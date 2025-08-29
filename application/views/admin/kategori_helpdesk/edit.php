  <?php
  // Validasi error
  echo validation_errors('<div class="alert alert-warning">', '</div>');

  // Form buka 
  echo form_open(base_url('admin/kategori_helpdesk/edit/' . $kategori_helpdesk->id_kategori_helpdesk));
  ?>

  <div class="form-group">
    <input type="text" name="nama_kategori_helpdesk" class="form-control" placeholder="Nama kategori helpdesk" value="<?php echo $kategori_helpdesk->nama_kategori_helpdesk ?>" required>
  </div>

  <div class="form-group">
    <input type="number" name="urutan" class="form-control" placeholder="Urutan" value="<?php echo $kategori_helpdesk->urutan ?>" required>
  </div>

  <div class="form-group text-center">
    <input type="submit" name="submit" class="btn btn-success btn-lg" value="Simpan Data">
  </div>
  <div class="clearfix"></div>

  <?php
  // Form close 
  echo form_close();
  ?>