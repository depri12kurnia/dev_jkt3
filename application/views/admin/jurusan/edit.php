<?php
// filepath: d:\xampp\htdocs\dev_jkt3\application\views\admin\jurusan\edit.php
?>

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">
      <i class="fa fa-edit"></i> Edit Data Jurusan
    </h3>
    <div class="box-tools pull-right">
      <a href="<?php echo base_url('admin/jurusan/preview/' . $jurusan->id) ?>"
        target="_blank"
        class="btn btn-info btn-sm">
        <i class="fa fa-eye"></i> Preview
      </a>
      <a href="<?php echo base_url('admin/jurusan') ?>" class="btn btn-default btn-sm">
        <i class="fa fa-arrow-left"></i> Kembali
      </a>
    </div>
  </div>

  <div class="box-body">
    <?php
    // Validasi error
    echo validation_errors('<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> ', '</div>');

    // Form buka 
    echo form_open_multipart(base_url('admin/jurusan/edit/' . $jurusan->id), array('id' => 'form-edit-jurusan'));
    ?>

    <!-- Basic Information -->
    <div class="row">
      <div class="col-md-8">
        <div class="form-group">
          <label for="nama">Nama Jurusan <span class="text-danger">*</span></label>
          <input type="text"
            id="nama"
            name="nama"
            class="form-control"
            placeholder="Masukkan nama jurusan"
            value="<?php echo set_value('nama', $jurusan->nama) ?>"
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
            value="<?php echo $jurusan->slug ?>"
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
            value="<?php echo set_value('tagline', $jurusan->tagline) ?>"
            maxlength="200">
          <small class="form-text text-muted">Maksimal 200 karakter</small>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="color">Color Theme</label>
          <select id="color" name="color" class="form-control">
            <option value="primary" <?php echo set_select('color', 'primary', $jurusan->color == 'primary'); ?>>Primary (Biru)</option>
            <option value="success" <?php echo set_select('color', 'success', $jurusan->color == 'success'); ?>>Success (Hijau)</option>
            <option value="info" <?php echo set_select('color', 'info', $jurusan->color == 'info'); ?>>Info (Cyan)</option>
            <option value="warning" <?php echo set_select('color', 'warning', $jurusan->color == 'warning'); ?>>Warning (Kuning)</option>
            <option value="danger" <?php echo set_select('color', 'danger', $jurusan->color == 'danger'); ?>>Danger (Merah)</option>
            <option value="secondary" <?php echo set_select('color', 'secondary', $jurusan->color == 'secondary'); ?>>Secondary (Abu-abu)</option>
            <option value="dark" <?php echo set_select('color', 'dark', $jurusan->color == 'dark'); ?>>Dark (Hitam)</option>
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="icon">Icon</label>
          <select id="icon" name="icon" class="form-control">
            <option value="bi bi-mortarboard" <?php echo set_select('icon', 'bi bi-mortarboard', $jurusan->icon == 'bi bi-mortarboard'); ?>>🎓 Mortarboard</option>
            <option value="bi bi-book" <?php echo set_select('icon', 'bi bi-book', $jurusan->icon == 'bi bi-book'); ?>>📚 Book</option>
            <option value="bi bi-laptop" <?php echo set_select('icon', 'bi bi-laptop', $jurusan->icon == 'bi bi-laptop'); ?>>💻 Laptop</option>
            <option value="bi bi-gear" <?php echo set_select('icon', 'bi bi-gear', $jurusan->icon == 'bi bi-gear'); ?>>⚙️ Gear</option>
            <option value="bi bi-heart-pulse" <?php echo set_select('icon', 'bi bi-heart-pulse', $jurusan->icon == 'bi bi-heart-pulse'); ?>>💓 Heart Pulse</option>
            <option value="bi bi-calculator" <?php echo set_select('icon', 'bi bi-calculator', $jurusan->icon == 'bi bi-calculator'); ?>>🧮 Calculator</option>
            <option value="bi bi-palette" <?php echo set_select('icon', 'bi bi-palette', $jurusan->icon == 'bi bi-palette'); ?>>🎨 Palette</option>
            <option value="bi bi-music-note" <?php echo set_select('icon', 'bi bi-music-note', $jurusan->icon == 'bi bi-music-note'); ?>>🎵 Music</option>
            <option value="bi bi-camera" <?php echo set_select('icon', 'bi bi-camera', $jurusan->icon == 'bi bi-camera'); ?>>📷 Camera</option>
            <option value="bi bi-building" <?php echo set_select('icon', 'bi bi-building', $jurusan->icon == 'bi bi-building'); ?>>🏢 Building</option>
            <option value="bi bi-globe" <?php echo set_select('icon', 'bi bi-globe', $jurusan->icon == 'bi bi-globe'); ?>>🌍 Globe</option>
            <option value="bi bi-cpu" <?php echo set_select('icon', 'bi bi-cpu', $jurusan->icon == 'bi bi-cpu'); ?>>🖥️ CPU</option>
            <option value="bi bi-microscope" <?php echo set_select('icon', 'bi bi-microscope', $jurusan->icon == 'bi bi-microscope'); ?>>🔬 Microscope</option>
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
            value="<?php echo set_value('status', $jurusan->status) ?>"
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
          <small class="form-text text-muted">Format: JPG, PNG, WEBP. Maksimal 2MB. Kosongkan jika tidak ingin mengubah</small>

          <!-- Current Image Preview -->
          <?php if (!empty($jurusan->image)): ?>
            <div class="current-image mt-2">
              <label class="control-label">Gambar Saat Ini:</label>
              <div>
                <img src="<?php echo base_url('assets/images/jurusan/' . $jurusan->image); ?>"
                  alt="<?php echo $jurusan->nama; ?>"
                  class="img-thumbnail current-image-preview"
                  style="max-width: 150px; max-height: 100px; object-fit: cover;">
                <button type="button" class="btn btn-danger btn-xs ml-2" onclick="deleteCurrentImage()">
                  <i class="fa fa-trash"></i> Hapus
                </button>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="deskripsi">Deskripsi</label>
      <textarea id="deskripsi"
        name="deskripsi"
        class="form-control tinymce-editor"
        placeholder="Masukkan deskripsi jurusan (opsional)"><?php echo set_value('deskripsi', $jurusan->deskripsi) ?></textarea>
      <small class="form-text text-muted">
        Gunakan editor untuk format teks yang lebih baik. <span id="char-count-display">0</span> karakter (tanpa HTML)
      </small>
    </div>

    <!-- Features Section -->
    <div class="form-group">
      <label>Features Jurusan</label>
      <div id="features-container">
        <?php
        $existing_features = [];
        if (!empty($jurusan->features)) {
          $existing_features = json_decode($jurusan->features, true);
        }

        if (empty($existing_features)) {
          $existing_features = [['icon' => '', 'color' => 'primary', 'text' => '']];
        }

        foreach ($existing_features as $index => $feature):
        ?>
          <div class="feature-row mb-2">
            <div class="row">
              <div class="col-md-3">
                <select name="feature_icon[]" class="form-control feature-icon">
                  <option value="">Pilih Icon</option>
                  <option value="bi bi-award-fill" <?php echo ($feature['icon'] == 'bi bi-award-fill') ? 'selected' : ''; ?>>🏆 Award</option>
                  <option value="bi bi-people-fill" <?php echo ($feature['icon'] == 'bi bi-people-fill') ? 'selected' : ''; ?>>👥 People</option>
                  <option value="bi bi-building" <?php echo ($feature['icon'] == 'bi bi-building') ? 'selected' : ''; ?>>🏢 Building</option>
                  <option value="bi bi-graph-up" <?php echo ($feature['icon'] == 'bi bi-graph-up') ? 'selected' : ''; ?>>📈 Graph Up</option>
                  <option value="bi bi-star-fill" <?php echo ($feature['icon'] == 'bi bi-star-fill') ? 'selected' : ''; ?>>⭐ Star</option>
                  <option value="bi bi-shield-check" <?php echo ($feature['icon'] == 'bi bi-shield-check') ? 'selected' : ''; ?>>🛡️ Shield</option>
                  <option value="bi bi-rocket" <?php echo ($feature['icon'] == 'bi bi-rocket') ? 'selected' : ''; ?>>🚀 Rocket</option>
                  <option value="bi bi-trophy" <?php echo ($feature['icon'] == 'bi bi-trophy') ? 'selected' : ''; ?>>🏆 Trophy</option>
                </select>
              </div>
              <div class="col-md-2">
                <select name="feature_color[]" class="form-control feature-color">
                  <option value="primary" <?php echo ($feature['color'] == 'primary') ? 'selected' : ''; ?>>Primary</option>
                  <option value="success" <?php echo ($feature['color'] == 'success') ? 'selected' : ''; ?>>Success</option>
                  <option value="info" <?php echo ($feature['color'] == 'info') ? 'selected' : ''; ?>>Info</option>
                  <option value="warning" <?php echo ($feature['color'] == 'warning') ? 'selected' : ''; ?>>Warning</option>
                  <option value="danger" <?php echo ($feature['color'] == 'danger') ? 'selected' : ''; ?>>Danger</option>
                </select>
              </div>
              <div class="col-md-6">
                <input type="text"
                  name="feature_text[]"
                  class="form-control"
                  placeholder="Teks feature"
                  maxlength="50"
                  value="<?php echo isset($feature['text']) ? $feature['text'] : ''; ?>">
              </div>
              <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-sm remove-feature">
                  <i class="fa fa-trash"></i>
                </button>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
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
            value="<?php echo set_value('link_brosur', $jurusan->link_brosur) ?>"
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
            value="<?php echo set_value('link_virtual_tour', $jurusan->link_virtual_tour) ?>"
            maxlength="255">
          <small class="form-text text-muted">URL lengkap untuk virtual tour</small>
        </div>
      </div>
    </div>

    <!-- Info Box -->
    <div class="row">
      <div class="col-md-6">
        <div class="alert alert-info">
          <i class="fa fa-info-circle"></i>
          <strong>Informasi Data:</strong>
          <ul class="mb-0 mt-2">
            <li><strong>ID:</strong> <?php echo $jurusan->id ?></li>
            <li><strong>Slug Saat Ini:</strong> <code><?php echo $jurusan->slug ?></code></li>
            <li><strong>Dibuat:</strong> <?php echo date('d/m/Y H:i', strtotime($jurusan->created_at)) ?></li>
            <li><strong>Color Theme:</strong> <span class="badge bg-<?php echo $jurusan->color ?>-subtle text-<?php echo $jurusan->color ?>"><?php echo ucfirst($jurusan->color) ?></span></li>
            <li><strong>Icon:</strong> <i class="<?php echo $jurusan->icon ?>"></i> <?php echo $jurusan->icon ?></li>
          </ul>
        </div>
      </div>
      <div class="col-md-6">
        <div class="alert alert-warning">
          <i class="fa fa-exclamation-triangle"></i>
          <strong>Perhatian:</strong>
          <ul class="mb-0 mt-2">
            <li>Perubahan nama akan mengubah slug</li>
            <li>Pastikan data sudah benar sebelum menyimpan</li>
            <li>Gambar baru akan mengganti gambar lama</li>
            <li>Features kosong akan dihapus otomatis</li>
            <li>Deskripsi mendukung format HTML</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Preview Changes -->
    <div class="alert alert-success" id="preview-changes" style="display: none;">
      <i class="fa fa-eye"></i>
      <strong>Preview Perubahan:</strong>
      <div id="changes-content"></div>
    </div>

    <div class="form-group text-center">
      <button type="button" class="btn btn-default" onclick="window.history.back()">
        <i class="fa fa-arrow-left"></i> Batal
      </button>
      <button type="button" id="preview-btn" class="btn btn-info">
        <i class="fa fa-eye"></i> Preview Perubahan
      </button>
      <button type="submit" name="submit" class="btn btn-success btn-lg">
        <i class="fa fa-save"></i> Simpan Perubahan
      </button>
    </div>

    <div class="clearfix"></div>

    <?php
    // Form close 
    echo form_close();
    ?>
  </div>
