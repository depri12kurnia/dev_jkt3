<section class="bg-servicesstyle2-section">
    <div class="container">
        <div class="row">
            <div class="our-services-option">
                <div class="section-header">
                    <h2><?php //echo $title 
                        ?> List Standard Pelayanan</h2>
                    <p>Dokumen Intruksi Kerja, Standard Pelayanan dll</p>
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
                        <div class="table-responsive mailbox-messages">
                            <h5 class="contact-title">Intruksi Kerja</h5>
                            <table id="example1" class="display table table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="60%">Dokumen</th>
                                        <th width="30%">Jenis</th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($intruksikerja as $intruksikerja) { ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $intruksikerja->judul_download ?></td>
                                            <td><?php echo $intruksikerja->nama_jenis_download ?></td>
                                            <td>
                                                <a href="<?php echo base_url('unduhan/unduh/' . $intruksikerja->id_download) ?>" class="btn btn-primary btn-xs" target="_blank">
                                                    <i class="fa fa-download"></i> Unduh</a>
                                            </td>
                                        </tr>
                                    <?php $i++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- End .row -->

                    <div class="col-md-12">
                        <div class="table-responsive mailbox-messages">
                            <h5 class="contact-title">Prosedur</h5>
                            <table id="example2" class="display table table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="60%">Dokumen</th>
                                        <th width="30%">Jenis</th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($prosedur as $prosedur) { ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $prosedur->judul_download ?></td>
                                            <td><?php echo $prosedur->nama_jenis_download ?></td>
                                            <td>
                                                <a href="<?php echo base_url('unduhan/unduh/' . $prosedur->id_download) ?>" class="btn btn-primary btn-xs" target="_blank">
                                                    <i class="fa fa-download"></i> Unduh</a>
                                            </td>
                                        </tr>
                                    <?php $i++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- End .row -->

                    <div class="col-md-12">
                        <div class="table-responsive mailbox-messages">
                            <h5 class="contact-title">Standard</h5>
                            <table id="example3" class="display table table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="60%">Dokumen</th>
                                        <th width="30%">Jenis</th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($standard as $standard) { ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $standard->judul_download ?></td>
                                            <td><?php echo $standard->nama_jenis_download ?></td>
                                            <td>
                                                <a href="<?php echo base_url('unduhan/unduh/' . $standard->id_download) ?>" class="btn btn-primary btn-xs" target="_blank">
                                                    <i class="fa fa-download"></i> Unduh</a>
                                            </td>
                                        </tr>
                                    <?php $i++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- End .row -->
                </div>
            </div>
        </div>
    </div>
</section>