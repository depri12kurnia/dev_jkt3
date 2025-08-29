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
echo form_open_multipart(base_url('admin/helpdesk/tambah'));
?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Kategori Helpdesk</label>
            <select name="id_kategori_helpdesk" id="kategori_helpdesk" class="form-control">
                <option>No Selected</option>
                <?php foreach ($kategori_helpdesk as $row) { ?>
                    <option value="<?php echo $row->id_kategori_helpdesk ?>">
                        <?php echo $row->nama_kategori_helpdesk ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Urutan</label>
            <input type="number" name="urutan" class="form-control" placeholder="Urutan" value="<?php echo set_value("urutan"); ?>" required>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group form-group-lg">
            <label>Pertanyaan Faq & Helpdesk</label>
            <input type="text" name="pertanyaan" class="form-control" placeholder="Isi Pertanyaan Faq & Helpdesk" value="<?php echo set_value('pertanyaan') ?>">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Jawaban Faq & Helpdesk</label>
            <textarea name="jawaban" id="jawaban" class="form-control" placeholder="Isi Jawaban Faq & Helpdesk"><?php echo set_value('jawaban') ?></textarea>
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