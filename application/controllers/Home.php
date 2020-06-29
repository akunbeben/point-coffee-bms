<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        IsAuthenticate();
        $this->load->model('LaporanModel');
        $this->load->helper('kasir');
    }

    public function index()
    {
        $data = [
            'title' => 'Home',
            'javascript' => null,
            'pendapatan' => $this->LaporanModel->getPendapatanToko()->result()
        ];

        // var_dump($data);
        // die;
        $this->template->load('layout/template', 'home/index', $data);
    }
}
