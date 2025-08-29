<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">
            <i class="fa fa-plus"></i> Tambah Data Jabatan SDM
        </h3>
        <div class="box-tools pull-right">
            <a href="<?php echo base_url('admin/jabatan_sdm') ?>" class="btn btn-default btn-sm">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="box-body">
        <?php
        // Validasi error
        echo validation_errors('<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> ', '</div>');

        // Error dari model
        if ($this->session->flashdata('error')) {
            echo '<div class="alert alert-danger"><i class="fa fa-ban"></i> ' . $this->session->flashdata('error') . '</div>';
        }

        // Form buka 
        echo form_open(base_url('admin/jabatan_sdm/tambah'), array('id' => 'form-tambah-jabatan-sdm', 'class' => 'form-horizontal'));
        ?>

        <div class="row">
            <!-- Kolom Kiri - Data Utama -->
            <div class="col-md-8">
                <div class="form-group">
                    <label for="sdm_id">Pilih SDM <span class="text-danger">*</span></label>
                    <select id="sdm_id"
                        name="sdm_id"
                        class="form-control"
                        required
                        autocomplete="off"
                        data-placeholder="-- Pilih SDM --">
                        <option value="">-- Pilih SDM --</option>
                        <?php if (isset($sdm_list) && !empty($sdm_list)) { ?>
                            <?php foreach ($sdm_list as $sdm) { ?>
                                <option value="<?php echo $sdm->id ?>" <?php echo set_select('sdm_id', $sdm->id) ?>>
                                    <?php echo $sdm->nama ?>
                                    <?php if (!empty($sdm->nip)) { ?>
                                        (NIP: <?php echo $sdm->nip ?>)
                                    <?php } ?>
                                </option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                    <small class="form-text text-muted">Pilih SDM yang akan diberi jabatan</small>
                </div>

                <div class="form-group">
                    <label for="level">Level Jabatan <span class="text-danger">*</span></label>
                    <select id="level" name="level" class="form-control" required autocomplete="off">
                        <option value="">-- Pilih Level Jabatan --</option>
                        <option value="institusi" <?php echo set_select('level', 'institusi') ?>>Institusi</option>
                        <option value="jurusan" <?php echo set_select('level', 'jurusan') ?>>Jurusan</option>
                        <option value="prodi" <?php echo set_select('level', 'prodi') ?>>Program Studi</option>
                        <option value="unit" <?php echo set_select('level', 'unit') ?>>Unit</option>
                        <option value="pusat" <?php echo set_select('level', 'pusat') ?>>Pusat</option>
                    </select>
                    <small class="form-text text-muted">Tentukan tingkatan jabatan</small>
                </div>

                <!-- Unit Kerja Section -->
                <div id="unit_kerja_section">
                    <div class="form-group" id="jurusan_group" style="display: none;">
                        <label for="jurusan_id">Jurusan <span class="text-danger">*</span></label>
                        <select id="jurusan_id" name="jurusan_id" class="form-control" autocomplete="off">
                            <option value="">-- Pilih Jurusan --</option>
                            <?php if (isset($jurusan_list) && !empty($jurusan_list)) { ?>
                                <?php foreach ($jurusan_list as $jurusan) { ?>
                                    <option value="<?php echo $jurusan->id ?>" <?php echo set_select('jurusan_id', $jurusan->id) ?>>
                                        <?php echo $jurusan->nama ?>
                                    </option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <small class="form-text text-muted">Wajib diisi untuk level jurusan</small>
                    </div>

                    <div class="form-group" id="prodi_group" style="display: none;">
                        <label for="prodi_id">Program Studi <span class="text-danger">*</span></label>
                        <select id="prodi_id" name="prodi_id" class="form-control" autocomplete="off">
                            <option value="">-- Pilih Program Studi --</option>
                            <?php if (isset($prodi_list) && !empty($prodi_list)) { ?>
                                <?php foreach ($prodi_list as $prodi) { ?>
                                    <option value="<?php echo $prodi->id ?>"
                                        data-jurusan="<?php echo isset($prodi->jurusan_id) ? $prodi->jurusan_id : '' ?>"
                                        <?php echo set_select('prodi_id', $prodi->id) ?>>
                                        <?php echo $prodi->nama ?>
                                        <?php if (isset($prodi->nama_jurusan)) { ?>
                                            (<?php echo $prodi->nama_jurusan ?>)
                                        <?php } ?>
                                    </option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <small class="form-text text-muted">Wajib diisi untuk level program studi</small>
                    </div>

                    <div class="form-group" id="unit_group" style="display: none;">
                        <label for="unit_id">Unit <span class="text-danger">*</span></label>
                        <select id="unit_id" name="unit_id" class="form-control" autocomplete="off">
                            <option value="">-- Pilih Unit --</option>
                            <?php if (isset($unit_list) && !empty($unit_list)) { ?>
                                <?php foreach ($unit_list as $unit) { ?>
                                    <option value="<?php echo $unit->id ?>" <?php echo set_select('unit_id', $unit->id) ?>>
                                        <?php echo $unit->nama ?>
                                    </option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <small class="form-text text-muted">Wajib diisi untuk level unit</small>
                    </div>

                    <div class="form-group" id="pusat_group" style="display: none;">
                        <label for="pusat_id">Pusat <span class="text-danger">*</span></label>
                        <select id="pusat_id" name="pusat_id" class="form-control" autocomplete="off">
                            <option value="">-- Pilih Pusat --</option>
                            <?php if (isset($pusat_list) && !empty($pusat_list)) { ?>
                                <?php foreach ($pusat_list as $pusat) { ?>
                                    <option value="<?php echo $pusat->id ?>" <?php echo set_select('pusat_id', $pusat->id) ?>>
                                        <?php echo $pusat->nama ?>
                                    </option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <small class="form-text text-muted">Wajib diisi untuk level pusat</small>
                    </div>
                </div>

                <div class="form-group">
                    <label for="jabatan">Nama Jabatan <span class="text-danger">*</span></label>
                    <input type="text"
                        id="jabatan"
                        name="jabatan"
                        class="form-control"
                        placeholder="Contoh: Direktur, Wakil Direktur, Ketua Jurusan, Koordinator Prodi"
                        value="<?php echo set_value('jabatan') ?>"
                        maxlength="100"
                        autocomplete="off"
                        required>
                    <small class="form-text text-muted">Maksimal 100 karakter</small>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="periode_mulai">Periode Mulai <span class="text-danger">*</span></label>
                            <input type="number"
                                id="periode_mulai"
                                name="periode_mulai"
                                class="form-control"
                                placeholder="<?php echo date('Y') ?>"
                                value="<?php echo set_value('periode_mulai', date('Y')) ?>"
                                min="2000"
                                max="2100"
                                autocomplete="off"
                                required>
                            <small class="form-text text-muted">Tahun mulai jabatan</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="periode_akhir">Periode Akhir <span class="text-danger">*</span></label>
                            <input type="number"
                                id="periode_akhir"
                                name="periode_akhir"
                                class="form-control"
                                placeholder="<?php echo date('Y') + 4 ?>"
                                value="<?php echo set_value('periode_akhir', date('Y') + 4) ?>"
                                min="2000"
                                max="2100"
                                autocomplete="off"
                                required>
                            <small class="form-text text-muted">Tahun akhir jabatan</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan - Informasi & Preview -->
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <i class="fa fa-info-circle"></i> Informasi
                        </h4>
                    </div>
                    <div class="panel-body">
                        <ul class="list-unstyled">
                            <li><i class="fa fa-check text-success"></i> Field bertanda <span class="text-danger">*</span> wajib diisi</li>
                            <li><i class="fa fa-check text-success"></i> Periode akhir harus lebih besar dari periode mulai</li>
                            <li><i class="fa fa-check text-success"></i> Satu SDM dapat memiliki multiple jabatan</li>
                            <li><i class="fa fa-check text-success"></i> Sistem akan validasi overlap periode untuk jabatan yang sama</li>
                        </ul>
                    </div>
                </div>

                <!-- Preview SDM -->
                <div id="sdm_preview" class="panel panel-default" style="display: none;">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <i class="fa fa-user"></i> Preview SDM
                        </h4>
                    </div>
                    <div class="panel-body" id="sdm_preview_content">
                        <!-- Content will be loaded via JavaScript -->
                    </div>
                </div>

                <!-- Jabatan Suggestion -->
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <i class="fa fa-lightbulb-o"></i> Contoh Jabatan
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div id="jabatan_suggestions">
                            <p class="text-muted">Pilih level untuk melihat contoh jabatan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box-footer">
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Simpan Data
                    </button>
                    <a href="<?php echo base_url('admin/jabatan_sdm') ?>" class="btn btn-default">
                        <i class="fa fa-times"></i> Batal
                    </a>
                    <button type="button" class="btn btn-info" id="btn_preview">
                        <i class="fa fa-eye"></i> Preview
                    </button>
                </div>
            </div>
        </div>

        <?php
        // Form close 
        echo form_close();
        ?>
    </div>
</div>

<!-- JavaScript untuk form handling -->
<script>
    $(document).ready(function() {
        console.log('Initializing Jabatan SDM form...');

        // Global variable to track Select2 initialization status
        let isSelect2Initialized = false;

        // Enhanced Select2 initialization with consistent spacing
        function initializeSelect2() {
            console.log('Attempting to initialize Select2...');

            // Check if Select2 is available
            if (typeof $.fn.select2 === 'undefined') {
                console.log('Select2 not available, loading from CDN...');
                loadSelect2FromCDN();
                return;
            }

            try {
                // Destroy existing Select2 if any
                if ($('#sdm_id').hasClass('select2-hidden-accessible')) {
                    $('#sdm_id').select2('destroy');
                }

                // Wait a bit before initializing
                setTimeout(() => {
                    try {
                        $('#sdm_id').select2({
                            placeholder: "-- Pilih SDM --",
                            allowClear: true,
                            width: '100%',
                            dropdownAutoWidth: false,
                            dropdownCssClass: 'select2-dropdown-custom',
                            containerCssClass: 'select2-container-custom',
                            theme: 'default',
                            language: {
                                noResults: function() {
                                    return "Tidak ada data SDM ditemukan";
                                },
                                searching: function() {
                                    return "Mencari...";
                                }
                            },
                            escapeMarkup: function(markup) {
                                return markup;
                            },
                            templateResult: function(data) {
                                if (data.loading) {
                                    return 'Mencari...';
                                }
                                // Format text with consistent styling
                                let text = data.text;
                                if (text.length > 100) {
                                    text = text.substring(0, 100) + '...';
                                }
                                return $('<div class="select2-option-content" title="' + data.text + '">' + text + '</div>');
                            },
                            templateSelection: function(data) {
                                // Limit text length in selection
                                if (data.text.length > 100) {
                                    return data.text.substring(0, 100) + '...';
                                }
                                return data.text;
                            }
                        });

                        // Fix Select2 search input attributes
                        $('#sdm_id').on('select2:open', function() {
                            setTimeout(function() {
                                const $searchInput = $('.select2-search__field');
                                if ($searchInput.length) {
                                    $searchInput.attr({
                                        'id': 'select2-sdm-search',
                                        'name': 'select2-sdm-search',
                                        'autocomplete': 'off',
                                        'aria-label': 'Cari SDM'
                                    });
                                }
                            }, 50);
                        });

                        isSelect2Initialized = true;
                        console.log('Select2 initialized successfully');

                    } catch (error) {
                        console.error('Error initializing Select2:', error);
                        fallbackToRegularSelect();
                    }
                }, 100);

            } catch (error) {
                console.error('Error in Select2 setup:', error);
                fallbackToRegularSelect();
            }
        }

        // Load Select2 from CDN
        function loadSelect2FromCDN() {
            // Load CSS first
            if (!$('link[href*="select2"]').length) {
                $('<link>')
                    .appendTo('head')
                    .attr({
                        type: 'text/css',
                        rel: 'stylesheet',
                        href: 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
                    });
            }

            // Load JS
            $.getScript('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js')
                .done(function() {
                    console.log('Select2 loaded successfully from CDN');
                    setTimeout(initializeSelect2, 200);
                })
                .fail(function() {
                    console.error('Failed to load Select2 from CDN');
                    fallbackToRegularSelect();
                });
        }

        // Fallback to regular select
        function fallbackToRegularSelect() {
            console.log('Using regular select as fallback');
            $('#sdm_id').removeClass('select2 select2-hidden-accessible').addClass('form-control');
            $('.select2-container').remove();
            isSelect2Initialized = false;
        }

        // Jabatan suggestions berdasarkan level
        const jabatanSuggestions = {
            'institusi': [
                'Direktur',
                'Wakil Direktur I',
                'Wakil Direktur II',
                'Wakil Direktur III',
                'Kepala Bagian Administrasi Akademik dan Umum',
                'Kepala Sub Bagian Administrasi Akademik dan Kemahasiswaan',
            ],
            'jurusan': [
                'Ketua Jurusan',
                'Sekretaris Jurusan',
                'Koordinator Akademik',
                'Koordinator Kemahasiswaan'
            ],
            'prodi': [
                'Ketua Program Studi',
                'Sekretaris Program Studi'
            ],
            'unit': [
                'Kepala Unit Laboratorium Terpadu',
                'Kepala Unit Pengembangan Bahasa',
                'Kepala Unit Pengembangan Kompetensi',
                'Kepala Unit Perpustakaan Terpadu',
                'Kepala Unit Teknologi Informasi',
                'Kepala Unit Pengelola Usaha',
                'Staf Unit Laboratorium Terpadu',
                'Staf Unit Pengembangan Bahasa',
                'Staf Unit Pengembangan Kompetensi',
                'Staf Unit Perpustakaan Terpadu',
                'Staf Unit Teknologi Informasi',
                'Staf Unit Pengelola Usaha'
            ],
            'pusat': [
                'Kepala Pusat Penjaminan Mutu',
                'Kepala Pusat Penelitian dan Pengabdian Masyarakat',
                'Kepala Pusat Pengembangan Pendidikan',
                'Staf Pusat Penjaminan Mutu',
                'Staf Pusat Penelitian dan Pengabdian Masyarakat',
                'Staf Pusat Pengembangan Pendidikan'
            ]
        };

        // Handle level change
        $('#level').on('change', function() {
            const level = $(this).val();

            // Hide all groups first & reset value
            $('#jurusan_group, #prodi_group, #unit_group, #pusat_group').hide();
            $('#jurusan_id, #prodi_id, #unit_id, #pusat_id').prop('required', false).val('');

            // Show appropriate fields
            if (level === 'jurusan') {
                $('#jurusan_group').show();
                $('#jurusan_id').prop('required', true);
            } else if (level === 'prodi') {
                $('#prodi_group').show();
                $('#prodi_id').prop('required', true);
            } else if (level === 'unit') {
                $('#unit_group').show();
                $('#unit_id').prop('required', true);
            } else if (level === 'pusat') {
                $('#pusat_group').show();
                $('#pusat_id').prop('required', true);
            }

            // Update jabatan suggestions
            updateJabatanSuggestions(level);
        });

        // Handle jurusan change untuk filter prodi
        $('#jurusan_id').on('change', function() {
            const selectedJurusan = $(this).val();
            console.log('Jurusan changed to:', selectedJurusan);

            const $prodiSelect = $('#prodi_id');

            $prodiSelect.find('option').each(function() {
                const $option = $(this);
                const jurusanId = $option.data('jurusan');

                if ($option.val() === '') {
                    $option.show(); // Keep "-- Pilih Program Studi --"
                } else if (!selectedJurusan || jurusanId == selectedJurusan) {
                    $option.show();
                } else {
                    $option.hide();
                }
            });

            $prodiSelect.val(''); // Reset selection
        });

        // Handle SDM change
        $('#sdm_id').on('change', function() {
            const sdmId = $(this).val();
            const sdmText = $(this).find('option:selected').text();
            console.log('SDM changed - ID:', sdmId, 'Text:', sdmText);

            if (sdmId) {
                loadSDMPreview(sdmId, sdmText);
            } else {
                $('#sdm_preview').hide();
                $('#existing_jabatan').remove();
            }
        });

        // Handle periode validation
        $('#periode_mulai, #periode_akhir').on('change blur', function() {
            validatePeriode();
        });

        // Jabatan suggestions click
        $(document).on('click', '.jabatan-suggestion', function() {
            const jabatan = $(this).text();
            $('#jabatan').val(jabatan);
            $(this).addClass('text-success').prepend('<i class="fa fa-check"></i> ');
            setTimeout(() => {
                $(this).removeClass('text-success').find('i').remove();
            }, 1000);
        });

        // Preview button
        $('#btn_preview').on('click', function() {
            showPreview();
        });

        // Update jabatan suggestions
        function updateJabatanSuggestions(level) {
            const $container = $('#jabatan_suggestions');

            if (!level || !jabatanSuggestions[level]) {
                $container.html('<p class="text-muted">Pilih level untuk melihat contoh jabatan</p>');
                return;
            }

            let html = '<p class="text-info"><small>Klik untuk menggunakan:</small></p>';
            jabatanSuggestions[level].forEach(jabatan => {
                html += `<span class="label label-default jabatan-suggestion" style="cursor: pointer; margin: 2px; display: inline-block;">${jabatan}</span>`;
            });

            $container.html(html);
        }

        // Load SDM preview
        function loadSDMPreview(sdmId, sdmText) {
            console.log('Loading SDM preview for:', sdmId, sdmText);

            // Simple preview without AJAX for now
            let html = `
            <div class="media">
                <div class="media-left">
                    <img src="<?php echo base_url('assets/img/no-image.png') ?>" 
                         class="media-object img-circle" style="width: 50px; height: 50px;">
                </div>
                <div class="media-body">
                    <h5 class="media-heading">${sdmText}</h5>
                    <p class="text-muted">
                        ID: ${sdmId}<br>
                        <em>Preview sederhana</em>
                    </p>
                </div>
            </div>
        `;

            $('#sdm_preview_content').html(html);
            $('#sdm_preview').show();
        }

        // Validate periode
        function validatePeriode() {
            const mulai = parseInt($('#periode_mulai').val());
            const akhir = parseInt($('#periode_akhir').val());

            $('#periode_error').remove();

            if (mulai && akhir && akhir <= mulai) {
                $('#periode_akhir').after('<span id="periode_error" class="text-danger"><br><small>Periode akhir harus lebih besar dari periode mulai</small></span>');
                return false;
            }

            return true;
        }

        // Show preview
        function showPreview() {
            const data = {
                sdm: $('#sdm_id option:selected').text(),
                level: $('#level option:selected').text(),
                jurusan: $('#jurusan_id option:selected').text(),
                prodi: $('#prodi_id option:selected').text(),
                jabatan: $('#jabatan').val(),
                periode_mulai: $('#periode_mulai').val(),
                periode_akhir: $('#periode_akhir').val()
            };

            let html = `
            <h4>Preview Data Jabatan SDM</h4>
            <table class="table table-bordered table-sm">
                <tr><td width="30%"><strong>SDM</strong></td><td>${data.sdm}</td></tr>
                <tr><td><strong>Level</strong></td><td>${data.level}</td></tr>
        `;

            if (data.level === 'Jurusan' && data.jurusan !== '-- Pilih Jurusan --') {
                html += `<tr><td><strong>Jurusan</strong></td><td>${data.jurusan}</td></tr>`;
            } else if (data.level === 'Program Studi' && data.prodi !== '-- Pilih Program Studi --') {
                html += `<tr><td><strong>Program Studi</strong></td><td>${data.prodi}</td></tr>`;
            }

            html += `
                <tr><td><strong>Jabatan</strong></td><td>${data.jabatan}</td></tr>
                <tr><td><strong>Periode</strong></td><td>${data.periode_mulai} - ${data.periode_akhir}</td></tr>
            </table>
        `;

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Preview Data',
                    html: html,
                    width: 600,
                    showConfirmButton: true,
                    confirmButtonText: 'OK'
                });
            } else {
                alert('Preview:\n' +
                    'SDM: ' + data.sdm + '\n' +
                    'Level: ' + data.level + '\n' +
                    'Jabatan: ' + data.jabatan + '\n' +
                    'Periode: ' + data.periode_mulai + ' - ' + data.periode_akhir);
            }
        }

        // Form validation
        $('#form-tambah-jabatan-sdm').on('submit', function(e) {
            console.log('Form submitted');

            let isValid = true;
            $('.form-group').removeClass('has-error');
            $('.error-message').remove();

            // Validasi SDM
            if ($('#sdm_id').val() === '') {
                $('#sdm_id').closest('.form-group').addClass('has-error')
                    .append('<span class="error-message text-danger">SDM harus dipilih</span>');
                isValid = false;
            }

            // Validasi Level
            const level = $('#level').val();
            if (level === '') {
                $('#level').closest('.form-group').addClass('has-error')
                    .append('<span class="error-message text-danger">Level jabatan harus dipilih</span>');
                isValid = false;
            }

            // Validasi Unit/Pusat jika dipilih
            if (level === 'unit' && $('#unit_id').val() === '') {
                $('#unit_id').closest('.form-group').addClass('has-error')
                    .append('<span class="error-message text-danger">Unit harus dipilih</span>');
                isValid = false;
            }
            if (level === 'pusat' && $('#pusat_id').val() === '') {
                $('#pusat_id').closest('.form-group').addClass('has-error')
                    .append('<span class="error-message text-danger">Pusat harus dipilih</span>');
                isValid = false;
            }
            if (level === 'jurusan' && $('#jurusan_id').val() === '') {
                $('#jurusan_id').closest('.form-group').addClass('has-error')
                    .append('<span class="error-message text-danger">Jurusan harus dipilih</span>');
                isValid = false;
            }
            if (level === 'prodi' && $('#prodi_id').val() === '') {
                $('#prodi_id').closest('.form-group').addClass('has-error')
                    .append('<span class="error-message text-danger">Program Studi harus dipilih</span>');
                isValid = false;
            }

            // Validasi jabatan
            const jabatan = $('#jabatan').val().trim();
            if (jabatan === '') {
                $('#jabatan').closest('.form-group').addClass('has-error')
                    .append('<span class="error-message text-danger">Nama jabatan harus diisi</span>');
                isValid = false;
            } else if (jabatan.length > 100) {
                $('#jabatan').closest('.form-group').addClass('has-error')
                    .append('<span class="error-message text-danger">Nama jabatan maksimal 100 karakter</span>');
                isValid = false;
            }

            // Validasi periode
            if (!validatePeriode()) {
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Validasi Error',
                        text: 'Mohon periksa kembali data yang Anda masukkan',
                        timer: 3000
                    });
                }
                return false;
            }

            // Show loading if SweetAlert available
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Menyimpan Data',
                    text: 'Mohon tunggu...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }
        });

        // HAPUS salah satu event submit agar tidak double!
        $('#form-tambah-jabatan-sdm').off('submit').on('submit', function(e) {
            // Pastikan value level bersih dari spasi
            let level = $('#level').val();
            $('#level').val($.trim(level));

            // Sinkronkan ke hidden input (jaga-jaga)
            if ($('#level_hidden').length === 0) {
                $('<input>').attr({
                    type: 'hidden',
                    id: 'level_hidden',
                    name: 'level'
                }).appendTo(this);
            }
            $('#level_hidden').val($.trim(level));

            // ...lanjutkan validasi JS kamu di sini...
        });

        // TRIM VALUE LEVEL SEBELUM SUBMIT
        $('#form-tambah-jabatan-sdm').on('submit', function(e) {
            // Pastikan value level bersih dari spasi
            let level = $('#level').val();
            $('#level').val($.trim(level));
        });

        // Cleanup function for page unload
        $(window).on('beforeunload', function() {
            if ($('#sdm_id').hasClass('select2-hidden-accessible')) {
                $('#sdm_id').select2('destroy');
            }
        });

        // Initialize everything
        setTimeout(initializeSelect2, 200); // Delay to ensure DOM is ready

        // Initialize other components
        $('#level').trigger('change');
        $('#jurusan_id').trigger('change');

        console.log('Form initialization completed');
    });
</script>

<!-- Enhanced Custom CSS with Fixed Spacing -->
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

    /* Form styling */
    .form-group label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .form-control {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 8px 12px;
        font-size: 14px;
    }

    .form-control:focus {
        border-color: #3c8dbc;
        box-shadow: 0 0 0 0.2rem rgba(60, 141, 188, 0.25);
        outline: 0;
    }

    /* Consistent Select2 styling with fixed spacing */
    .select2-container {
        width: 100% !important;
    }

    .select2-container-custom {
        max-width: 100% !important;
    }

    .select2-container--default .select2-selection--single {
        height: 34px !important;
        border: 1px solid #ddd !important;
        border-radius: 4px !important;
        background-color: #fff !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 32px !important;
        padding-left: 12px !important;
        padding-right: 30px !important;
        color: #555 !important;
        font-size: 14px !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        white-space: nowrap !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 32px !important;
        right: 10px !important;
    }

    /* Fixed dropdown width and spacing */
    .select2-dropdown {
        border: 1px solid #ddd !important;
        border-radius: 4px !important;
        z-index: 9999 !important;
        max-width: 450px !important;
        min-width: 300px !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15) !important;
    }

    .select2-dropdown-custom {
        max-width: 450px !important;
        min-width: 300px !important;
    }

    /* Consistent option spacing */
    .select2-container--default .select2-results__option {
        padding: 10px 15px !important;
        font-size: 14px !important;
        line-height: 1.5 !important;
        border-bottom: 1px solid #f0f0f0 !important;
        margin: 0 !important;
        word-wrap: break-word !important;
        white-space: normal !important;
        min-height: 40px !important;
        display: flex !important;
        align-items: center !important;
    }

    /* Remove border from last option */
    .select2-container--default .select2-results__option:last-child {
        border-bottom: none !important;
    }

    /* Custom option content styling */
    .select2-option-content {
        width: 100%;
        padding: 0;
        margin: 0;
        line-height: 1.4;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #3c8dbc !important;
        color: white !important;
    }

    .select2-container--default .select2-results__option[aria-selected=true] {
        background-color: #e8f4fd !important;
        color: #333 !important;
    }

    .select2-container--default .select2-results__option[aria-selected=true].select2-results__option--highlighted {
        background-color: #3c8dbc !important;
        color: white !important;
    }

    /* Search input styling */
    .select2-search {
        padding: 8px 12px !important;
        border-bottom: 1px solid #e0e0e0 !important;
        background-color: #f8f9fa !important;
    }

    .select2-search__field {
        border: 1px solid #ddd !important;
        border-radius: 3px !important;
        padding: 8px 12px !important;
        outline: none !important;
        font-size: 14px !important;
        width: 100% !important;
        box-sizing: border-box !important;
        background-color: #fff !important;
    }

    .select2-search__field:focus {
        border-color: #3c8dbc !important;
        box-shadow: 0 0 0 0.1rem rgba(60, 141, 188, 0.25) !important;
    }

    /* Results container with consistent spacing */
    .select2-results {
        max-height: 320px !important;
        overflow-y: auto !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .select2-results__option {
        cursor: pointer !important;
        transition: all 0.15s ease !important;
    }

    .select2-results__option:hover {
        background-color: #f5f5f5 !important;
    }

    /* No results message */
    .select2-results__option--no-results {
        padding: 15px !important;
        text-align: center !important;
        color: #999 !important;
        font-style: italic !important;
        background-color: #f8f9fa !important;
    }

    /* Loading message */
    .select2-results__option--loading-results {
        padding: 15px !important;
        text-align: center !important;
        color: #666 !important;
        background-color: #f8f9fa !important;
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

    /* Jabatan suggestions */
    .jabatan-suggestion {
        transition: all 0.2s ease;
        cursor: pointer;
        margin: 2px;
        display: inline-block;
        padding: 6px 10px;
        border-radius: 3px;
        font-size: 12px;
    }

    .jabatan-suggestion:hover {
        background-color: #3c8dbc !important;
        color: white !important;
        transform: scale(1.05);
    }

    /* Media object */
    .media-object {
        border: 2px solid #ddd;
    }

    /* Box footer */
    .box-footer {
        border-top: 1px solid #ddd;
        padding: 15px 20px;
        background-color: #f9f9f9;
    }

    /* Error styling */
    #periode_error {
        font-size: 12px;
        margin-top: 5px;
    }

    /* Button improvements */
    .btn {
        border-radius: 4px;
        font-weight: 500;
    }

    .btn-success:hover {
        background-color: #449d44;
        border-color: #398439;
    }

    .btn-info:hover {
        background-color: #31b0d5;
        border-color: #269abc;
    }

    /* Mobile responsive with consistent spacing */
    @media (max-width: 768px) {
        .col-md-4 {
            margin-top: 20px;
        }

        .select2-dropdown {
            max-width: 95vw !important;
            min-width: 250px !important;
        }

        .select2-container--default .select2-results__option {
            padding: 12px 15px !important;
            font-size: 16px !important;
            min-height: 45px !important;
        }

        .select2-search {
            padding: 10px 15px !important;
        }

        .select2-search__field {
            font-size: 16px !important;
            padding: 10px 15px !important;
        }
    }

    @media (max-width: 480px) {
        .select2-dropdown {
            max-width: 90vw !important;
            min-width: 200px !important;
        }

        .select2-container--default .select2-results__option {
            padding: 15px !important;
            min-height: 50px !important;
        }
    }

    /* Accessibility improvements */
    .form-control[aria-invalid="true"] {
        border-color: #d9534f;
    }

    /* Fix for autofill warnings */
    input[autocomplete="off"]::-webkit-contacts-auto-fill-button {
        visibility: hidden;
        display: none !important;
        pointer-events: none;
        height: 0;
        width: 0;
        margin: 0;
    }

    /* Ensure proper z-index for Select2 */
    .select2-container--open {
        z-index: 9999;
    }

    /* Loading state */
    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: #999 !important;
        font-style: italic !important;
    }

    /* Clear button styling */
    .select2-container--default .select2-selection--single .select2-selection__clear {
        color: #999 !important;
        cursor: pointer !important;
        float: right !important;
        font-weight: bold !important;
        margin-right: 10px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__clear:hover {
        color: #333 !important;
    }

    /* Custom scrollbar for better UX */
    .select2-results::-webkit-scrollbar {
        width: 8px;
    }

    .select2-results::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .select2-results::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 4px;
    }

    .select2-results::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }

    /* Firefox scrollbar */
    .select2-results {
        scrollbar-width: thin;
        scrollbar-color: #c1c1c1 #f1f1f1;
    }

    /* Ensure consistent typography */
    .select2-container--default .select2-results__option,
    .select2-container--default .select2-selection--single .select2-selection__rendered,
    .select2-search__field {
        font-family: inherit !important;
    }

    /* Fix for select2 container positioning */
    .select2-container {
        margin: 0 !important;
    }

    /* Improve focus states */
    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #3c8dbc !important;
        box-shadow: 0 0 0 0.2rem rgba(60, 141, 188, 0.25) !important;
    }

    /* Consistent border styling */
    .select2-container--default .select2-selection--single,
    .select2-dropdown {
        border-color: #ddd !important;
    }

    .select2-container--default.select2-container--open .select2-selection--single {
        border-color: #3c8dbc !important;
    }
</style>