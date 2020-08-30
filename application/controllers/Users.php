<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        IsAuthenticate();
        IsAdmin();
        $this->load->helper('users');
        $this->load->model('UsersModel');
        $this->load->model('TokoModel');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = [
            'title'         => 'Users',
            'sub_title'     => '',
            'javascript'    => 'users.js',
            'users'         => $this->UsersModel->Get()->result()
        ];

        $this->template->load('layout/template', 'users/index', $data);
    }

    public function add()
    {
        $data = [
            'title'         => 'Add User',
            'sub_title'     => '',
            'javascript'    => 'users.js',
            'toko'          => $this->TokoModel->GetUnregisteredStore()->result(),
            'users'         => array()
        ];

        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('konf_password', 'Konfirmasi Password', 'required|matches[password]');
        $this->form_validation->set_rules('idtoko', 'ID Toko', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->Register();
        }

        $getUnregisteredStore = $this->TokoModel->GetUnregisteredStore()->result();

        foreach ($getUnregisteredStore as $user) {
            $data['users'][] = $user->kodetoko;
        };

        $this->template->load('layout/template', 'users/add', $data);
    }

    public function edit($id)
    {
        $data = [
            'title'         => 'Edit User',
            'sub_title'     => '',
            'javascript'    => 'users.js',
            'toko'          => $this->TokoModel->get()->result(),
            'user'          => $this->UsersModel->Get($id)->row()
        ];

        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required');
        $this->form_validation->set_rules('password_baru', 'Password Baru', 'required');
        $this->form_validation->set_rules('konf_password', 'Konfirmasi Password', 'required|matches[password_baru]');
        $this->form_validation->set_rules('idtoko', 'ID Toko', 'required');

        if ($this->form_validation->run() == TRUE) {
            $this->Update();
        }

        $this->template->load('layout/template', 'users/edit', $data);
    }

    public function hapus($id = null)
    {
        if ($id == null) {
            redirect('users/');
        }

        $this->UsersModel->delete($id);
        redirect('users/');
    }

    private function Update()
    {
        $data = [
            'id'            => $this->input->post('id'),
            'password_lama' => $this->input->post('password_lama'),
            'password_baru' => password_hash($this->input->post('password_baru'), PASSWORD_DEFAULT),
            'idtoko'        => $this->input->post('idtoko')
        ];

        $currentData = $this->UsersModel->Get($data['id'])->row();

        if (password_verify($data['password_lama'], $currentData->password) == false) {
            $this->session->set_flashdata('typePesan', 'error');
            $this->session->set_flashdata('pesan', 'Password lama salah.');
            redirect(base_url('users/edit/') . $data['id']);
        }

        $this->UsersModel->Update($data['id'], $data);
        redirect(base_url('users/'));
    }

    private function Register()
    {
        $data = [
            'id'        => null,
            'username'  => $this->input->post('username'),
            'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'idtoko'    => $this->input->post('idtoko')
        ];

        $this->UsersModel->Register($data);
        redirect(base_url('users/'));
    }
}
