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
                echo form_open(base_url('admin/monitoring'));
                ?>

                <div class="form-group">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="<?php echo set_value('nama') ?>" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email') ?>" required>
                </div>
                <div class="form-group">
                    <select name="jabatan" class="form-control">
                        <option value="Kepala Subbagian Administrasi Akademik">Kepala Subbagian Administrasi Akademik</option>
                        <option value="Koordinator Monitoring dan Evaluasi Pendidikan">Koordinator Monitoring dan Evaluasi Pendidikan</option>
                        <option value="Ketua Jurusan Keperawatan">Ketua Jurusan Keperawatan</option>
                        <option value="Ketua Jurusan Kebidanan">Ketua Jurusan Kebidanan</option>
                        <option value="Ketua Jurusan Fisioterapi">Ketua Jurusan Kebidanan</option>
                        <option value="Ketua Jurusan TLM">Ketua Jurusan Kebidanan</option>
                        <option value="Sekertaris Jurusan Keperawatan">Sekertaris Jurusan Keperawatan</option>
                        <option value="Sekertaris Jurusan Kebidanan">Sekertaris Jurusan Kebidanan</option>
                        <option value="Sekertaris Jurusan Fisioterapi">Sekertaris Jurusan Fisioterapi</option>
                        <option value="Sekertaris Jurusan TLM">Sekertaris Jurusan TLM</option>
                    </select>
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