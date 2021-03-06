<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="float-left mt-2">
      <h6 class="m-0 font-weight-bold text-primary">Data struk penjualan</h6>
    </div>
    <div class="float-right">

    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <form action="" method="post">
          <div class="row">
            <div class="col-md-5">
              <div class="form-group row">
                <label for="dateFrom" class="col-md-4 col-form-label">From</label>
                <div class="col-md-8">
                  <input type="date" class="form-control form-control-sm" id="dateFrom" name="dateFrom">
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group row">
                <label for="dateTo" class="col-md-4 col-form-label">To</label>
                <div class="col-md-8">
                  <input type="date" class="form-control form-control-sm" id="dateTo" name="dateTo">
                </div>
              </div>
            </div>
            <!-- <div class="col-md-4"></div> -->
            <div class="col-md-2 text-center">
              <button type="button" id="btnFilter" class="btn btn-primary btn-sm">Filter</button>
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
<div class="modal fade" id="transaksiModal" tabindex="-1" role="dialog" aria-labelledby="transaksiModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="transaksiModalLabel">Detail Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="printable-area">
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
      </div>
      <div class="modal-footer">
        <button type="button" id="btnPrint" class="btn btn-primary"><i class="fas fa-print"></i> Print</button>
        <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
      </div>
    </div>
  </div>
</div>