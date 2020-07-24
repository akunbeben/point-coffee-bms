<h1 class="h3 mb-2 text-gray-800">Form Permintaan Barang</h1>
<div class="row justify-content-center">
  <div class="col-md-12">
    <div class="card shadow mb-4">
      <div class="card-header">
        <div class="row">
          <div class="col-md-6 text-left">
            <h6 class="m-0 font-weight-bold text-primary mt-2"><i class="fas fa-paste"></i> Request ID:
              <?= $header->kodepermintaan . ' | ' . $header->supco . ' - ' . $header->nama_supplier; ?>
            </h6>
          </div>
          <div class="col-md-6 text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#permintaanModal"><i class="fas fa-plus"></i> Tambah Item</button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table table-responsive">
          <table class="table table-hovered dataitems" id="Datatable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Item</th>
                <th>Harga</th>
                <th>Kategori</th>
                <th>Satuan</th>
                <th>Jumlah</th>
                <th style="max-width: 50px;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($line as $req) : ?>
                <tr>
                  <td><?= $req->prdcd . ' - ' . $req->nama_item; ?></td>
                  <td><?= rupiah($req->harga); ?></td>
                  <td><?= $req->ketegoriText; ?></td>
                  <td><?= $req->satuanText; ?></td>
                  <td><?= $req->jumlah; ?></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-primary btn-sm" title="Koreksi item" data-toggle="modal" onclick="getItem('<?= base_url('stock/get-item/' . $req->id); ?>')" data-target="#updatePermintaanModal"><i class="fas fa-pencil-alt"></i>
                    </button>
                    <a class="btn btn-danger btn-sm" title="Hapus item" href="<?= base_url('stock/hapusItem/' . $req->id . '/' . $header->kodepermintaan); ?>"><i class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer text-right">
        <button type="button" onclick="prosesPermintaan('<?= base_url('stock/proses-permintaan/' . $header->kodepermintaan); ?>')" class="btn btn-success" <?= count($line) == 0 ? 'disabled' : null; ?>><i class="fas fa-paper-plane"></i>
          Proses
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="permintaanModal" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="permintaanModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="permintaanModalLabel">Tambah Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" id="formPermintaan">
        <div class="modal-body">
          <input type="hidden" name="kodepermintaan" value="<?= $header->kodepermintaan; ?>">
          <div class="form-group row">
            <label for="prdcd" class="col-sm-4 col-form-label">PLU</label>
            <div class="col-md-8">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                </div>
                <select class="form-control" id="prdcd" name="prdcd" required>
                  <option value="">Pilih Item</option>
                  <?php foreach ($stock as $item) : ?>
                    <option value="<?= $item->prdcd; ?>"><?= $item->prdcd . ' - ' . $item->deskripsi; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlah" class="col-sm-4 col-form-label">Jumlah</label>
            <div class="col-md-4">
              <input type="text" class="form-control" id="jumlah" name="jumlah">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" onclick="submitForm()" id="btnSave" class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="updatePermintaanModal" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="updatePermintaanModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updatePermintaanModalLabel">Update Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('stock/update-item'); ?>" method="post" id="formUpdateItem">
        <div class="modal-body">
          <input type="hidden" name="idBaru" id="idBaru">
          <input type="hidden" name="kodepermintaanBaru" id="kodepermintaanBaru">
          <div class="form-group row">
            <label for="productName" class="col-sm-4 col-form-label">Product</label>
            <div class="col-md-8">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-barcode"></i></div>
                </div>
                <input type="text" name="productName" id="productName" class="form-control" readonly>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="jumlahBaru" class="col-sm-4 col-form-label">Jumlah</label>
            <div class="col-md-4">
              <input type="text" class="form-control" id="jumlahBaru" name="jumlahBaru">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>