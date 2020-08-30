<div class="card shadow mb-4">
  <div class="card-header">
    <h6 class="m-0 font-weight-bold text-primary">Filter Data</h6>
  </div>
  <div class="card-body">
    <form action="" method="post">
      <div class="row">
        <div class="col-md-5">
          <div class="form-group">
            <label for="tanggal_awal">Tanggal Awal</label>
            <input type="date" class="form-control form-control-sm" id="tanggal_awal" name="tanggal_awal" value="<?= $this->input->post('tanggal_awal'); ?>">
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label for="tanggal_akhir">Tanggal Akhir</label>
            <input type="date" class="form-control form-control-sm" id="tanggal_akhir" name="tanggal_akhir" value="<?= $this->input->post('tanggal_akhir'); ?>">
          </div>
        </div>
        <div class="col-md-2 text-center" style="margin-top: 31.5px;">
          <button class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Filter</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="float-left">
      <h6 class="m-0 font-weight-bold text-primary">Bukti Penerimaan Barang</h6>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered dataitems table-sm" id="Datatable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Surat Jalan</th>
            <th>Supplier</th>
            <th>Kode Permintaan</th>
            <th>Jumlah Barang</th>
            <th>Tanggal Terima</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($barang as $stuff) : ?>
            <tr>
              <td><?= $stuff->surat_jalan == null ? '-' : $stuff->surat_jalan; ?></td>
              <td><?= $stuff->supplier; ?></td>
              <td><?= $stuff->kodepermintaan; ?></td>
              <td><?= $stuff->jumlah_barang; ?> Item</td>
              <td><?= $stuff->tanggal_terima == null ? '-' : date('d M Y H:i:s', strtotime($stuff->tanggal_terima)); ?></td>
              <td><?= $stuff->desc; ?></td>
              <td class="text-center">
                <?php if ($stuff->status != 35) : ?>
                  <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detailpermintaanModal" onclick="initNewDatatable('<?= base_url('stock/get-item-json/' . $stuff->kodepermintaan); ?>')" title="Proses"><i class="fas fa-recycle"></i></button>
                <?php elseif ($stuff->status == 35) : ?>
                  <button id="detailButton" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detailpermintaanModal" onclick="initNewDatatable('<?= base_url('stock/get-item-json/' . $stuff->kodepermintaan); ?>'); showDetail();" title="Detail"><i class="fas fa-eye"></i></button>
                  <button class="btn btn-sm btn-primary" title="Print" onclick="window.location.href = '<?= base_url('laporan/proses-barang/') . $stuff->surat_jalan; ?>'"><i class="fas fa-print"></i></button>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="detailpermintaanModal" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="detailpermintaanModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title font-weight-bold text-primary" id="detailpermintaanModalLabel">Detail Request: </h6>
        <button type="button" class="close" id="btnClose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered table-sm" id="newDatatable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Item</th>
                <th>Harga</th>
                <th>Kategori</th>
                <th>Satuan</th>
                <th>Jumlah</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      <div class="modal-footer" id="modal-footer">
        <button type="button" id="btnProses" class="btn btn-primary">Proses Sekarang</button>
      </div>
    </div>
  </div>
</div>