<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductModel extends CI_Model{
    
    public function get($id = null)
    {
        if ($id !== null) {
            $this->db->where('id', $id);
        }

        if ($this->session->userdata('x-idm-store') != 1) {
            $this->db->where('product.idtoko', $this->session->userdata('x-idm-store'));
        }

        return $this->db->get('product');
    }

    public function save($product)
    {
        $this->db->insert('product', $product);
    }
    
    public function edit($product)
    {
        $this->db->set('prdcd', $product['prdcd']);
        $this->db->set('singkatan', $product['singkatan']);
        $this->db->set('desc', $product['desc']);
        $this->db->set('unit', $product['unit']);
        $this->db->set('size', $product['size']);
        $this->db->set('price', $product['price']);
        $this->db->set('sellingprice', $product['sellingprice']);
        $this->db->where('id', $product['id']);
        $this->db->update('product');
    }
    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('product');
    }
}

