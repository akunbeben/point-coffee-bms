<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <link rel="STYLESHEET" href="<?= base_url('asset/static/'); ?>nota.css" type="text/css" />
  <title>Tutup Shift</title>
</head>

<body>

  <div id="body" style="width: 57mm;">
    <div id="print-area">

      <div id="section_header">
      </div>

      <div id="content">

        <div class="page">
          <table style="width: 100%;" class="header">
            <tr>
              <td style="text-align: center;">
                <p style="font-style: normal; font-family: Calibri; font-size: 6pt;"><?= $toko->kodetoko . ' ' . $toko->nama_toko . ' - ' . $toko->telp; ?></p>
                <p style="font-style: normal; font-family: Calibri; font-size: 6pt;"><?= $toko->alamat . ', ' . $toko->kota; ?></p>
              </td>
            </tr>
          </table>
          <div style="text-align: center; font-family: Calibri; font-size: 6pt; margin-bottom: -10px;">
            <p>SLIP PENJUALAN TUTUP SHIFT</p>
          </div>
          <hr>
          <table style="width: 100%; font-size: 6pt;">
            <tr>
              <td>Laporan Penjualan Shift No: <?= $data->shift; ?></td>
              <td style="text-align: right;"><?= date('d m Y H:i:s', strtotime($data->tanggal_tutup_shift)); ?></td>
            </tr>
          </table>
          <table class="change_order_items" style="font-family: Calibri; font-size: 6pt; width: 100%;">
            <tbody>
              <tr>
                <th></th>
                <th></th>
                <th></th>
              </tr>
              <tr>
                <td>Total Sales</td>
                <td style="text-align: left;">:</td>
                <td style="text-align: right;"><?= rupiah($data->total); ?></td>
              </tr>
              <tr>
                <td>PPN</td>
                <td style="text-align: left;">:</td>
                <td style="text-align: right;"><?= rupiah($data->ppn); ?></td>
              </tr>
            </tbody>
          </table>
          <hr>
          <table style="font-family: Calibri; font-size: 6pt; width: 100%;">
            <tbody>
              <tr>
                <th></th>
                <th></th>
                <th></th>
              </tr>
              <tr>
                <td style="text-align: left;" colspan="2">SALES + PPN:</td>
                <td style="text-align: right;"><?= rupiah($data->ppn + $data->total); ?></td>
              </tr>
            </tbody>
          </table>
          <hr>
          <table style="font-family: Calibri; font-size: 6pt; width: 100%;">
            <tbody>
              <tr>
                <th></th>
                <th></th>
                <th></th>
              </tr>
              <tr>
                <td style="text-align: left;" colspan="2">Actual Kas</td>
                <td style="text-align: right;"><?= rupiah($data->kas); ?></td>
              </tr>
            </tbody>
          </table>
          <table class="change_order_items" style="font-family: Calibri; font-size: 6pt; width: 100%;">
            <tbody>
              <tr>
                <th></th>
                <th></th>
                <th></th>
              </tr>
              <tr>
                <td>Pergantian</td>
                <td style="text-align: left;">:</td>
                <td style="text-align: right;"><?= rupiah($data->pergantian); ?></td>
              </tr>
              <tr>
                <td>Variance</td>
                <td style="text-align: left;">:</td>
                <td style="text-align: right;"><?= rupiah($data->variance); ?></td>
              </tr>
            </tbody>
          </table>
          <hr>
          <table class="change_order_items" style="font-family: Calibri; font-size: 6pt; width: 100%;">
            <tbody>
              <tr>
                <th></th>
                <th></th>
                <th></th>
              </tr>
              <tr>
                <td>KAS</td>
                <td style="text-align: left;">:</td>
                <td style="text-align: right;"><?= rupiah(($data->kas - $data->variance) + $data->pergantian); ?></td>
              </tr>
            </tbody>
          </table>
          <hr>
          <table class="change_order_items" style="font-family: Calibri; font-size: 6pt; width: 100%;">
            <tbody>
              <tr>
                <th></th>
                <th></th>
                <th></th>
              </tr>
              <tr>
                <td>Total Customer</td>
                <td style="text-align: left;">:</td>
                <td style="text-align: right;"><?= $data->jumlah_struk; ?></td>
              </tr>
              <tr>
                <td>Total Qty</td>
                <td style="text-align: left;">:</td>
                <td style="text-align: right;"><?= $data->jumlah_item; ?></td>
              </tr>
            </tbody>
          </table>
          <hr>
          <br>
          <br>
          <br>
          <table style="width: 100%;">
            <tbody>
              <tr style="justify-content: space-between;">
                <td style="text-align: center;">
                  <p style="font-family: Calibri; font-size: 6; margin-bottom: 0px;"><?= $barista->nama; ?></p>
                  ________
                </td>
                <td style="text-align: center;">
                  <p style="font-family: Calibri; font-size: 6; margin-bottom: 0px;"><?= $toko->ka_toko; ?></p>
                  ________
                </td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>
    </div>

  </div>

</body>

</html>