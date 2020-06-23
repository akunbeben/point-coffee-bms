<?php

function returCode($num)
{
  $num = $num + 1;
  switch (strlen($num)) {
    case 1:
      $NoTrans = "RET-BMS-00000" . $num;
      break;
    case 2:
      $NoTrans = "RET-BMS-0000" . $num;
      break;
    case 3:
      $NoTrans = "RET-BMS-000" . $num;
      break;
    case 4:
      $NoTrans = "RET-BMS-00" . $num;
      break;
    case 5:
      $NoTrans = "RET-BMS-0" . $num;
      break;
    case 6:
      $NoTrans = "RET-BMS-" . $num;
      break;

    default:
      $NoTrans = $num;
  }
  return $NoTrans;
}

function returSequence()
{
  $ci = &get_instance();
  $ci->db->from('retur_barang');
  $result = $ci->db->get()->num_rows();
  return $result;
}
