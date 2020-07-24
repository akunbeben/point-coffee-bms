<div class="card shadow mb-4">
  <div class="card-header">
    <div class="row">
      <div class="col-md-6 mt-2">
        <h6 class="m-0 font-weight-bold text-primary">Data Pendapatan Pertoko</h6>
      </div>
    </div>
  </div>
  <div class="card-body">
    <form action="" method="post">
      <div class="row">
        <div class="col-md-2">
          <div class="form-group">
            <label for="tanggal_awal">Tanggal Awal</label>
            <input type="date" class="form-control form-control-sm" id="tanggal_awal" name="tanggal_awal" value="<?= $periode['tanggal_awal'] != null ? $periode['tanggal_awal'] : null; ?>">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label for="tanggal_akhir">Tanggal Akhir</label>
            <input type="date" class="form-control form-control-sm" id="tanggal_akhir" name="tanggal_akhir" value="<?= $periode['tanggal_akhir'] != null ? $periode['tanggal_akhir'] : null; ?>">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="filter_toko">Toko</label>
            <select name="filter_toko" id="filter_toko" class="form-control form-control-sm">
              <option value="">-- Pilih Toko --</option>
              <?php foreach ($stores as $toko) : ?>
                <option value="<?= $toko->idtoko; ?>" <?= $periode['filter_toko'] == $toko->idtoko ? 'selected' : ''; ?>><?= $toko->nama_toko; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="filter_supplier">Supplier</label>
            <select name="filter_supplier" id="filter_supplier" class="form-control form-control-sm">
              <option value="">-- Pilih Supplier --</option>
              <?php foreach ($suppliers as $supplier) : ?>
                <option value="<?= $supplier->supplier; ?>" <?= $periode['filter_supplier'] == $supplier->supplier ? 'selected' : ''; ?>><?= $supplier->supplier; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="col-md-2 text-center" style="margin-top: 31.5px;">
          <button class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Filter</button>
          <button type="button" class="btn btn-primary btn-sm" onclick="submitFilter()"><i class="fas fa-print"></i> Print</button>
        </div>
      </div>
    </form>
    <form action="<?= base_url('laporan/print-pengeluaran-pertoko'); ?>" method="post" id="formFilter" target="_blank">
      <input type="hidden" name="filter_awal" value="<?= $periode['tanggal_awal']; ?>">
      <input type="hidden" name="filter_akhir" value="<?= $periode['tanggal_akhir']; ?>">
      <input type="hidden" name="toko" value="<?= $periode['filter_toko']; ?>">
      <input type="hidden" name="supplier" value="<?= $periode['filter_supplier']; ?>">
    </form>
    <hr>
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered dataitems table-sm" id="Datatable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No.</th>
                <th>Supplier</th>
                <th>Kode Permintaan</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Toko</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($data as $key) : ?>
                <tr>
                  <td class="text-center"><?= $no++; ?></td>
                  <td><?= $key->supplier; ?></td>
                  <td><?= $key->kodepermintaan; ?></td>
                  <td><?= date('d F Y H:i:s', strtotime($key->tanggal_terima)); ?></td>
                  <td><?= rupiah($key->total); ?></td>
                  <td><?= $key->nama_toko; ?></td>
                  <td class="text-center">
                    <button class="btn btn-primary btn-sm" title="Detail"><i class="fas fa-eye"></i></button>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>