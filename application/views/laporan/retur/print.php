<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <link rel="STYLESHEET" href="<?= base_url('asset/static/'); ?>nota.css" type="text/css" />
  <title>NOTA RETUR BARANG</title>
</head>

<body>

  <div id="body">
    <div id="print-area">

      <div id="section_header">
      </div>

      <div id="content">

        <div class="page">
          <table style="width: 100%;">
            <tr>
              <td>
                <p style="font-style: normal; font-family: Calibri; font-size: 6pt;">PT. Indomarco Prismatama</p>
                <p style="font-style: normal; font-family: Calibri; font-size: 6pt;">JL ANCOL I/9-10 ANCOL</p>
                <p style="font-style: normal; font-family: Calibri; font-size: 6pt;">BARAT-JAKARTA UTARA</p>
                <p style="font-style: normal; font-family: Calibri; font-size: 6pt;">NPWP 01 337 994 6-092 000</p>
              </td>
              <td style="text-align: right;">
                <img src="<?= base_url('asset/img/' . 'idm.png'); ?>" alt="Logo" width="120">
              </td>
            </tr>
          </table>
          <table style="width: 100%;" class="header">
            <tr>
              <td style="text-align: center;">
                <br>
                <p style="font-style: normal; font-family: Calibri; font-size: 10pt;"><?= $toko->kodetoko . ' ' . $toko->nama_toko . ' - ' . $toko->telp; ?></p>
                <p style="font-style: normal; font-family: Calibri; font-size: 10pt;"><?= $toko->alamat . ', ' . $toko->kota; ?></p>
              </td>
            </tr>
          </table>
          <div style="text-align: center; font-family: Calibri; font-size: 10pt; margin-bottom: -10px;">
            <p>NOTA RETUR BARANG</p>
          </div>
          <hr>
          <table style="width: 100%; font-size: 10pt;">
            <tr>
              <td></td>
              <td style="text-align: right;">Tanggal Retur: <?= date('d M Y H:i:s', strtotime($header->tanggal_retur)); ?></td>
            </tr>
            <tr>
              <td></td>
              <td style="text-align: right;">Supplier: <?= $header->supco . ' - ' . $header->nama_supplier; ?></td>
            </tr>
            <tr>
              <td></td>
              <td style="text-align: right;">Kode Retur: <?= $header->kode_retur; ?></td>
            </tr>
          </table>
          <br>
          <table class="change_order_items" style="font-family: Calibri; font-size: 10pt; border: 1px dotted; width: 100%;">
            <tbody>
              <tr>
                <th style="border-bottom: 1px dotted; text-align: center;">No</th>
                <th style="border-bottom: 1px dotted; text-align: left;">PLU</th>
                <th style="border-bottom: 1px dotted; text-align: left;">Nama Item</th>
                <th style="border-bottom: 1px dotted; text-align: center;">Satuan</th>
                <th style="border-bottom: 1px dotted; text-align: center;">Jumlah</th>
                <th style="border-bottom: 1px dotted; text-align: left;">Keterangan</th>
              </tr>

              <?php $no = 1;
              foreach ($lines as $line) : ?>
                <tr>
                  <td style="text-align: center; "><?= $no++; ?></td>
                  <td style="text-align: left; "><?= $line->prdcd; ?></td>
                  <td style="text-align: left; "><?= $line->nama_item; ?></td>
                  <td style="text-align: center; "><?= $line->satuan; ?></td>
                  <td style="text-align: center; "><?= $line->jumlah; ?></td>
                  <td style="text-align: left; "><?= $line->keterangan; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <table class="change_order_items" style="font-family: Calibri; font-size: 10pt; border: 1px dotted; width: 100%;">
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
                <td colspan="3">Total</td>
                <td style="text-align: right; padding-right: 10px;"><?= $header->jumlah_item; ?></td>
              </tr>
            </tbody>
          </table>
          <br>
          <br>
          <br>
          <table style="width: 100%;">
            <tbody>
              <tr style="justify-content: space-between;">
                <td style="text-align: center;">
                  <p style="font-family: Calibri; font-size: 10pt;">Diterima</p>
                  <br>
                  <br>
                  <br>
                  ________________
                  <p style="font-family: Calibri; font-size: 10pt;"><?= $header->nama_supplier; ?></p>
                </td>
                <td style="text-align: center;">
                  <p style="font-family: Calibri; font-size: 10pt;">Diserahkan</p>
                  <br>
                  <br>
                  <br>
                  ________________
                  <p style="font-family: Calibri; font-size: 10pt;"><?= $header->dibuat_oleh; ?></p>
                </td>
                <td style="text-align: center;">
                  <p style="font-family: Calibri; font-size: 10pt;">Disetujui</p>
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