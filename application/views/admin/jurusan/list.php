<!-- Search Box -->
<div class="row mb-3">
  <div class="col-md-6">
    <form method="GET" action="<?php echo base_url('admin/jurusan/search') ?>">
      <div class="input-group">
        <input type="text" class="form-control" name="q" placeholder="Cari jurusan, tagline, atau status..." value="<?php echo isset($keyword) ? $keyword : '' ?>">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Cari</button>
        </div>
      </div>
    </form>
  </div>
  <div class="col-md-6 text-right">
    <a href="<?php echo base_url('admin/jurusan/export') ?>" class="btn btn-success btn-sm">
      <i class="fa fa-download"></i> Export CSV
    </a>
    <a href="<?php echo base_url('admin/jurusan/import') ?>" class="btn btn-info btn-sm">
      <i class="fa fa-upload"></i> Import CSV
    </a>
    <!-- Bulk Actions -->
    <button type="button" class="btn btn-secondary btn-sm" onclick="toggleBulkActions()">
      <i class="fa fa-cogs"></i> Bulk Actions
    </button>
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

<!-- Bulk Actions Panel (Hidden by default) -->
<div class="row mb-3" id="bulk-actions-panel" style="display: none;">
  <div class="col-md-12">
    <div class="card border-warning">
      <div class="card-body">
        <form method="POST" action="<?php echo base_url('admin/jurusan/bulk_action') ?>" id="bulk-form">
          <div class="row">
            <div class="col-md-4">
              <select class="form-control" name="bulk_action" required>
                <option value="">-- Pilih Aksi --</option>
                <option value="delete">Hapus Terpilih</option>
                <option value="soft_delete">Nonaktifkan Terpilih</option>
              </select>
            </div>
            <div class="col-md-8">
              <button type="submit" class="btn btn-warning btn-sm" onclick="return confirmBulkAction()">
                <i class="fa fa-play"></i> Jalankan Aksi
              </button>
              <button type="button" class="btn btn-secondary btn-sm" onclick="toggleBulkActions()">
                <i class="fa fa-times"></i> Batal
              </button>
              <span class="ml-2">
                <small class="text-muted">
                  <span id="selected-count">0</span> item terpilih
                </small>
              </span>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Add Button -->
<p>
  <?php include('tambah.php') ?>
</p>

