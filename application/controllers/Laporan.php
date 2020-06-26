<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    IsAuthenticate();
    $this->load->model('LaporanModel');
  }

  public function laporan_penjualan()
  {
    $data = [
      'title' => 'Laporan Penjualan',
      'javascript' => 'laporan_penjualan.js'
    ];

    $this->template->load('layout/template', 'laporan/penjualan/index', $data);
  }

  public function api_laporan_penjualan()
  {
    $search         = $_POST['search']['value'];
    $length         = $_POST['length'];
    $start          = $_POST['start'];
    $sortColumnName = $_POST['columns']['' . $_POST['order']['0']['column'] . '']['name'];
    $sortDir        = $_POST['order']['0']['dir'];

    $draw = $_POST['draw'];
    $recordsFiltered = $this->LaporanModel->getRecordsFiltered($search)->num_rows();
    $recordsTotal = $this->LaporanModel->getSales()->num_rows();
    $data = $this->LaporanModel->getDatatables($search, $length, $start, $sortColumnName, $sortDir);

    $output = ['draw' => $draw, 'recordsFiltered' => $recordsFiltered, 'recordsTotal' => $recordsTotal, 'data' => $data];

    header('Content-Type: application/json');
    echo json_encode($output);
  }

  public function api_penjualan_detail($invoiceNumber)
  {
    $data = $this->LaporanModel->getSales($invoiceNumber)->row();
    $data->tanggal_transaksi = date('Y M d H:i:s', strtotime($data->tanggal_transaksi));

    if ($data != null) {
      $output = [
        'status' => true,
        'data' => $data
      ];
    } else {
      $output = [
        'status' => true,
        'data' => null
      ];
    }

    header('Content-Type: application/json');
    echo json_encode($output);
  }
}
