<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Point Coffee - <?= $title; ?></title>

  <!-- Custom fonts for this template-->
  <!-- Custom fonts for this template -->
  <link href="<?= base_url('asset/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?= base_url('asset/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="<?= base_url('asset/'); ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="<?= base_url('asset/'); ?>vendor/sweetalert2/dist/sweetalert2.css" rel="stylesheet">
  <link href="<?= base_url('asset/'); ?>vendor/select2/dist/css/select2.css" rel="stylesheet" />
  <link href="<?= base_url('asset/'); ?>vendor/select2-bootstrap4-theme/select2-bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url('asset/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top" class="<?= $this->uri->segment(1) == "kasir" ? 'sidebar-toggled' : ''; ?>">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion <?= $this->uri->segment(1) == "kasir" ? 'toggled' : ''; ?>" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>">
        <div class="sidebar-brand-icon">
          <i class="fas fa-coffee"></i>
        </div>
        <div class="sidebar-brand-text mx-2">Point Coffee<sup></sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <?php if ($this->session->userdata('x-idm-store') == 1) : ?>
        <hr class="sidebar-divider">

        <div class="sidebar-heading">
          Back Office
        </div>

        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('toko'); ?>">
            <i class="fas fa-fw fa-store"></i>
            <span>Toko</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('users'); ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span>
          </a>
        </li>
      <?php endif; ?>

      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Front Office
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-database"></i>
          <span>Master Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url('barista'); ?>">Barista</a>
            <a class="collapse-item" href="<?= base_url('product') ?>">Product</a>
            <a class="collapse-item" href="<?= base_url('stock') ?>">Stock</a>
            <a class="collapse-item" href="<?= base_url('aktiva') ?>">Aktiva</a>
            <a class="collapse-item" href="<?= base_url('supplier') ?>">Supplier</a>
            <a class="collapse-item" href="<?= base_url('member') ?>">Member</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#initialmenu" aria-expanded="true" aria-controls="initialmenu">
          <i class="fas fa-fw fa-calendar-check"></i>
          <span>Initial</span>
        </a>
        <div id="initialmenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url('initial'); ?>">Initial</a>
            <a class="collapse-item" href="<?= base_url('initial/tutup-shift'); ?>">Tutup Shift</a>
            <a class="collapse-item" href="<?= base_url() ?>">Tutup Harian</a>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        Transaction
      </div>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('kasir'); ?>">
          <i class="fas fa-fw fa-shopping-cart"></i>
          <span>Pos Kasir</span></a>
      </li>

      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        Inventory
      </div>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#permintaanbarang" aria-expanded="true" aria-controls="permintaanbarang">
          <i class="fas fa-fw fa-truck"></i>
          <span>Permintaan Barang</span>
        </a>
        <div id="permintaanbarang" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url('stock/permintaan-barang'); ?>">Permintaan Barang</a>
            <a class="collapse-item" href="<?= base_url('inventory/proses-barang'); ?>">Proses Barang</a>
            <a class="collapse-item" href="<?= base_url('inventory/data-retur-barang'); ?>">Retur Barang</a>
            <a class="collapse-item" href="<?= base_url('inventory/konversi-barang') ?>">Konversi Barang</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('x-idm-kode_toko'); ?></span>
                <img class="img-profile rounded-circle" src="<?= base_url('asset/img/') . 'user-default.png'; ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <button class="dropdown-item" onclick="Logout()">Logout</button>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <?= $contents; ?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url('asset/'); ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url('asset/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('asset/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?= base_url('asset/'); ?>vendor/jquery-mask/dist/jquery.mask.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('asset/'); ?>js/sb-admin-2.min.js"></script>


  <script src="<?= base_url('asset/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('asset/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url('asset/'); ?>vendor/sweetalert2/dist/sweetalert2.all.js"></script>
  <script src="<?= base_url('asset/'); ?>vendor/select2/dist/js/select2.js"></script>

  <?php if ($javascript != null) : ?>
    <script src="<?= base_url('asset/'); ?>js/pages/<?= $javascript; ?>"></script>
  <?php endif; ?>
  <script>
    var globalDatatable = $('table.dataitems').DataTable();

    var globalBaseUrl = "<?= base_url(); ?>";

    var globalMessage = "<?= $this->session->flashdata('pesanGlobal'); ?>";
    var globalMessageType = "<?= $this->session->flashdata('typePesanGlobal'); ?>";

    function Logout() {
      Swal.fire({
        title: 'Logout Confirmation',
        text: 'Are you sure to logout?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, logout!'
      }).then((result) => {
        if (result.value) {
          document.location.href = '<?= base_url('authentication/logout '); ?>';
        }
      })
    };
  </script>
</body>

</html>