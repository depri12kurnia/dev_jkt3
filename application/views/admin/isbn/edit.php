<script src="<?php echo base_url('assets/ckeditor/ckeditor.js'); ?>"></script>
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
echo form_open_multipart(base_url('admin/isbn/edit/' . $isbn->id_isbn));
?>
<div class="row">
   <div class="col-md-10">
        <div class="form-group form-group-lg">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" placeholder="Judul" required="required" value="<?php echo $isbn->judul; ?>" autofocus>
        </div>
    </div>

    <div class="col-md-10">
        <div class="form-group form-group-lg">
            <label>Penulis</label>
            <input type="text" name="penulis" class="form-control" placeholder="Penulis" required="required" value="<?php echo $isbn->penulis; ?>">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group form-group-lg">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="Proses">Proses</option>
                <option value="Berhasil" <?php if ($isbn->status == "Berhasil") {
                                            echo "selected";
                                        } ?>>Berhasil</option>
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>Attachment</label>
            <input type="file" name="attachment" class="form-control" placeholder="Upload Attachment">
        </div>
    </div>

    <div class="col-md-12">

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" placeholder="Deskripsi"><?php echo $isbn->deskripsi; ?></textarea>
        </div>

        <div class="form-group text-right">
            <button type="submit" name="submit" class="btn btn-success btn-lg">
                <i class="fa fa-save"></i> Simpan Data
            </button>
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