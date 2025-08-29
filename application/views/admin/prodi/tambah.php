<button class="btn btn-primary" data-toggle="modal" data-target="#TambahProdi">
    <i class="fa fa-plus"></i> Tambah Program Studi
</button>

<div class="modal fade" id="TambahProdi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">
                    <i class="fa fa-plus"></i> Tambah Data Program Studi
                </h4>
            </div>
            <div class="modal-body">

                <?php
                // Validasi error
                echo validation_errors('<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> ', '</div>');

                // Form buka - sesuaikan dengan controller prodi
                echo form_open(base_url('admin/prodi'), array('id' => 'form-tambah-prodi'));
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
                                        value="<?php echo set_value('nama') ?>"
                                        maxlength="100"
                                        required>
                                    <small class="form-text text-muted">Maksimal 100 karakter. Slug akan dibuat otomatis.</small>
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
                                                    <option value="<?php echo $key ?>" <?php echo set_select('jurusan_id', $key) ?>>
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
                                placeholder="Masukkan deskripsi lengkap program studi (opsional)"><?php echo set_value('deskripsi') ?></textarea>
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
                                        maxlength="1000"><?php echo set_value('visi') ?></textarea>
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
                                        maxlength="2000"><?php echo set_value('misi') ?></textarea>
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
                                        <option value="D3" <?php echo set_select('jenjang', 'D3') ?>>Diploma 3 (D3)</option>
                                        <option value="STr" <?php echo set_select('jenjang', 'STr') ?>>Sarjana Terapan (STr)</option>
                                        <option value="Profesi" <?php echo set_select('jenjang', 'Profesi') ?>>Profesi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="akreditasi">Akreditasi</label>
                                    <select id="akreditasi" name="akreditasi" class="form-control">
                                        <option value="">Belum Terakreditasi</option>
                                        <option value="A" <?php echo set_select('akreditasi', 'A') ?>>A (Unggul)</option>
                                        <option value="B" <?php echo set_select('akreditasi', 'B') ?>>B (Baik Sekali)</option>
                                        <option value="C" <?php echo set_select('akreditasi', 'C') ?>>C (Baik)</option>
                                        <option value="Baik Sekali" <?php echo set_select('akreditasi', 'Baik Sekali') ?>>Baik Sekali</option>
                                        <option value="Baik" <?php echo set_select('akreditasi', 'Baik') ?>>Baik</option>
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
                                        value="<?php echo set_value('gelar') ?>"
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
                                        value="<?php echo set_value('durasi') ?>"
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
                                        value="<?php echo set_value('total_sks') ?>"
                                        min="1"
                                        max="200">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-control">
                                        <option value="active" <?php echo set_select('status', 'active', TRUE) ?>>Aktif</option>
                                        <option value="inactive" <?php echo set_select('status', 'inactive') ?>>Tidak Aktif</option>
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
                                        value="<?php echo set_value('mode_kuliah') ?>"
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
                                        value="<?php echo set_value('biaya_kuliah') ?>"
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
                            Anda dapat mengisi nilai estimasi atau data aktual yang tersedia.
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
                                        value="<?php echo set_value('alumni_count', '100') ?>"
                                        min="0"
                                        max="99999">
                                    <small class="form-text text-muted">
                                        Estimasi total alumni yang telah lulus. Default: 100
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
                                        value="<?php echo set_value('job_placement', '90.00') ?>"
                                        min="0"
                                        max="100"
                                        step="0.01">
                                    <small class="form-text text-muted">
                                        Persentase lulusan yang mendapat pekerjaan (0-100%). Default: 90%
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
                                        value="<?php echo set_value('rating', '4.50') ?>"
                                        min="0"
                                        max="5"
                                        step="0.01">
                                    <small class="form-text text-muted">
                                        Rating program studi (0-5). Default: 4.5/5
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Statistics Preview -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-solid">
                                    <div class="box-header">
                                        <h3 class="box-title">
                                            <i class="fa fa-eye"></i> Preview Tampilan Statistik
                                        </h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="row" id="stats-preview">
                                            <div class="col-md-4">
                                                <div class="info-box bg-aqua">
                                                    <span class="info-box-icon"><i class="fa fa-users"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Alumni</span>
                                                        <span class="info-box-number" id="preview-alumni">100</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="info-box bg-green">
                                                    <span class="info-box-icon"><i class="fa fa-briefcase"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Job Placement</span>
                                                        <span class="info-box-number" id="preview-job">90.0%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="info-box bg-yellow">
                                                    <span class="info-box-icon"><i class="fa fa-star"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Rating</span>
                                                        <span class="info-box-number" id="preview-rating">4.5/5</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                        <option value="bi bi-mortarboard-fill" <?php echo set_select('icon', 'bi bi-mortarboard-fill') ?>>🎓 Mortarboard</option>
                                        <option value="bi bi-book-fill" <?php echo set_select('icon', 'bi bi-book-fill') ?>>📚 Book</option>
                                        <option value="bi bi-laptop" <?php echo set_select('icon', 'bi bi-laptop') ?>>💻 Laptop</option>
                                        <option value="bi bi-gear-fill" <?php echo set_select('icon', 'bi bi-gear-fill') ?>>⚙️ Gear</option>
                                        <option value="bi bi-heart-pulse-fill" <?php echo set_select('icon', 'bi bi-heart-pulse-fill') ?>>💓 Heart Pulse</option>
                                        <option value="bi bi-calculator-fill" <?php echo set_select('icon', 'bi bi-calculator-fill') ?>>🧮 Calculator</option>
                                        <option value="bi bi-palette-fill" <?php echo set_select('icon', 'bi bi-palette-fill') ?>>🎨 Palette</option>
                                        <option value="bi bi-music-note-beamed" <?php echo set_select('icon', 'bi bi-music-note-beamed') ?>>🎵 Music</option>
                                        <option value="bi bi-camera-fill" <?php echo set_select('icon', 'bi bi-camera-fill') ?>>📷 Camera</option>
                                        <option value="bi bi-building" <?php echo set_select('icon', 'bi bi-building') ?>>🏢 Building</option>
                                        <option value="bi bi-globe" <?php echo set_select('icon', 'bi bi-globe') ?>>🌍 Globe</option>
                                        <option value="bi bi-cpu-fill" <?php echo set_select('icon', 'bi bi-cpu-fill') ?>>🖥️ CPU</option>
                                        <option value="bi bi-microscope" <?php echo set_select('icon', 'bi bi-microscope') ?>>🔬 Microscope</option>
                                        <option value="bi bi-hospital" <?php echo set_select('icon', 'bi bi-hospital') ?>>🏥 Hospital</option>
                                        <option value="bi bi-briefcase-fill" <?php echo set_select('icon', 'bi bi-briefcase-fill') ?>>💼 Briefcase</option>
                                    </select>
                                    <small class="form-text text-muted">
                                        Icon akan ditampilkan di card program studi
                                        <span id="icon-preview" style="margin-left: 10px;"></span>
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="color">Color Theme</label>
                                    <select id="color" name="color" class="form-control">
                                        <option value="">Pilih Warna</option>
                                        <option value="primary" <?php echo set_select('color', 'primary') ?>>Primary (Biru)</option>
                                        <option value="success" <?php echo set_select('color', 'success') ?>>Success (Hijau)</option>
                                        <option value="info" <?php echo set_select('color', 'info') ?>>Info (Cyan)</option>
                                        <option value="warning" <?php echo set_select('color', 'warning') ?>>Warning (Kuning)</option>
                                        <option value="danger" <?php echo set_select('color', 'danger') ?>>Danger (Merah)</option>
                                        <option value="secondary" <?php echo set_select('color', 'secondary') ?>>Secondary (Abu-abu)</option>
                                        <option value="dark" <?php echo set_select('color', 'dark') ?>>Dark (Hitam)</option>
                                    </select>
                                    <small class="form-text text-muted">
                                        Tema warna untuk card program studi
                                        <span id="color-preview" class="badge" style="margin-left: 10px;">Preview</span>
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
                                        value="<?php echo set_value('link_brosur') ?>"
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
                                        value="<?php echo set_value('link_detail') ?>"
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
                                value="<?php echo set_value('prospek_title') ?>"
                                maxlength="100">
                            <small class="form-text text-muted">Judul untuk section prospek karir (opsional)</small>
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
                                                    <li class="text-muted"><em>Belum ada keunggulan yang ditambahkan</em></li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <h5><i class="fa fa-briefcase text-info"></i> Prospek Karir</h5>
                                                <div id="preview-prospek">
                                                    <span class="text-muted"><em>Belum ada prospek karir yang ditambahkan</em></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php echo form_close(); ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-times"></i> Batal
                </button>
                <button type="button" class="btn btn-info" id="preview-form">
                    <i class="fa fa-eye"></i> Preview
                </button>
                <button type="submit" form="form-tambah-prodi" class="btn btn-success">
                    <i class="fa fa-save"></i> Simpan Data
                </button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk form handling -->
