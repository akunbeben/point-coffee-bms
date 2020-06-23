<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthenticationModel extends CI_Model {

    public function GetUser($username)
    {
        $this->db->select('users.*, toko.kodetoko, toko.nama_toko');
        $this->db->from('users');
        $this->db->join('toko', 'users.idtoko = toko.id');
        $this->db->where('users.username', $username);

        return $this->db->get();
    }
}