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
            <input type="date" class="form-control form-control-sm" id="tanggal_awal" name="tanggal_awal">
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label for="tanggal_akhir">Tanggal Akhir</label>
            <input type="date" class="form-control form-control-sm" id="tanggal_akhir" name="tanggal_akhir">
          </div>
        </div>
        <div class="col-md-2 text-center" style="margin-top: 31.5px;">
          <button class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Filter</button>
          <button type="button" class="btn btn-primary btn-sm" onclick="submitFilter()"><i class="fas fa-print"></i> Print</button>
        </div>
      </div>
    </form>
    <form action="<?= base_url('laporan/print-data-retur'); ?>" method="post" id="formFilter" target="_blank">
      <input type="hidden" name="tanggal_awal" value="<?= $periode['tanggal_awal']; ?>">
      <input type="hidden" name="tanggal_akhir" value="<?= $periode['tanggal_akhir']; ?>">
    </form>
  </div>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="float-left">
      <h6 class="m-0 font-weight-bold text-primary">Bukti Retur Barang</h6>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered dataitems table-sm" id="Datatable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No.</th>
            <th>Kode Retur</th>
            <th>Tanggal Retur</th>
            <th>Supplier</th>
            <th>Jumlah Item</th>
            <th>Dibuat Oleh</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $number = 1; ?>
          <?php foreach ($data as $item) : ?>
            <tr>
              <td class="text-center"><?= $number++; ?></td>
              <td><?= $item->kode_retur; ?></td>
              <td><?= date('d M Y H:i:s', strtotime($item->tanggal_retur)); ?></td>
              <td><?= $item->supco . ' - ' . $item->nama_supplier; ?></td>
              <td><?= $item->jumlah_item; ?></td>
              <td><?= $item->dibuat_oleh; ?></td>
              <td class="text-center">
                <?php if ($item->jumlah_item != null) : ?>
                  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detailItemModal" onclick="initNewDatatable('<?= base_url('inventory/data-retur-json/' . $item->kode_retur); ?>')" title="Detail"><i class="fas fa-eye"></i></button>
                  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onclick="window.location.href = '<?= base_url('laporan/retur-barang/' . $item->kode_retur); ?>'" title="Print"><i class="fas fa-print"></i></button>
                <?php endif; ?>
                <?php if ($item->jumlah_item == null) : ?>
                  <button class="btn btn-warning btn-sm" onclick="editRetur('<?= base_url('inventory/form-retur/' . $item->kode_retur); ?>')" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="detailItemModal" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="detailItemModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title font-weight-bold text-primary" id="detailItemModalLabel">Detail Request: </h6>
        <button type="button" class="close" id="btnDetailClose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered table-sm" id="newDatatable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Item</th>
                <th>Jumlah</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>