<script>
    $(document).ready(function() {
        // Initialize TinyMCE
        var tinymceConfig = {
            selector: '.tinymce-editor',
            height: 300,
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic forecolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; font-size: 14px }',
            setup: function(editor) {
                editor.on('change keyup', function() {
                    editor.save();
                    updateDescriptionCharCount();
                });
            },
            branding: false,
            promotion: false
        };

        // Initialize TinyMCE
        tinymce.init(tinymceConfig);

        var keunggulanIndex = 1;
        var prospekIndex = 1;

        // Form validation - Update untuk TinyMCE
        $('#form-tambah-prodi').on('submit', function(e) {
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
            prospekIndex++;
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
            var alumni = $('#alumni_count').val() || '100';
            var job = $('#job_placement').val() || '90.0';
            var rating = $('#rating').val() || '4.5';

            $('#preview-alumni').text(parseInt(alumni).toLocaleString());
            $('#preview-job').text(parseFloat(job).toFixed(1) + '%');
            $('#preview-rating').text(parseFloat(rating).toFixed(1) + '/5');
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
                $('#color-preview').removeClass().addClass('badge badge-' + color).text(color);
            } else {
                $('#color-preview').removeClass().addClass('badge').text('Preview');
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
                var icon = $(this).find('.prospek-icon').val();
                var color = $(this).find('.prospek-color').val();
                var text = $(this).find('input[type="text"]').val().trim();

                if (text) {
                    prospekList.push({
                        icon: icon || 'bi bi-briefcase',
                        color: color || 'primary',
                        text: text
                    });
                }
            });

            var html = '';
            if (prospekList.length > 0) {
                prospekList.forEach(function(item) {
                    html += '<span class="badge badge-' + item.color + '" style="margin: 2px;">';
                    html += '<i class="' + item.icon + '"></i> ' + item.text + '</span> ';
                });
            } else {
                html = '<span class="text-muted"><em>Belum ada prospek karir yang ditambahkan</em></span>';
            }

            $('#preview-prospek').html(html);
        }

        // Monitor changes for preview updates
        $(document).on('input change', 'input[name="keunggulan[]"]', updateKeunggulanPreview);
        $(document).on('change', '.prospek-icon, .prospek-color', updateProspekPreview);
        $(document).on('input', '.prospek-item input[type="text"]', updateProspekPreview);

        // Character counters
        function updateCharCount(element, countElement, maxLength) {
            var length = element.val().length;
            $(countElement).text(length);

            if (length > maxLength * 0.9) {
                $(countElement).addClass('text-warning').removeClass('text-danger');
            } else {
                $(countElement).removeClass('text-warning text-danger');
            }

            if (length > maxLength) {
                $(countElement).addClass('text-danger').removeClass('text-warning');
            }
        }

        function updateDescriptionCharCount() {
            if (tinymce.get('deskripsi')) {
                var content = tinymce.get('deskripsi').getContent();
                var textContent = $('<div>').html(content).text();
                $('#char-count-desc').text(textContent.length);
            }
        }

        $('#visi').on('keyup', function() {
            updateCharCount($(this), '#char-count-visi', 1000);
        });

        $('#misi').on('keyup', function() {
            updateCharCount($(this), '#char-count-misi', 2000);
        });

        // Preview form functionality
        $('#preview-form').on('click', function() {
            var formData = $('#form-tambah-prodi').serialize();

            Swal.fire({
                title: 'Preview Form Data',
                html: '<div class="text-left"><pre>' + formData.replace(/&/g, '\n') + '</pre></div>',
                width: '800px',
                showCancelButton: true,
                confirmButtonText: 'Lanjut Submit',
                cancelButtonText: 'Tutup Preview'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form-tambah-prodi').submit();
                }
            });
        });

        // Initialize previews
        updateStatsPreview();
        updateKeunggulanPreview();
        updateProspekPreview();
        updateCharCount($('#visi'), '#char-count-visi', 1000);
        updateCharCount($('#misi'), '#char-count-misi', 2000);

        // Initialize description char count after TinyMCE loads
        setTimeout(function() {
            updateDescriptionCharCount();
        }, 1000);
    });
