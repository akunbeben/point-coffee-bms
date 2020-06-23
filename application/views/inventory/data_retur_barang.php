<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="float-left mt-2">
      <h6 class="m-0 font-weight-bold text-primary">Data Barang Retur</h6>
    </div>
    <div class="float-right">
      <button class="btn btn-primary" data-toggle="modal" data-target="#returFormModal">Retur Barang</button>
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
                <button class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></button>
              </td>
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
        <h6 class="modal-title font-weight-bold text-primary" id="returFormModalLabel">Retur Barang</h6>
        <button type="button" class="close" id="btnClose" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="form-group row">
            <label for="supplier" class="col-sm-4 col-form-label">Supplier</label>
            <div class="col-md-8">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-truck"></i></div>
                </div>
                <select name="supplier" id="supplier" class="form-control">
                  <option value="">Pilih supplier.</option>
                  <?php foreach ($supplier as $supply) : ?>
                    <option value="<?= $supply->id; ?>"><?= $supply->supco . ' - ' . $supply->nama_supplier; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>