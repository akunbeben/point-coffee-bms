<div style="display: none;" id="typePesan"><?= $this->session->flashdata('typePesan'); ?></div>
<div style="display: none;" id="pesan"><?= $this->session->flashdata('pesan'); ?></div>
<!-- Page Heading -->
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit User</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url('users/edit/') . $user->id; ?>" method="post" id="user-form">
                    <div class="form-group">
                        <label for="username_lama">Username</label>
                        <input type="hidden" name="id" id="id" value="<?= $user->id; ?>">
                        <input class="form-control" id="username_lama" name="username_lama" value="<?= $user->username; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="password_lama">Password Lama</label>
                        <input type="password" class="form-control" id="password_lama" name="password_lama" autocomplete="false">
                    </div>
                    <div class="form-group">
                        <label for="password_baru">Password Baru</label>
                        <input type="password" class="form-control" id="password_baru" name="password_baru" autocomplete="false">
                    </div>
                    <div class="form-group">
                        <label for="konf_password">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="konf_password" name="konf_password" autocomplete="false">
                    </div>
                    <div class="form-group">
                        <label for="idtoko">Toko</label>
                        <select class="form-control" id="idtoko" name="idtoko">
                            <?php foreach($toko as $store) : ?>
                            <option value="<?= $store->id; ?>" <?= $store->id == $user->idtoko ? 'selected' : null; ?>><?= $store->kodetoko . ' - ' . $store->nama_toko; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row justify-content-end">
                        <button type="button" id="btnSave" onclick="checkPassword()" class="btn btn-success"><i class="fas fa-paper-plane"></i> Simpan</button>&nbsp;
                        <button type="reset" class="btn btn-warning"><i class="fas fa-minus"></i> Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>