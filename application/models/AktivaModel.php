<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AktivaModel extends CI_Model{
    
    public function get($id = null)
    {
        $this->db->select('aktiva.*, category.desc as categoryname, subcategory.desc as subcategoryname');
        $this->db->from('aktiva');
        $this->db->join('lookupvalue as category','aktiva.category=category.id');
        $this->db->join('lookupvalue as subcategory','aktiva.subcategory=subcategory.id');
        if ($id !== null) {
            $this->db->where('aktiva.id', $id);
        }

        if ($this->session->userdata('x-idm-store') != 1) {
            $this->db->where('aktiva.idtoko', $this->session->userdata('x-idm-store'));
        }
        
        return $this->db->get();
    
    }

    public function save($aktiva)
    {
        $this->db->insert('aktiva', $aktiva);
    }
    public function edit($aktiva)
    {
        $this->db->set('aktiva_name', $aktiva['aktiva_name']);
        $this->db->set('aktiva_desc', $aktiva['aktiva_desc']);
        $this->db->set('category', $aktiva['category']);
        $this->db->set('subcategory', $aktiva['subcategory']);
        $this->db->set('qty', $aktiva['qty']);
        $this->db->set('harga', $aktiva['harga']);
        $this->db->set('ket', $aktiva['ket']);
        $this->db->where('id', $aktiva['id']);
        $this->db->update('aktiva');
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('aktiva');
    }

    
}

