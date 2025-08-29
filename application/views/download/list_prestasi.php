<section class="bg-servicesstyle2-section">
    <div class="container">
        <div class="row">
            <div class="our-services-option">
                <div class="section-header">
                    <h2><?php //echo $title 
                        ?> List Prestasi & Penghargaan</h2>
                    <p>Institusi, Mahasiswa, Dosen dan Tenaga Kependidikan</p>
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
                            <h5 class="contact-title">Institusi</h5>
                            <table id="example1" class="display table table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="35%">Institusi</th>
                                        <th width="35%">Penghargaan</th>
                                        <th width="20%">Type</th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($institusi as $ins) { ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $ins->judul_download ?></td>
                                            <td><?php echo $ins->isi ?></td>
                                            <td><?php echo $ins->type_dowload ?></td>
                                            <td>
                                                <a href="<?php echo base_url('unduhan/unduh/' . $ins->id_download) ?>" class="btn btn-primary btn-xs" target="_blank">
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
                            <h5 class="contact-title">Mahasiswa</h5>
                            <table id="example1" class="display table table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="35%">Nama Peserta</th>
                                        <th width="35%">Penghargaan</th>
                                        <th width="20%">Type</th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($mahasiswa as $mahasiswa) { ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $mahasiswa->judul_download ?></td>
                                            <td><?php echo $mahasiswa->isi ?></td>
                                            <td><?php echo $mahasiswa->type_dowload ?></td>
                                            <td>
                                                <a href="<?php echo base_url('unduhan/unduh/' . $mahasiswa->id_download) ?>" class="btn btn-primary btn-xs" target="_blank">
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
                            <h5 class="contact-title">Dosen</h5>
                            <table id="example2" class="display table table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="35%">Nama Peserta</th>
                                        <th width="35%">Penghargaan</th>
                                        <th width="20%">Type</th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($dosen as $dosen) { ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $dosen->judul_download ?></td>
                                            <td><?php echo $dosen->isi ?></td>
                                            <td><?php echo $dosen->type_dowload ?></td>
                                            <td>
                                                <a href="<?php echo base_url('unduhan/unduh/' . $dosen->id_download) ?>" class="btn btn-primary btn-xs" target="_blank">
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
                            <h5 class="contact-title">Tenaga Kependidikan</h5>
                            <table id="example3" class="display table table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="35%">Nama Peserta</th>
                                        <th width="35%">Penghargaan</th>
                                        <th width="20%">Type</th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($tendik as $tendik) { ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $tendik->judul_download ?></td>
                                            <td><?php echo $tendik->isi ?></td>
                                            <td><?php echo $tendik->type_dowload ?></td>
                                            <td>
                                                <a href="<?php echo base_url('unduhan/unduh/' . $tendik->id_download) ?>" class="btn btn-primary btn-xs" target="_blank">
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