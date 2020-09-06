<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Barista</h1>
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form action="" method="post">
          <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" class="form-control" id="nik" name="nik" value="<?= set_value('nik'); ?>">
            <?= form_error('nik', '<small class="text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama'); ?>">
            <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= set_value('tempat_lahir'); ?>">
            <?= form_error('tempat_lahir', '<small class="text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= set_value('tanggal_lahir'); ?>">
            <?= form_error('tanggal_lahir', '<small class="text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
              <?php foreach ($jenis_kelamin as $jenis) : ?>
                <option value="<?= $jenis->desc ?>" <?= $jenis->desc == set_value('jenis_kelamin') ? 'selected' : '' ?>><?= $jenis->desc ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="jabatan">Jabatan</label>
            <select class="form-control" id="jabatan" name="jabatan">
              <?php foreach ($jabatan as $jbtn) : ?>
                <option value="<?= $jbtn->desc ?>" <?= $jbtn->desc == set_value('jabatan') ? 'selected' : '' ?>><?= $jbtn->desc ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea type="text" class="form-control" id="alamat" name="alamat"><?= set_value('alamat'); ?></textarea>
            <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="no_hp">No HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= set_value('no_hp'); ?>">
            <?= form_error('no_hp', '<small class="text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="status_kerja">Status Kerja</label>
            <select class="form-control" id="status_kerja" name="status_kerja">
              <?php foreach ($status_kerja as $status) : ?>
                <option value="<?= $status->desc ?>" <?= $status->desc == set_value('status_kerja') ? 'selected' : '' ?>><?= $status->desc ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="status_perkawinan">Status Perkawinan</label>
            <select class="form-control" id="status_perkawinan" name="status_perkawinan">
              <?php foreach ($status_perkawinan as $perkawinan) : ?>
                <option value="<?= $perkawinan->desc ?>" <?= $perkawinan->desc == set_value('status_perkawinan') ? 'selected' : '' ?>><?= $perkawinan->desc ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <input type="hidden" name="idtoko" id="idtoko" value="<?= $toko; ?>">
          <div class="row justify-content-end">
            <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Simpan</button>&nbsp;
            <button type="button" onclick="window.history.back()" class="btn btn-warning"><i class="fas fa-minus"></i> Kembali</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<input type="hidden" id="id" name="id" value="<?= $barista->id; ?>">