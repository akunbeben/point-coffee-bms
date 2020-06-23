<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Product</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="float-left">
                    <h6 class="m-0 font-weight-bold text-primary">Data Product</h6>
              </div>
                <div class="float-right">
                    <a class="btn btn-primary" href="<?= base_url('product/add')?>"><i class="fas fa-plus"></i> Tambah Product</a>
                    <a class="btn btn-primary" href="<?= base_url('product/discount')?>"><i class="fas fa-percent"></i> Discount</a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered dataitems" id="Datatable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Product Code</th>
                      <th>Abbreviation</th>
                      <th>Description</th>
                      <th>Unit</th>
                      <th>Size</th>
                      <th>Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($product as $prd) : ?>
                        <tr>
                            <td><?= $prd->prdcd; ?></td>
                            <td><?= $prd->singkatan; ?></td>
                            <td><?= $prd->desc; ?></td>
                            <td><?= $prd->unit; ?></td>
                            <td><?= $prd->size; ?></td>
                            <td><?= $prd->price; ?></td>
                            <td class="text-center" style="max-width: 50px;">
                                <a class="btn btn-warning btn-sm" href="<?= base_url('product/edit/') . $prd->id; ?>"><i class="fas fa-pencil-alt"></i></a>
                                <a class="btn btn-danger btn-sm" href="<?= base_url('product/hapus/') . $prd->id; ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>