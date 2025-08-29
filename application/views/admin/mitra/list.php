<?php
$site   = $this->konfigurasi_model->listing();
echo form_open(base_url('admin/mitra/proses'));
?>
<p class="btn-group">
    <a href="<?php echo base_url('admin/mitra/tambah') ?>" class="btn btn-success btn-lg">
        <i class="fa fa-plus"></i> Tambah mitra</a>

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
            foreach ($mitra as $mitra) { ?>

                <tr class="odd gradeX">
                    <td>
                        <div class="mailbox-star text-center">
                            <div class="text-center">
                                <input type="checkbox" class="icheckbox_flat-blue " name="id_mitra[]" value="<?php echo $mitra->id_mitra ?>">
                                <span class="checkmark"></span>
                            </div>
                    </td>
                    <td>
                        <?php if ($mitra->gambar != "") { ?>
                            <img src="<?php echo base_url('assets/upload/mitra/thumbs/' . $mitra->gambar) ?>" class="img img-thumbnail img-responsive" width="60">
                        <?php } else { ?>
                            <img src="<?php echo base_url('assets/upload/mitra/thumbs/' . $site->icon) ?>" class="img img-thumbnail img-responsive" width="60">
                        <?php } ?>
                    </td>
                    <td>
                        <a href="<?php echo base_url('admin/mitra/edit/' . $mitra->id_mitra) ?>">
                            <?php echo $mitra->judul_mitra ?> <sup><i class="fa fa-pencil"></i></sup>
                        </a>
                        <small>
                            <br>Link: <?php echo $mitra->link_mitra ?>
                            <br>Urutan: <?php echo $mitra->urutan ?>
                            <br>Tgl posting: <?php echo date('d-m-Y', strtotime($mitra->tanggal)) ?>
                        </small>
                    </td>
                    <td><a href="<?php echo base_url('admin/mitra/status_mitra/' . $mitra->status_mitra) ?>"><?php echo $mitra->status_mitra ?><sup><i class="fa fa-link"></i></sup>
                        </a></td>
                    <td>
                        <a href="<?php echo base_url('admin/mitra/author/' . $mitra->id_user) ?>">
                            <?php echo $mitra->nama ?><sup><i class="fa fa-link"></i></sup>
                        </a>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="<?php echo base_url('mitra/read/' . $mitra->link_mitra) ?>" class="btn btn-success btn-xs" target="_blank"><i class="fa fa-eye"></i></a>

                            <a href="<?php echo base_url('admin/mitra/edit/' . $mitra->id_mitra) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>

                            <a href="<?php echo base_url('admin/mitra/delete/' . $mitra->id_mitra) ?>" class="btn btn-danger btn-xs" onclick="confirmation(event)"><i class="fa fa-trash-o"></i></a>
                        </div>
                    </td>
                </tr>

            <?php $i++;
            } ?>

        </tbody>
    </table>
</div>
<?php echo form_close(); ?>