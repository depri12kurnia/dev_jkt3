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
echo form_open_multipart(base_url('admin/download/tambah'));
?>
<div class="row">
    <div class="col-md-12">

        <div class="form-group form-group-lg">
            <label>Nama file/Nama Peserta Untuk Prestasi</label>
            <input type="text" name="judul_download" class="form-control" placeholder="Nama File/Nama Peserta"
                value="<?php echo set_value('judul_download') ?>">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>Kategori Download</label>
            <select name="id_kategori_download" id="kategori_download" class="form-control">
                <option>No Selected</option>
                <?php foreach ($kategori_download as $row) {?>
                <option value="<?php echo $row->id_kategori_download ?>">
                    <?php echo $row->nama_kategori_download ?></option>
                <?php }?>
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>Jenis Download</label>
            <select name="id_jenis_download" id="jenis_download" class="form-control">
            <option>No Selected</option>
                <?php foreach ($jenis_download as $row) {?>
                <option value="<?php echo $row->id_jenis_download ?>">
                    <?php echo $row->nama_jenis_download ?></option>
                <?php }?>
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>Type Download/Prestasi Nasional-International</label>
            <select name="type_dowload" class="form-control">
                <option value="Download">Download Biasa</option>
                <option value="Panduan">Panduan</option>
                <option value="Nasional">Nasional</option>
                <option value="International">International</option>
            </select>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>Upload file</label>
            <input type="file" name="gambar" class="form-control" required="required" placeholder="Upload gambar">
        </div>
    </div>
    <div class="col-md-4">
        <label>Tanggal Publish</label>
        <input type="text" name="tanggal_post" class="form-control tanggal" placeholder="Tanggal publikasi"
            value="<?php if (isset($_POST['tanggal_post'])) {echo set_value('tanggal_post');} else {echo date('d-m-Y');}?>"
            data-date-format="dd-mm-yyyy">
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Isi/keterangan/Penghargaan</label>
            <textarea name="isi" id="isi" class="form-control"
                placeholder="Isi download"><?php echo set_value('isi') ?></textarea>
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

<script type="text/javascript">
$(document).ready(function() {

    $('#kategori_download').change(function() {
        var id = $(this).val();
        $.ajax({
            url: "<?php echo site_url('download/get_subkategori_download'); ?>",
            method: "POST",
            data: {
                id: id
            },
            async: true,
            dataType: 'json',
            success: function(data) {

                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].id_jenis_download + '>' + data[i].nama_jenis_download + '</option>';
                }
                $('#jenis_download').html(html);

            }
        });
        return false;
    });

});
</script>