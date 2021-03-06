<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    IsAuthenticate();
    $this->load->helper('kasir');
    $this->load->model('InventoryModel');
    $this->load->model('InitialModel');
    $this->load->model('StockModel');
    $this->load->model('BaristaModel');
    $this->load->model('SupplierModel');
    $this->load->library('form_validation');
    $this->load->helper('inventory');
    $this->load->helper('initial');
  }

  public function proses_barang()
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
      'barang'  => $this->InventoryModel->getItems(null, null, $dataFilter, [32, 34])->result()
    ];

    $this->template->load('layout/template', 'inventory/proses_barang', $data);
  }

  public function proses_barang_masuk($requestNumber = null)
  {
    $data = [
      'title' => 'Proses Barang Masuk',
      'sub_title' => '',
      'javascript'  => 'proses_barang_masuk.js',
      'header' => $this->InventoryModel->getSingle($requestNumber)->row(),
      'itemToCompare' => null,
      'lineItems' => null
    ];

    if ($data['header']->surat_jalan != null) {
      $data['lineItems'] = $this->InventoryModel->getLineItems($data['header']->surat_jalan)->result();
      $data['itemToCompare'] = $this->StockModel->GetDataLinePermintaan($requestNumber, $data['lineItems'])->result();
    }

    $this->template->load('layout/template', 'inventory/proses_barang_masuk', $data);
  }

  public function selesaikan_proses($suratJalan = null)
  {
    $this->InventoryModel->sendTempData();
    $this->InventoryModel->updateStock($suratJalan);
    $this->InventoryModel->resetTempData();
    $this->InventoryModel->selesaiProses($suratJalan);

    $this->session->set_flashdata('pesanGlobal', 'Stock telah berhasil diterima.');
    $this->session->set_flashdata('typePesanGlobal', 'success');
    redirect('inventory/proses-barang');
  }

  public function get_items_ajax($requestNumber = null)
  {
    $data = $this->StockModel->GetDataLinePermintaan($requestNumber)->result();

    header('Content-Type: application/json');
    echo json_encode(['status' => true, 'data' => $data]);
  }

  public function submit_item($requestNumber = null)
  {
    $id = $this->input->post('productcode');
    $suratJalan = $this->input->post('suratJalan');
    $this->InventoryModel->submitItem($id, $suratJalan);

    $this->session->set_flashdata('pesanGlobal', 'Item ditambahkan dalam antrean untuk diproses.');
    $this->session->set_flashdata('typePesanGlobal', 'success');
    redirect('inventory/proses-barang-masuk/' . $requestNumber);
  }

  public function get_items_json($requestNumber = null)
  {
    $search         = $_POST['search']['value'];
    $length         = $_POST['length'];
    $start          = $_POST['start'];
    $sortColumnName = $_POST['columns']['' . $_POST['order']['0']['column'] . '']['name'];
    $sortDir        = $_POST['order']['0']['dir'];

    $draw = $_POST['draw'];
    $recordsFiltered = $this->InventoryModel->getRecordsFiltered($search, $requestNumber)->num_rows();
    $recordsTotal = $this->InventoryModel->getDataItems(null, $requestNumber)->num_rows();
    $data = $this->InventoryModel->getDatatables($search, $length, $start, $sortColumnName, $sortDir, $requestNumber);

    $output = ['draw' => $draw, 'recordsFiltered' => $recordsFiltered, 'recordsTotal' => $recordsTotal, 'data' => $data];

    header('Content-Type: application/json');
    echo json_encode($output);
  }

  public function proses()
  {
    $data = [
      'id' => $this->input->post('id'),
      'surat_jalan' => $this->input->post('surat_jalan'),
      'status' => 34,
      'tanggal_terima' => date('Y-m-d H:i:s', time()),
    ];

    $result = $this->InventoryModel->prosesData($data);

    header('Content-Type: application/json');

    if ($result == true) {
      echo json_encode(['status' => true, 'data' => $data]);
    } else {
      echo json_encode(['status' => false, 'data' => null]);
    }
  }

  public function data_retur_barang()
  {
    $dataFilter = null;
    $dataPostSupplier = $this->input->post('supplier');

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
      'title' => 'Retur Barang',
      'sub_title' => null,
      'javascript' => 'retur_barang.js',
      'data' => $this->InventoryModel->getData(null, $dataFilter)->result(),
      'supplier' => $this->SupplierModel->get()->result()
    ];

    if ($dataPostSupplier != null) {
      $this->returBarang();
    }

    $this->template->load('layout/template', 'inventory/data_retur_barang', $data);
  }

  private function returBarang()
  {
    CheckDataInitial();

    $data = [
      'id' => null,
      'kode_retur' => returCode(returSequence()),
      'tanggal_retur' => date('Y-m-d H:i:s', time()),
      'supplier_id' => $this->input->post('supplier'),
      'jumlah_item' => null,
      'dibuat_oleh' => $this->BaristaModel->GetBaristaByNik($this->InitialModel->CheckInitialStatus()->nik)->row()->nama,
      'idtoko' => $this->session->userdata('x-idm-store')
    ];

    $this->InventoryModel->createRetur($data);
    redirect('inventory/form-retur/' . $data['kode_retur']);
  }

  public function form_retur($kodeRetur = null)
  {
    $data = [
      'title' => 'Form Retur Barang',
      'sub_title' => null,
      'javascript' => 'form_retur.js',
      'header' => $this->InventoryModel->getData($kodeRetur)->row(),
      'lines' => $this->InventoryModel->getLineRetur($kodeRetur)->result(),
      'items' => $this->StockModel->get(null, $this->InventoryModel->getLineRetur($kodeRetur)->result(), null, $this->session->userdata('x-idm-store'))->result()
    ];

    $this->template->load('layout/template', 'inventory/form_retur_barang', $data);
  }

  public function tambah_item_retur($kodeRetur = null)
  {
    $dataHeader = $this->InventoryModel->getData($kodeRetur)->row();
    $item = $this->StockModel->get(null, null, $this->input->post('productcode'))->row();

    $itemCheck = $item->jumlah - $this->input->post('jumlah');

    if ($itemCheck < 0) {
      $this->session->set_flashdata('pesanGlobal', 'Jumlah yang anda masukkan melebihi batas.');
      $this->session->set_flashdata('typePesanGlobal', 'error');
      redirect('inventory/form-retur/' . $kodeRetur);
    }

    $data = [
      'id' => null,
      'retur_id' => $dataHeader->id,
      'prdcd' => $this->input->post('productcode'),
      'jumlah' => $this->input->post('jumlah'),
      'keterangan' => $this->input->post('keterangan')
    ];

    $this->InventoryModel->createLine($data);
    $this->session->set_flashdata('pesanGlobal', 'Item ditambah.');
    $this->session->set_flashdata('typePesanGlobal', 'success');
    redirect('inventory/form-retur/' . $kodeRetur);
  }

  public function hapus_item_retur($id = null, $kodeRetur = null)
  {
    $this->InventoryModel->deleteLine($id);
    $this->session->set_flashdata('pesanGlobal', 'Item dihapus.');
    $this->session->set_flashdata('typePesanGlobal', 'success');
    redirect('inventory/form-retur/' . $kodeRetur);
  }

  public function proses_retur($kodeRetur = null)
  {
    $idRetur = $this->InventoryModel->getData($kodeRetur)->row()->id;
    $this->InventoryModel->prosesRetur($idRetur);
    $this->session->set_flashdata('pesanGlobal', 'Retur telah berhasil di proses.');
    $this->session->set_flashdata('typePesanGlobal', 'success');
    redirect('inventory/data-retur-barang');
  }

  public function data_retur_json($kodeRetur = null)
  {
    $search         = $_POST['search']['value'];
    $length         = $_POST['length'];
    $start          = $_POST['start'];
    $sortColumnName = $_POST['columns']['' . $_POST['order']['0']['column'] . '']['name'];
    $sortDir        = $_POST['order']['0']['dir'];

    $draw = $_POST['draw'];
    $recordsFiltered = $this->InventoryModel->getRecordsFilteredRetur($search, $kodeRetur)->num_rows();
    $recordsTotal = $this->InventoryModel->getLineRetur($kodeRetur)->num_rows();
    $data = $this->InventoryModel->getDatatablesRetur($search, $length, $start, $sortColumnName, $sortDir, $kodeRetur);

    $output = ['draw' => $draw, 'recordsFiltered' => $recordsFiltered, 'recordsTotal' => $recordsTotal, 'data' => $data];

    header('Content-Type: application/json');
    echo json_encode($output);
  }

  // Konversi

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
      'stock' => $this->StockModel->get(null, null, null, $this->session->userdata('x-idm-store'))->result()
    ];

    if ($this->input->post('filter_day') != null) {
      $data['filter_day'] = $this->input->post('filter_day');
    }

    if ($data['current_period'] == NULL) {
      $data['current_period'] = new stdClass;
      $data['current_period']->bulan = date('F', time());
    }

    $this->form_validation->set_rules('prdcd', 'Product Code', 'required');
    $this->form_validation->set_rules('jumlah', 'Jumlah Product', 'required');

    if ($this->form_validation->run() == true) {
      $this->prosesKonversi();
    }

    $this->template->load('layout/template', 'inventory/konversi', $data);
  }

  public function prosesKonversi()
  {
    $data = [
      'id' => null,
      'prdcd' => $this->input->post('prdcd'),
      'jumlah' => $this->input->post('jumlah'),
      'tanggal_konversi' => date('Y-m-d H:i:s', time()),
      'konversi_oleh' => $this->BaristaModel->GetBaristaByNik($this->InitialModel->CheckInitialStatus()->nik)->row()->nama,
      'idtoko' => $this->session->userdata('x-idm-store')
    ];

    $stock = $this->StockModel->get(null, null, $data['prdcd'])->row()->jumlah;

    if ($stock - $data['jumlah'] < 0) {
      $this->session->set_flashdata('pesanGlobal', 'Jumlah yang anda masukkan melebihi batas.');
      $this->session->set_flashdata('typePesanGlobal', 'error');
      redirect('inventory/konversi');
    }

    $this->InventoryModel->createKonversi($data);
    $this->InventoryModel->minusKonversi($data);
    $this->session->set_flashdata('pesanGlobal', 'Item berhasil dikonversi.');
    $this->session->set_flashdata('typePesanGlobal', 'success');
    redirect('inventory/konversi');
  }
}
