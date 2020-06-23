<?php

function IsAuthenticate()
{
    $ci = &get_instance();
    $login_token    = $ci->session->userdata('x-idm-username');
    $hash           = $ci->session->userdata('x-idm-token');

    if (!password_verify($login_token, $hash)) {
        $ci->session->set_flashdata('authentication', 'Access denied, login to get access!');
        $ci->session->set_flashdata('authenticationType', 'error');
        redirect('authentication/login');
    }
}

function IsAdmin()
{
    $ci = &get_instance();

    if ($ci->session->userdata('x-idm-store') != 1) {
        redirect(base_url());
    }
}

function UserOnly()
{
    $ci = &get_instance();

    if ($ci->session->userdata('x-idm-store') == 1) {
        redirect(base_url());
    }
}
