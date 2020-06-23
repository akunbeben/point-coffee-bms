<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Member</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="float-left">
                    <h6 class="m-0 font-weight-bold text-primary">Data Member</h6>
              </div>
                <div class="float-right">
                    <a class="btn btn-primary" href="<?= base_url('member/add')?>"><i class="fas fa-plus"></i> Tambah Member</a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered dataitems" id="Datatable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID Member</th>
                      <th>Nama Member</th>
                      <th>No HP</th>
                      <th>Jenis Kelamin</th>
                      <th>Alamat</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($member as $mem) : ?>
                        <tr>
                            <td><?= $mem->id_member; ?></td>
                            <td><?= $mem->nama; ?></td>
                            <td><?= $mem->nohp; ?></td>
                            <td><?= $mem->jkname; ?></td>
                            <td><?= $mem->alamat; ?></td>
                            <td class="text-center" style="max-width: 50px;">
                                <a class="btn btn-warning btn-sm" href="<?= base_url('member/edit/') . $mem->id; ?>"><i class="fas fa-pencil-alt"></i></a>
                                <a class="btn btn-danger btn-sm" href="<?= base_url('member/hapus/') . $mem->id; ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>