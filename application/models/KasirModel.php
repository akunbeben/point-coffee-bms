<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KasirModel extends CI_Model
{

    public function AddToCart($data)
    {
        $this->db->insert('kasir_keranjang', $data);
    }

    public function KeranjangBelanja($id = null, $productId = null)
    {
        $this->db->select('kasir_keranjang.*, product.prdcd, product.singkatan, product.price, product.sellingprice');
        $this->db->from('kasir_keranjang');
        $this->db->join('product', 'product.id = kasir_keranjang.product_id');

        if ($id != null) {
            $this->db->where('kasir_keranjang.id', $id);
        }

        if ($productId != null) {
            $this->db->where('kasir_keranjang.product_id', $productId);
        }

        return $this->db->get();
    }

    public function TambahJumlahProduct($id)
    {
        $query = "UPDATE kasir_keranjang SET quantity = quantity + 1 WHERE id = $id";
        $this->db->query($query);
    }

    public function HapusProduct($id)
    {
        $this->db->delete('kasir_keranjang', ['id' => $id]);
    }

    public function KurangiJumlahProduct($id)
    {
        $query = "UPDATE kasir_keranjang SET quantity = quantity - 1 WHERE id = $id";
        $this->db->query($query);
    }

    public function TotalBelanja()
    {
        $query = "SELECT SUM(kasir_keranjang.quantity * product.sellingprice) as total FROM `kasir_keranjang` LEFT JOIN `product` ON `kasir_keranjang`.`product_id` = `product`.`id`";

        return $this->db->query($query)->row();
    }

    public function Keuntungan()
    {
        $query = "SELECT ((kasir_keranjang.quantity * product.sellingprice) - (kasir_keranjang.quantity * product.price)) as total FROM `kasir_keranjang` LEFT JOIN `product` ON `kasir_keranjang`.`product_id` = `product`.`id`";

        return $this->db->query($query)->row();
    }

    public function BayarNonTunai($data)
    {
        $this->db->insert('penjualan_non_tunai', $data);
    }

    public function CloseOrder($data)
    {
        $this->db->insert('penjualan', $data);
    }

    public function ResetKeranjang()
    {
        $this->db->truncate('kasir_keranjang');
    }

    public function sendDetail($invoiceId)
    {
        $query =
            "INSERT INTO penjualan_detail (penjualan_id, product_id, quantity)
            SELECT '" . $invoiceId . "' , product_id, quantity FROM kasir_keranjang";
        $this->db->query($query);
    }

    public function CheckPembayaran($struk)
    {
        $this->db->from('penjualan_non_tunai');
        $this->db->where('no_struk', $struk);
        return $this->db->get()->row();
    }

    public function getCurrentTotalSales($transactionDate)
    {
        $query =
            "SELECT 
                SUM(total_bayar) AS total 
            FROM 
                penjualan
            WHERE 
                tanggal_transaksi >= '$transactionDate'
            AND 
                tanggal_transaksi <=" . "'" . date('Y-m-d H:i:s', time()) . "'" .
            "AND idtoko = " . "'" . $this->session->userdata('x-idm-store') . "'";

        return $this->db->query($query);
    }

    public function getCountSales($transactionDate)
    {
        $query =
            "SELECT 
                COUNT(id) AS jumlah_struk
            FROM 
                penjualan
            WHERE 
                tanggal_transaksi >= '$transactionDate'
            AND 
                tanggal_transaksi <=" . "'" . date('Y-m-d H:i:s', time()) . "'" .
            "AND idtoko = " . "'" . $this->session->userdata('x-idm-store') . "'";

        return $this->db->query($query);
    }

    public function getCountSalesItem($transactionDate)
    {
        $query =
            "SELECT 
                SUM(penjualan_detail.quantity) AS jumlah_item
            FROM 
                penjualan 
            INNER JOIN 
                penjualan_detail on penjualan_detail.penjualan_id = penjualan.id
            WHERE 
                penjualan.tanggal_transaksi >= '$transactionDate'
            AND 
                penjualan.tanggal_transaksi <=" . "'" . date('Y-m-d H:i:s', time()) . "'" .
            "AND penjualan.idtoko = " . "'" . $this->session->userdata('x-idm-store') . "'";

        return $this->db->query($query);
    }
}
