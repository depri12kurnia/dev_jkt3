<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">
      <i class="fa fa-edit"></i> Edit Data Jabatan SDM
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

    // Success message
    if ($this->session->flashdata('success')) {
      echo '<div class="alert alert-success"><i class="fa fa-check"></i> ' . $this->session->flashdata('success') . '</div>';
    }

    // Form buka 
    echo form_open(base_url('admin/jabatan_sdm/edit/' . $jabatan_sdm->id), array('id' => 'form-edit-jabatan-sdm', 'class' => 'form-horizontal'));
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
                <option value="<?php echo $sdm->id ?>"
                  <?php echo ($sdm->id == $jabatan_sdm->sdm_id) ? 'selected' : set_select('sdm_id', $sdm->id) ?>>
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
            <option value="institusi" <?php echo ($jabatan_sdm->level == 'institusi') ? 'selected' : set_select('level', 'institusi') ?>>Institusi</option>
            <option value="jurusan" <?php echo ($jabatan_sdm->level == 'jurusan') ? 'selected' : set_select('level', 'jurusan') ?>>Jurusan</option>
            <option value="prodi" <?php echo ($jabatan_sdm->level == 'prodi') ? 'selected' : set_select('level', 'prodi') ?>>Program Studi</option>
            <option value="unit" <?php echo ($jabatan_sdm->level == 'unit') ? 'selected' : set_select('level', 'unit') ?>>Unit</option>
            <option value="pusat" <?php echo ($jabatan_sdm->level == 'pusat') ? 'selected' : set_select('level', 'pusat') ?>>Pusat</option>
          </select>
          <small class="form-text text-muted">Tentukan tingkatan jabatan</small>
        </div>

        <!-- Unit Kerja Section -->
        <div id="unit_kerja_section">
          <div class="form-group" id="jurusan_group" style="<?php echo ($jabatan_sdm->level == 'jurusan') ? 'display: block;' : 'display: none;' ?>">
            <label for="jurusan_id">Jurusan <span class="text-danger">*</span></label>
            <select id="jurusan_id" name="jurusan_id" class="form-control" autocomplete="off"
              <?php echo ($jabatan_sdm->level == 'jurusan') ? 'required' : '' ?>>
              <option value="">-- Pilih Jurusan --</option>
              <?php if (isset($jurusan_list) && !empty($jurusan_list)) { ?>
                <?php foreach ($jurusan_list as $jurusan) { ?>
                  <option value="<?php echo $jurusan->id ?>"
                    <?php echo ($jurusan->id == $jabatan_sdm->jurusan_id) ? 'selected' : set_select('jurusan_id', $jurusan->id) ?>>
                    <?php echo $jurusan->nama ?>
                  </option>
                <?php } ?>
              <?php } ?>
            </select>
            <small class="form-text text-muted">Wajib diisi untuk level jurusan</small>
          </div>

          <div class="form-group" id="prodi_group" style="<?php echo ($jabatan_sdm->level == 'prodi') ? 'display: block;' : 'display: none;' ?>">
            <label for="prodi_id">Program Studi <span class="text-danger">*</span></label>
            <select id="prodi_id" name="prodi_id" class="form-control" autocomplete="off"
              <?php echo ($jabatan_sdm->level == 'prodi') ? 'required' : '' ?>>
              <option value="">-- Pilih Program Studi --</option>
              <?php if (isset($prodi_list) && !empty($prodi_list)) { ?>
                <?php foreach ($prodi_list as $prodi) { ?>
                  <option value="<?php echo $prodi->id ?>"
                    data-jurusan="<?php echo isset($prodi->jurusan_id) ? $prodi->jurusan_id : '' ?>"
                    <?php echo ($prodi->id == $jabatan_sdm->prodi_id) ? 'selected' : set_select('prodi_id', $prodi->id) ?>>
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

          <div class="form-group" id="unit_group" style="<?php echo ($jabatan_sdm->level == 'unit') ? 'display: block;' : 'display: none;' ?>">
            <label for="unit_id">Unit <span class="text-danger">*</span></label>
            <select id="unit_id" name="unit_id" class="form-control" autocomplete="off"
              <?php echo ($jabatan_sdm->level == 'unit') ? 'required' : '' ?>>
              <option value="">-- Pilih Unit --</option>
              <?php if (isset($unit_list) && !empty($unit_list)) { ?>
                <?php foreach ($unit_list as $unit) { ?>
                  <option value="<?php echo $unit->id ?>"
                    <?php echo ($unit->id == $jabatan_sdm->unit_id) ? 'selected' : set_select('unit_id', $unit->id) ?>>
                    <?php echo $unit->nama ?>
                  </option>
                <?php } ?>
              <?php } ?>
            </select>
            <small class="form-text text-muted">Wajib diisi untuk level unit</small>
          </div>

          <div class="form-group" id="pusat_group" style="<?php echo ($jabatan_sdm->level == 'pusat') ? 'display: block;' : 'display: none;' ?>">
            <label for="pusat_id">Pusat <span class="text-danger">*</span></label>
            <select id="pusat_id" name="pusat_id" class="form-control" autocomplete="off"
              <?php echo ($jabatan_sdm->level == 'pusat') ? 'required' : '' ?>>
              <option value="">-- Pilih Pusat --</option>
              <?php if (isset($pusat_list) && !empty($pusat_list)) { ?>
                <?php foreach ($pusat_list as $pusat) { ?>
                  <option value="<?php echo $pusat->id ?>"
                    <?php echo ($pusat->id == $jabatan_sdm->pusat_id) ? 'selected' : set_select('pusat_id', $pusat->id) ?>>
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
            value="<?php echo set_value('jabatan', $jabatan_sdm->jabatan) ?>"
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
                value="<?php echo set_value('periode_mulai', $jabatan_sdm->periode_mulai) ?>"
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
                value="<?php echo set_value('periode_akhir', $jabatan_sdm->periode_akhir) ?>"
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
        <!-- Data Lama -->
        <div class="panel panel-warning">
          <div class="panel-heading">
            <h4 class="panel-title">
              <i class="fa fa-info-circle"></i> Data Sebelumnya
            </h4>
          </div>
          <div class="panel-body">
            <table class="table table-condensed table-borderless">
              <tr>
                <td><strong>SDM:</strong></td>
                <td><?php echo isset($current_sdm->nama) ? $current_sdm->nama : 'N/A' ?></td>
              </tr>
              <tr>
                <td><strong>Level:</strong></td>
                <td><?php echo ucfirst($jabatan_sdm->level) ?></td>
              </tr>
              <?php if ($jabatan_sdm->level == 'jurusan' && isset($current_jurusan->nama)) { ?>
                <tr>
                  <td><strong>Jurusan:</strong></td>
                  <td><?php echo $current_jurusan->nama ?></td>
                </tr>
              <?php } elseif ($jabatan_sdm->level == 'prodi' && isset($current_prodi->nama)) { ?>
                <tr>
                  <td><strong>Prodi:</strong></td>
                  <td><?php echo $current_prodi->nama ?></td>
                </tr>
              <?php } ?>
              <tr>
                <td><strong>Jabatan:</strong></td>
                <td><?php echo $jabatan_sdm->jabatan ?></td>
              </tr>
              <tr>
                <td><strong>Periode:</strong></td>
                <td><?php echo $jabatan_sdm->periode_mulai ?> - <?php echo $jabatan_sdm->periode_akhir ?></td>
              </tr>
            </table>
          </div>
        </div>

        <!-- Informasi Edit -->
        <div class="panel panel-info">
          <div class="panel-heading">
            <h4 class="panel-title">
              <i class="fa fa-edit"></i> Informasi Edit
            </h4>
          </div>
          <div class="panel-body">
            <ul class="list-unstyled">
              <li><i class="fa fa-check text-success"></i> Field bertanda <span class="text-danger">*</span> wajib diisi</li>
              <li><i class="fa fa-check text-success"></i> Periode akhir harus lebih besar dari periode mulai</li>
              <li><i class="fa fa-check text-success"></i> Perubahan data akan tercatat dalam riwayat</li>
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
        <div class="panel panel-success">
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
          <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Update Data
          </button>
          <a href="<?php echo base_url('admin/jabatan_sdm') ?>" class="btn btn-default">
            <i class="fa fa-times"></i> Batal
          </a>
          <button type="button" class="btn btn-info" id="btn_preview">
            <i class="fa fa-eye"></i> Preview
          </button>
          <button type="reset" class="btn btn-warning" id="btn_reset">
            <i class="fa fa-refresh"></i> Reset
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
    console.log('Initializing Edit Jabatan SDM form...');

    // Global variable to track Select2 initialization status
    let isSelect2Initialized = false;

    // Store original values for reset functionality
    const originalValues = {
      sdm_id: '<?php echo $jabatan_sdm->sdm_id ?>',
      level: '<?php echo $jabatan_sdm->level ?>',
      jurusan_id: '<?php echo $jabatan_sdm->jurusan_id ?>',
      prodi_id: '<?php echo $jabatan_sdm->prodi_id ?>',
      jabatan: '<?php echo addslashes($jabatan_sdm->jabatan) ?>',
      periode_mulai: '<?php echo $jabatan_sdm->periode_mulai ?>',
      periode_akhir: '<?php echo $jabatan_sdm->periode_akhir ?>',
      status: '<?php echo $jabatan_sdm->status ?>',
      catatan: '<?php echo addslashes($jabatan_sdm->catatan) ?>'
    };

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
                if (text.length > 80) {
                  text = text.substring(0, 77) + '...';
                }
                return $('<div class="select2-option-content" title="' + data.text + '">' + text + '</div>');
              },
              templateSelection: function(data) {
                // Limit text length in selection
                if (data.text.length > 60) {
                  return data.text.substring(0, 57) + '...';
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
        'Kepala Unit Penjaminan Mutu',
        'Kepala Unit Penelitian dan Pengabdian Masyarakat',
        'Kepala Unit Sistem Informasi',
        'Kepala Bagian Administrasi Akademik dan Kemahasiswaan',
        'Kepala Bagian Administrasi Umum dan Keuangan'
      ],
      'jurusan': [
        'Ketua Jurusan',
        'Sekretaris Jurusan',
        'Koordinator Laboratorium',
        'Koordinator Praktik Kerja Lapangan',
        'Koordinator Tugas Akhir'
      ],
      'prodi': [
        'Koordinator Program Studi',
        'Sekretaris Program Studi',
        'Koordinator Mata Kuliah',
        'Koordinator Magang',
        'Koordinator Skripsi/Tugas Akhir'
      ]
    };

    // Handle level change
    $('#level').on('change', function() {
      const level = $(this).val();

      // Hide all groups first
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
      }
    });

    // Handle periode validation
    $('#periode_mulai, #periode_akhir').on('change blur', function() {
      validatePeriode();
    });

    // Character counter for catatan
    $('#catatan').on('keyup', function() {
      const length = $(this).val().length;
      $('#catatan-count').text(length);

      if (length > 450) {
        $('#catatan-count').addClass('text-warning');
      } else {
        $('#catatan-count').removeClass('text-warning');
      }

      if (length > 500) {
        $('#catatan-count').addClass('text-danger').removeClass('text-warning');
      } else {
        $('#catatan-count').removeClass('text-danger');
      }
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

    // Reset button
    $('#btn_reset').on('click', function() {
      if (confirm('Apakah Anda yakin ingin mereset form ke data awal?')) {
        resetToOriginal();
      }
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

    // Reset to original values
    function resetToOriginal() {
      $('#sdm_id').val(originalValues.sdm_id);
      $('#level').val(originalValues.level).trigger('change');
      $('#jurusan_id').val(originalValues.jurusan_id);
      $('#prodi_id').val(originalValues.prodi_id);
      $('#jabatan').val(originalValues.jabatan);
      $('#periode_mulai').val(originalValues.periode_mulai);
      $('#periode_akhir').val(originalValues.periode_akhir);
      $('#status').val(originalValues.status);
      $('#catatan').val(originalValues.catatan).trigger('keyup');

      // Trigger Select2 update if initialized
      if (isSelect2Initialized) {
        $('#sdm_id').trigger('change');
      }

      // Clear validation errors
      $('.form-group').removeClass('has-error');
      $('.error-message').remove();
      $('#periode_error').remove();

      if (typeof Swal !== 'undefined') {
        Swal.fire({
          icon: 'success',
          title: 'Form Reset',
          text: 'Form telah dikembalikan ke data awal',
          timer: 2000,
          showConfirmButton: false
        });
      }
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
        periode_akhir: $('#periode_akhir').val(),
        status: $('#status option:selected').text(),
        catatan: $('#catatan').val()
      };

      let html = `
            <h4>Preview Update Jabatan SDM</h4>
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
                <tr><td><strong>Status</strong></td><td>${data.status}</td></tr>
        `;

      if (data.catatan) {
        html += `<tr><td><strong>Catatan</strong></td><td>${data.catatan}</td></tr>`;
      }

      html += `</table>`;

      if (typeof Swal !== 'undefined') {
        Swal.fire({
          title: 'Preview Update Data',
          html: html,
          width: 700,
          showConfirmButton: true,
          confirmButtonText: 'OK'
        });
      } else {
        alert('Preview:\n' +
          'SDM: ' + data.sdm + '\n' +
          'Level: ' + data.level + '\n' +
          'Jabatan: ' + data.jabatan + '\n' +
          'Periode: ' + data.periode_mulai + ' - ' + data.periode_akhir + '\n' +
          'Status: ' + data.status);
      }
    }

    // Form validation
    $('#form-edit-jabatan-sdm').on('submit', function(e) {
      console.log('Form submitted');

      if (!validatePeriode()) {
        e.preventDefault();
        if (typeof Swal !== 'undefined') {
          Swal.fire({
            icon: 'error',
            title: 'Validasi Error',
            text: 'Mohon periksa periode jabatan'
          });
        } else {
          alert('Error: Mohon periksa periode jabatan');
        }
        return false;
      }

      // Show loading if SweetAlert available
      if (typeof Swal !== 'undefined') {
        Swal.fire({
          title: 'Mengupdate Data',
          text: 'Mohon tunggu...',
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading();
          }
        });
      }
    });

    // Cleanup function for page unload
    $(window).on('beforeunload', function() {
      if ($('#sdm_id').hasClass('select2-hidden-accessible')) {
        $('#sdm_id').select2('destroy');
      }
    });

    // Initialize everything
    setTimeout(initializeSelect2, 200);

    // Initialize other components
    $('#level').trigger('change');
    $('#jurusan_id').trigger('change');
    $('#catatan').trigger('keyup');

    // Initialize SDM preview if already selected
    if ($('#sdm_id').val()) {
      $('#sdm_id').trigger('change');
    }

    console.log('Edit form initialization completed');
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

  /* Table styling for data sebelumnya */
  .table-borderless td {
    border: none !important;
    padding: 5px 0;
    font-size: 13px;
  }

  .table-borderless td:first-child {
    width: 40%;
    vertical-align: top;
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

  /* Character counter */
  #catatan-count.text-warning {
    color: #f39c12 !important;
    font-weight: bold;
  }

  #catatan-count.text-danger {
    color: #dd4b39 !important;
    font-weight: bold;
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

  .btn-primary:hover {
    background-color: #2e6da4;
    border-color: #204d74;
  }

  .btn-warning:hover {
    background-color: #ec971f;
    border-color: #d58512;
  }

  .btn-info:hover {
    background-color: #31b0d5;
    border-color: #269abc;
  }

  /* Status labels */
  .label {
    font-size: 11px;
    padding: 4px 8px;
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