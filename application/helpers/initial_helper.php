<?php

function CountDataInitial($totalData)
{
    switch ($totalData) {
        case 1:
            $dataToCast = 2;
            break;

        case 2:
            $dataToCast = 3;
            break;

        default:
            $dataToCast = 1;
    }

    return $dataToCast;
}

function CheckDataInitial()
{
    $CI = &get_instance();

    $model = $CI->load->model('InitialModel');

    if ($CI->InitialModel->CheckInitialStatus()->nik == 0) {
        $CI->session->set_flashdata('initial', '<div class="alert alert-danger" role="alert">Silahkan initial terlebih dahulu!</div>');
        redirect(base_url('initial'));
    }
}