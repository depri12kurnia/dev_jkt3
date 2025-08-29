<?php
$site   = $this->konfigurasi_model->listing();
echo form_open(base_url('admin/maturity/proses'));
?>
<p class="btn-group">
    <a href="<?php echo base_url('admin/maturity/tambah') ?>" class="btn btn-success btn-lg">
        <i class="fa fa-plus"></i> Tambah maturity</a>

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
                <!--<th width="10%">GAMBAR</th>-->
                <th width="35%">JUDUL</th>
                <th width="10%">STATUS</th>
                <th width="10%">AUTHOR</th>
                <th width="15%">ACTION</th>
            </tr>
        </thead>
        <tbody>

            <?php $i = 1;
            foreach ($maturity as $maturity) { ?>

                <tr class="odd gradeX">
                    <td>
                        <div class="mailbox-star text-center">
                            <div class="text-center">
                                <input type="checkbox" class="icheckbox_flat-blue " name="id_maturity[]" value="<?php echo $maturity->id_maturity ?>">
                                <span class="checkmark"></span>
                            </div>
                    </td>
                    <!--<td>-->
                    <!--    <?php if ($maturity->gambar != "") { ?>-->
                    <!--        <img src="<?php echo base_url('assets/upload/maturity/thumbs/' . $maturity->gambar) ?>" class="img img-thumbnail img-responsive" width="60">-->
                    <!--    <?php } else { ?>-->
                    <!--        <img src="<?php echo base_url('assets/upload/maturity/thumbs/' . $site->icon) ?>" class="img img-thumbnail img-responsive" width="60">-->
                    <!--    <?php } ?>-->
                    <!--</td>-->
                    <td>
                        <a href="<?php echo base_url('admin/maturity/edit/' . $maturity->id_maturity) ?>">
                            <?php echo $maturity->judul_maturity ?> <sup><i class="fa fa-pencil"></i></sup>
                        </a>
                        <small>
                            <br>Tgl posting: <?php echo date('d-m-Y', strtotime($maturity->tanggal)) ?>
                        </small>
                    </td>
                    <td><a href="<?php echo base_url('admin/maturity/status_maturity/' . $maturity->status_maturity) ?>"><?php echo $maturity->status_maturity ?><sup><i class="fa fa-link"></i></sup>
                        </a></td>
                    <td>
                        <a href="<?php echo base_url('admin/maturity/author/' . $maturity->id_user) ?>">
                            <?php echo $maturity->nama ?><sup><i class="fa fa-link"></i></sup>
                        </a>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="<?php echo base_url('maturity/read/' . $maturity->slug_maturity) ?>" class="btn btn-success btn-xs" target="_blank"><i class="fa fa-eye"></i></a>

                            <a href="<?php echo base_url('admin/maturity/edit/' . $maturity->id_maturity) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>

                            <a href="<?php echo base_url('admin/maturity/delete/' . $maturity->id_maturity) ?>" class="btn btn-danger btn-xs" onclick="confirmation(event)"><i class="fa fa-trash-o"></i></a>
                        </div>
                    </td>
                </tr>

            <?php $i++;
            } ?>

        </tbody>
    </table>
</div>
<?php echo form_close(); ?>