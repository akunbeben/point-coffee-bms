<div class="row">
  <div class="col-md-6">
    <?= $this->session->flashdata('initial'); ?>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tutup Shift</h6>
      </div>

      <div class="card-body">
        <p class="text-danger m-0">* Apakah anda yakin untuk menutup shift ?</p>
        <p class="text-danger">* Pastikan modal sudah terpisah.</p>
        <div class="text-right">
          <button class="btn btn-primary" type="button" onclick="toogleForm()" id="openForm">Tutup Shift</button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6" id="formTutupShift" style="display: none;">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail</h6>
      </div>

      <div class="card-body">
        <form action="" method="post" id="form-tutup-shift">
          <div class="form-group">
            <label for="pendapatan">Total Pendapatan</label>
            <input type="text" class="form-control" id="pendapatan" name="pendapatan">
          </div>
          <div class="row justify-content-end">
            <button type="button" id="submit-button" onclick="submitConfirmation()" class="btn btn-success">Proses</button>&nbsp;
            <button type="reset" class="btn btn-warning">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>