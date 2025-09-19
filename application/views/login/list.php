<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="<?php echo $this->website->icon(); ?>">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/depri12kurnia/assetsadminlte3.2.0@c4cd9975aa7ae3113ef356aed8e37f56b126d3d6/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/depri12kurnia/assetsadminlte3.2.0@c4cd9975aa7ae3113ef356aed8e37f56b126d3d6/plugins/iCheck/square/blue.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <style type="text/css" media="screen">
    body {
      background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
      min-height: 100vh;
    }

    .login-box {
      min-width: 400px !important;
      margin: 60px auto;
    }

    .card {
      border-radius: 18px;
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.25);
      border: none;
    }

    .login-logo img {
      max-width: 80px;
      margin-bottom: 10px;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
    }

    .login-logo h2 {
      font-weight: bold;
      font-size: 22px;
      margin-top: 18px;
      color: #1e3c72;
      letter-spacing: 1px;
    }

    .login-card-body {
      padding: 2.5rem 2.5rem 2rem 2.5rem;
    }

    .login-box-msg {
      font-size: 16px;
      color: #555;
      margin-bottom: 25px;
    }

    .form-group {
      position: relative;
      margin-bottom: 22px;
    }

    .form-group .fa {
      position: absolute;
      left: 14px;
      top: 12px;
      color: #aaa;
      font-size: 16px;
    }

    .form-control {
      padding-left: 38px;
      height: 44px;
      border-radius: 8px;
      font-size: 15px;
      border: 1px solid #d1d5db;
      transition: border-color 0.2s;
    }

    .form-control:focus {
      border-color: #1e3c72;
      box-shadow: 0 0 0 2px #1e3c7240;
    }

    .btn-primary {
      background: linear-gradient(90deg, #1e3c72 0%, #2a5298 100%);
      border: none;
      border-radius: 8px;
      font-size: 17px;
      font-weight: 600;
      transition: background 0.2s, box-shadow 0.2s;
      box-shadow: 0 2px 8px rgba(30, 60, 114, 0.10);
    }

    .btn-primary:hover {
      background: linear-gradient(90deg, #2a5298 0%, #1e3c72 100%);
      box-shadow: 0 4px 16px rgba(30, 60, 114, 0.18);
    }

    .alert {
      border-radius: 8px;
      font-size: 14px;
    }

    @media (max-width: 500px) {
      .login-box {
        min-width: 90vw !important;
        margin: 20px;
      }

      .login-card-body {
        padding: 1.2rem;
      }
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card">
      <div class="card-body login-card-body">
        <div class="login-logo text-center">
          <img src="<?php echo $this->website->icon(); ?>" alt="<?php echo $this->website->namaweb(); ?>" class="img img-responsive img-thumbnail">
          <h2><?php echo $this->website->namaweb() ?></h2>
        </div>
        <p class="login-box-msg text-center">Masukkan username dan password</p>
        <?php
        echo validation_errors('<p class="alert alert-warning">', '</p>');
        echo form_open(base_url('login'));
        ?>
        <div class="form-group">
          <span class="fa fa-user"></span>
          <input type="text" name="username" class="form-control" placeholder="Username" autofocus>
        </div>
        <div class="form-group">
          <span class="fa fa-lock"></span>
          <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block btn-lg">Login</button>
          </div>
        </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
  <?php if ($this->session->flashdata('sukses')) { ?>
    <script>
      swal("Berhasil", "<?php echo $this->session->flashdata('sukses'); ?>", "success")
    </script>
  <?php } ?>
  <?php if ($this->session->flashdata('warning')) { ?>
    <script>
      swal("Oops...", "<?php echo $this->session->flashdata('warning'); ?>", "warning")
    </script>
  <?php } ?>
  <script src="https://cdn.jsdelivr.net/gh/depri12kurnia/assetsadminlte3.2.0@c4cd9975aa7ae3113ef356aed8e37f56b126d3d6/plugins/jquery/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/depri12kurnia/assetsadminlte3.2.0@c4cd9975aa7ae3113ef356aed8e37f56b126d3d6/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/depri12kurnia/assetsadminlte3.2.0@c4cd9975aa7ae3113ef356aed8e37f56b126d3d6/plugins/iCheck/icheck.min.js"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      })
    })
  </script>
</body>

</html>