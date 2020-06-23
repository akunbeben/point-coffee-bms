<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MemberModel extends CI_Model{
    
    public function get($id = null)
    {
        $this->db->select('member.*, gender.desc as jkname');   
        $this->db->from('member');
        $this->db->join('lookupvalue as gender','member.jk=gender.id');
        if ($id !== null) {
            $this->db->where('member.id', $id);
        }
        $this->db->order_by('id_member', 'asc');
        return $this->db->get();
    }

    public function save($member)
    {
        $this->db->insert('member', $member);
    }
    
    public function edit($member)
    {
        $this->db->set('id_member', $member['id_member']);
        $this->db->set('nama', $member['nama']);
        $this->db->set('noktp', $member['noktp']);
        $this->db->set('nohp', $member['nohp']);
        $this->db->set('jk', $member['jk']);
        $this->db->set('alamat', $member['alamat']);
        $this->db->where('id', $member['id']);
        $this->db->update('member');
    }
    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('member');
    }
}