</div>

<!-- Related Data Box -->
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">
      <i class="fa fa-graduation-cap"></i> Program Studi Terkait
    </h3>
  </div>
  <div class="box-body">
    <?php if (!empty($prodi_list)) { ?>
      <div class="alert alert-warning">
        <i class="fa fa-exclamation-triangle"></i>
        <strong>Perhatian!</strong> Jurusan ini memiliki <?php echo count($prodi_list) ?> program studi terkait.
        Perubahan nama jurusan akan mempengaruhi data terkait.
      </div>

      <table class="table table-bordered table-sm">
        <thead>
          <tr>
            <th width="5%">#</th>
            <th>Nama Program Studi</th>
            <th width="15%">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;
          foreach ($prodi_list as $prodi) { ?>
            <tr>
              <td><?php echo $i ?></td>
              <td><?php echo $prodi->nama ?></td>
              <td>
                <a href="<?php echo base_url('admin/prodi/detail/' . $prodi->id) ?>"
                  class="btn btn-info btn-xs">
                  <i class="fa fa-eye"></i> Detail
                </a>
              </td>
            </tr>
            <?php $i++; ?>
          <?php } ?>
        </tbody>
      </table>
    <?php } else { ?>
      <p class="text-muted">
        <i class="fa fa-info-circle"></i>
        Jurusan ini belum memiliki program studi.
      </p>
    <?php } ?>
  </div>
