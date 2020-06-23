<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TokoModel extends CI_Model{
    
    public function GetUnregisteredStore()
    {
        $this->db->select('toko.*, users.username, users.idtoko');
        $this->db->from('toko');
        $this->db->join('users', 'users.idtoko = toko.id', 'left');
        $this->db->where('users.id', null);
        return $this->db->get();
    }

    public function get($id = null)
    {
        if ($id !== null) {
            $this->db->where('id', $id);
        }
        $this->db->where('toko.id !=', 1);
        return $this->db->get('toko');
    }

    public function save($toko)
    {
        $this->db->insert('toko', $toko);
    }
    public function edit($toko)
    {
        $this->db->set('kodetoko', $toko['kodetoko']);
        $this->db->set('nama_toko', $toko['nama_toko']);
        $this->db->set('alamat', $toko['alamat']);
        $this->db->set('kota', $toko['kota']);
        $this->db->set('rt', $toko['rt']);
        $this->db->set('rw', $toko['rw']);
        $this->db->set('telp', $toko['telp']);
        $this->db->set('kodepos', $toko['kodepos']);
        $this->db->set('buka', $toko['buka']);
        $this->db->set('namafrc', $toko['namafrc']);
        $this->db->set('ka_toko', $toko['ka_toko']);
        $this->db->where('id', $toko['id']);
        $this->db->update('toko');
    }
    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('toko');
    }
}
