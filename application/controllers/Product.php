<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller{
    public function __construct(){
        parent::__construct();
        IsAuthenticate();
        $this->load->model('ProductModel');
        $this->load->library('form_validation');
    }

    public function index() {
        $data = [
            'title'     => 'Product',
            'sub_title' => 'Daftar Product',
            'javascript' => null,
            'product'   => $this->ProductModel->get()->result()
        ];
        
        $this->template->load('layout/template', 'product/index', $data);
    }
    
    public function add()
    {
        $data = [
            'title'     => 'Product',
            'sub_title' => 'Tambah Product',
            'javascript' => null,
        ];
        $this->form_validation->set_rules('prdcd', 'Product Code', 'required');
        $this->form_validation->set_rules('singkatan', 'Abbreviation', 'required');
        $this->form_validation->set_rules('desc', 'Description', 'required');
        $this->form_validation->set_rules('unit', 'Unit', 'required');
        $this->form_validation->set_rules('size', 'Size', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('layout/template', 'product/add', $data);
        } else {
            $this->do_save();
        }
    }

    function do_save()
    {
        $product = [
            'id'                    => null,
            'prdcd'                 => $this->input->post('prdcd'),
            'singkatan'             => $this->input->post('singkatan'),
            'desc'                  => $this->input->post('desc'),
            'unit'                  => $this->input->post('unit'),
            'size'                  => $this->input->post('size'),
            'price'                 => $this->input->post('price'),
            'sellingprice'          => $this->input->post('sellingprice'),
            'idtoko'                => $this->input->post('idtoko')
        ];

        $this->ProductModel->save($product);
        redirect('product');
    }

    public function edit($id = null)
    {
        $data = [
            'title'     => 'Product',
            'sub_title' => 'Edit Product',
            'javascript' => null,
            'product'   => $this->ProductModel->get($id)->row()
        ];
        $this->form_validation->set_rules('prdcd', 'Product Code', 'required');
        $this->form_validation->set_rules('singkatan', 'Abbreviation', 'required');
        $this->form_validation->set_rules('desc', 'Description', 'required');
        $this->form_validation->set_rules('unit', 'Unit', 'required');
        $this->form_validation->set_rules('size', 'Size', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        if ($this->form_validation->run() == FALSE) {
            if ($id == null) {
                redirect('product/');
            } else {
                $this->template->load('layout/template', 'product/edit', $data);
            }
        } else {
            $this->do_edit();
        }
    }

    function do_edit()
    {
        $product = [
            'id'                    => $this->input->post('id'),
            'prdcd'                 => $this->input->post('prdcd'),
            'singkatan'             => $this->input->post('singkatan'),
            'desc'                  => $this->input->post('desc'),
            'unit'                  => $this->input->post('unit'),
            'size'                  => $this->input->post('size'),
            'price'                 => $this->input->post('price'),
            'sellingprice'          => $this->input->post('sellingprice')
        ];
        
        $this->ProductModel->edit($product);
        redirect('product/');
    }

    public function discount()
    {
        $data = [
            'title'     => 'Product',
            'sub_title' => 'Daftar Product',
            'javascript' => null
        ];

        $this->template->load('layout/template', 'product/discount_index', $data);
    }

    public function hapus($id = null)
    {
        if ($id == null) {
            redirect('product/');
        } else {
            $this->ProductModel->hapus($id);
            redirect('product/');
    }
        }
}
