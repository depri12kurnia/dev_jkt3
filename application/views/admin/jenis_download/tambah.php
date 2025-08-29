<button class="btn btn-primary" data-toggle="modal" data-target="#Tambah">
    <i class="fa fa-plus"></i> Tambah
</button>
<div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Tambah data?</h4>
            </div>
            <div class="modal-body">

                <?php
// Validasi error
echo validation_errors('<div class="alert alert-warning">', '</div>');

// Form buka
echo form_open(base_url('admin/jenis_download'));
?>
                <div class="form-group">
                    <select name="id_subkategori_download" id="id_subkategori_download" class="form-control">
                        <option>No Selected</option>
                        <?php foreach ($kategori_download as $row) {?>
                        <option value="<?php echo $row->id_kategori_download ?>">
                            <?php echo $row->nama_kategori_download ?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" name="nama_jenis_download" class="form-control" placeholder="Nama jenis download"
                        value="<?php echo set_value('nama_jenis_download') ?>" required>
                </div>

                <div class="form-group">
                    <input type="number" name="urutan" class="form-control" placeholder="Urutan"
                        value="<?php echo set_value('urutan') ?>" required>
                </div>

                <div class="form-group text-center">
                    <input type="submit" name="submit" class="btn btn-success btn-lg" value="Simpan Data">
                </div>
                <div class="clearfix"></div>

                <?php
// Form close
echo form_close();
?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>



            </div>
        </div>
    </div>
</div>