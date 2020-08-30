<div class="row mb-4">
  <div class="col-xl-12 mb-2 col-md-6">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="h5 mb-0 font-weight-bold text-gray-800 text-center" id="jam" onload="showTime()"></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800 text-center" id="tanggal">Selasa, 20 Agustus 2020</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-6 mb-2 col-md-6">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Initial</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $initial; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-6 mb-2 col-md-6">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Customer</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_customer; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-6 mb-2 col-md-6">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Permintaan Barang Pending</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pending; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-sync fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-6 mb-2 col-md-6">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Permintaan Barang Approved</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $approved; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-check fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-6 mb-2 col-md-6">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Permintaan Barang Rejected</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $rejected; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-ban fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-6 mb-2 col-md-6">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Penerimaan Barang Belum Diproses</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $penerimaan; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-truck fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>