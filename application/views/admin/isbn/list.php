<?php
$site   = $this->konfigurasi_model->listing();
echo form_open(base_url('admin/isbn/proses'));
?>
<p class="btn-group">
    <a href="<?php echo base_url('admin/isbn/tambah') ?>" class="btn btn-success btn-md">
        <i class="fa fa-plus"></i> Tambah ISBN</a>

    <?php
    $url_navigasi = $this->uri->segment(2);
    if ($this->uri->segment(3) != "") {
    ?>
        <a href="<?php echo base_url('admin/' . $url_navigasi) ?>" class="btn btn-primary">
            <i class="fa fa-backward"></i> Kembali</a>
    <?php } ?>
</p>
<div class="table-responsive mailbox-messages small">
    <table id="datatable" class="display table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="15%">Judul</th>
                <th width="15%">Penulis</th>
                <th width="35%">Deskripsi</th>
                <th width="10%">Status</th>
                <th width="15%">Action</th>
            </tr>
        </thead>
        <tbody>

            <?php $i = 1;
            foreach ($isbn as $isbn) { ?>

                <tr class="odd gradeX">
                    <td><?php echo $i ?></td>
                    <td><?php echo $isbn->judul ?><br>Link : <small><?php echo base_url('isbn/view/' . $isbn->slug) ?></small></td>
                    <td><?php echo $isbn->penulis ?></td>
                    <td><?php echo character_limiter(strip_tags($isbn->deskripsi), 130); ?></td>
                    <td><?php echo $isbn->status ?></td>
                    <td>
                        <div class="btn-group">
                            <a href="<?php echo base_url('isbn') ?>" class="btn btn-default btn-xs" target="_blank"><i class="fa fa-list"></i></a>

                            <a href="<?php echo base_url('isbn/view/' . $isbn->slug . '/' . $isbn->id_isbn) ?>" class="btn btn-success btn-xs" target="_blank"><i class="fa fa-eye"></i></a>

                            <a href="<?php echo base_url('admin/isbn/edit/' . $isbn->id_isbn) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>

                            <a href="<?php echo base_url('admin/isbn/delete/' . $isbn->id_isbn) ?>" class="btn btn-danger btn-xs" onclick="confirmation(event)"><i class="fa fa-trash-o"></i></a>
                        </div>
                    </td>
                </tr>

            <?php $i++;
            } ?>

        </tbody>
    </table>
</div>
<?php echo form_close(); ?>