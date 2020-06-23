<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StockModel extends CI_Model
{

    public function get($id = null, $exceptionCode = null, $productCode = null)
    {
        $this->db->select('stock.*, kategori.singkatan as kategoriname, satuan.singkatan as satuanname');
        $this->db->from('stock');
        $this->db->join('lookupvalue as kategori', 'stock.kategori=kategori.id');
        $this->db->join('lookupvalue as satuan', 'stock.satuan=satuan.id');

        if ($id !== null) {
            $this->db->where('stock.id', $id);
        }

        if ($productCode !== null) {
            $this->db->where('stock.prdcd', $productCode);
        }

        if ($exceptionCode !== null) {
            foreach ($exceptionCode as $key) {
                $this->db->where('stock.prdcd !=', $key->prdcd);
            }
        }

        if ($this->session->userdata('x-idm-store') != 1) {
            $this->db->where('stock.idtoko', $this->session->userdata('x-idm-store'));
        }

        return $this->db->get();
    }

    public function save($stock)
    {
        $this->db->insert('stock', $stock);
    }

    public function edit($stock)
    {
        $this->db->set('prdcd', $stock['prdcd']);
        $this->db->set('deskripsi', $stock['deskripsi']);
        $this->db->set('harga', $stock['harga']);
        $this->db->set('jumlah', $stock['jumlah']);
        $this->db->set('kategori', $stock['kategori']);
        $this->db->set('satuan', $stock['satuan']);
        $this->db->where('id', $stock['id']);
        $this->db->update('stock');
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('stock');
    }

    public function GeneratePermintaan($data)
    {
        $this->db->insert('permintaan_barang', $data);
    }

    public function getGroupedData($kodePermintaan)
    {
        $query =
            "SELECT 
                supplier.supco,
                supplier.nama_supplier,
                permintaan_barang_detail.kodepermintaan,
                SUM(permintaan_barang_detail.jumlah) AS totalBarang,
                permintaan_barang.idtoko
            FROM 
                pos.permintaan_barang_detail 
            JOIN 
                pos.permintaan_barang ON permintaan_barang_detail.kodepermintaan = permintaan_barang.kodepermintaan
            JOIN 
                pos.supplier ON permintaan_barang.kodesupplier = supplier.id
            WHERE
                permintaan_barang_detail.kodepermintaan = " .  "'" . $kodePermintaan . "'" . "
            GROUP BY 
                permintaan_barang.kodepermintaan, supplier.supco, supplier.nama_supplier, permintaan_barang.idtoko";

        return $this->db->query($query);
    }

    public function GetDataPermintaan($kodePermintaan = null, $filterDeleted = true)
    {
        $this->db->select('permintaan_barang.*, barista.nama, toko.kodetoko, toko.nama_toko, lookupvalue.desc, supplier.supco, supplier.nama_supplier');
        $this->db->join('barista', 'barista.id = permintaan_barang.idbarista');
        $this->db->join('supplier', 'supplier.id = permintaan_barang.kodesupplier');
        $this->db->join('toko', 'toko.id = permintaan_barang.idtoko');
        $this->db->join('lookupvalue', 'permintaan_barang.status = lookupvalue.id');
        $this->db->from('permintaan_barang');

        if ($filterDeleted == true) {
            $this->db->where('permintaan_barang.is_deleted', 0);
        }

        if ($kodePermintaan != null) {
            $this->db->where('permintaan_barang.kodepermintaan', $kodePermintaan);
        }

        if ($this->session->userdata('x-idm-store') == 1) {
            $this->db->where('permintaan_barang.status', 29);
        }

        if ($this->session->userdata('x-idm-store') != 1) {
            $this->db->where('permintaan_barang.idtoko', $this->session->userdata('x-idm-store'));
        }
        return $this->db->get();
    }

    public function HapusData($kodePermintaan)
    {
        $this->db->set('is_deleted', 1);
        $this->db->where('kodepermintaan', $kodePermintaan);
        $this->db->update('permintaan_barang');
    }

    public function ProsesPermintaan($kodePermintaan)
    {
        $this->db->set('status', 29);
        $this->db->where('kodepermintaan', $kodePermintaan);
        $this->db->update('permintaan_barang');
    }

    public function GetDataLinePermintaan($kodePermintaan = null, $exceptionCode = null)
    {
        $this->db->select('permintaan_barang_detail.*, stock.deskripsi as nama_item, kategoriValue.singkatan as ketegoriText, satuanValue.singkatan as satuanText');
        $this->db->from('permintaan_barang_detail');
        $this->db->join('stock', 'stock.prdcd = permintaan_barang_detail.prdcd');
        $this->db->join('lookupvalue as kategoriValue', 'kategoriValue.id = permintaan_barang_detail.kategori');
        $this->db->join('lookupvalue as satuanValue', 'satuanValue.id = permintaan_barang_detail.satuan');
        $this->db->where('permintaan_barang_detail.kodepermintaan', $kodePermintaan);

        if ($exceptionCode !== null) {
            foreach ($exceptionCode as $key) {
                $this->db->where('permintaan_barang_detail.prdcd !=', $key->prdcd);
            }
        }

        return $this->db->get();
    }

    public function GetItem($productCode)
    {
        $this->db->where('id', $productCode);
        return $this->db->get('permintaan_barang_detail');
    }

    public function GetItemsJson($kodePermintaan)
    {
        $this->db->select('
                        permintaan_barang_detail.id,
                        permintaan_barang_detail.kodepermintaan,
                        permintaan_barang_detail.prdcd,
                        stock.deskripsi as nama_item,
                        permintaan_barang_detail.harga,
                        kategoriValue.singkatan as kategori, 
                        satuanValue.singkatan as satuan,
                        permintaan_barang_detail.jumlah,
                        ');
        $this->db->from('permintaan_barang_detail');
        $this->db->join('stock', 'stock.prdcd = permintaan_barang_detail.prdcd');
        $this->db->join('lookupvalue as kategoriValue', 'kategoriValue.id = permintaan_barang_detail.kategori');
        $this->db->join('lookupvalue as satuanValue', 'satuanValue.id = permintaan_barang_detail.satuan');
        $this->db->where('permintaan_barang_detail.kodepermintaan', $kodePermintaan);
        return $this->db->get();
    }

    private function DatatablesQuery($search, $kodePermintaan)
    {
        $this->db->select('
                        permintaan_barang_detail.id,
                        permintaan_barang_detail.kodepermintaan,
                        permintaan_barang_detail.prdcd,
                        stock.deskripsi as nama_item,
                        permintaan_barang_detail.harga,
                        kategoriValue.singkatan as kategori, 
                        satuanValue.singkatan as satuan,
                        permintaan_barang_detail.jumlah,
                        ');
        $this->db
            ->from('permintaan_barang_detail')
            ->join('stock', 'stock.prdcd = permintaan_barang_detail.prdcd')
            ->join('lookupvalue as kategoriValue', 'kategoriValue.id = permintaan_barang_detail.kategori')
            ->join('lookupvalue as satuanValue', 'satuanValue.id = permintaan_barang_detail.satuan')
            ->where('permintaan_barang_detail.kodepermintaan', $kodePermintaan);

        if ($search != null) {
            $this->db
                ->group_start()
                ->like('permintaan_barang_detail.prdcd', $search)
                ->or_like('stock.deskripsi', $search)
                ->or_like('permintaan_barang_detail.harga', $search)
                ->or_like('kategoriValue.singkatan', $search)
                ->or_like('satuanValue.singkatan', $search)
                ->group_end();
        }
    }

    public function GetDatatables($search, $length, $start, $orderColumn, $orderDir, $kodePermintaan)
    {
        $this->DatatablesQuery($search, $kodePermintaan);
        $this->db->order_by($orderColumn, $orderDir);
        $this->db->limit($length, $start);

        return $this->db->get()->result();
    }

    public function GetRecordsFiltered($search = null, $kodePermintaan)
    {
        $this->DatatablesQuery($search, $kodePermintaan);
        return $this->db->get();
    }

    public function hapusItem($productCode)
    {
        $this->db->where('id', $productCode);
        $this->db->delete('permintaan_barang_detail');
    }

    public function tambahItem($data)
    {
        $this->db->insert('permintaan_barang_detail', $data);
    }

    public function tambahJumlahItem($productCode)
    {
        $query = "UPDATE permintaan_barang_detail SET jumlah = jumlah + 1 WHERE id = $productCode";
        $this->db->query($query);
    }

    public function kurangiJumlahItem($productCode)
    {
        $query = "UPDATE permintaan_barang_detail SET jumlah = jumlah - 1 WHERE id = $productCode";
        $this->db->query($query);
    }

    public function updateItem($data)
    {
        $this->db->set('harga', $data['harga']);
        $this->db->set('jumlah', $data['jumlah']);
        $this->db->where('id', $data['id']);
        $this->db->update('permintaan_barang_detail');
    }

    public function approve($kodePermintaan)
    {
        $this->db->set('status', 30);
        $this->db->where('kodepermintaan', $kodePermintaan);
        $this->db->update('permintaan_barang');
    }

    public function reject($kodePermintaan)
    {
        $this->db->set('status', 31);
        $this->db->where('kodepermintaan', $kodePermintaan);
        $this->db->update('permintaan_barang');
    }

    public function getLineItem($id)
    {
        $this->db->select('permintaan_barang_detail.*, stock.deskripsi as nama_item');
        $this->db->where('permintaan_barang_detail.id', $id);
        $this->db->from('permintaan_barang_detail');
        $this->db->join('stock', 'stock.prdcd = permintaan_barang_detail.prdcd');
        return $this->db->get();
    }
}
