<!-- Search Box -->
<div class="row mb-3">
    <div class="col-md-6">
        <form method="GET" action="<?php echo base_url('admin/sdm/search') ?>">
            <div class="input-group">
                <input type="text" class="form-control" name="q" placeholder="Cari nama, NIP, atau email..." value="<?php echo isset($keyword) ? $keyword : '' ?>">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </form>
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
    <a href="<?php echo base_url('admin/sdm/tambah') ?>" class="btn btn-primary">
        <i class="fa fa-plus"></i> Tambah Data SDM
    </a>
</p>

<!-- Bulk Action Form -->
<form action="<?php echo base_url('admin/sdm/proses') ?>" method="post" class="form-horizontal">

    <!-- Data Table -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Data SDM</h3>
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
                        <th width="10%">Foto</th>
                        <th width="20%">Nama</th>
                        <th width="15%">NIP</th>
                        <th width="10%">Jenis Kelamin</th>
                        <th width="20%">Email</th>
                        <th width="12%">No. HP</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($sdm)) { ?>
                        <?php $i = 1;
                        foreach ($sdm as $row) { ?>
                            <tr class="odd gradeX">
                                <td>
                                    <input type="checkbox" name="id_sdm[]" value="<?php echo $row->id ?>">
                                </td>
                                <td><?php echo $i ?></td>
                                <td class="text-center">
                                    <?php if (!empty($row->foto_url)) { ?>
                                        <img src="<?php echo base_url('assets/upload/sdm/' . $row->foto_url) ?>"
                                            alt="Foto <?php echo $row->nama ?>"
                                            class="img-circle"
                                            width="40"
                                            height="40"
                                            style="object-fit: cover;">
                                    <?php } else { ?>
                                        <div class="bg-gray text-center" style="width: 40px; height: 40px; border-radius: 50%; line-height: 40px; margin: 0 auto;">
                                            <i class="fa fa-user text-white"></i>
                                        </div>
                                    <?php } ?>
                                </td>
                                <td>
                                    <strong><?php echo $row->nama ?></strong>
                                </td>
                                <td>
                                    <?php if (!empty($row->nip)) { ?>
                                        <code><?php echo $row->nip ?></code>
                                    <?php } else { ?>
                                        <em class="text-muted">-</em>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($row->jenis_kelamin == 'L') { ?>
                                        <span class="label label-primary">Laki-laki</span>
                                    <?php } elseif ($row->jenis_kelamin == 'P') { ?>
                                        <span class="label label-warning">Perempuan</span>
                                    <?php } else { ?>
                                        <em class="text-muted">-</em>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if (!empty($row->email)) { ?>
                                        <a href="mailto:<?php echo $row->email ?>" class="text-blue">
                                            <?php echo $row->email ?>
                                        </a>
                                    <?php } else { ?>
                                        <em class="text-muted">-</em>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if (!empty($row->no_hp)) { ?>
                                        <a href="tel:<?php echo $row->no_hp ?>" class="text-green">
                                            <?php echo $row->no_hp ?>
                                        </a>
                                    <?php } else { ?>
                                        <em class="text-muted">-</em>
                                    <?php } ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <!-- Edit Button -->
                                        <a href="<?php echo base_url('admin/sdm/edit/' . $row->id) ?>"
                                            class="btn btn-warning btn-xs"
                                            title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <a href="<?php echo base_url('admin/sdm/delete/' . $row->id) ?>"
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
                                    <p class="text-muted">Tidak ada data SDM</p>
                                    <a href="<?php echo base_url('admin/sdm/tambah') ?>" class="btn btn-primary btn-sm">
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
                <span class="info-box-text">Total SDM</span>
                <span class="info-box-number"><?php echo count($sdm) ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-male"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Laki-laki</span>
                <span class="info-box-number">
                    <?php
                    $laki_count = 0;
                    foreach ($sdm as $row) {
                        if ($row->jenis_kelamin == 'L') {
                            $laki_count++;
                        }
                    }
                    echo $laki_count;
                    ?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-pink"><i class="fa fa-female"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Perempuan</span>
                <span class="info-box-number">
                    <?php
                    $perempuan_count = 0;
                    foreach ($sdm as $row) {
                        if ($row->jenis_kelamin == 'P') {
                            $perempuan_count++;
                        }
                    }
                    echo $perempuan_count;
                    ?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-check-circle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Dengan Foto</span>
                <span class="info-box-number">
                    <?php
                    $foto_count = 0;
                    foreach ($sdm as $row) {
                        if (!empty($row->foto_url)) {
                            $foto_count++;
                        }
                    }
                    echo $foto_count;
                    ?>
                </span>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk DataTable dan Konfirmasi Delete -->
<script>
    $(document).ready(function() {
        console.log('Starting SDM List initialization...');

        // Function to safely initialize DataTable
        function initializeDataTable() {
            const table = $('#example1');

            // Check if table exists
            if (!table.length) {
                console.log('Table #example1 not found');
                return false;
            }

            // Check table structure
            const thead = table.find('thead tr th');
            const tbody = table.find('tbody tr');

            console.log('Table structure check:', {
                'thead columns': thead.length,
                'tbody rows': tbody.length,
                'has data': tbody.length > 0 && !tbody.first().find('td[colspan]').length
            });

            // Skip DataTable if no data or only empty state
            if (tbody.length === 0 || tbody.first().find('td[colspan]').length > 0) {
                console.log('No data found, skipping DataTable initialization');
                table.addClass('table-striped table-hover');
                return false;
            }

            // Validate table structure consistency
            let isValidStructure = true;
            tbody.each(function(index) {
                const cells = $(this).find('td');
                if (cells.length !== thead.length) {
                    console.log(`Row ${index} has ${cells.length} cells, expected ${thead.length}`);
                    isValidStructure = false;
                }
            });

            if (!isValidStructure) {
                console.log('Table structure inconsistent, using fallback styling');
                table.addClass('table-striped table-hover');
                return false;
            }

            // Try to initialize DataTable
            try {
                // Destroy existing DataTable if it exists
                if ($.fn.DataTable.isDataTable('#example1')) {
                    table.DataTable().destroy();
                }

                // Clear any existing DataTable classes
                table.removeClass('dataTable');

                const dataTable = table.DataTable({
                    "destroy": true,
                    "responsive": true,
                    "autoWidth": false,
                    "processing": false,
                    "serverSide": false,
                    "deferRender": true,
                    "language": {
                        "lengthMenu": "Tampilkan _MENU_ data per halaman",
                        "zeroRecords": "Data tidak ditemukan",
                        "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                        "infoEmpty": "Tidak ada data yang tersedia",
                        "infoFiltered": "(difilter dari _MAX_ total data)",
                        "search": "Cari:",
                        "loadingRecords": "Memuat...",
                        "processing": "Memproses...",
                        "paginate": {
                            "first": "Pertama",
                            "last": "Terakhir",
                            "next": "Selanjutnya",
                            "previous": "Sebelumnya"
                        }
                    },
                    "order": [
                        [3, "asc"]
                    ], // Order by nama
                    "columnDefs": [{
                        "orderable": false,
                        "searchable": false,
                        "targets": [0, 2, 8] // checkbox, foto, action columns
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
                        // Re-initialize event handlers after redraw
                        initializeRowEvents();
                        $('[data-toggle="tooltip"]').tooltip();
                    },
                    "initComplete": function(settings, json) {
                        console.log('DataTable initialized successfully');
                        initializeRowEvents();
                    },
                    "error": function(xhr, error, thrown) {
                        console.error('DataTable error:', error, thrown);
                        return false;
                    }
                });

                return true;

            } catch (error) {
                console.error('DataTable initialization failed:', error);

                // Fallback: Add basic styling and functionality
                table.addClass('table-striped table-hover');
                initializeRowEvents();
                return false;
            }
        }

        // Initialize row-specific events
        function initializeRowEvents() {
            // Image hover effects
            $('img.img-circle').off('mouseenter mouseleave').on({
                'mouseenter': function() {
                    $(this).addClass('img-hover');
                },
                'mouseleave': function() {
                    $(this).removeClass('img-hover');
                }
            });

            // Image error handling
            $('img').off('error').on('error', function() {
                const $this = $(this);
                if (!$this.hasClass('error-handled')) {
                    $this.addClass('error-handled').hide();
                    $this.after('<div class="bg-gray text-center" style="width: 40px; height: 40px; border-radius: 50%; line-height: 40px; margin: 0 auto;"><i class="fa fa-user text-white"></i></div>');
                }
            });

            // Tooltip initialization
            $('[title]').tooltip();
        }

        // Initialize DataTable with delay
        setTimeout(function() {
            console.log('Attempting DataTable initialization...');
            initializeDataTable();

            // Initialize other components
            initializeCheckboxes();
            initializeBulkActions();
            initializeAlerts();

        }, 100);

        // Checkbox functionality
        function initializeCheckboxes() {
            // Check All functionality
            $('#checkAll').off('change').on('change', function() {
                const isChecked = this.checked;
                $('input[name="id_sdm[]"]').prop('checked', isChecked);
                updateBulkActionState();
            });

            // Individual checkbox change
            $(document).off('change', 'input[name="id_sdm[]"]').on('change', 'input[name="id_sdm[]"]', function() {
                const $checkboxes = $('input[name="id_sdm[]"]');
                const $checked = $checkboxes.filter(':checked');

                $('#checkAll').prop('checked', $checked.length === $checkboxes.length);
                updateBulkActionState();
            });
        }

        // Bulk actions functionality
        function initializeBulkActions() {
            // Update bulk action button state
            function updateBulkActionState() {
                const checkedCount = $('input[name="id_sdm[]"]:checked').length;
                const $bulkBtn = $('button[name="hapus"]');

                if (checkedCount > 0) {
                    $bulkBtn.removeClass('btn-default').addClass('btn-danger').prop('disabled', false);
                    $bulkBtn.html('<i class="fa fa-trash"></i> Hapus ' + checkedCount + ' Terpilih');
                } else {
                    $bulkBtn.removeClass('btn-danger').addClass('btn-default').prop('disabled', true);
                    $bulkBtn.html('<i class="fa fa-trash"></i> Hapus Terpilih');
                }
            }

            // Make updateBulkActionState available globally
            window.updateBulkActionState = updateBulkActionState;

            // Initial state
            updateBulkActionState();

            // Bulk delete confirmation
            $('form').off('submit').on('submit', function(e) {
                const $form = $(this);
                if ($form.find('button[name="hapus"]').length > 0) {
                    const checkedCount = $('input[name="id_sdm[]"]:checked').length;

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
                        text: `Yakin ingin menghapus ${checkedCount} data SDM?`,
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

                            // Submit form after short delay
                            setTimeout(() => {
                                $form.off('submit').submit();
                            }, 500);
                        }
                    });
                }
            });
        }

        // Alert management
        function initializeAlerts() {
            // Auto hide alerts
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);
        }

        // Search functionality
        $('form[action*="search"] input[name="q"]').on('keyup debounce', function() {
            const query = $(this).val();
            if (query.length >= 3 || query.length === 0) {
                // Auto-search can be implemented here
            }
        });

        console.log('SDM List JavaScript initialization completed');
    });

    // Delete confirmation function
    function confirmation(event) {
        event.preventDefault();
        const url = event.target.closest('a').href;
        const $row = $(event.target).closest('tr');
        const nama = $row.find('td:nth-child(4) strong').text().trim() || 'data ini';

        Swal.fire({
            title: 'Apakah Anda yakin?',
            html: `Data SDM <strong>${nama}</strong> akan dihapus secara permanen!`,
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
            link.download = 'data_sdm_' + new Date().toISOString().slice(0, 10) + '.xlsx';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            Swal.close();
        }, 1000);
    });

    // Quick search function
    function quickSearch(query) {
        if (query.length >= 3) {
            window.location.href = '<?php echo base_url("admin/sdm/search") ?>?q=' + encodeURIComponent(query);
        } else if (query.length === 0) {
            window.location.href = '<?php echo base_url("admin/sdm") ?>';
        }
    }
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
        cursor: pointer;
    }

    .table td {
        vertical-align: middle !important;
        padding: 12px 8px;
        border-bottom: 1px solid #eee;
    }

    /* Checkbox styling */
    input[type="checkbox"] {
        transform: scale(1.2);
        margin: 0;
    }

    /* Image hover effects */
    .img-hover {
        transform: scale(1.3);
        transition: transform 0.3s ease;
        z-index: 1000;
        position: relative;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        border-radius: 50%;
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

    /* Button group improvements */
    .btn-group .btn {
        margin-right: 3px;
        border-radius: 3px;
    }

    .btn-group .btn:last-child {
        margin-right: 0;
    }

    .btn-xs {
        padding: 3px 8px;
        font-size: 11px;
        line-height: 1.5;
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

    .alert-warning {
        border-left-color: #f39c12;
        background-color: #fff3cd;
        color: #856404;
    }

    /* Responsive improvements */
    @media (max-width: 768px) {
        .table-responsive {
            border: none;
        }

        .btn-group {
            display: flex;
            flex-direction: column;
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
</style>