<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanModel extends CI_Model
{

  public function getSales($id = null, $invoiceNumber = null)
  {
    $this->db->select('penjualan.*, barista.nama, toko.kodetoko');
    $this->db->from('penjualan');
    $this->db->join('barista', 'penjualan.kasir = barista.nik');
    $this->db->join('toko', 'penjualan.idtoko = toko.id');
    $this->db->where('penjualan.idtoko', $this->session->userdata('x-idm-store'));

    if ($id != null) {
      $this->db->where('penjualan.id', $id);
    }

    // if ($this->session->userdata('x-idm-store') != 1) {
    //   $this->db->where('penjualan.tanggal_transaksi >', date('Y-m-d H:i:s', strtotime('today midnight')));
    // }

    if ($invoiceNumber != null) {
      $this->db->where('penjualan.struk', $invoiceNumber);
    }

    return $this->db->get();
  }

  public function getSalesDetail($id)
  {
    $query =
      "SELECT 
        detail.singkatan, line.quantity, detail.sellingprice harga
      FROM 
        penjualan_detail line
      JOIN 
        product detail ON line.product_id = detail.id
      WHERE line.penjualan_id = '" . $id . "'";

    return $this->db->query($query);
  }

  public function getPendapatanHariIni()
  {
    $query = "SELECT SUM(total_belanja) as pendapatan FROM penjualan WHERE tanggal_transaksi >= CURDATE() AND idtoko = '" . $this->session->userdata('x-idm-store') . "'";

    return $this->db->query($query);
  }

  public function getPendapatanToko()
  {
    $query =
      "SELECT 
        SUM(penjualan.total_belanja) as pendapatan, toko.kodetoko, toko.nama_toko
      FROM 
        penjualan 
      JOIN
        toko ON penjualan.idtoko = toko.id
      WHERE 
        tanggal_transaksi >= CURDATE()
      GROUP BY toko.kodetoko, toko.nama_toko";

    return $this->db->query($query);
  }

  // Ajax 

  private function getAjaxQuery($search, $filter = null)
  {
    $this->db->select('penjualan.*, barista.nama');
    $this->db->from('penjualan');
    $this->db->join('barista', 'penjualan.kasir = barista.nik');
    $this->db->where('penjualan.idtoko', $this->session->userdata('x-idm-store'));

    if ($filter != null) {
      $this->db->where('penjualan.tanggal_transaksi >=', $filter['dateFrom']);
      $this->db->where('penjualan.tanggal_transaksi <=', $filter['dateTo']);
    }

    // if ($this->session->userdata('x-idm-store') != 1) {
    //   $this->db->where('penjualan.tanggal_transaksi >', date('Y-m-d H:i:s', strtotime('today midnight')));
    // }

    if ($search != null) {
      $this->db->group_start();
      $this->db->like('penjualan.struk', $search);
      $this->db->or_like('penjualan.member', $search);
      $this->db->or_like('penjualan.total_belanja', $search);
      $this->db->or_like('barista.nama', $search);
      $this->db->or_like('penjualan.tanggal_transaksi', $search);
      $this->db->group_end();
    }
  }

  public function getDatatables($search, $length, $start, $orderColumn, $orderDir, $filter = null)
  {
    $this->getAjaxQuery($search, $filter);
    $this->db->order_by($orderColumn, $orderDir);
    $this->db->limit($length, $start);

    return $this->db->get()->result();
  }

  public function getRecordsFiltered($search = null)
  {
    $this->getAjaxQuery($search);
    return $this->db->get();
  }

  public function getProfit($dataFilter)
  {
    $this->db->from('profit')
      ->join('toko', 'toko.id = profit.idtoko')
      ->where('profit.tanggal >=', $dataFilter['tanggal_awal'])
      ->where('profit.tanggal <=', $dataFilter['tanggal_akhir']);

    if ($dataFilter['filter_toko'] != null) {
      $this->db->where('profit.idtoko', $dataFilter['filter_toko']);
    }

    return $this->db->get();
  }

  public function pendapatan_perbulan()
  {
    $query =
      "SELECT 
        SUM(penjualan.total_belanja) as pendapatan, 
        toko.kodetoko, 
        toko.nama_toko, 
        MONTHNAME(penjualan.tanggal_transaksi) AS periode
      FROM 
        penjualan 
      JOIN
        toko ON penjualan.idtoko = toko.id
      WHERE 
        MONTH(penjualan.tanggal_transaksi) = MONTH(CURDATE())
      GROUP BY 
        toko.kodetoko, toko.nama_toko, MONTH(penjualan.tanggal_transaksi)";

    return $this->db->query($query);
  }

  public function pengeluaran_perbulan()
  {
    $query =
      "SELECT 
        SUM(proses_barang_detail.total) as pengeluaran, 
        toko.kodetoko, 
        toko.nama_toko, 
        MONTHNAME(proses_barang.tanggal_terima) AS periode
      FROM 
        proses_barang 
      JOIN
        proses_barang_detail ON proses_barang.surat_jalan = proses_barang_detail.surat_jalan
      JOIN
        toko ON proses_barang.idtoko = toko.id
      WHERE 
        MONTH(proses_barang.tanggal_terima) = MONTH(CURDATE())
      GROUP BY 
        toko.kodetoko, toko.nama_toko, MONTH(proses_barang.tanggal_terima)";

    return $this->db->query($query);
  }

  public function pendapatan_perhari()
  {
    $query =
      "SELECT 
        toko.kodetoko, 
        toko.nama_toko, 
        SUM(penjualan.total_belanja) as pendapatan, 
        DAY(penjualan.tanggal_transaksi) AS periode
      FROM 
        penjualan 
      JOIN
        toko ON penjualan.idtoko = toko.id
      WHERE 
        DAY(penjualan.tanggal_transaksi) = DAY(CURDATE())
      GROUP BY 
        toko.kodetoko, toko.nama_toko, periode";

    return $this->db->query($query);
  }

  public function getTutupShift($id = null, $idToko = null)
  {
    $this->db->from('tutup_shift');
    if ($id != null) {
      $this->db->where('id', $id);
    }

    if ($idToko != null) {
      $this->db->where('idtoko', $idToko);
    }

    $this->db->order_by('tanggal_tutup_shift DESC', 'shift ASC');

    return $this->db->get();
  }

  public function getShiftHarian($tanggal = null)
  {
    $this->db->from('tutup_shift');
    $this->db->where('tanggal_tutup_shift >=', $tanggal . ' 00:00:00');
    $this->db->where('tanggal_tutup_shift <=', $tanggal . ' 23:59:59');
    return $this->db->get();
  }

  public function getTutupHarian($id = null, $idToko = null)
  {
    $this->db->from('tutup_harian');
    if ($id != null) {
      $this->db->where('id', $id);
    }

    if ($idToko != null) {
      $this->db->where('idtoko', $idToko);
    }

    $this->db->order_by('tanggal_tutup_harian DESC');

    return $this->db->get();
  }

  public function pendapatanPertoko($dataFilter)
  {
    $query =
      "SELECT
        SUM(penjualan.total_belanja) AS total_belanja,
        MONTHNAME(penjualan.tanggal_transaksi) month_period,
        SUM(penjualan_detail.quantity) total_items,
        COUNT(penjualan_detail.id) total_customer,
        penjualan.idtoko,
        CONCAT(toko.kodetoko, ' - ', toko.nama_toko) nama_toko
      FROM
        penjualan
      JOIN
        penjualan_detail ON penjualan_detail.penjualan_id = penjualan.id
      JOIN 
        toko ON toko.id = penjualan.idtoko
      WHERE 
        penjualan.tanggal_transaksi >= '{$dataFilter['tanggal_awal']}'
      AND 
        penjualan.tanggal_transaksi <= '{$dataFilter['tanggal_akhir']}'";

    if ($dataFilter['filter_toko'] != null) {
      $query .=
        " AND
          penjualan.idtoko = '{$dataFilter['filter_toko']}' ";
    }

    $query .=
      " GROUP BY
        penjualan.idtoko, MONTH(tanggal_transaksi)";

    return $this->db->query($query);
  }

  public function pendapatanAllToko()
  {
    $query =
      "SELECT
        SUM(penjualan.total_belanja) AS pendapatan,
        MONTHNAME(penjualan.tanggal_transaksi) month_period
      FROM
        penjualan
      WHERE 
        penjualan.tanggal_transaksi >= DATE_ADD(DATE_ADD(LAST_DAY(CURDATE()), INTERVAL 1 DAY), INTERVAL - 1 MONTH)
      AND 
        penjualan.tanggal_transaksi <= NOW()";

    return $this->db->query($query);
  }

  public function pendapatanAllTokoPertahun()
  {
    $query =
      "SELECT
        SUM(penjualan.total_belanja) AS pendapatan
      FROM
        penjualan
      WHERE 
        penjualan.tanggal_transaksi >= DATE_FORMAT(NOW() ,'%Y-01-01')
      AND 
        penjualan.tanggal_transaksi <= NOW()";

    return $this->db->query($query);
  }

  public function grandTotalCustomer()
  {
    $query =
      "SELECT
        COUNT(penjualan.id) customer
      FROM
        penjualan
    ";

    return $this->db->query($query);
  }

  public function getTokoByData()
  {
    $query =
      "SELECT
        penjualan.idtoko as idtoko,
        CONCAT(toko.kodetoko, ' - ', toko.nama_toko) as nama_toko
      FROM
        penjualan
      JOIN
        penjualan_detail ON penjualan_detail.penjualan_id = penjualan.id
      JOIN 
        toko ON toko.id = penjualan.idtoko
      GROUP BY
        toko.id, toko.nama_toko";

    return $this->db->query($query);
  }

  public function getPengeluaranTokoByData()
  {
    $query =
      "SELECT
        proses_barang.idtoko as idtoko,
        CONCAT(toko.kodetoko, ' - ', toko.nama_toko) as nama_toko
      FROM
        proses_barang
      JOIN
        proses_barang_detail ON proses_barang_detail.surat_jalan = proses_barang.surat_jalan
      JOIN 
        toko ON toko.id = proses_barang.idtoko
      GROUP BY
        toko.id, toko.nama_toko";

    return $this->db->query($query);
  }

  public function getPengeluaranTokoBySupplier()
  {
    $query =
      "SELECT
        proses_barang.supplier
      FROM
        proses_barang
      GROUP BY
        proses_barang.supplier";

    return $this->db->query($query);
  }

  public function getDataPengeluaran($dataFilter, $order = false)
  {
    $query =
      "SELECT
        header.*,
        CONCAT(toko.kodetoko, ' - ', toko.nama_toko) nama_toko,
        SUM(line.total) total
      FROM 
        proses_barang_detail line
      JOIN 
        proses_barang header ON line.surat_jalan = header.surat_jalan
      JOIN 
        toko ON toko.id = header.idtoko
      WHERE 
        header.status = 35
      AND 
        header.tanggal_terima >= '{$dataFilter['tanggal_awal']}'
      AND 
        header.tanggal_terima <= '{$dataFilter['tanggal_akhir']}'";

    if ($dataFilter['filter_toko'] != null) {
      $query .=
        " AND
          header.idtoko = '{$dataFilter['filter_toko']}' ";
    }

    if ($dataFilter['filter_supplier'] != null) {
      $query .=
        "AND
          header.supplier = '{$dataFilter['filter_supplier']}' ";
    }

    $query .=
      " GROUP BY
          header.supplier, header.kodepermintaan, header.tanggal_terima, header.idtoko";

    if ($order == true) {
      $query .=
        " ORDER BY
          SUM(line.total)";
    }

    return $this->db->query($query);
  }
  public function getDataPengeluaranGrouped($dataFilter, $order = false)
  {
    $query =
      "SELECT
        MONTHNAME(header.tanggal_terima) periode,
        CONCAT(toko.kodetoko, ' - ', toko.nama_toko) nama_toko,
        SUM(line.total) total
      FROM 
        proses_barang_detail line
      JOIN 
        proses_barang header ON line.surat_jalan = header.surat_jalan
      JOIN 
        toko ON toko.id = header.idtoko
      WHERE 
        header.status = 35
      AND 
        header.tanggal_terima >= '{$dataFilter['tanggal_awal']}'
      AND 
        header.tanggal_terima <= '{$dataFilter['tanggal_akhir']}'";

    if ($dataFilter['filter_toko'] != null) {
      $query .=
        " AND
          header.idtoko = '{$dataFilter['filter_toko']}' ";
    }

    if ($dataFilter['filter_supplier'] != null) {
      $query .=
        "AND
          header.supplier = '{$dataFilter['filter_supplier']}' ";
    }

    $query .=
      " GROUP BY
        MONTHNAME(header.tanggal_terima), header.idtoko";

    if ($order == true) {
      $query .=
        " ORDER BY
          SUM(line.total)";
    }

    return $this->db->query($query);
  }

  public function getProductTerlaris($dataFilter)
  {
    $query =
      "SELECT
        product.singkatan,
        product.prdcd,
        product.sellingprice,
        product.price,
        SUM(penjualan_detail.product_id) jumlah_terjual,
        MONTHNAME('{$dataFilter['tanggal_awal']}') periode
      FROM
        penjualan
      JOIN
        penjualan_detail ON penjualan.id = penjualan_detail.penjualan_id
      JOIN
        product ON penjualan_detail.product_id = product.id
      WHERE
        penjualan.tanggal_transaksi >= '{$dataFilter['tanggal_awal']}'
      AND
        penjualan.tanggal_transaksi <= '{$dataFilter['tanggal_akhir']}'
      GROUP BY 
        penjualan_detail.product_id, product.prdcd
      ORDER BY
        SUM(penjualan_detail.product_id) DESC";

    return $this->db->query($query);
  }

  public function groupedProfit()
  {
    $query =
      "SELECT
        SUM(profit.profit) profit,
        profit.tanggal,
        profit.idtoko
      FROM
        profit
      WHERE
        (profit.tanggal BETWEEN DATE_FORMAT(NOW(), '%Y-01-01') AND NOW())
      GROUP BY
        profit.idtoko, profit.tanggal";

    return $this->db->query($query);
  }

  public function profitPerbulan()
  {
    $query =
      "SELECT
        SUM(profit.profit) AS profit,
        MONTHNAME(profit.tanggal) periode,
        toko.kodetoko AS toko
      FROM
        profit
      JOIN
        toko on profit.idtoko = toko.id
      WHERE
        profit.tanggal BETWEEN NOW() - INTERVAL 30 DAY AND NOW()
      GROUP BY
        toko.kodetoko, periode";

    return $this->db->query($query);
  }
}
