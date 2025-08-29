<!-- Search Box -->
<div class="row mb-3">
  <div class="col-md-6">
    <form method="GET" action="<?php echo base_url('admin/jabatan_sdm/search') ?>">
      <div class="input-group">
        <input type="text" class="form-control" name="q" placeholder="Cari nama SDM, jabatan, atau level..." value="<?php echo isset($keyword) ? $keyword : '' ?>">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Cari</button>
        </div>
      </div>
    </form>
  </div>
  <div class="col-md-6 text-right">
    <a href="<?php echo base_url('admin/jabatan_sdm/export') ?>" class="btn btn-success btn-sm">
      <i class="fa fa-download"></i> Export Excel
    </a>
    <a href="<?php echo base_url('admin/jabatan_sdm/import') ?>" class="btn btn-info btn-sm">
      <i class="fa fa-upload"></i> Import Excel
    </a>
    <a href="<?php echo base_url('admin/jabatan_sdm/struktur_organisasi') ?>" class="btn btn-warning btn-sm">
      <i class="fa fa-sitemap"></i> Struktur Organisasi
    </a>
  </div>
</div>

<!-- Flash Messages -->
<?php if ($this->session->flashdata('sukses')) { ?>
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <i class="icon fa fa-check"></i> <?php echo $this->session->flashdata('sukses') ?>
  </div>
<?php } ?>

<?php if ($this->session->flashdata('error')) { ?>
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <i class="icon fa fa-ban"></i> <?php echo $this->session->flashdata('error') ?>
  </div>
<?php } ?>

<!-- Add Button -->
<p>
  <a href="<?php echo base_url('admin/jabatan_sdm/tambah') ?>" class="btn btn-primary">
    <i class="fa fa-plus"></i> Tambah Jabatan SDM
  </a>
</p>

