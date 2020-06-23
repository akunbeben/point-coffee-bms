<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InitialModel extends CI_Model {

    public function UpdateInitialData($dataInitial)
    {
        $this->db->set('nik', $dataInitial['nik']);
        $this->db->set('lastinitialdate', $dataInitial['lastinitialdate']);
        $this->db->set('modal', $dataInitial['modal']);
        $this->db->set('shift', $dataInitial['shift']);
        $this->db->where('id', 1);
        $this->db->update('initial');
    }

    public function InsertInitialLog($dataInitial)
    {
        $this->db->insert('initialog', $dataInitial);
    }

    public function CheckInitialStatus()
    {
        $this->db->from('initial');
        $this->db->where('initial.id', 1);
        return $this->db->get()->row();
    }

    public function ResetInitialShift()
    {
        $this->db->set('nik', 0);
        $this->db->set('lastinitialdate', null);
        $this->db->set('modal', 0);
        $this->db->set('shift', 0);
        $this->db->where('id', 1);
        $this->db->update('initial');
    }

    public function GetInitialByDate()
    {
        $query = "SELECT * FROM initialog WHERE lastinitialdate >= CURDATE() AND lastinitialdate <= NOW()";
        return $this->db->query($query);
    }
}