<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InventoryModel extends CI_Model
{

  public function getItems($id = null, $kodePermintaan = null)
  {
    $this->db->select('proses_barang.*, lookupvalue.desc');
    $this->db->from('proses_barang');
    $this->db->join('lookupvalue', 'proses_barang.status = lookupvalue.id');

    if ($id != null) {
      $this->db->where('id', $id);
    }

    if ($kodePermintaan != null) {
      $this->db->where('kodepermintaan', $kodePermintaan);
    }

    if ($this->session->userdata('x-idm-store') != 1) {
      $this->db->where('proses_barang.idtoko', $this->session->userdata('x-idm-store'));
    }

    return $this->db->get();
  }

  public function updateStock($suratJalan)
  {
    $query = "UPDATE stock firstTable
              INNER JOIN proses_barang_detail secondTable
              ON firstTable.prdcd = secondTable.prdcd
              SET firstTable.jumlah = firstTable.jumlah + secondTable.jumlah, 
                  firstTable.harga = secondTable.harga
              WHERE secondTable.surat_jalan = '" . $suratJalan . "'";

    $this->db->query($query);
  }

  public function getSingle($kodePermintaan)
  {
    $this->db->from('proses_barang');
    $this->db->where('kodepermintaan', $kodePermintaan);
    return $this->db->get();
  }

  public function submitItem($id, $suratJalan)
  {
    $query = "INSERT INTO proses_barang_detail_temp (surat_jalan, prdcd, harga, kategori, satuan, jumlah)
              SELECT '" . $suratJalan . "', prdcd, harga, kategori, satuan, jumlah FROM permintaan_barang_detail WHERE id = '" . $id . "'";

    $this->db->query($query);
  }

  public function sendTempData()
  {
    $query = "INSERT INTO proses_barang_detail (surat_jalan, prdcd, harga, kategori, satuan, jumlah)
              SELECT surat_jalan, prdcd, harga, kategori, satuan, jumlah FROM proses_barang_detail_temp";

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
    $this->db->select('proses_barang_detail_temp.*, stock.deskripsi as nama_item, kategoriValue.singkatan as ketegoriText, satuanValue.singkatan as satuanText');
    $this->db->from('proses_barang_detail_temp');
    $this->db->join('stock', 'stock.prdcd = proses_barang_detail_temp.prdcd');
    $this->db->join('lookupvalue as kategoriValue', 'kategoriValue.id = proses_barang_detail_temp.kategori');
    $this->db->join('lookupvalue as satuanValue', 'satuanValue.id = proses_barang_detail_temp.satuan');
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

  public function getData($returCode = null)
  {
    $this->db->select('returBarang.*, supplier.supco, supplier.nama_supplier');
    $this->db->from('retur_barang returBarang');
    $this->db->join('supplier', 'returBarang.supplier_id = supplier.id');

    if ($returCode != null) {
      $this->db->where('returBarang.kode_retur', $returCode);
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
      item.deskripsi nama_item
    ');

    $this->db->from('retur_barang_detail line');
    $this->db->join('retur_barang header', 'line.retur_id = header.id');
    $this->db->join('stock item', 'line.prdcd = item.prdcd');
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
      INNER JOIN retur_barang_detail secondTable
      ON firstTable.prdcd = secondTable.prdcd
      SET firstTable.jumlah = firstTable.jumlah - secondTable.jumlah
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

  public function getKonversi($id = null)
  {
    $this->db->select('konversi.*, stock.deskripsi as nama_item');
    $this->db->from('konversi');
    $this->db->join('stock', 'konversi.prdcd = stock.prdcd');

    if ($id != null) {
      $this->db->where('konversi.id', $id);
    }

    if ($this->session->userdata('x-idm-store') != 1) {
      $this->db->where('konversi.idtoko', $this->session->userdata('x-idm-store'));
    }

    return $this->db->get();
  }

  public function createKonversi($data)
  {
    $this->db->insert('konversi', $data);
  }

  public function minusKonversi($data)
  {
    $query = "UPDATE stock SET jumlah = jumlah - {$data['jumlah']} WHERE prdcd = '{$data['prdcd']}'";

    $this->db->query($query);
  }
}
