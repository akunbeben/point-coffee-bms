<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Barista</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="float-left">
                    <h6 class="m-0 font-weight-bold text-primary">Data Barista</h6>
              </div>
                <div class="float-right">
                    <a class="btn btn-primary" href="<?= base_url('barista/add')?>"><i class="fas fa-plus"></i> Tambah Barista</a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered dataitems" id="Datatable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>NIK</th>
                      <th>Nama</th>
                      <th>TTL</th>
                      <th>Jenis Kelamin</th>
                      <th>Alamat</th>
                      <th>No HP</th>
                      <th>Toko</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($barista as $brs) : ?>
                        <tr>
                            <td><?= $brs->nik; ?></td>
                            <td><?= $brs->nama; ?></td>
                            <td><?= $brs->tempat_lahir; ?> , <?= date('d M Y', strtotime($brs->tanggal_lahir)); ?></td>
                            <td><?= $brs->jenis_kelamin; ?></td>
                            <td><?= $brs->alamat; ?></td>
                            <td><?= $brs->no_hp; ?></td>
                            <td><?= $brs->kodetoko; ?> - <?=$brs->nama_toko; ?></td>
                            <td class="text-center" style="max-width: 50px;">
                                <a class="btn btn-warning btn-sm" href="<?= base_url('barista/edit/') . $brs->id; ?>"><i class="fas fa-pencil-alt"></i></a>
                                <a class="btn btn-danger btn-sm" href="<?= base_url('barista/hapus/') . $brs->id; ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>