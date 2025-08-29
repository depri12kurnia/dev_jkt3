<?php
// Session
if ($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-success">';
    echo $this->session->flashdata('sukses');
    echo '</div>';
}

// File upload error
if (isset($error)) {
    echo '<div class="alert alert-success">';
    echo $error;
    echo '</div>';
}

// Error
echo validation_errors('<div class="alert alert-success">', '</div>');

echo form_open(base_url('admin/mperiode/tambah'));
?>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Periode</label>
            <input type="text" name="periode" class="form-control" value="<?php echo set_value('periode') ?>" required placeholder="Periode">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Isi</label>
            <textarea name="isi" class="form-control" id="isi" placeholder="Isi berita"><?php echo set_value('isi') ?></textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <input type="submit" name="submit" value="Save" class="btn btn-success btn-lg">
            <input type="reset" name="reset" value="Reset" class="btn btn-primary btn-lg">
        </div>

    </div>

</div>

</form>