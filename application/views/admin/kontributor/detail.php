
    <section class="content">
        <div class="container-fluid">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Detail Kontributor Berita | Tanggal Kegiatan : <?php echo $kontributor->lp_when ?></h3>
            </div>

            <div class="card-body">
              <div class="row">
              <div class="col-md-6">
                    <div class="form-group form-group-lg">
                        <label>Status Kontributor</label>
                        <input type="text" class="form-control" value="<?php echo $kontributor->lp_options ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-lg">
                        <label>NIP / NIM</label>
                        <input type="text" class="form-control" value="<?php echo $kontributor->lp_id ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-lg">
                        <label>Nama Kontributor</label>
                        <input type="text" class="form-control" value="<?php echo $kontributor->lp_kontributor ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-lg">
                        <label>Unit Kerja</label>
                        <input type="text" class="form-control" value="<?php echo $kontributor->lp_unit ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-lg">
                        <label>Judul dan Tema Kegiatan</label>
                        <input type="text" class="form-control" value="<?php echo $kontributor->lp_what ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-lg">
                        <label>Lokasi / Tempat Kegiatan</label>
                        <input type="text" class="form-control" value="<?php echo $kontributor->lp_where ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-lg">
                        <label>Narasumber, Kriteria Peserta, Jumlah Peserta, Peserta</label>
                        <input type="text" class="form-control" value="<?php echo $kontributor->lp_who ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-lg">
                        <label>Maksud dan Tujuan Kegiatan</label>
                        <input type="text" class="form-control" value="<?php echo $kontributor->lp_why ?>" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group form-group-lg">
                        <label>Proses Pelaksanaan Kegiatan(Susunan Acara)</label>
                        <textarea class="form-control" readonly><?php echo $kontributor->lp_how ?></textarea>
                    </div>
                </div>
                <?php if (!empty($images)): ?>
                    <?php foreach ($images as $image): ?>
                <div class="col-md-6">
                    <img src="<?php echo base_url('assets/upload/kontributor/' . $image['file_name']); ?>" alt="Image" style="width: 300px; height:200px;">
                    <a href="<?=base_url('assets/upload/kontributor/' . $image['file_name']);?>" target="_blank" class="btn btn-warning btn-sm" title="Download"><i class="fa fa-download"></i></a>
                </div>
                <?php endforeach; ?>
                    <?php else: ?>
                        <p>No images found.</p>
                    <?php endif; ?>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="<?=base_url('admin/kontributor/');?>" class="btn btn-danger btn-lg"> <i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
          </div>
          <!-- /.card -->
      </section>