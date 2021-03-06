<div class="row">
  <div class="col-md-8">
    <div class="card shadow mb-4">
      <div class="card-header">
        <div class="float-left">
          <h6 class="m-0 font-weight-bold text-primary">Buat Permintaan Baru</h6>
        </div>
        <div class="float-right">
        </div>
      </div>
      <form action="" method="post">
        <div class="card-body">
          <div class="form-group row">
            <label for="kategori" class="col-sm-4 col-form-label">Kategori</label>
            <div class="col-md-8">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-archive"></i></div>
                </div>
                <select class="form-control" id="kategori" name="kategori" required>
                  <option value="">Pilih kategori bahan baku</option>
                  <?php foreach ($kategori as $ktgr) : ?>
                    <option value="<?= $ktgr->id; ?>"><?= $ktgr->desc; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer text-right">
          <button type="submit" class="btn btn-primary">Buat</button>
        </div>
      </form>
    </div>
  </div>
</div>