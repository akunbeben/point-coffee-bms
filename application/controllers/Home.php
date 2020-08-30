<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    IsAuthenticate();
    $this->load->model('TokoModel');
    $this->load->model('LaporanModel');
    $this->load->model('InitialModel');
    $this->load->model('BaristaModel');
    $this->load->model('KasirModel');
    $this->load->model('StockModel');
    $this->load->model('InventoryModel');
    $this->load->model('LaporanModel');
    $this->load->helper('kasir');
  }

  public function index()
  {
    $tanggal_filter = date('Y-m-d 00:00:00', time());

    $data = [
      'title' => 'Home',
      'javascript' => 'home_users.js',
      'jumlah_toko' => count($this->TokoModel->get()->result()),
      'view' => 'home/index_users.php',
      'initial' => 'Belum ada Initial',
      'total_customer' => 0,
      'pending' => 0,
      'approved' => 0,
      'rejected' => 0,
      'penerimaan' => 0,
      'pendapatan_perbulan' => 0,
      'pendapatan_pertahun' => 0,
      'customer' => 0
    ];

    if ($this->session->userdata('x-idm-store') == 1) {
      $data['javascript'] = 'home.js';
      $data['view'] = 'home/index';

      if ($this->LaporanModel->pendapatanAllToko()->row()->pendapatan > 0) {
        $data['pendapatan_perbulan'] = $this->LaporanModel->pendapatanAllToko()->row()->pendapatan;
      }

      if ($this->LaporanModel->pendapatanAllTokoPertahun()->row()->pendapatan > 0) {
        $data['pendapatan_pertahun'] = $this->LaporanModel->pendapatanAllTokoPertahun()->row()->pendapatan;
      }

      if ($this->LaporanModel->grandTotalCustomer()->row()->customer > 0) {
        $data['customer'] = $this->LaporanModel->grandTotalCustomer()->row()->customer;
      }
    }

    if ($this->InitialModel->CheckInitialStatus() != null) {
      if ($this->InitialModel->CheckInitialStatus()->nik != 0) {
        $data['initial'] = $this->BaristaModel->GetBaristaByNik($this->InitialModel->CheckInitialStatus()->nik)->row()->nama;
      }
    }

    if ($this->KasirModel->getCountSales($tanggal_filter)->row() != null) {
      if ($this->KasirModel->getCountSales($tanggal_filter)->row()->jumlah_struk > 0) {
        $data['total_customer'] = $this->KasirModel->getCountSales($tanggal_filter)->row()->jumlah_struk;
      }
    }

    if ($this->StockModel->GetDataPermintaanPending()->num_rows() > 0) {
      $data['pending'] = $this->StockModel->GetDataPermintaanPending()->num_rows();
    }

    if ($this->StockModel->GetDataPermintaanApproved()->num_rows() > 0) {
      $data['approved'] = $this->StockModel->GetDataPermintaanApproved()->num_rows();
    }

    if ($this->StockModel->GetDataPermintaanRejected()->num_rows() > 0) {
      $data['rejected'] = $this->StockModel->GetDataPermintaanRejected()->num_rows();
    }

    if ($this->InventoryModel->penerimaanBelumDiproses()->num_rows() > 0) {
      $data['penerimaan'] = $this->InventoryModel->penerimaanBelumDiproses()->num_rows();
    }

    // var_dump($data);
    // die;

    $this->template->load('layout/template', $data['view'], $data);
  }
}
