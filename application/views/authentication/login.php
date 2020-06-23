
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Login</title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url('asset/');?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?= base_url('asset/');?>vendor/sweetalert2/dist/sweetalert2.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url('asset/');?>css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center my-5">

      <div class="col-xl-6 col-lg-6 col-md-6">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Sign in to your account!</h1>
                  </div>
                  <form class="user" method="post" action="">
                    <div class="form-group">
                      <input type="text" class="form-control" id="username" aria-describedby="username" placeholder="Username" name="username">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="password" placeholder="Password" name="password" autocomplete="false">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                      Login
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="<?= base_url('authentication/forgot-password'); ?>">Forgot Password?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url('asset/');?>vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url('asset/');?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('asset/');?>vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?= base_url('asset/');?>vendor/sweetalert2/dist/sweetalert2.all.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('asset/');?>js/sb-admin-2.min.js"></script>

  <script>
    var flashData = '<?= $this->session->flashdata('authentication'); ?>';
    var flashDataType = '<?= $this->session->flashdata('authenticationType'); ?>';

    if (flashData != '') {
        Swal.fire({
            title: flashData,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            type: flashDataType
        });
    }
  </script>

</body>

</html>
