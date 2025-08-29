<!-- Navigation Breadcrumb -->
<div class="box">
    <div class="box-header">
        <h3 class="box-title">
            <i class="fa fa-edit"></i> Edit pusat: <?php echo htmlspecialchars($pusat->nama) ?>
        </h3>
        <div class="box-tools pull-right">
            <a href="<?php echo base_url('admin/pusat') ?>" class="btn btn-default btn-sm">
                <i class="fa fa-arrow-left"></i> Kembali ke Daftar
            </a>
            <a href="<?php echo base_url('admin/pusat/detail/' . $pusat->id) ?>" class="btn btn-info btn-sm">
                <i class="fa fa-eye"></i> Lihat Detail
            </a>
            <a href="<?php echo base_url('admin/pusat/preview/' . $pusat->id) ?>" target="_blank" class="btn btn-primary btn-sm">
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
        echo form_open_multipart(base_url('admin/pusat/edit/' . $pusat->id), array('id' => 'form-edit-pusat'));
        ?>

        <div class="form-group">
            <label for="nama">Nama pusat <span class="text-danger">*</span></label>
            <input type="text"
                id="nama"
                name="nama"
                class="form-control"
                placeholder="Masukkan nama pusat"
                value="<?php echo set_value('nama', $pusat->nama) ?>"
                maxlength="100"
                required>
            <small class="form-text text-muted">Maksimal 100 karakter. Slug akan diupdate otomatis jika kosong.</small>
        </div>

        <div class="form-group">
            <label for="slug">Slug (opsional)</label>
            <input type="text"
                id="slug"
                name="slug"
                class="form-control"
                placeholder="Slug otomatis jika dikosongkan"
                value="<?php echo set_value('slug', $pusat->slug) ?>"
                maxlength="100">
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi"
                name="deskripsi"
                class="form-control tinymce-editor"
                rows="6"
                placeholder="Masukkan deskripsi pusat"><?php echo set_value('deskripsi', $pusat->deskripsi) ?></textarea>
        </div>

        <div class="form-group">
            <label for="tagline">Tagline</label>
            <input type="text"
                id="tagline"
                name="tagline"
                class="form-control"
                placeholder="Tagline pusat (opsional)"
                value="<?php echo set_value('tagline', $pusat->tagline) ?>"
                maxlength="200">
        </div>

        <div class="form-group">
            <label>Keunggulan / Fitur pusat <small>(opsional, icon, warna, dan teks)</small></label>
            <div id="features-container">
                <?php
                $features = !empty($existing_features) ? $existing_features : array();
                if (!empty($features)) {
                    foreach ($features as $idx => $feature) { ?>
                        <div class="row feature-item" style="margin-bottom:10px;">
                            <div class="col-md-3">
                                <select name="feature_icon[]" class="form-control">
                                    <option value="">Icon</option>
                                    <option value="bi bi-star" <?php echo (isset($feature['icon']) && $feature['icon'] == 'bi bi-star') ? 'selected' : '' ?>>★ Star</option>
                                    <option value="bi bi-award" <?php echo (isset($feature['icon']) && $feature['icon'] == 'bi bi-award') ? 'selected' : '' ?>>🏅 Award</option>
                                    <option value="bi bi-gear" <?php echo (isset($feature['icon']) && $feature['icon'] == 'bi bi-gear') ? 'selected' : '' ?>>⚙️ Gear</option>
                                    <option value="bi bi-people" <?php echo (isset($feature['icon']) && $feature['icon'] == 'bi bi-people') ? 'selected' : '' ?>>👥 People</option>
                                    <option value="bi bi-lightning" <?php echo (isset($feature['icon']) && $feature['icon'] == 'bi bi-lightning') ? 'selected' : '' ?>>⚡ Lightning</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="feature_color[]" class="form-control">
                                    <option value="">Warna</option>
                                    <option value="primary" <?php echo (isset($feature['color']) && $feature['color'] == 'primary') ? 'selected' : '' ?>>Primary</option>
                                    <option value="success" <?php echo (isset($feature['color']) && $feature['color'] == 'success') ? 'selected' : '' ?>>Success</option>
                                    <option value="info" <?php echo (isset($feature['color']) && $feature['color'] == 'info') ? 'selected' : '' ?>>Info</option>
                                    <option value="warning" <?php echo (isset($feature['color']) && $feature['color'] == 'warning') ? 'selected' : '' ?>>Warning</option>
                                    <option value="danger" <?php echo (isset($feature['color']) && $feature['color'] == 'danger') ? 'selected' : '' ?>>Danger</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="feature_text[]" class="form-control" placeholder="Teks fitur" maxlength="255" value="<?php echo isset($feature['text']) ? htmlspecialchars($feature['text']) : '' ?>">
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger remove-feature"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <div class="row feature-item" style="margin-bottom:10px;">
                        <div class="col-md-3">
                            <select name="feature_icon[]" class="form-control">
                                <option value="">Icon</option>
                                <option value="bi bi-star">★ Star</option>
                                <option value="bi bi-award">🏅 Award</option>
                                <option value="bi bi-gear">⚙️ Gear</option>
                                <option value="bi bi-people">👥 People</option>
                                <option value="bi bi-lightning">⚡ Lightning</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="feature_color[]" class="form-control">
                                <option value="">Warna</option>
                                <option value="primary">Primary</option>
                                <option value="success">Success</option>
                                <option value="info">Info</option>
                                <option value="warning">Warning</option>
                                <option value="danger">Danger</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="feature_text[]" class="form-control" placeholder="Teks fitur" maxlength="255">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger remove-feature"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <button type="button" id="add-feature" class="btn btn-sm btn-success" style="margin-top:10px;">
                <i class="fa fa-plus"></i> Tambah Fitur
            </button>
            <small class="form-text text-muted">Setiap fitur terdiri dari icon, warna, dan teks. Data akan disimpan dalam format JSON.</small>
        </div>

        <div class="form-group">
            <label for="image">Gambar/Logo pusat <small>(opsional, jpg/png/webp, max 2MB)</small></label>
            <?php if (!empty($pusat->image)) { ?>
                <div style="margin-bottom:10px;">
                    <img src="<?php echo base_url('assets/images/pusat/' . $pusat->image) ?>" alt="Image" style="max-width:100px;max-height:100px;">
                    <a href="#" class="btn btn-xs btn-danger delete-image" data-id="<?php echo $pusat->id ?>"><i class="fa fa-trash"></i> Hapus Gambar</a>
                </div>
            <?php } ?>
            <input type="file" id="image" name="image" class="form-control">
        </div>

        <div class="form-group" style="margin-top: 30px;">
            <hr>
            <div class="btn-group">
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="fa fa-save"></i> Update Data
                </button>
                <a href="<?php echo base_url('admin/pusat') ?>" class="btn btn-default">
                    <i class="fa fa-times"></i> Batal
                </a>
            </div>
        </div>

        <?php echo form_close(); ?>
    </div>
</div>

<script>
    // TinyMCE init
    $(document).ready(function() {
        if (typeof tinymce !== 'undefined') {
            tinymce.init({
                selector: '.tinymce-editor',
                height: 200,
                menubar: false
            });
        }

        // Add feature
        $('#add-feature').click(function() {
            var html = `<div class="row feature-item" style="margin-bottom:10px;">
                <div class="col-md-3">
                    <select name="feature_icon[]" class="form-control">
                        <option value="">Icon</option>
                        <option value="bi bi-star">★ Star</option>
                        <option value="bi bi-award">🏅 Award</option>
                        <option value="bi bi-gear">⚙️ Gear</option>
                        <option value="bi bi-people">👥 People</option>
                        <option value="bi bi-lightning">⚡ Lightning</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="feature_color[]" class="form-control">
                        <option value="">Warna</option>
                        <option value="primary">Primary</option>
                        <option value="success">Success</option>
                        <option value="info">Info</option>
                        <option value="warning">Warning</option>
                        <option value="danger">Danger</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <input type="text" name="feature_text[]" class="form-control" placeholder="Teks fitur" maxlength="255">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger remove-feature"><i class="fa fa-minus"></i></button>
                </div>
            </div>`;
            $('#features-container').append(html);
        });

        // Remove feature
        $(document).on('click', '.remove-feature', function() {
            $(this).closest('.feature-item').remove();
        });

        // Image delete
        $(document).on('click', '.delete-image', function(e) {
            e.preventDefault();
            var btn = $(this);
            var id = btn.data('id');

            if (confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
                $.ajax({
                    url: '<?php echo base_url("admin/pusat/delete_image/") ?>' + id,
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            btn.closest('div').remove();
                            Swal.fire('Sukses', 'Gambar berhasil dihapus', 'success');
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Terjadi kesalahan saat menghapus gambar', 'error');
                    }
                });
            }
        });
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