<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Mpdf\Mpdf;

class Initial extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        IsAuthenticate();
        $this->load->model('TokoModel');
        $this->load->model('InitialModel');
        $this->load->model('BaristaModel');
        $this->load->model('KasirModel');
        $this->load->model('LaporanModel');
        $this->load->library('form_validation');
        $this->load->helper('initial');
        $this->load->helper('kasir');
    }

    public function index()
    {
        $data = [
            'title'             => 'Initial',
            'sub_title'         => '',
            'javascript'        => 'initial.js',
            'currentInitial'    => $this->InitialModel->CheckInitialStatus(),
            'currentBarista'    => null,
            'barista'           => $this->BaristaModel->GetBaristaByStore($this->session->userdata('x-idm-store'))->result()
        ];

        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('modal', 'Modal Awal', 'required');

        if ($data['currentInitial'] != null) {
            if ($data['currentInitial']->nik != 0) {
                $data['currentBarista'] = $this->BaristaModel->GetBaristaByNik($this->InitialModel->CheckInitialStatus()->nik)->row();
            }
        }

        if ($this->form_validation->run() == TRUE) {
            $this->create_initial();
        }

        $this->template->load('layout/template', 'initial/initial', $data);
    }

    public function tutup_shift()
    {
        $data = [
            'title'     => 'Tutup Shift',
            'sub_title' => '',
            'javascript' => 'tutup_shift.js'
        ];

        $this->form_validation->set_rules('pendapatan', 'Pendapatan', 'required');

        if ($this->form_validation->run() == TRUE) {

            $dataTutupShift = [
                'id' => null,
                'nik' => $this->InitialModel->CheckInitialStatus()->nik,
                'tanggal_tutup_shift' => date('Y-m-d H:i:s', time()),
                'total' => $this->KasirModel->getCurrentTotalSales($this->InitialModel->CheckInitialStatus()->lastinitialdate)->row()->total == null ? 0 : $this->KasirModel->getCurrentTotalSales($this->InitialModel->CheckInitialStatus()->lastinitialdate)->row()->total,
                'kas' => intval($this->input->post('pendapatan')),
                'shift' => $this->InitialModel->CheckInitialStatus()->shift,
                'pergantian' => ((persen(intval($this->KasirModel->getCurrentTotalSales($this->InitialModel->CheckInitialStatus()->lastinitialdate)->row()->total), 10) + intval($this->KasirModel->getCurrentTotalSales($this->InitialModel->CheckInitialStatus()->lastinitialdate)->row()->total)) - intval($this->input->post('pendapatan'))) <= 0 ? 0 : ((persen(intval($this->KasirModel->getCurrentTotalSales($this->InitialModel->CheckInitialStatus()->lastinitialdate)->row()->total), 10) + intval($this->KasirModel->getCurrentTotalSales($this->InitialModel->CheckInitialStatus()->lastinitialdate)->row()->total)) - intval($this->input->post('pendapatan'))),
                'variance' => (intval($this->input->post('pendapatan')) - (persen(intval($this->KasirModel->getCurrentTotalSales($this->InitialModel->CheckInitialStatus()->lastinitialdate)->row()->total), 10) + intval($this->KasirModel->getCurrentTotalSales($this->InitialModel->CheckInitialStatus()->lastinitialdate)->row()->total))) <= 0 ? 0 : (intval($this->input->post('pendapatan')) - (persen(intval($this->KasirModel->getCurrentTotalSales($this->InitialModel->CheckInitialStatus()->lastinitialdate)->row()->total), 10) + intval($this->KasirModel->getCurrentTotalSales($this->InitialModel->CheckInitialStatus()->lastinitialdate)->row()->total))),
                'ppn' => persen(intval($this->KasirModel->getCurrentTotalSales($this->InitialModel->CheckInitialStatus()->lastinitialdate)->row()->total), 10),
                'jumlah_struk' => intval($this->KasirModel->getCountSales($this->InitialModel->CheckInitialStatus()->lastinitialdate)->row()->jumlah_struk),
                'jumlah_item' => intval($this->KasirModel->getCountSalesItem($this->InitialModel->CheckInitialStatus()->lastinitialdate)->row()->jumlah_item),
                'idtoko' => intval($this->session->userdata('x-idm-store'))
            ];

            $this->InitialModel->tutupShift($dataTutupShift);
            $this->InitialModel->ResetInitialShift();

            $this->session->set_flashdata(
                'initial',
                '<div class="alert alert-success" role="alert">Tutup shift berhasil! 
                    <a class="btn btn-primary btn-sm float-right" target="_blank" href="' . base_url('initial/print-tutup-shift/') . intval($this->InitialModel->getLastTutupShift()->row()->id) . '"><i class="fas fa-print"></i> Cetak</a>
                </div>'
            );
            redirect(base_url('initial'));
        }

        $this->template->load('layout/template', 'initial/tutup_shift', $data);
    }

    private function create_initial()
    {
        $defaultShift = 1;
        $dataInitial = [
            'id' => null,
            'nik' => $this->input->post('nik'),
            'lastinitialdate' => date('Y-m-d H:i:s', time()),
            'modal' => $this->input->post('modal'),
            'shift' => $defaultShift,
            'idtoko' => $this->session->userdata('x-idm-store')
        ];

        $checkInitialFromDb = $this->InitialModel->CheckInitialStatus();
        $countDataInitial = $this->InitialModel->GetInitialByDate()->num_rows();

        if ($checkInitialFromDb == null) {
            $this->InitialModel->InsertInitial($dataInitial);
            $this->InitialModel->InsertInitialLog($dataInitial);

            $this->session->set_flashdata('initial', '<div class="alert alert-success" role="alert">Initial berhasil!</div>');
            redirect(base_url('initial'));
        }

        if ($this->InitialModel->CheckInitialStatus()->shift > 0) {
            $this->session->set_flashdata('initial', '<div class="alert alert-danger" role="alert">Silahkan tutup shift terlebih dahulu!</div>');
            redirect(base_url('initial'));
        }

        if ($countDataInitial == 3) {
            $this->session->set_flashdata('initial', '<div class="alert alert-danger" role="alert">Akses initial ditutup!</div>');
            redirect(base_url('initial'));
        }

        if ($countDataInitial > 0) {
            $getShift = CountDataInitial($countDataInitial, $defaultShift);
            $dataInitial['shift'] = $getShift;
            $this->InitialModel->UpdateInitialData($dataInitial);
            $this->InitialModel->InsertInitialLog($dataInitial);

            $this->session->set_flashdata('initial', '<div class="alert alert-success" role="alert">Initial berhasil!</div>');
            redirect(base_url('initial'));
        }

        $this->GenerateInitial($dataInitial);
        $this->session->set_flashdata('initial', '<div class="alert alert-success" role="alert">Initial berhasil!</div>');
        redirect(base_url('initial'));
    }

    public function print_tutup_shift($id = null)
    {
        $dataLaporan = $this->LaporanModel->getTutupShift($id)->row();

        $data = [
            'toko' => $this->TokoModel->get($dataLaporan->idtoko)->row(),
            'barista' => $this->BaristaModel->GetBaristaByNik($dataLaporan->nik)->row(),
            'data' => $dataLaporan
        ];

        $mpdf = new Mpdf;
        $view = $this->load->view('laporan/initial/tutup_shift', $data, TRUE);
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }

    public function print_tutup_harian($id = null)
    {
        $dataLaporan = $this->LaporanModel->getTutupHarian($id)->row();
        $tanggal = date('Y-m-d', strtotime($dataLaporan->tanggal));
        $dataShift = $this->LaporanModel->getShiftHarian($tanggal)->result();

        $data = [
            'toko' => $this->TokoModel->get($dataLaporan->idtoko)->row(),
            'dataShift' => $dataShift,
            'data' => $dataLaporan
        ];

        $mpdf = new Mpdf;
        $view = $this->load->view('laporan/initial/tutup_harian', $data, TRUE);
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }

    public function tutup_harian()
    {
        $data = [
            'title' => 'Tutup Harian',
            'javascript' => 'tutup_harian.js',
            'detail' => $this->InitialModel->GetTutupShiftByDate()->result()
        ];

        $this->form_validation->set_rules('csrf', 'csrf', 'required');

        if ($this->form_validation->run() == true) {
            $dataHarian = $this->InitialModel->getDataHarian()->row();

            $dataTutupHarian = [
                'id' => null,
                'tanggal' => date('Y-m-d', time()),
                'total' => $dataHarian->total,
                'kas' => $dataHarian->kas,
                'pergantian' => $dataHarian->pergantian,
                'variance' => $dataHarian->variance,
                'ppn' => $dataHarian->ppn,
                'jumlah_customer' => $dataHarian->jumlah_customer,
                'jumlah_item' => $dataHarian->jumlah_item,
                'idtoko' => $this->session->userdata('x-idm-store'),
                'tanggal_tutup_harian' => date('Y-m-d H:i:s', time())
            ];

            $this->InitialModel->insertTutupHarian($dataTutupHarian);

            $this->session->set_flashdata(
                'initial',
                '<div class="alert alert-success" role="alert">Tutup harian berhasil! 
                    <a class="btn btn-primary btn-sm float-right" target="_blank" href="' . base_url('initial/print-tutup-harian/') . intval($this->InitialModel->getLastTutupHarian()->row()->id) . '"><i class="fas fa-print"></i> Cetak</a>
                </div>'
            );
            redirect(base_url('initial'));
        }

        $this->template->load('layout/template', 'initial/tutup_harian', $data);
    }

    private function GenerateInitial($data)
    {
        $this->InitialModel->UpdateInitialData($data);
        $this->InitialModel->InsertInitialLog($data);
    }
}
