<section class="bg-servicesstyle2-section">
    <div class="container">
        <div class="row">
            <div class="our-services-option">
                <div class="section-header">
                    <h2><?php //echo $title 
                        ?> List Dokumen Akademik</h2>
                    <p>SKL, KRS, Pengajuan Surat Keterangan Pengganti dll </p>
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
                            <h5 class="contact-title">Layanan Akademik</h5>
                            <!-- Custom Filter -->
                            <!-- End Custom Filter -->
                            <table id="dokumen" class="display table table-bordered table-hover" cellspacing="0" width="100%">
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
                                    foreach ($dokumen as $dokumen) { ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $dokumen->judul_download ?></td>
                                            <td><?php echo $dokumen->nama_jenis_download ?></td>
                                            <td>
                                                <a href="<?php echo base_url('unduhan/unduh/' . $dokumen->id_download) ?>" class="btn btn-primary btn-xs" target="_blank" title="Unduh <?php echo $dokumen->judul_download ?>">
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