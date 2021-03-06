<div class="row">
  <div class="col-md-12">
    <div class="card shadow">
      <div class="card-header">
        <div class="row">
          <div class="col-md-6 mt-1">
            <h6 class="m-0 font-weight-bold text-primary">Pendapatan Overall</h6>
          </div>
          <div class="col-md-6 text-right">
            <div class="btn-group" role="group">
              <button id="btnGroupDrop1" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-download"></i> Export Recap
              </button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item" href="#" onclick="submitFilter()">PDF</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <form action="<?= base_url('laporan/print-pendapatan-pertoko'); ?>" method="post" id="formFilter" target="_blank" style="display: none;">
        <input type="hidden" name="filter_awal" value="<?= $periode['tanggal_awal']; ?>">
        <input type="hidden" name="filter_akhir" value="<?= $periode['tanggal_akhir']; ?>">
        <input type="hidden" name="toko" value="<?= $periode['filter_toko']; ?>">
      </form>
      <div class="card-body">
        <canvas id="chartPendapatan">

        </canvas>
      </div>
    </div>
  </div>
</div>