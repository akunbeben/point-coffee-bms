<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="float-left">
      <h6 class="m-0 font-weight-bold text-primary">Data Proses Barang</h6>
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
      <div class="modal-footer">
        <button type="button" id="btnProses" class="btn btn-primary">Proses Sekarang</button>
      </div>
    </div>
  </div>
</div>