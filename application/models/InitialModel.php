<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InitialModel extends CI_Model
{

    public function UpdateInitialData($dataInitial)
    {
        $this->db->set('nik', $dataInitial['nik']);
        $this->db->set('lastinitialdate', $dataInitial['lastinitialdate']);
        $this->db->set('modal', $dataInitial['modal']);
        $this->db->set('shift', $dataInitial['shift']);
        $this->db->where('idtoko', $this->session->userdata('x-idm-store'));
        $this->db->update('initial');
    }

    public function InsertInitialLog($dataInitial)
    {
        $this->db->insert('initialog', $dataInitial);
    }

    public function InsertInitial($dataInitial)
    {
        $this->db->insert('initial', $dataInitial);
    }

    public function CheckInitialStatus()
    {
        $this->db->from('initial');
        $this->db->where('initial.idtoko', $this->session->userdata('x-idm-store'));
        return $this->db->get()->row();
    }

    public function ResetInitialShift()
    {
        $this->db->set('nik', 0);
        $this->db->set('lastinitialdate', null);
        $this->db->set('modal', 0);
        $this->db->set('shift', 0);
        $this->db->where('idtoko', $this->session->userdata('x-idm-store'));
        $this->db->update('initial');
    }

    public function GetInitialByDate()
    {
        $query = "SELECT * FROM initialog WHERE lastinitialdate >= CURDATE() AND lastinitialdate <= NOW() AND idtoko = {$this->session->userdata('x-idm-store')}";
        return $this->db->query($query);
    }

    public function GetTutupShiftByDate()
    {
        $query =
            "SELECT 
                tutup_shift.*, barista.nama
            FROM 
                tutup_shift
            JOIN 
                barista ON tutup_shift.nik = barista.nik
            WHERE 
                tutup_shift.tanggal_tutup_shift >= CURDATE() 
            AND 
                tutup_shift.tanggal_tutup_shift <= NOW() 
            AND 
                tutup_shift.idtoko = {$this->session->userdata('x-idm-store')}";

        return $this->db->query($query);
    }

    public function tutupShift($data)
    {
        $this->db->insert('tutup_shift', $data);
    }

    public function getLastTutupShift()
    {
        $this->db->from('tutup_shift');
        $this->db->where('idtoko', $this->session->userdata('x-idm-store'));
        $this->db->order_by('tanggal_tutup_shift', 'DESC');
        return $this->db->get();
    }

    public function getLastTutupHarian()
    {
        $this->db->from('tutup_harian');
        $this->db->where('idtoko', $this->session->userdata('x-idm-store'));
        $this->db->order_by('tanggal_tutup_harian', 'DESC');
        return $this->db->get();
    }

    public function getDataHarian()
    {
        $query =
            "SELECT 
                SUM(tutup_shift.total + tutup_shift.ppn) AS total,
                SUM(tutup_shift.kas) AS kas,
                SUM(tutup_shift.ppn) AS ppn,
                SUM(tutup_shift.pergantian) AS pergantian,
                SUM(tutup_shift.variance) AS variance,
                SUM(tutup_shift.jumlah_struk) AS jumlah_customer,
                SUM(tutup_shift.jumlah_item) AS jumlah_item
            FROM
                tutup_shift
            WHERE
                tutup_shift.tanggal_tutup_shift >= CURDATE()
            AND
                tutup_shift.tanggal_tutup_shift <= NOW()
            AND
                tutup_shift.idtoko = {$this->session->userdata('x-idm-store')}";

        return $this->db->query($query);
    }

    public function insertProfit($data)
    {
        $this->db->insert('profit', $data);
    }

    public function getDataDaily()
    {
        $query =
            "SELECT 
                SUM(tutup_shift.total) AS total,
                SUM(tutup_shift.kas) AS kas,
                SUM(tutup_shift.ppn) AS ppn,
                SUM(tutup_shift.pergantian) AS pergantian,
                SUM(tutup_shift.variance) AS variance,
                SUM(tutup_shift.jumlah_struk) AS jumlah_customer,
                SUM(tutup_shift.jumlah_item) AS jumlah_item
            FROM
                tutup_shift
            WHERE
                tutup_shift.tanggal_tutup_shift >= CURDATE()
            AND
                tutup_shift.tanggal_tutup_shift <= NOW()
            AND
                tutup_shift.idtoko = {$this->session->userdata('x-idm-store')}";

        return $this->db->query($query);
    }

    public function insertTutupHarian($data)
    {
        $this->db->insert('tutup_harian', $data);
    }
}
