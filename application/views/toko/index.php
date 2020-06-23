<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Toko</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="float-left">
                    <h6 class="m-0 font-weight-bold text-primary">Data Toko</h6>
              </div>
                <div class="float-right">
                    <a class="btn btn-primary" href="<?= base_url('toko/add')?>"><i class="fas fa-plus"></i> Tambah Toko</a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered dataitems" id="Datatable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Kode Toko</th>
                      <th>Nama Toko</th>
                      <th>Alamat</th>
                      <th>Tanggal Buka</th>
                      <th>Nama Perusahaan</th>
                      <th>Kepala Toko</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($toko as $tk) : ?>
                        <tr>
                            <td><?= $tk->kodetoko; ?></td>
                            <td><?= $tk->nama_toko; ?></td>
                            <td><?= $tk->alamat . ' ' . $tk->kota . ' RT ' . $tk->rt . ' RW ' . $tk->rw . ' ' . $tk->kodepos . ' Telp ' . $tk->telp; ?></td>
                            <td><?= date('d M Y', strtotime($tk->buka)); ?></td>
                            <td><?= $tk->namafrc; ?></td>
                            <td><?= $tk->ka_toko; ?></td>
                            <td class="text-center" style="max-width: 50px;">
                                <a class="btn btn-warning btn-sm" href="<?= base_url('toko/edit/') . $tk->id; ?>"><i class="fas fa-pencil-alt"></i></a>
                                <a class="btn btn-danger btn-sm" href="<?= base_url('toko/hapus/') . $tk->id; ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>