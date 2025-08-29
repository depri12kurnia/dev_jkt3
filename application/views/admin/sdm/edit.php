<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">
            <i class="fa fa-edit"></i> Edit Data SDM
        </h3>
        <div class="box-tools pull-right">
            <a href="<?php echo base_url('admin/sdm') ?>" class="btn btn-default btn-sm">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="box-body">
        <?php
        // Validasi error
        echo validation_errors('<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> ', '</div>');

        // Error upload
        if (isset($error)) {
            echo '<div class="alert alert-danger"><i class="fa fa-ban"></i> ' . $error . '</div>';
        }

        // Form buka 
        echo form_open_multipart(base_url('admin/sdm/edit/' . $sdm->id), array('id' => 'form-edit-sdm', 'class' => 'form-horizontal'));
        ?>

        <div class="row">
            <!-- Kolom Kiri - Data Pribadi -->
            <div class="col-md-8">
                <div class="form-group">
                    <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text"
                        id="nama"
                        name="nama"
                        class="form-control"
                        placeholder="Masukkan nama lengkap"
                        value="<?php echo set_value('nama', $sdm->nama) ?>"
                        maxlength="100"
                        required>
                    <small class="form-text text-muted">Maksimal 100 karakter</small>
                </div>

                <div class="form-group">
                    <label for="nip">NIP (Nomor Induk Pegawai)</label>
                    <input type="text"
                        id="nip"
                        name="nip"
                        class="form-control"
                        placeholder="Masukkan NIP (opsional)"
                        value="<?php echo set_value('nip', $sdm->nip) ?>"
                        maxlength="50">
                    <small class="form-text text-muted">Contoh: 196801011990031001</small>
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="L" <?php echo set_select('jenis_kelamin', 'L', ($sdm->jenis_kelamin == 'L')) ?>>Laki-laki</option>
                        <option value="P" <?php echo set_select('jenis_kelamin', 'P', ($sdm->jenis_kelamin == 'P')) ?>>Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        placeholder="Masukkan alamat email"
                        value="<?php echo set_value('email', $sdm->email) ?>"
                        maxlength="100">
                    <small class="form-text text-muted">Contoh: nama@domain.com</small>
                </div>

                <div class="form-group">
                    <label for="no_hp">Nomor HP/WhatsApp</label>
                    <input type="text"
                        id="no_hp"
                        name="no_hp"
                        class="form-control"
                        placeholder="Masukkan nomor HP"
                        value="<?php echo set_value('no_hp', $sdm->no_hp) ?>"
                        maxlength="20">
                    <small class="form-text text-muted">Contoh: 08123456789 atau +6281234567890</small>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi/Bio Singkat</label>
                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        class="form-control tinymce-editor"
                        rows="8"
                        placeholder="Masukkan deskripsi atau bio singkat..."><?php echo set_value('deskripsi', $sdm->deskripsi) ?></textarea>
                    <small class="form-text text-muted">Maksimal 1000 karakter. Gunakan editor untuk formatting text.</small>
                </div>

            </div>
            <!-- End col-md-8 -->

            <!-- Kolom Kanan - Upload Foto -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="foto">Foto Profil</label>
                    <div class="photo-upload-container">
                        <div id="photo-preview" class="photo-preview">
                            <?php if (!empty($sdm->foto_url)) { ?>
                                <img src="<?php echo base_url('assets/upload/sdm/' . $sdm->foto_url) ?>"
                                    alt="Foto <?php echo $sdm->nama ?>"
                                    class="img-responsive"
                                    style="max-width: 100%; max-height: 200px; object-fit: cover;">
                            <?php } else { ?>
                                <i class="fa fa-user-plus fa-4x text-muted"></i>
                                <p class="text-muted">Klik untuk upload foto</p>
                            <?php } ?>
                        </div>
                        <input type="file"
                            id="foto"
                            name="foto"
                            class="form-control-file"
                            accept="image/jpeg,image/jpg,image/png,image/gif"
                            style="display: none;">
                    </div>
                    <small class="form-text text-muted">
                        Format: JPG, PNG, GIF<br>
                        Ukuran maksimal: 2MB<br>
                        Resolusi maksimal: 2000x2000px<br>
                        <?php if (!empty($sdm->foto_url)) { ?>
                            <span class="text-success">Foto saat ini: <?php echo $sdm->foto_url ?></span>
                        <?php } ?>
                    </small>
                </div>

                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i>
                    <strong>Informasi:</strong>
                    <ul class="mb-0 mt-2">
                        <li>Field bertanda <span class="text-danger">*</span> wajib diisi</li>
                        <li>NIP, Email, dan No HP bersifat opsional</li>
                        <li>Upload foto baru akan mengganti foto lama</li>
                        <li>Kosongkan foto jika tidak ingin mengubah</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="box-footer">
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Update Data
                    </button>
                    <a href="<?php echo base_url('admin/sdm') ?>" class="btn btn-default">
                        <i class="fa fa-times"></i> Batal
                    </a>
                    <a href="<?php echo base_url('admin/sdm/detail/' . $sdm->id) ?>" class="btn btn-info">
                        <i class="fa fa-eye"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        <?php
        // Form close 
        echo form_close();
        ?>
    </div>
