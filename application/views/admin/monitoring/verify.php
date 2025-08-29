  <?php
  // Validasi error
  echo validation_errors('<div class="alert alert-warning">', '</div>');

  // Form buka 
  echo form_open(base_url('admin/monitoring/send/' . $monitoring->id_monitoring));
  ?>


  <div class="form-group">
    <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo $monitoring->nama ?>">
  </div>

  <div class="form-group">
    <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $monitoring->email ?>">
  </div>

  <div class="form-group">
    <select name="jabatan" class="form-control">
      <option value="Ketua Jurusan Keperawatan" <?php if ($monitoring->jabatan == "Ketua Jurusan Keperawatan") {
                                                  echo "selected";
                                                } ?>>Ketua Jurusan Keperawatan</option>
      <option value="Ketua Jurusan Kebidanan" <?php if ($monitoring->jabatan == "Ketua Jurusan Kebidanan") {
                                                echo "selected";
                                              } ?>>Ketua Jurusan Kebidanan</option>
      <option value="Ketua Jurusan Fisioterapi" <?php if ($monitoring->jabatan == "Ketua Jurusan Fisioterapi") {
                                                  echo "selected";
                                                } ?>>Ketua Jurusan Kebidanan</option>
      <option value="Ketua Jurusan TLM" <?php if ($monitoring->jabatan == "Ketua Jurusan TLM") {
                                          echo "selected";
                                        } ?>>Ketua Jurusan Kebidanan</option>
      <option value="Sekertaris Jurusan Keperawatan" <?php if ($monitoring->jabatan == "Sekertaris Jurusan Keperawatan") {
                                                        echo "selected";
                                                      } ?>>Sekertaris Jurusan Keperawatan</option>
      <option value="Sekertaris Jurusan Kebidanan" <?php if ($monitoring->jabatan == "Sekertaris Jurusan Kebidanan") {
                                                      echo "selected";
                                                    } ?>>Sekertaris Jurusan Kebidanan</option>
      <option value="Sekertaris Jurusan Fisioterapi" <?php if ($monitoring->jabatan == "Sekertaris Jurusan Fisioterapi") {
                                                        echo "selected";
                                                      } ?>>Sekertaris Jurusan Fisioterapi</option>
      <option value="Sekertaris Jurusan TLM" <?php if ($monitoring->jabatan == "Sekertaris Jurusan TLM") {
                                                echo "selected";
                                              } ?>>Sekertaris Jurusan TLM</option>
    </select>
  </div>
  <div class="form-group">
    <select name="periode" id="periode" class="form-control">
      <option>No Selected</option>
      <?php foreach ($periode as $row) { ?>
        <option value="<?php echo $row->id_mperiode ?>">
          <?php echo $row->periode ?></option>
      <?php } ?>
    </select>
  </div>

  <div class="form-group">
    <label></label>
    <textarea name="isi" class="form-control" id="isi" placeholder="Isi berita"></textarea>
  </div>

  <div class="form-group text-center">
    <input type="submit" name="submit" class="btn btn-success btn-lg" value="Send Notify">
  </div>
  <div class="clearfix"></div>

  <?php
  // Form close 
  echo form_close();
  ?>