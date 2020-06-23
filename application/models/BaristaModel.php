<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BaristaModel extends CI_Model{

    public function GetBaristaByStore($storeId)
    {
        $this->db->from('barista');
        $this->db->where('idtoko', $storeId);
        return $this->db->get();
    }

    public function GetBaristaByNik($nik)
    {
        $this->db->from('barista');
        $this->db->where('nik', $nik);
        return $this->db->get();
    }
    
    public function get($id = null)
    {
        $this->db->select('barista.*, toko.kodetoko, toko.nama_toko');
        $this->db->from('barista');
        $this->db->join('toko', 'barista.idtoko = toko.id');

        if ($id !== null) {
            $this->db->where('barista.id', $id);
        }

        if ($this->session->userdata('x-idm-store') != 1) {
            $this->db->where('barista.idtoko', $this->session->userdata('x-idm-store'));
        }

        return $this->db->get();
    }

    public function save($barista)
    {
        $this->db->insert('barista', $barista);
    }

    public function edit($barista)
    {
        $this->db->set('nik', $barista['nik']);
        $this->db->set('nama', $barista['nama']);
        $this->db->set('tempat_lahir', $barista['tempat_lahir']);
        $this->db->set('tanggal_lahir', $barista['tanggal_lahir']);
        $this->db->set('jenis_kelamin', $barista['jenis_kelamin']);
        $this->db->set('jabatan', $barista['jabatan']);
        $this->db->set('alamat', $barista['alamat']);
        $this->db->set('no_hp', $barista['no_hp']);
        $this->db->set('status_kerja', $barista['status_kerja']);
        $this->db->set('status_perkawinan', $barista['status_perkawinan']);
        $this->db->where('id', $barista['id']);
        $this->db->update('barista');
    }
    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('barista');
    }
}