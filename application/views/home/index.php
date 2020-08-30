<?php if ($this->session->userdata('x-idm-store') == 1) : ?>
  <div class="row mb-4">

    <div class="col-xl-3 col-md-6">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Toko</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_toko; ?> Toko</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-store fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pendapatan Perbulan</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= rupiah($pendapatan_perbulan); ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pendapatan Pertahun</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= rupiah($pendapatan_pertahun); ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Grand Total Customer</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $customer; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>


  <div class="row mb-4">
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-header">
          <h6 class="m-0 font-weight-bold text-primary">Pendapatan Toko Perbulan</h6>
        </div>
        <div class="card-body">
          <canvas id="chartPendapatan" height="150">

          </canvas>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-header">
          <h6 class="m-0 font-weight-bold text-primary">Product Terlaris</h6>
        </div>
        <div class="card-body">
          <canvas id="chartProductTerlaris" height="150">

          </canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-header">
          <h6 class="m-0 font-weight-bold text-primary">Statistik Kunjungan Pelanggan</h6>
        </div>
        <div class="card-body">
          <canvas id="chartCustomer" height="256">

          </canvas>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-header">
          <h6 class="m-0 font-weight-bold text-primary">Profit Perbulan</h6>
        </div>
        <div class="card-body">
          <canvas id="chartProfit" height="150">

          </canvas>
        </div>
      </div>
    </div>
  </div>


<?php endif; ?>