</div>
<!-- JavaScript untuk form handling -->
<script>
  $(document).ready(function() {
    // Store original values
    var originalData = {
      nama: '<?php echo addslashes($jurusan->nama) ?>',
      deskripsi: '<?php echo addslashes($jurusan->deskripsi ?? '') ?>',
      tagline: '<?php echo addslashes($jurusan->tagline ?? '') ?>',
      status: '<?php echo addslashes($jurusan->status ?? '') ?>',
      color: '<?php echo $jurusan->color ?>',
      icon: '<?php echo $jurusan->icon ?>',
      link_brosur: '<?php echo addslashes($jurusan->link_brosur ?? '') ?>',
      link_virtual_tour: '<?php echo addslashes($jurusan->link_virtual_tour ?? '') ?>',
      slug: '<?php echo $jurusan->slug ?>'
    };

    // Initialize TinyMCE
    var tinymceConfig = {
      selector: '.tinymce-editor',
      height: 350,
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
          checkChanges();
        });

        editor.on('keyup', function() {
          editor.save();
          checkDeskripsiLength();
          checkChanges();
        });
      },
      init_instance_callback: function(editor) {
        // Set initial content and count
        var content = $('#deskripsi').val();
        if (content) {
          editor.setContent(content);
        }
        checkDeskripsiLength();
      }
    };

    // Initialize TinyMCE immediately
    tinymce.init(tinymceConfig);

    // Check deskripsi length function
    function checkDeskripsiLength() {
      var content = '';

      if (tinymce.get('deskripsi')) {
        content = tinymce.get('deskripsi').getContent();
      } else {
        content = $('#deskripsi').val();
      }

      var textContent = $('<div>').html(content).text(); // Strip HTML
      var length = textContent.length;

      // Update character count
      $('#char-count-display').text(length);

      if (length > 900) {
        $('#char-count-display').addClass('text-warning');
      } else {
        $('#char-count-display').removeClass('text-warning');
      }

      if (length > 1000) {
        $('#char-count-display').addClass('text-danger').removeClass('text-warning');
      } else {
        $('#char-count-display').removeClass('text-danger');
      }
    }

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
      checkChanges();
    });

    // Monitor other fields for changes
    $('#tagline, #status, #color, #icon, #link_brosur, #link_virtual_tour').on('change keyup', checkChanges);

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

    // Check for changes
    function checkChanges() {
      var currentDeskripsi = '';
      if (tinymce.get('deskripsi')) {
        currentDeskripsi = tinymce.get('deskripsi').getContent();
      } else {
        currentDeskripsi = $('#deskripsi').val();
      }

      var currentData = {
        nama: $('#nama').val(),
        deskripsi: currentDeskripsi,
        tagline: $('#tagline').val(),
        status: $('#status').val(),
        color: $('#color').val(),
        icon: $('#icon').val(),
        link_brosur: $('#link_brosur').val(),
        link_virtual_tour: $('#link_virtual_tour').val(),
        slug: $('#slug_preview').val()
      };

      var hasChanges = false;
      for (var key in currentData) {
        if (currentData[key] !== originalData[key]) {
          hasChanges = true;
          break;
        }
      }

      if (hasChanges) {
        $('#preview-btn').show();
      } else {
        $('#preview-btn').hide();
        $('#preview-changes').hide();
      }
    }

    // Preview changes
    $('#preview-btn').on('click', function() {
      var changes = [];
      var currentDeskripsi = tinymce.get('deskripsi') ? tinymce.get('deskripsi').getContent() : $('#deskripsi').val();

      if ($('#nama').val() !== originalData.nama) {
        changes.push('<strong>Nama:</strong> "' + originalData.nama + '" → "' + $('#nama').val() + '"');
      }

      if ($('#tagline').val() !== originalData.tagline) {
        changes.push('<strong>Tagline:</strong> "' + originalData.tagline + '" → "' + $('#tagline').val() + '"');
      }

      if ($('#status').val() !== originalData.status) {
        changes.push('<strong>Status:</strong> "' + originalData.status + '" → "' + $('#status').val() + '"');
      }

      if ($('#color').val() !== originalData.color) {
        changes.push('<strong>Color:</strong> ' + originalData.color + ' → ' + $('#color').val());
      }

      if ($('#icon').val() !== originalData.icon) {
        changes.push('<strong>Icon:</strong> ' + originalData.icon + ' → ' + $('#icon').val());
      }

      if ($('#link_brosur').val() !== originalData.link_brosur) {
        changes.push('<strong>Link Brosur:</strong> "' + originalData.link_brosur + '" → "' + $('#link_brosur').val() + '"');
      }

      if ($('#link_virtual_tour').val() !== originalData.link_virtual_tour) {
        changes.push('<strong>Link Virtual Tour:</strong> "' + originalData.link_virtual_tour + '" → "' + $('#link_virtual_tour').val() + '"');
      }

      if (currentDeskripsi !== originalData.deskripsi) {
        var originalPreview = originalData.deskripsi ? $('<div>').html(originalData.deskripsi).text().substring(0, 50) + '...' : 'Kosong';
        var currentPreview = $('<div>').html(currentDeskripsi).text().substring(0, 50) + '...';
        changes.push('<strong>Deskripsi:</strong> "' + originalPreview + '" → "' + currentPreview + '"');
      }

      if ($('#slug_preview').val() !== originalData.slug) {
        changes.push('<strong>Slug:</strong> "' + originalData.slug + '" → "' + $('#slug_preview').val() + '"');
      }

      if (changes.length > 0) {
        $('#changes-content').html('<ul><li>' + changes.join('</li><li>') + '</li></ul>');
        $('#preview-changes').show();
      }
    });

    // Form validation
    $('#form-edit-jurusan').on('submit', function(e) {
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
      var deskripsiContent = tinymce.get('deskripsi') ? tinymce.get('deskripsi').getContent() : $('#deskripsi').val();
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
          $(this).closest('.form-group').addClass('has-error');
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

      // Confirm if there are related prodi
      <?php if (!empty($prodi_list)) { ?>
        e.preventDefault();

        Swal.fire({
          title: 'Konfirmasi Perubahan',
          text: 'Jurusan ini memiliki <?php echo count($prodi_list) ?> program studi terkait. Yakin ingin menyimpan perubahan?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Simpan!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            showLoadingAndSubmit();
          }
        });
      <?php } else { ?>
        showLoadingAndSubmit();
      <?php } ?>
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

    function showLoadingAndSubmit() {
      Swal.fire({
        title: 'Menyimpan Perubahan',
        text: 'Mohon tunggu...',
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        }
      });

      // Submit form manually
      $('#form-edit-jurusan')[0].submit();
    }

    // Initialize
    checkChanges();
    $('#preview-btn').hide();

    // Initial character count check
    setTimeout(function() {
      checkDeskripsiLength();
    }, 1000);
  });

  // Delete current image
  function deleteCurrentImage() {
    Swal.fire({
      title: 'Konfirmasi Hapus',
      text: 'Apakah Anda yakin ingin menghapus gambar ini?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Ya, Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '<?php echo base_url("admin/jurusan/delete_image/" . $jurusan->id); ?>',
          type: 'POST',
          dataType: 'json',
          success: function(response) {
            if (response.status === 'success') {
              $('.current-image').remove();
              Swal.fire('Berhasil', 'Gambar telah dihapus', 'success');
            } else {
              Swal.fire('Error', 'Gagal menghapus gambar', 'error');
            }
          },
          error: function() {
            Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
          }
        });
      }
    });
  }
