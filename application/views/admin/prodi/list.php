<?php
// filepath: d:\xampp\htdocs\dev_jkt3\application\views\admin\prodi\list.php
?>

<!-- Search Box -->
<div class="row mb-3">
    <div class="col-md-6">
        <form method="GET" action="<?php echo base_url('admin/prodi/search') ?>">
            <div class="input-group">
                <input type="text" class="form-control" name="q" placeholder="Cari program studi..." value="<?php echo isset($keyword) ? $keyword : '' ?>">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6 text-right">
        <a href="<?php echo base_url('admin/prodi/export_csv') ?>" class="btn btn-success btn-sm">
            <i class="fa fa-download"></i> Export CSV
        </a>
        <a href="<?php echo base_url('admin/prodi/import') ?>" class="btn btn-info btn-sm">
            <i class="fa fa-upload"></i> Import CSV
        </a>
        <button type="button" class="btn btn-warning btn-sm" onclick="updateStatistics()">
            <i class="fa fa-refresh"></i> Update Statistik
        </button>
    </div>
</div>

<!-- Filter by Jurusan -->
<div class="row mb-3">
    <div class="col-md-3">
        <form method="GET" action="<?php echo base_url('admin/prodi') ?>">
            <div class="input-group">
                <select name="jurusan" class="form-control">
                    <option value="">Semua Jurusan</option>
                    <?php if (!empty($jurusan)) { ?>
                        <?php foreach ($jurusan as $row) { ?>
                            <option value="<?php echo $row->id ?>" <?php echo ($this->input->get('jurusan') == $row->id) ? 'selected' : '' ?>>
                                <?php echo $row->nama ?>
                            </option>
                        <?php } ?>
                    <?php } ?>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit"><i class="fa fa-filter"></i> Filter</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-3">
        <form method="GET" action="<?php echo base_url('admin/prodi') ?>">
            <div class="input-group">
                <select name="jenjang" class="form-control">
                    <option value="">Semua Jenjang</option>
                    <option value="D3" <?php echo ($this->input->get('jenjang') == 'D3') ? 'selected' : '' ?>>Diploma 3</option>
                    <option value="STr" <?php echo ($this->input->get('jenjang') == 'STr') ? 'selected' : '' ?>>Sarjana Terapan</option>
                    <option value="Profesi" <?php echo ($this->input->get('jenjang') == 'Profesi') ? 'selected' : '' ?>>Profesi</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit"><i class="fa fa-filter"></i> Filter Jenjang</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-3">
        <form method="GET" action="<?php echo base_url('admin/prodi') ?>">
            <div class="input-group">
                <select name="akreditasi" class="form-control">
                    <option value="">Semua Akreditasi</option>
                    <option value="A" <?php echo ($this->input->get('akreditasi') == 'A') ? 'selected' : '' ?>>A (Unggul)</option>
                    <option value="B" <?php echo ($this->input->get('akreditasi') == 'B') ? 'selected' : '' ?>>B (Baik Sekali)</option>
                    <option value="C" <?php echo ($this->input->get('akreditasi') == 'C') ? 'selected' : '' ?>>C (Baik)</option>
                    <option value="Baik Sekali" <?php echo ($this->input->get('akreditasi') == 'Baik Sekali') ? 'selected' : '' ?>>Baik Sekali</option>
                    <option value="Baik" <?php echo ($this->input->get('akreditasi') == 'Baik') ? 'selected' : '' ?>>Baik</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit"><i class="fa fa-filter"></i> Filter Akreditasi</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-3">
        <form method="GET" action="<?php echo base_url('admin/prodi') ?>">
            <div class="input-group">
                <select name="status" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="active" <?php echo ($this->input->get('status') == 'active') ? 'selected' : '' ?>>Aktif</option>
                    <option value="inactive" <?php echo ($this->input->get('status') == 'inactive') ? 'selected' : '' ?>>Tidak Aktif</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit"><i class="fa fa-filter"></i> Filter Status</button>
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

