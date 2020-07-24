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
    $this->load->model('BaristaModel');
    $this->load->model('InitialModel');
    $this->load->model('SupplierModel');
    $this->load->model('StockModel');
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

    $tanggalAwal = date('Y-m-01 00:00:00', time());
    $tanggalAkhir = date('Y-m-d H:i:s', time());


    $dataFilter = [
      'tanggal_awal' => $tanggalAwal,
      'tanggal_akhir' => $tanggalAkhir,
      'filter_toko' => null
    ];

    $data = [
      'title' => 'Pendapatan per Periode',
      'javascript' => 'laporan_pendapatan.js',
      'periode' => $dataFilter
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

  public function print_data_konversi()
  {
    $dataFilter = [
      'tanggal_awal' => $this->input->post('tanggal_awal'),
      'tanggal_akhir' => $this->input->post('tanggal_akhir')
    ];

    $data = [
      'toko' => $this->TokoModel->get($this->session->userdata('x-idm-store'))->row(),
      'lines' => $this->InventoryModel->getKonversi(null, $dataFilter)->result(),
      'barista' => $this->BaristaModel->GetBaristaByNik($this->InitialModel->CheckInitialStatus()->nik)->row()
    ];

    $mpdf = new Mpdf;
    $view = $this->load->view('laporan/konversi/print', $data, TRUE);
    $mpdf->WriteHTML($view);
    $mpdf->Output();
  }

  public function print_data_retur()
  {
    $dataFilter = [
      'tanggal_awal' => $this->input->post('tanggal_awal'),
      'tanggal_akhir' => $this->input->post('tanggal_akhir')
    ];

    $data = [
      'toko' => $this->TokoModel->get($this->session->userdata('x-idm-store'))->row(),
      'lines' => $this->InventoryModel->getData(null, $dataFilter)->result(),
      'periode' => $dataFilter,
      'barista' => $this->BaristaModel->GetBaristaByNik($this->InitialModel->CheckInitialStatus()->nik)->row()
    ];

    $mpdf = new Mpdf;
    $view = $this->load->view('laporan/retur/print_data', $data, TRUE);
    $mpdf->WriteHTML($view);
    $mpdf->Output();
  }

  public function data_proses_barang()
  {
    UserOnly();
    $dataFilter = null;

    $tanggalAwal = $this->input->post('tanggal_awal');
    $tanggalAkhir = $this->input->post('tanggal_akhir');

    if ($tanggalAwal != null) {
      $dataFilter['tanggal_awal'] = $tanggalAwal;
      $dataFilter['tanggal_akhir'] = date('Y-m-d H:i:s', time());
    }

    if ($tanggalAwal != null && $tanggalAkhir != null) {
      $dataFilter['tanggal_awal'] = $tanggalAwal;
      $dataFilter['tanggal_akhir'] = $tanggalAkhir;
    }

    $data = [
      'title' => 'Proses Barang',
      'sub_title' => '',
      'javascript'  => 'proses_barang.js',
      'barang'  => $this->InventoryModel->getItems(null, null, $dataFilter, [35])->result()
    ];

    $this->template->load('layout/template', 'laporan/proses_barang/index', $data);
  }

  public function data_retur_barang()
  {
    $tanggalAwal = $this->input->post('tanggal_awal') == null ? date('Y-m-01 00:00:00', time()) : $this->input->post('tanggal_awal');
    $tanggalAkhir = $this->input->post('tanggal_akhir') == null ? date('Y-m-t H:i:s', time()) : $this->input->post('tanggal_akhir');

    $dataFilter = [
      'tanggal_awal' => $tanggalAwal,
      'tanggal_akhir' => $tanggalAkhir
    ];

    if ($tanggalAwal != null) {
      $dataFilter['tanggal_awal'] = $tanggalAwal;
      $dataFilter['tanggal_akhir'] = date('Y-m-d H:i:s', time());
    }

    if ($tanggalAwal != null && $tanggalAkhir != null) {
      $dataFilter['tanggal_awal'] = $tanggalAwal;
      $dataFilter['tanggal_akhir'] = $tanggalAkhir;
    }

    $data = [
      'title' => 'Retur Barang',
      'sub_title' => null,
      'javascript' => 'retur_barang.js',
      'data' => $this->InventoryModel->getData(null, $dataFilter)->result(),
      'supplier' => $this->SupplierModel->get()->result(),
      'periode' => $dataFilter
    ];

    $this->template->load('layout/template', 'laporan/retur/index', $data);
  }

  public function konversi()
  {
    $dataFilter = [
      'tanggal_awal' => date('Y-m-01', time()),
      'tanggal_akhir' => date('Y-m-d', time())
    ];

    $filterBulan = $this->input->post('filter_month') == null ? date('Y-m-d', time()) : $this->input->post('filter_month');

    if ($filterBulan != null) {
      $dataFilter['tanggal_awal'] = date('Y-m-01', strtotime($filterBulan . ' 00:00:00'));
      $dataFilter['tanggal_akhir'] = date('Y-m-d', time());
    }

    if (date('m', strtotime($dataFilter['tanggal_awal'])) != date('m', time())) {
      $dataFilter['tanggal_akhir'] = date('Y-m-t', strtotime($filterBulan));
    }

    if ($this->input->post('filter_day') != null) {
      $dataFilter['tanggal_awal'] = date('Y-m-d', strtotime($this->input->post('filter_day') . ' 00:00:00'));
      $dataFilter['tanggal_akhir'] = date('Y-m-d', strtotime($this->input->post('filter_day') . ' 23:59:59'));
    }

    $data = [
      'title' => 'Konversi',
      'javascript' => 'konversi.js',
      'data' => $this->InventoryModel->getKonversi(null, $dataFilter)->result(),
      'data_bulan' => $this->InventoryModel->groupKonversiByMonth()->result(),
      'current_period' => $this->InventoryModel->getCurrentPeriodKonversi($filterBulan)->row(),
      'filter_data' => $dataFilter,
      'filter_day' => null,
      'filter_month' => $filterBulan,
      'stock' => $this->StockModel->get()->result()
    ];

    if ($this->input->post('filter_day') != null) {
      $data['filter_day'] = $this->input->post('filter_day');
    }

    $this->template->load('layout/template', 'laporan/konversi/index', $data);
  }

  public function pendapatan_pertoko()
  {
    IsAdmin();

    $tanggalAwal = $this->input->post('tanggal_awal') == null ? date('Y-m-01 00:00:00', time()) : $this->input->post('tanggal_awal');
    $tanggalAkhir = $this->input->post('tanggal_akhir') == null ? date('Y-m-d H:i:s', time()) : $this->input->post('tanggal_akhir');
    $filterToko = $this->input->post('filter_toko');

    $dataFilter = [
      'tanggal_awal' => $tanggalAwal,
      'tanggal_akhir' => $tanggalAkhir,
      'filter_toko' => $filterToko
    ];

    if ($tanggalAwal != null) {
      $dataFilter['tanggal_awal'] = $tanggalAwal;
      $dataFilter['tanggal_akhir'] = date('Y-m-d H:i:s', time());
    }

    if ($tanggalAwal != null && $tanggalAkhir != null) {
      $dataFilter['tanggal_awal'] = $tanggalAwal;
      $dataFilter['tanggal_akhir'] = $tanggalAkhir;
    }

    if ($filterToko != null && $tanggalAwal == date('Y-m-01 00:00:00', time()) && $tanggalAkhir == date('Y-m-d', time())) {
      $dataFilter['filter_toko'] = $filterToko;
      $dataFilter['tanggal_awal'] = null;
      $dataFilter['tanggal_akhir'] = null;
    }

    $data = [
      'title' => 'Pendapatan Pertoko',
      'javascript' => 'print_penjualan_pertoko.js',
      'filter_day' => null,
      'periode' => $dataFilter,
      'stores' => $this->LaporanModel->getTokoByData()->result(),
      'data' => $this->LaporanModel->pendapatanPertoko($dataFilter)->result()
    ];

    $this->template->load('layout/template', 'laporan/pendapatan/pendapatan_pertoko', $data);
  }

  public function print_pendapatan_pertoko()
  {
    $dataFilter = [
      'tanggal_awal' => $this->input->post('filter_awal'),
      'tanggal_akhir' => $this->input->post('filter_akhir'),
      'filter_toko' => $this->input->post('toko'),
    ];

    $data = [
      'toko' => $this->TokoModel->get($dataFilter['filter_toko'])->row(),
      'lines' => $this->LaporanModel->pendapatanPertoko($dataFilter)->result(),
      'periode' => $dataFilter,
      'barista' => $this->BaristaModel->GetBaristaByNik($this->InitialModel->CheckInitialStatus()->nik)->row()
    ];

    $mpdf = new Mpdf;
    $view = $this->load->view('laporan/pendapatan/print_pendapatan_pertoko', $data, TRUE);
    $mpdf->WriteHTML($view);
    $mpdf->Output();
  }

  public function pengeluaran_pertoko()
  {
    IsAdmin();

    $tanggalAwal = $this->input->post('tanggal_awal') == null ? date('Y-m-01 00:00:00', time()) : $this->input->post('tanggal_awal');
    $tanggalAkhir = $this->input->post('tanggal_akhir') == null ? date('Y-m-d H:i:s', time()) : $this->input->post('tanggal_akhir');
    $filterToko = $this->input->post('filter_toko');
    $filterSupplier = $this->input->post('filter_supplier');

    $dataFilter = [
      'tanggal_awal' => $tanggalAwal,
      'tanggal_akhir' => $tanggalAkhir,
      'filter_toko' => $filterToko,
      'filter_supplier' => $filterSupplier
    ];

    if ($tanggalAwal != null) {
      $dataFilter['tanggal_awal'] = $tanggalAwal;
      $dataFilter['tanggal_akhir'] = date('Y-m-d H:i:s', time());
    }

    if ($tanggalAwal != null && $tanggalAkhir != null) {
      $dataFilter['tanggal_awal'] = $tanggalAwal;
      $dataFilter['tanggal_akhir'] = $tanggalAkhir;
    }

    if ($filterToko != null && $tanggalAwal == date('Y-m-01 00:00:00', time()) && $tanggalAkhir == date('Y-m-d', time()) && $filterSupplier != null) {
      $dataFilter['filter_toko'] = $filterToko;
      $dataFilter['filter_supplier'] = $filterSupplier;
      $dataFilter['tanggal_awal'] = null;
      $dataFilter['tanggal_akhir'] = null;
    }

    $data = [
      'title' => 'Pengeluaran Pertoko',
      'javascript' => 'pengeluaran_pertoko.js',
      'stores' => $this->LaporanModel->getPengeluaranTokoByData()->result(),
      'suppliers' => $this->LaporanModel->getPengeluaranTokoBySupplier()->result(),
      'periode' => $dataFilter,
      'data' => $this->LaporanModel->getDataPengeluaran($dataFilter)->result()
    ];

    $this->template->load('layout/template', 'laporan/pengeluaran/index', $data);
  }

  public function print_pengeluaran_pertoko()
  {
    $dataFilter = [
      'tanggal_awal' => $this->input->post('filter_awal'),
      'tanggal_akhir' => $this->input->post('filter_akhir'),
      'filter_toko' => $this->input->post('toko'),
      'filter_supplier' => $this->input->post('supplier'),
    ];

    $data = [
      'toko' => $this->TokoModel->get($dataFilter['filter_toko'])->row(),
      'lines' => $this->LaporanModel->getDataPengeluaran($dataFilter, true)->result(),
      'periode' => $dataFilter,
      'barista' => $this->BaristaModel->GetBaristaByNik($this->InitialModel->CheckInitialStatus()->nik)->row()
    ];

    $mpdf = new Mpdf;
    $view = $this->load->view('laporan/pengeluaran/print_pengeluaran_pertoko', $data, TRUE);
    $mpdf->WriteHTML($view);
    $mpdf->Output();
  }

  public function pengeluaran()
  {
    IsAdmin();

    $tanggalAwal = date('Y-m-01 00:00:00', time());
    $tanggalAkhir = date('Y-m-d H:i:s', time());


    $dataFilter = [
      'tanggal_awal' => $tanggalAwal,
      'tanggal_akhir' => $tanggalAkhir,
      'filter_toko' => null
    ];

    $data = [
      'title' => 'Pengeluaran per Periode',
      'javascript' => 'laporan_pengeluaran.js',
      'periode' => $dataFilter
    ];

    $this->template->load('layout/template', 'laporan/pengeluaran/laporan_pengeluaran', $data);
  }

  public function pengeluaran_perbulan_ajax()
  {
    $pengeluaran_perbulan = $this->LaporanModel->pengeluaran_perbulan()->result();

    foreach ($pengeluaran_perbulan as $key => $value) {
      $value->pengeluaran = intval($value->pengeluaran);
    }

    $output = [
      'data' => $pengeluaran_perbulan,
      'status' => true
    ];

    if ($pengeluaran_perbulan == null) {
      $output['data'] = null;
      $output['status'] = false;
    }

    header('Content-Type: application/json');
    echo json_encode($output);
  }

  public function print_pengeluaran_overall()
  {
    $dataFilter = [
      'tanggal_awal' => $this->input->post('filter_awal'),
      'tanggal_akhir' => $this->input->post('filter_akhir'),
      'filter_toko' => $this->input->post('toko'),
      'filter_supplier' => $this->input->post('supplier'),
    ];

    $data = [
      'toko' => $this->TokoModel->get($dataFilter['filter_toko'])->row(),
      'lines' => $this->LaporanModel->getDataPengeluaranGrouped($dataFilter, true)->result(),
      'periode' => $dataFilter,
      'barista' => $this->BaristaModel->GetBaristaByNik($this->InitialModel->CheckInitialStatus()->nik)->row()
    ];

    $mpdf = new Mpdf;
    $view = $this->load->view('laporan/pengeluaran/print_pengeluaran_overall', $data, TRUE);
    $mpdf->WriteHTML($view);
    $mpdf->Output();
  }

  public function product_terlaris()
  {
    IsAdmin();

    $tanggalAwal = date('Y-m-01 00:00:00', time());
    $tanggalAkhir = date('Y-m-d H:i:s', time());


    $dataFilter = [
      'tanggal_awal' => $tanggalAwal,
      'tanggal_akhir' => $tanggalAkhir,
      'filter_toko' => null
    ];

    $data = [
      'title' => 'Product Terlaris',
      'javascript' => 'product_terlaris.js',
      'periode' => $dataFilter
    ];

    $this->template->load('layout/template', 'laporan/product/product_terlaris', $data);
  }

  public function product_terlaris_ajax()
  {
    $tanggalAwal = date('Y-m-01 00:00:00', time());
    $tanggalAkhir = date('Y-m-d H:i:s', time());


    $dataFilter = [
      'tanggal_awal' => $tanggalAwal,
      'tanggal_akhir' => $tanggalAkhir,
      'filter_toko' => null
    ];

    $product_perbulan = $this->LaporanModel->getProductTerlaris($dataFilter)->result();

    foreach ($product_perbulan as $key => $value) {
      $value->jumlah_terjual = intval($value->jumlah_terjual);
    }

    $output = [
      'data' => $product_perbulan,
      'status' => true
    ];

    if ($product_perbulan == null) {
      $output['data'] = null;
      $output['status'] = false;
    }

    header('Content-Type: application/json');
    echo json_encode($output);
  }

  public function print_product_terlaris()
  {
    $dataFilter = [
      'tanggal_awal' => $this->input->post('filter_awal'),
      'tanggal_akhir' => $this->input->post('filter_akhir')
    ];

    $data = [
      'toko' => null,
      'lines' => $this->LaporanModel->getProductTerlaris($dataFilter)->result(),
      'periode' => $dataFilter,
      'barista' => $this->BaristaModel->GetBaristaByNik($this->InitialModel->CheckInitialStatus()->nik)->row()
    ];

    $mpdf = new Mpdf;
    $view = $this->load->view('laporan/product/print_product_terlaris', $data, TRUE);
    $mpdf->WriteHTML($view);
    $mpdf->Output();
  }

  public function laporan_profit()
  {
    IsAdmin();

    $tanggalAwal = $this->input->post('tanggal_awal') == null ? date('Y-m-01 00:00:00', time()) : $this->input->post('tanggal_awal');
    $tanggalAkhir = $this->input->post('tanggal_akhir') == null ? date('Y-m-d H:i:s', time()) : $this->input->post('tanggal_akhir');
    $filterToko = $this->input->post('filter_toko');

    $dataFilter = [
      'tanggal_awal' => $tanggalAwal,
      'tanggal_akhir' => $tanggalAkhir,
      'filter_toko' => $filterToko
    ];

    if ($tanggalAwal != null) {
      $dataFilter['tanggal_awal'] = $tanggalAwal;
      $dataFilter['tanggal_akhir'] = date('Y-m-d H:i:s', time());
    }

    if ($tanggalAwal != null && $tanggalAkhir != null) {
      $dataFilter['tanggal_awal'] = $tanggalAwal;
      $dataFilter['tanggal_akhir'] = $tanggalAkhir;
    }

    if ($filterToko != null && $tanggalAwal == date('Y-m-01 00:00:00', time()) && $tanggalAkhir == date('Y-m-d', time())) {
      $dataFilter['filter_toko'] = $filterToko;
      $dataFilter['tanggal_awal'] = $tanggalAwal;
      $dataFilter['tanggal_akhir'] = $tanggalAkhir;
    }

    $data = [
      'title' => 'Laporan Profit',
      'javascript' => 'laporan_profit.js',
      'periode' => $dataFilter,
      'data' => $this->LaporanModel->getProfit($dataFilter)->result(),
      'stores' => $this->TokoModel->get()->result()
    ];

    $this->template->load('layout/template', 'laporan/profit/laporan_profit', $data);
  }

  public function print_data_profit()
  {
    $dataFilter = [
      'tanggal_awal' => $this->input->post('filter_awal'),
      'tanggal_akhir' => $this->input->post('filter_akhir'),
      'filter_toko' => $this->input->post('toko')
    ];

    $data = [
      'toko' => null,
      'lines' => $this->LaporanModel->getProfit($dataFilter)->result(),
      'periode' => $dataFilter,
    ];

    $mpdf = new Mpdf;
    $view = $this->load->view('laporan/profit/print_data_profit', $data, TRUE);
    $mpdf->WriteHTML($view);
    $mpdf->Output();
  }

  public function get_all_customers()
  {
    $data = $this->TokoModel->getGroupedCustomer()->result();

    $output = [
      'data' => $data,
      'status' => true
    ];

    header('Content-Type: application/json');
    echo json_encode($output);
  }
}
