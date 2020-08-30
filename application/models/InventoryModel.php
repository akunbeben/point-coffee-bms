<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InventoryModel extends CI_Model
{

  public function getItems($id = null, $kodePermintaan = null, $tanggalFilter = null, $status = null)
  {
    $this->db->select('proses_barang.*, lookupvalue.desc');
    $this->db->from('proses_barang');
    $this->db->join('lookupvalue', 'proses_barang.status = lookupvalue.id');

    if ($id != null) {
      $this->db->where('id', $id);
    }

    if ($tanggalFilter != null) {
      $this->db->where('tanggal_terima >=', $tanggalFilter['tanggal_awal'] . ' 00:00:00');
      $this->db->where('tanggal_terima <=', $tanggalFilter['tanggal_akhir'] . ' 23:59:59');
    }

    if ($kodePermintaan != null) {
      $this->db->where('kodepermintaan', $kodePermintaan);
    }

    if ($status != null) {
      foreach ($status as $key) {
        $this->db->or_where('status', $key);
      }
    }

    if ($this->session->userdata('x-idm-store') != 1) {
      $this->db->where('proses_barang.idtoko', $this->session->userdata('x-idm-store'));
    }

    $this->db->order_by('proses_barang.tanggal_terima ASC');

    return $this->db->get();
  }

  public function updateStock($suratJalan)
  {
    // $query = "UPDATE stock_toko firstTable
    //           INNER JOIN stock ON firstTable.idstock = stock.id
    //           INNER JOIN proses_barang_detail secondTable ON stock.prdcd = secondTable.prdcd
    //           SET firstTable.jumlah = firstTable.jumlah + secondTable.jumlah
    //           WHERE secondTable.surat_jalan = '" . $suratJalan . "'";

    // $this->db->query($query);
    $totalStock = null;
    $dataProses = $this->db->select('stock.*, proses_barang_detail.jumlah')
      ->where('surat_jalan', $suratJalan)
      ->join('stock', 'stock.prdcd = proses_barang_detail.prdcd')
      ->get('proses_barang_detail')
      ->result();


    foreach ($dataProses as $proses) {
      $totalStock = $this->db->where('stock_toko.idstock', $proses->id)->where('stock_toko.idtoko', $this->session->userdata('x-idm-store'))->get('stock_toko')->result();

      if ($totalStock != null) {
        foreach ($totalStock as $stockUpdate) {
          $dataToInsert = [
            'id' => $stockUpdate->id,
            'jumlah' => $proses->jumlah + $stockUpdate->jumlah
          ];

          $this->db->set('jumlah', $dataToInsert['jumlah'])->where('id', $dataToInsert['id'])->update('stock_toko');
        }
      } else {
        $dataToInsert = [
          'id' => null,
          'idtoko' => $this->session->userdata('x-idm-store'),
          'idstock' => $proses->id,
          'jumlah' => $proses->jumlah
        ];

        $this->db->insert('stock_toko', $dataToInsert);
      }
    }
  }

  public function getSingle($kodePermintaan)
  {
    $this->db->from('proses_barang');
    $this->db->where('kodepermintaan', $kodePermintaan);
    return $this->db->get();
  }

  public function submitItemNew($id, $suratJalan)
  {
    $query = "INSERT INTO proses_barang_detail_temp (surat_jalan, prdcd, harga, kategori, satuan, jumlah)
    SELECT '" . $suratJalan . "', prdcd, harga, kategori, satuan, jumlah FROM permintaan_barang_detail WHERE id = '" . $id . "'";

    $this->db->query($query);
  }

  public function submitItem($id, $suratJalan)
  {
    $query =
      "INSERT INTO 
        proses_barang_detail_temp (
          surat_jalan, 
          prdcd, 
          jumlah, 
          total
        )
        SELECT 
          '" . $suratJalan . "', 
          prdcd,  
          jumlah,
          (
            SELECT 
              (stock.harga * permintaan.jumlah) AS total 
            FROM 
              stock
            JOIN
              permintaan_barang_detail permintaan ON stock.prdcd = permintaan.prdcd
            WHERE
              permintaan.id = '" . $id . "'
          ) AS total
        FROM 
          permintaan_barang_detail 
        WHERE 
          id = '" . $id . "'";

    $this->db->query($query);
  }

  public function sendTempData()
  {
    $query = "INSERT INTO proses_barang_detail (surat_jalan, prdcd, jumlah, total)
              SELECT surat_jalan, prdcd, jumlah, total FROM proses_barang_detail_temp";

    $this->db->query($query);
  }

  public function resetTempData()
  {
    $this->db->truncate('proses_barang_detail_temp');
  }

  public function selesaiProses($suratJalan)
  {
    $this->db->set('status', 35);
    $this->db->where('surat_jalan', $suratJalan);
    $this->db->update('proses_barang');
  }

  public function getLineItems($suratJalan)
  {
    $this->db->select('
      proses_barang_detail_temp.id,
      proses_barang_detail_temp.surat_jalan,
      proses_barang_detail_temp.prdcd,
      stock.kategori,
      stock.satuan,
      proses_barang_detail_temp.jumlah, 
      proses_barang_detail_temp.total, 
      stock.deskripsi as nama_item, 
      stock.harga, 
      kategoriValue.singkatan as ketegoriText, 
      satuanValue.singkatan as satuanText');
    $this->db->from('proses_barang_detail_temp');
    $this->db->join('stock', 'stock.prdcd = proses_barang_detail_temp.prdcd');
    $this->db->join('lookupvalue as kategoriValue', 'kategoriValue.id = stock.kategori');
    $this->db->join('lookupvalue as satuanValue', 'satuanValue.id = stock.satuan');
    $this->db->where('proses_barang_detail_temp.surat_jalan', $suratJalan);
    return $this->db->get();
  }

  public function prosesData($data)
  {
    $this->db->set('surat_jalan', $data['surat_jalan']);
    $this->db->set('status', $data['status']);
    $this->db->set('tanggal_terima', $data['tanggal_terima']);
    $this->db->where('id', $data['id']);
    $this->db->update('proses_barang');

    if ($this->db->affected_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function generateDataProses($data)
  {
    $this->db->insert('proses_barang', $data);
  }

  public function getDataItems($id = null, $kodePermintaan = null)
  {
    $this->db->select('pendingItem.id, pendingItem.kodepermintaan, pendingItem.prdcd, itemDetail.deskripsi as nama_item, pendingItem.harga, categoryItem.singkatan as kategori, unitItem.singkatan as satuan, pendingItem.jumlah');
    $this->db->from('permintaan_barang_detail pendingItem');
    $this->db->join('stock itemDetail', 'itemDetail.prdcd = pendingItem.prdcd');
    $this->db->join('lookupvalue as categoryItem', 'categoryItem.id = pendingItem.kategori');
    $this->db->join('lookupvalue as unitItem', 'unitItem.id = pendingItem.satuan');

    if ($id != null) {
      $this->db->where('id', $id);
    }

    if ($kodePermintaan != null) {
      $this->db->where('kodepermintaan', $kodePermintaan);
    }

    return $this->db->get();
  }

  public function datatablesQuery($search, $kodePermintaan)
  {
    $this->db->select('pendingItem.id, pendingItem.kodepermintaan, pendingItem.prdcd, itemDetail.deskripsi as nama_item, pendingItem.harga, categoryItem.singkatan as kategori, unitItem.singkatan as satuan, pendingItem.jumlah');

    $this->db->from('permintaan_barang_detail pendingItem');
    $this->db->join('stock itemDetail', 'itemDetail.prdcd = pendingItem.prdcd');
    $this->db->join('lookupvalue as categoryItem', 'categoryItem.id = pendingItem.kategori');
    $this->db->join('lookupvalue as unitItem', 'unitItem.id = pendingItem.satuan');
    $this->db->where('pendingItem.kodepermintaan', $kodePermintaan);

    if ($search != null) {
      $this->db->group_start();
      $this->db->like('pendingItem.prdcd', $search);
      $this->db->or_like('itemDetail.deskripsi', $search);
      $this->db->or_like('pendingItem.harga', $search);
      $this->db->or_like('categoryItem.singkatan', $search);
      $this->db->or_like('unitItem.singkatan', $search);
      $this->db->group_end();
    }
  }

  public function getDatatables($search, $length, $start, $orderColumn, $orderDir, $kodePermintaan)
  {
    $this->DatatablesQuery($search, $kodePermintaan);
    $this->db->order_by($orderColumn, $orderDir);
    $this->db->limit($length, $start);

    return $this->db->get()->result();
  }

  public function getRecordsFiltered($search = null, $kodePermintaan)
  {
    $this->DatatablesQuery($search, $kodePermintaan);
    return $this->db->get();
  }

  // Retur Barang

  public function getData($returCode = null, $tanggalFilter = null)
  {
    $this->db->select('returBarang.*, supplier.supco, supplier.nama_supplier');
    $this->db->from('retur_barang returBarang');
    $this->db->join('supplier', 'returBarang.supplier_id = supplier.id');

    if ($returCode != null) {
      $this->db->where('returBarang.kode_retur', $returCode);
    }

    if ($tanggalFilter != null) {
      $this->db->where('tanggal_retur >=', $tanggalFilter['tanggal_awal'] . ' 00:00:00');
      $this->db->where('tanggal_retur <=', $tanggalFilter['tanggal_akhir'] . ' 23:59:59');
    }

    if ($this->session->userdata('x-idm-store') != 1) {
      $this->db->where('returBarang.idtoko', $this->session->userdata('x-idm-store'));
    }

    return $this->db->get();
  }

  public function createRetur($data)
  {
    $this->db->insert('retur_barang', $data);
  }

  public function getLineRetur($returCode = null)
  {
    $this->db->select('
      line.*,
      item.deskripsi nama_item,
      unit.desc satuan
    ');

    $this->db->from('retur_barang_detail line');
    $this->db->join('retur_barang header', 'line.retur_id = header.id');
    $this->db->join('stock item', 'line.prdcd = item.prdcd');
    $this->db->join('lookupvalue unit', 'item.satuan = unit.id');
    $this->db->where('header.kode_retur', $returCode);
    return $this->db->get();
  }

  public function createLine($data)
  {
    $this->db->insert('retur_barang_detail', $data);
  }

  public function deleteLine($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('retur_barang_detail');
  }

  public function prosesRetur($idRetur)
  {
    $firstQuery =
      "UPDATE stock firstTable
      INNER JOIN stock_toko
      ON firstTable.id = stock_toko.idstock
      INNER JOIN retur_barang_detail secondTable
      ON firstTable.prdcd = secondTable.prdcd
      SET stock_toko.jumlah = stock_toko.jumlah - secondTable.jumlah
      WHERE secondTable.retur_id = '" . $idRetur . "'";
    $this->db->query($firstQuery);

    $secondQuery =
      "UPDATE retur_barang firstTable
      SET firstTable.jumlah_item = (SELECT SUM(jumlah) total FROM retur_barang_detail WHERE retur_id = {$idRetur})
      WHERE firstTable.id = '" . $idRetur . "'";
    $this->db->query($secondQuery);
  }

  public function datatablesQueryRetur($search, $returCode)
  {
    $this->db->select('returItem.id, returItem.prdcd, returItem.jumlah, itemDetail.deskripsi as nama_item');

    $this->db->from('retur_barang_detail returItem');
    $this->db->join('stock itemDetail', 'itemDetail.prdcd = returItem.prdcd');
    $this->db->join('retur_barang header', 'returItem.retur_id = header.id');
    $this->db->where('header.kode_retur', $returCode);

    if ($search != null) {
      $this->db->group_start();
      $this->db->like('returItem.prdcd', $search);
      $this->db->or_like('returItem.jumlah', $search);
      $this->db->or_like('returItem.deskripsi', $search);
      $this->db->group_end();
    }
  }

  public function getDatatablesRetur($search, $length, $start, $orderColumn, $orderDir, $returCode)
  {
    $this->datatablesQueryRetur($search, $returCode);
    $this->db->order_by($orderColumn, $orderDir);
    $this->db->limit($length, $start);

    return $this->db->get()->result();
  }

  public function getRecordsFilteredRetur($search = null, $returCode)
  {
    $this->datatablesQueryRetur($search, $returCode);
    return $this->db->get();
  }

  public function getKonversi($id = null, $tanggalFilter = null)
  {
    $this->db->select('konversi.*, stock.deskripsi as nama_item');
    $this->db->from('konversi');
    $this->db->join('stock', 'konversi.prdcd = stock.prdcd');

    if ($id != null) {
      $this->db->where('konversi.id', $id);
    }

    if ($tanggalFilter != null) {
      $this->db->where('tanggal_konversi >=', $tanggalFilter['tanggal_awal'] . ' 00:00:00');
      $this->db->where('tanggal_konversi <=', $tanggalFilter['tanggal_akhir'] . ' 23:59:59');
    }

    if ($this->session->userdata('x-idm-store') != 1) {
      $this->db->where('konversi.idtoko', $this->session->userdata('x-idm-store'));
    }

    return $this->db->get();
  }

  public function getCurrentPeriodKonversi($filter)
  {
    $query =
      "SELECT 
        DATE(konversi.tanggal_konversi) bulan
      FROM
        konversi
      WHERE 
        MONTH(konversi.tanggal_konversi) = MONTH('$filter')
      GROUP BY 
        MONTH(konversi.tanggal_konversi)";

    return $this->db->query($query);
  }

  public function groupKonversiByMonth()
  {
    $query =
      "SELECT 
        DATE(konversi.tanggal_konversi) bulan,
        MONTH(konversi.tanggal_konversi) bulan_angka,
        MONTHNAME(konversi.tanggal_konversi) bulan_nama
      FROM
        konversi
      GROUP BY
        MONTH(konversi.tanggal_konversi)";

    return $this->db->query($query);
  }

  public function createKonversi($data)
  {
    $this->db->insert('konversi', $data);
  }

  public function minusKonversi($data)
  {
    $query =
      "UPDATE 
        stock 
      JOIN
        stock_toko ON stock.id = stock_toko.idstock
      SET 
        stock_toko.jumlah = stock_toko.jumlah - {$data['jumlah']} 
      WHERE 
        stock.prdcd = '{$data['prdcd']}'";

    $this->db->query($query);
  }

  public function getHeaderProsesBarang($suratJalan = null, $idToko = null)
  {
    $query =
      "SELECT
        proses_barang.*,
        SUM(stock.harga * proses_barang_detail.jumlah) AS total,
        SUM(proses_barang_detail.jumlah) AS total_barang
      FROM
        proses_barang
      JOIN
        proses_barang_detail ON proses_barang.surat_jalan = proses_barang_detail.surat_jalan
      JOIN
        stock ON proses_barang_detail.prdcd = stock.prdcd
      WHERE
        proses_barang.status = 35
      AND
        proses_barang.surat_jalan = '$suratJalan'
      AND
        proses_barang.idtoko = '$idToko'
      GROUP BY
        proses_barang.surat_jalan";

    return $this->db->query($query);
  }

  public function getLineProsesBarang($suratJalan = null)
  {
    $this->db->select('
    proses_barang_detail.id,
    proses_barang_detail.surat_jalan,
    proses_barang_detail.prdcd,
    proses_barang_detail.kategori,
    proses_barang_detail.satuan,
    proses_barang_detail.jumlah, 
    proses_barang_detail.total, 
    stock.deskripsi,
    stock.harga');
    $this->db->from('proses_barang_detail');
    $this->db->join('stock', 'stock.prdcd = proses_barang_detail.prdcd');

    if ($suratJalan != null) {
      $this->db->where('surat_jalan', $suratJalan);
    }

    return $this->db->get();
  }

  public function penerimaanBelumDiproses()
  {
    $this->db->select('proses_barang.*, lookupvalue.desc');
    $this->db->from('proses_barang');
    $this->db->join('lookupvalue', 'proses_barang.status = lookupvalue.id');

    $this->db->where('proses_barang.idtoko', $this->session->userdata('x-idm-store'));
    $this->db->where('proses_barang.status', 32);

    $this->db->order_by('proses_barang.tanggal_terima ASC');

    return $this->db->get();
  }
}