</script>

<style>
    .modal-xl {
        width: 90%;
        max-width: 1200px;
    }

    .nav-tabs {
        border-bottom: 2px solid #f4f4f4;
        margin-bottom: 20px;
    }

    .nav-tabs>li.active>a {
        border-bottom: 2px solid #3c8dbc;
        font-weight: bold;
        background-color: #f8f9fa;
    }

    .nav-tabs>li>a:hover {
        background-color: #f8f9fa;
        border-color: #ddd;
    }

    .tab-content {
        min-height: 500px;
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

    .info-box {
        margin-bottom: 10px;
    }

    .info-box-content {
        padding: 10px;
    }

    .info-box-number {
        font-size: 18px;
        font-weight: bold;
    }

    .badge {
        margin: 2px;
        padding: 4px 8px;
    }

    #icon-preview,
    #color-preview {
        display: inline-block;
        margin-left: 10px;
    }

    .box-solid>.box-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #ddd;
    }

    .text-warning {
        color: #f39c12 !important;
    }

    .text-danger {
        color: #dd4b39 !important;
    }

    .text-success {
        color: #00a65a !important;
    }

    .text-info {
        color: #00c0ef !important;
    }

    .text-blue {
        color: #3c8dbc !important;
    }

    .text-green {
        color: #00a65a !important;
    }

    .text-yellow {
        color: #f39c12 !important;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .modal-xl {
            width: 95%;
            margin: 10px auto;
        }

        .prospek-item .col-md-4,
        .prospek-item .col-md-3,
        .prospek-item .col-md-1 {
            margin-bottom: 5px;
        }
    }
</style>