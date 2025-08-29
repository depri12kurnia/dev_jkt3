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
echo form_open_multipart(base_url('admin/download/edit/' . $download->id_download));
?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group form-group-lg">
            <label>Nama file/Nama Peserta Untuk Prestasi</label>
            <input type="text" name="judul_download" class="form-control" placeholder="Nama File/Nama Peserta"
                value="<?php echo $download->judul_download ?>">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>Kategori Download</label>
            <select name="id_kategori_download" class="form-control">
                <?php foreach ($kategori_download as $kategori_download) {?>
                <option value="<?php echo $kategori_download->id_kategori_download ?>"
                    <?php if ($download->id_kategori_download == $kategori_download->id_kategori_download) {echo "selected";}?>>
                    <?php echo $kategori_download->nama_kategori_download ?></option>
                <?php }?>
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>Jenis Download</label>
            <select name="id_jenis_download" class="form-control">
                <?php foreach ($jenis_download as $jenis_download) {?>
                <option value="<?php echo $jenis_download->id_jenis_download ?>"
                    <?php if ($download->id_jenis_download == $jenis_download->id_jenis_download) {echo "selected";}?>>
                    <?php echo $jenis_download->nama_jenis_download ?></option>
                <?php }?>
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>Type Download/Prestasi Nasional-International</label>
            <select name="type_dowload" class="form-control">
                <option value="<?php echo $download->type_dowload ?>"><?php echo $download->type_dowload ?></option>
                <option value="Download">Download Biasa</option>
                <option value="Panduan">Panduan</option>
                <option value="Nasional">Nasional</option>
                <option value="Internasional">International</option>
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>Upload File</label>
            <input type="file" name="gambar" class="form-control" placeholder="Upload gambar">
        </div>
    </div>
    <div class="col-md-6">
        <label>Tanggal Publish</label>
        <input type="text" name="tanggal_post" class="form-control tanggal" placeholder="Tanggal publikasi"
            value="<?php if (isset($_POST['tanggal_post'])) {echo set_value('tanggal_post');} else {echo date('Y-m-d', strtotime($download->tanggal_post));}?>"
            data-date-format="dd-mm-yyyy">
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Isi/keterangan/Penghargaan</label>
            <textarea name="isi" id="isi" class="form-control konten"
                placeholder="Isi download"><?php echo $download->isi ?></textarea>
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