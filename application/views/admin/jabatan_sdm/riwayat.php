<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">
            <i class="fa fa-history"></i> Riwayat Jabatan SDM
        </h3>
        <div class="box-tools pull-right">
            <a href="<?php echo base_url('admin/jabatan_sdm') ?>" class="btn btn-default btn-sm">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
            <a href="<?php echo base_url('admin/sdm/detail/' . $sdm->id) ?>" class="btn btn-info btn-sm" target="_blank">
                <i class="fa fa-user"></i> Detail SDM
            </a>
        </div>
    </div>

    <div class="box-body">
        <!-- Header SDM Info -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <i class="fa fa-user"></i> Informasi SDM
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="text-center">
                                    <?php if (!empty($sdm->foto_url) && file_exists('./assets/img/sdm/' . $sdm->foto_url)) { ?>
                                        <img src="<?php echo base_url('assets/img/sdm/' . $sdm->foto_url) ?>"
                                            class="img-thumbnail"
                                            style="width: 120px; height: 120px; object-fit: cover;"
                                            alt="Foto <?php echo $sdm->nama ?>">
                                    <?php } else { ?>
                                        <div class="img-thumbnail" style="width: 120px; height: 120px; display: flex; align-items: center; justify-content: center; background-color: #f5f5f5;">
                                            <i class="fa fa-user fa-3x text-muted"></i>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="40%"><strong>Nama Lengkap</strong></td>
                                        <td><?php echo $sdm->nama ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>NIP</strong></td>
                                        <td><?php echo !empty($sdm->nip) ? $sdm->nip : '-' ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>ID SDM</strong></td>
                                        <td><code><?php echo $sdm->id ?></code></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-5">
                                <table class="table table-borderless">
                                    <?php if (!empty($sdm->email)) { ?>
                                        <tr>
                                            <td width="40%"><strong>Email</strong></td>
                                            <td><a href="mailto:<?php echo $sdm->email ?>"><?php echo $sdm->email ?></a></td>
                                        </tr>
                                    <?php } ?>
                                    <?php if (!empty($sdm->no_hp)) { ?>
                                        <tr>
                                            <td><strong>No. HP</strong></td>
                                            <td><a href="tel:<?php echo $sdm->no_hp ?>"><?php echo $sdm->no_hp ?></a></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td><strong>Total Jabatan</strong></td>
                                        <td>
                                            <span class="label label-info"><?php echo count($riwayat) ?> Jabatan</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Jabatan -->
        <div class="row">
            <div class="col-md-8">
                <?php if (empty($riwayat)) { ?>
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle"></i>
                        <strong>Belum Ada Riwayat Jabatan</strong><br>
                        SDM ini belum memiliki riwayat jabatan dalam sistem.
                    </div>
                <?php } else { ?>
                    <!-- Timeline Jabatan -->
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <i class="fa fa-timeline"></i> Timeline Jabatan
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div class="timeline-container">
                                <?php
                                $tahun_sekarang = date('Y');
                                foreach ($riwayat as $index => $jabatan) {
                                    $is_active = ($jabatan->periode_mulai <= $tahun_sekarang && $jabatan->periode_akhir >= $tahun_sekarang);
                                    $is_future = ($jabatan->periode_mulai > $tahun_sekarang);
                                    $is_past = ($jabatan->periode_akhir < $tahun_sekarang);
                                ?>
                                    <div class="timeline-item <?php echo $is_active ? 'active' : ($is_future ? 'future' : 'past') ?>">
                                        <div class="timeline-icon bg-<?php echo $is_active ? 'green' : ($is_future ? 'blue' : 'gray') ?>">
                                            <i class="fa fa-<?php echo $is_active ? 'check' : ($is_future ? 'clock-o' : 'history') ?>"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="timeline-header">
                                                <h4 class="timeline-title">
                                                    <?php echo $jabatan->jabatan ?>
                                                    <?php if ($is_active) { ?>
                                                        <span class="label label-success pull-right">AKTIF</span>
                                                    <?php } elseif ($is_future) { ?>
                                                        <span class="label label-info pull-right">AKAN DATANG</span>
                                                    <?php } else { ?>
                                                        <span class="label label-default pull-right">SELESAI</span>
                                                    <?php } ?>
                                                </h4>
                                                <p class="timeline-period">
                                                    <i class="fa fa-calendar"></i>
                                                    <strong><?php echo $jabatan->periode_mulai ?> - <?php echo $jabatan->periode_akhir ?></strong>
                                                    <span class="text-muted">
                                                        (<?php echo ($jabatan->periode_akhir - $jabatan->periode_mulai + 1) ?> tahun)
                                                    </span>
                                                </p>
                                            </div>

                                            <div class="timeline-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <table class="table table-condensed table-borderless">
                                                            <tr>
                                                                <td width="35%"><strong>Level</strong></td>
                                                                <td>
                                                                    <?php
                                                                    $level_class = 'info';
                                                                    $level_text = ucfirst($jabatan->level);
                                                                    switch ($jabatan->level) {
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
                                                                    <span class="label label-<?php echo $level_class ?>">
                                                                        <?php echo $level_text ?>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <?php if ($jabatan->level == 'jurusan' && !empty($jabatan->nama_jurusan)) { ?>
                                                                <tr>
                                                                    <td><strong>Jurusan</strong></td>
                                                                    <td><?php echo $jabatan->nama_jurusan ?></td>
                                                                </tr>
                                                            <?php } elseif ($jabatan->level == 'prodi' && !empty($jabatan->nama_prodi)) { ?>
                                                                <tr>
                                                                    <td><strong>Prodi</strong></td>
                                                                    <td><?php echo $jabatan->nama_prodi ?></td>
                                                                </tr>
                                                            <?php } elseif ($jabatan->level == 'unit' && !empty($jabatan->nama_unit)) { ?>
                                                                <tr>
                                                                    <td><strong>Unit</strong></td>
                                                                    <td><?php echo $jabatan->nama_unit ?></td>
                                                                </tr>
                                                            <?php } elseif ($jabatan->level == 'pusat' && !empty($jabatan->nama_pusat)) { ?>
                                                                <tr>
                                                                    <td><strong>Pusat</strong></td>
                                                                    <td><?php echo $jabatan->nama_pusat ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </table>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="btn-group-vertical btn-group-xs" style="width: 100%;">
                                                            <a href="<?php echo base_url('admin/jabatan_sdm/detail/' . $jabatan->id) ?>"
                                                                class="btn btn-info btn-xs">
                                                                <i class="fa fa-eye"></i> Lihat Detail
                                                            </a>
                                                            <a href="<?php echo base_url('admin/jabatan_sdm/edit/' . $jabatan->id) ?>"
                                                                class="btn btn-warning btn-xs">
                                                                <i class="fa fa-edit"></i> Edit
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <!-- End Timeline -->
                                <div class="timeline-item">
                                    <div class="timeline-icon bg-gray">
                                        <i class="fa fa-flag"></i>
                                    </div>
                                    <div class="timeline-end">
                                        <p class="text-muted text-center">
                                            <em>Riwayat jabatan lengkap</em>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Riwayat (Alternative View) -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <i class="fa fa-table"></i> Tabel Riwayat Jabatan
                                <button type="button" class="btn btn-xs btn-primary pull-right" onclick="toggleTableView()">
                                    <i class="fa fa-eye" id="toggle-icon"></i> <span id="toggle-text">Tampilkan Tabel</span>
                                </button>
                            </h4>
                        </div>
                        <div class="panel-body" id="table-view" style="display: none;">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="riwayat-table">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th width="5%">No</th>
                                            <th width="20%">Jabatan</th>
                                            <th width="15%">Level</th>
                                            <th width="20%">Unit Kerja</th>
                                            <th width="15%">Periode</th>
                                            <th width="10%">Durasi</th>
                                            <th width="10%">Status</th>
                                            <th width="5%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($riwayat as $jabatan) {
                                            $is_active = ($jabatan->periode_mulai <= $tahun_sekarang && $jabatan->periode_akhir >= $tahun_sekarang);
                                            $is_future = ($jabatan->periode_mulai > $tahun_sekarang);
                                            $level_class = 'info';
                                            $level_text = ucfirst($jabatan->level);
                                            switch ($jabatan->level) {
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
                                            <tr class="<?php echo $is_active ? 'success' : ($is_future ? 'info' : '') ?>">
                                                <td class="text-center"><?php echo $no++ ?></td>
                                                <td>
                                                    <strong><?php echo $jabatan->jabatan ?></strong>
                                                    <?php if ($is_active) { ?>
                                                        <br><small class="text-success"><i class="fa fa-check-circle"></i> Aktif</small>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <span class="label label-<?php echo $level_class ?>">
                                                        <?php echo $level_text ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($jabatan->level == 'jurusan' && !empty($jabatan->nama_jurusan)) {
                                                        echo $jabatan->nama_jurusan;
                                                    } elseif ($jabatan->level == 'prodi' && !empty($jabatan->nama_prodi)) {
                                                        echo $jabatan->nama_prodi;
                                                    } elseif ($jabatan->level == 'unit' && !empty($jabatan->nama_unit)) {
                                                        echo $jabatan->nama_unit;
                                                    } elseif ($jabatan->level == 'pusat' && !empty($jabatan->nama_pusat)) {
                                                        echo $jabatan->nama_pusat;
                                                    } else {
                                                        echo '<span class="text-muted">Institusi</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $jabatan->periode_mulai ?> - <?php echo $jabatan->periode_akhir ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo ($jabatan->periode_akhir - $jabatan->periode_mulai + 1) ?> tahun
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($is_active) {
                                                        echo '<span class="label label-success">Aktif</span>';
                                                    } elseif ($is_future) {
                                                        echo '<span class="label label-info">Akan Datang</span>';
                                                    } else {
                                                        echo '<span class="label label-default">Selesai</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-xs">
                                                        <a href="<?php echo base_url('admin/jabatan_sdm/detail/' . $jabatan->id) ?>"
                                                            class="btn btn-info btn-xs" title="Detail">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="<?php echo base_url('admin/jabatan_sdm/edit/' . $jabatan->id) ?>"
                                                            class="btn btn-warning btn-xs" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- Sidebar Statistik & Actions -->
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
                            <a href="<?php echo base_url('admin/jabatan_sdm/tambah?sdm_id=' . $sdm->id) ?>"
                                class="btn btn-success">
                                <i class="fa fa-plus"></i> Tambah Jabatan Baru
                            </a>
                            <a href="<?php echo base_url('admin/sdm/detail/' . $sdm->id) ?>"
                                class="btn btn-info" target="_blank">
                                <i class="fa fa-user"></i> Detail SDM
                            </a>
                            <a href="<?php echo base_url('admin/jabatan_sdm') ?>"
                                class="btn btn-default">
                                <i class="fa fa-list"></i> Semua Jabatan SDM
                            </a>
                            <button type="button" class="btn btn-primary" onclick="printRiwayat()">
                                <i class="fa fa-print"></i> Print Riwayat
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Statistik Riwayat -->
                <?php if (!empty($riwayat)) { ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <i class="fa fa-bar-chart"></i> Statistik Jabatan
                            </h4>
                        </div>
                        <div class="panel-body">
                            <?php
                            $stats = array(
                                'total' => count($riwayat),
                                'aktif' => 0,
                                'selesai' => 0,
                                'akan_datang' => 0,
                                'by_level' => array('institusi' => 0, 'jurusan' => 0, 'prodi' => 0, 'unit' => 0, 'pusat' => 0),
                                'total_tahun' => 0
                            );

                            foreach ($riwayat as $jabatan) {
                                if ($jabatan->periode_mulai <= $tahun_sekarang && $jabatan->periode_akhir >= $tahun_sekarang) {
                                    $stats['aktif']++;
                                } elseif ($jabatan->periode_mulai > $tahun_sekarang) {
                                    $stats['akan_datang']++;
                                } else {
                                    $stats['selesai']++;
                                }
                                $stats['by_level'][$jabatan->level]++;
                                $stats['total_tahun'] += ($jabatan->periode_akhir - $jabatan->periode_mulai + 1);
                            }
                            ?>

                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="stat-item text-center">
                                        <h3 class="text-primary"><?php echo $stats['total'] ?></h3>
                                        <p class="text-muted">Total Jabatan</p>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="stat-item text-center">
                                        <h3 class="text-success"><?php echo $stats['aktif'] ?></h3>
                                        <p class="text-muted">Aktif</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="stat-item text-center">
                                        <h3 class="text-default"><?php echo $stats['selesai'] ?></h3>
                                        <p class="text-muted">Selesai</p>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="stat-item text-center">
                                        <h3 class="text-info"><?php echo $stats['akan_datang'] ?></h3>
                                        <p class="text-muted">Akan Datang</p>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="text-center">
                                <h4 class="text-warning"><?php echo $stats['total_tahun'] ?></h4>
                                <p class="text-muted">Total Tahun Pengabdian</p>
                            </div>

                            <hr>

                            <div class="level-stats">
                                <h5><strong>Berdasarkan Level:</strong></h5>
                                <div class="row">
                                    <div class="col-xs-2 text-center">
                                        <span class="label label-danger"><?php echo $stats['by_level']['institusi'] ?></span>
                                        <br><small>Institusi</small>
                                    </div>
                                    <div class="col-xs-2 text-center">
                                        <span class="label label-warning"><?php echo $stats['by_level']['jurusan'] ?></span>
                                        <br><small>Jurusan</small>
                                    </div>
                                    <div class="col-xs-2 text-center">
                                        <span class="label label-primary"><?php echo $stats['by_level']['prodi'] ?></span>
                                        <br><small>Prodi</small>
                                    </div>
                                    <div class="col-xs-3 text-center">
                                        <span class="label label-success"><?php echo $stats['by_level']['unit'] ?></span>
                                        <br><small>Unit</small>
                                    </div>
                                    <div class="col-xs-3 text-center">
                                        <span class="label label-info"><?php echo $stats['by_level']['pusat'] ?></span>
                                        <br><small>Pusat</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <!-- Jabatan Terkini -->
                <?php
                $jabatan_aktif = array_filter($riwayat, function ($jabatan) use ($tahun_sekarang) {
                    return ($jabatan->periode_mulai <= $tahun_sekarang && $jabatan->periode_akhir >= $tahun_sekarang);
                });
                ?>
                <?php if (!empty($jabatan_aktif)) { ?>
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <i class="fa fa-star"></i> Jabatan Aktif
                            </h4>
                        </div>
                        <div class="panel-body">
                            <?php foreach ($jabatan_aktif as $jabatan) { ?>
                                <div class="media">
                                    <div class="media-left">
                                        <span class="label label-success label-lg">
                                            <i class="fa fa-check"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading"><?php echo $jabatan->jabatan ?></h5>
                                        <p class="text-muted">
                                            <small>
                                                <i class="fa fa-calendar"></i>
                                                <?php echo $jabatan->periode_mulai ?> - <?php echo $jabatan->periode_akhir ?>
                                            </small>
                                        </p>
                                        <?php
                                        if ($jabatan->level == 'jurusan' && !empty($jabatan->nama_jurusan)) {
                                            echo '<p class="text-info"><small><i class="fa fa-building"></i> ' . $jabatan->nama_jurusan . '</small></p>';
                                        } elseif ($jabatan->level == 'prodi' && !empty($jabatan->nama_prodi)) {
                                            echo '<p class="text-info"><small><i class="fa fa-graduation-cap"></i> ' . $jabatan->nama_prodi . '</small></p>';
                                        } elseif ($jabatan->level == 'unit' && !empty($jabatan->nama_unit)) {
                                            echo '<p class="text-info"><small><i class="fa fa-cubes"></i> ' . $jabatan->nama_unit . '</small></p>';
                                        } elseif ($jabatan->level == 'pusat' && !empty($jabatan->nama_pusat)) {
                                            echo '<p class="text-info"><small><i class="fa fa-dot-circle-o"></i> ' . $jabatan->nama_pusat . '</small></p>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <hr>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk interaktivitas -->
<script>
    $(document).ready(function() {
        console.log('Riwayat Jabatan SDM page loaded');

        // Initialize DataTable jika ada
        if ($.fn.DataTable) {
            $('#riwayat-table').DataTable({
                "pageLength": 10,
                "ordering": true,
                "searching": false,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                }
            });
        }

        // Toggle table view
        window.toggleTableView = function() {
            const tableView = $('#table-view');
            const toggleIcon = $('#toggle-icon');
            const toggleText = $('#toggle-text');

            if (tableView.is(':visible')) {
                tableView.slideUp();
                toggleIcon.removeClass('fa-eye-slash').addClass('fa-eye');
                toggleText.text('Tampilkan Tabel');
            } else {
                tableView.slideDown();
                toggleIcon.removeClass('fa-eye').addClass('fa-eye-slash');
                toggleText.text('Sembunyikan Tabel');
            }
        };

        // Print function
        window.printRiwayat = function() {
            window.print();
        };

        // Smooth scroll untuk timeline
        $('.timeline-content').on('click', function() {
            $(this).toggleClass('expanded');
        });

        // Tooltip untuk buttons
        $('[data-toggle="tooltip"]').tooltip();

        // Auto refresh notification untuk jabatan aktif
        if ($('.panel-success .media').length > 0) {
            setTimeout(function() {
                $('.panel-success').effect('highlight', {
                    color: '#d4edda'
                }, 2000);
            }, 1000);
        }
    });
</script>

<!-- Enhanced CSS untuk Riwayat View -->
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
        padding: 5px 0;
        font-size: 13px;
    }

    .table-borderless td:first-child {
        vertical-align: top;
        color: #666;
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
        width: 3px;
        background: #ddd;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 30px;
    }

    .timeline-item.active .timeline-content {
        border-left-color: #00a65a;
        background: #f0f8f0;
    }

    .timeline-item.future .timeline-content {
        border-left-color: #3c8dbc;
        background: #f0f7ff;
    }

    .timeline-item.past .timeline-content {
        border-left-color: #95a5a6;
        background: #f8f9fa;
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
        border: 3px solid white;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .timeline-content {
        background: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        border-left: 4px solid #3c8dbc;
        transition: all 0.3s ease;
    }

    .timeline-content:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .timeline-header {
        margin-bottom: 15px;
    }

    .timeline-title {
        margin: 0 0 8px 0;
        font-size: 18px;
        color: #333;
    }

    .timeline-period {
        margin: 0;
        color: #666;
        font-size: 14px;
    }

    .timeline-body {
        margin-top: 10px;
    }

    .timeline-end {
        background: #f8f9fa;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
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

    /* Labels */
    .label {
        font-size: 11px;
        padding: 4px 8px;
        border-radius: 3px;
    }

    .label-lg {
        font-size: 13px;
        padding: 6px 10px;
    }

    /* Image styling */
    .img-thumbnail {
        border: 2px solid #ddd;
        border-radius: 8px;
    }

    /* Table styling */
    .table-striped>tbody>tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    .table-bordered>thead>tr>th,
    .table-bordered>tbody>tr>th,
    .table-bordered>tfoot>tr>th,
    .table-bordered>thead>tr>td,
    .table-bordered>tbody>tr>td,
    .table-bordered>tfoot>tr>td {
        border: 1px solid #ddd;
    }

    .bg-primary {
        background-color: #3c8dbc !important;
        color: white !important;
    }

    /* Media object */
    .media {
        margin-bottom: 15px;
    }

    .media-heading {
        margin: 0 0 5px 0;
        font-size: 14px;
        font-weight: 600;
    }

    /* Level stats styling */
    .level-stats {
        margin-top: 10px;
    }

    .level-stats .row {
        margin-top: 10px;
    }

    .level-stats .label {
        display: block;
        margin-bottom: 5px;
        font-size: 14px;
        padding: 6px;
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

        .timeline-content {
            padding: 15px;
        }

        .timeline-title {
            font-size: 16px;
        }

        .btn-group-vertical .btn {
            font-size: 12px;
            padding: 8px 12px;
        }

        .stat-item h3 {
            font-size: 20px;
        }
    }

    /* Print styles */
    @media print {

        .box-tools,
        .btn,
        .panel-warning,
        .panel-info {
            display: none !important;
        }

        .col-md-4 {
            display: none !important;
        }

        .col-md-8 {
            width: 100% !important;
        }

        .timeline-content {
            break-inside: avoid;
            margin-bottom: 10px;
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

        .timeline-container::before {
            background: #333 !important;
        }

        .timeline-icon {
            background: #333 !important;
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

    /* Expanded timeline content */
    .timeline-content.expanded {
        background: white;
        border-left-width: 6px;
    }

    /* Table responsive wrapper */
    .table-responsive {
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    /* Success/Info row styling */
    tr.success {
        background-color: #dff0d8 !important;
    }

    tr.info {
        background-color: #d9edf7 !important;
    }

    /* Toggle button styling */
    .panel-title .btn {
        font-size: 11px;
        padding: 2px 6px;
    }
</style>