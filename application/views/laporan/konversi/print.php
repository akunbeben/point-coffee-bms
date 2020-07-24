<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <link rel="STYLESHEET" href="<?= base_url('asset/static/'); ?>nota.css" type="text/css" />
  <title>LAPORAN KONVERSI BAHAN BAKU</title>
</head>

<body>

  <div id="body">
    <div id="print-area">

      <div id="section_header">
      </div>

      <div id="content">

        <div class="page">
          <table style="width: 100%;" class="header">
            <tr>
              <td style="text-align: center;">
                <p style="font-style: normal; font-family: Calibri; font-size: 10pt;"><?= $toko->kodetoko . ' ' . $toko->nama_toko . ' - ' . $toko->telp; ?></p>
                <p style="font-style: normal; font-family: Calibri; font-size: 10pt;"><?= $toko->alamat . ', ' . $toko->kota; ?></p>
              </td>
            </tr>
          </table>
          <div style="text-align: center; font-family: Calibri; font-size: 10pt; margin-bottom: -10px;">
            <p>LAPORAN KONVERSI BAHAN BAKU PERIODE : <?= date('F Y', strtotime($this->input->post('filter_month'))) != null ? date('F Y', strtotime($this->input->post('filter_month'))) : null; ?></p>
          </div>
          <hr>
          <br>
          <table class="change_order_items" style="font-family: Calibri; font-size: 10pt; border: 1px dotted; width: 100%;">
            <tbody>
              <tr>
                <th style="border-bottom: 1px dotted; text-align: center;">No</th>
                <th style="border-bottom: 1px dotted; text-align: left;">PLU</th>
                <th style="border-bottom: 1px dotted; text-align: left;">Nama Item</th>
                <th style="border-bottom: 1px dotted; text-align: center;">Jumlah</th>
                <th style="border-bottom: 1px dotted; text-align: center;">Tanggal Konversi</th>
                <th style="border-bottom: 1px dotted; text-align: left;">Dikonversi Oleh</th>
              </tr>

              <?php $no = 1;
              $total_jumlah = intval(0);
              foreach ($lines as $line) : ?>
                <tr>
                  <td style="text-align: center; "><?= $no++; ?></td>
                  <td style="text-align: left; "><?= $line->prdcd; ?></td>
                  <td style="text-align: left; "><?= $line->nama_item; ?></td>
                  <td style="text-align: center; ">
                    <?php

                    echo $line->jumlah;
                    $total_jumlah = $total_jumlah + $line->jumlah
                    ?>

                  </td>
                  <td style="text-align: center; "><?= $line->tanggal_konversi; ?></td>
                  <td style="text-align: left; "><?= $line->konversi_oleh; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <td style="text-align: center; border-top: 1px dotted;" colspan="3">Total Item : </td>
                <td style="text-align: center; border-top: 1px dotted;"><?= $total_jumlah; ?></td>
                <td style="text-align: center; border-top: 1px dotted;" colspan="3"></td>
              </tr>
            </tfoot>
          </table>
          <br>
          <br>
          <br>
          <table style="width: 100%;">
            <tbody>
              <tr style="justify-content: space-between;">
                <td style="text-align: center;">
                  <p style="font-family: Calibri; font-size: 10pt;">Dicetak Oleh</p>
                  <br>
                  <br>
                  <br>
                  ________________
                  <p style="font-family: Calibri; font-size: 10pt;"><?= $barista == null ? null : $barista->nama; ?></p>
                </td>
                <td style="text-align: center;">
                  <p style="font-family: Calibri; font-size: 10pt;">Diketahui</p>
                  <br>
                  <br>
                  <br>
                  ___________________
                  <p style="font-family: Calibri; font-size: 10pt;">Chief of Store/Assist.</p>
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