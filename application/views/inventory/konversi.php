<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="float-left mt-2">
      <h6 class="m-0 font-weight-bold text-primary">Data Konversi</h6>
    </div>
    <div class="float-right">
      <button class="btn btn-primary" data-toggle="modal" data-target="#returFormModal">Konversi Bahan Baku</button>
    </div>
  </div>
  <div class="card-body">
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