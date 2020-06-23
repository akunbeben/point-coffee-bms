<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Permintaan Barang</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="float-left mt-2">
      <h6 class="m-0 font-weight-bold text-primary">Data Permintaan Barang</h6>
    </div>
    <div class="float-right">
      <?php if ($this->session->userdata('x-idm-store') != 1) : ?>
        <a class="btn btn-primary" href="<?= base_url('stock/permintaan-barang-baru') ?>">
          <i class="fas fa-plus"></i> Buat Permintaan Barang
        </a>
      <?php endif; ?>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered dataitems" id="Datatable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Supplier</th>
            <th>Kode Permintaan</th>
            <th>Tanggal Permintaan</th>
            <th>Diminta Oleh</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($permintaan as $req) : ?>
            <tr>
              <td><?= $req->supco . ' - ' . $req->nama_supplier; ?></td>
              <td><?= $req->kodepermintaan; ?></td>
              <td><?= date('d M Y H:i:s', strtotime($req->tanggal)); ?></td>
              <td><?= $req->nama; ?></td>
              <td>
                <?= $req->status == 28 ? '<span class="badge badge-secondary">Draft</span>' : ($req->status == 29 ? '<span class="badge badge-warning">Pending</span>' : ($req->status == 30 ? '<span class="badge badge-success">Approved</span>' : ($req->status == 31 ? '<span class="badge badge-danger">Rejected</span>' : null))); ?>
              </td>
              <td class="text-center" style="max-width: 50px;">
                <?php if ($this->session->userdata('x-idm-store') == 1) : ?>
                  <?php if ($req->status == 29) : ?>
                    <button type="button" onclick="initNewDatatable('<?= base_url('stock/get-item-json/' . $req->kodepermintaan); ?>')" data-toggle="modal" data-target="#detailpermintaanModal" class="btn btn-success btn-sm" title="Show detail"><i class="fas fa-eye"></i></button>
                  <?php endif; ?>
                <?php endif; ?>
                <?php if ($this->session->userdata('x-idm-store') != 1) : ?>
                  <?php if ($req->status == 28) : ?>
                    <button class="btn btn-warning btn-sm" type="button" onclick="editData('<?= base_url('stock/form-permintaan-barang/') . $req->kodepermintaan; ?>')" title="Edit Data">
                      <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" type="button" onclick="deleteData('<?= base_url('stock/hapus-permintaan-barang/') . $req->kodepermintaan; ?>', '<?= $req->kodepermintaan; ?>')" title="Hapus Data">
                      <i class="fas fa-trash"></i>
                    </button>
                  <?php endif; ?>
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
        <button type="button" id="btnReject" class="btn btn-danger">Reject</button>
        <button type="button" id="btnApprove" class="btn btn-primary">Approve</button>
      </div>
    </div>
  </div>
</div>