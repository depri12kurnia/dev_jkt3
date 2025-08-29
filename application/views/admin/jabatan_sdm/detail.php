<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">
            <i class="fa fa-info-circle"></i> Detail Data Jabatan SDM
        </h3>
        <div class="box-tools pull-right">
            <a href="<?php echo base_url('admin/jabatan_sdm') ?>" class="btn btn-default btn-sm">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
            <a href="<?php echo base_url('admin/jabatan_sdm/edit/' . $jabatan_sdm->id) ?>" class="btn btn-warning btn-sm">
                <i class="fa fa-edit"></i> Edit
            </a>
            <a href="<?php echo base_url('admin/jabatan_sdm/delete/' . $jabatan_sdm->id) ?>"
                class="btn btn-danger btn-sm"
                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                <i class="fa fa-trash"></i> Hapus
            </a>
        </div>
    </div>

    <div class="box-body">
        <div class="row">
            <!-- Kolom Kiri - Informasi Utama -->
            <div class="col-md-8">
                <!-- Data Jabatan -->
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <i class="fa fa-briefcase"></i> Informasi Jabatan
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-striped table-borderless">
                                    <tr>
                                        <td width="40%"><strong>Level Jabatan</strong></td>
                                        <td>
                                            <?php
                                            $level_class = 'info';
                                            $level_text = ucfirst($jabatan_sdm->level);
                                            switch ($jabatan_sdm->level) {
                                                case 'institusi':
                                                    $level_class = 'danger';
                                                    $level_text = 'Institusi';
                                                    break;
                                                case 'jurusan':
                                                    $level_class = 'warning';
                                                    $level_text = 'Jurusan';
                                                    break;
                                                case 'prodi':
                                                    $level_class = 'primary';
                                                    $level_text = 'Program Studi';
                                                    break;
                                                case 'unit':
                                                    $level_class = 'success';
                                                    $level_text = 'Unit';
                                                    break;
                                                case 'pusat':
                                                    $level_class = 'info';
                                                    $level_text = 'Pusat';
                                                    break;
                                            }
                                            ?>
                                            <span class="label label-<?php echo $level_class; ?>">
                                                <?php echo $level_text; ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nama Jabatan</strong></td>
                                        <td><?php echo $jabatan_sdm->jabatan ?></td>
                                    </tr>
                                    <?php if ($jabatan_sdm->level == 'jurusan' && !empty($jabatan_sdm->nama_jurusan)) { ?>
                                        <tr>
                                            <td><strong>Jurusan</strong></td>
                                            <td><?php echo $jabatan_sdm->nama_jurusan ?></td>
                                        </tr>
                                    <?php } elseif ($jabatan_sdm->level == 'prodi' && !empty($jabatan_sdm->nama_prodi)) { ?>
                                        <tr>
                                            <td><strong>Program Studi</strong></td>
                                            <td><?php echo $jabatan_sdm->nama_prodi ?></td>
                                        </tr>
                                    <?php } elseif ($jabatan_sdm->level == 'unit' && !empty($jabatan_sdm->nama_unit)) { ?>
                                        <tr>
                                            <td><strong>Unit</strong></td>
                                            <td><?php echo $jabatan_sdm->nama_unit ?></td>
                                        </tr>
                                    <?php } elseif ($jabatan_sdm->level == 'pusat' && !empty($jabatan_sdm->nama_pusat)) { ?>
                                        <tr>
                                            <td><strong>Pusat</strong></td>
                                            <td><?php echo $jabatan_sdm->nama_pusat ?></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-striped table-borderless">
                                    <tr>
                                        <td width="40%"><strong>Periode Mulai</strong></td>
                                        <td><?php echo $jabatan_sdm->periode_mulai ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Periode Akhir</strong></td>
                                        <td><?php echo $jabatan_sdm->periode_akhir ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Durasi</strong></td>
                                        <td>
                                            <?php
                                            $durasi = $jabatan_sdm->periode_akhir - $jabatan_sdm->periode_mulai + 1;
                                            echo $durasi . ' tahun';
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status Periode</strong></td>
                                        <td>
                                            <?php
                                            $tahun_sekarang = date('Y');
                                            if ($jabatan_sdm->periode_mulai > $tahun_sekarang) {
                                                echo '<span class="label label-info">Belum Mulai</span>';
                                            } elseif ($jabatan_sdm->periode_mulai <= $tahun_sekarang && $jabatan_sdm->periode_akhir >= $tahun_sekarang) {
                                                echo '<span class="label label-success">Aktif</span>';
                                            } else {
                                                echo '<span class="label label-default">Berakhir</span>';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data SDM -->
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <i class="fa fa-user"></i> Informasi SDM
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="text-center">
                                    <?php if (!empty($jabatan_sdm->foto_url) && file_exists('./assets/img/sdm/' . $jabatan_sdm->foto_url)) { ?>
                                        <img src="<?php echo base_url('assets/img/sdm/' . $jabatan_sdm->foto_url) ?>"
                                            class="img-thumbnail"
                                            style="width: 150px; height: 150px; object-fit: cover;"
                                            alt="Foto <?php echo $jabatan_sdm->nama_sdm ?>">
                                    <?php } else { ?>
                                        <div class="img-thumbnail" style="width: 150px; height: 150px; display: flex; align-items: center; justify-content: center; background-color: #f5f5f5;">
                                            <i class="fa fa-user fa-4x text-muted"></i>
                                        </div>
                                    <?php } ?>
                                    <p class="text-muted" style="margin-top: 10px;">
                                        <small>Foto SDM</small>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <table class="table table-striped table-borderless">
                                    <tr>
                                        <td width="30%"><strong>Nama Lengkap</strong></td>
                                        <td><?php echo $jabatan_sdm->nama_sdm ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>NIP</strong></td>
                                        <td><?php echo !empty($jabatan_sdm->nip) ? $jabatan_sdm->nip : '-' ?></td>
                                    </tr>
                                    <?php if (!empty($jabatan_sdm->email)) { ?>
                                        <tr>
                                            <td><strong>Email</strong></td>
                                            <td>
                                                <a href="mailto:<?php echo $jabatan_sdm->email ?>">
                                                    <?php echo $jabatan_sdm->email ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php if (!empty($jabatan_sdm->no_hp)) { ?>
                                        <tr>
                                            <td><strong>No. HP</strong></td>
                                            <td>
                                                <a href="tel:<?php echo $jabatan_sdm->no_hp ?>">
                                                    <?php echo $jabatan_sdm->no_hp ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td><strong>ID SDM</strong></td>
                                        <td>
                                            <code><?php echo $jabatan_sdm->sdm_id ?></code>
                                            <a href="<?php echo base_url('admin/sdm/detail/' . $jabatan_sdm->sdm_id) ?>"
                                                class="btn btn-xs btn-link" target="_blank">
                                                <i class="fa fa-external-link"></i> Lihat Detail SDM
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Timeline Jabatan -->
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <i class="fa fa-clock-o"></i> Timeline Jabatan
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="timeline-container">
                            <div class="timeline-item">
                                <div class="timeline-icon bg-blue">
                                    <i class="fa fa-play"></i>
                                </div>
                                <div class="timeline-content">
                                    <h4>Mulai Jabatan</h4>
                                    <p>
                                        <strong><?php echo $jabatan_sdm->periode_mulai ?></strong> -
                                        Mulai menjabat sebagai <?php echo $jabatan_sdm->jabatan ?>
                                    </p>
                                </div>
                            </div>

                            <?php
                            $tahun_sekarang = date('Y');
                            if ($jabatan_sdm->periode_mulai <= $tahun_sekarang && $jabatan_sdm->periode_akhir >= $tahun_sekarang) {
                            ?>
                                <div class="timeline-item">
                                    <div class="timeline-icon bg-green">
                                        <i class="fa fa-check"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h4>Saat Ini</h4>
                                        <p>
                                            <strong><?php echo $tahun_sekarang ?></strong> -
                                            Sedang aktif menjabat
                                            <span class="label label-success">AKTIF</span>
                                        </p>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="timeline-item">
                                <div class="timeline-icon bg-<?php echo ($jabatan_sdm->periode_akhir < $tahun_sekarang) ? 'gray' : 'orange' ?>">
                                    <i class="fa fa-stop"></i>
                                </div>
                                <div class="timeline-content">
                                    <h4>Akhir Jabatan</h4>
                                    <p>
                                        <strong><?php echo $jabatan_sdm->periode_akhir ?></strong> -
                                        <?php echo ($jabatan_sdm->periode_akhir < $tahun_sekarang) ? 'Telah berakhir' : 'Akan berakhir' ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan - Actions & Riwayat -->
            <div class="col-md-4">
                <!-- Quick Actions -->
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <i class="fa fa-cogs"></i> Quick Actions
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="btn-group-vertical btn-group-sm" style="width: 100%;">
                            <a href="<?php echo base_url('admin/jabatan_sdm/edit/' . $jabatan_sdm->id) ?>"
                                class="btn btn-warning">
                                <i class="fa fa-edit"></i> Edit Data
                            </a>
                            <a href="<?php echo base_url('admin/jabatan_sdm/riwayat/' . $jabatan_sdm->sdm_id) ?>"
                                class="btn btn-info">
                                <i class="fa fa-history"></i> Riwayat Jabatan SDM
                            </a>
                            <a href="<?php echo base_url('admin/sdm/detail/' . $jabatan_sdm->sdm_id) ?>"
                                class="btn btn-primary" target="_blank">
                                <i class="fa fa-user"></i> Detail SDM
                            </a>
                            <?php if ($jabatan_sdm->level == 'jurusan' && !empty($jabatan_sdm->jurusan_id)) { ?>
                                <a href="<?php echo base_url('admin/jurusan/detail/' . $jabatan_sdm->jurusan_id) ?>"
                                    class="btn btn-success" target="_blank">
                                    <i class="fa fa-building"></i> Detail Jurusan
                                </a>
                            <?php } elseif ($jabatan_sdm->level == 'prodi' && !empty($jabatan_sdm->prodi_id)) { ?>
                                <a href="<?php echo base_url('admin/prodi/detail/' . $jabatan_sdm->prodi_id) ?>"
                                    class="btn btn-success" target="_blank">
                                    <i class="fa fa-graduation-cap"></i> Detail Prodi
                                </a>
                            <?php } elseif ($jabatan_sdm->level == 'unit' && !empty($jabatan_sdm->unit_id)) { ?>
                                <a href="<?php echo base_url('admin/unit/detail/' . $jabatan_sdm->unit_id) ?>"
                                    class="btn btn-success" target="_blank">
                                    <i class="fa fa-cubes"></i> Detail Unit
                                </a>
                            <?php } elseif ($jabatan_sdm->level == 'pusat' && !empty($jabatan_sdm->pusat_id)) { ?>
                                <a href="<?php echo base_url('admin/pusat/detail/' . $jabatan_sdm->pusat_id) ?>"
                                    class="btn btn-success" target="_blank">
                                    <i class="fa fa-dot-circle-o"></i> Detail Pusat
                                </a>
                            <?php } ?>
                        </div>
                        <hr>
                        <div class="btn-group btn-group-sm" style="width: 100%;">
                            <button type="button" class="btn btn-default dropdown-toggle"
                                data-toggle="dropdown" style="width: 100%;">
                                <i class="fa fa-print"></i> Export <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" style="width: 100%;">
                                <li>
                                    <a href="#" onclick="window.print()">
                                        <i class="fa fa-print"></i> Print Halaman
                                    </a>
                                </li>
                                <li>
                                    <a href="#" onclick="exportToPDF()">
                                        <i class="fa fa-file-pdf-o"></i> Export PDF
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Statistik Singkat -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <i class="fa fa-bar-chart"></i> Statistik
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="row text-center">
                            <div class="col-xs-6">
                                <div class="stat-item">
                                    <h3 class="text-primary"><?php echo $jabatan_sdm->periode_akhir - $jabatan_sdm->periode_mulai + 1 ?></h3>
                                    <p class="text-muted">Tahun Jabatan</p>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="stat-item">
                                    <h3 class="text-success">
                                        <?php
                                        if ($jabatan_sdm->periode_akhir >= $tahun_sekarang) {
                                            echo $jabatan_sdm->periode_akhir - $tahun_sekarang + 1;
                                        } else {
                                            echo '0';
                                        }
                                        ?>
                                    </h3>
                                    <p class="text-muted">Sisa Tahun</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="progress">
                            <?php
                            $total_tahun = $jabatan_sdm->periode_akhir - $jabatan_sdm->periode_mulai + 1;
                            $tahun_berjalan = $tahun_sekarang - $jabatan_sdm->periode_mulai + 1;
                            $persentase = min(100, max(0, ($tahun_berjalan / $total_tahun) * 100));
                            ?>
                            <div class="progress-bar progress-bar-success"
                                style="width: <?php echo $persentase ?>%">
                                <?php echo round($persentase, 1) ?>%
                            </div>
                        </div>
                        <p class="text-center text-muted">
                            <small>Progress periode jabatan</small>
                        </p>
                    </div>
                </div>

                <!-- Informasi Sistem -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <i class="fa fa-info"></i> Informasi Sistem
                        </h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-condensed table-borderless">
                            <tr>
                                <td><strong>ID Jabatan</strong></td>
                                <td><code><?php echo $jabatan_sdm->id ?></code></td>
                            </tr>
                            <tr>
                                <td><strong>Dibuat</strong></td>
                                <td>
                                    <?php
                                    if (isset($jabatan_sdm->created_at)) {
                                        echo date('d/m/Y H:i', strtotime($jabatan_sdm->created_at));
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Diupdate</strong></td>
                                <td>
                                    <?php
                                    if (isset($jabatan_sdm->updated_at)) {
                                        echo date('d/m/Y H:i', strtotime($jabatan_sdm->updated_at));
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk fungsi tambahan -->
<script>
    $(document).ready(function() {
        console.log('Detail Jabatan SDM page loaded');

        // Function untuk export PDF
        window.exportToPDF = function() {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Export PDF',
                    text: 'Fitur export PDF akan segera tersedia',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            } else {
                alert('Fitur export PDF akan segera tersedia');
            }
        };

        // Print styling
        $('<style type="text/css" media="print">')
            .html(`
            @media print {
                .box-tools, .btn, .panel:not(.panel-primary):not(.panel-info) {
                    display: none !important;
                }
                .box {
                    box-shadow: none !important;
                    border: 1px solid #ddd !important;
                }
                .panel {
                    break-inside: avoid;
                }
                body { 
                    font-size: 12px !important; 
                }
                .col-md-4 {
                    display: none !important;
                }
                .col-md-8 {
                    width: 100% !important;
                }
            }
        `)
            .appendTo('head');

        // Smooth scroll untuk anchors
        $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            const target = $(this.getAttribute('href'));
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 20
                }, 500);
            }
        });

        // Tooltip untuk icons
        $('[data-toggle="tooltip"]').tooltip();

        // Auto refresh setiap 5 menit untuk status periode
        setTimeout(function() {
            location.reload();
        }, 300000); // 5 menit
    });
</script>

<!-- Enhanced CSS untuk Detail View -->
<style>
    /* Box styling */
    .box-header {
        border-bottom: 1px solid #ddd;
        padding: 15px 20px;
    }

    .box-title {
        font-size: 18px;
        font-weight: 600;
        color: #333;
    }

    /* Panel styling */
    .panel {
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        border: 1px solid #ddd;
    }

    .panel-heading {
        border-radius: 8px 8px 0 0;
        font-weight: 600;
        padding: 12px 15px;
    }

    .panel-body {
        padding: 15px;
    }

    /* Table styling */
    .table-borderless td {
        border: none !important;
        padding: 8px 0;
        font-size: 14px;
    }

    .table-borderless td:first-child {
        vertical-align: top;
        color: #666;
    }

    .table-borderless td:last-child {
        font-weight: 500;
    }

    /* Timeline styling */
    .timeline-container {
        position: relative;
        padding-left: 30px;
    }

    .timeline-container::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #ddd;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 30px;
    }

    .timeline-icon {
        position: absolute;
        left: -22px;
        top: 0;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 12px;
    }

    .timeline-content {
        background: #f9f9f9;
        padding: 15px;
        border-radius: 5px;
        border-left: 3px solid #3c8dbc;
    }

    .timeline-content h4 {
        margin: 0 0 5px 0;
        font-size: 16px;
        color: #333;
    }

    .timeline-content p {
        margin: 0;
        color: #666;
    }

    /* Background colors */
    .bg-blue {
        background-color: #3c8dbc;
    }

    .bg-green {
        background-color: #00a65a;
    }

    .bg-orange {
        background-color: #f39c12;
    }

    .bg-gray {
        background-color: #95a5a6;
    }

    /* Button styling */
    .btn-group-vertical .btn {
        margin-bottom: 5px;
        border-radius: 4px !important;
    }

    .btn-group-vertical .btn:last-child {
        margin-bottom: 0;
    }

    /* Stat items */
    .stat-item {
        padding: 10px;
        text-align: center;
    }

    .stat-item h3 {
        margin: 0 0 5px 0;
        font-size: 24px;
        font-weight: bold;
    }

    .stat-item p {
        margin: 0;
        font-size: 12px;
        text-transform: uppercase;
    }

    /* Progress bar */
    .progress {
        height: 20px;
        margin-bottom: 10px;
        border-radius: 10px;
    }

    .progress-bar {
        line-height: 20px;
        font-size: 12px;
        font-weight: bold;
    }

    /* Labels */
    .label {
        font-size: 11px;
        padding: 4px 8px;
        border-radius: 3px;
    }

    /* Image styling */
    .img-thumbnail {
        border: 2px solid #ddd;
        border-radius: 8px;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .col-md-4 {
            margin-top: 20px;
        }

        .timeline-container {
            padding-left: 20px;
        }

        .timeline-icon {
            left: -15px;
            width: 25px;
            height: 25px;
            font-size: 10px;
        }

        .timeline-container::before {
            left: 12px;
        }

        .btn-group-vertical .btn {
            font-size: 12px;
            padding: 8px 12px;
        }
    }

    /* Print styles */
    @media print {

        .box-tools,
        .btn,
        .timeline-container,
        .panel-warning,
        .panel-default {
            display: none !important;
        }

        .col-md-4 {
            display: none !important;
        }

        .col-md-8 {
            width: 100% !important;
        }

        .panel {
            break-inside: avoid;
            margin-bottom: 15px;
        }

        .panel-heading {
            background: #f5f5f5 !important;
            color: #333 !important;
        }

        body {
            font-size: 12px !important;
            line-height: 1.4 !important;
        }

        .table-borderless td {
            padding: 4px 0;
            font-size: 11px;
        }
    }

    /* Animation */
    .panel {
        transition: all 0.3s ease;
    }

    .panel:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .btn {
        transition: all 0.2s ease;
    }

    /* Code styling */
    code {
        background-color: #f8f9fa;
        color: #e83e8c;
        padding: 2px 4px;
        border-radius: 3px;
        font-size: 12px;
    }

    /* Links */
    a {
        color: #3c8dbc;
        text-decoration: none;
    }

    a:hover {
        color: #2a6496;
        text-decoration: underline;
    }

    /* External link icon */
    .fa-external-link {
        font-size: 11px;
        margin-left: 3px;
    }

    /* Small text */
    small {
        font-size: 11px;
        color: #999;
    }
</style>