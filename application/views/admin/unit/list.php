<!-- Search Box -->
<div class="row mb-3">
    <div class="col-md-6">
        <form method="GET" action="<?php echo base_url('admin/unit/search') ?>">
            <div class="input-group">
                <input type="text" class="form-control" name="q" placeholder="Cari unit..." value="<?php echo isset($keyword) ? $keyword : '' ?>">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-6 text-right">
        <a href="<?php echo base_url('admin/unit/export') ?>" class="btn btn-success btn-sm">
            <i class="fa fa-download"></i> Export CSV
        </a>
        <a href="<?php echo base_url('admin/unit/import') ?>" class="btn btn-info btn-sm">
            <i class="fa fa-upload"></i> Import CSV
        </a>
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

<!-- Add Button -->
<p>
    <?php include('tambah.php') ?>
</p>

<!-- Data Table -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Data Unit</h3>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-hover table-striped" id="example1">
            <thead>
                <tr>
                    <th width="3%">#</th>
                    <th width="20%">Nama Unit</th>
                    <th width="15%">Slug</th>
                    <th width="25%">Deskripsi</th>
                    <th width="15%">Tagline</th>
                    <th width="10%">Image</th>
                    <th width="12%">Tanggal Dibuat</th>
                    <th width="10%" class="no-sort">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($unit)) { ?>
                    <?php $i = 1;
                    foreach ($unit as $row) { ?>
                        <tr>
                            <td class="text-center"><?php echo $i ?></td>
                            <td><?php echo htmlspecialchars($row->nama) ?></td>
                            <td><code><?php echo htmlspecialchars($row->slug) ?></code></td>
                            <td>
                                <?php echo character_limiter(strip_tags($row->deskripsi), 80) ?>
                                <?php if (!empty($row->deskripsi) && strlen($row->deskripsi) > 80) { ?>
                                    <a href="#" class="show-more" data-description="<?php echo htmlspecialchars($row->deskripsi) ?>">Lihat</a>
                                <?php } ?>
                            </td>
                            <td><?php echo htmlspecialchars($row->tagline) ?></td>
                            <td>
                                <?php if (!empty($row->image)) { ?>
                                    <img src="<?php echo base_url('assets/images/unit/' . $row->image) ?>" alt="Image" style="max-width:60px;max-height:60px;">
                                <?php } else { ?>
                                    <span class="text-muted">-</span>
                                <?php } ?>
                            </td>
                            <td><?php echo date('d/m/Y H:i', strtotime($row->created_at)) ?></td>
                            <td class="text-center">
                                <div class="btn-group-vertical" role="group">
                                    <a href="<?php echo base_url('admin/unit/detail/' . $row->id) ?>" class="btn btn-info btn-xs" title="Detail" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
                                    <a href="<?php echo base_url('admin/unit/edit/' . $row->id) ?>" class="btn btn-warning btn-xs" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                    <a href="<?php echo base_url('admin/unit/delete/' . $row->id) ?>" class="btn btn-danger btn-xs" onclick="return confirmation(event)" title="Hapus" data-toggle="tooltip"><i class="fa fa-trash-o"></i></a>
                                    <a href="<?php echo base_url('admin/unit/preview/' . $row->id) ?>" target="_blank" class="btn btn-primary btn-xs" title="Preview" data-toggle="tooltip"><i class="fa fa-external-link"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php $i++;
                    } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted">Belum ada data unit</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Deskripsi -->
<div class="modal fade" id="descriptionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Deskripsi Unit</h4>
            </div>
            <div class="modal-body">
                <div id="description-content"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Show more deskripsi
    function attachDescriptionEvents() {
        $('.show-more').off('click.description').on('click.description', function(e) {
            e.preventDefault();
            var description = $(this).data('description');
            $('#description-content').html(description);
            $('#descriptionModal').modal('show');
        });
    }
    $(document).ready(function() {
        attachDescriptionEvents();
        $('[data-toggle="tooltip"]').tooltip();
        setTimeout(function() {
            $('.alert').slideUp('slow');
        }, 5000);
    });

    // Konfirmasi delete
    function confirmation(event) {
        event.preventDefault();
        var url = event.target.closest('a').href;
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data unit yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>