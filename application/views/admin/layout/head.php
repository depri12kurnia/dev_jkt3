<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- icon -->
  <link rel="shortcut icon" href="<?php echo $this->website->icon(); ?>">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap4.min.css">

  <!-- AdminLTE Theme -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=swap" rel="stylesheet">

  <!-- iCheck -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.3/skins/flat/blue.css">

  <!-- Summernote -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.css">

  <!-- jQuery Timepicker -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.3.5/jquery.timepicker.min.css">

  <!-- jQuery UI -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/ui-lightness/jquery-ui.css">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- jQuery UI -->
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

  <!-- Bootstrap 4 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- DataTables -->
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>

  <!-- Select2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-theme@0.1.0-beta.10/dist/select2-bootstrap.min.css">

  <!-- Select2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <!-- AdminLTE -->
  <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>

  <!-- iCheck -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.3/icheck.min.js"></script>

  <!-- Summernote -->
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>

  <!-- TinyMCE -->
  <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>

  <!-- jQuery Timepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.3.5/jquery.timepicker.min.js"></script>

  <!-- jQuery Chained -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-chained/1.0.1/jquery.chained.min.js"></script>

  <!-- Moment.js untuk manipulasi tanggal -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

  <!-- Chart.js untuk grafik (versi 3 yang kompatibel tanpa ES6 modules) -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

  <!-- PDF.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

  <style type="text/css" media="screen">
    .btn-group-xs>.btn,
    .btn-xs {
      padding: .25rem .4rem;
      font-size: .875rem;
      line-height: .5;
      border-radius: .2rem;
    }

    .text-strong {
      font-weight: bold;
      background-color: #FFC;
    }

    .select2 {
      z-index: 10050 !important;
    }

    span.select2-container {
      z-index: 10050 !important;
    }

    /* Custom CSS untuk AdminLTE compatibility */
    .main-sidebar,
    .main-header,
    .content-wrapper {
      transition: all 0.3s ease-in-out;
    }

    /* Responsive table */
    .table-responsive {
      border: none;
    }

    /* Loading overlay */
    .loading-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 9999;
      display: none;
    }

    .loading-spinner {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: white;
    }

    /* SweetAlert2 custom styling */
    .swal2-popup {
      font-size: 1rem;
    }

    /* Select2 modal fix */
    .select2-container--default .select2-selection--single {
      height: 38px;
      line-height: 38px;
    }

    /* DataTables responsive */
    table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control:before,
    table.dataTable.dtr-inline.collapsed>tbody>tr>th.dtr-control:before {
      top: 50%;
      left: 5px;
      height: 1em;
      width: 1em;
      margin-top: -9px;
      display: block;
      position: absolute;
      color: white;
      border: 0.15em solid white;
      border-radius: 1em;
      box-shadow: 0 0 0.2em #444;
      box-sizing: content-box;
      text-align: center;
      text-indent: 0 !important;
      font-family: 'Courier New', Courier, monospace;
      line-height: 1em;
      content: '+';
      background-color: #31b131;
    }

    /* Fix untuk Chart.js */
    .chart-container {
      position: relative;
      height: 400px;
      width: 100%;
    }

    canvas {
      max-width: 100%;
      height: auto !important;
    }
  </style>

  <!-- Konfigurasi global JavaScript -->
  <script>
    // Konfigurasi global
    window.AppConfig = {
      baseUrl: '<?php echo base_url(); ?>',
      csrfName: '<?php echo $this->security->get_csrf_token_name(); ?>',
      csrfHash: '<?php echo $this->security->get_csrf_hash(); ?>'
    };

    // SweetAlert2 default config
    window.Swal = window.Swal || {};

    // Chart.js default config
    if (typeof Chart !== 'undefined') {
      Chart.defaults.font.family = 'Source Sans Pro';
      Chart.defaults.font.size = 12;
      Chart.defaults.color = '#666';
      Chart.defaults.plugins.legend.display = true;
      Chart.defaults.plugins.tooltip.enabled = true;
      Chart.defaults.responsive = true;
      Chart.defaults.maintainAspectRatio = false;
    }

    // Global functions
    window.showLoading = function() {
      $('.loading-overlay').show();
    };

    window.hideLoading = function() {
      $('.loading-overlay').hide();
    };

    // Select2 default config
    $(document).ready(function() {
      // Initialize Select2 globally
      $('.select2').select2({
        theme: 'bootstrap',
        width: '100%'
      });

      // Initialize iCheck globally
      $('.icheck').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
      });

      // Auto hide loading overlay after page load
      setTimeout(function() {
        hideLoading();
      }, 1000);
    });
  </script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <!-- Loading overlay -->
  <div class="loading-overlay">
    <div class="loading-spinner">
      <i class="fa fa-spinner fa-spin fa-3x"></i>
      <p>Loading...</p>
    </div>
  </div>