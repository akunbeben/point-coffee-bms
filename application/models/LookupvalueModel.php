<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LookupvalueModel extends CI_Model
{

    public function getlookupvalue($type)
    {
        return $this->db->from('lookupvalue')
            ->where('valuetype', $type)
            ->get();
    }
}
