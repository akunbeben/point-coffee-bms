<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Aktiva</h1>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="aktiva_name">Nama Aktiva</label>
                        <input type="hidden" class="form-control" id="idtoko" name="idtoko" value="<?= $this->session->userdata('x-idm-store'); ?>">
                        <input type="text" class="form-control" id="aktiva_name" name="aktiva_name">
                    </div>
                    <div class="form-group">
                        <label for="aktiva_desc">Desc Aktiva</label>
                        <input type="text" class="form-control" id="aktiva_desc" name="aktiva_desc">
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category">
                            <?php foreach ($category as $cat) : ?>
                                <option value="<?= $cat->id ?>"><?= $cat->desc ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subcategory">Sub Category</label>
                        <select class="form-control" id="subcategory" name="subcategory">
                            <?php foreach ($subcategory as $sct) : ?>
                                <option value="<?= $sct->id ?>"><?= $sct->desc ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="qty">Qty</label>
                        <input type="text" class="form-control" id="qty" name="qty">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga">
                    </div>
                    <div class="form-group">
                        <label for="ket">Keterangan</label>
                        <textarea type="text" class="form-control" id="ket" name="ket"></textarea>
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