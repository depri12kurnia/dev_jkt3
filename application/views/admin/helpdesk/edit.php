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
echo form_open_multipart(base_url('admin/helpdesk/edit/' . $helpdesk->id_helpdesk));
?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Kategori helpdesk</label>
            <select name="id_kategori_helpdesk" class="form-control">
                <?php foreach ($kategori_helpdesk as $kategori_helpdesk) { ?>
                    <option value="<?php echo $kategori_helpdesk->id_kategori_helpdesk ?>" <?php if ($helpdesk->id_kategori_helpdesk == $kategori_helpdesk->id_kategori_helpdesk) {
                                                                                                echo "selected";
                                                                                            } ?>>
                        <?php echo $kategori_helpdesk->nama_kategori_helpdesk ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Urutan</label>
            <input type="number" name="urutan" class="form-control" placeholder="Urutan" value="<?php echo $helpdesk->urutan ?>" required>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group form-group-lg">
            <label>Pertanyaan Faq & Helpdesk</label>
            <input type="text" name="pertanyaan" class="form-control" placeholder="Isi Pertanyaan Faq & Helpdesk" value="<?php echo $helpdesk->pertanyaan ?>">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Jawaban Faq & Helpdesk</label>
            <textarea name="jawaban" id="jawaban" class="form-control konten" placeholder="Isi helpdesk"><?php echo $helpdesk->jawaban ?></textarea>
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