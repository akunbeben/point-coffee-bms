<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Barista</h1>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="hidden" id="id" name="id" value="<?= $barista->id; ?>">
                        <input type="text" class="form-control" id="nik" name="nik" readonly value ="<?= $barista->nik; ?>">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $barista->nama; ?>">
                    </div>
                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $barista->tempat_lahir; ?>">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $barista->tanggal_lahir; ?>">
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="<?= $barista->jenis_kelamin; ?>">
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $barista->jabatan; ?>">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $barista->alamat; ?>"> 
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $barista->no_hp; ?>">
                    </div>
                    <div class="form-group">
                        <label for="status_kerja">Status Kerja</label>
                        <input type="text" class="form-control" id="status_kerja" name="status_kerja" value="<?= $barista->status_kerja; ?>">
                    </div>
                    <div class="form-group">
                        <label for="status_perkawinan">Status Perkawinan</label>
                        <input type="text" class="form-control" id="status_perkawinan" name="status_perkawinan"value="<?= $barista->status_perkawinan; ?>">
                    </div>
                    <div class="form-group">
                        <label for="idtoko">Store</label>
                        <select class="form-control" id="idtoko" name="idtoko">
                            <?php foreach ($toko as $store) : ?>
                            <option value="<?= $store->id; ?>"><?= $store->kodetoko . ' - ' . $store->nama_toko; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row justify-content-end">
                        <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Simpan</button>&nbsp;
                        <button type="reset" class="btn btn-warning"><i class="fas fa-minus"></i> Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>