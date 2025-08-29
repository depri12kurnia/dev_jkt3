<?php
// filepath: d:\xampp\htdocs\dev_jkt3\application\views\admin\jurusan\search.php

// PHP Helper Function for Highlighting - Pindahkan ke atas
if (!function_exists('highlight_search')) {
    function highlight_search($text, $keyword)
    {
        if (empty($keyword)) return $text;

        $highlighted = preg_replace(
            '/(' . preg_quote($keyword, '/') . ')/i',
            '<mark>$1</mark>',
            $text
        );

        return $highlighted;
    }
}
?>

<!-- Search Header -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">
            <i class="fa fa-search"></i> Hasil Pencarian: "<?php echo htmlspecialchars($keyword) ?>"
        </h3>
        <div class="box-tools pull-right">
            <a href="<?php echo base_url('admin/jurusan') ?>" class="btn btn-default btn-sm">
                <i class="fa fa-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>
    </div>
</div>

<!-- Search Form -->
<div class="row mb-3">
    <div class="col-md-8">
        <form method="GET" action="<?php echo base_url('admin/jurusan/search') ?>">
            <div class="input-group">
                <input type="text" class="form-control" name="q" placeholder="Cari jurusan..." value="<?php echo htmlspecialchars($keyword) ?>">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
            <small class="form-text text-muted">
                Pencarian berdasarkan nama jurusan, slug, atau deskripsi
            </small>
        </form>
    </div>
    <div class="col-md-4">
        <div class="text-right">
            <?php if (!empty($jurusan)) { ?>
                <span class="badge badge-success">
                    <i class="fa fa-check"></i> <?php echo count($jurusan) ?> data ditemukan
                </span>
            <?php } else { ?>
                <span class="badge badge-warning">
                    <i class="fa fa-exclamation-triangle"></i> Tidak ada data
                </span>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Search Results -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">
            <i class="fa fa-list"></i> Hasil Pencarian
        </h3>
        <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="box-body">
        <?php if (!empty($jurusan)) { ?>
            <table class="table table-bordered table-hover table-striped" id="search-results">
                <thead class="bordered-darkorange">
                    <tr>
                        <th width="5%">#</th>
                        <th width="25%">Nama Jurusan</th>
                        <th width="20%">Slug</th>
                        <th width="35%">Deskripsi</th>
                        <th width="10%">Tanggal</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($jurusan as $row) { ?>
                        <tr class="odd gradeX">
                            <td><?php echo $i ?></td>
                            <td>
                                <strong><?php echo highlight_search($row->nama, $keyword) ?></strong>
                                <br>
                                <small class="text-muted">ID: <?php echo $row->id ?></small>
                            </td>
                            <td>
                                <code><?php echo highlight_search($row->slug, $keyword) ?></code>
                            </td>
                            <td>
                                <?php if (!empty($row->deskripsi)) { ?>
                                    <?php echo highlight_search(character_limiter(strip_tags($row->deskripsi), 100), $keyword) ?>
                                <?php } else { ?>
                                    <em class="text-muted">Tidak ada deskripsi</em>
                                <?php } ?>
                            </td>
                            <td>
                                <small class="text-muted">
                                    <?php echo date('d/m/Y', strtotime($row->created_at)) ?>
                                </small>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <!-- Detail Button -->
                                    <a href="<?php echo base_url('admin/jurusan/detail/' . $row->id) ?>"
                                        class="btn btn-info btn-xs"
                                        title="Detail">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <!-- Edit Button -->
                                    <a href="<?php echo base_url('admin/jurusan/edit/' . $row->id) ?>"
                                        class="btn btn-warning btn-xs"
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
                </tbody>
            </table>
        <?php } else { ?>
            <!-- No Results Found -->
            <div class="text-center py-5">
                <div class="empty-state">
                    <i class="fa fa-search fa-5x text-muted mb-3"></i>
                    <h4 class="text-muted">Tidak Ada Hasil</h4>
                    <p class="text-muted">
                        Pencarian untuk "<strong><?php echo htmlspecialchars($keyword) ?></strong>" tidak ditemukan.
                    </p>

                    <div class="mt-4">
                        <h5 class="text-muted">Saran:</h5>
                        <ul class="list-unstyled text-muted">
                            <li><i class="fa fa-check"></i> Periksa ejaan kata kunci</li>
                            <li><i class="fa fa-check"></i> Gunakan kata kunci yang lebih umum</li>
                            <li><i class="fa fa-check"></i> Coba dengan kata kunci yang berbeda</li>
                        </ul>
                    </div>

                    <div class="mt-4">
                        <a href="<?php echo base_url('admin/jurusan') ?>" class="btn btn-primary">
                            <i class="fa fa-list"></i> Lihat Semua Data
                        </a>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Tambah">
                            <i class="fa fa-plus"></i> Tambah Jurusan Baru
                        </button>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<!-- Search Statistics -->
<?php if (!empty($jurusan)) { ?>
    <div class="row">
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-search"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Hasil Ditemukan</span>
                    <span class="info-box-number"><?php echo count($jurusan) ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-clock-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Kata Kunci</span>
                    <span class="info-box-number"><?php echo str_word_count($keyword) ?> kata</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-percent"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Akurasi</span>
                    <span class="info-box-number">
                        <?php
                        $this->load->model('jurusan_model'); // Pastikan model loaded
                        $total_jurusan = $this->jurusan_model->jumlah()->total;
                        $accuracy = $total_jurusan > 0 ? round((count($jurusan) / $total_jurusan) * 100, 1) : 0;
                        echo $accuracy;
                        ?>%
                    </span>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Related Searches -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">
            <i class="fa fa-lightbulb-o"></i> Pencarian Terkait
        </h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <h5>Pencarian Populer:</h5>
                <div class="tag-cloud">
                    <a href="<?php echo base_url('admin/jurusan/search?q=teknik') ?>" class="btn btn-default btn-sm">teknik</a>
                    <a href="<?php echo base_url('admin/jurusan/search?q=ekonomi') ?>" class="btn btn-default btn-sm">ekonomi</a>
                    <a href="<?php echo base_url('admin/jurusan/search?q=komputer') ?>" class="btn btn-default btn-sm">komputer</a>
                    <a href="<?php echo base_url('admin/jurusan/search?q=manajemen') ?>" class="btn btn-default btn-sm">manajemen</a>
                </div>
            </div>
            <div class="col-md-6">
                <h5>Tips Pencarian:</h5>
                <ul class="list-unstyled">
                    <li><i class="fa fa-lightbulb-o text-yellow"></i> Gunakan kata kunci yang spesifik</li>
                    <li><i class="fa fa-lightbulb-o text-yellow"></i> Kombinasikan beberapa kata kunci</li>
                    <li><i class="fa fa-lightbulb-o text-yellow"></i> Cek ejaan dan spasi</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Include Add Modal if no results -->
<?php if (empty($jurusan)) { ?>
    <?php include('tambah.php') ?>
<?php } ?>

<!-- JavaScript -->
<script>
    $(document).ready(function() {
        // Initialize DataTable for search results
        <?php if (!empty($jurusan)) { ?>
            $('#search-results').DataTable({
                "responsive": true,
                "autoWidth": false,
                "searching": false, // Disable default search since we have custom search
                "lengthChange": false,
                "info": false,
                "paging": <?php echo count($jurusan) > 10 ? 'true' : 'false' ?>,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                },
                "order": [
                    [4, "desc"]
                ], // Order by date desc
                "columnDefs": [{
                        "orderable": false,
                        "targets": [0, 5]
                    } // Disable ordering on # and Action columns
                ]
            });
        <?php } ?>

        // Auto focus on search input
        $('input[name="q"]').focus().select();

        // Search suggestions
        $('input[name="q"]').on('keyup', function() {
            var value = $(this).val();
            if (value.length > 2) {
                // You can implement AJAX suggestions here
            }
        });
    });

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
</script>

<!-- Custom CSS -->
<style>
    .empty-state {
        padding: 40px 20px;
    }

    .empty-state .fa-5x {
        font-size: 5em;
    }

    mark {
        background-color: #fff59d;
        padding: 2px 4px;
        border-radius: 3px;
        font-weight: bold;
    }

    .tag-cloud .btn {
        margin: 2px;
    }

    .bordered-darkorange {
        background-color: #ff851b;
        color: white;
    }

    .info-box {
        margin-bottom: 15px;
    }

    .box {
        margin-bottom: 20px;
    }

    .btn-group .btn {
        border-radius: 0;
    }

    .btn-group .btn:first-child {
        border-top-left-radius: 3px;
        border-bottom-left-radius: 3px;
    }

    .btn-group .btn:last-child {
        border-top-right-radius: 3px;
        border-bottom-right-radius: 3px;
    }

    .py-5 {
        padding-top: 3rem;
        padding-bottom: 3rem;
    }

    .mb-3 {
        margin-bottom: 1rem;
    }

    .mt-4 {
        margin-top: 1.5rem;
    }

    .badge {
        padding: 6px 12px;
        font-size: 12px;
    }

    .badge-success {
        background-color: #5cb85c;
    }

    .badge-warning {
        background-color: #f0ad4e;
    }
</style>