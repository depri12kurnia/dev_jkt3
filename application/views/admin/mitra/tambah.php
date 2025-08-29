<?php
// Validasi error
echo validation_errors('<div class="alert alert-warning">', '</div>');

// Error upload
if (isset($error)) {
    echo '<div class="alert alert-warning">';
    echo $error;
    echo '</div>';
}

// Form open
echo form_open_multipart(base_url('admin/mitra/tambah'));
?>

<div class="row">
    <div class="col-md-4">
        <div class="form-group form-group-lg">
            <label>Judul mitra</label>
            <input type="text" name="judul_mitra" class="form-control" placeholder="Judul mitra" required="required" value="<?php echo set_value('judul_mitra') ?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group form-group-lg">
            <label>Link mitra</label>
            <input type="url" name="link_mitra" class="form-control" placeholder="Example : https://example.com" value="<?php echo set_value('link_mitra') ?>">
        </div>
    </div>
    <div class="col-md-4">

    </div>
    <div class="col-md-4">
        <div class="form-group form-group-lg">
            <label>Status mitra</label>
            <select name="status_mitra" class="form-control">
                <option value="Publish">Publikasikan</option>
                <option value="Draft">Simpan sebagai draft</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Urutan</label>
            <input type="number" name="urutan" class="form-control" placeholder="Urutan" value="<?php echo set_value('urutan') ?>">
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <label>Upload gambar</label>
            <input type="file" name="gambar" class="form-control" placeholder="Upload gambar">
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group">
            <label>Isi mitra</label>
            <textarea name="isi" class="form-control" id="isi" placeholder="Isi mitra"><?php echo set_value('isi') ?></textarea>
        </div>

        <div class="form-group text-right">
            <button type="submit" name="submit" class="btn btn-success btn-lg"><i class="fa fa-save"></i> Simpan
                Data</button>
            <input type="reset" name="reset" class="btn btn-default btn-lg" value="Reset">
        </div>

    </div>

    <?php
    // Form close
    echo form_close();
    ?>
    <!-- Modal -->
    <div class="modal fade" id="file" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            </div><!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="gambar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            </div><!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</div>

<script>
    $('body').on('click', '[data-toggle="modal"]', function() {
        $($(this).data("target") + ' .modal-body').load($(this).data("remote"));
    });
</script>