<?php
echo form_open(base_url('admin/mperiode/proses'));
?>
<p class="btn-group">
    <a href="<?php echo base_url('admin/mperiode/tambah') ?>" class="btn btn-success btn-lg">
        <i class="fa fa-plus"></i> Tambah Periode Monitoring</a>

    <button class="btn btn-danger" type="submit" name="hapus" onClick="check();">
        <i class="fa fa-trash-o"></i> Hapus
    </button>

</p>

<div class="table-responsive mailbox-messages">
    <table id="datatable" class="display table table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr class="bg-info">
                <th width="5%">
                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <button type="button" class="btn btn-default btn-xs checkbox-toggle"><i class="fa fa-square-o"></i>
                        </button>
                    </div>
                </th>
                <th width="12%">Periode</th>
                <th width="19%">Isi Deskripsi</th>
                <th width="17%">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($mperiode as $mperiode) { ?>
                <tr class="odd gradeX">
                    <td>
                        <div class="mailbox-star text-center">
                            <div class="text-center">
                                <input type="checkbox" class="icheckbox_flat-blue " name="id_mperiode[]" value="<?php echo $mperiode->id_mperiode ?>">
                                <span class="checkmark"></span>
                            </div>
                    </td>
                    <td><?php echo $mperiode->periode ?></td>
                    <td><?php echo character_limiter(strip_tags($mperiode->isi), 100); ?></td>
                    <td>

                        <div class="btn-group">
                            <a href="<?php echo base_url('admin/mperiode/edit/' . $mperiode->id_mperiode) ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                            <a href="<?php echo base_url('admin/mperiode/delete/' . $mperiode->id_mperiode) ?>" class="btn btn-danger btn-xs " onclick="confirmation(event)"><i class="fa fa-trash-o"></i></a>
                        </div>

                    </td>
                </tr>
            <?php $i++;
            } ?>
        </tbody>
    </table>
</div>
<?php echo form_close(); ?>