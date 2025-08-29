<button class="btn btn-primary" data-toggle="modal" data-target="#TambahUnit">
    <i class="fa fa-plus"></i> Tambah Unit
</button>

<div class="modal fade" id="TambahUnit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">
                    <i class="fa fa-plus"></i> Tambah Data Unit
                </h4>
            </div>
            <div class="modal-body">

                <?php
                // Validasi error
                echo validation_errors('<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> ', '</div>');

                // Form buka - sesuai controller unit
                echo form_open_multipart(base_url('admin/unit'), array('id' => 'form-tambah-unit'));
                ?>

                <div class="form-group">
                    <label for="nama">Nama Unit <span class="text-danger">*</span></label>
                    <input type="text"
                        id="nama"
                        name="nama"
                        class="form-control"
                        placeholder="Masukkan nama unit"
                        value="<?php echo set_value('nama') ?>"
                        maxlength="100"
                        required>
                    <small class="form-text text-muted">Maksimal 100 karakter. Slug akan dibuat otomatis jika kosong.</small>
                </div>

                <div class="form-group">
                    <label for="slug">Slug (opsional)</label>
                    <input type="text"
                        id="slug"
                        name="slug"
                        class="form-control"
                        placeholder="Slug otomatis jika dikosongkan"
                        value="<?php echo set_value('slug') ?>"
                        maxlength="100">
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi"
                        name="deskripsi"
                        class="form-control tinymce-editor"
                        rows="6"
                        placeholder="Masukkan deskripsi unit"><?php echo set_value('deskripsi') ?></textarea>
                </div>

                <div class="form-group">
                    <label for="tagline">Tagline</label>
                    <input type="text"
                        id="tagline"
                        name="tagline"
                        class="form-control"
                        placeholder="Tagline unit (opsional)"
                        value="<?php echo set_value('tagline') ?>"
                        maxlength="200">
                </div>

                <div class="form-group">
                    <label for="features">Keunggulan / Fitur Unit <small>(opsional, satu per baris)</small></label>
                    <textarea id="features"
                        name="features"
                        class="form-control"
                        rows="4"
                        placeholder="Contoh:&#10;- Fasilitas lengkap&#10;- Tenaga pengajar profesional"><?php echo set_value('features') ?></textarea>
                    <small class="form-text text-muted">Pisahkan tiap fitur/keunggulan dengan baris baru. Akan disimpan dalam format JSON.</small>
                </div>

                <div class="form-group">
                    <label for="image">Gambar/Logo Unit <small>(opsional, jpg/png/webp, max 2MB)</small></label>
                    <input type="file" id="image" name="image" class="form-control">
                </div>

                <?php echo form_close(); ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-times"></i> Batal
                </button>
                <button type="submit" form="form-tambah-unit" class="btn btn-success">
                    <i class="fa fa-save"></i> Simpan Data
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Optional: TinyMCE init
    $(document).ready(function() {
        if (typeof tinymce !== 'undefined') {
            tinymce.init({
                selector: '.tinymce-editor',
                height: 200,
                menubar: false
            });
        }
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