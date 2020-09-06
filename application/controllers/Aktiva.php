<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aktiva extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        IsAuthenticate();
        $this->load->model('AktivaModel');
        $this->load->model('LookupvalueModel');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = [
            'title'     => 'Aktiva',
            'sub_title' => 'Daftar Aktiva',
            'javascript' => null,
            'aktiva'    => $this->AktivaModel->get()->result()
        ];
        $this->template->load('layout/template', 'aktiva/index', $data);
    }

    public function add()
    {
        $data = [
            'title'     => 'Aktiva',
            'sub_title' => 'Tambah Aktiva',
            'javascript' => null,
            'category'  => $this->LookupvalueModel->getlookupvalue(1004)->result(),
            'subcategory'  => $this->LookupvalueModel->getlookupvalue(1005)->result()
        ];
        $this->form_validation->set_rules('aktiva_name', 'Nama Aktiva', 'required');
        $this->form_validation->set_rules('aktiva_desc', 'Desc Aktiva', 'required');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('subcategory', 'Sub Category', 'required');
        $this->form_validation->set_rules('qty', 'Qty', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('ket', 'Keterarangan', 'required');

        if ($this->form_validation->run() == FALSE) {
            // var_dump($data);
            // die;
            $this->template->load('layout/template', 'aktiva/add', $data);
        } else {
            $this->do_save();
        }
    }

    function do_save()
    {
        $aktiva = [
            'id'                    => null,
            'aktiva_name'           => $this->input->post('aktiva_name'),
            'aktiva_desc'           => $this->input->post('aktiva_desc'),
            'category'              => $this->input->post('category'),
            'subcategory'           => $this->input->post('subcategory'),
            'qty'                   => $this->input->post('qty'),
            'harga'                 => $this->input->post('harga'),
            'ket'                   => $this->input->post('ket'),
            'idtoko'                => $this->input->post('idtoko')
        ];

        $this->AktivaModel->save($aktiva);
        redirect('aktiva');
    }

    public function edit($id = null)
    {
        $data = [
            'title'     => 'Aktiva',
            'sub_title' => 'Edit Aktiva',
            'javascript' => null,
            'aktiva'   => $this->AktivaModel->get($id)->row(),
            'category'  => $this->LookupvalueModel->getlookupvalue(1004)->result(),
            'subcategory'  => $this->LookupvalueModel->getlookupvalue(1005)->result()
        ];
        $this->form_validation->set_rules('aktiva_name', 'Nama Aktiva', 'required');
        $this->form_validation->set_rules('aktiva_desc', 'Desc Aktiva', 'required');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('subcategory', 'Sub Category', 'required');
        $this->form_validation->set_rules('qty', 'Qty', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('ket', 'keterangan', 'required');
        if ($this->form_validation->run() == FALSE) {
            if ($id == null) {
                redirect('aktiva/');
            } else {
                $this->template->load('layout/template', 'aktiva/edit', $data);
            }
        } else {
            $this->do_edit();
        }
    }

    function do_edit()
    {
        $aktiva = [
            'id'                    => $this->input->post('id'),
            'aktiva_name'           => $this->input->post('aktiva_name'),
            'aktiva_desc'           => $this->input->post('aktiva_desc'),
            'category'              => $this->input->post('category'),
            'subcategory'           => $this->input->post('subcategory'),
            'qty'                   => $this->input->post('qty'),
            'harga'                 => $this->input->post('harga'),
            'ket'                   => $this->input->post('ket'),
        ];

        $this->AktivaModel->edit($aktiva);
        redirect('aktiva/');
    }

    public function hapus($id = null)
    {
        if ($id == null) {
            redirect('aktiva/');
        } else {
            $this->AktivaModel->hapus($id);
            redirect('aktiva/');
        }
    }
}