<!-- Bulk Action Form -->
<form action="<?php echo base_url('admin/jabatan_sdm/proses') ?>" method="post" class="form-horizontal">

  <!-- Data Table -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Data Jabatan SDM</h3>
      <div class="box-tools pull-right">
        <button type="submit" name="hapus" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data yang dipilih?')">
          <i class="fa fa-trash"></i> Hapus Terpilih
        </button>
      </div>
    </div>
    <div class="box-body">
      <table class="table table-bordered table-hover table-striped" id="example1">
        <thead class="bordered-darkorange">
          <tr>
            <th width="3%">
              <input type="checkbox" id="checkAll">
            </th>
            <th width="5%">#</th>
            <th width="20%">Nama SDM</th>
            <th width="12%">NIP</th>
            <th width="10%">Level</th>
            <th width="15%">Unit Kerja</th>
            <th width="15%">Jabatan</th>
            <th width="10%">Periode</th>
            <th width="10%">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($jabatan_sdm)) { ?>
            <?php $i = 1;
            foreach ($jabatan_sdm as $row) { ?>
              <tr class="odd gradeX">
                <td>
                  <input type="checkbox" name="id_jabatan_sdm[]" value="<?php echo $row->id ?>">
                </td>
                <td><?php echo $i ?></td>
                <td>
                  <strong><?php echo $row->nama_sdm ?></strong>
                </td>
                <td>
                  <?php if (!empty($row->nip)) { ?>
                    <code><?php echo $row->nip ?></code>
                  <?php } else { ?>
                    <em class="text-muted">-</em>
                  <?php } ?>
                </td>
                <td>
                  <?php
                  $level_class = '';
                  $level_text = '';
                  switch ($row->level) {
                    case 'institusi':
                      $level_class = 'label-danger';
                      $level_text = 'Institusi';
                      break;
                    case 'jurusan':
                      $level_class = 'label-warning';
                      $level_text = 'Jurusan';
                      break;
                    case 'prodi':
                      $level_class = 'label-primary';
                      $level_text = 'Program Studi';
                      break;
                    case 'unit':
                      $level_class = 'label-success';
                      $level_text = 'Unit';
                      break;
                    case 'pusat':
                      $level_class = 'label-info';
                      $level_text = 'Pusat';
                      break;
                  }
                  ?>
                  <span class="label <?php echo $level_class ?>"><?php echo $level_text ?></span>
                </td>
                <td>
                  <?php
                  if ($row->level == 'jurusan' && !empty($row->nama_jurusan)) {
                    echo '<i class="fa fa-building text-orange"></i> ' . $row->nama_jurusan;
                  } elseif ($row->level == 'prodi' && !empty($row->nama_prodi)) {
                    echo '<i class="fa fa-graduation-cap text-blue"></i> ' . $row->nama_prodi;
                  } elseif ($row->level == 'unit' && !empty($row->nama_unit)) {
                    echo '<i class="fa fa-cubes text-green"></i> ' . $row->nama_unit;
                  } elseif ($row->level == 'pusat' && !empty($row->nama_pusat)) {
                    echo '<i class="fa fa-dot-circle-o text-aqua"></i> ' . $row->nama_pusat;
                  } elseif ($row->level == 'institusi') {
                    echo '<i class="fa fa-university text-red"></i> Politeknik Kesehatan Kemenkes Jakarta III';
                  } else {
                    echo '<em class="text-muted">-</em>';
                  }
                  ?>
                </td>
                <td>
                  <strong><?php echo $row->jabatan ?></strong>
                </td>
                <td>
                  <small class="text-muted">
                    <?php echo $row->periode_mulai ?> - <?php echo $row->periode_akhir ?>
                  </small>
                </td>
                <td>
                  <div class="btn-group">
                    <!-- Detail Button -->
                    <a href="<?php echo base_url('admin/jabatan_sdm/detail/' . $row->id) ?>"
                      class="btn btn-info btn-xs"
                      title="Detail">
                      <i class="fa fa-eye"></i>
                    </a>

                    <!-- Riwayat Button -->
                    <a href="<?php echo base_url('admin/jabatan_sdm/riwayat/' . $row->sdm_id) ?>"
                      class="btn btn-success btn-xs"
                      title="Riwayat Jabatan">
                      <i class="fa fa-history"></i>
                    </a>

                    <!-- Edit Button -->
                    <a href="<?php echo base_url('admin/jabatan_sdm/edit/' . $row->id) ?>"
                      class="btn btn-warning btn-xs"
                      title="Edit">
                      <i class="fa fa-edit"></i>
                    </a>

                    <!-- Delete Button -->
                    <a href="<?php echo base_url('admin/jabatan_sdm/delete/' . $row->id) ?>"
                      class="btn btn-danger btn-xs"
                      onclick="confirmation(event)"
                      title="Hapus">
                      <i class="fa fa-trash-o"></i>
                    </a>
                  </div>
                </td>
              </tr>
              <?php $i++; ?>
            <?php } ?>
          <?php } else { ?>
            <tr>
              <td colspan="9" class="text-center">
                <div class="empty-state py-4">
                  <i class="fa fa-users fa-3x text-muted mb-3"></i>
                  <p class="text-muted">Tidak ada data jabatan SDM</p>
                  <a href="<?php echo base_url('admin/jabatan_sdm/tambah') ?>" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> Tambah Data Pertama
                  </a>
                </div>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

</form>

<!-- Statistics Box -->
<div class="row">
  <div class="col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Total Jabatan</span>
        <span class="info-box-number"><?php echo count($jabatan_sdm) ?></span>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-university"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Level Institusi</span>
        <span class="info-box-number">
          <?php
          $institusi_count = 0;
          foreach ($jabatan_sdm as $row) {
            if ($row->level == 'institusi') {
              $institusi_count++;
            }
          }
          echo $institusi_count;
          ?>
        </span>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-building"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Level Jurusan</span>
        <span class="info-box-number">
          <?php
          $jurusan_count = 0;
          foreach ($jabatan_sdm as $row) {
            if ($row->level == 'jurusan') {
              $jurusan_count++;
            }
          }
          echo $jurusan_count;
          ?>
        </span>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-blue"><i class="fa fa-graduation-cap"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Level Program Studi</span>
        <span class="info-box-number">
          <?php
          $prodi_count = 0;
          foreach ($jabatan_sdm as $row) {
            if ($row->level == 'prodi') {
              $prodi_count++;
            }
          }
          echo $prodi_count;
          ?>
        </span>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="fa fa-cubes"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Level Unit</span>
        <span class="info-box-number">
          <?php
          $unit_count = 0;
          foreach ($jabatan_sdm as $row) {
            if ($row->level == 'unit') {
              $unit_count++;
            }
          }
          echo $unit_count;
          ?>
        </span>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-dot-circle-o"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Level Pusat</span>
        <span class="info-box-number">
          <?php
          $pusat_count = 0;
          foreach ($jabatan_sdm as $row) {
            if ($row->level == 'pusat') {
              $pusat_count++;
            }
          }
          echo $pusat_count;
          ?>
        </span>
      </div>
    </div>
  </div>
</div>

<!-- Filter Section -->
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary collapsed-box">
      <div class="box-body">
        <form method="GET" action="<?php echo base_url('admin/jabatan_sdm') ?>">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Level Jabatan</label>
                <select name="level" class="form-control">
                  <option value="">Semua Level</option>
                  <option value="institusi" <?php echo ($this->input->get('level') == 'institusi') ? 'selected' : '' ?>>Institusi</option>
                  <option value="jurusan" <?php echo ($this->input->get('level') == 'jurusan') ? 'selected' : '' ?>>Jurusan</option>
                  <option value="prodi" <?php echo ($this->input->get('level') == 'prodi') ? 'selected' : '' ?>>Program Studi</option>
                  <option value="unit" <?php echo ($this->input->get('level') == 'unit') ? 'selected' : '' ?>>Unit</option>
                  <option value="pusat" <?php echo ($this->input->get('level') == 'pusat') ? 'selected' : '' ?>>Pusat</option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Tahun</label>
                <select name="tahun" class="form-control">
                  <option value="">Semua Tahun</option>
                  <?php for ($year = date('Y'); $year >= 2010; $year--) { ?>
                    <option value="<?php echo $year ?>" <?php echo ($this->input->get('tahun') == $year) ? 'selected' : '' ?>><?php echo $year ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>&nbsp;</label>
                <div class="clearfix"></div>
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-filter"></i> Filter
                </button>
                <a href="<?php echo base_url('admin/jabatan_sdm') ?>" class="btn btn-default">
                  <i class="fa fa-refresh"></i> Reset
                </a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript untuk DataTable dan Konfirmasi Delete -->
<script>
  $(document).ready(function() {
    console.log('Initializing Jabatan SDM DataTable...');

    // Function to safely initialize DataTable
    function initializeDataTable() {
      const $table = $('#example1');

      // Check if table exists
      if (!$table.length) {
        console.log('Table #example1 not found');
        return false;
      }

      // Check if table has data
      const $tbody = $table.find('tbody');
      const $rows = $tbody.find('tr');
      const hasData = $rows.length > 0 && !$rows.first().find('td[colspan]').length;

      console.log('Table check:', {
        'rows': $rows.length,
        'hasData': hasData,
        'emptyState': $rows.first().find('td[colspan]').length > 0
      });

      if (!hasData) {
        console.log('No data in table, skipping DataTable initialization');
        $table.addClass('table-striped table-hover');
        initializeOtherFunctions();
        return false;
      }

      // Clean any existing DataTable
      if ($.fn.DataTable.isDataTable('#example1')) {
        console.log('Destroying existing DataTable...');
        $table.DataTable().destroy();
        $table.removeClass('dataTable');
      }

      // Validate table structure
      const $thead = $table.find('thead tr th');
      let isValidStructure = true;

      $tbody.find('tr').each(function(index) {
        const $cells = $(this).find('td');
        if ($cells.length !== $thead.length) {
          console.log(`Row ${index} has ${$cells.length} cells, expected ${$thead.length}`);
          isValidStructure = false;
        }
      });

      if (!isValidStructure) {
        console.log('Table structure inconsistent, using fallback');
        $table.addClass('table-striped table-hover');
        initializeOtherFunctions();
        return false;
      }

      // Initialize DataTable with error handling
      try {
        const dataTable = $table.DataTable({
          "destroy": true,
          "responsive": true,
          "autoWidth": false,
          "processing": false,
          "serverSide": false,
          "deferRender": true,
          "stateSave": false,
          "language": {
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Data tidak ditemukan",
            "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
            "infoEmpty": "Tidak ada data yang tersedia",
            "infoFiltered": "(difilter dari _MAX_ total data)",
            "search": "Cari:",
            //                     "loadingRecords": "Memuat...",
            //                     "processing": "Memproses...",
            "paginate": {
              "first": "Pertama",
              "last": "Terakhir",
              "next": "Selanjutnya",
              "previous": "Sebelumnya"
            }
          },
          "order": [
            [7, "desc"]
          ], // Order by periode desc
          "columnDefs": [{
            "orderable": false,
            "searchable": false,
            "targets": [0, 8] // Disable ordering on checkbox and Action columns
          }],
          "pageLength": 10,
          "lengthMenu": [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
          ],
          "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>' +
            '<"row"<"col-sm-12"tr>>' +
            '<"row"<"col-sm-5"i><"col-sm-7"p>>',
          "drawCallback": function(settings) {
            // Re-initialize functions after table redraw
            initializeOtherFunctions();
          },
          "initComplete": function(settings, json) {
            console.log('DataTable initialized successfully');
            initializeOtherFunctions();
          },
          "error": function(xhr, error, thrown) {
            console.error('DataTable error:', error, thrown);
            return false;
          }
        });

        console.log('DataTable created successfully');
        return true;

      } catch (error) {
        console.error('DataTable initialization failed:', error);
        $table.addClass('table-striped table-hover');
        initializeOtherFunctions();
        return false;
      }
    }

    // Initialize other functions (checkboxes, etc.)
    function initializeOtherFunctions() {
      // Check All functionality
      $('#checkAll').off('change').on('change', function() {
        const isChecked = this.checked;
        $('input[name="id_jabatan_sdm[]"]').prop('checked', isChecked);
        updateBulkDeleteButton();
      });

      // Individual checkbox change
      $(document).off('change', 'input[name="id_jabatan_sdm[]"]').on('change', 'input[name="id_jabatan_sdm[]"]', function() {
        const $checkboxes = $('input[name="id_jabatan_sdm[]"]');
        const $checked = $checkboxes.filter(':checked');

        $('#checkAll').prop('checked', $checked.length === $checkboxes.length);
        updateBulkDeleteButton();
      });

      // Initialize tooltips
      $('[title]').tooltip();
    }

    // Update bulk delete button state
    function updateBulkDeleteButton() {
      const checkedCount = $('input[name="id_jabatan_sdm[]"]:checked').length;
      const $bulkBtn = $('button[name="hapus"]');

      if (checkedCount > 0) {
        $bulkBtn.removeClass('btn-default').addClass('btn-danger').prop('disabled', false);
        $bulkBtn.html('<i class="fa fa-trash"></i> Hapus ' + checkedCount + ' Terpilih');
      } else {
        $bulkBtn.removeClass('btn-danger').addClass('btn-default').prop('disabled', true);
        $bulkBtn.html('<i class="fa fa-trash"></i> Hapus Terpilih');
      }
    }

    // Initialize with delay to ensure DOM is ready
    setTimeout(function() {
      console.log('Starting DataTable initialization...');
      initializeDataTable();
    }, 200);

    // Auto hide alerts
    setTimeout(function() {
      $('.alert').fadeOut('slow');
    }, 5000);

    // Bulk delete form submission
    $('form').on('submit', function(e) {
      const $form = $(this);
      if ($form.find('button[name="hapus"]').length > 0) {
        const checkedCount = $('input[name="id_jabatan_sdm[]"]:checked').length;

        if (checkedCount === 0) {
          e.preventDefault();
          Swal.fire({
            icon: 'warning',
            title: 'Pilih Data',
            text: 'Pilih minimal satu data untuk dihapus'
          });
          return false;
        }

        e.preventDefault();
        Swal.fire({
          title: 'Konfirmasi Hapus',
          text: `Yakin ingin menghapus ${checkedCount} data jabatan SDM?`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya, Hapus!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              title: 'Menghapus Data',
              text: 'Mohon tunggu...',
              allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
              }
            });

            setTimeout(() => {
              $form.off('submit').submit();
            }, 500);
          }
        });
      }
    });

    console.log('Jabatan SDM List JavaScript initialized');
  });

  // Konfirmasi delete individual
  function confirmation(event) {
    event.preventDefault();
    const url = event.target.closest('a').href;
    const $row = $(event.target).closest('tr');
    const nama = $row.find('td:nth-child(3) strong').text().trim() || 'data ini';

    Swal.fire({
      title: 'Apakah Anda yakin?',
      html: `Data jabatan <strong>${nama}</strong> akan dihapus secara permanen!`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Ya, Hapus!',
      cancelButtonText: 'Batal',
      focusCancel: true
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: 'Menghapus Data',
          text: 'Mohon tunggu...',
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading();
          }
        });

        setTimeout(() => {
          window.location.href = url;
        }, 500);
      }
    });
  }

  // Export functionality
  $(document).on('click', 'a[href*="export"]', function(e) {
    e.preventDefault();
    const url = $(this).attr('href');

    Swal.fire({
      title: 'Menyiapkan Export',
      text: 'Mohon tunggu...',
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      }
    });

    setTimeout(() => {
      const link = document.createElement('a');
      link.href = url;
      link.download = 'data_jabatan_sdm_' + new Date().toISOString().slice(0, 10) + '.xlsx';
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);

      Swal.close();
    }, 1000);
  });

  // Quick search enhancement
  $('form[action*="search"] input[name="q"]').on('keyup', function(e) {
    if (e.keyCode === 13) { // Enter key
      $(this).closest('form').submit();
    }
  });

  // Filter form enhancement
  $('select[name="level"], select[name="tahun"]').on('change', function() {
    $(this).closest('form').submit();
  });
