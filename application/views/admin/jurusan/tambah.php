<button class="btn btn-primary" data-toggle="modal" data-target="#Tambah">
    <i class="fa fa-plus"></i> Tambah Jurusan
</button>

<div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">
                    <i class="fa fa-plus"></i> Tambah Data Jurusan
                </h4>
            </div>
            <div class="modal-body">

                <?php
                // Validasi error
                echo validation_errors('<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> ', '</div>');

                // Form buka 
                echo form_open_multipart(base_url('admin/jurusan'), array('id' => 'form-tambah-jurusan'));
                ?>

                <!-- Basic Information Tab -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="nama">Nama Jurusan <span class="text-danger">*</span></label>
                            <input type="text"
                                id="nama"
                                name="nama"
                                class="form-control"
                                placeholder="Masukkan nama jurusan"
                                value="<?php echo set_value('nama') ?>"
                                maxlength="100"
                                required>
                            <small class="form-text text-muted">Maksimal 100 karakter</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="slug_preview">Slug (Auto-generate)</label>
                            <input type="text"
                                id="slug_preview"
                                class="form-control"
                                readonly
                                placeholder="Slug akan dibuat otomatis">
                            <small class="form-text text-muted">Dibuat otomatis dari nama</small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tagline">Tagline</label>
                            <input type="text"
                                id="tagline"
                                name="tagline"
                                class="form-control"
                                placeholder="Contoh: Membangun Masa Depan"
                                value="<?php echo set_value('tagline') ?>"
                                maxlength="200">
                            <small class="form-text text-muted">Maksimal 200 karakter</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="color">Color Theme</label>
                            <select id="color" name="color" class="form-control">
                                <option value="primary" <?php echo set_select('color', 'primary', true); ?>>Primary (Biru)</option>
                                <option value="success" <?php echo set_select('color', 'success'); ?>>Success (Hijau)</option>
                                <option value="info" <?php echo set_select('color', 'info'); ?>>Info (Cyan)</option>
                                <option value="warning" <?php echo set_select('color', 'warning'); ?>>Warning (Kuning)</option>
                                <option value="danger" <?php echo set_select('color', 'danger'); ?>>Danger (Merah)</option>
                                <option value="secondary" <?php echo set_select('color', 'secondary'); ?>>Secondary (Abu-abu)</option>
                                <option value="dark" <?php echo set_select('color', 'dark'); ?>>Dark (Hitam)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <select id="icon" name="icon" class="form-control">
                                <option value="bi bi-mortarboard" <?php echo set_select('icon', 'bi bi-mortarboard', true); ?>>🎓 Mortarboard</option>
                                <option value="bi bi-book" <?php echo set_select('icon', 'bi bi-book'); ?>>📚 Book</option>
                                <option value="bi bi-laptop" <?php echo set_select('icon', 'bi bi-laptop'); ?>>💻 Laptop</option>
                                <option value="bi bi-gear" <?php echo set_select('icon', 'bi bi-gear'); ?>>⚙️ Gear</option>
                                <option value="bi bi-heart-pulse" <?php echo set_select('icon', 'bi bi-heart-pulse'); ?>>💓 Heart Pulse</option>
                                <option value="bi bi-calculator" <?php echo set_select('icon', 'bi bi-calculator'); ?>>🧮 Calculator</option>
                                <option value="bi bi-palette" <?php echo set_select('icon', 'bi bi-palette'); ?>>🎨 Palette</option>
                                <option value="bi bi-music-note" <?php echo set_select('icon', 'bi bi-music-note'); ?>>🎵 Music</option>
                                <option value="bi bi-camera" <?php echo set_select('icon', 'bi bi-camera'); ?>>📷 Camera</option>
                                <option value="bi bi-building" <?php echo set_select('icon', 'bi bi-building'); ?>>🏢 Building</option>
                                <option value="bi bi-globe" <?php echo set_select('icon', 'bi bi-globe'); ?>>🌍 Globe</option>
                                <option value="bi bi-cpu" <?php echo set_select('icon', 'bi bi-cpu'); ?>>🖥️ CPU</option>
                                <option value="bi bi-microscope" <?php echo set_select('icon', 'bi bi-microscope'); ?>>🔬 Microscope</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text"
                                id="status"
                                name="status"
                                class="form-control"
                                placeholder="Contoh: Jurusan Unggulan"
                                value="<?php echo set_value('status', 'Jurusan Unggulan') ?>"
                                maxlength="100">
                            <small class="form-text text-muted">Maksimal 100 karakter</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">Gambar Jurusan</label>
                            <input type="file"
                                id="image"
                                name="image"
                                class="form-control"
                                accept="image/*">
                            <small class="form-text text-muted">Format: JPG, PNG, WEBP. Maksimal 2MB</small>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi"
                        name="deskripsi"
                        class="form-control tinymce-editor"
                        placeholder="Masukkan deskripsi jurusan (opsional)"><?php echo set_value('deskripsi') ?></textarea>
                    <small class="form-text text-muted">
                        Gunakan editor untuk format teks yang lebih baik
                    </small>
                </div>

                <!-- Features Section -->
                <div class="form-group">
                    <label>Features Jurusan</label>
                    <div id="features-container">
                        <div class="feature-row mb-2">
                            <div class="row">
                                <div class="col-md-3">
                                    <select name="feature_icon[]" class="form-control feature-icon">
                                        <option value="">Pilih Icon</option>
                                        <option value="bi bi-award-fill">🏆 Award</option>
                                        <option value="bi bi-people-fill">👥 People</option>
                                        <option value="bi bi-building">🏢 Building</option>
                                        <option value="bi bi-graph-up">📈 Graph Up</option>
                                        <option value="bi bi-star-fill">⭐ Star</option>
                                        <option value="bi bi-shield-check">🛡️ Shield</option>
                                        <option value="bi bi-rocket">🚀 Rocket</option>
                                        <option value="bi bi-trophy">🏆 Trophy</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="feature_color[]" class="form-control feature-color">
                                        <option value="primary">Primary</option>
                                        <option value="success">Success</option>
                                        <option value="info">Info</option>
                                        <option value="warning">Warning</option>
                                        <option value="danger">Danger</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="feature_text[]" class="form-control" placeholder="Teks feature" maxlength="50">
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger btn-sm remove-feature">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success btn-sm" id="add-feature">
                        <i class="fa fa-plus"></i> Tambah Feature
                    </button>
                </div>

                <!-- Links Section -->
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
                            <small class="form-text text-muted">URL lengkap untuk download brosur</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="link_virtual_tour">Link Virtual Tour</label>
                            <input type="url"
                                id="link_virtual_tour"
                                name="link_virtual_tour"
                                class="form-control"
                                placeholder="https://example.com/virtual-tour"
                                value="<?php echo set_value('link_virtual_tour') ?>"
                                maxlength="255">
                            <small class="form-text text-muted">URL lengkap untuk virtual tour</small>
                        </div>
                    </div>
                </div>

                <!-- Preview Section -->
                <div class="form-group">
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle"></i>
                        <strong>Informasi:</strong>
                        <ul class="mb-0 mt-2">
                            <li>Semua field dengan tanda (*) wajib diisi</li>
                            <li>Color theme akan mempengaruhi tampilan badge dan button</li>
                            <li>Features akan ditampilkan sebagai highlight di halaman jurusan</li>
                            <li>Gambar akan diresize otomatis jika terlalu besar</li>
                            <li>Deskripsi mendukung formatting HTML</li>
                        </ul>
                    </div>
                </div>

                <?php
                // Form close 
                echo form_close();
                ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-times"></i> Batal
                </button>
                <button type="submit" form="form-tambah-jurusan" class="btn btn-success">
                    <i class="fa fa-save"></i> Simpan Data
                </button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk form handling -->
