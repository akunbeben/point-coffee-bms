<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        IsAuthenticate();
    }

    public function permintaan()
    {
        $data = [
            'title'         => 'Permintaan Barang',
            'sub_title'     => '',
            'javascript'    => null
        ];

        $this->template->load('layout/template', 'barang/permintaan', $data);
    }
}