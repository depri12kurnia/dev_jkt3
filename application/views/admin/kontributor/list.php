<table class="table table-bordered table-hover table-striped" id="datatable">
  <thead class="bordered-darkorange">
    <tr>
      <th>#</th>
      <th>NIP/NIM</th>
      <th>Kontributor</th>
      <th>Unit</th>
      <th>Kegiatan</th>
      <th>Tempat</th>
      <th>Waktu</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1;
    foreach ($kontributor as $row) { ?>

      <tr class="odd gradeX">
        <td><?php echo $i ?></td>
        <td><?php echo $row->lp_id ?>
          <small>
            <br>Status: <?php echo $row->lp_options ?>
          </small>
        </td>
        <td><?php echo $row->lp_kontributor ?>
          <small>
            <br>Unit: <?php echo $row->lp_unit ?>
          </small>
        </td>
        <td><?php echo $row->lp_unit ?></td>
        <td><?php echo $row->lp_what ?></td>
        <td><?php echo $row->lp_where ?></td>
        <td><?php echo $row->lp_when ?></td>
        <td><?php echo $row->lp_status ?></td>
        <td>
          <a href="<?php echo base_url('admin/kontributor/detail/' . $row->id_kontributor) ?>" class="btn btn-primary btn-xs" title="Detail"><i class="fa fa-eye"></i></a>
          <!--<a href="<?php echo base_url('admin/kontributor/delete/' . $row->id_kontributor) ?>" class="btn btn-danger btn-xs" title="Hapus" onclick="confirmation(event)"><i class="fa fa-trash-o"></i></a>-->
        </td>
      </tr>

    <?php $i++;
    } ?>

  </tbody>
</table>