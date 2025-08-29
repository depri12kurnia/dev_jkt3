<?php
echo form_open(base_url('admin/magazine/proses'));
?>
<p class="btn-group">
    <a href="<?php echo base_url('admin/magazine/tambah') ?>" class="btn btn-success btn-lg">
        <i class="fa fa-plus"></i> Tambah File</a>

    <button class="btn btn-danger" type="submit" name="hapus" onClick="check();">
        <i class="fa fa-trash-o"></i> Hapus
    </button>

</p>
<div class="table-responsive mailbox-messages">
    <table id="datatable" class="display table table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr class="bg-info">
                <th width="5%">No</th>
                <th>Thumb</th>
                <th>Judul Magazine</th>
                <th width="15%">Action</th>
            </tr>
        </thead>
        <tbody>

            <?php $i = 1;
            foreach ($magazine as $magazine) { ?>

                <tr>
                    <td><?php echo $i ?></td>
                    <td>
                        <img data-pdf-thumbnail-file="<?php echo base_url('assets/upload/magazine/' . $magazine->pdfmagazine) ?>" src="pdf.png" class="img img-thumbnail img-responsive" width="250px">
                    </td>
                    <td><?php echo $magazine->judul_magazine ?><br><small>Urutan : <?php echo $magazine->urutan ?></small></td>
                    <td>
                        <div class="btn-group">
                            <a href="<?php echo base_url('admin/magazine/edit/' . $magazine->id_magazine) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
                            <a href="<?php echo base_url('admin/magazine/delete/' . $magazine->id_magazine) ?>" class="btn btn-danger btn-xs" onclick="confirmation(event)"><i class="fa fa-trash-o"></i></a>
                        </div>
                    </td>
                </tr>

            <?php $i++;
            } ?>

        </tbody>
    </table>
</div>
<?php echo form_close(); ?>