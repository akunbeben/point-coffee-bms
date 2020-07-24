<div style="display: none;" id="typePesan"><?= $this->session->flashdata('typePesan'); ?></div>
<div style="display: none;" id="pesan"><?= $this->session->flashdata('pesan'); ?></div>
<!-- Page Heading -->
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah User</h6>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <select class="form-control" id="username" name="username">
                            <?php foreach ($users as $user) : ?>
                                <option value="<?= $user; ?>"><?= $user; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="konf_password">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="konf_password" name="konf_password">
                    </div>
                    <div class="form-group">
                        <label for="idtoko">Toko</label>
                        <select class="form-control" id="idtoko" name="idtoko">
                            <?php foreach ($toko as $store) : ?>
                                <option value="<?= $store->id; ?>"><?= $store->kodetoko . ' - ' . $store->nama_toko; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row justify-content-end">
                        <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Simpan</button>&nbsp;
                        <button type="button" onclick="window.history.back()" class="btn btn-warning"><i class="fas fa-minus"></i> Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>