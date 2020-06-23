<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller{
    public function __construct(){
        parent::__construct();
        IsAuthenticate();
        $this->load->model('SupplierModel');
        $this->load->library('form_validation');
    }
    public function index() {
        $data = [
            'title'     => 'Supplier',
            'sub_title' => 'Daftar Supplier',
            'javascript' => null,
            'supplier'   => $this->SupplierModel->get()->result()
        ];
        $this->template->load('layout/template', 'supplier/index', $data);
    }
    
    public function add()
    {
        $data = [
            'title'     => 'Supplier',
            'sub_title' => 'Tambah Supplier',
            'javascript' => null
        ];
        $this->form_validation->set_rules('supco', 'Supplier Code', 'required');
        $this->form_validation->set_rules('nama_supplier', 'Nama Supplier', 'required');
        $this->form_validation->set_rules('alamat1', 'Alamat Pusat', 'required');
        $this->form_validation->set_rules('alamat2', 'Alamat Cabang', 'required');
        $this->form_validation->set_rules('telp1', 'Telp Pusat', 'required');
        $this->form_validation->set_rules('telp2', 'Telp Cabang', 'required'); 
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('layout/template', 'supplier/add', $data);
        } else {
            $this->do_save();
        }
    }

    function do_save()
    {
        $supplier = [
            'id'                   => null,
            'supco'                => $this->input->post('supco'),
            'nama_supplier'        => $this->input->post('nama_supplier'),
            'alamat1'              => $this->input->post('alamat1'),
            'alamat2'              => $this->input->post('alamat2'),
            'telp1'                => $this->input->post('telp1'),
            'telp2'                => $this->input->post('telp2'),
            'idtoko'                => $this->input->post('idtoko')
        ];

        $this->SupplierModel->save($supplier);
        redirect('supplier');
    }
    public function edit($id = null)
    {
        $data = [
            'title'     => 'Supplier',
            'sub_title' => 'Edit Supplier',
            'javascript' => null,
            'supplier'   => $this->SupplierModel->get($id)->row()
        ];
        $this->form_validation->set_rules('supco', 'Supplier Code', 'required');
        $this->form_validation->set_rules('nama_supplier', 'Nama Supplier', 'required');
        $this->form_validation->set_rules('alamat1', 'Alamat Pusat', 'required');
        $this->form_validation->set_rules('alamat2', 'Alamat Cabang', 'required');
        $this->form_validation->set_rules('telp1', 'Telp Pusat', 'required');
        $this->form_validation->set_rules('telp2', 'Telp Cabang', 'required'); 
        if ($this->form_validation->run() == FALSE) {
            if ($id == null) {
                redirect('supplier/');
            } else {
                $this->template->load('layout/template', 'supplier/edit', $data);
            }
        } else {
            $this->do_edit();
        }
    }

    function do_edit()
    {
        $supplier = [
            'id'                   => $this->input->post('id'),
            'supco'                => $this->input->post('supco'),
            'nama_supplier'        => $this->input->post('nama_supplier'),
            'alamat1'              => $this->input->post('alamat1'),
            'alamat2'              => $this->input->post('alamat2'),
            'telp1'                => $this->input->post('telp1'),
            'telp2'                => $this->input->post('telp2'),
        ];
        // var_dump($supplier);
        // die;
        $this->SupplierModel->edit($supplier);
        redirect('supplier/');
    }

    public function hapus($id = null)
    {
        if ($id == null) {
            redirect('supplier/');
        } else {
            $this->SupplierModel->hapus($id);
            redirect('supplier/');
    }
        }
}
