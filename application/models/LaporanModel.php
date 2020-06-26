<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanModel extends CI_Model
{

  public function getSales($id = null, $invoiceNumber = null)
  {
    $this->db->from('penjualan');
    $this->db->where('penjualan.idtoko', $this->session->userdata('x-idm-store'));

    if ($id != null) {
      $this->db->where('penjualan.id', $id);
    }

    if ($invoiceNumber != null) {
      $this->db->where('penjualan.struk', $invoiceNumber);
    }

    return $this->db->get();
  }

  public function getSalesDetail($id)
  {
    $this->db->from('penjualan_detail');
  }

  private function getAjaxQuery($search)
  {
    $this->db->select('penjualan.*, barista.nama');
    $this->db->from('penjualan');
    $this->db->join('barista', 'penjualan.kasir = barista.nik');
    $this->db->where('penjualan.idtoko', $this->session->userdata('x-idm-store'));

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
}
