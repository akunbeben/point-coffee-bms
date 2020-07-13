<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <link rel="STYLESHEET" href="<?= base_url('asset/static/'); ?>nota.css" type="text/css" />
  <title>Invoice - <?= $header->struk; ?></title>
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
                <p style="font-style: normal; font-family: Calibri; font-size: 6pt;"><?= date('d/m/Y H:i:s', strtotime($header->tanggal_transaksi)) . ' | ' . $header->kodetoko . ' | ' . $header->struk; ?></p>
              </td>
            </tr>
          </table>

          <table style="width: 100%; font-size: 6pt;">
            <tr>
              <td>No. Struk: <?= $header->struk; ?></td>
              <td style="text-align: right;">Kasir: <?= $header->nama; ?></td>
            </tr>

            <tr>
              <td><?= date('d/m/Y H:i:s', strtotime($header->tanggal_transaksi)); ?></td>
              <td style="text-align: right;"><?= $toko->kodetoko . ' - ' . $toko->nama_toko; ?></td>
            </tr>

            <tr>
            </tr>
          </table>
          <br>
          <br>
          <table class="change_order_items" style="font-family: Calibri; font-size: 6pt; border: 1px dotted; width: 100%;">
            <tbody>
              <tr>
                <th style="border-bottom: 1px dotted;">No</th>
                <th style="border-bottom: 1px dotted;">Item</th style="border-bottom: 1px dotted;">
                <th style="border-bottom: 1px dotted;">Jumlah</th style="border-bottom: 1px dotted;">
                <th style="border-bottom: 1px dotted;">Harga</th style="border-bottom: 1px dotted;">
              </tr>

              <?php $no = 1;
              foreach ($lines as $line) : ?>
                <tr class="even_row">
                  <td style="text-align: center; "><?= $no++; ?></td>
                  <td><?= $line->singkatan; ?></td>
                  <td style="text-align: center; "><?= $line->quantity; ?></td>
                  <td style="text-align: right; "><?= rupiah($line->harga); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

          <p style="text-align: right; font-family: Calibri; font-size: 6pt;">Total: <?= rupiah($header->total_belanja); ?></p>
          <p style="text-align: right; font-family: Calibri; font-size: 6pt; margin-top: -15px; border-bottom: 1px dotted;">Bayar: <?= rupiah($header->total_bayar); ?></p>
          <p style="text-align: right; font-family: Calibri; font-size: 6pt;">Kembali: <?= rupiah($header->kembalian); ?></p>
          <br>
          <br>

          <p style="text-align: center; font-size: 6pt; font-family: Calibri;">Terimakasih telah berbelanja di tempat kami.</p>

        </div>

      </div>
    </div>

  </div>

</body>

</html>