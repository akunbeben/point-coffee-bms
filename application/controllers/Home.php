<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

    public function __construct(){
        parent::__construct();
        IsAuthenticate();
    }

    public function index()
    { 
        $data = [ 
            'title' => 'Home',
            'javascript' => null
        ];
        $this->template->load('layout/template', 'home/index', $data);
    }
}
