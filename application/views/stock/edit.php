<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Stock Bahan Baku</h1>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="idtoko" name="idtoko" value="<?= $this->session->userdata('x-idm-store'); ?>">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?= $stock->id ?>">
                        <label for="prdcd">Product Code</label>
                        <input type="text" class="form-control" id="prdcd" name="prdcd" value="<?= $stock->prdcd; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= $stock->deskripsi; ?>">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga" value="<?= $stock->harga; ?>">
                    </div>
                    <div class="form-group">
                        <label for="kategori">Category</label>
                        <select class="form-control" id="kategori" name="kategori">
                            <?php foreach ($kategori as $kat) : ?>
                                <option value="<?= $kat->id ?>"><?= $kat->singkatan ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <select class="form-control" id="satuan" name="satuan">
                            <?php foreach ($satuan as $sat) : ?>
                                <option value="<?= $sat->id ?>"><?= $sat->singkatan ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis</label>
                        <select class="form-control" id="jenis" name="jenis">
                            <?php foreach ($jenis as $jns) : ?>
                                <option value="<?= $jns->id ?>"><?= $jns->desc ?></option>
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