</div>

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
                'bold italic underline strikethrough | forecolor backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link image | ' +
                'removeformat | help',
            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; }',
            branding: false,
            resize: false,
            statusbar: true,
            elementpath: false,
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                    formChanged = true; // Set form changed flag
                });
            },
            init_instance_callback: function(editor) {
                editor.on('KeyUp', function(e) {
                    var content = editor.getContent({
                        format: 'text'
                    });
                    var maxLength = 1000;

                    if (content.length > maxLength) {
                        var truncated = content.substring(0, maxLength);
                        editor.setContent(truncated);

                        Swal.fire({
                            icon: 'warning',
                            title: 'Batas Karakter Tercapai',
                            text: 'Deskripsi maksimal ' + maxLength + ' karakter',
                            timer: 2000
                        });
                    }
                });
            }
        });

        // Photo upload handling
        $('#photo-preview').on('click', function() {
            $('#foto').click();
        });

        $('#foto').on('change', function() {
            var file = this.files[0];

            if (file) {
                // Validate file type
                var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(file.type)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Format File Tidak Valid',
                        text: 'Hanya file JPG, PNG, dan GIF yang diperbolehkan'
                    });
                    $(this).val('');
                    return;
                }

                // Validate file size (2MB)
                if (file.size > 2048 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ukuran File Terlalu Besar',
                        text: 'Ukuran file maksimal 2MB'
                    });
                    $(this).val('');
                    return;
                }

                // Preview image
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#photo-preview').html(
                        '<img src="' + e.target.result + '" class="img-responsive" style="max-width: 100%; max-height: 200px; object-fit: cover;">'
                    );
                };
                reader.readAsDataURL(file);
                formChanged = true; // Set form changed flag
            } else {
                // Reset to original photo or default
                <?php if (!empty($sdm->foto_url)) { ?>
                    $('#photo-preview').html(
                        '<img src="<?php echo base_url('assets/upload/sdm/' . $sdm->foto_url) ?>" alt="Foto <?php echo $sdm->nama ?>" class="img-responsive" style="max-width: 100%; max-height: 200px; object-fit: cover;">'
                    );
                <?php } else { ?>
                    $('#photo-preview').html(
                        '<i class="fa fa-user-plus fa-4x text-muted"></i>' +
                        '<p class="text-muted">Klik untuk upload foto</p>'
                    );
                <?php } ?>
            }
        });

        // NIP validation (hanya angka)
        $('#nip').on('keypress', function(e) {
            var charCode = (e.which) ? e.which : e.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                e.preventDefault();
                return false;
            }
        });

        // No HP validation (angka, +, -, spasi)
        $('#no_hp').on('keypress', function(e) {
            var charCode = (e.which) ? e.which : e.keyCode;
            var char = String.fromCharCode(charCode);
            var regex = /[0-9\+\-\s]/;

            if (!regex.test(char) && charCode > 31) {
                e.preventDefault();
                return false;
            }
        });

        // Form validation
        $('#form-edit-sdm').on('submit', function(e) {
            // Update TinyMCE content
            tinymce.triggerSave();

            var nama = $('#nama').val().trim();
            var jenis_kelamin = $('#jenis_kelamin').val();
            var email = $('#email').val().trim();
            var deskripsi = $('#deskripsi').val().trim();
            var isValid = true;

            // Clear previous errors
            $('.form-group').removeClass('has-error');
            $('.error-message').remove();

            // Validate nama
            if (nama === '') {
                $('#nama').closest('.form-group').addClass('has-error');
                $('#nama').after('<span class="error-message text-danger">Nama harus diisi</span>');
                isValid = false;
            } else if (nama.length > 100) {
                $('#nama').closest('.form-group').addClass('has-error');
                $('#nama').after('<span class="error-message text-danger">Nama maksimal 100 karakter</span>');
                isValid = false;
            }

            // Validate jenis kelamin
            if (jenis_kelamin === '') {
                $('#jenis_kelamin').closest('.form-group').addClass('has-error');
                $('#jenis_kelamin').after('<span class="error-message text-danger">Jenis kelamin harus dipilih</span>');
                isValid = false;
            }

            // Validate email if filled
            if (email !== '') {
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    $('#email').closest('.form-group').addClass('has-error');
                    $('#email').after('<span class="error-message text-danger">Format email tidak valid</span>');
                    isValid = false;
                }
            }

            // Validate deskripsi length
            if (deskripsi.length > 1000) {
                $('#deskripsi').closest('.form-group').addClass('has-error');
                $('#deskripsi').after('<span class="error-message text-danger">Deskripsi maksimal 1000 karakter</span>');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();

                // Show error alert
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Error',
                    text: 'Mohon periksa kembali data yang Anda masukkan',
                    timer: 3000
                });

                // Scroll to first error
                $('html, body').animate({
                    scrollTop: $('.has-error:first').offset().top - 100
                }, 500);

                return false;
            }

            // Show loading
            Swal.fire({
                title: 'Mengupdate Data',
                text: 'Mohon tunggu...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        });

        // Auto-format phone number
        $('#no_hp').on('blur', function() {
            var phone = $(this).val().replace(/\s+/g, '');
            if (phone.startsWith('08')) {
                $(this).val(phone.replace(/(\d{4})(\d{4})(\d{4})/, '$1-$2-$3'));
            }
        });

        // Focus on nama field when page loads
        $('#nama').focus();

        // Konfirmasi jika ada perubahan data saat akan meninggalkan halaman
        var formChanged = false;

        $('input, select').on('change', function() {
            formChanged = true;
        });

        // TinyMCE change detection sudah ditambahkan di init callback

        $(window).on('beforeunload', function(e) {
            if (formChanged) {
                return 'Anda memiliki perubahan yang belum disimpan. Yakin ingin meninggalkan halaman?';
            }
        });

        $('#form-edit-sdm').on('submit', function() {
            formChanged = false;
        });
    });
