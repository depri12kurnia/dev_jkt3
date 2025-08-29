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
echo form_open_multipart(base_url('admin/magazine/tambah'));
?>
<div class="row">
    <div class="col-md-12">

        <div class="form-group form-group-lg">
            <label>Judul Magazine</label>
            <input type="text" name="judul_magazine" class="form-control" placeholder="Masukan Judul Magazine Disini" value="<?php echo set_value('judul_magazine') ?>">
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>Upload Pdf</label>
            <input type="file" name="pdfmagazine" class="form-control" required="required" placeholder="Upload Pdf">
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>Urutan</label>
            <input type="number" name="urutan" class="form-control" value="<?php echo set_value('urutan') ?>">
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>Status</label>
            <select name="status_magazine" id="status_magazine" class="form-control">
                <option>No Selected</option>
                <option value="Publish">Publish</option>
                <option value="Draft">Draft</option>
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Keywords dan Ringkasan (untuk pencarian Google)</label>
            <textarea name="keywords" class="form-control" placeholder="Keywords (untuk pencarian Google)"><?php echo set_value('keywords') ?></textarea>
        </div>
        <div class="form-group">
            <label>Isi Deskripsi Majalah</label>
            <textarea name="isi" id="isi" class="form-control" placeholder="Isi magazine"><?php echo set_value('isi') ?></textarea>
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

        $('#jurusan').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?php echo site_url('magazine/jurusan'); ?>",
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
                        html += '<option value=' + data[i].id_jurusan + '>' + data[i].nama_jurusan + '</option>';
                    }
                    $('#jurusan').html(html);

                }
            });
            return false;
        });

    });
</script>