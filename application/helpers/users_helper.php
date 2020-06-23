<?php 

function CheckUsername($username) {

    $ci = &get_instance();
    $toko = $ci->db->get('toko')->result();
    $result = FALSE;

    foreach ($toko as $store) {
        
        if ($store->kodetoko == $username) {
            $result = TRUE;
            return $result;
        }
    }

    return $result;
}