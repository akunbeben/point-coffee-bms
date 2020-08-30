<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <link rel="STYLESHEET" href="<?= base_url('asset/static/'); ?>nota.css" type="text/css" />
  <title>SLIP PROSES BARANG</title>
</head>

<body>

  <div id="body" style="width: 57mm;">
    <div id="print-area">

      <div id="section_header">
      </div>

      <div id="content">

        <div class="page">
          <table style="width: 100%;">
            <tr>
              <td>
                <p style="font-style: normal; font-family: Calibri; font-size: 3pt;">PT. Indomarco Prismatama</p>
                <p style="font-style: normal; font-family: Calibri; font-size: 3pt;">JL ANCOL I/9-10 ANCOL</p>
                <p style="font-style: normal; font-family: Calibri; font-size: 3pt;">BARAT-JAKARTA UTARA</p>
                <p style="font-style: normal; font-family: Calibri; font-size: 3pt;">NPWP 01 337 994 6-092 000</p>
              </td>
              <td style="text-align: right;">
                <img src="<?= base_url('asset/img/' . 'idm.png'); ?>" alt="Logo" width="50">
              </td>
            </tr>
          </table>
          <table style="width: 100%;" class="header">
            <tr>
              <td style="text-align: center;">
                <br>
                <p style="font-style: normal; font-family: Calibri; font-size: 6pt;"><?= $toko->kodetoko . ' ' . $toko->nama_toko . ' - ' . $toko->telp; ?></p>
                <p style="font-style: normal; font-family: Calibri; font-size: 6pt;"><?= $toko->alamat . ', ' . $toko->kota; ?></p>
              </td>
            </tr>
          </table>
          <div style="text-align: center; font-family: Calibri; font-size: 6pt; margin-bottom: -10px;">
            <p>SLIP PROSES BARANG</p>
          </div>
          <hr>
          <table style="width: 100%; font-size: 6pt;">
            <tr>
              <td>Tanggal Terima:</td>
              <td style="text-align: right;"><?= date('d M Y H:i:s', strtotime($header->tanggal_terima)); ?></td>
            </tr>
            <tr>
              <td>Supplier:</td>
              <td style="text-align: right;"><?= $header->supplier; ?></td>
            </tr>
            <tr>
              <td>No. Surat Jalan:</td>
              <td style="text-align: right;"><?= $header->surat_jalan; ?></td>
            </tr>
          </table>
          <hr>
          <div style="text-align: center; font-family: Calibri; font-size: 6pt;">
            <p>BUKTI PEMPROSESAN DATA</p>
          </div>
          <table class="change_order_items" style="font-family: Calibri; font-size: 6pt; border: 1px dotted; width: 100%;">
            <tbody>
              <tr>
                <th style="border-bottom: 1px dotted;">No</th>
                <th style="border-bottom: 1px dotted;">PLU</th>
                <th style="border-bottom: 1px dotted;">Harga Pcs</th>
                <th style="border-bottom: 1px dotted; text-align: right;">Jumlah Item</th>
                <th style="border-bottom: 1px dotted; width: 70px;">Total</th style="border-bottom: 1px dotted;">
              </tr>

              <?php $no = 1;
              foreach ($lines as $line) : ?>
                <tr class="even_row">
                  <td style="text-align: center; "><?= $no++; ?></td>
                  <td><?= $line->prdcd . ' - ' . $line->deskripsi; ?></td>
                  <td style="text-align: right; width: 70px;"><?= rupiah($line->harga); ?></td>
                  <td style="text-align: center; "><?= $line->jumlah; ?></td>
                  <td style="text-align: center; "><?= rupiah($line->total); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <table class="change_order_items" style="font-family: Calibri; font-size: 6pt; border: 1px dotted; width: 100%;">
            <thead>
              <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td colspan="2">Total</td>
                <td style="text-align: right; padding-right: 10px;"><?= $header->total_barang; ?></td>
                <td style="text-align: right; width: 70px;"><?= rupiah($header->total); ?></td>
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
                  <p style="font-family: Calibri; font-size: 6; margin-bottom: 0px;">Penerima</p>
                  ________
                </td>
                <td style="text-align: center;">
                  <p style="font-family: Calibri; font-size: 6; margin-bottom: 0px;">Supplier</p>
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