</script>

<!-- Custom CSS untuk form -->
<style>
    .box-header {
        border-bottom: 1px solid #ddd;
        padding: 15px 20px;
    }

    .box-title {
        font-size: 18px;
        font-weight: 600;
        color: #333;
    }

    .form-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .form-control:focus {
        border-color: #3c8dbc;
        box-shadow: 0 0 0 0.2rem rgba(60, 141, 188, 0.25);
    }

    .has-error .form-control {
        border-color: #dd4b39;
    }

    .error-message {
        display: block;
        margin-top: 5px;
        font-size: 12px;
    }

    .alert-info {
        border-left: 4px solid #3c8dbc;
        background-color: #f4f9fd;
    }

    /* Photo Upload Styling */
    .photo-upload-container {
        margin-bottom: 15px;
    }

    .photo-preview {
        width: 100%;
        height: 200px;
        border: 2px dashed #ccc;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background-color: #f9f9f9;
        overflow: hidden;
    }

    .photo-preview:hover {
        border-color: #3c8dbc;
        background-color: #f0f8ff;
    }

    .photo-preview img {
        border-radius: 8px;
        max-height: 180px;
        object-fit: cover;
        width: 100%;
    }

    .box-footer {
        border-top: 1px solid #ddd;
        padding: 15px 20px;
        background-color: #f9f9f9;
    }

    .btn {
        margin-right: 10px;
    }

    .btn:last-child {
        margin-right: 0;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {

        .col-md-8,
        .col-md-4 {
            margin-bottom: 20px;
        }

        .photo-preview {
            height: 150px;
        }
    }

    /* Loading overlay */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        z-index: 9999;
    }

    .loading-spinner {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 24px;
    }

    /* TinyMCE Styling */
    .tox-tinymce {
        border-radius: 4px;
        border: 1px solid #ddd !important;
    }

    .tox-tinymce:focus-within {
        border-color: #3c8dbc !important;
        box-shadow: 0 0 0 0.2rem rgba(60, 141, 188, 0.25) !important;
    }

    .tox-toolbar-overlord {
        background: #f8f9fa !important;
    }

    .tox-editor-header {
        border-bottom: 1px solid #e9ecef !important;
    }

    .has-error .tox-tinymce {
        border-color: #dd4b39 !important;
    }

    /* Character counter for TinyMCE */
    .char-counter {
        font-size: 12px;
        color: #666;
        text-align: right;
        margin-top: 5px;
    }

    .char-counter.over-limit {
        color: #dd4b39;
        font-weight: bold;
    }

    /* Responsive TinyMCE */
    @media (max-width: 768px) {
        .tox-tinymce {
            width: 100% !important;
        }

        .tox-toolbar__group {
            flex-wrap: wrap;
        }
    }

    /* Enhanced form styling */
    .form-group textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    .tinymce-editor {
        border-radius: 4px;
    }
</style>