<div class="card shadow mb-4">
  <div class="card-header">
    <div class="row">
      <div class="col-md-6 mt-2">
        <h6 class="m-0 font-weight-bold text-primary">Data Konversi</h6>
      </div>
      <div class="col-md-6 text-right">
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#returFormModal">Konversi Bahan Baku</button>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-5">
        <form action="" method="post" class="text-right">
          <div class="form-group row">
            <label for="filter_day" class="col-sm-4 col-form-label">Data Perhari : </label>
            <div class="col-md-8">
              <div class="input-group input-group-sm">
                <input type="date" name="filter_day" id="filter_day" class="form-control form-control-sm" value="<?= $filter_day != null ? $filter_day : null; ?>">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-5 text-right">
        <form action="" method="post" class="text-right">
          <div class="form-group row">
            <label for="filter_month" class="col-sm-4 col-form-label">Data Perbulan : </label>
            <div class="col-md-8">
              <div class="input-group input-group-sm">
                <select name="filter_month" id="filter_month" class="form-control form-control-sm">
                  <?php foreach ($data_bulan as $bulan) : ?>
                    <option value="<?= $bulan->bulan; ?>" <?= date('n', strtotime($current_period->bulan)) == $bulan->bulan_angka ? 'selected' : null; ?>><?= $bulan->bulan_nama; ?></option>
                  <?php endforeach; ?>
                </select>
                <div class="input-group-append">
                  <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-2 text-center">
        <form action="<?= base_url('laporan/print-data-konversi'); ?>" method="post" target="_blank">
          <input type="hidden" name="tanggal_awal" value="<?= $filter_data['tanggal_awal']; ?>">
          <input type="hidden" name="tanggal_akhir" value="<?= $filter_data['tanggal_akhir']; ?>">
        </form>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered dataitems table-sm" id="Datatable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No.</th>
                <th>Item</th>
                <th>Jumlah</th>
                <th>Tanggal Konversi</th>
                <th>Dikonversi oleh</th>
              </tr>
            </thead>
            <tbody>
              <?php $number = 1;
              foreach ($data as $item) : ?>
                <tr>
                  <td class="text-center"><?= $number++; ?></td>
                  <td><?= $item->prdcd . ' - ' . $item->nama_item; ?></td>
                  <td><?= $item->jumlah; ?></td>
                  <td><?= date('d M Y H:i:s', strtotime($item->tanggal_konversi)); ?></td>
                  <td><?= $item->konversi_oleh; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="returFormModal" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="returFormModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title font-weight-bold text-primary" id="returFormModalLabel">Form Konversi</h6>
        <button type="button" class="close" id="btnClose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="form-group row">
            <label for="prdcd" class="col-sm-4 col-form-label">PLU Product</label>
            <div class="col-md-8">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                </div>
                <select name="prdcd" id="prdcd" class="form-control">
                  <option value="">Pilih item.</option>
                  <?php foreach ($stock as $items) : ?>
                    <option value="<?= $items->prdcd; ?>"><?= $items->prdcd . ' - ' . $items->deskripsi; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlah" class="col-sm-4 col-form-label">Jumlah</label>
            <div class="col-md-4">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">Qty</div>
                </div>
                <input type="text" id="jumlah" name="jumlah" class="form-control">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id="btnSubmit" class="btn btn-primary">Konversi</button>
        </div>
      </form>
    </div>
  </div>
</div>