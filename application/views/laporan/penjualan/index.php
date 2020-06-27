<div class="row mb-4">
  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
              </div>
              <div class="col">
                <div class="progress progress-sm mr-2">
                  <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pending Requests Card Example -->
  <div class="col-xl-3 col-md-6">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-comments fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="float-left mt-2">
      <h6 class="m-0 font-weight-bold text-primary">Data struk penjualan</h6>
    </div>
    <div class="float-right">
      <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-download"></i> Laporan
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="#">Cetak PDF</a>
        </div>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <form action="" method="post">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group row">
                <label for="colFormLabelSm" class="col-md-4 col-form-label">From</label>
                <div class="col-md-8">
                  <input type="date" class="form-control form-control-sm" id="colFormLabelSm">
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group row">
                <label for="colFormLabelSm" class="col-md-4 col-form-label">To</label>
                <div class="col-md-8">
                  <input type="date" class="form-control form-control-sm" id="colFormLabelSm">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <label for="colFormLabelSm" class="col-md-4 col-form-label">Kasir</label>
                <div class="col-md-8">
                  <input type="text" class="form-control form-control-sm" id="colFormLabelSm">
                </div>
              </div>
            </div>
            <div class="col-md-2 text-center">
              <button class="btn btn-primary btn-sm">Filter</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <hr class="sidebar-divider">
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered table-sm" id="newDatatable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No. Struk</th>
                <th>Customer</th>
                <th>Total Belanja</th>
                <th>Kasir</th>
                <th>Tgl. Transaksi</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 text-center">
            <p id="header">No. Struk: 0000000001</p>
          </div>
          <hr class="sidebar-divider">
        </div>
        <div class="row">
          <div class="col-md-6">
            <p id="struk">No. Struk: 0000000001</p>
          </div>
          <div class="col-md-6 text-right">
            <p id="kasir">Customer: Benny Rahmat</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table class="table" id="itemDetail">
              <thead>
                <tr>
                  <th>Item</th>
                  <th class="text-center">Qty</th>
                  <th class="text-left">Harga</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot class="table-borderless">
              </tfoot>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>