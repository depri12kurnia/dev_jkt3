<?php
echo form_open(base_url('admin/helpdesk/proses'));
?>
<p class="btn-group">
    <a href="<?php echo base_url('admin/helpdesk/tambah') ?>" class="btn btn-success btn-lg">
        <i class="fa fa-plus"></i> Tambah File</a>

    <button class="btn btn-danger" type="submit" name="hapus" onClick="check();">
        <i class="fa fa-trash-o"></i> Hapus
    </button>

</p>
<table class="table table-bordered table-hover table-striped" id="datatable">
    <thead class="bordered-darkorange">
        <tr>
            <th width="5%">#</th>
            <th>Pertanyaan</th>
            <th>Jawaban</th>
            <th>Kategori</th>
            <th>Urutan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        <?php $i = 1;
        foreach ($helpdesk as $helpdesk) { ?>

            <tr class="odd gradeX">
                <td><?php echo $i ?></td>
                <td><?php echo $helpdesk->pertanyaan ?></td>
                <td><?php echo $helpdesk->jawaban ?></td>
                <td><?php echo $helpdesk->nama_kategori_helpdesk ?></td>
                <td><?php echo $helpdesk->urutan ?></td>
                <td>

                    <a href="<?php echo base_url('admin/helpdesk/edit/' . $helpdesk->id_helpdesk) ?>"
                        class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>

                    <a href="<?php echo base_url('admin/helpdesk/delete/' . $helpdesk->id_helpdesk) ?>"
                        class="btn btn-danger btn-xs " onclick="confirmation(event)"><i class="fa fa-trash-o"></i></a>

                </td>
            </tr>

        <?php $i++;
        } ?>

    </tbody>
</table>