<p>
  <?php include('tambah.php') ?>
</p>
<table class="table table-striped table-bordered table-hover" id="datatable">
  <thead>
    <tr>
      <th>#</th>
      <th>Nama Kategori Helpdesk</th>
      <th>Slug</th>
      <th>Urutan</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>

    <?php $i = 1;
    foreach ($kategori_helpdesk as $kategori_helpdesk) { ?>

      <tr class="odd gradeX">
        <td><?php echo $i ?></td>
        <td><?php echo $kategori_helpdesk->nama_kategori_helpdesk ?></td>
        <td><?php echo $kategori_helpdesk->slug_kategori_helpdesk ?></td>
        <td><?php echo $kategori_helpdesk->urutan ?></td>
        <td>

          <a href="<?php echo base_url('admin/kategori_helpdesk/edit/' . $kategori_helpdesk->id_kategori_helpdesk) ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>

          <?php include('delete.php'); ?>

        </td>
      </tr>

    <?php $i++;
    } ?>

  </tbody>
</table>