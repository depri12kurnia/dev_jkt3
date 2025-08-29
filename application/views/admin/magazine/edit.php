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
echo form_open_multipart(base_url('admin/magazine/edit/' . $magazine->id_magazine));
?>
<div class="row">
    <div class="col-md-12">

        <div class="form-group form-group-lg">
            <label>Nama Program Studi</label>
            <input type="text" name="judul_magazine" class="form-control" placeholder="Masukan Nama Program Studi" value="<?php echo $magazine->judul_magazine ?>">
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>Upload Gambar</label>
            <input type="file" name="gambar" class="form-control" required="required" placeholder="Upload gambar">
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>Urutan</label>
            <input type="number" name="urutan" class="form-control" value="<?php echo $magazine->urutan ?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Status</label>
            <select name="status_magazine" id="status_magazine" class="form-control">
                <option value="<?php echo $magazine->status_magazine ?>"><?php echo $magazine->status_magazine ?></option>
                <option>No Selected</option>
                <option value="Publish">Publish</option>
                <option value="Draft">Draft</option>
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Keywords dan Ringkasan (untuk pencarian Google)</label>
            <textarea name="keywords" class="form-control" placeholder="Keywords (untuk pencarian Google)"><?php echo $magazine->keywords ?></textarea>
        </div>
        <div class="form-group">
            <label>Isi Deskripsi Program Studi</label>
            <textarea name="isi" id="isi" class="form-control" placeholder="Isi magazine"><?php echo $magazine->isi ?></textarea>
        </div>

        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-success btn-lg" value="Simpan Data">
            <input type="reset" name="reset" class="btn btn-default btn-lg" value="Reset">
        </div>

    </div>
</div>
<?php
// Form close
echo form_close();
?>