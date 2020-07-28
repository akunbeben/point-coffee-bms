<div class="row">
  <div class="col-md-8">
    <div class="card shadow mb-4">
      <div class="card-header">
        <div class="float-left">
          <h6 class="m-0 font-weight-bold text-primary">Proses Permintaan : <?= $header->kodepermintaan; ?></h6>
        </div>
        <div class="float-right">
        </div>
      </div>
      <form action="<?= base_url('stock/approve/') . $header->kodepermintaan; ?>" method="post">
        <div class="card-body">
          <div class="form-group row">
            <label for="supplier" class="col-sm-4 col-form-label">Supplier</label>
            <div class="col-md-8">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-archive"></i></div>
                </div>
                <select class="form-control" id="supplier" name="supplier" required>
                  <option value="">Pilih supplier</option>
                  <?php foreach ($supplier as $supply) : ?>
                    <option value="<?= $supply->id; ?>"><?= $supply->supco . ' - ' . $supply->nama_supplier; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer text-right">
          <button type="submit" class="btn btn-primary">Proses</button>
        </div>
      </form>
    </div>
  </div>
</div>