<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Laporan Shift</h6>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered table-sm dataitems" id="newDatatable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No.</th>
                <th>Shift No.</th>
                <th>Pendapatan</th>
                <th>Pergantian</th>
                <th>Variance</th>
                <th>Tgl. Tutup Shift</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $number = 1;
              foreach ($data as $shift) : ?>
                <tr>
                  <td class="text-center"><?= $number++; ?>.</td>
                  <td class="text-center"><?= $shift->shift; ?></td>
                  <td><?= rupiah($shift->total); ?></td>
                  <td><?= rupiah($shift->pergantian); ?></td>
                  <td><?= rupiah($shift->variance); ?></td>
                  <td class="text-center"><?= date('d M Y H:i:s', strtotime($shift->tanggal_tutup_shift)); ?></td>
                  <td class="text-center">
                    <button class="btn btn-primary btn-sm" onclick="window.location.href = '<?= base_url('initial/print-tutup-shift/' . $shift->id); ?>'" title="Print"><i class="fas fa-print"></i></button>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>