<!-- Bulk Actions -->
<div class="row mb-3">
    <div class="col-md-12">
        <form id="bulk-form" method="POST" action="<?php echo base_url('admin/prodi/bulk_action') ?>">
            <div class="input-group">
                <div id="selected-items"></div>
                <select name="bulk_action" class="form-control" style="max-width: 200px;">
                    <option value="">Pilih Aksi...</option>
                    <option value="activate">Aktifkan</option>
                    <option value="deactivate">Nonaktifkan</option>
                    <option value="delete">Hapus</option>
                </select>
                <div class="input-group-append">
                    <button type="button" class="btn btn-primary" onclick="return confirmBulkAction()">
                        <i class="fa fa-play"></i> Jalankan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Add Button -->
<p>
    <?php include('tambah.php') ?>
</p>

<!-- Data Table -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Data Program Studi</h3>
        <div class="box-tools pull-right">
            <?php if (isset($jurusan_filter)) { ?>
                <span class="label label-info">Filter Jurusan: <?php echo $jurusan_filter->nama ?></span>
            <?php } ?>
            <?php if ($this->input->get('jenjang')) { ?>
                <span class="label label-warning">Filter Jenjang: <?php echo $this->input->get('jenjang') ?></span>
            <?php } ?>
            <?php if ($this->input->get('akreditasi')) { ?>
                <span class="label label-success">Filter Akreditasi: <?php echo $this->input->get('akreditasi') ?></span>
            <?php } ?>
            <?php if ($this->input->get('status')) { ?>
                <span class="label label-default">Filter Status: <?php echo ucfirst($this->input->get('status')) ?></span>
            <?php } ?>
            <?php if (isset($jurusan_filter) || $this->input->get('jenjang') || $this->input->get('akreditasi') || $this->input->get('status')) { ?>
                <a href="<?php echo base_url('admin/prodi') ?>" class="btn btn-default btn-xs">
                    <i class="fa fa-times"></i> Reset Filter
                </a>
            <?php } ?>
        </div>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-hover table-striped" id="example1">
            <thead class="bordered-darkorange">
                <tr>
                    <th width="3%">
                        <input type="checkbox" id="select-all">
                    </th>
                    <th width="3%">#</th>
                    <th width="15%">Nama Program Studi</th>
                    <th width="10%">Jurusan</th>
                    <th width="8%">Jenjang</th>
                    <th width="8%">Akreditasi</th>
                    <th width="8%">Durasi</th>
                    <th width="8%">Gelar</th>
                    <th width="10%">Statistik</th>
                    <th width="8%">Status</th>
                    <th width="10%">Mode Kuliah</th>
                    <th width="9%" class="no-sort">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($prodi)) { ?>
                    <?php $i = 1;
                    foreach ($prodi as $row) { ?>
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" name="selected_ids[]" value="<?php echo $row->id ?>" class="row-checkbox">
                            </td>
                            <td class="text-center"><?php echo $i ?></td>
                            <td>
                                <div class="prodi-info">
                                    <strong class="text-primary"><?php echo htmlspecialchars($row->nama) ?></strong>
                                    <?php if (!empty($row->icon)) { ?>
                                        <i class="<?php echo $row->icon ?>" style="color: <?php echo !empty($row->color) ? $row->color : '#3c8dbc' ?>; margin-left: 5px;"></i>
                                    <?php } ?>
                                    <br>
                                    <small class="text-muted">
                                        <code><?php echo htmlspecialchars($row->slug) ?></code>
                                    </small>
                                    <?php if (!empty($row->biaya_kuliah)) { ?>
                                        <br>
                                        <small class="text-success">
                                            <i class="fa fa-money"></i> <?php echo $row->biaya_kuliah ?>
                                        </small>
                                    <?php } ?>
                                </div>
                            </td>
                            <td>
                                <span class="label label-primary">
                                    <?php echo isset($row->nama_jurusan) ? htmlspecialchars($row->nama_jurusan) : 'N/A' ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <?php if (!empty($row->jenjang)) { ?>
                                    <span class="label <?php
                                                        echo ($row->jenjang == 'D3') ? 'label-info' : (($row->jenjang == 'STr') ? 'label-success' : (($row->jenjang == 'Profesi') ? 'label-warning' : 'label-default'));
                                                        ?>">
                                        <?php echo $row->jenjang ?>
                                    </span>
                                <?php } else { ?>
                                    <span class="text-muted">-</span>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <?php if (!empty($row->akreditasi)) { ?>
                                    <span class="label <?php
                                                        echo ($row->akreditasi == 'A') ? 'label-success' : (($row->akreditasi == 'B' || $row->akreditasi == 'Baik Sekali') ? 'label-warning' : (($row->akreditasi == 'C' || $row->akreditasi == 'Baik') ? 'label-info' : 'label-default'));
                                                        ?>">
                                        <?php echo $row->akreditasi ?>
                                    </span>
                                <?php } else { ?>
                                    <span class="text-muted">Belum</span>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <?php if (!empty($row->durasi)) { ?>
                                    <span class="badge badge-info">
                                        <?php echo $row->durasi ?> Tahun
                                    </span>
                                    <?php if (!empty($row->total_sks)) { ?>
                                        <br>
                                        <small class="text-muted"><?php echo $row->total_sks ?> SKS</small>
                                    <?php } ?>
                                <?php } else { ?>
                                    <span class="text-muted">-</span>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <?php if (!empty($row->gelar)) { ?>
                                    <span class="label label-info"><?php echo $row->gelar ?></span>
                                <?php } else { ?>
                                    <span class="text-muted">-</span>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <div class="statistics-info">
                                    <!-- Alumni Count -->
                                    <div class="stat-item">
                                        <i class="fa fa-users text-blue"></i>
                                        <span class="stat-value"><?php echo number_format($row->alumni_count ?? 0) ?></span>
                                        <small class="text-muted">Alumni</small>
                                    </div>

                                    <!-- Job Placement -->
                                    <div class="stat-item">
                                        <i class="fa fa-briefcase text-green"></i>
                                        <span class="stat-value"><?php echo number_format($row->job_placement ?? 0, 1) ?>%</span>
                                        <small class="text-muted">Kerja</small>
                                    </div>

                                    <!-- Rating -->
                                    <div class="stat-item">
                                        <i class="fa fa-star text-yellow"></i>
                                        <span class="stat-value"><?php echo number_format($row->rating ?? 0, 1) ?></span>
                                        <small class="text-muted">Rating</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <?php if ($row->status == 'active') { ?>
                                    <span class="label label-success">
                                        <i class="fa fa-check-circle"></i> Aktif
                                    </span>
                                <?php } else { ?>
                                    <span class="label label-danger">
                                        <i class="fa fa-times-circle"></i> Tidak Aktif
                                    </span>
                                <?php } ?>
                                <br>
                                <small class="text-muted">
                                    <?php echo date('d/m/Y', strtotime($row->created_at)) ?>
                                </small>
                            </td>
                            <td class="text-center">
                                <?php if (!empty($row->mode_kuliah)) { ?>
                                    <span class="label label-info"><?php echo $row->mode_kuliah ?></span>
                                <?php } else { ?>
                                    <span class="text-muted">-</span>
                                <?php } ?>
                                <?php if (!empty($row->link_brosur)) { ?>
                                    <br>
                                    <a href="<?php echo $row->link_brosur ?>" target="_blank" class="btn btn-xs btn-info">
                                        <i class="fa fa-download"></i> Brosur
                                    </a>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group-vertical" role="group">
                                    <!-- Detail Button -->
                                    <a href="<?php echo base_url('admin/prodi/detail/' . $row->id) ?>"
                                        class="btn btn-info btn-xs"
                                        title="Detail Program Studi"
                                        data-toggle="tooltip">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <!-- Edit Button -->
                                    <a href="<?php echo base_url('admin/prodi/edit/' . $row->id) ?>"
                                        class="btn btn-warning btn-xs"
                                        title="Edit Program Studi"
                                        data-toggle="tooltip">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <!-- Change Status Button -->
                                    <a href="<?php echo base_url('admin/prodi/change_status/' . $row->id) ?>"
                                        class="btn <?php echo ($row->status == 'active') ? 'btn-warning' : 'btn-success' ?> btn-xs"
                                        title="<?php echo ($row->status == 'active') ? 'Nonaktifkan' : 'Aktifkan' ?>"
                                        data-toggle="tooltip"
                                        onclick="confirmStatusChange(event, '<?php echo ($row->status == 'active') ? 'menonaktifkan' : 'mengaktifkan' ?>')">
                                        <i class="fa <?php echo ($row->status == 'active') ? 'fa-pause' : 'fa-play' ?>"></i>
                                    </a>

                                    <!-- Preview Button -->
                                    <a href="<?php echo base_url('admin/prodi/preview/' . $row->id) ?>"
                                        target="_blank"
                                        class="btn btn-primary btn-xs"
                                        title="Preview Program Studi"
                                        data-toggle="tooltip">
                                        <i class="fa fa-external-link"></i>
                                    </a>

                                    <!-- Delete Button -->
                                    <a href="<?php echo base_url('admin/prodi/delete/' . $row->id) ?>"
                                        class="btn btn-danger btn-xs"
                                        onclick="confirmation(event)"
                                        title="Hapus Program Studi"
                                        data-toggle="tooltip">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php } ?>
                <?php } else { ?>
                    <!-- Empty state row with proper column count -->
                    <tr class="empty-row">
                        <td class="text-center">-</td>
                        <td class="text-center">-</td>
                        <td class="text-center">-</td>
                        <td class="text-center">-</td>
                        <td class="text-center">-</td>
                        <td class="text-center">-</td>
                        <td class="text-center">-</td>
                        <td class="text-center">-</td>
                        <td class="text-center">-</td>
                        <td class="text-center">-</td>
                        <td class="text-center">-</td>
                        <td class="text-center">-</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Empty state message -->
        <?php if (empty($prodi)) { ?>
            <div class="empty-state-message" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 10; background: white; padding: 20px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <div class="text-center">
                    <i class="fa fa-graduation-cap" style="font-size: 48px; color: #ccc; margin-bottom: 10px;"></i>
                    <p class="text-muted">
                        <?php if (isset($keyword)) { ?>
                            Tidak ada hasil untuk pencarian "<strong><?php echo htmlspecialchars($keyword) ?></strong>"
                        <?php } elseif (isset($jurusan_filter)) { ?>
                            Tidak ada program studi di jurusan "<strong><?php echo htmlspecialchars($jurusan_filter->nama) ?></strong>"
                        <?php } elseif ($this->input->get('jenjang')) { ?>
                            Tidak ada program studi dengan jenjang "<strong><?php echo $this->input->get('jenjang') ?></strong>"
                        <?php } elseif ($this->input->get('akreditasi')) { ?>
                            Tidak ada program studi dengan akreditasi "<strong><?php echo $this->input->get('akreditasi') ?></strong>"
                        <?php } elseif ($this->input->get('status')) { ?>
                            Tidak ada program studi dengan status "<strong><?php echo $this->input->get('status') ?></strong>"
                        <?php } else { ?>
                            Belum ada data program studi
                        <?php } ?>
                    </p>
                    <?php if (!isset($keyword) && !isset($jurusan_filter) && !$this->input->get('jenjang') && !$this->input->get('akreditasi') && !$this->input->get('status')) { ?>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#TambahProdi">
                            <i class="fa fa-plus"></i> Tambah Program Studi Pertama
                        </button>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<!-- Enhanced Statistics Boxes -->
<div class="row">
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-graduation-cap"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Program Studi</span>
                <span class="info-box-number"><?php echo !empty($prodi) ? count($prodi) : 0 ?></span>
                <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                </div>
                <span class="progress-description">
                    Aktif: <?php
                            $active_count = 0;
                            if (!empty($prodi)) {
                                foreach ($prodi as $p) {
                                    if ($p->status == 'active') $active_count++;
                                }
                            }
                            echo $active_count;
                            ?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Alumni</span>
                <span class="info-box-number">
                    <?php
                    $total_alumni = 0;
                    if (!empty($prodi)) {
                        foreach ($prodi as $p) {
                            $total_alumni += $p->alumni_count ?? 0;
                        }
                    }
                    echo number_format($total_alumni);
                    ?>
                </span>
                <div class="progress">
                    <div class="progress-bar" style="width: 85%"></div>
                </div>
                <span class="progress-description">
                    Dari semua program studi
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-briefcase"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Rata-rata Job Placement</span>
                <span class="info-box-number">
                    <?php
                    $avg_job_placement = 0;
                    $count_prodi = 0;
                    if (!empty($prodi)) {
                        foreach ($prodi as $p) {
                            if (isset($p->job_placement)) {
                                $avg_job_placement += $p->job_placement;
                                $count_prodi++;
                            }
                        }
                        if ($count_prodi > 0) {
                            $avg_job_placement = $avg_job_placement / $count_prodi;
                        }
                    }
                    echo number_format($avg_job_placement, 1) . '%';
                    ?>
                </span>
                <div class="progress">
                    <div class="progress-bar" style="width: <?php echo $avg_job_placement ?>%"></div>
                </div>
                <span class="progress-description">
                    Penempatan kerja alumni
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-star"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Rata-rata Rating</span>
                <span class="info-box-number">
                    <?php
                    $avg_rating = 0;
                    $count_rating = 0;
                    if (!empty($prodi)) {
                        foreach ($prodi as $p) {
                            if (isset($p->rating)) {
                                $avg_rating += $p->rating;
                                $count_rating++;
                            }
                        }
                        if ($count_rating > 0) {
                            $avg_rating = $avg_rating / $count_rating;
                        }
                    }
                    echo number_format($avg_rating, 1) . '/5';
                    ?>
                </span>
                <div class="progress">
                    <div class="progress-bar" style="width: <?php echo ($avg_rating / 5) * 100 ?>%"></div>
                </div>
                <span class="progress-description">
                    Rating program studi
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Summary by Jenjang -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-bar-chart"></i> Ringkasan Program Studi
                </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <?php
                    $jenjang_stats = array(
                        'D3' => array('count' => 0, 'alumni' => 0, 'rating' => 0),
                        'STr' => array('count' => 0, 'alumni' => 0, 'rating' => 0),
                        'Profesi' => array('count' => 0, 'alumni' => 0, 'rating' => 0)
                    );

                    if (!empty($prodi)) {
                        foreach ($prodi as $row) {
                            if (isset($jenjang_stats[$row->jenjang])) {
                                $jenjang_stats[$row->jenjang]['count']++;
                                $jenjang_stats[$row->jenjang]['alumni'] += $row->alumni_count ?? 0;
                                $jenjang_stats[$row->jenjang]['rating'] += $row->rating ?? 0;
                            }
                        }
                    }
                    ?>

                    <!-- D3 Statistics -->
                    <div class="col-md-4">
                        <div class="info-box bg-aqua">
                            <span class="info-box-icon"><i class="fa fa-certificate"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Diploma 3 (D3)</span>
                                <span class="info-box-number"><?php echo $jenjang_stats['D3']['count'] ?> Program</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    Alumni: <?php echo number_format($jenjang_stats['D3']['alumni']) ?> |
                                    Rating: <?php echo $jenjang_stats['D3']['count'] > 0 ? number_format($jenjang_stats['D3']['rating'] / $jenjang_stats['D3']['count'], 1) : '0' ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- STr Statistics -->
                    <div class="col-md-4">
                        <div class="info-box bg-green">
                            <span class="info-box-icon"><i class="fa fa-graduation-cap"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Sarjana Terapan (STr)</span>
                                <span class="info-box-number"><?php echo $jenjang_stats['STr']['count'] ?> Program</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    Alumni: <?php echo number_format($jenjang_stats['STr']['alumni']) ?> |
                                    Rating: <?php echo $jenjang_stats['STr']['count'] > 0 ? number_format($jenjang_stats['STr']['rating'] / $jenjang_stats['STr']['count'], 1) : '0' ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Profesi Statistics -->
                    <div class="col-md-4">
                        <div class="info-box bg-yellow">
                            <span class="info-box-icon"><i class="fa fa-user-md"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Profesi</span>
                                <span class="info-box-number"><?php echo $jenjang_stats['Profesi']['count'] ?> Program</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    Alumni: <?php echo number_format($jenjang_stats['Profesi']['alumni']) ?> |
                                    Rating: <?php echo $jenjang_stats['Profesi']['count'] > 0 ? number_format($jenjang_stats['Profesi']['rating'] / $jenjang_stats['Profesi']['count'], 1) : '0' ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Description Modal -->
<div class="modal fade" id="descriptionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Deskripsi Program Studi</h4>
            </div>
            <div class="modal-body">
                <div id="description-content"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk DataTable dan Enhanced Functionality -->
<script>
    $(document).ready(function() {
        // Enhanced DataTable initialization
        var tableId = '#example1';
        var $table = $(tableId);

        if ($table.length === 0) {
            console.error('Table not found: ' + tableId);
            return;
        }

        setTimeout(function() {
            if (!$.fn.DataTable.isDataTable(tableId)) {
                try {
                    var dataTable = $(tableId).DataTable({
                        "responsive": true,
                        "autoWidth": false,
                        "processing": true,
                        "pageLength": 25,
                        "lengthMenu": [
                            [10, 25, 50, 100, -1],
                            [10, 25, 50, 100, "Semua"]
                        ],
                        "order": [
                            [9, "desc"]
                        ], // Order by status/date column
                        "columnDefs": [{
                                "orderable": false,
                                "targets": [0, 11] // Checkbox and Action columns
                            },
                            {
                                "className": "text-center",
                                "targets": [0, 1, 4, 5, 6, 7, 8, 9, 11] // Center align specific columns
                            }
                        ],
                        "language": {
                            "emptyTable": "Tidak ada data yang tersedia pada tabel ini",
                            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                            "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                            "infoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                            "lengthMenu": "Tampilkan _MENU_ entri",
                            "loadingRecords": "Sedang memuat...",
                            "processing": "Sedang memproses...",
                            "search": "Cari:",
                            "zeroRecords": "Tidak ditemukan data yang sesuai",
                            "paginate": {
                                "first": "Pertama",
                                "last": "Terakhir",
                                "next": "Selanjutnya",
                                "previous": "Sebelumnya"
                            }
                        },
                        "drawCallback": function() {
                            attachCheckboxEvents();
                            attachDescriptionEvents();
                            $('[data-toggle="tooltip"]').tooltip();
                            handleEmptyState();
                        },
                        "initComplete": function() {
                            console.log('DataTable initialized successfully');
                            handleEmptyState();
                        }
                    });

                    attachCheckboxEvents();
                    attachDescriptionEvents();

                } catch (error) {
                    console.error('DataTable initialization failed:', error);
                }
            }
        }, 300);

        function handleEmptyState() {
            var $tbody = $table.find('tbody');
            var dataRowsCount = $tbody.find('tr').not('.empty-row').length;

            if (dataRowsCount === 0) {
                $tbody.find('.empty-row').hide();
                $('.empty-state-message').show();
                $table.closest('.box-body').css('position', 'relative');
            } else {
                $('.empty-state-message').hide();
            }
        }

        function attachCheckboxEvents() {
            $('#select-all').off('change.checkbox');
            $('.row-checkbox').off('change.checkbox');

            $('#select-all').on('change.checkbox', function() {
                var isChecked = $(this).prop('checked');
                $('.row-checkbox:visible').prop('checked', isChecked);
                updateSelectedItems();
            });

            $('.row-checkbox').on('change.checkbox', function() {
                updateSelectedItems();
                updateSelectAllState();
            });
        }

        function attachDescriptionEvents() {
            $('.show-more').off('click.description').on('click.description', function(e) {
                e.preventDefault();
                var description = $(this).data('description');
                $('#description-content').html(description);
                $('#descriptionModal').modal('show');
            });
        }

        function updateSelectAllState() {
            var totalCheckboxes = $('.row-checkbox:visible').length;
            var checkedCheckboxes = $('.row-checkbox:visible:checked').length;

            if (checkedCheckboxes === 0) {
                $('#select-all').prop('indeterminate', false).prop('checked', false);
            } else if (checkedCheckboxes === totalCheckboxes) {
                $('#select-all').prop('indeterminate', false).prop('checked', true);
            } else {
                $('#select-all').prop('indeterminate', true);
            }
        }

        function updateSelectedItems() {
            var selected = [];
            $('.row-checkbox:checked').each(function() {
                selected.push($(this).val());
            });

            $('#selected-items').empty();
            selected.forEach(function(id) {
                $('#selected-items').append('<input type="hidden" name="selected_ids[]" value="' + id + '">');
            });

            var selectedCount = selected.length;
            $('#selected-count').text(selectedCount);

            if (selectedCount > 0) {
                $('.box-title').first().text('Data Program Studi (' + selectedCount + ' dipilih)');
            } else {
                $('.box-title').first().text('Data Program Studi');
            }
        }

        $('[data-toggle="tooltip"]').tooltip();
        handleEmptyState();
    });

    // Konfirmasi delete
    function confirmation(event) {
        event.preventDefault();
        var url = event.target.closest('a').href;

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data program studi yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menghapus data...',
                    text: 'Mohon tunggu',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                window.location.href = url;
            }
        });
    }

    // Konfirmasi status change
    function confirmStatusChange(event, action) {
        event.preventDefault();
        var url = event.target.closest('a').href;

        Swal.fire({
            title: 'Konfirmasi Perubahan Status',
            text: 'Apakah Anda yakin ingin ' + action + ' program studi ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjutkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Memproses...',
                    text: 'Mohon tunggu',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                window.location.href = url;
            }
        });
    }

    // Konfirmasi bulk action
    function confirmBulkAction() {
        var selectedCount = $('.row-checkbox:checked').length;
        var action = $('select[name="bulk_action"]').val();

        if (selectedCount === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Pilih Data',
                text: 'Pilih minimal satu data untuk diproses!'
            });
            return false;
        }

        if (action === '') {
            Swal.fire({
                icon: 'warning',
                title: 'Pilih Aksi',
                text: 'Pilih aksi yang akan dilakukan!'
            });
            return false;
        }

        var actionText = action === 'delete' ? 'menghapus' :
            (action === 'activate' ? 'mengaktifkan' : 'menonaktifkan');

        Swal.fire({
            title: 'Konfirmasi Aksi Massal',
            text: 'Yakin ingin ' + actionText + ' ' + selectedCount + ' data program studi?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: action === 'delete' ? '#d33' : '#3085d6',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Lanjutkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Memproses data...',
                    text: 'Mohon tunggu',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                $('#bulk-form')[0].submit();
            }
        });
        return false;
    }

    // Update statistics function
    function updateStatistics() {
        Swal.fire({
            title: 'Update Statistik',
            text: 'Memperbarui data statistik program studi...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: '<?php echo base_url("admin/prodi/get_statistics") ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Statistik telah diperbarui',
                        timer: 2000
                    });

                    // Reload page to show updated statistics
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Gagal memperbarui statistik'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan sistem'
                });
            }
        });
    }

    // Auto hide alerts
    setTimeout(function() {
        $('.alert').slideUp('slow');
    }, 5000);

    // Filter form auto-submit
    $('select[name="jurusan"], select[name="jenjang"], select[name="akreditasi"], select[name="status"]').on('change', function() {
        var form = $(this).closest('form');
        if ($(this).val() !== '') {
            form.submit();
        }
    });
