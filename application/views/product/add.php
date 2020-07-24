<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Product</h1>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="prdcd">Product Code</label>
                        <input type="text" class="form-control" id="prdcd" name="prdcd">
                    </div>
                    <div class="form-group">
                        <label for="singkatan">Abbreviation</label>
                        <input type="text" class="form-control" id="singkatan" name="singkatan">
                    </div>
                    <div class="form-group">
                        <label for="desc">Description</label>
                        <input type="text" class="form-control" id="desc" name="desc">
                    </div>
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <select class="form-control" id="unit" name="unit">
                            <?php foreach ($units as $unit) : ?>
                                <option value="<?= $unit->id ?>"><?= $unit->singkatan ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="size">Size</label>
                        <select class="form-control" id="size" name="size">
                            <?php foreach ($sizes as $size) : ?>
                                <option value="<?= $size->id ?>"><?= $size->singkatan ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" name="price">
                    </div>
                    <div class="form-group">
                        <label for="sellingprice">Selling Price</label>
                        <input type="text" class="form-control" id="sellingprice" name="sellingprice">
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