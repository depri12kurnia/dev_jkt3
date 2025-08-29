<!-- Navigation Breadcrumb -->
<div class="box">
    <div class="box-header">
        <h3 class="box-title">
            <i class="fa fa-edit"></i> Edit Program Studi: <?php echo htmlspecialchars($prodi->nama) ?>
        </h3>
        <div class="box-tools pull-right">
            <a href="<?php echo base_url('admin/prodi') ?>" class="btn btn-default btn-sm">
                <i class="fa fa-arrow-left"></i> Kembali ke Daftar
            </a>
            <a href="<?php echo base_url('admin/prodi/detail/' . $prodi->id) ?>" class="btn btn-info btn-sm">
                <i class="fa fa-eye"></i> Lihat Detail
            </a>
            <a href="<?php echo base_url('admin/prodi/preview/' . $prodi->id) ?>" target="_blank" class="btn btn-primary btn-sm">
                <i class="fa fa-external-link"></i> Preview
            </a>
        </div>
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

<!-- Main Form -->
<div class="box">
    <div class="box-header with-border">
    </div>
    <div class="box-body">
        <?php
        // Validasi error
        echo validation_errors('<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> ', '</div>');

        // Form buka - untuk edit
        echo form_open(base_url('admin/prodi/edit/' . $prodi->id), array('id' => 'form-edit-prodi'));
        ?>

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="active">
                <a href="#basic-info" data-toggle="tab">
                    <i class="fa fa-info-circle"></i> Informasi Dasar
                </a>
            </li>
            | |
            <li>
                <a href="#academic-info" data-toggle="tab">
                    <i class="fa fa-graduation-cap"></i> Info Akademik
                </a>
            </li>
            | |
            <li>
                <a href="#statistics-info" data-toggle="tab">
                    <i class="fa fa-bar-chart"></i> Statistik
                </a>
            </li>
            | |
            <li>
                <a href="#additional-info" data-toggle="tab">
                    <i class="fa fa-cogs"></i> Informasi Tambahan
                </a>
            </li>
            | |
            <li>
                <a href="#features-info" data-toggle="tab">
                    <i class="fa fa-star"></i> Keunggulan & Prospek
                </a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" style="margin-top: 20px;">

            <!-- Basic Info Tab -->
            <div class="tab-pane active" id="basic-info">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama Program Studi <span class="text-danger">*</span></label>
                            <input type="text"
                                id="nama"
                                name="nama"
                                class="form-control"
                                placeholder="Masukkan nama program studi"
                                value="<?php echo set_value('nama', $prodi->nama) ?>"
                                maxlength="100"
                                required>
                            <small class="form-text text-muted">Maksimal 100 karakter. Slug akan diupdate otomatis.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jurusan_id">Jurusan <span class="text-danger">*</span></label>
                            <select id="jurusan_id" name="jurusan_id" class="form-control" required>
                                <option value="">Pilih Jurusan</option>
                                <?php if (!empty($jurusan_dropdown)) { ?>
                                    <?php foreach ($jurusan_dropdown as $key => $value) { ?>
                                        <?php if ($key != '') { // Skip empty option 
                                        ?>
                                            <option value="<?php echo $key ?>"
                                                <?php echo set_select('jurusan_id', $key, ($prodi->jurusan_id == $key)) ?>>
                                                <?php echo $value ?>
                                            </option>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                            <small class="form-text text-muted">Pilih jurusan untuk program studi ini</small>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi Program Studi</label>
                    <textarea id="deskripsi"
                        name="deskripsi"
                        class="form-control tinymce-editor"
                        rows="10"
                        placeholder="Masukkan deskripsi lengkap program studi (opsional)"><?php echo set_value('deskripsi', $prodi->deskripsi) ?></textarea>
                    <small class="form-text text-muted">
                        Gunakan toolbar untuk formatting teks. Deskripsi lengkap tentang program studi.
                        <span id="char-count-desc">0</span> karakter (tanpa HTML)
                    </small>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="visi">Visi Program Studi</label>
                            <textarea id="visi"
                                name="visi"
                                class="form-control"
                                rows="4"
                                placeholder="Masukkan visi program studi (opsional)"
                                maxlength="1000"><?php echo set_value('visi', $prodi->visi) ?></textarea>
                            <small class="form-text text-muted">
                                <span id="char-count-visi">0</span>/1000 karakter
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="misi">Misi Program Studi</label>
                            <textarea id="misi"
                                name="misi"
                                class="form-control"
                                rows="4"
                                placeholder="Masukkan misi program studi (opsional)"
                                maxlength="2000"><?php echo set_value('misi', $prodi->misi) ?></textarea>
                            <small class="form-text text-muted">
                                <span id="char-count-misi">0</span>/2000 karakter
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Academic Info Tab -->
            <div class="tab-pane" id="academic-info">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="jenjang">Jenjang Pendidikan</label>
                            <select id="jenjang" name="jenjang" class="form-control">
                                <option value="">Pilih Jenjang</option>
                                <option value="D3" <?php echo set_select('jenjang', 'D3', ($prodi->jenjang == 'D3')) ?>>Diploma 3 (D3)</option>
                                <option value="STr" <?php echo set_select('jenjang', 'STr', ($prodi->jenjang == 'STr')) ?>>Sarjana Terapan (STr)</option>
                                <option value="Profesi" <?php echo set_select('jenjang', 'Profesi', ($prodi->jenjang == 'Profesi')) ?>>Profesi</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="akreditasi">Akreditasi</label>
                            <select id="akreditasi" name="akreditasi" class="form-control">
                                <option value="">Belum Terakreditasi</option>
                                <option value="A" <?php echo set_select('akreditasi', 'A', ($prodi->akreditasi == 'A')) ?>>A (Unggul)</option>
                                <option value="B" <?php echo set_select('akreditasi', 'B', ($prodi->akreditasi == 'B')) ?>>B (Baik Sekali)</option>
                                <option value="C" <?php echo set_select('akreditasi', 'C', ($prodi->akreditasi == 'C')) ?>>C (Baik)</option>
                                <option value="Baik Sekali" <?php echo set_select('akreditasi', 'Baik Sekali', ($prodi->akreditasi == 'Baik Sekali')) ?>>Baik Sekali</option>
                                <option value="Baik" <?php echo set_select('akreditasi', 'Baik', ($prodi->akreditasi == 'Baik')) ?>>Baik</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gelar">Gelar Lulusan</label>
                            <input type="text"
                                id="gelar"
                                name="gelar"
                                class="form-control"
                                placeholder="Contoh: A.Md.Fis, S.Tr.Fis"
                                value="<?php echo set_value('gelar', $prodi->gelar) ?>"
                                maxlength="50">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="durasi">Durasi (Tahun)</label>
                            <input type="number"
                                id="durasi"
                                name="durasi"
                                class="form-control"
                                placeholder="Contoh: 3, 4"
                                value="<?php echo set_value('durasi', $prodi->durasi) ?>"
                                min="1"
                                max="10">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="total_sks">Total SKS</label>
                            <input type="number"
                                id="total_sks"
                                name="total_sks"
                                class="form-control"
                                placeholder="Contoh: 144, 108"
                                value="<?php echo set_value('total_sks', $prodi->total_sks) ?>"
                                min="1"
                                max="200">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control">
                                <option value="active" <?php echo set_select('status', 'active', ($prodi->status == 'active')) ?>>Aktif</option>
                                <option value="inactive" <?php echo set_select('status', 'inactive', ($prodi->status == 'inactive')) ?>>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mode_kuliah">Mode Kuliah</label>
                            <input type="text"
                                id="mode_kuliah"
                                name="mode_kuliah"
                                class="form-control"
                                placeholder="Contoh: Reguler, Kelas Sore, Weekend"
                                value="<?php echo set_value('mode_kuliah', $prodi->mode_kuliah) ?>"
                                maxlength="100">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="biaya_kuliah">Biaya Kuliah</label>
                            <input type="text"
                                id="biaya_kuliah"
                                name="biaya_kuliah"
                                class="form-control"
                                placeholder="Contoh: Rp 15.000.000/tahun"
                                value="<?php echo set_value('biaya_kuliah', $prodi->biaya_kuliah) ?>"
                                maxlength="100">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Info Tab - BARU -->
            <div class="tab-pane" id="statistics-info">
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i>
                    <strong>Informasi Statistik:</strong>
                    Data statistik ini digunakan untuk menampilkan informasi kepada calon mahasiswa.
                    Perbarui dengan data aktual yang tersedia.
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="alumni_count">
                                <i class="fa fa-users text-blue"></i> Jumlah Alumni
                            </label>
                            <input type="number"
                                id="alumni_count"
                                name="alumni_count"
                                class="form-control"
                                placeholder="100"
                                value="<?php echo set_value('alumni_count', $prodi->alumni_count ?? 100) ?>"
                                min="0"
                                max="99999">
                            <small class="form-text text-muted">
                                Total alumni yang telah lulus. Current: <strong><?php echo number_format($prodi->alumni_count ?? 100) ?></strong>
                            </small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="job_placement">
                                <i class="fa fa-briefcase text-green"></i> Job Placement (%)
                            </label>
                            <input type="number"
                                id="job_placement"
                                name="job_placement"
                                class="form-control"
                                placeholder="90.00"
                                value="<?php echo set_value('job_placement', $prodi->job_placement ?? 90.00) ?>"
                                min="0"
                                max="100"
                                step="0.01">
                            <small class="form-text text-muted">
                                Persentase lulusan yang mendapat pekerjaan (0-100%). Current: <strong><?php echo number_format($prodi->job_placement ?? 90.00, 1) ?>%</strong>
                            </small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="rating">
                                <i class="fa fa-star text-yellow"></i> Rating Program Studi
                            </label>
                            <input type="number"
                                id="rating"
                                name="rating"
                                class="form-control"
                                placeholder="4.50"
                                value="<?php echo set_value('rating', $prodi->rating ?? 4.50) ?>"
                                min="0"
                                max="5"
                                step="0.01">
                            <small class="form-text text-muted">
                                Rating program studi (0-5). Current: <strong><?php echo number_format($prodi->rating ?? 4.50, 1) ?>/5</strong>
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Current Statistics Display -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <div class="box-header">
                                <h3 class="box-title">
                                    <i class="fa fa-eye"></i> Preview Statistik Saat Ini
                                </h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="info-box bg-aqua">
                                            <span class="info-box-icon"><i class="fa fa-users"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Alumni</span>
                                                <span class="info-box-number" id="current-alumni"><?php echo number_format($prodi->alumni_count ?? 100) ?></span>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: 100%"></div>
                                                </div>
                                                <span class="progress-description">Total lulusan</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-box bg-green">
                                            <span class="info-box-icon"><i class="fa fa-briefcase"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Job Placement</span>
                                                <span class="info-box-number" id="current-job"><?php echo number_format($prodi->job_placement ?? 90.00, 1) ?>%</span>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: <?php echo $prodi->job_placement ?? 90 ?>%"></div>
                                                </div>
                                                <span class="progress-description">Penempatan kerja</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-box bg-yellow">
                                            <span class="info-box-icon"><i class="fa fa-star"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Rating</span>
                                                <span class="info-box-number" id="current-rating"><?php echo number_format($prodi->rating ?? 4.50, 1) ?>/5</span>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: <?php echo (($prodi->rating ?? 4.50) / 5) * 100 ?>%"></div>
                                                </div>
                                                <span class="progress-description">Rating program studi</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics History/Notes -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="callout callout-warning">
                            <h4><i class="fa fa-info"></i> Catatan Penting:</h4>
                            <ul>
                                <li>Data statistik ini akan ditampilkan di halaman publik program studi</li>
                                <li>Pastikan data yang dimasukkan akurat dan dapat dipertanggungjawabkan</li>
                                <li>Update secara berkala sesuai dengan data terbaru yang tersedia</li>
                                <li>Rating dapat berasal dari survei kepuasan mahasiswa atau evaluasi eksternal</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Info Tab -->
            <div class="tab-pane" id="additional-info">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="icon">Icon (Bootstrap Icons)</label>
                            <select id="icon" name="icon" class="form-control">
                                <option value="">Pilih Icon</option>
                                <option value="bi bi-mortarboard-fill" <?php echo set_select('icon', 'bi bi-mortarboard-fill', ($prodi->icon == 'bi bi-mortarboard-fill')) ?>>🎓 Mortarboard</option>
                                <option value="bi bi-book-fill" <?php echo set_select('icon', 'bi bi-book-fill', ($prodi->icon == 'bi bi-book-fill')) ?>>📚 Book</option>
                                <option value="bi bi-laptop" <?php echo set_select('icon', 'bi bi-laptop', ($prodi->icon == 'bi bi-laptop')) ?>>💻 Laptop</option>
                                <option value="bi bi-gear-fill" <?php echo set_select('icon', 'bi bi-gear-fill', ($prodi->icon == 'bi bi-gear-fill')) ?>>⚙️ Gear</option>
                                <option value="bi bi-heart-pulse-fill" <?php echo set_select('icon', 'bi bi-heart-pulse-fill', ($prodi->icon == 'bi bi-heart-pulse-fill')) ?>>💓 Heart Pulse</option>
                                <option value="bi bi-calculator-fill" <?php echo set_select('icon', 'bi bi-calculator-fill', ($prodi->icon == 'bi bi-calculator-fill')) ?>>🧮 Calculator</option>
                                <option value="bi bi-palette-fill" <?php echo set_select('icon', 'bi bi-palette-fill', ($prodi->icon == 'bi bi-palette-fill')) ?>>🎨 Palette</option>
                                <option value="bi bi-music-note-beamed" <?php echo set_select('icon', 'bi bi-music-note-beamed', ($prodi->icon == 'bi bi-music-note-beamed')) ?>>🎵 Music</option>
                                <option value="bi bi-camera-fill" <?php echo set_select('icon', 'bi bi-camera-fill', ($prodi->icon == 'bi bi-camera-fill')) ?>>📷 Camera</option>
                                <option value="bi bi-building" <?php echo set_select('icon', 'bi bi-building', ($prodi->icon == 'bi bi-building')) ?>>🏢 Building</option>
                                <option value="bi bi-globe" <?php echo set_select('icon', 'bi bi-globe', ($prodi->icon == 'bi bi-globe')) ?>>🌍 Globe</option>
                                <option value="bi bi-cpu-fill" <?php echo set_select('icon', 'bi bi-cpu-fill', ($prodi->icon == 'bi bi-cpu-fill')) ?>>🖥️ CPU</option>
                                <option value="bi bi-microscope" <?php echo set_select('icon', 'bi bi-microscope', ($prodi->icon == 'bi bi-microscope')) ?>>🔬 Microscope</option>
                                <option value="bi bi-hospital" <?php echo set_select('icon', 'bi bi-hospital', ($prodi->icon == 'bi bi-hospital')) ?>>🏥 Hospital</option>
                                <option value="bi bi-briefcase-fill" <?php echo set_select('icon', 'bi bi-briefcase-fill', ($prodi->icon == 'bi bi-briefcase-fill')) ?>>💼 Briefcase</option>
                            </select>
                            <small class="form-text text-muted">
                                Icon akan ditampilkan di card program studi
                                <span id="icon-preview" style="margin-left: 10px;">
                                    <?php if (!empty($prodi->icon)) { ?>
                                        <i class="<?php echo $prodi->icon ?>" style="font-size: 16px;"></i>
                                    <?php } ?>
                                </span>
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="color">Color Theme</label>
                            <select id="color" name="color" class="form-control">
                                <option value="">Pilih Warna</option>
                                <option value="primary" <?php echo set_select('color', 'primary', ($prodi->color == 'primary')) ?>>Primary (Biru)</option>
                                <option value="success" <?php echo set_select('color', 'success', ($prodi->color == 'success')) ?>>Success (Hijau)</option>
                                <option value="info" <?php echo set_select('color', 'info', ($prodi->color == 'info')) ?>>Info (Cyan)</option>
                                <option value="warning" <?php echo set_select('color', 'warning', ($prodi->color == 'warning')) ?>>Warning (Kuning)</option>
                                <option value="danger" <?php echo set_select('color', 'danger', ($prodi->color == 'danger')) ?>>Danger (Merah)</option>
                                <option value="secondary" <?php echo set_select('color', 'secondary', ($prodi->color == 'secondary')) ?>>Secondary (Abu-abu)</option>
                                <option value="dark" <?php echo set_select('color', 'dark', ($prodi->color == 'dark')) ?>>Dark (Hitam)</option>
                            </select>
                            <small class="form-text text-muted">
                                Tema warna untuk card program studi
                                <span id="color-preview" class="badge <?php echo !empty($prodi->color) ? 'badge-' . $prodi->color : 'badge-default' ?>" style="margin-left: 10px;">
                                    <?php echo !empty($prodi->color) ? ucfirst($prodi->color) : 'Preview' ?>
                                </span>
                            </small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="link_brosur">Link Brosur</label>
                            <input type="url"
                                id="link_brosur"
                                name="link_brosur"
                                class="form-control"
                                placeholder="https://example.com/brosur.pdf"
                                value="<?php echo set_value('link_brosur', $prodi->link_brosur) ?>"
                                maxlength="255">
                            <small class="form-text text-muted">URL untuk download brosur program studi</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="link_detail">Link Detail</label>
                            <input type="url"
                                id="link_detail"
                                name="link_detail"
                                class="form-control"
                                placeholder="https://example.com/detail-prodi"
                                value="<?php echo set_value('link_detail', $prodi->link_detail) ?>"
                                maxlength="255">
                            <small class="form-text text-muted">URL untuk halaman detail program studi</small>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="prospek_title">Judul Prospek Karir</label>
                    <input type="text"
                        id="prospek_title"
                        name="prospek_title"
                        class="form-control"
                        placeholder="Contoh: Prospek Karir, Peluang Kerja"
                        value="<?php echo set_value('prospek_title', $prodi->prospek_title) ?>"
                        maxlength="100">
                    <small class="form-text text-muted">Judul untuk section prospek karir (opsional)</small>
                </div>

                <div class="form-group">
                    <label for="slug_preview">Slug (Auto-generate)</label>
                    <input type="text"
                        id="slug_preview"
                        class="form-control"
                        readonly
                        value="<?php echo $prodi->slug ?>"
                        placeholder="Slug akan dibuat otomatis">
                    <small class="form-text text-muted">
                        Dibuat otomatis dari nama program studi
                        <br><strong>Current:</strong> <code><?php echo $prodi->slug ?></code>
                    </small>
                </div>
            </div>

            <!-- Features & Prospects Tab -->
            <div class="tab-pane" id="features-info">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                <i class="fa fa-star"></i> Keunggulan Program Studi
                            </label>
                            <div id="keunggulan-container">
                                <?php if (!empty($prodi->keunggulan_array) && is_array($prodi->keunggulan_array)) { ?>
                                    <?php foreach ($prodi->keunggulan_array as $index => $keunggulan) { ?>
                                        <div class="input-group keunggulan-item" style="margin-bottom: 10px;">
                                            <input type="text"
                                                name="keunggulan[]"
                                                class="form-control"
                                                value="<?php echo htmlspecialchars($keunggulan) ?>"
                                                placeholder="Masukkan keunggulan program studi"
                                                maxlength="255">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-danger remove-keunggulan">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <div class="input-group keunggulan-item" style="margin-bottom: 10px;">
                                        <input type="text"
                                            name="keunggulan[]"
                                            class="form-control"
                                            placeholder="Masukkan keunggulan program studi"
                                            maxlength="255">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-danger remove-keunggulan">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <button type="button" id="add-keunggulan" class="btn btn-sm btn-success">
                                <i class="fa fa-plus"></i> Tambah Keunggulan
                            </button>
                            <small class="form-text text-muted">
                                Maksimal 255 karakter per keunggulan. Data akan disimpan dalam format JSON.
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                <i class="fa fa-briefcase"></i> Prospek Karir
                            </label>
                            <div id="prospek-container">
                                <?php if (!empty($prodi->prospek_karir_array) && is_array($prodi->prospek_karir_array)) { ?>
                                    <?php foreach ($prodi->prospek_karir_array as $index => $prospek) { ?>
                                        <div class="prospek-item" style="margin-bottom: 10px;">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <select name="prospek_karir[<?php echo $index ?>][icon]" class="form-control prospek-icon">
                                                        <option value="">Pilih Icon</option>
                                                        <option value="bi bi-building" <?php echo (isset($prospek['icon']) && $prospek['icon'] == 'bi bi-building') ? 'selected' : '' ?>>🏢 Building</option>
                                                        <option value="bi bi-hospital" <?php echo (isset($prospek['icon']) && $prospek['icon'] == 'bi bi-hospital') ? 'selected' : '' ?>>🏥 Hospital</option>
                                                        <option value="bi bi-briefcase" <?php echo (isset($prospek['icon']) && $prospek['icon'] == 'bi bi-briefcase') ? 'selected' : '' ?>>💼 Briefcase</option>
                                                        <option value="bi bi-people" <?php echo (isset($prospek['icon']) && $prospek['icon'] == 'bi bi-people') ? 'selected' : '' ?>>👥 People</option>
                                                        <option value="bi bi-gear" <?php echo (isset($prospek['icon']) && $prospek['icon'] == 'bi bi-gear') ? 'selected' : '' ?>>⚙️ Gear</option>
                                                        <option value="bi bi-laptop" <?php echo (isset($prospek['icon']) && $prospek['icon'] == 'bi bi-laptop') ? 'selected' : '' ?>>💻 Laptop</option>
                                                        <option value="bi bi-heart-pulse" <?php echo (isset($prospek['icon']) && $prospek['icon'] == 'bi bi-heart-pulse') ? 'selected' : '' ?>>💓 Medical</option>
                                                        <option value="bi bi-camera" <?php echo (isset($prospek['icon']) && $prospek['icon'] == 'bi bi-camera') ? 'selected' : '' ?>>📷 Media</option>
                                                        <option value="bi bi-palette" <?php echo (isset($prospek['icon']) && $prospek['icon'] == 'bi bi-palette') ? 'selected' : '' ?>>🎨 Creative</option>
                                                        <option value="bi bi-calculator" <?php echo (isset($prospek['icon']) && $prospek['icon'] == 'bi bi-calculator') ? 'selected' : '' ?>>🧮 Finance</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <select name="prospek_karir[<?php echo $index ?>][color]" class="form-control prospek-color">
                                                        <option value="">Pilih Warna</option>
                                                        <option value="primary" <?php echo (isset($prospek['color']) && $prospek['color'] == 'primary') ? 'selected' : '' ?>>Primary</option>
                                                        <option value="success" <?php echo (isset($prospek['color']) && $prospek['color'] == 'success') ? 'selected' : '' ?>>Success</option>
                                                        <option value="info" <?php echo (isset($prospek['color']) && $prospek['color'] == 'info') ? 'selected' : '' ?>>Info</option>
                                                        <option value="warning" <?php echo (isset($prospek['color']) && $prospek['color'] == 'warning') ? 'selected' : '' ?>>Warning</option>
                                                        <option value="danger" <?php echo (isset($prospek['color']) && $prospek['color'] == 'danger') ? 'selected' : '' ?>>Danger</option>
                                                        <option value="secondary" <?php echo (isset($prospek['color']) && $prospek['color'] == 'secondary') ? 'selected' : '' ?>>Secondary</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text"
                                                        name="prospek_karir[<?php echo $index ?>][text]"
                                                        class="form-control"
                                                        placeholder="Nama karir"
                                                        value="<?php echo isset($prospek['text']) ? htmlspecialchars($prospek['text']) : '' ?>"
                                                        maxlength="100">
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="btn btn-danger remove-prospek">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <div class="prospek-item" style="margin-bottom: 10px;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <select name="prospek_karir[0][icon]" class="form-control prospek-icon">
                                                    <option value="">Pilih Icon</option>
                                                    <option value="bi bi-building">🏢 Building</option>
                                                    <option value="bi bi-hospital">🏥 Hospital</option>
                                                    <option value="bi bi-briefcase">💼 Briefcase</option>
                                                    <option value="bi bi-people">👥 People</option>
                                                    <option value="bi bi-gear">⚙️ Gear</option>
                                                    <option value="bi bi-laptop">💻 Laptop</option>
                                                    <option value="bi bi-heart-pulse">💓 Medical</option>
                                                    <option value="bi bi-camera">📷 Media</option>
                                                    <option value="bi bi-palette">🎨 Creative</option>
                                                    <option value="bi bi-calculator">🧮 Finance</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select name="prospek_karir[0][color]" class="form-control prospek-color">
                                                    <option value="">Pilih Warna</option>
                                                    <option value="primary">Primary</option>
                                                    <option value="success">Success</option>
                                                    <option value="info">Info</option>
                                                    <option value="warning">Warning</option>
                                                    <option value="danger">Danger</option>
                                                    <option value="secondary">Secondary</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text"
                                                    name="prospek_karir[0][text]"
                                                    class="form-control"
                                                    placeholder="Nama karir"
                                                    maxlength="100">
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-danger remove-prospek">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <button type="button" id="add-prospek" class="btn btn-sm btn-success">
                                <i class="fa fa-plus"></i> Tambah Prospek Karir
                            </button>
                            <small class="form-text text-muted">
                                Maksimal 100 karakter per prospek karir. Data akan disimpan dalam format JSON.
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Preview Features & Prospects -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <div class="box-header">
                                <h3 class="box-title">
                                    <i class="fa fa-eye"></i> Preview Keunggulan & Prospek Karir
                                </h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5><i class="fa fa-star text-warning"></i> Keunggulan</h5>
                                        <ul id="preview-keunggulan" class="list-unstyled">
                                            <?php if (!empty($prodi->keunggulan_array)) { ?>
                                                <?php foreach ($prodi->keunggulan_array as $keunggulan) { ?>
                                                    <li><i class="fa fa-check text-success"></i> <?php echo htmlspecialchars($keunggulan) ?></li>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <li class="text-muted"><em>Belum ada keunggulan yang ditambahkan</em></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <h5><i class="fa fa-briefcase text-info"></i> Prospek Karir</h5>
                                        <div id="preview-prospek">
                                            <?php if (!empty($prodi->prospek_karir_array)) { ?>
                                                <?php foreach ($prodi->prospek_karir_array as $prospek) { ?>
                                                    <span class="badge badge-<?php echo $prospek['color'] ?? 'primary' ?>" style="margin: 2px;">
                                                        <i class="<?php echo $prospek['icon'] ?? 'bi bi-briefcase' ?>"></i>
                                                        <?php echo htmlspecialchars($prospek['text'] ?? '') ?>
                                                    </span>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <span class="text-muted"><em>Belum ada prospek karir yang ditambahkan</em></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Buttons -->
        <div class="form-group" style="margin-top: 30px;">
            <hr>
            <div class="btn-group">
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="fa fa-save"></i> Update Data
                </button>
                <button type="button" id="preview-btn" class="btn btn-info">
                    <i class="fa fa-eye"></i> Preview
                </button>
                <button type="button" class="btn btn-warning" onclick="resetForm()">
                    <i class="fa fa-refresh"></i> Reset
                </button>
                <a href="<?php echo base_url('admin/prodi') ?>" class="btn btn-default">
                    <i class="fa fa-times"></i> Batal
                </a>
            </div>
        </div>

        <?php echo form_close(); ?>
    </div>
</div>

<!-- Sidebar Info (Current Data) -->
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-info-circle"></i> Informasi Data Saat Ini
                </h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        <table class="table table-condensed">
                            <tr>
                                <td><strong>ID:</strong></td>
                                <td><?php echo $prodi->id ?></td>
                            </tr>
                            <tr>
                                <td><strong>Slug:</strong></td>
                                <td><code><?php echo $prodi->slug ?></code></td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    <span class="label <?php echo ($prodi->status == 'active') ? 'label-success' : 'label-danger' ?>">
                                        <?php echo ucfirst($prodi->status) ?>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <table class="table table-condensed">
                            <tr>
                                <td><strong>Jenjang:</strong></td>
                                <td>
                                    <?php if (!empty($prodi->jenjang)) { ?>
                                        <span class="label label-primary"><?php echo $prodi->jenjang ?></span>
                                    <?php } else { ?>
                                        <span class="text-muted">Belum diset</span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Akreditasi:</strong></td>
                                <td>
                                    <?php if (!empty($prodi->akreditasi)) { ?>
                                        <span class="label <?php
                                                            echo ($prodi->akreditasi == 'A') ? 'label-success' : (($prodi->akreditasi == 'B' || $prodi->akreditasi == 'Baik Sekali') ? 'label-warning' : 'label-info');
                                                            ?>"><?php echo $prodi->akreditasi ?></span>
                                    <?php } else { ?>
                                        <span class="text-muted">Belum terakreditasi</span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Gelar:</strong></td>
                                <td><?php echo $prodi->gelar ?: '-' ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <table class="table table-condensed">
                            <tr>
                                <td><strong>Durasi:</strong></td>
                                <td><?php echo $prodi->durasi ? $prodi->durasi . ' tahun' : '-' ?></td>
                            </tr>
                            <tr>
                                <td><strong>Total SKS:</strong></td>
                                <td><?php echo $prodi->total_sks ?: '-' ?></td>
                            </tr>
                            <tr>
                                <td><strong>Mode:</strong></td>
                                <td><?php echo $prodi->mode_kuliah ?: '-' ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <table class="table table-condensed">
                            <tr>
                                <td><strong>Alumni:</strong></td>
                                <td><span class="badge bg-blue"><?php echo number_format($prodi->alumni_count ?? 100) ?></span></td>
                            </tr>
                            <tr>
                                <td><strong>Job Placement:</strong></td>
                                <td><span class="badge bg-green"><?php echo number_format($prodi->job_placement ?? 90.00, 1) ?>%</span></td>
                            </tr>
                            <tr>
                                <td><strong>Rating:</strong></td>
                                <td><span class="badge bg-yellow"><?php echo number_format($prodi->rating ?? 4.50, 1) ?>/5</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <small class="text-muted">
                            <strong>Dibuat:</strong> <?php echo date('d/m/Y H:i', strtotime($prodi->created_at)) ?> |
                            <strong>Diupdate:</strong> <?php echo $prodi->updated_at ? date('d/m/Y H:i', strtotime($prodi->updated_at)) : 'Belum pernah' ?>
                            <?php if ($prodi->color) { ?>
                                | <strong>Color Theme:</strong> <span class="label label-<?php echo $prodi->color ?>"><?php echo $prodi->color ?></span>
                            <?php } ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript -->
<script>
    $(document).ready(function() {
        // Initialize TinyMCE
        tinymce.init({
            selector: '.tinymce-editor',
            height: 300,
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic forecolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family:"Segoe UI", Tahoma, Geneva, Verdana, sans-serif; font-size:14px }',
            setup: function(editor) {
                editor.on('change keyup', function() {
                    editor.save();
                    updateDescriptionCharCount();
                });
            },
            branding: false,
            promotion: false
        });

        // Initialize counters - Perbaikan untuk menghindari error
        var keunggulanIndex = <?php echo !empty($prodi->keunggulan_array) && is_array($prodi->keunggulan_array) ? count($prodi->keunggulan_array) : 1; ?>;
        var prospekIndex = <?php echo !empty($prodi->prospek_karir_array) && is_array($prodi->prospek_karir_array) ? count($prodi->prospek_karir_array) : 1; ?>;

        // Form validation
        $('#form-edit-prodi').on('submit', function(e) {
            // Sync TinyMCE content
            if (tinymce.get('deskripsi')) {
                tinymce.get('deskripsi').save();
            }

            var nama = $('#nama').val().trim();
            var jurusan_id = $('#jurusan_id').val();
            var isValid = true;

            // Clear previous errors
            $('.form-group').removeClass('has-error');
            $('.error-message').remove();

            if (nama === '') {
                $('#nama').closest('.form-group').addClass('has-error');
                $('#nama').after('<span class="error-message text-danger">Nama program studi harus diisi</span>');
                isValid = false;
            }

            if (jurusan_id === '') {
                $('#jurusan_id').closest('.form-group').addClass('has-error');
                $('#jurusan_id').after('<span class="error-message text-danger">Jurusan harus dipilih</span>');
                isValid = false;
            }

            // Validate statistics
            var alumni_count = $('#alumni_count').val();
            var job_placement = $('#job_placement').val();
            var rating = $('#rating').val();

            if (alumni_count && (isNaN(alumni_count) || alumni_count < 0)) {
                $('#alumni_count').closest('.form-group').addClass('has-error');
                $('#alumni_count').after('<span class="error-message text-danger">Jumlah alumni harus berupa angka positif</span>');
                isValid = false;
            }

            if (job_placement && (isNaN(job_placement) || job_placement < 0 || job_placement > 100)) {
                $('#job_placement').closest('.form-group').addClass('has-error');
                $('#job_placement').after('<span class="error-message text-danger">Job placement harus antara 0-100%</span>');
                isValid = false;
            }

            if (rating && (isNaN(rating) || rating < 0 || rating > 5)) {
                $('#rating').closest('.form-group').addClass('has-error');
                $('#rating').after('<span class="error-message text-danger">Rating harus antara 0-5</span>');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                $('a[href="#basic-info"]').tab('show');
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Error',
                    text: 'Mohon periksa kembali data yang Anda masukkan',
                    timer: 3000
                });
                return false;
            }

            // Show loading
            Swal.fire({
                title: 'Menyimpan Data',
                text: 'Mohon tunggu...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        });

        // Add keunggulan
        $('#add-keunggulan').click(function() {
            var html = '<div class="input-group keunggulan-item" style="margin-bottom: 10px;">' +
                '<input type="text" name="keunggulan[]" class="form-control" placeholder="Masukkan keunggulan program studi" maxlength="255">' +
                '<div class="input-group-btn">' +
                '<button type="button" class="btn btn-danger remove-keunggulan"><i class="fa fa-minus"></i></button>' +
                '</div></div>';
            $('#keunggulan-container').append(html);
            updateKeunggulanPreview();
        });

        // Remove keunggulan
        $(document).on('click', '.remove-keunggulan', function() {
            if ($('.keunggulan-item').length > 1) {
                $(this).closest('.keunggulan-item').remove();
                updateKeunggulanPreview();
            }
        });

        // Add prospek karir
        $('#add-prospek').click(function() {
            prospekIndex++;
            var html = '<div class="prospek-item" style="margin-bottom: 10px;">' +
                '<div class="row">' +
                '<div class="col-md-4">' +
                '<select name="prospek_karir[' + prospekIndex + '][icon]" class="form-control prospek-icon">' +
                '<option value="">Pilih Icon</option>' +
                '<option value="bi bi-building">🏢 Building</option>' +
                '<option value="bi bi-hospital">🏥 Hospital</option>' +
                '<option value="bi bi-briefcase">💼 Briefcase</option>' +
                '<option value="bi bi-people">👥 People</option>' +
                '<option value="bi bi-gear">⚙️ Gear</option>' +
                '<option value="bi bi-laptop">💻 Laptop</option>' +
                '<option value="bi bi-heart-pulse">💓 Medical</option>' +
                '<option value="bi bi-camera">📷 Media</option>' +
                '<option value="bi bi-palette">🎨 Creative</option>' +
                '<option value="bi bi-calculator">🧮 Finance</option>' +
                '</select></div>' +
                '<div class="col-md-3">' +
                '<select name="prospek_karir[' + prospekIndex + '][color]" class="form-control prospek-color">' +
                '<option value="">Pilih Warna</option>' +
                '<option value="primary">Primary</option>' +
                '<option value="success">Success</option>' +
                '<option value="info">Info</option>' +
                '<option value="warning">Warning</option>' +
                '<option value="danger">Danger</option>' +
                '<option value="secondary">Secondary</option>' +
                '</select></div>' +
                '<div class="col-md-4">' +
                '<input type="text" name="prospek_karir[' + prospekIndex + '][text]" class="form-control" placeholder="Nama karir" maxlength="100">' +
                '</div>' +
                '<div class="col-md-1">' +
                '<button type="button" class="btn btn-danger remove-prospek"><i class="fa fa-minus"></i></button>' +
                '</div></div></div>';
            $('#prospek-container').append(html);
            updateProspekPreview();
        });

        // Remove prospek karir
        $(document).on('click', '.remove-prospek', function() {
            if ($('.prospek-item').length > 1) {
                $(this).closest('.prospek-item').remove();
                updateProspekPreview();
            }
        });

        // Statistics preview update
        function updateStatsPreview() {
            var alumni = $('#alumni_count').val() || <?php echo json_encode($prodi->alumni_count ?? 100) ?>;
            var job = $('#job_placement').val() || <?php echo json_encode($prodi->job_placement ?? 90.00) ?>;
            var rating = $('#rating').val() || <?php echo json_encode($prodi->rating ?? 4.50) ?>;

            $('#current-alumni').text(parseInt(alumni).toLocaleString());
            $('#current-job').text(parseFloat(job).toFixed(1) + '%');
            $('#current-rating').text(parseFloat(rating).toFixed(1) + '/5');

            // Update progress bars
            $('.info-box.bg-green .progress-bar').css('width', parseFloat(job) + '%');
            $('.info-box.bg-yellow .progress-bar').css('width', (parseFloat(rating) / 5) * 100 + '%');
        }

        // Update statistics preview when values change
        $('#alumni_count, #job_placement, #rating').on('input change', updateStatsPreview);

        // Icon and color preview
        $('#icon').on('change', function() {
            var iconClass = $(this).val();
            if (iconClass) {
                $('#icon-preview').html('<i class="' + iconClass + '" style="font-size: 16px;"></i>');
            } else {
                $('#icon-preview').html('');
            }
        });

        $('#color').on('change', function() {
            var color = $(this).val();
            if (color) {
                $('#color-preview').removeClass().addClass('badge badge-' + color).text(ucfirst(color));
            } else {
                $('#color-preview').removeClass().addClass('badge badge-default').text('Preview');
            }
        });

        // Update keunggulan preview
        function updateKeunggulanPreview() {
            var keunggulanList = [];
            $('input[name="keunggulan[]"]').each(function() {
                var value = $(this).val().trim();
                if (value) {
                    keunggulanList.push(value);
                }
            });

            var html = '';
            if (keunggulanList.length > 0) {
                keunggulanList.forEach(function(item) {
                    html += '<li><i class="fa fa-check text-success"></i> ' + item + '</li>';
                });
            } else {
                html = '<li class="text-muted"><em>Belum ada keunggulan yang ditambahkan</em></li>';
            }
            $('#preview-keunggulan').html(html);
        }

        // Update prospek preview
        function updateProspekPreview() {
            var prospekList = [];
            $('.prospek-item').each(function() {
                var icon = $(this).find('select[name$="[icon]"]').val();
                var color = $(this).find('select[name$="[color]"]').val();
                var text = $(this).find('input[name$="[text]"]').val().trim();

                if (text) {
                    prospekList.push({
                        icon: icon,
                        color: color,
                        text: text
                    });
                }
            });

            var html = '';
            if (prospekList.length > 0) {
                prospekList.forEach(function(item) {
                    html += '<span class="badge badge-' + (item.color || 'primary') + '" style="margin: 2px;">' +
                        '<i class="' + (item.icon || 'bi bi-briefcase') + '"></i> ' +
                        item.text +
                        '</span>';
                });
            } else {
                html = '<span class="text-muted"><em>Belum ada prospek karir yang ditambahkan</em></span>';
            }
            $('#preview-prospek').html(html);
        }

        // Character counters
        function updateCharCount(element, countElement, maxLength) {
            var length = element.val().length;
            $(countElement).text(length);

            $(countElement).removeClass('text-warning text-danger');

            if (length > maxLength * 0.9) {
                $(countElement).addClass('text-warning');
            }

            if (length > maxLength) {
                $(countElement).removeClass('text-warning').addClass('text-danger');
            }
        }

        $('#visi').on('keyup', function() {
            updateCharCount($(this), '#char-count-visi', 1000);
        });

        $('#misi').on('keyup', function() {
            updateCharCount($(this), '#char-count-misi', 2000);
        });

        // Initialize character counts
        updateCharCount($('#visi'), '#char-count-visi', 1000);
        updateCharCount($('#misi'), '#char-count-misi', 2000);

        // Auto-hide alerts
        setTimeout(function() {
            $('.alert').slideUp('slow');
        }, 5000);

        // Slug auto-generate
        $('#nama').on('keyup', function() {
            var nama = $(this).val();
            var slug = nama.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
            $('#slug_preview').val(slug);
        });
    });

    // Reset form function - Perbaikan untuk menghindari syntax error
    function resetForm() {
        if (confirm('Apakah Anda yakin ingin mereset form? Semua perubahan akan hilang.')) {
            // Reset TinyMCE content dengan escape yang aman
            var originalContent = <?php echo json_encode($prodi->deskripsi); ?>;
            if (typeof tinymce !== 'undefined' && tinymce.get('deskripsi')) {
                tinymce.get('deskripsi').setContent(originalContent);
            }

            // Reset form
            document.getElementById('form-edit-prodi').reset();

            // Reset character counts
            $('#char-count-visi').text('0');
            $('#char-count-misi').text('0');

            // Reinitialize character counts
            setTimeout(function() {
                updateCharCount($('#visi'), '#char-count-visi', 1000);
                updateCharCount($('#misi'), '#char-count-misi', 2000);
            }, 100);
        }
    }

    // Preview function
    $('#preview-btn').click(function() {
        // Sync TinyMCE before preview
        if (typeof tinymce !== 'undefined') {
            tinymce.triggerSave();
        }

        var formData = $('#form-edit-prodi').serialize();

        // Open preview in new window/tab
        var previewUrl = '<?php echo base_url("admin/prodi/preview/" . $prodi->id); ?>';
        var previewWindow = window.open(previewUrl, '_blank');

        if (previewWindow) {
            // Post data to preview window if needed
            console.log('Preview opened with data:', formData);
        } else {
            alert('Popup diblokir! Silakan izinkan popup untuk preview.');
        }
    });
</script>

<style>
    .nav-tabs {
        border-bottom: 2px solid #f4f4f4;
        margin-bottom: 20px;
    }

    .nav-tabs>li.active>a {
        border-bottom: 2px solid #3c8dbc;
        font-weight: bold;
    }

    .tab-content {
        min-height: 300px;
    }

    .keunggulan-item,
    .prospek-item {
        margin-bottom: 10px;
    }

    .has-error .form-control {
        border-color: #dd4b39;
    }

    .error-message {
        display: block;
        margin-top: 5px;
        font-size: 12px;
    }

    #slug_preview {
        background-color: #f8f9fa;
        font-family: 'Courier New', monospace;
        font-size: 12px;
    }
</style>