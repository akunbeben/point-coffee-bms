<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        IsAuthenticate();
        $this->load->model('StockModel');
        $this->load->model('BaristaModel');
        $this->load->model('InitialModel');
        $this->load->model('SupplierModel');
        $this->load->model('InventoryModel');
        $this->load->model('LookupvalueModel');
        $this->load->library('form_validation');
        $this->load->helper('stock');
        $this->load->helper('initial');
        $this->load->helper('kasir');

        if ($this->session->userdata('x-idm-store') != 1) {
            CheckDataInitial();
        }
    }

    public function index()
    {
        $data = [
            'title'     => 'Stock',
            'sub_title' => 'Daftar Stock',
            'javascript' => null,
            'stock'   => $this->StockModel->get()->result()
        ];
        $this->template->load('layout/template', 'stock/index', $data);
    }

    public function add()
    {
        $data = [
            'title'     => 'Stock',
            'sub_title' => 'Tambah Stock',
            'javascript' => null,
            'kategori'  => $this->LookupvalueModel->getlookupvalue(1001)->result(),
            'satuan'    => $this->LookupvalueModel->getlookupvalue(1000)->result()
        ];

        $this->form_validation->set_rules('prdcd', 'Product Code', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('layout/template', 'stock/add', $data);
        } else {
            $this->do_save();
        }
    }

    function do_save()
    {
        $stock = [
            'id'                   => null,
            'prdcd'                => $this->input->post('prdcd'),
            'deskripsi'            => $this->input->post('deskripsi'),
            'harga'                => $this->input->post('harga'),
            'jumlah'               => $this->input->post('jumlah'),
            'kategori'             => $this->input->post('kategori'),
            'satuan'               => $this->input->post('satuan'),
            'idtoko'               => $this->input->post('idtoko')
        ];

        $this->StockModel->save($stock);
        redirect('stock');
    }

    public function edit($id = null)
    {
        $data = [
            'title'     => 'Stock',
            'sub_title' => 'Edit Stock',
            'javascript' => null,
            'stock'   => $this->StockModel->get($id)->row(),
            'kategori'  => $this->LookupvalueModel->getlookupvalue(1001)->result(),
            'satuan'    => $this->LookupvalueModel->getlookupvalue(1000)->result()
        ];
        $this->form_validation->set_rules('prdcd', 'Product Code', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        if ($this->form_validation->run() == FALSE) {
            if ($id == null) {
                redirect('stock/');
            } else {
                $this->template->load('layout/template', 'stock/edit', $data);
            }
        } else {
            $this->do_edit();
        }
    }

    function do_edit()
    {
        $stock = [
            'id'                   => $this->input->post('id'),
            'prdcd'                => $this->input->post('prdcd'),
            'deskripsi'            => $this->input->post('deskripsi'),
            'harga'                => $this->input->post('harga'),
            'jumlah'               => $this->input->post('jumlah'),
            'kategori'             => $this->input->post('kategori'),
            'satuan'               => $this->input->post('satuan'),
        ];
        // var_dump($product);
        // die;
        $this->StockModel->edit($stock);
        redirect('stock/');
    }

    public function hapus($id = null)
    {
        if ($id == null) {
            redirect('stock/');
        } else {
            $this->StockModel->hapus($id);
            redirect('stock/');
        }
    }

    public function permintaan_barang()
    {
        $data = [
            'title'         => 'Permintaan Barang',
            'sub_title'     => '',
            'javascript'    => 'permintaan_barang.js',
            'permintaan'    => $this->StockModel->GetDataPermintaan()->result()
        ];

        $this->template->load('layout/template', 'stock/permintaan_barang', $data);
    }

    public function form_permintaan_barang($requestNumber = null)
    {
        if (
            $requestNumber == null ||
            $this->session->userdata('x-idm-store') == 1 ||
            $this->StockModel->GetDataPermintaan($requestNumber, false)->row()->status > 28 ||
            $this->StockModel->GetDataPermintaan($requestNumber, false)->row()->is_deleted == 1
        ) {
            redirect('stock/permintaan-barang/');
        }

        $data = [
            'title'         => 'Form Permintaan Barang',
            'sub_title'     => '',
            'javascript'    => 'buat_permintaan_barang.js',
            'header'        => $this->StockModel->GetDataPermintaan($requestNumber)->row(),
            'line'          => $this->StockModel->GetDataLinePermintaan($requestNumber)->result(),
            'stock'         => $this->StockModel->get(null, $this->StockModel->GetDataLinePermintaan($requestNumber)->result())->result(),
            'kategori'      => $this->LookupvalueModel->getlookupvalue(1001)->result(),
            'satuan'        => $this->LookupvalueModel->getlookupvalue(1000)->result()
        ];

        $this->form_validation->set_rules('prdcd', 'Product Code', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');

        if ($this->form_validation->run() == true) {
            $this->tambahItem();
        }

        $this->template->load('layout/template', 'stock/buat_permintaan_barang', $data);
    }

    public function permintaan_barang_baru()
    {
        $data = [
            'title'         => 'Buat Permintaan Barang',
            'sub_title'     => '',
            'javascript'    => 'permintaan_barang_baru.js',
            'supplier'      => $this->SupplierModel->get()->result()
        ];

        $this->form_validation->set_rules('supplier', 'Supplier', 'required');

        if ($this->form_validation->run() == true) {
            $this->generatePermintaanBarang();
        }

        $this->template->load('layout/template', 'stock/permintaan_barang_baru', $data);
    }

    private function generatePermintaanBarang()
    {
        $data = [
            'id'                => null,
            'kodesupplier'      => $this->input->post('supplier'),
            'kodepermintaan'    => RequestForm(SequenceNumber()),
            'tanggal'           => date('Y-m-d H:i:s', time()),
            'idtoko'            => $this->session->userdata('x-idm-store'),
            'idbarista'         => $this->BaristaModel->GetBaristaByNik($this->InitialModel->CheckInitialStatus()->nik)->row()->id,
            'status'            => 28,
            'is_deleted'        => 0
        ];

        $this->StockModel->GeneratePermintaan($data);
        redirect(base_url('stock/form-permintaan-barang/') . $data['kodepermintaan']);
    }

    public function hapus_permintaan_barang($requestNumber = null)
    {
        if (
            $requestNumber == null ||
            $this->session->userdata('x-idm-store') == 1 ||
            $this->StockModel->GetDataPermintaan($requestNumber, false)->row()->status > 28 ||
            $this->StockModel->GetDataPermintaan($requestNumber, false)->row()->is_deleted == 1
        ) {
            $this->session->set_flashdata('pesanGlobal', 'Perubahan dokumen tidak dapat dilakukan.');
            $this->session->set_flashdata('typePesanGlobal', 'error');
            redirect('stock/permintaan-barang/');
        }

        $this->StockModel->HapusData($requestNumber);
        $this->session->set_flashdata('pesanGlobal', 'Data ' . $requestNumber . ' berhasil dihapus.');
        $this->session->set_flashdata('typePesanGlobal', 'success');
        redirect('stock/permintaan-barang/');
    }

    public function proses_permintaan($requestNumber = null)
    {
        if (
            $requestNumber == null ||
            $this->session->userdata('x-idm-store') == 1 ||
            $this->StockModel->GetDataPermintaan($requestNumber, false)->row()->status > 28 ||
            $this->StockModel->GetDataPermintaan($requestNumber, false)->row()->is_deleted == 1
        ) {
            $this->session->set_flashdata('pesanGlobal', 'Dokumen telah dalam tahap proses.');
            $this->session->set_flashdata('typePesanGlobal', 'error');
            redirect('stock/permintaan-barang/');
        }

        $this->StockModel->ProsesPermintaan($requestNumber);
        $this->session->set_flashdata('pesanGlobal', 'Data ' . $requestNumber . ' telah diproses.');
        $this->session->set_flashdata('typePesanGlobal', 'success');
        redirect('stock/permintaan-barang/');
    }

    public function tambahJumlahItem($productCode, $requestNumber)
    {
        $this->StockModel->tambahJumlahItem($productCode);
        redirect('stock/form-permintaan-barang/' . $requestNumber);
    }

    public function kurangiJumlahItem($productCode, $requestNumber)
    {
        $item = $this->StockModel->GetItem($productCode)->row()->jumlah;

        if ($item <= 1) {
            $this->session->set_flashdata('pesanGlobal', 'Jumlah item minimal 1.');
            $this->session->set_flashdata('typePesanGlobal', 'error');
            redirect('stock/form-permintaan-barang/' . $requestNumber);
        }

        $this->StockModel->kurangiJumlahItem($productCode);
        redirect('stock/form-permintaan-barang/' . $requestNumber);
    }

    public function hapusItem($productCode, $requestNumber)
    {
        $this->StockModel->hapusItem($productCode);
        redirect('stock/form-permintaan-barang/' . $requestNumber);
    }

    public function get_item_json($requestNumber)
    {
        $search         = $_POST['search']['value'];
        $Length         = $_POST['length'];
        $Start          = $_POST['start'];
        $SortColumnName = $_POST['columns']['' . $_POST['order']['0']['column'] . '']['name'];
        $SortDir        = $_POST['order']['0']['dir'];

        $draw = $_POST['draw'];
        $recordsFiltered = $this->StockModel->GetRecordsFiltered($search, $requestNumber)->num_rows();
        $recordsTotal = $this->StockModel->GetItemsJson($requestNumber)->num_rows();
        $data = $this->StockModel->GetDatatables($search, $Length, $Start, $SortColumnName, $SortDir, $requestNumber);

        $output = ['draw' => $draw, 'recordsFiltered' => $recordsFiltered, 'recordsTotal' => $recordsTotal, 'data' => $data];
        header('Content-Type: application/json');
        echo json_encode($output);
    }

    private function tambahItem()
    {
        $data = [
            'id'                => null,
            'kodepermintaan'    => $this->input->post('kodepermintaan'),
            'prdcd'             => $this->input->post('prdcd'),
            'harga'             => $this->input->post('harga'),
            'kategori'          => $this->input->post('kategori'),
            'satuan'            => $this->input->post('satuan'),
            'jumlah'            => $this->input->post('jumlah')
        ];

        $this->StockModel->tambahItem($data);
        redirect('stock/form-permintaan-barang/' . $data['kodepermintaan']);
    }

    public function update_item()
    {
        $data = [
            'requestNumber' => $this->input->post('kodepermintaanBaru'),
            'id'            => $this->input->post('idBaru'),
            'harga'         => $this->input->post('hargaBaru'),
            'jumlah'        => $this->input->post('jumlahBaru')
        ];

        $this->StockModel->updateItem($data);
        redirect('stock/form-permintaan-barang/' . $data['requestNumber']);
    }

    public function get_item($id)
    {
        $data = $this->StockModel->getLineItem($id)->row();
        $output = ['status' => true, 'data' => $data];

        header('Content-Type: application/json');
        echo json_encode($output);
    }

    public function approve($requestNumber)
    {
        $dataPermintaan = $this->StockModel->getGroupedData($requestNumber)->row();

        $data = [
            'supplier'          => $dataPermintaan->supco . ' - ' . $dataPermintaan->nama_supplier,
            'kodepermintaan'    => $dataPermintaan->kodepermintaan,
            'jumlah_barang'     => $dataPermintaan->totalBarang,
            'status'            => 32,
            'idtoko'            => $dataPermintaan->idtoko
        ];

        $this->session->set_flashdata('pesanGlobal', 'Data ' . $requestNumber . ' berhasil di approve.');
        $this->session->set_flashdata('typePesanGlobal', 'success');
        $this->StockModel->approve($requestNumber);
        $this->InventoryModel->generateDataProses($data);
        redirect('stock/permintaan-barang/');
    }

    public function reject($requestNumber)
    {
        $this->session->set_flashdata('pesanGlobal', 'Data ' . $requestNumber . ' berhasil di reject.');
        $this->session->set_flashdata('typePesanGlobal', 'success');
        $this->StockModel->reject($requestNumber);
        redirect('stock/permintaan-barang/');
    }
}
