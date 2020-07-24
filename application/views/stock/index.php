<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Stock Bahan Baku</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="float-left">
      <h6 class="m-0 font-weight-bold text-primary">Data Stock Bahan Baku</h6>
    </div>
    <?php if ($this->session->userdata('x-idm-store') == 1) : ?>
      <div class="float-right">
        <button class="btn btn-primary" onclick="window.location.href='<?= base_url('stock/add'); ?>'"><i class="fas fa-plus"></i> Tambah Stock</button>
      </div>
    <?php endif; ?>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered dataitems" id="Datatable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Product Code</th>
            <th>Description</th>
            <th>Harga</th>
            <?php if ($this->session->userdata('x-idm-store') != 1) : ?>
              <th>Jumlah</th>
            <?php endif; ?>
            <th>Kategori</th>
            <th>Satuan</th>
            <?php if ($this->session->userdata('x-idm-store') == 1) : ?>
              <th>Action</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($stock as $stk) : ?>
            <tr>
              <td><?= $stk->prdcd; ?></td>
              <td><?= $stk->deskripsi; ?></td>
              <td><?= rupiah($stk->harga); ?></td>
              <?php if ($this->session->userdata('x-idm-store') != 1) : ?>
                <td><?= $stk->jumlah; ?></td>
              <?php endif; ?>
              <td><?= $stk->kategoriname; ?></td>
              <td><?= $stk->satuanname; ?></td>
              <?php if ($this->session->userdata('x-idm-store') == 1) : ?>
                <td class="text-center" style="max-width: 50px;">
                  <a class="btn btn-warning btn-sm" href="<?= base_url('stock/edit/') . $stk->id; ?>"><i class="fas fa-pencil-alt"></i></a>
                  <a class="btn btn-danger btn-sm" href="<?= base_url('stock/hapus/') . $stk->id; ?>"><i class="fas fa-trash"></i></a>
                </td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>