<script>
    // TinyMCE Configuration
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
            // Event listeners untuk TinyMCE
            editor.on('change', function() {
                editor.save(); // Simpan konten ke textarea
                checkDeskripsiLength();
            });

            editor.on('keyup', function() {
                editor.save();
                checkDeskripsiLength();
            });
        },
        init_instance_callback: function(editor) {
            // Set initial content
            var content = $('#deskripsi').val();
            if (content) {
                editor.setContent(content);
            }
        }
    };

    $(document).ready(function() {
        // Initialize TinyMCE when modal is shown
        $('#Tambah').on('shown.bs.modal', function() {
            // Destroy existing instances first
            if (tinymce.get('deskripsi')) {
                tinymce.get('deskripsi').destroy();
            }

            // Initialize TinyMCE
            tinymce.init(tinymceConfig);

            // Focus on nama field
            setTimeout(function() {
                $('#nama').focus();
            }, 500);
        });

        // Auto generate slug preview
        $('#nama').on('keyup', function() {
            var nama = $(this).val();
            if (nama.length > 0) {
                var slug = nama.toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim('-');
                $('#slug_preview').val(slug);
            } else {
                $('#slug_preview').val('');
            }
        });

        // Check deskripsi length
        function checkDeskripsiLength() {
            var content = tinymce.get('deskripsi') ? tinymce.get('deskripsi').getContent() : '';
            var textContent = $('<div>').html(content).text(); // Strip HTML
            var length = textContent.length;

            // Update character count (you can add this element if needed)
            if ($('#char-count').length) {
                $('#char-count').text(length);

                if (length > 900) {
                    $('#char-count').addClass('text-warning');
                } else {
                    $('#char-count').removeClass('text-warning');
                }

                if (length > 1000) {
                    $('#char-count').addClass('text-danger').removeClass('text-warning');
                } else {
                    $('#char-count').removeClass('text-danger');
                }
            }
        }

        // Add feature functionality
        $('#add-feature').on('click', function() {
            var featureRow = `
                <div class="feature-row mb-2">
                    <div class="row">
                        <div class="col-md-3">
                            <select name="feature_icon[]" class="form-control feature-icon">
                                <option value="">Pilih Icon</option>
                                <option value="bi bi-award-fill">🏆 Award</option>
                                <option value="bi bi-people-fill">👥 People</option>
                                <option value="bi bi-building">🏢 Building</option>
                                <option value="bi bi-graph-up">📈 Graph Up</option>
                                <option value="bi bi-star-fill">⭐ Star</option>
                                <option value="bi bi-shield-check">🛡️ Shield</option>
                                <option value="bi bi-rocket">🚀 Rocket</option>
                                <option value="bi bi-trophy">🏆 Trophy</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="feature_color[]" class="form-control feature-color">
                                <option value="primary">Primary</option>
                                <option value="success">Success</option>
                                <option value="info">Info</option>
                                <option value="warning">Warning</option>
                                <option value="danger">Danger</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="feature_text[]" class="form-control" placeholder="Teks feature" maxlength="50">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger btn-sm remove-feature">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            $('#features-container').append(featureRow);
        });

        // Remove feature functionality
        $(document).on('click', '.remove-feature', function() {
            if ($('.feature-row').length > 1) {
                $(this).closest('.feature-row').remove();
            } else {
                Swal.fire('Info', 'Minimal harus ada satu feature', 'info');
            }
        });

        // Image preview
        $('#image').on('change', function() {
            var file = this.files[0];
            if (file) {
                // Check file size (2MB = 2097152 bytes)
                if (file.size > 2097152) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Terlalu Besar',
                        text: 'Ukuran file maksimal 2MB',
                    });
                    $(this).val('');
                    return;
                }

                // Check file type
                var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
                if (allowedTypes.indexOf(file.type) === -1) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Format File Tidak Didukung',
                        text: 'Hanya mendukung format JPG, PNG, dan WEBP',
                    });
                    $(this).val('');
                    return;
                }

                var reader = new FileReader();
                reader.onload = function(e) {
                    // You can add image preview here if needed
                    console.log('Image loaded successfully');
                };
                reader.readAsDataURL(file);
            }
        });

        // Form validation
        $('#form-tambah-jurusan').on('submit', function(e) {
            // Ensure TinyMCE content is saved
            if (tinymce.get('deskripsi')) {
                tinymce.get('deskripsi').save();
            }

            var nama = $('#nama').val().trim();
            var isValid = true;

            // Clear previous errors
            $('.form-group').removeClass('has-error');
            $('.error-message').remove();

            // Validate nama
            if (nama === '') {
                $('#nama').closest('.form-group').addClass('has-error');
                $('#nama').after('<span class="error-message text-danger">Nama jurusan harus diisi</span>');
                isValid = false;
            } else if (nama.length > 100) {
                $('#nama').closest('.form-group').addClass('has-error');
                $('#nama').after('<span class="error-message text-danger">Nama jurusan maksimal 100 karakter</span>');
                isValid = false;
            }

            // Validate deskripsi length (text content without HTML)
            var deskripsiContent = tinymce.get('deskripsi') ? tinymce.get('deskripsi').getContent() : '';
            var deskripsiText = $('<div>').html(deskripsiContent).text();
            if (deskripsiText.length > 1000) {
                $('#deskripsi').closest('.form-group').addClass('has-error');
                $('#deskripsi').after('<span class="error-message text-danger">Deskripsi maksimal 1000 karakter (tanpa HTML)</span>');
                isValid = false;
            }

            // Validate tagline length
            var tagline = $('#tagline').val();
            if (tagline.length > 200) {
                $('#tagline').closest('.form-group').addClass('has-error');
                $('#tagline').after('<span class="error-message text-danger">Tagline maksimal 200 karakter</span>');
                isValid = false;
            }

            // Validate status length
            var status = $('#status').val();
            if (status.length > 100) {
                $('#status').closest('.form-group').addClass('has-error');
                $('#status').after('<span class="error-message text-danger">Status maksimal 100 karakter</span>');
                isValid = false;
            }

            // Validate URLs
            var linkBrosur = $('#link_brosur').val();
            var linkVirtualTour = $('#link_virtual_tour').val();

            if (linkBrosur && !isValidURL(linkBrosur)) {
                $('#link_brosur').closest('.form-group').addClass('has-error');
                $('#link_brosur').after('<span class="error-message text-danger">Format URL tidak valid</span>');
                isValid = false;
            }

            if (linkVirtualTour && !isValidURL(linkVirtualTour)) {
                $('#link_virtual_tour').closest('.form-group').addClass('has-error');
                $('#link_virtual_tour').after('<span class="error-message text-danger">Format URL tidak valid</span>');
                isValid = false;
            }

            // Validate features
            var featureTexts = $('input[name="feature_text[]"]');
            featureTexts.each(function() {
                var text = $(this).val().trim();
                var icon = $(this).closest('.feature-row').find('select[name="feature_icon[]"]').val();

                if (text !== '' && icon === '') {
                    $(this).closest('.feature-row').addClass('has-error');
                    if ($(this).siblings('.error-message').length === 0) {
                        $(this).after('<span class="error-message text-danger">Pilih icon untuk feature ini</span>');
                    }
                    isValid = false;
                }
            });

            if (!isValid) {
                e.preventDefault();
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

        // URL validation function
        function isValidURL(string) {
            try {
                new URL(string);
                return true;
            } catch (_) {
                return false;
            }
        }

        // Reset form when modal is closed
        $('#Tambah').on('hidden.bs.modal', function() {
            // Destroy TinyMCE instance
            if (tinymce.get('deskripsi')) {
                tinymce.get('deskripsi').destroy();
            }

            // Reset form
            $('#form-tambah-jurusan')[0].reset();
            $('#slug_preview').val('');
            $('.form-group').removeClass('has-error');
            $('.error-message').remove();

            // Reset features to default
            $('#features-container').html(`
                <div class="feature-row mb-2">
                    <div class="row">
                        <div class="col-md-3">
                            <select name="feature_icon[]" class="form-control feature-icon">
                                <option value="">Pilih Icon</option>
                                <option value="bi bi-award-fill">🏆 Award</option>
                                <option value="bi bi-people-fill">👥 People</option>
                                <option value="bi bi-building">🏢 Building</option>
                                <option value="bi bi-graph-up">📈 Graph Up</option>
                                <option value="bi bi-star-fill">⭐ Star</option>
                                <option value="bi bi-shield-check">🛡️ Shield</option>
                                <option value="bi bi-rocket">🚀 Rocket</option>
                                <option value="bi bi-trophy">🏆 Trophy</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="feature_color[]" class="form-control feature-color">
                                <option value="primary">Primary</option>
                                <option value="success">Success</option>
                                <option value="info">Info</option>
                                <option value="warning">Warning</option>
                                <option value="danger">Danger</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="feature_text[]" class="form-control" placeholder="Teks feature" maxlength="50">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger btn-sm remove-feature">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `);
        });
    });
