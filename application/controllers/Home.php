<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        IsAuthenticate();
        $this->load->model('TokoModel');
        $this->load->model('LaporanModel');
        $this->load->helper('kasir');
    }

    public function index()
    {
        $data = [
            'title' => 'Home',
            'javascript' => null,
            'jumlah_toko' => count($this->TokoModel->get()->result()),
        ];

        if ($this->session->userdata('x-idm-store') == 1) {
            $data['javascript'] = 'home.js';
        }

        $this->template->load('layout/template', 'home/index', $data);
    }
}
