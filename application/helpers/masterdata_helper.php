<?php

function MasterDataPage($page) {

    $this->CI = &get_instance();
    
    $urlSegmented = $this->CI->uri->segment(1);

    if ($page == $urlSegmented) {
        return 'Active';
    }
}