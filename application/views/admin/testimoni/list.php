<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-comments"></i> <?php echo $title ?>
                </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal">
                        <i class="fa fa-plus"></i> Tambah Testimoni
                    </button>
                    <a href="<?php echo base_url('admin/testimoni/export?' . http_build_query($filters)) ?>" class="btn btn-success btn-sm">
                        <i class="fa fa-download"></i> Export CSV
                    </a>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-blue">
                            <span class="info-box-icon"><i class="fa fa-comments"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Testimoni</span>
                                <span class="info-box-number"><?php echo isset($statistics['total']) ? $statistics['total'] : 0 ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-green">
                            <span class="info-box-icon"><i class="fa fa-check"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Published</span>
                                <span class="info-box-number"><?php echo isset($statistics['status']['publish']) ? $statistics['status']['publish'] : 0 ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-yellow">
                            <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Pending</span>
                                <span class="info-box-number"><?php echo isset($statistics['status']['pending']) ? $statistics['status']['pending'] : 0 ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-red">
                            <span class="info-box-icon"><i class="fa fa-times"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Rejected</span>
                                <span class="info-box-number"><?php echo isset($statistics['status']['rejected']) ? $statistics['status']['rejected'] : 0 ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter Form -->
                <div class="row">
                    <div class="col-md-12">
                        <form method="GET" action="<?php echo base_url('admin/testimoni') ?>" class="form-inline">
                            <div class="form-group">
                                <label>Status:</label>
                                <select name="status" class="form-control">
                                    <option value="">Semua Status</option>
                                    <?php foreach ($status_options as $key => $value): ?>
                                        <option value="<?php echo $key ?>" <?php echo (isset($filters['status']) && $filters['status'] == $key) ? 'selected' : '' ?>>
                                            <?php echo $value ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Role:</label>
                                <select name="role" class="form-control">
                                    <option value="">Semua Role</option>
                                    <?php foreach ($role_options as $key => $value): ?>
                                        <option value="<?php echo $key ?>" <?php echo (isset($filters['role']) && $filters['role'] == $key) ? 'selected' : '' ?>>
                                            <?php echo $value ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Pencarian:</label>
                                <input type="text" name="search" class="form-control" placeholder="Nama, Prodi, atau Isi testimoni..."
                                    value="<?php echo isset($filters['search']) ? $filters['search'] : '' ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i> Filter
                            </button>
                            <a href="<?php echo base_url('admin/testimoni') ?>" class="btn btn-default">
                                <i class="fa fa-refresh"></i> Reset
                            </a>
                        </form>
                    </div>
                </div>
                <br>

                <!-- Bulk Actions -->
                <form id="bulk-form" method="POST">
                    <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>" />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select id="bulk-action" class="form-control" style="width: 200px; display: inline-block;">
                                    <option value="">Pilih Aksi</option>
                                    <option value="publish">Publish Terpilih</option>
                                    <option value="pending">Set Pending</option>
                                    <option value="rejected">Set Rejected</option>
                                    <option value="delete">Hapus Terpilih</option>
                                </select>
                                <button type="button" id="apply-bulk" class="btn btn-warning">
                                    <i class="fa fa-play"></i> Terapkan
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <small class="text-muted">
                                <span id="selected-count">0</span> item terpilih
                            </small>
                        </div>
                    </div>

                    <!-- Data Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="30">
                                        <input type="checkbox" id="select-all">
                                    </th>
                                    <th width="50">Foto</th>
                                    <th>Nama</th>
                                    <th>Asal Prodi</th>
                                    <th>Jabatan</th>
                                    <th>Role</th>
                                    <th>Isi Testimoni</th>
                                    <th width="80">Status</th>
                                    <th width="100">Tanggal</th>
                                    <th width="140">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($testimoni)): ?>
                                    <?php foreach ($testimoni as $row): ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="select-item" value="<?php echo $row->id ?>">
                                            </td>
                                            <td>
                                                <?php if (!empty($row->foto)): ?>
                                                    <img src="<?php echo base_url('assets/images/testimoni/' . $row->foto) ?>"
                                                        alt="Foto" class="img-thumbnail" style="width: 40px; height: 40px;">
                                                <?php else: ?>
                                                    <span class="text-muted">No Image</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <strong><?php echo $row->nama ?></strong>
                                            </td>
                                            <td><?php echo $row->asal_prodi ?></td>
                                            <td><?php echo $row->jabatan ?></td>
                                            <td>
                                                <span class="label label-info">
                                                    <?php echo $role_options[$row->role] ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php echo character_limiter(strip_tags($row->isi), 100) ?>
                                            </td>
                                            <td>
                                                <?php
                                                $status_class = '';
                                                switch ($row->status) {
                                                    case 'publish':
                                                        $status_class = 'label-success';
                                                        break;
                                                    case 'pending':
                                                        $status_class = 'label-warning';
                                                        break;
                                                    case 'rejected':
                                                        $status_class = 'label-danger';
                                                        break;
                                                }
                                                ?>
                                                <span class="label <?php echo $status_class ?>">
                                                    <?php echo $status_options[$row->status] ?>
                                                </span>
                                            </td>
                                            <td>
                                                <small><?php echo date('d/m/Y', strtotime($row->created_at)) ?></small>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-xs">
                                                    <button type="button" class="btn btn-info btn-detail" title="Detail"
                                                        data-id="<?php echo $row->id ?>">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-edit" title="Edit"
                                                        data-id="<?php echo $row->id ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-delete" title="Hapus"
                                                        data-id="<?php echo $row->id ?>"
                                                        data-nama="<?php echo $row->nama ?>">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="10" class="text-center">Tidak ada data testimoni</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </form>

                <!-- Pagination -->
                <?php if (!empty($pagination)): ?>
                    <div class="text-center">
                        <?php echo $pagination ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Testimoni -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Testimoni</h4>
            </div>
            <form id="addForm" enctype="multipart/form-data">
                <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>" />
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Asal Prodi <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="asal_prodi" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" placeholder="Contoh: Mahasiswa, Dosen, Alumni">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control" name="role">
                                    <?php foreach ($role_options as $key => $value): ?>
                                        <option value="<?php echo $key ?>" <?php echo ($key == 'umum') ? 'selected' : '' ?>>
                                            <?php echo $value ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <?php foreach ($status_options as $key => $value): ?>
                                        <option value="<?php echo $key ?>" <?php echo ($key == 'pending') ? 'selected' : '' ?>>
                                            <?php echo $value ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Isi Testimoni <span class="text-red">*</span></label>
                        <textarea class="form-control" name="isi" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" class="form-control" name="foto" accept="image/*">
                        <small class="text-muted">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB.</small>
                        <div id="add-image-preview" style="margin-top: 10px; display: none;">
                            <img id="add-preview-img" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Testimoni -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Testimoni</h4>
            </div>
            <form id="editForm" enctype="multipart/form-data">
                <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>" />
                <input type="hidden" name="id" id="edit-id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="nama" id="edit-nama" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Asal Prodi <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="asal_prodi" id="edit-asal_prodi" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" id="edit-jabatan" placeholder="Contoh: Mahasiswa, Dosen, Alumni">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control" name="role" id="edit-role">
                                    <?php foreach ($role_options as $key => $value): ?>
                                        <option value="<?php echo $key ?>"><?php echo $value ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" id="edit-status">
                                    <?php foreach ($status_options as $key => $value): ?>
                                        <option value="<?php echo $key ?>"><?php echo $value ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Isi Testimoni <span class="text-red">*</span></label>
                        <textarea class="form-control" name="isi" id="edit-isi" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" class="form-control" name="foto" accept="image/*">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                        <div id="edit-current-image" style="margin-top: 10px;">
                            <!-- Current image will be shown here -->
                        </div>
                        <div id="edit-image-preview" style="margin-top: 10px; display: none;">
                            <img id="edit-preview-img" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fa fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail Testimoni -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-eye"></i> Detail Testimoni</h4>
            </div>
            <div class="modal-body" id="detail-content">
                <!-- Detail content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var csrfName = '<?php echo $csrf_token_name; ?>';
        var csrfHash = '<?php echo $csrf_hash; ?>';

        // Function to update CSRF token
        function updateCSRFToken(newToken, newHash) {
            if (newToken && newHash) {
                csrfName = newToken;
                csrfHash = newHash;
                $('input[name="' + csrfName + '"]').val(newHash);
            }
        }

        // Select all checkbox
        $('#select-all').change(function() {
            $('.select-item').prop('checked', this.checked);
            updateSelectedCount();
        });

        // Individual checkbox
        $('.select-item').change(function() {
            updateSelectedCount();
        });

        // Update selected count
        function updateSelectedCount() {
            var count = $('.select-item:checked').length;
            $('#selected-count').text(count);

            if (count > 0) {
                $('#bulk-action').prop('disabled', false);
                $('#apply-bulk').prop('disabled', false);
            } else {
                $('#bulk-action').prop('disabled', true);
                $('#apply-bulk').prop('disabled', true);
            }
        }

        // Apply bulk action
        $('#apply-bulk').click(function() {
            var action = $('#bulk-action').val();
            var selected = $('.select-item:checked').map(function() {
                return this.value;
            }).get();

            if (action == '' || selected.length == 0) {
                alert('Pilih aksi dan minimal satu item');
                return;
            }

            var confirm_message = '';
            var form_action = '';

            switch (action) {
                case 'delete':
                    confirm_message = 'Yakin ingin menghapus ' + selected.length + ' testimoni?';
                    form_action = '<?php echo base_url("admin/testimoni/bulk_delete") ?>';
                    break;
                case 'publish':
                case 'pending':
                case 'rejected':
                    confirm_message = 'Yakin ingin mengubah status ' + selected.length + ' testimoni?';
                    form_action = '<?php echo base_url("admin/testimoni/bulk_update_status") ?>';
                    break;
            }

            if (confirm(confirm_message)) {
                var form = $('#bulk-form');
                form.attr('action', form_action);

                // Add selected IDs
                selected.forEach(function(id) {
                    form.append('<input type="hidden" name="ids[]" value="' + id + '">');
                });

                // Add status for status update
                if (action != 'delete') {
                    form.append('<input type="hidden" name="status" value="' + action + '">');
                }

                form.submit();
            }
        });

        // Image preview for add form
        $('#addForm input[name="foto"]').change(function() {
            previewImage(this, '#add-preview-img', '#add-image-preview');
        });

        // Image preview for edit form
        $('#editForm input[name="foto"]').change(function() {
            previewImage(this, '#edit-preview-img', '#edit-image-preview');
        });

        function previewImage(input, imgId, containerId) {
            if (input.files && input.files[0]) {
                var file = input.files[0];

                // Validate file size (2MB)
                if (file.size > 2048 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB.');
                    $(input).val('');
                    $(containerId).hide();
                    return;
                }

                // Validate file type
                var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (allowedTypes.indexOf(file.type) === -1) {
                    alert('Format file tidak didukung. Gunakan JPG, JPEG, PNG, atau GIF.');
                    $(input).val('');
                    $(containerId).hide();
                    return;
                }

                var reader = new FileReader();
                reader.onload = function(e) {
                    $(imgId).attr('src', e.target.result);
                    $(containerId).show();
                }
                reader.readAsDataURL(file);
            } else {
                $(containerId).hide();
            }
        }

        // Add form submission
        $('#addForm').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            var btn = $(this).find('button[type="submit"]');
            btn.html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...').prop('disabled', true);

            $.ajax({
                url: '<?php echo base_url("admin/testimoni/create") ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    try {
                        var result = JSON.parse(response);

                        // Update CSRF token if provided
                        if (result.csrf_token_name && result.csrf_hash) {
                            updateCSRFToken(result.csrf_token_name, result.csrf_hash);
                        }

                        if (result.status == 'success') {
                            $('#addModal').modal('hide');
                            location.reload();
                        } else {
                            alert(result.message);
                        }
                    } catch (e) {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                },
                complete: function() {
                    btn.html('<i class="fa fa-save"></i> Simpan').prop('disabled', false);
                }
            });
        });

        // Edit button click
        $('.btn-edit').click(function() {
            var id = $(this).data('id');

            $.ajax({
                url: '<?php echo base_url("admin/testimoni/get_by_id/") ?>' + id,
                type: 'GET',
                success: function(response) {
                    try {
                        var data = JSON.parse(response);

                        // Update CSRF token if provided
                        if (data.csrf_token_name && data.csrf_hash) {
                            updateCSRFToken(data.csrf_token_name, data.csrf_hash);
                        }

                        if (data.status == 'success') {
                            var testimoni = data.data;
                            $('#edit-id').val(testimoni.id);
                            $('#edit-nama').val(testimoni.nama);
                            $('#edit-asal_prodi').val(testimoni.asal_prodi);
                            $('#edit-jabatan').val(testimoni.jabatan);
                            $('#edit-role').val(testimoni.role);
                            $('#edit-status').val(testimoni.status);
                            $('#edit-isi').val(testimoni.isi);

                            // Show current image
                            if (testimoni.foto) {
                                $('#edit-current-image').html('<p>Foto saat ini:</p><img src="<?php echo base_url("assets/images/testimoni/") ?>' + testimoni.foto + '" class="img-thumbnail" style="max-width: 200px;">');
                            } else {
                                $('#edit-current-image').html('<p class="text-muted">Tidak ada foto</p>');
                            }

                            $('#editModal').modal('show');
                        } else {
                            alert(data.message);
                        }
                    } catch (e) {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                }
            });
        });

        // Edit form submission
        $('#editForm').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            var btn = $(this).find('button[type="submit"]');
            var id = $('#edit-id').val();
            btn.html('<i class="fa fa-spinner fa-spin"></i> Mengupdate...').prop('disabled', true);

            $.ajax({
                url: '<?php echo base_url("admin/testimoni/edit/") ?>' + id,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    try {
                        var result = JSON.parse(response);

                        // Update CSRF token if provided
                        if (result.csrf_token_name && result.csrf_hash) {
                            updateCSRFToken(result.csrf_token_name, result.csrf_hash);
                        }

                        if (result.status == 'success') {
                            $('#editModal').modal('hide');
                            location.reload();
                        } else {
                            alert(result.message);
                        }
                    } catch (e) {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                },
                complete: function() {
                    btn.html('<i class="fa fa-save"></i> Update').prop('disabled', false);
                }
            });
        });

        // Detail button click
        $('.btn-detail').click(function() {
            var id = $(this).data('id');

            $.ajax({
                url: '<?php echo base_url("admin/testimoni/detail/") ?>' + id,
                type: 'GET',
                success: function(response) {
                    $('#detail-content').html(response);
                    $('#detailModal').modal('show');
                }
            });
        });

        // Delete button click
        $('.btn-delete').click(function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');

            if (confirm('Yakin ingin menghapus testimoni dari "' + nama + '"?')) {
                $.ajax({
                    url: '<?php echo base_url("admin/testimoni/delete/") ?>' + id,
                    type: 'POST',
                    data: {
                        [csrfName]: csrfHash
                    },
                    success: function(response) {
                        try {
                            var result = JSON.parse(response);

                            // Update CSRF token if provided
                            if (result.csrf_token_name && result.csrf_hash) {
                                updateCSRFToken(result.csrf_token_name, result.csrf_hash);
                            }

                            if (result.status == 'success') {
                                location.reload();
                            } else {
                                alert(result.message);
                            }
                        } catch (e) {
                            alert('Terjadi kesalahan. Silakan coba lagi.');
                        }
                    }
                });
            }
        });

        // Reset form when modal is hidden
        $('#addModal').on('hidden.bs.modal', function() {
            $('#addForm')[0].reset();
            $('#add-image-preview').hide();
            // Update CSRF token in add form
            $('#addForm input[name="' + csrfName + '"]').val(csrfHash);
        });

        $('#editModal').on('hidden.bs.modal', function() {
            $('#editForm')[0].reset();
            $('#edit-image-preview').hide();
            $('#edit-current-image').html('');
            // Update CSRF token in edit form
            $('#editForm input[name="' + csrfName + '"]').val(csrfHash);
        });

        // Initialize disabled state
        updateSelectedCount();
    });
</script>