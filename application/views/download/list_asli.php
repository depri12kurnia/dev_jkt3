<section class="bg-servicesstyle2-section">
    <div class="container">
        <div class="row">
            <div class="our-services-option">
                <div class="section-header">
                    <h2><?php //echo $title ?> DOWNLOAD</h2>
                </div>
                <!-- .section-header -->
                <div class="row">

                    <style type="text/css" media="screen">
                    th,
                    td {
                        text-align: left !important;
                        vertical-align: top !important;
                        padding: 6px 12px !important;
                        color: #000 !important;
                    }
                    </style>

                    <div class="col-md-12">
                        <!-- Custom Filter -->
                        <form id="#" class="contact-form">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nameId" name="nama"
                                            placeholder="Full Name">
                                    </div>
                                    <!-- .form-group -->
                                </div>
                                <!-- .col-md-6 -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="emailId" name="email"
                                            placeholder="Informasi Publik/Layanan Publik">
                                    </div>
                                </div>
                                <!-- .col-md-6 -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="emailId" name="email"
                                            placeholder="Email Address">
                                    </div>
                                </div>
                                <!-- .col-md-6 -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-default">Filter</button>
                                    </div>
                                </div>
                                <div class="col-md-2">

                                </div>
                                <!-- .col-md-6 -->
                            </div>
                            <!-- .row -->

                        </form>
                        <!-- End Custom Filter -->
                        <div class="table-responsive mailbox-messages">
                            <table id="example1" class="display table table-bordered table-hover" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Dokumen</th>
                                        <th>Layanan</th>
                                        <th>Kategori</th>
                                        <th>Jenis</th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($download as $download) { ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $download->judul_download ?></td>
                                        <td><?php echo $download->isi ?></td>
                                        <td>
                                            <a href="<?php echo base_url('download/unduh/'.$download->id_download) ?>"
                                                class="btn btn-primary btn-xs" target="_blank">
                                                <i class="fa fa-download"></i> Unduh</a>
                                        </td>
                                    </tr>
                                    <?php $i++; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- End .row -->
                </div>
            </div>
        </div>
    </div>
</section>