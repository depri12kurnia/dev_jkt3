<section class="bg-servicesstyle2-section">
    <div class="container">
        <div class="row">
            <div class="our-services-option">
                <div class="section-header">
                    <h2><?php //echo $title 
                        ?> List Akuntabilitas</h2>
                    <p>DIPA, Laporan Keuangan, Perencanaan,Perjanjian Kinerja, Lakip/LKj dll</p>
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
                            <h5 class="contact-title">Dipa</h5>
                            <table id="example1" class="display table table-bordered table-hover small" cellspacing="0" width="100%">
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
                                    foreach ($dipa as $dipa) { ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $dipa->judul_download ?></td>
                                            <td><?php echo $dipa->nama_jenis_download ?></td>
                                            <td>
                                                <a href="<?php echo base_url('unduhan/unduh/' . $dipa->id_download) ?>" class="btn btn-primary btn-xs" target="_blank">
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
                            <h5 class="contact-title">Laporan Keuangan</h5>
                            <table id="example2" class="display table table-bordered table-hover small" cellspacing="0" width="100%">
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
                                    foreach ($lapkeu as $lapkeu) { ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $lapkeu->judul_download ?></td>
                                            <td><?php echo $lapkeu->nama_jenis_download ?></td>
                                            <td>
                                                <a href="<?php echo base_url('unduhan/unduh/' . $lapkeu->id_download) ?>" class="btn btn-primary btn-xs" target="_blank">
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
                            <h5 class="contact-title">Perencanaan</h5>
                            <table id="example3" class="display table table-bordered table-hover small" cellspacing="0" width="100%">
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
                                    foreach ($perencanaan as $perencanaan) { ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $perencanaan->judul_download ?></td>
                                            <td><?php echo $perencanaan->nama_jenis_download ?></td>
                                            <td>
                                                <a href="<?php echo base_url('unduhan/unduh/' . $perencanaan->id_download) ?>" class="btn btn-primary btn-xs" target="_blank">
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
                            <h5 class="contact-title">Lakip/LKj</h5>
                            <table id="example4" class="display table table-bordered table-hover small" cellspacing="0" width="100%">
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
                                    foreach ($lakip as $lakip) { ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $lakip->judul_download ?></td>
                                            <td><?php echo $lakip->nama_jenis_download ?></td>
                                            <td>
                                                <a href="<?php echo base_url('unduhan/unduh/' . $lakip->id_download) ?>" class="btn btn-primary btn-xs" target="_blank">
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
                            <h5 class="contact-title">Perjanjian Kinerja</h5>
                            <table id="example5" class="display table table-bordered table-hover small" cellspacing="0" width="100%">
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
                                    foreach ($perjanjiankinerja as $perjanjiankinerja) { ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $perjanjiankinerja->judul_download ?></td>
                                            <td><?php echo $perjanjiankinerja->nama_jenis_download ?></td>
                                            <td>
                                                <a href="<?php echo base_url('unduhan/unduh/' . $perjanjiankinerja->id_download) ?>" class="btn btn-primary btn-xs" target="_blank">
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
                            <h5 class="contact-title">Peraturan-peraturan</h5>
                            <table id="example6" class="display table table-bordered table-hover small" cellspacing="0" width="100%">
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
                                    foreach ($peraturan as $peraturan) { ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $peraturan->judul_download ?></td>
                                            <td><?php echo $peraturan->nama_jenis_download ?></td>
                                            <td>
                                                <a href="<?php echo base_url('unduhan/unduh/' . $peraturan->id_download) ?>" class="btn btn-primary btn-xs" target="_blank">
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
                            <h5 class="contact-title">Lainnya</h5>
                            <table id="example7" class="display table table-bordered table-hover small" cellspacing="0" width="100%">
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
                                    foreach ($lainnya as $lainnya) { ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $lainnya->judul_download ?></td>
                                            <td><?php echo $lainnya->nama_jenis_download ?></td>
                                            <td>
                                                <a href="<?php echo base_url('unduhan/unduh/' . $lainnya->id_download) ?>" class="btn btn-primary btn-xs" target="_blank">
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