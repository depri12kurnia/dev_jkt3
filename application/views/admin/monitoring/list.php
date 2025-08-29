<p>
    <?php include('tambah.php') ?>
</p>



<table class="table table-bordered table-hover table-striped" id="datatable">
    <thead class="bordered-darkorange">
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jabatan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        <?php $i = 1;
        foreach ($monitoring as $mn) { ?>

            <tr class="odd gradeX">
                <td><?php echo $i ?></td>
                <td><?php echo $mn->nama ?></td>
                <td><?php echo $mn->email ?></td>
                <td><?php echo $mn->jabatan ?></td>
                <td>
                    <a href="<?php echo base_url('admin/monitoring/verify/' . $mn->id_monitoring) ?>" class="btn btn-warning btn-xs"><i class="fa fa-envelope"></i></a>

                    <a href="<?php echo base_url('admin/monitoring/edit/' . $mn->id_monitoring) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>

                    <a href="<?php echo base_url('admin/monitoring/delete/' . $mn->id_monitoring) ?>" class="btn btn-danger btn-xs " onclick="confirmation(event)"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>

        <?php $i++;
        } ?>

    </tbody>
</table>