<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Aktiva</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="float-left">
                    <h6 class="m-0 font-weight-bold text-primary">Data Aktiva</h6>
              </div>
                <div class="float-right">
                    <a class="btn btn-primary" href="<?= base_url('aktiva/add')?>"><i class="fas fa-plus"></i> Tambah Aktiva</a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered dataitems" id="Datatable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nama Aktiva</th>
                      <th>Desc Aktiva</th>
                      <th>Category</th>
                      <th>Sub Category</th>
                      <th>Qty</th>
                      <th>Harga</th>
                      <th>Keterangan</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($aktiva as $akv) : ?>
                        <tr>
                            <td><?= $akv->aktiva_name; ?></td>
                            <td><?= $akv->aktiva_desc; ?></td>
                            <td><?= $akv->categoryname; ?></td>
                            <td><?= $akv->subcategoryname; ?></td>
                            <td><?= $akv->qty; ?></td>
                            <td><?= $akv->harga; ?></td>
                            <td><?= $akv->ket; ?></td>
                            <td class="text-center" style="max-width: 50px;">
                                <a class="btn btn-warning btn-sm" href="<?= base_url('aktiva/edit/') . $akv->id; ?>"><i class="fas fa-pencil-alt"></i></a>
                                <a class="btn btn-danger btn-sm" href="<?= base_url('aktiva/hapus/') . $akv->id; ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>