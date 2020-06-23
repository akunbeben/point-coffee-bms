<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Supplier</h1>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                    <input type="hidden" class="form-control" id="idtoko" name="idtoko" value="<?= $this->session->userdata('x-idm-store'); ?>">
                        <label for="supco">Supplier Code</label>
                        <input type="text" class="form-control" id="supco" name="supco">
                    </div>
                    <div class="form-group">
                        <label for="nama_supplier">Nama Supplier</label>
                        <input type="text" class="form-control" id="nama_supplier" name="nama_supplier">
                    </div>
                    <div class="form-group">
                        <label for="alamat1">Alamat Pusat</label>
                        <input type="text" class="form-control" id="alamat1" name="alamat1">
                    </div>
                    <div class="form-group">
                        <label for="alamat2">Alamat Cabang</label>
                        <input type="text" class="form-control" id="alamat2" name="alamat2">
                    </div>
                    <div class="form-group">
                        <label for="telp1">Telp Pusat</label>
                        <input type="text" class="form-control" id="telp1" name="telp1">
                    </div>
                    <div class="form-group">
                        <label for="telp2">Telp Cabang</label>
                        <input type="text" class="form-control" id="telp2" name="telp2">
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