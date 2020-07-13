<div class="row" id="cardProses">
  <div class="col-md-12">
    <div class="card mb-4">
      <div class="card-header py-3">
        <div class="float-left">
          <h6 class="m-0 font-weight-bold text-primary">Form Retur Barang</h6>
        </div>
      </div>
      <div class="card-body">
        <form action="<?= base_url('inventory/tambah-item-retur/' . $header->kode_retur); ?>" method="post">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label for="productcode" class="col-sm-4 col-form-label">PLU Product</label>
                <div class="col-md-8">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                    </div>
                    <select name="productcode" id="productcode" class="form-control">
                      <option value="">Pilih item.</option>
                      <?php foreach ($items as $item) : ?>
                        <option value="<?= $item->prdcd; ?>"><?= $item->prdcd . ' - ' . $item->deskripsi; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group row">
                <div class="col-md-12">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Qty</div>
                    </div>
                    <input type="text" class="form-control" placeholder="jumlah" id="jumlah" name="jumlah">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <button type="submit" id="btnSubmit" class="btn btn-primary">Retur</button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
                <div class="col-md-8">
                  <textarea name="keterangan" class="form-control" id="keterangan" cols="1" rows="2"></textarea>
                </div>
              </div>
            </div>
          </div>
        </form>
        <hr>
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-bordered table-sm dataitems" id="Datatable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Item</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($lines as $line) : ?>
                    <tr>
                      <td><?= $line->prdcd . ' - ' . $line->nama_item; ?></td>
                      <td><?= $line->jumlah; ?> Item</td>
                      <td><?= $line->keterangan; ?></td>
                      <td class="text-center">
                        <button class="btn btn-sm btn-danger" onclick="hapusItem('<?= base_url('inventory/hapus-item-retur/' . $line->id . '/' . $header->kode_retur); ?>')"><i class="fas fa-trash-alt"></i></button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-md-12 text-right">
            <button onclick="prosesRetur('<?= base_url('inventory/proses-retur/' . $header->kode_retur); ?>')" class="btn btn-primary" <?= count($lines) == 0 ? 'disabled' : null; ?>>Proses Retur</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>