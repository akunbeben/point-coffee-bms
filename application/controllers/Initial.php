<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Initial extends CI_Controller
{
    
    public function __construct() {
        parent::__construct();
        IsAuthenticate();
        $this->load->model('InitialModel');
        $this->load->model('BaristaModel');
        $this->load->library('form_validation');
        $this->load->helper('initial');
    }

    public function index()
    {
        $data = [
            'title'             => 'Initial',
            'sub_title'         => '',
            'javascript'        => 'initial.js',
            'currentInitial'    => $this->InitialModel->CheckInitialStatus(),
            'currentBarista'    => $this->BaristaModel->GetBaristaByNik($this->InitialModel->CheckInitialStatus()->nik)->row(),
            'barista'           => $this->BaristaModel->GetBaristaByStore($this->session->userdata('x-idm-store'))->result()
        ];

        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('modal', 'Modal Awal', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->create_initial();
        }
        
        $this->template->load('layout/template', 'initial/initial', $data);
    }

    public function tutup_shift()
    {
        $data = [
            'title'     => 'Tutup Shift',
            'sub_title' => '',
            'javascript' => 'tutup_shift.js'
        ];

        $this->form_validation->set_rules('pendapatan', 'Pendapatan', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->InitialModel->ResetInitialShift();
            $this->session->set_flashdata('initial', '<div class="alert alert-success" role="alert">Tutup shift berhasil!</div>');
            redirect(base_url('initial'));
        }

        $this->template->load('layout/template', 'initial/tutup_shift', $data);
    }

    private function create_initial()
    {
        $defaultShift = 1;
        $dataInitial = [
            'id' => null,
            'nik' => $this->input->post('nik'),
            'lastinitialdate' => date('Y-m-d H:i:s', time()),
            'modal' => $this->input->post('modal'),
            'shift' => $defaultShift
        ];

        if ($this->InitialModel->CheckInitialStatus()->shift > 0) {
            $this->session->set_flashdata('initial', '<div class="alert alert-danger" role="alert">Silahkan tutup shift terlebih dahulu!</div>');
            redirect(base_url('initial'));
        }

        $countDataInitial = $this->InitialModel->GetInitialByDate()->num_rows();

        if ($countDataInitial == 3) {
            $this->session->set_flashdata('initial', '<div class="alert alert-danger" role="alert">Akses initial ditutup!</div>');
            redirect(base_url('initial'));
        }

        if ($countDataInitial > 0) {
            $getShift = CountDataInitial($countDataInitial, $defaultShift);
            $dataInitial['shift'] = $getShift;
            $this->InitialModel->UpdateInitialData($dataInitial);
            $this->InitialModel->InsertInitialLog($dataInitial);

            $this->session->set_flashdata('initial', '<div class="alert alert-success" role="alert">Initial berhasil!</div>');
            redirect(base_url('initial'));
        }
        
        $this->GenerateInitial($dataInitial);
        $this->session->set_flashdata('initial', '<div class="alert alert-success" role="alert">Initial berhasil!</div>');
        redirect(base_url('initial'));
    }

    private function GenerateInitial($data)
    {
        $this->InitialModel->UpdateInitialData($data);
        $this->InitialModel->InsertInitialLog($data);
    }
}
