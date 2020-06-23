<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Product</h1>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="idtoko" name="idtoko" value="<?= $this->session->userdata('x-idm-store'); ?>">
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
                        <input type="text" class="form-control" id="unit" name="unit">
                    </div>
                    <div class="form-group">
                        <label for="size">Size</label>
                        <input type="text" class="form-control" id="size" name="size">
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
                        <button type="reset" class="btn btn-warning"><i class="fas fa-minus"></i> Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>