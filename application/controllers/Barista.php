<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barista extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    IsAuthenticate();
    $this->load->model('BaristaModel');
    $this->load->model('LookupvalueModel');
    $this->load->model('TokoModel');
    $this->load->library('form_validation');
  }

  public function index()
  {

    $data = [
      'title'     => 'Barista',
      'sub_title' => 'Daftar Barista',
      'javascript' => 'barista.js',
      'barista'   => $this->BaristaModel->get()->result()
    ];
    $this->template->load('layout/template', 'barista/index', $data);
  }

  public function add()
  {
    $data = [
      'title'     => 'Barista',
      'sub_title' => 'Tambah Barista',
      'javascript' => 'barista.js',
      'toko' => $this->session->userdata('x-idm-store'),
      'status_kerja' => $this->LookupvalueModel->getlookupvalue(1008)->result(),
      'status_perkawinan' => $this->LookupvalueModel->getlookupvalue(1011)->result(),
      'jabatan' => $this->LookupvalueModel->getlookupvalue(1007)->result(),
      'jenis_kelamin' => $this->LookupvalueModel->getlookupvalue(1002)->result()
    ];

    $this->form_validation->set_rules('nik', 'NIK', 'required|is_unique[barista.nik]');
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
    $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
    $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
    $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    $this->form_validation->set_rules('no_hp', 'No HP', 'required');
    $this->form_validation->set_rules('status_kerja', 'Status Kerja', 'required');
    $this->form_validation->set_rules('status_perkawinan', 'Status Perkawinan', 'required');
    $this->form_validation->set_rules('idtoko', 'ID Toko', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->template->load('layout/template', 'barista/add', $data);
    } else {
      $this->do_save();
    }
  }

  function do_save()
  {
    $barista = [
      'id'                    => null,
      'nik'                   => $this->input->post('nik'),
      'nama'                  => $this->input->post('nama'),
      'tempat_lahir'          => $this->input->post('tempat_lahir'),
      'tanggal_lahir'         => $this->input->post('tanggal_lahir'),
      'jenis_kelamin'         => $this->input->post('jenis_kelamin'),
      'jabatan'               => $this->input->post('jabatan'),
      'alamat'                => $this->input->post('alamat'),
      'no_hp'                 => $this->input->post('no_hp'),
      'status_kerja'          => $this->input->post('status_kerja'),
      'status_perkawinan'     => $this->input->post('status_perkawinan'),
      'idtoko'                => $this->input->post('idtoko')
    ];

    $this->BaristaModel->save($barista);
    $this->session->set_flashdata('pesanGlobal', 'Data barista berhasil ditambahkan.');
    $this->session->set_flashdata('typePesanGlobal', 'success');
    redirect('barista');
  }

  public function edit($id = null)
  {
    $data = [
      'title'     => 'Barista',
      'sub_title' => 'Edit',
      'javascript' => 'barista.js',
      'barista'   => $this->BaristaModel->get($id)->row(),
      'toko' => $this->session->userdata('x-idm-store'),
      'status_kerja' => $this->LookupvalueModel->getlookupvalue(1008)->result(),
      'status_perkawinan' => $this->LookupvalueModel->getlookupvalue(1011)->result(),
      'jabatan' => $this->LookupvalueModel->getlookupvalue(1007)->result(),
      'jenis_kelamin' => $this->LookupvalueModel->getlookupvalue(1002)->result()
    ];

    $this->form_validation->set_rules('nik', 'NIK', 'required');
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
    $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
    $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    $this->form_validation->set_rules('no_hp', 'No HP', 'required');
    $this->form_validation->set_rules('status_kerja', 'Status Kerja', 'required');
    $this->form_validation->set_rules('status_perkawinan', 'Status Perkawinan', 'required');
    $this->form_validation->set_rules('idtoko', 'ID Toko', 'required');

    if ($this->form_validation->run() == FALSE) {
      if ($id == null) {
        redirect('barista/');
      } else {
        $this->template->load('layout/template', 'barista/edit', $data);
      }
    } else {
      $this->do_edit();
    }
  }

  function do_edit()
  {
    $barista = [
      'id'                    => $this->input->post('id'),
      'nik'                   => $this->input->post('nik'),
      'nama'                  => $this->input->post('nama'),
      'tempat_lahir'          => $this->input->post('tempat_lahir'),
      'tanggal_lahir'         => $this->input->post('tanggal_lahir'),
      'jenis_kelamin'         => $this->input->post('jenis_kelamin'),
      'jabatan'               => $this->input->post('jabatan'),
      'alamat'                => $this->input->post('alamat'),
      'no_hp'                 => $this->input->post('no_hp'),
      'status_kerja'          => $this->input->post('status_kerja'),
      'status_perkawinan'     => $this->input->post('status_perkawinan')
    ];

    $this->BaristaModel->edit($barista);
    $this->session->set_flashdata('pesanGlobal', 'Data barista berhasil diupdate.');
    $this->session->set_flashdata('typePesanGlobal', 'success');
    redirect('barista/');
  }

  public function hapus($id = null)
  {
    if ($id == null) {
      redirect('barista/');
    } else {
      $this->BaristaModel->hapus($id);
      redirect('barista/');
    }
  }
}