</script>

<!-- Enhanced Custom CSS -->
<style>
  /* DataTable enhancements */
  .dataTables_wrapper {
    margin-top: 20px;
  }

  .dataTables_length select,
  .dataTables_filter input {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px 8px;
  }

  .dataTables_filter input {
    margin-left: 5px;
  }

  .dataTables_info {
    margin-top: 10px;
  }

  /* Table improvements */
  .table {
    margin-bottom: 0;
  }

  .table thead th {
    background-color: #f4f4f4;
    border-bottom: 2px solid #ddd;
    font-weight: 600;
    color: #333;
    position: sticky;
    top: 0;
    z-index: 10;
  }

  .table tbody tr:hover {
    background-color: #f9f9f9;
  }

  .table td {
    vertical-align: middle !important;
    padding: 8px 12px;
    border-bottom: 1px solid #eee;
  }

  /* Empty state styling */
  .empty-state {
    padding: 60px 40px;
    text-align: center;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 10px;
    margin: 20px 0;
  }

  .empty-state i {
    color: #6c757d;
    margin-bottom: 20px;
    display: block;
  }

  .empty-state p {
    font-size: 16px;
    color: #6c757d;
    margin-bottom: 20px;
  }

  /* Label improvements */
  .label {
    font-size: 11px;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: 600;
  }

  .label-primary {
    background-color: #3c8dbc;
  }

  .label-warning {
    background-color: #f39c12;
  }

  .label-danger {
    background-color: #dd4b39;
  }

  .label-success {
    background-color: #28a745;
  }

  .label-info {
    background-color: #17a2b8;
  }

  /* Button group improvements */
  .btn-group {
    display: flex;
    flex-wrap: wrap;
    gap: 2px;
  }

  .btn-group .btn {
    margin: 0;
    border-radius: 3px;
  }

  .btn-xs {
    padding: 3px 8px;
    font-size: 11px;
    line-height: 1.5;
  }

  /* Info boxes improvements */
  .info-box {
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease;
    margin-bottom: 20px;
  }

  .info-box:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
  }

  .info-box-icon {
    border-radius: 8px 0 0 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 80px;
  }

  .info-box-content {
    padding: 15px 20px;
  }

  .info-box-text {
    font-weight: 600;
    color: #666;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .info-box-number {
    font-size: 24px;
    font-weight: 700;
    color: #333;
  }

  /* Alert improvements */
  .alert {
    border-radius: 6px;
    border-left: 4px solid;
    margin-bottom: 20px;
  }

  .alert-success {
    border-left-color: #27ae60;
    background-color: #d5f4e6;
    color: #1e7e34;
  }

  .alert-danger {
    border-left-color: #e74c3c;
    background-color: #f8d7da;
    color: #721c24;
  }

  /* Collapsible box */
  .collapsed-box .box-body {
    display: none;
  }

  /* Search box improvements */
  .input-group {
    margin-bottom: 15px;
  }

  .input-group .form-control {
    border-right: 0;
  }

  .input-group .btn {
    border-left: 0;
    border-color: #ddd;
  }

  /* Responsive improvements */
  @media (max-width: 768px) {
    .table-responsive {
      border: none;
    }

    .btn-group {
      flex-direction: column;
      align-items: stretch;
    }

    .btn-group .btn {
      margin-bottom: 2px;
      border-radius: 4px;
    }

    .info-box {
      margin-bottom: 10px;
    }

    .info-box-number {
      font-size: 18px;
    }

    .col-md-6.text-right {
      text-align: left !important;
      margin-top: 15px;
    }
  }

  /* Loading states */
  .loading {
    opacity: 0.6;
    pointer-events: none;
  }

  /* Tooltip improvements */
  .tooltip {
    font-size: 12px;
  }

  .tooltip-inner {
    background-color: #333;
    color: white;
    border-radius: 4px;
    padding: 6px 10px;
  }

  /* Checkbox styling */
  input[type="checkbox"] {
    transform: scale(1.2);
    margin: 0;
  }

  /* Enhanced text styling */
  .text-orange {
    color: #f39c12 !important;
  }

  .text-blue {
    color: #3c8dbc !important;
  }

  .text-red {
    color: #dd4b39 !important;
  }

  /* Fix for AdminLTE conflicts */
  .dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 6px 12px;
    margin-left: 2px;
    border: 1px solid #ddd;
    border-radius: 4px;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: #337ab7;
    color: white !important;
    border: 1px solid #337ab7;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #f5f5f5;
    border: 1px solid #ddd;
    color: #333 !important;
  }
</style>