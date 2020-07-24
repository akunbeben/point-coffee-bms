<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UsersModel extends CI_Model
{

    public function Get($id = null)
    {
        $this->db->select('users.*, toko.kodetoko, toko.nama_toko');
        $this->db->from('users');
        $this->db->join('toko', 'users.idtoko = toko.id');

        if ($id !== null)
            $this->db->where('users.id', $id);

        $this->db->where('toko.id !=', 1);
        return $this->db->get();
    }

    public function Register($data)
    {
        $this->db->insert('users', $data);
    }

    public function Update($id, $data)
    {
        $currentData = $this->Get($id)->row();

        $this->db->set('password', $data['password_baru']);
        $this->db->set('idtoko', $data['idtoko']);
        $this->db->where('id', $currentData->id);
        $this->db->update('users');
    }

    public function editUserToko($data, $id)
    {
        $this->db->set('username', $data['kodetoko']);
        $this->db->where('users.id', $id);
        $this->db->update('users');
    }

    public function getUserByIdToko($idToko)
    {
        return $this->db->where('users.idtoko', $idToko)->get('users');
    }
}
