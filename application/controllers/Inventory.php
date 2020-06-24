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
  }

  public function proses_barang()
  {
    UserOnly();

    $data = [
      'title' => 'Proses Barang',
      'sub_title' => '',
      'javascript'  => 'proses_barang.js',
      'barang'  => $this->InventoryModel->getItems()->result()
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
    $data = [
      'title' => 'Retur Barang',
      'sub_title' => null,
      'javascript' => 'retur_barang.js',
      'data' => $this->InventoryModel->getData()->result(),
      'supplier' => $this->SupplierModel->get()->result()
    ];

    $this->form_validation->set_rules('supplier', 'Supplier', 'required');

    if ($this->form_validation->run() == true) {
      $this->returBarang();
    }

    $this->template->load('layout/template', 'inventory/data_retur_barang', $data);
  }

  private function returBarang()
  {
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
      'items' => $this->StockModel->get(null, $this->InventoryModel->getLineRetur($kodeRetur)->result())->result()
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
      'jumlah' => $this->input->post('jumlah')
    ];

    $this->InventoryModel->createLine($data);
    redirect('inventory/form-retur/' . $kodeRetur);
  }

  public function hapus_item_retur($id = null, $kodeRetur = null)
  {
    $this->InventoryModel->deleteLine($id);
    redirect('inventory/form-retur/' . $kodeRetur);
  }

  public function proses_retur($kodeRetur = null)
  {
    $idRetur = $this->InventoryModel->getData($kodeRetur)->row()->id;
    $this->InventoryModel->prosesRetur($idRetur);
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
    $data = [
      'title' => 'Konversi',
      'javascript' => 'konversi.js',
      'data' => $this->InventoryModel->getKonversi()->result(),
      'stock' => $this->StockModel->get()->result()
    ];

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
    redirect('inventory/konversi');
  }
}
