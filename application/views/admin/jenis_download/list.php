<p>
    <?php include 'tambah.php' ?>
</p>



<table class="table table-striped table-bordered table-hover" id="datatable">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama kategori download</th>
            <th>Nama jenis download</th>
            <th>Slug</th>
            <th>Urutan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        <?php $i = 1;
        foreach ($jenis_download as $jenis_download) { ?>

            <tr class="odd gradeX">
                <td><?php echo $i ?></td>
                <td><?php echo $jenis_download->nama_kategori_download ?></td>
                <td><?php echo $jenis_download->nama_jenis_download ?></td>
                <td><?php echo $jenis_download->slug_jenis_download ?></td>
                <td><?php echo $jenis_download->urutan ?></td>
                <td>

                    <a href="<?php echo base_url('admin/jenis_download/edit/' . $jenis_download->id_jenis_download) ?>"
                        class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>

                    <?php include 'delete.php'; ?>

                </td>
            </tr>

        <?php $i++;
        } ?>

    </tbody>
</table>