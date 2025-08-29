<?php
$site   = $this->konfigurasi_model->listing();
echo form_open(base_url('admin/capaian/proses'));
?>
<p class="btn-group">
    <a href="<?php echo base_url('admin/capaian/tambah') ?>" class="btn btn-success btn-lg">
        <i class="fa fa-plus"></i> Tambah capaian</a>

    <button class="btn btn-warning" type="submit" name="draft" onClick="check();">
        <i class="fa fa-times"></i> Jangan Publikasikan
    </button>

    <button class="btn btn-primary" type="submit" name="publish" onClick="check();">
        <i class="fa fa-check"></i> Publikasikan
    </button>

    <button class="btn btn-danger" type="submit" name="hapus" onClick="check();">
        <i class="fa fa-trash-o"></i> Hapus
    </button>
    <?php
    $url_navigasi = $this->uri->segment(2);
    if ($this->uri->segment(3) != "") {
    ?>
        <a href="<?php echo base_url('admin/' . $url_navigasi) ?>" class="btn btn-primary">
            <i class="fa fa-backward"></i> Kembali</a>
    <?php } ?>
</p>
<div class="table-responsive mailbox-messages">
    <table id="datatable" class="display table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th width="5%">
                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <button type="button" class="btn btn-default btn-xs checkbox-toggle"><i class="fa fa-square-o"></i>
                        </button>
                    </div>
                </th>
                <th width="10%">GAMBAR</th>
                <th width="35%">JUDUL</th>
                <th width="10%">STATUS</th>
                <th width="10%">AUTHOR</th>
                <th width="15%">ACTION</th>
            </tr>
        </thead>
        <tbody>

            <?php $i = 1;
            foreach ($capaian as $capaian) { ?>

                <tr class="odd gradeX">
                    <td>
                        <div class="mailbox-star text-center">
                            <div class="text-center">
                                <input type="checkbox" class="icheckbox_flat-blue " name="id_capaian[]" value="<?php echo $capaian->id_capaian ?>">
                                <span class="checkmark"></span>
                            </div>
                    </td>
                    <td>
                        <?php if ($capaian->gambar != "") { ?>
                            <img src="<?php echo base_url('assets/upload/capaian/thumbs/' . $capaian->gambar) ?>" class="img img-thumbnail img-responsive" width="60">
                        <?php } else { ?>
                            <img src="<?php echo base_url('assets/upload/capaian/thumbs/' . $site->icon) ?>" class="img img-thumbnail img-responsive" width="60">
                        <?php } ?>
                    </td>
                    <td>
                        <a href="<?php echo base_url('admin/capaian/edit/' . $capaian->id_capaian) ?>">
                            <?php echo $capaian->judul_capaian ?> <sup><i class="fa fa-pencil"></i></sup>
                        </a>
                        <small>
                            <br>Tgl posting: <?php echo date('d-m-Y', strtotime($capaian->tanggal)) ?>
                        </small>
                    </td>
                    <td><a href="<?php echo base_url('admin/capaian/status_capaian/' . $capaian->status_capaian) ?>"><?php echo $capaian->status_capaian ?><sup><i class="fa fa-link"></i></sup>
                        </a></td>
                    <td>
                        <a href="<?php echo base_url('admin/capaian/author/' . $capaian->id_user) ?>">
                            <?php echo $capaian->nama ?><sup><i class="fa fa-link"></i></sup>
                        </a>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="<?php echo base_url('capaian/read/' . $capaian->slug_capaian) ?>" class="btn btn-success btn-xs" target="_blank"><i class="fa fa-eye"></i></a>

                            <a href="<?php echo base_url('admin/capaian/edit/' . $capaian->id_capaian) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>

                            <a href="<?php echo base_url('admin/capaian/delete/' . $capaian->id_capaian) ?>" class="btn btn-danger btn-xs" onclick="confirmation(event)"><i class="fa fa-trash-o"></i></a>
                        </div>
                    </td>
                </tr>

            <?php $i++;
            } ?>

        </tbody>
    </table>
</div>
<?php echo form_close(); ?>