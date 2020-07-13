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

    if ($this->session->userdata('x-idm-store') != 1) {
      $this->db->where('penjualan.tanggal_transaksi >', date('Y-m-d H:i:s', strtotime('today midnight')));
    }

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

  private function getAjaxQuery($search)
  {
    $this->db->select('penjualan.*, barista.nama');
    $this->db->from('penjualan');
    $this->db->join('barista', 'penjualan.kasir = barista.nik');
    $this->db->where('penjualan.idtoko', $this->session->userdata('x-idm-store'));

    if ($this->session->userdata('x-idm-store') != 1) {
      $this->db->where('penjualan.tanggal_transaksi >', date('Y-m-d H:i:s', strtotime('today midnight')));
    }

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

  public function getDatatables($search, $length, $start, $orderColumn, $orderDir)
  {
    $this->getAjaxQuery($search);
    $this->db->order_by($orderColumn, $orderDir);
    $this->db->limit($length, $start);

    return $this->db->get()->result();
  }

  public function getRecordsFiltered($search = null)
  {
    $this->getAjaxQuery($search);
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
}
