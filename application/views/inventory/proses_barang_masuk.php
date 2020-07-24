<div class="row">
  <div class="col-md-6">
    <div class="card mb-4">
      <div class="card-header py-3">
        <div class="float-left">
          <h6 class="m-0 font-weight-bold text-primary">Proses Barang Masuk</h6>
        </div>
      </div>
      <div class="card-body">
        <form action="" method="post" id="formSuratJalan" class="needs-validation">
          <input type="hidden" name="id" id="id" value="<?= $header->id; ?>">
          <div class="form-group row">
            <label for="surat_jalan" class="col-sm-4 col-form-label">No. Surat Jalan</label>
            <div class="col-md-8">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-truck"></i></div>
                </div>
                <input type="text" class="form-control" id="surat_jalan" name="surat_jalan" autocomplete="off" value="<?= $header->surat_jalan == null ? null : $header->surat_jalan; ?>">
              </div>
              <div class="invalid-feedback">
                Surat jalan harus diisi.
              </div>
            </div>
          </div>
          <div class="text-right">
            <button type="button" id="btnSubmit" class="btn btn-primary btn-sm" onclick="showData('<?= base_url('inventory/proses/'); ?>')">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row" id="cardProses">
  <div class="col-md-12">
    <div class="card mb-4">
      <div class="card-header py-3">
        <div class="float-left">
          <h6 class="m-0 font-weight-bold text-primary">Proses Item</h6>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <form action="<?= base_url('inventory/submit-item/' . $header->kodepermintaan); ?>" method="post">
              <div class="form-group row">
                <input type="hidden" name="suratJalan" id="suratJalan" value="<?= $header->surat_jalan; ?>">
                <label for="productcode" class="col-sm-4 col-form-label">PLU</label>
                <div class="col-md-8">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                    </div>
                    <select name="productcode" id="productcode" class="form-control">
                      <option value="">Pilih item.</option>
                      <?php foreach ($itemToCompare as $compare) : ?>
                        <option value="<?= $compare->id; ?>"><?= $compare->prdcd . ' - ' . $compare->nama_item; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-primary btn-sm">Input</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-bordered table-sm dataitems" id="Datatable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Item</th>
                    <th>Harga</th>
                    <th>Kategori</th>
                    <th>Satuan</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($lineItems != null) : ?>
                    <?php foreach ($lineItems as $line) : ?>
                      <tr>
                        <td><?= $line->prdcd . ' - ' . $line->nama_item; ?></td>
                        <td><?= rupiah($line->harga); ?></td>
                        <td><?= $line->ketegoriText; ?></td>
                        <td><?= $line->satuanText; ?></td>
                        <td><?= $line->jumlah; ?></td>
                        <td><?= rupiah($line->total); ?></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-md-12 text-right">
            <button onclick="selesaiProses('<?= base_url('inventory/selesaikan-proses/' . $header->surat_jalan); ?>')" class="btn btn-primary">Proses</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>