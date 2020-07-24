<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductModel extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select('product.*, unitTable.singkatan unitName, sizeTable.singkatan sizeName');
        $this->db->from('product');
        $this->db->join('lookupvalue unitTable', 'product.unit = unitTable.id');
        $this->db->join('lookupvalue sizeTable', 'product.size = sizeTable.id');
        if ($id !== null) {
            $this->db->where('product.id', $id);
        }

        return $this->db->get();
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
