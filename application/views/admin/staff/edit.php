<?php echo form_open_multipart(base_url('admin/staff/edit/'.$staff->id_staff),'id="tambah"') ?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group has-error">
            <label class="text-danger">Nama staff <span class="text-danger">*</span></label>
            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama lengkap"
                value="<?php echo $staff->nama ?>">
        </div>

        <div class="form-group">
            <label>Jabatan</label>
            <input type="text" name="jabatan" class="form-control" placeholder="Jabatan"
                value="<?php echo $staff->jabatan ?>">
        </div>

        <div class="form-group">
            <label>Email staff</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                value="<?php echo $staff->email ?>">
        </div>

        <div class="form-group">
            <label>Facebook</label>
            <input type="text" name="facebook" id="facebook" class="form-control"
                placeholder="http://facebook.com/namamu" value="<?php echo $staff->facebook ?>">
        </div>
        <div class="form-group">
            <label>Instagram</label>
            <input type="text" name="instagram" id="instagram" class="form-control"
                placeholder="http://instagram.com/namamu" value="<?php echo $staff->instagram ?>">
        </div>

    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Twitter</label>
            <input type="text" name="twitter" id="twitter" class="form-control" placeholder="http://twitter.com/namamu"
                value="<?php echo $staff->twitter ?>">
        </div>
        <div class="form-group">
            <label>Youtube</label>
            <input type="text" name="youtube" id="youtube" class="form-control" placeholder="http://youtube.com/namamu"
                value="<?php echo $staff->youtube ?>">
        </div>
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label>Urutan</label>
                    <input type="number" name="urutan" class="form-control" placeholder="Urutan"
                        value="<?php echo $staff->urutan ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Tampilkan di website?</label>
                    <select name="status_staff" class="form-control">
                        <option value="No">No</option>
                        <option value="Yes" <?php if($staff->status_staff=="Yes") { echo "selected"; } ?>>Yes</option>
                    </select>
                </div>
            </div>

        </div>



        <div class="form-group">
            <label>Kata Kunci pencarian di Google</label>
            <textarea name="keywords" id="keywords" class="form-control"
                placeholder="Keywords"><?php echo $staff->keywords ?></textarea>
        </div>

        <div class="form-group">
            <label>Upload Foto/Logo</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="gambar" id="gambar" class="custom-file-input" placeholder="gambar"
                        value="<?php echo $staff->gambar ?>">
                    <label class="custom-file-label" for="exampleInputFile">Upload Foto/Logo</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-success btn-lg"><i class="fa fa-save"></i> Simpan
                Data</button>
            <button type="reset" name="reset" class="btn btn-info btn-lg"><i class="fa fa-cut"></i> Reset</button>

        </div>


    </div>
</div>

<?php echo form_close(); ?>

<script>
$().ready(function() {
    // validate signup form on keyup and submit
    $("#tambah").validate({
        rules: {
            nama: {
                required: true,
                minlength: 4
            },
            email: {
                required: false,
                email: true
            },
        },
        messages: {
            nama: {
                required: "Isi nama dengan lengkap",
                minlength: "Nama minimal 4 karakter"
            },
            email: "Masukkan alamat email",
        }
    });
});
</script>