<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        IsAuthenticate();
        $this->load->model('BaristaModel');
        $this->load->model('MemberModel');
        $this->load->model('ProductModel');
        $this->load->model('KasirModel');
        $this->load->model('InitialModel');
        $this->load->model('LaporanModel');
        $this->load->helper('kasir');
    }

    public function index()
    {
        if ($this->InitialModel->CheckInitialStatus()->nik == 0) {
            $this->session->set_flashdata('initial', '<div class="alert alert-danger" role="alert">Silahkan initial terlebih dahulu!</div>');
            redirect(base_url('initial'));
        }

        $keuntungan = $this->KasirModel->Keuntungan() == null ? 0 : $this->KasirModel->TotalBelanja()->total;
        $totalBelanja = $this->KasirModel->TotalBelanja() == null ? 0 : $this->KasirModel->TotalBelanja()->total;

        $data = [
            'title'         => 'POS Kasir',
            'sub_title'     => '',
            'javascript'    => 'kasir.js',
            'kasir'         => $this->BaristaModel->GetBaristaByNik($this->InitialModel->CheckInitialStatus()->nik)->row(),
            'customer'      => $this->MemberModel->get()->result(),
            'product'       => $this->ProductModel->get()->result(),
            'struk'         => FormatStruk(NomorStruk()),
            'totalBelanja'  => $totalBelanja,
            'keuntungan'    => $keuntungan,
            'keranjang'     => $this->KasirModel->KeranjangBelanja()->result(),
            'pembayaran'    => $this->KasirModel->CheckPembayaran(FormatStruk(NomorStruk()))
        ];

        if ($this->KasirModel->CheckPembayaran(FormatStruk(NomorStruk())) != null) {
            $data['pembayaran'] = $this->KasirModel->CheckPembayaran($data['struk']);
        }

        $this->template->load('layout/template', 'kasir/index', $data);
    }

    public function add_to_cart()
    {
        $data = [
            'id'            => null,
            'product_id'    => $this->input->post('product'),
            'quantity'      => 1
        ];

        $currentProductOnCart = $this->KasirModel->KeranjangBelanja(null, $data['product_id'])->row();

        if ($currentProductOnCart->product_id == $data['product_id']) {
            $this->plus_product($currentProductOnCart->id);
            redirect(base_url('kasir'));
        }

        $this->KasirModel->AddToCart($data);
        redirect(base_url('kasir'));
    }

    public function plus_product($id)
    {
        $this->KasirModel->TambahJumlahProduct($id);
        redirect(base_url('kasir'));
    }

    public function delete_product($id)
    {
        $this->KasirModel->HapusProduct($id);
        redirect(base_url('kasir'));
    }

    public function minus_product($id)
    {
        $currentProductOnCart = $this->KasirModel->KeranjangBelanja($id)->row()->quantity;

        if ($currentProductOnCart <= 1) {
            $this->session->set_flashdata('pesan', 'Penjualan minilam satu produk.');
            $this->session->set_flashdata('typePesan', 'error');
            redirect(base_url('kasir'));
        }

        $this->KasirModel->KurangiJumlahProduct($id);
        redirect(base_url('kasir'));
    }

    public function non_tunai()
    {
        $data = [
            'id'        => null,
            'no_struk'  => $this->input->post('no_struk'),
            'no_kartu'  => $this->input->post('no_kartu'),
            'bank'      => $this->input->post('bank'),
            'approval'  => $this->input->post('approval'),
            'total'     => $this->input->post('total')
        ];

        $this->KasirModel->BayarNonTunai($data);

        $output = ['status' => true, 'data' => $data, 'redirect' => base_url('kasir/')];

        header('Content-Type: application/json');
        echo json_encode($output);
    }

    public function bayar()
    {
        $data = [
            'id' => null,
            'struk' => $this->input->post('kasir_struk'),
            'kasir' => $this->input->post('kasir_kasir'),
            'member' => $this->input->post('kasir_member'),
            'total_belanja' => $this->input->post('kasir_total_belanja'),
            'total_bayar' => $this->input->post('kasir_total_bayar'),
            'keuntungan' => $this->input->post('kasir_keuntungan'),
            'kembalian' => $this->input->post('kasir_kembalian'),
            'tanggal_transaksi' => date('Y-m-d H:i:s', time()),
            'idtoko' => $this->session->userdata('x-idm-store')
        ];

        $this->KasirModel->CloseOrder($data);

        $salesId = $this->LaporanModel->getSales(null, $data['struk'])->row()->id;

        $this->KasirModel->sendDetail($salesId);
        $this->KasirModel->ResetKeranjang();
        $this->session->set_flashdata('pesan', 'Penjualan Selesai.');
        $this->session->set_flashdata('typePesan', 'success');
        redirect(base_url('kasir'));
    }
}
