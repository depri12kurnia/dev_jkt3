
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Backup Data</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Backup Database</label>
                            <p>Fitur Backup Database</p>
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <a href="<?php echo base_url('admin/backups/backup_db') ?>" class="btn btn-primary btn-lg" title="Backup Database"><i class="fa fa-database"></i> Backup Database</a>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Backup Files Assets</label>
                            <p>Fitur Backup Folder Assets Dokumen</p>
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <a href="<?php echo base_url('admin/backups/backup_files') ?>" class="btn btn-primary btn-lg" title="Backup Files"><i class="fa fa-file"></i> Backup Dokumen</a>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
</section>