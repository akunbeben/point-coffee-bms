<?php

function FormatStruk($num)
{
    $num = $num + 1;
    switch (strlen($num)) {
        case 1:
            $NoTrans = "000000000" . $num;
            break;
        case 2:
            $NoTrans = "00000000" . $num;
            break;
        case 3:
            $NoTrans = "0000000" . $num;
            break;
        case 4:
            $NoTrans = "000000" . $num;
            break;
        case 5:
            $NoTrans = "00000" . $num;
            break;
        case 6:
            $NoTrans = "0000" . $num;
            break;
        case 7:
            $NoTrans = "000" . $num;
            break;
        case 8:
            $NoTrans = "00" . $num;
            break;
        case 9:
            $NoTrans = "0" . $num;
            break;
        default:
            $NoTrans = $num;
    }
    return $NoTrans;
}

function NomorStruk()
{
    $ci = &get_instance();
    $ci->db->from('penjualan');
    $result = $ci->db->get()->num_rows();
    return $result;
}

function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}

function persen($jumlah, $persen)
{
    $hasil = (intval($jumlah) / 100) * intval($persen);

    return $hasil;
}
