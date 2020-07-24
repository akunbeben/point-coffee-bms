<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Toko</h1>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="kodetoko">Kode Toko</label>
                        <input type="hidden" id="id" name="id" value="<?= $toko->id; ?>">
                        <input type="text" class="form-control" id="kodetoko" name="kodetoko" value="<?= $toko->kodetoko; ?>">
                    </div>
                    <div class="form-group">
                        <label for="nama_toko">Nama Toko</label>
                        <input type="text" class="form-control" id="nama_toko" name="nama_toko" value="<?= $toko->nama_toko; ?>">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $toko->alamat; ?>">
                    </div>
                    <div class="form-group">
                        <label for="kota">Kota</label>
                        <input type="text" class="form-control" id="kota" name="kota" value="<?= $toko->kota; ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rt">RT</label>
                                <input type="text" class="form-control" id="rt" name="rt" value="<?= $toko->rt; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rw">RW</label>
                                <input type="text" class="form-control" id="rw" name="rw" value="<?= $toko->rw; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telp">Telp</label>
                                <input type="text" class="form-control" id="telp" name="telp" value="<?= $toko->telp; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kodepos">Kode Pos</label>
                                <input type="text" class="form-control" id="kodepos" name="kodepos" value="<?= $toko->kodepos; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="buka">Tanggal Buka</label>
                        <input type="date" class="form-control" id="buka" name="buka" value="<?= $toko->buka; ?>">
                    </div>
                    <div class="form-group">
                        <label for="namafrc">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="namafrc" name="namafrc" value="<?= $toko->namafrc; ?>">
                    </div>
                    <div class="form-group">
                        <label for="ka_toko">Kepala Toko</label>
                        <input type="text" class="form-control" id="ka_toko" name="ka_toko" value="<?= $toko->ka_toko; ?>">
                    </div>
                    <div class="form-group">
                        <label for="latitude">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" value="<?= $toko->latitude; ?>">
                    </div>
                    <div class="form-group">
                        <label for="longitude">Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" value="<?= $toko->longitude; ?>">
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