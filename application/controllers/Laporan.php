<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Mpdf\Mpdf;

class Laporan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    IsAuthenticate();
    $this->load->model('TokoModel');
    $this->load->model('LaporanModel');
    $this->load->model('InventoryModel');
    $this->load->helper('kasir_helper');
  }

  public function laporan_penjualan()
  {
    $data = [
      'title' => 'Laporan Penjualan',
      'javascript' => 'laporan_penjualan.js',
      'pendapatan' => $this->LaporanModel->getPendapatanHariIni()->row()
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
    $header = $this->LaporanModel->getSales($invoiceNumber)->row();
    $header->tanggal_transaksi = date('Y/m/d H:i:s', strtotime($header->tanggal_transaksi));
    $line = $this->LaporanModel->getSalesDetail($invoiceNumber)->result();

    if ($line != null) {
      $output = [
        'status' => true,
        'data' => ['header' => $header, 'line' => $line]
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

  public function print_nota($id)
  {
    $data = [
      'toko' => $this->TokoModel->get($this->session->userdata('x-idm-store'))->row(),
      'header' => $this->LaporanModel->getSales($id)->row(),
      'lines' => $this->LaporanModel->getSalesDetail($id)->result()
    ];

    $mpdf = new Mpdf;
    $view = $this->load->view('laporan/penjualan/print_invoice', $data, TRUE);
    $mpdf->WriteHTML($view);
    $mpdf->Output();
  }

  public function pendapatan()
  {
    IsAdmin();

    $data = [
      'title' => 'Pendapatan per Periode',
      'javascript' => 'laporan_pendapatan.js'
    ];

    $this->template->load('layout/template', 'laporan/pendapatan/laporan_pendapatan', $data);
  }

  public function pendapatan_perbulan_ajax()
  {
    $pendapatan_perbulan = $this->LaporanModel->pendapatan_perbulan()->result();

    foreach ($pendapatan_perbulan as $key => $value) {
      $value->pendapatan = intval($value->pendapatan);
    }

    $output = [
      'data' => $pendapatan_perbulan,
      'status' => true
    ];

    if ($pendapatan_perbulan == null) {
      $output['data'] = null;
      $output['status'] = false;
    }

    header('Content-Type: application/json');
    echo json_encode($output);
  }

  public function pendapatan_perhari_ajax()
  {
    $pendapatan_perhari = $this->LaporanModel->pendapatan_perhari()->result();

    foreach ($pendapatan_perhari as $key => $value) {
      $value->pendapatan = intval($value->pendapatan);
    }

    $output = [
      'data' => $pendapatan_perhari,
      'status' => true
    ];

    if ($pendapatan_perhari == null) {
      $output['data'] = null;
      $output['status'] = false;
    }

    header('Content-Type: application/json');
    echo json_encode($output);
  }

  public function laporan_shift()
  {
    $data = [
      'title' => 'Laporan Shift',
      'javascript' => null,
      'data' => $this->LaporanModel->getTutupShift(null, $this->session->userdata('x-idm-store'))->result()
    ];

    $this->template->load('layout/template', 'laporan/shift/index', $data);
  }

  public function laporan_harian()
  {
    $data = [
      'title' => 'Laporan Harian',
      'javascript' => null,
      'data' => $this->LaporanModel->getTutupHarian(null, $this->session->userdata('x-idm-store'))->result()
    ];

    $this->template->load('layout/template', 'laporan/harian/index', $data);
  }

  public function proses_barang($suratJalan)
  {
    $data = [
      'toko' => $this->TokoModel->get($this->session->userdata('x-idm-store'))->row(),
      'header' => $this->InventoryModel->getHeaderProsesBarang($suratJalan, $this->session->userdata('x-idm-store'))->row(),
      'lines' => $this->InventoryModel->getLineProsesBarang($suratJalan)->result()
    ];

    // var_dump($data);
    // die;

    $mpdf = new Mpdf;
    $view = $this->load->view('laporan/proses_barang/print', $data, TRUE);
    $mpdf->WriteHTML($view);
    $mpdf->Output();
  }

  public function retur_barang($kodeRetur)
  {
    $data = [
      'toko' => $this->TokoModel->get($this->session->userdata('x-idm-store'))->row(),
      'header' => $this->InventoryModel->getData($kodeRetur)->row(),
      'lines' => $this->InventoryModel->getLineRetur($kodeRetur)->result()
    ];

    $mpdf = new Mpdf;
    $view = $this->load->view('laporan/retur/print', $data, TRUE);
    $mpdf->WriteHTML($view);
    $mpdf->Output();
  }
}