<!-- Data Table -->
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Data Jurusan</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse">
        <i class="fa fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="box-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped" id="example1">
        <thead class="bordered-darkorange">
          <tr>
            <th width="3%">
              <input type="checkbox" id="select-all" title="Pilih Semua">
            </th>
            <th width="5%">#</th>
            <th width="15%">Jurusan</th>
            <th width="12%">Status & Color</th>
            <th width="20%">Deskripsi & Tagline</th>
            <th width="10%">Features</th>
            <th width="8%">Links</th>
            <th width="8%">Image</th>
            <th width="8%">Tanggal</th>
            <th width="11%">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($jurusan)) { ?>
            <?php $i = 1;
            foreach ($jurusan as $row) { ?>
              <tr class="odd gradeX">
                <td>
                  <input type="checkbox" class="select-item" name="selected_ids[]" value="<?php echo $row->id ?>" form="bulk-form">
                </td>
                <td><?php echo $i ?></td>
                <td>
                  <div class="jurusan-info">
                    <div class="d-flex align-items-center mb-1">
                      <i class="<?php echo !empty($row->icon) ? $row->icon : 'bi bi-mortarboard' ?> text-<?php echo !empty($row->color) ? $row->color : 'primary' ?> mr-2"></i>
                      <strong><?php echo $row->nama ?></strong>
                    </div>
                    <small class="text-muted">
                      <code><?php echo $row->slug ?></code>
                    </small>
                  </div>
                </td>
                <td>
                  <div class="status-info">
                    <span class="badge badge-<?php echo !empty($row->color) ? $row->color : 'primary' ?> mb-1">
                      <?php echo !empty($row->status) ? $row->status : 'Jurusan Unggulan' ?>
                    </span>
                    <br>
                    <small class="text-muted">
                      Theme: <strong><?php echo !empty($row->color) ? ucfirst($row->color) : 'Primary' ?></strong>
                    </small>
                  </div>
                </td>
                <td>
                  <div class="description-info">
                    <?php if (!empty($row->deskripsi)) { ?>
                      <p class="mb-1 small">
                        <?php echo character_limiter(strip_tags($row->deskripsi), 80) ?>
                      </p>
                    <?php } ?>

                    <?php if (!empty($row->tagline)) { ?>
                      <div class="tagline">
                        <i class="fa fa-quote-left text-muted"></i>
                        <em class="text-info small"><?php echo $row->tagline ?></em>
                      </div>
                    <?php } ?>

                    <?php if (empty($row->deskripsi) && empty($row->tagline)) { ?>
                      <em class="text-muted small">Tidak ada deskripsi</em>
                    <?php } ?>
                  </div>
                </td>
                <td>
                  <?php if (!empty($row->features)) {
                    $features = json_decode($row->features, true);
                    if ($features && is_array($features)) { ?>
                      <div class="features-preview">
                        <?php foreach (array_slice($features, 0, 2) as $feature) { ?>
                          <div class="feature-item mb-1">
                            <i class="<?php echo $feature['icon'] ?> text-<?php echo $feature['color'] ?>"></i>
                            <small><?php echo character_limiter($feature['text'], 15) ?></small>
                          </div>
                        <?php } ?>
                        <?php if (count($features) > 2) { ?>
                          <small class="text-muted">+<?php echo count($features) - 2 ?> lainnya</small>
                        <?php } ?>
                      </div>
                    <?php } else { ?>
                      <small class="text-muted">Tidak ada features</small>
                    <?php }
                  } else { ?>
                    <small class="text-muted">Tidak ada features</small>
                  <?php } ?>
                </td>
                <td>
                  <div class="links-info">
                    <?php if (!empty($row->link_brosur)) { ?>
                      <a href="<?php echo $row->link_brosur ?>" target="_blank" class="btn btn-outline-primary btn-xs mb-1" title="Download Brosur">
                        <i class="fa fa-download"></i>
                      </a>
                    <?php } ?>

                    <?php if (!empty($row->link_virtual_tour)) { ?>
                      <a href="<?php echo $row->link_virtual_tour ?>" target="_blank" class="btn btn-outline-info btn-xs mb-1" title="Virtual Tour">
                        <i class="fa fa-play-circle"></i>
                      </a>
                    <?php } ?>

                    <?php if (empty($row->link_brosur) && empty($row->link_virtual_tour)) { ?>
                      <small class="text-muted">No links</small>
                    <?php } ?>
                  </div>
                </td>
                <td>
                  <?php if (!empty($row->image)) { ?>
                    <div class="image-preview">
                      <img src="<?php echo base_url('assets/images/jurusan/' . $row->image) ?>"
                        alt="<?php echo $row->nama ?>"
                        class="img-thumbnail"
                        style="max-width: 50px; max-height: 50px; cursor: pointer;"
                        onclick="showImageModal('<?php echo base_url('assets/images/jurusan/' . $row->image) ?>', '<?php echo $row->nama ?>')">
                    </div>
                  <?php } else { ?>
                    <div class="no-image text-center">
                      <i class="fa fa-image text-muted"></i>
                      <br>
                      <small class="text-muted">No image</small>
                    </div>
                  <?php } ?>
                </td>
                <td>
                  <small class="text-muted">
                    <?php echo date('d/m/Y', strtotime($row->created_at)) ?>
                    <br>
                    <?php echo date('H:i', strtotime($row->created_at)) ?>
                  </small>
                </td>
                <td>
                  <div class="btn-group-vertical">
                    <!-- Preview Button -->
                    <a href="<?php echo base_url('admin/jurusan/preview/' . $row->id) ?>"
                      class="btn btn-info btn-xs mb-1"
                      title="Preview Frontend"
                      target="_blank">
                      <i class="fa fa-eye"></i>
                    </a>

                    <!-- Detail Button -->
                    <a href="<?php echo base_url('admin/jurusan/detail/' . $row->id) ?>"
                      class="btn btn-primary btn-xs mb-1"
                      title="Detail">
                      <i class="fa fa-list"></i>
                    </a>

                    <!-- Edit Button -->
                    <a href="<?php echo base_url('admin/jurusan/edit/' . $row->id) ?>"
                      class="btn btn-warning btn-xs mb-1"
                      title="Edit">
                      <i class="fa fa-edit"></i>
                    </a>

                    <!-- Delete Button -->
                    <a href="<?php echo base_url('admin/jurusan/delete/' . $row->id) ?>"
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
              <td colspan="10" class="text-center">
                <div class="empty-state py-4">
                  <i class="fa fa-building fa-3x text-muted mb-3"></i>
                  <h5 class="text-muted">Tidak ada data jurusan</h5>
                  <p class="text-muted">Klik tombol "Tambah Jurusan" untuk menambah data baru</p>
                </div>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Enhanced Statistics Box -->
<div class="row">
  <div class="col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-building"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Total Jurusan</span>
        <span class="info-box-number"><?php echo count($jurusan) ?></span>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="fa fa-graduation-cap"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Total Program Studi</span>
        <span class="info-box-number">
          <?php
          // Load prodi model untuk hitung total prodi
          $this->load->model('prodi_model');
          $total_prodi = $this->prodi_model->jumlah();
          echo $total_prodi->total;
          ?>
        </span>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-calendar"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Ditambahkan Hari Ini</span>
        <span class="info-box-number">
          <?php
          $today_count = 0;
          foreach ($jurusan as $row) {
            if (date('Y-m-d', strtotime($row->created_at)) == date('Y-m-d')) {
              $today_count++;
            }
          }
          echo $today_count;
          ?>
        </span>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-image"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Dengan Gambar</span>
        <span class="info-box-number">
          <?php
          $with_image = 0;
          foreach ($jurusan as $row) {
            if (!empty($row->image)) {
              $with_image++;
            }
          }
          echo $with_image;
          ?>
        </span>
      </div>
    </div>
  </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="imageModalTitle">Preview Gambar</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <img id="imageModalImg" src="" alt="" class="img-fluid">
      </div>
    </div>
  </div>
</div>

<!-- Custom CSS -->
<style>
  .jurusan-info .badge {
    font-size: 0.7em;
  }

  .features-preview .feature-item {
    font-size: 0.8em;
    white-space: nowrap;
  }

  .links-info .btn {
    margin-right: 2px;
  }

  .image-preview img:hover {
    transform: scale(1.1);
    transition: transform 0.2s;
  }

  .description-info {
    max-height: 80px;
    overflow: hidden;
  }

  .tagline {
    background: #f8f9fa;
    padding: 3px 6px;
    border-radius: 3px;
    border-left: 3px solid #17a2b8;
  }

  .empty-state {
    padding: 40px 20px;
  }

  #bulk-actions-panel .card {
    box-shadow: 0 0 10px rgba(255, 193, 7, 0.3);
  }

  .btn-group-vertical .btn {
    margin-bottom: 2px;
  }

  .btn-xs {
    padding: 2px 5px;
    font-size: 10px;
  }

  @media (max-width: 768px) {
    .table-responsive {
      font-size: 12px;
    }

    .btn-group-vertical .btn {
      padding: 1px 3px;
    }

    .description-info {
      max-height: 60px;
    }
  }
</style>

<!-- Enhanced JavaScript -->
<script>
  $(document).ready(function() {
    // Initialize DataTable
    $('#example1').DataTable({
      "responsive": true,
      "autoWidth": false,
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
      },
      "order": [
        [8, "desc"]
      ], // Order by created_at desc
      "columnDefs": [{
          "orderable": false,
          "targets": [0, 1, 5, 6, 7, 9]
        }, // Disable ordering on checkbox, #, features, links, image, action
        {
          "searchable": false,
          "targets": [0, 1, 5, 6, 7, 9]
        }
      ],
      "pageLength": 25,
      "lengthMenu": [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, "Semua"]
      ],
      "dom": 'Bfrtip',
      "buttons": [{
          extend: 'copy',
          text: '<i class="fa fa-copy"></i> Copy',
          className: 'btn btn-default btn-sm'
        },
        {
          extend: 'excel',
          text: '<i class="fa fa-file-excel-o"></i> Excel',
          className: 'btn btn-success btn-sm'
        },
        {
          extend: 'pdf',
          text: '<i class="fa fa-file-pdf-o"></i> PDF',
          className: 'btn btn-danger btn-sm'
        },
        {
          extend: 'print',
          text: '<i class="fa fa-print"></i> Print',
          className: 'btn btn-info btn-sm'
        }
      ]
    });

    // Select All functionality
    $('#select-all').on('change', function() {
      $('.select-item').prop('checked', this.checked);
      updateSelectedCount();
    });

    // Individual checkbox change
    $('.select-item').on('change', function() {
      updateSelectedCount();

      // Update select all checkbox
      var totalItems = $('.select-item').length;
      var checkedItems = $('.select-item:checked').length;

      $('#select-all').prop('indeterminate', checkedItems > 0 && checkedItems < totalItems);
      $('#select-all').prop('checked', checkedItems === totalItems);
    });

    // Update selected count
    function updateSelectedCount() {
      var count = $('.select-item:checked').length;
      $('#selected-count').text(count);
    }
  });

  // Toggle bulk actions panel
  function toggleBulkActions() {
    $('#bulk-actions-panel').toggle();
    $('.select-item, #select-all').prop('checked', false);
    updateSelectedCount();
  }

  // Update selected count
  function updateSelectedCount() {
    var count = $('.select-item:checked').length;
    $('#selected-count').text(count);
  }

  // Confirm bulk action
  function confirmBulkAction() {
    var selectedItems = $('.select-item:checked').length;
    var action = $('select[name="bulk_action"]').val();

    if (selectedItems === 0) {
      Swal.fire('Peringatan', 'Pilih minimal satu item untuk diproses!', 'warning');
      return false;
    }

    if (!action) {
      Swal.fire('Peringatan', 'Pilih aksi yang akan dilakukan!', 'warning');
      return false;
    }

    var actionText = action === 'delete' ? 'menghapus' : 'menonaktifkan';

    return Swal.fire({
      title: 'Konfirmasi Bulk Action',
      text: `Anda akan ${actionText} ${selectedItems} item. Lanjutkan?`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Ya, Lanjutkan!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      return result.isConfirmed;
    });
  }

  // Show image modal
  function showImageModal(imageSrc, title) {
    $('#imageModalImg').attr('src', imageSrc);
    $('#imageModalTitle').text('Preview: ' + title);
    $('#imageModal').modal('show');
  }

  // Konfirmasi delete
  function confirmation(event) {
    event.preventDefault();
    var url = event.target.closest('a').href;

    Swal.fire({
      title: 'Apakah Anda yakin?',
      text: "Data yang dihapus tidak dapat dikembalikan!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Ya, Hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = url;
      }
    });
  }

  // Auto hide alerts
  setTimeout(function() {
    $('.alert').fadeOut('slow');
  }, 5000);

  // Tooltip initialization
  $('[title]').tooltip();

  // Responsive table scroll
  $(window).on('resize', function() {
    $('.table-responsive').css('max-height', $(window).height() - 300);
  });
</script>