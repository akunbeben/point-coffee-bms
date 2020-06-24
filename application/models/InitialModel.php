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
}
