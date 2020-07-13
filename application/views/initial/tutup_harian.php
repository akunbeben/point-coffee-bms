<div class="row">
    <div class="col-md-6">
        <?= $this->session->flashdata('initial'); ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tutup Harian</h6>
            </div>

            <div class="card-body">
                <p class="text-danger m-0">* Apakah anda ingin melakukan tutup harian <?= date('d M Y', time()); ?> ?</p>
                <p class="text-danger">* Pastikan anda sudah melakukan tutup shift.</p>
                <div class="text-right">
                    <button class="btn btn-primary" type="button" onclick="toogleForm()" id="openForm">Tutup Harian</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12" id="formTutupShift" style="display: none;">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Per Shift</h6>
            </div>

            <div class="card-body">
                <form action="" method="post" id="form-tutup-harian">
                    <input type="hidden" name="csrf" value="<?= password_hash('1', PASSWORD_DEFAULT); ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Barista</th>
                                        <th>Shift</th>
                                        <th>Pendapatan</th>
                                        <th>Kas</th>
                                        <th>Pergantian</th>
                                        <th>Variance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($detail as $data) : ?>
                                        <tr>
                                            <td><?= $data->nama; ?></td>
                                            <td><?= $data->shift; ?></td>
                                            <td><?= rupiah($data->total); ?></td>
                                            <td><?= rupiah($data->kas); ?></td>
                                            <td><?= rupiah($data->pergantian); ?></td>
                                            <td><?= rupiah($data->variance); ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <button type="button" id="submit-button" onclick="submitConfirmation()" class="btn btn-success">Proses</button>&nbsp;
                        <button type="reset" class="btn btn-warning">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>