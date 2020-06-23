<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Supplier</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="float-left">
                    <h6 class="m-0 font-weight-bold text-primary">Data Supplier</h6>
              </div>
                <div class="float-right">
                    <a class="btn btn-primary" href="<?= base_url('supplier/add')?>"><i class="fas fa-plus"></i> Tambah Supplier</a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered dataitems" id="Datatable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Supplier Code</th>
                      <th>Nama Supplier</th>
                      <th>Alamat Pusat</th>
                      <th>Alamat Cabang</th>
                      <th>Telp Pusat</th>
                      <th>Telp Cabang</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($supplier as $sup) : ?>
                        <tr>
                            <td><?= $sup->supco; ?></td>
                            <td><?= $sup->nama_supplier; ?></td>
                            <td><?= $sup->alamat1; ?></td>
                            <td><?= $sup->alamat2; ?></td>
                            <td><?= $sup->telp1; ?></td>
                            <td><?= $sup->telp2; ?></td>
                            <td class="text-center" style="max-width: 50px;">
                                <a class="btn btn-warning btn-sm" href="<?= base_url('supplier/edit/') . $sup->id; ?>"><i class="fas fa-pencil-alt"></i></a>
                                <a class="btn btn-danger btn-sm" href="<?= base_url('supplier/hapus/') . $sup->id; ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>