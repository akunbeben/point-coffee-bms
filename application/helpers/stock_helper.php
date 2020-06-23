<?php

function RequestForm($num)
{
  $num = $num + 1;
  switch (strlen($num)) {
    case 1:
      $NoTrans = "RF000000" . $num;
      break;
    case 2:
      $NoTrans = "RF00000" . $num;
      break;
    case 3:
      $NoTrans = "RF0000" . $num;
      break;
    case 4:
      $NoTrans = "RF000" . $num;
      break;
    case 5:
      $NoTrans = "RF00" . $num;
      break;
    case 6:
      $NoTrans = "RF0" . $num;
      break;

    default:
      $NoTrans = $num;
  }
  return $NoTrans;
}

function SequenceNumber()
{
  $ci = &get_instance();
  $ci->db->from('permintaan_barang');
  $result = $ci->db->get()->num_rows();
  return $result;
}