</script>

<!-- Custom CSS -->
<style>
  .box {
    margin-bottom: 20px;
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

  .alert {
    border-left: 4px solid #3c8dbc;
  }

  .alert-warning {
    border-left-color: #f39c12;
  }

  .alert-info {
    border-left-color: #00c0ef;
  }

  .alert-success {
    border-left-color: #00a65a;
  }

  #char-count-display.text-warning {
    color: #f39c12 !important;
  }

  #char-count-display.text-danger {
    color: #dd4b39 !important;
  }

  .table-sm th,
  .table-sm td {
    padding: 8px;
  }

  .current-image-preview {
    border: 2px solid #ddd;
    border-radius: 5px;
    transition: transform 0.2s;
  }

  .current-image-preview:hover {
    transform: scale(1.05);
    border-color: #3c8dbc;
  }

  .feature-row {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background: #f9f9f9;
    margin-bottom: 10px;
  }

  .feature-row:hover {
    background: #f5f5f5;
    border-color: #3c8dbc;
  }

  .badge {
    padding: 4px 8px;
    font-size: 0.8em;
  }

  .current-image {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px;
    background: #f9f9f9;
  }

  /* TinyMCE Editor Styling */
  .tox .tox-editor-header {
    border-radius: 4px 4px 0 0 !important;
    border: 1px solid #d2d6de !important;
    border-bottom: none !important;
  }

  .tox .tox-editor-container {
    border-radius: 0 0 4px 4px !important;
    border: 1px solid #d2d6de !important;
    border-top: none !important;
  }

  .tox:not([dir=rtl]) .tox-toolbar__primary {
    background: #f8f9fa !important;
    border-bottom: 1px solid #ddd !important;
  }

  /* Character count display */
  .tinymce-char-count {
    text-align: right;
    font-size: 12px;
    color: #666;
    margin-top: 5px;
  }
</style>