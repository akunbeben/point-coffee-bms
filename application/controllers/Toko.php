<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Toko extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        IsAuthenticate();
        IsAdmin();
        $this->load->model('TokoModel');
        $this->load->model('UsersModel');
        $this->load->library('form_validation');
    }
    public function index()
    {

        $data = [
            'title'     => 'Toko',
            'sub_title' => 'Daftar Toko',
            'javascript' => null,
            'toko'   => $this->TokoModel->get()->result()
        ];
        // var_dump($data);
        // die;
        $this->template->load('layout/template', 'toko/index', $data);
    }

    public function add()
    {
        $data = [
            'title'     => 'Toko',
            'sub_title' => 'Tambah Toko',
            'javascript' => null
        ];
        $this->form_validation->set_rules('kodetoko', 'Kode Toko', 'required|is_unique[toko.kodetoko]');
        $this->form_validation->set_rules('nama_toko', 'Nama Toko', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('kota', 'Kota', 'required');
        $this->form_validation->set_rules('rt', 'RT', 'required');
        $this->form_validation->set_rules('rw', 'RW', 'required');
        $this->form_validation->set_rules('telp', 'Telp', 'required');
        $this->form_validation->set_rules('kodepos', 'Kode Pos', 'required');
        $this->form_validation->set_rules('buka', 'Tanggal Buka', 'required');
        $this->form_validation->set_rules('namafrc', 'Nama Perusahaan', 'required');
        $this->form_validation->set_rules('ka_toko', 'Kepala Toko', 'required');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('layout/template', 'toko/add', $data);
        } else {
            $this->do_save();
        }
    }

    function do_save()
    {
        $toko = [
            'id'                   => null,
            'kodetoko'             => $this->input->post('kodetoko'),
            'nama_toko'            => $this->input->post('nama_toko'),
            'alamat'               => $this->input->post('alamat'),
            'kota'                 => $this->input->post('kota'),
            'rt'                   => $this->input->post('rt'),
            'rw'                   => $this->input->post('rw'),
            'telp'                 => $this->input->post('telp'),
            'kodepos'              => $this->input->post('kodepos'),
            'buka'                 => $this->input->post('buka'),
            'namafrc'              => $this->input->post('namafrc'),
            'ka_toko'              => $this->input->post('ka_toko'),
            'latitude'             => $this->input->post('latitude'),
            'longitude'            => $this->input->post('longitude'),
            'is_deleted'           => 0,
        ];

        $this->TokoModel->save($toko);
        redirect('toko');
    }
    public function edit($id = null)
    {
        $data = [
            'title'     => 'Toko',
            'sub_title' => 'Edit Toko',
            'javascript' => null,
            'toko'   => $this->TokoModel->get($id)->row()
        ];
        $this->form_validation->set_rules('kodetoko', 'Kode Toko', 'required');
        $this->form_validation->set_rules('nama_toko', 'Nama Toko', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('kota', 'Kota', 'required');
        $this->form_validation->set_rules('rt', 'RT', 'required');
        $this->form_validation->set_rules('rw', 'RW', 'required');
        $this->form_validation->set_rules('telp', 'Telp', 'required');
        $this->form_validation->set_rules('kodepos', 'Kode Pos', 'required');
        $this->form_validation->set_rules('buka', 'Tanggal Buka', 'required');
        $this->form_validation->set_rules('namafrc', 'Nama Perusahaan', 'required');
        $this->form_validation->set_rules('ka_toko', 'Kepala Toko', 'required');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required');

        if ($this->form_validation->run() == FALSE) {
            if ($id == null) {
                redirect('toko/');
            } else {
                $this->template->load('layout/template', 'toko/edit', $data);
            }
        } else {
            $this->do_edit();
        }
    }

    function do_edit()
    {
        $toko = [
            'id'                   => $this->input->post('id'),
            'kodetoko'             => $this->input->post('kodetoko'),
            'nama_toko'            => $this->input->post('nama_toko'),
            'alamat'               => $this->input->post('alamat'),
            'kota'                 => $this->input->post('kota'),
            'rt'                   => $this->input->post('rt'),
            'rw'                   => $this->input->post('rw'),
            'telp'                 => $this->input->post('telp'),
            'kodepos'              => $this->input->post('kodepos'),
            'buka'                 => $this->input->post('buka'),
            'namafrc'              => $this->input->post('namafrc'),
            'ka_toko'              => $this->input->post('ka_toko'),
            'latitude'             => $this->input->post('latitude'),
            'longitude'            => $this->input->post('longitude'),
            'is_deleted'           => 0
        ];

        $oldUser = $this->UsersModel->getUserByIdtoko($toko['id'])->row()->id;

        $this->TokoModel->edit($toko);
        $this->UsersModel->editUsertoko($toko, $oldUser);
        redirect('toko/');
    }

    public function hapus($id = null)
    {
        if ($id == null) {
            redirect('toko/');
        } else {
            $this->TokoModel->hapus($id);
            redirect('toko/');
        }
    }
}
