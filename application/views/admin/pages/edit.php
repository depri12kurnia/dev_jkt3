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
echo form_open_multipart(base_url('admin/pages/edit/' . $pages->id_pages));
?>
<div class="row">
    <div class="col-md-8">

        <div class="form-group form-group-lg">
            <label>Judul Pages</label>
            <input type="text" name="judul_pages" class="form-control" placeholder="Judul Pages" required="required" value="<?php echo $pages->judul_pages ?>">
        </div>

    </div>

    <div class="col-md-4">

        <div class="form-group form-group-lg">
            <label>Icon Pages</label>
            <input type="text" name="icon" class="form-control" placeholder="Icon Pages" value="<?php echo $pages->icon ?>">
        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group form-group-lg">

            <div class="row">
                <div class="col-md-6">
                    <label>Tanggal Publish</label>
                    <input type="text" name="tanggal_publish" class="form-control tanggal" placeholder="Tanggal publikasi" value="<?php if (isset($_POST['tanggal_publish'])) {
                                                                                                                                        echo set_value('tanggal_publish');
                                                                                                                                    } else {
                                                                                                                                        echo date('Y-m-d', strtotime($pages->tanggal_publish));
                                                                                                                                    } ?>" data-date-format="dd-mm-yyyy">
                </div>
                <div class="col-md-6">
                    <label>Jam Publish</label>
                    <input type="text" name="jam_publish" class="form-control time-picker" placeholder="Jam publikasi" value="<?php if (isset($_POST['jam_publish'])) {
                                                                                                                                    echo set_value('jam_publish');
                                                                                                                                } else {
                                                                                                                                    echo date('H:i:s', strtotime($pages->tanggal_publish));
                                                                                                                                } ?>">
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group form-group-lg">
            <label>Status Pages</label>
            <select name="status_pages" class="form-control">
                <option value="Publish">Publikasikan</option>
                <option value="Draft" <?php if ($pages->status_pages == "Draft") {
                                            echo "selected";
                                        } ?>>Simpan sebagai
                    draft</option>
            </select>

        </div>
    </div>

    <div class="col-md-3">

        <div class="form-group">
            <label>Jenis Pages</label>
            <select name="jenis_pages" class="form-control">
                <option value="">- Pilih Jenis Pages -</option>
                <option value="Profil" <?php if ($pages->jenis_pages == "Profil") {
                                            echo "selected";
                                        } ?>>Profil</option>
                <option value="Pendidikan" <?php if ($pages->jenis_pages == "Pendidikan") {
                                                echo "selected";
                                            } ?>>Pendidikan
                </option>
                <option value="Alumni" <?php if ($pages->jenis_pages == "Alumni") {
                                            echo "selected";
                                        } ?>>Alumni
                </option>
                <option value="Layanan" <?php if ($pages->jenis_pages == "Layanan") {
                                            echo "selected";
                                        } ?>>Layanan
                </option>
                <option value="spi" <?php if ($pages->jenis_pages == "spi") {
                                            echo "selected";
                                        } ?>>SPI
                </option>
            </select>

        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>Upload Gambar</label>
            <input type="file" name="gambar" class="form-control" placeholder="Upload gambar">
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>Urutan</label>
            <input type="number" name="urutan" class="form-control" placeholder="Urutan" value="<?php echo $pages->urutan ?>">
        </div>
    </div>

    <div class="col-md-12">

        <div class="form-group">
            <label>Keywords dan Ringkasan (untuk pencarian Google)</label>
            <textarea name="keywords" class="form-control" placeholder="Keywords (untuk pencarian Google)"><?php echo $pages->keywords ?></textarea>
        </div>

        <div class="form-group">
            <label>Isi pages</label>
            <textarea name="isi" class="form-control" id="isi" placeholder="Isi pages" placeholder="Isi pages"><?php echo $pages->isi ?></textarea>
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