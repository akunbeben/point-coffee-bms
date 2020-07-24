<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Member</h1>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?= $member->id ?>">
                        <label for="id_member">No Member</label>
                        <input type="text" class="form-control" id="id_member" name="id_member" value="<?= $member->id_member; ?>">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $member->nama; ?>">
                    </div>
                    <div class="form-group">
                        <label for="noktp">No Identitas</label>
                        <input type="text" class="form-control" id="noktp" name="noktp" value="<?= $member->noktp; ?>">
                    </div>
                    <div class="form-group">
                        <label for="nohp">No HP</label>
                        <input type="text" class="form-control" id="nohp" name="nohp" value="<?= $member->nohp; ?>">
                    </div>
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select class="form-control" id="jk" name="jk">
                            <?php foreach ($gender as $jk) : ?>
                                <option value="<?= $jk->id ?>"><?= $jk->desc ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $member->alamat; ?>">
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