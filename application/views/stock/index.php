<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Stock Bahan Baku</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="float-left">
      <h6 class="m-0 font-weight-bold text-primary">Data Stock Bahan Baku</h6>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered dataitems" id="Datatable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Product Code</th>
            <th>Description</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Kategori</th>
            <th>Satuan</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($stock as $stk) : ?>
            <tr>
              <td><?= $stk->prdcd; ?></td>
              <td><?= $stk->deskripsi; ?></td>
              <td><?= rupiah($stk->harga); ?></td>
              <td><?= $stk->jumlah; ?></td>
              <td><?= $stk->kategoriname; ?></td>
              <td><?= $stk->satuanname; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>