</script>

<!-- Custom CSS untuk form -->
<style>
    .modal-xl {
        max-width: 1200px;
    }

    .form-group label {
        font-weight: 600;
        color: #333;
    }

    .form-control:focus {
        border-color: #3c8dbc;
        box-shadow: 0 0 0 0.2rem rgba(60, 141, 188, 0.25);
    }

    .has-error .form-control {
        border-color: #dd4b39;
    }

    .has-error .feature-row {
        border-color: #dd4b39;
        background-color: #fdf2f2;
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

    .alert-info {
        border-left: 4px solid #3c8dbc;
    }

    .modal-footer {
        border-top: 1px solid #e5e5e5;
        padding: 15px 20px;
    }

    .feature-row {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background: #f9f9f9;
        transition: all 0.3s ease;
    }

    .feature-row:hover {
        background: #f5f5f5;
        border-color: #3c8dbc;
    }

    /* TinyMCE Modal Fix */
    .tox .tox-dialog-wrap__backdrop {
        z-index: 1060 !important;
    }

    .tox .tox-dialog {
        z-index: 1061 !important;
    }

    /* TinyMCE Toolbar styling */
    .tox:not([dir=rtl]) .tox-toolbar__primary {
        background: #f8f9fa !important;
        border-bottom: 1px solid #ddd !important;
    }

    .tox .tox-editor-header {
        border-radius: 4px 4px 0 0 !important;
    }

    .tox .tox-editor-container {
        border-radius: 0 0 4px 4px !important;
    }

    /* Character count for TinyMCE */
    .tinymce-char-count {
        text-align: right;
        font-size: 12px;
        color: #666;
        margin-top: 5px;
    }
</style>