</script>

<style>
    /* Enhanced Statistics Info Styling */
    .statistics-info {
        display: flex;
        flex-direction: column;
        gap: 3px;
        font-size: 11px;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 3px;
    }

    .stat-item i {
        width: 12px;
        font-size: 10px;
    }

    .stat-value {
        font-weight: bold;
        min-width: 30px;
    }

    /* Prodi Info Enhanced */
    .prodi-info strong {
        font-size: 13px;
        line-height: 1.3;
    }

    .prodi-info code {
        background-color: #e3f2fd;
        color: #1976d2;
        padding: 1px 4px;
        border-radius: 2px;
        font-size: 10px;
    }

    /* Enhanced Labels */
    .label {
        font-size: 10px;
        padding: 3px 6px;
        border-radius: 3px;
    }

    .badge {
        font-size: 10px;
        padding: 3px 6px;
    }

    /* Button Group Vertical */
    .btn-group-vertical .btn {
        margin-bottom: 1px;
        border-radius: 2px !important;
        font-size: 10px;
        padding: 2px 6px;
    }

    /* Enhanced Info Boxes */
    .info-box {
        margin-bottom: 15px;
    }

    .info-box .progress {
        margin-top: 5px;
        height: 3px;
    }

    .progress-description {
        font-size: 11px;
        margin-top: 5px;
    }

    /* Table Row Hover Effect */
    .table-hover tbody tr:hover {
        background-color: #f5f5f5;
    }

    /* Empty State */
    .empty-state-message {
        display: none;
        min-height: 200px;
    }

    .empty-row {
        background-color: #f9f9f9;
    }

    .empty-row td {
        color: #ccc;
        font-style: italic;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .statistics-info {
            font-size: 9px;
        }

        .stat-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 1px;
        }

        .btn-group-vertical .btn {
            display: block;
            width: 100%;
            margin-bottom: 2px;
        }

        .prodi-info {
            font-size: 11px;
        }
    }

    /* Color Indicators */
    .text-blue {
        color: #3c8dbc !important;
    }

    .text-green {
        color: #00a65a !important;
    }

    .text-yellow {
        color: #f39c12 !important;
    }

    .text-red {
        color: #dd4b39 !important;
    }
</style>