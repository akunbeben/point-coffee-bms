<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentication extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AuthenticationModel');
        $this->load->model('InitialModel');
        $this->load->library('form_validation');
    }

    public function login()
    {
        $data = [
            'javascript' => null
        ];

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->DoLogin();
        }

        $this->load->view('authentication/login', $data);
    }

    private function DoLogin()
    {
        $username   = $this->input->post('username');
        $password   = $this->input->post('password');

        $getUserFromDb  = $this->AuthenticationModel->GetUser($username)->row();

        if ($getUserFromDb == null) {
            $this->session->set_flashdata('authentication', 'Username or password is not valid!');
            $this->session->set_flashdata('authenticationType', 'error');
            redirect('authentication/login');
        }

        if (password_verify($password, $getUserFromDb->password) == FALSE) {
            $this->session->set_flashdata('authentication', 'Username or password is not valid!');
            $this->session->set_flashdata('authenticationType', 'error');
            redirect('authentication/login');
        }

        $authData = [
            'x-idm-token'       => password_hash($username, PASSWORD_DEFAULT),
            'x-idm-username'    => $getUserFromDb->username,
            'x-idm-store'       => $getUserFromDb->idtoko,
            'x-idm-kode_toko'   => $getUserFromDb->kodetoko,
        ];

        $this->session->set_userdata($authData);
        redirect('home');
    }

    public function logout()
    {
        if ($this->InitialModel->CheckInitialStatus()->nik > 0) {
            $this->session->set_flashdata('initial', '<div class="alert alert-danger" role="alert">Silahkan tutup shift terlebih dahulu!</div>');
            redirect(base_url('initial'));
        }
        $this->session->unset_userdata(['x-idm-token', 'x-idm-username', 'x-idm-name', 'x-idm-store', 'x-idm-nik']);
        redirect('authentication/login');
    }
}
