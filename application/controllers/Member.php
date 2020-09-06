<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    IsAuthenticate();
    $this->load->model('MemberModel');
    $this->load->model('LookupvalueModel');
    $this->load->library('form_validation');
  }

  public function index()
  {
    $data = [
      'title'     => 'Member',
      'sub_title' => 'Daftar Member',
      'javascript' => null,
      'member'   => $this->MemberModel->get(null, true)->result()

    ];
    $this->template->load('layout/template', 'member/index', $data);
  }

  public function add()
  {
    $data = [
      'title'     => 'Member',
      'sub_title' => 'Tambah Member',
      'javascript' => null,
      'gender'  => $this->LookupvalueModel->getlookupvalue(1002)->result()

    ];
    $this->form_validation->set_rules('id_member', 'ID Member', 'required');
    $this->form_validation->set_rules('nama', 'Nama Member', 'required');
    $this->form_validation->set_rules('noktp', 'No KTP', 'required');
    $this->form_validation->set_rules('nohp', 'No HP', 'required');
    $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    if ($this->form_validation->run() == FALSE) {
      $this->template->load('layout/template', 'member/add', $data);
    } else {
      $this->do_save();
    }
  }

  function do_save()
  {
    $member = [
      'id'                   => null,
      'id_member'            => $this->input->post('id_member'),
      'nama'                 => $this->input->post('nama'),
      'noktp'                => $this->input->post('noktp'),
      'nohp'                 => $this->input->post('nohp'),
      'jk'                   => $this->input->post('jk'),
      'alamat'               => $this->input->post('alamat'),
    ];

    $this->MemberModel->save($member);
    $this->session->set_flashdata('pesanGlobal', 'Member baru berhasil ditambahkan.');
    $this->session->set_flashdata('typePesanGlobal', 'success');
    redirect('member');
  }
  public function edit($id = null)
  {
    $data = [
      'title'     => 'Member',
      'sub_title' => 'Edit Member',
      'javascript' => null,
      'gender'  => $this->LookupvalueModel->getlookupvalue(1002)->result(),
      'member'    => $this->MemberModel->get($id)->row()
    ];
    $this->form_validation->set_rules('id_member', 'ID Member', 'required');
    $this->form_validation->set_rules('nama', 'Nama Member', 'required');
    $this->form_validation->set_rules('noktp', 'No KTP', 'required');
    $this->form_validation->set_rules('nohp', 'No HP', 'required');
    $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    if ($this->form_validation->run() == FALSE) {
      if ($id == null) {
        redirect('member/');
      } else {
        $this->template->load('layout/template', 'member/edit', $data);
      }
    } else {
      $this->do_edit();
    }
  }

  function do_edit()
  {
    $member = [
      'id'                   => $this->input->post('id'),
      'id_member'            => $this->input->post('id_member'),
      'nama'                 => $this->input->post('nama'),
      'noktp'                => $this->input->post('noktp'),
      'nohp'                 => $this->input->post('nohp'),
      'jk'                   => $this->input->post('jk'),
      'alamat'               => $this->input->post('alamat'),
    ];

    $this->MemberModel->edit($member);
    $this->session->set_flashdata('pesanGlobal', 'Data member berhasil diupdate.');
    $this->session->set_flashdata('typePesanGlobal', 'success');
    redirect('member/');
  }

  public function hapus($id = null)
  {
    if ($id == null) {
      redirect('member/');
    } else {
      $this->MemberModel->hapus($id);
      redirect('member/');
    }
  }
}
