<div class="col-md-6">
    <?= $this->session->flashdata('initial'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Initial</h6>
        </div>

        <div class="card-body">
            <form action="" method="post">
                <?php if ($currentBarista == null) : ?>
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <select class="form-control" id="nik" name="nik">
                            <option value="">Masukkan NIK anda.</option>
                            <?php foreach ($barista as $brs) : ?>
                                <option value="<?= $brs->nik; ?>"><?= $brs->nik . ' - ' . $brs->nama; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="modal">Modal</label>
                        <input type="text" class="form-control" id="modal" name="modal">
                    </div>
                    <div class="row justify-content-end">
                        <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Simpan</button>&nbsp;
                        <button type="button" onclick="window.history.back()" class="btn btn-warning"><i class="fas fa-minus"></i> Kembali</button>
                    </div>
                <?php else : ?>
                    <div class="form-group">
                        <label for="currentInitial">NIK</label>
                        <input class="form-control" type="text" id="currentInitial" name="currentInitial" value="<?= $currentBarista->nik . ' - ' . $currentBarista->nama; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="modal">Modal</label>
                        <input type="text" class="form-control" id="modal" name="modal" value="<?= $currentInitial->modal; ?>" readonly>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>