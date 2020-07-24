<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <link rel="STYLESHEET" href="<?= base_url('asset/static/'); ?>nota.css" type="text/css" />
  <title>LAPORAN PENGELUARAN : <?= $toko != null ? $toko->kodetoko . ' - ' . $toko->nama_toko : 'Overall'; ?></title>
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
                <p style="font-style: normal; font-family: Calibri; font-size: 10pt;"><?= $toko != null ? $toko->kodetoko . ' ' . $toko->nama_toko . ' - ' . $toko->telp : 'PT. Indomarco Prismatama - 0511 6746 181'; ?></p>
                <p style="font-style: normal; font-family: Calibri; font-size: 10pt;"><?= $toko != null ? $toko->alamat . ', ' . $toko->kota : 'JL. A YANI KM 12.2, Gambut, Kab.Banjar, Kode Pos 70652'; ?></p>
              </td>
            </tr>
          </table>
          <div style="text-align: center; font-family: Calibri; font-size: 10pt; margin-bottom: -10px;">
            <p>LAPORAN PENGELUARAN : <strong><?= $toko != null ? $toko->kodetoko . ' - ' . $toko->nama_toko : 'OVERALL'; ?></strong></p>
            <p>PERIODE : <?= $periode['tanggal_awal'] && $periode['tanggal_akhir'] != null ? date('d F Y', strtotime($periode['tanggal_awal'])) . ' - ' . date('d F Y', strtotime($periode['tanggal_akhir'])) : null; ?></p>
          </div>
          <hr>
          <br>
          <table class="change_order_items" style="font-family: Calibri; font-size: 10pt; border: 1px dotted; width: 100%;">
            <tbody>
              <tr>
                <th style="border-bottom: 1px dotted; text-align: center; width: 20px;">No</th>
                <th style="border-bottom: 1px dotted; text-align: center;">Periode</th>
                <th style="border-bottom: 1px dotted; text-align: center;">Total</th>
                <th style="border-bottom: 1px dotted; text-align: center;">Toko</th>
              </tr>

              <?php
              $no = 1;
              $grand_total = intval(0);
              foreach ($lines as $line) : ?>
                <tr>
                  <td style="text-align: center; "><?= $no++; ?></td>
                  <td style="text-align: center;"><?= $line->periode; ?></td>
                  <td style="text-align: right;"><?= rupiah($line->total); ?></td>
                  <td style="text-align: center;"><?= $line->nama_toko; ?></td>
                  <?php
                  $grand_total = $grand_total + $line->total;
                  ?>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <td style="text-align: center; border-top: 1px dotted;" colspan="2">Grand Total : </td>
                <td style="text-align: right; border-top: 1px dotted;"><?= rupiah($grand_total); ?></td>
                <td style="text-align: center; border-top: 1px dotted;"></td>
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
                  <p style="font-family: Calibri; font-size: 10pt;">Admin</p>
                </td>
                <td style="text-align: center;">
                  <p style="font-family: Calibri; font-size: 10pt;">Diketahui</p>
                  <br>
                  <br>
                  <br>
                  ___________________
                  <p style="font-family: Calibri; font-size: 10pt;">Deputy Branch Mgr.</p>
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