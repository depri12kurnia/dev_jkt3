<?php echo form_open_multipart(base_url('admin/staff'), 'id="tambah"') ?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Staff Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group has-error">
                            <label class="text-danger">Nama staff <span class="text-danger">*</span></label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama lengkap"
                                value="<?php echo set_value('nama') ?>">
                        </div>

                        <div class="form-group">
                            <label>Jabatan</label>
                            <input type="text" name="jabatan" class="form-control" placeholder="Jabatan"
                                value="<?php echo set_value('jabatan') ?>">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="contoh@gmail.com" value="<?php echo set_value('email') ?>">
                        </div>

                        <div class="form-group">
                            <label>Facebook</label>
                            <input type="text" name="facebook" id="facebook" class="form-control"
                                placeholder="http://facebook.com/namakamu" value="<?php echo set_value('facebook') ?>">
                        </div>
                        <div class="form-group">
                            <label>Instagram</label>
                            <input type="text" name="instagram" id="instagram" class="form-control"
                                placeholder="http://instagram.com/namakamu"
                                value="<?php echo set_value('instagram') ?>">
                        </div>
                        <div class="form-group">
                            <label>Twitter</label>
                            <input type="text" name="twitter" id="twitter" class="form-control"
                                placeholder="http://twitter.com/namakamu" value="<?php echo set_value('twitter') ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Youtube</label>
                            <input type="text" name="youtube" id="youtube" class="form-control"
                                placeholder="http://youtube.com/namakamu" value="<?php echo set_value('youtube') ?>">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Urutan</label>
                                    <input type="number" name="urutan" class="form-control" placeholder="Urutan"
                                        value="<?php echo set_value('urutan') ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tampilkan di website?</label>
                                    <select name="status_staff" class="form-control">
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label>Kata Kunci pencarian di Google</label>
                            <input type="text" name="keywords" id="keywords" class="form-control" placeholder="Keywords"
                                value="<?php echo set_value('keywords') ?>">
                        </div>

                        <div class="form-group">
                            <label>Upload Foto/Logo</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="gambar" id="gambar" class="custom-file-input"
                                        placeholder="gambar" value="<?php echo set_value('gambar') ?>">
                                    <label class="custom-file-label" for="exampleInputFile">Upload Foto/Logo</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group btn-group">
                            <button type="submit" name="submit" class="btn btn-success btn-lg"><i
                                    class="fa fa-save"></i> Simpan Data</button>
                            <button type="reset" name="reset" class="btn btn-info btn-lg"><i class="fa fa-cut"></i>
                                Reset</button>
                            <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal"><i
                                    class="fa fa-times"></i> Close</button>
                        </div>


                    </div>
                </div>
            </div>
            <div class="modal-footer">


            </div>
        </div>
    </div>
</div>


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
<?php echo form_close(); ?>