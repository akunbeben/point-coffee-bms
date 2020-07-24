<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TokoModel extends CI_Model
{

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
        $this->db->where('toko.is_deleted', 0);

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
        $this->db->set('latitude', $toko['latitude']);
        $this->db->set('longitude', $toko['longitude']);
        $this->db->where('id', $toko['id']);
        $this->db->update('toko');
    }
    public function hapus($id)
    {
        $this->db->set('is_deleted', 1);
        $this->db->where('id', $id);
        $this->db->update('toko');
    }

    public function getGroupedCustomer()
    {
        $query =
            "SELECT
                COUNT(*) total_customer,
                (WEEK(penjualan.tanggal_transaksi) - WEEK(DATE_FORMAT(NOW(), '%Y-%m-01') ) + 1) number_of_week,
                MONTHNAME(penjualan.tanggal_transaksi) name_of_month,
                CONCAT((WEEK(penjualan.tanggal_transaksi) - WEEK(DATE_FORMAT(NOW(), '%Y-%m-01') ) + 1), 
                CASE
                WHEN (WEEK(penjualan.tanggal_transaksi) - WEEK(DATE_FORMAT(NOW(), '%Y-%m-01') ) + 1)%100 BETWEEN 11 AND 13 THEN 'th'
                WHEN (WEEK(penjualan.tanggal_transaksi) - WEEK(DATE_FORMAT(NOW(), '%Y-%m-01') ) + 1)%10 = 1 THEN 'st'
                WHEN (WEEK(penjualan.tanggal_transaksi) - WEEK(DATE_FORMAT(NOW(), '%Y-%m-01') ) + 1)%10 = 2 THEN 'nd'
                WHEN (WEEK(penjualan.tanggal_transaksi) - WEEK(DATE_FORMAT(NOW(), '%Y-%m-01') ) + 1)%10 = 3 THEN 'rd'
                ELSE 'th'
                END) week_suffix
            FROM 
                penjualan
            WHERE
                (penjualan.tanggal_transaksi BETWEEN DATE_FORMAT(NOW(), '%Y-%m-01') AND NOW() )
            GROUP BY
                (WEEK(penjualan.tanggal_transaksi) - WEEK(DATE_FORMAT(NOW(), '%Y-%m-01') ) + 1), MONTHNAME(penjualan.tanggal_transaksi)";

        return $this->db->query($query);
    }
}
