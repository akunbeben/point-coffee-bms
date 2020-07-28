<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SupplierModel extends CI_Model
{
    public function get($id = null, $kategori = null)
    {
        $this->db->select('supplier.*, kategori.desc as kategoriname');
        $this->db->from('supplier');
        $this->db->join('lookupvalue kategori', 'kategori.id = supplier.kategori');

        if ($id !== null) {
            $this->db->where('supplier.id', $id);
        }

        if ($kategori !== null) {
            $this->db->where('supplier.kategori', $kategori);
        }

        return $this->db->get();
    }

    public function save($supplier)
    {
        $this->db->insert('supplier', $supplier);
    }

    public function edit($supplier)
    {
        $this->db->set('supco', $supplier['supco']);
        $this->db->set('nama_supplier', $supplier['nama_supplier']);
        $this->db->set('alamat1', $supplier['alamat1']);
        $this->db->set('alamat2', $supplier['alamat2']);
        $this->db->set('telp1', $supplier['telp1']);
        $this->db->set('telp2', $supplier['telp2']);
        $this->db->set('kategori', $supplier['kategori']);
        $this->db->where('id', $supplier['id']);
        $this->db->update('supplier');
    }
    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('supplier');
    }
}
