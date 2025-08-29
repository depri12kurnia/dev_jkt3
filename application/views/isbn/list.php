<section class="bg-servicesstyle2-section">
    <div class="container">
        <div class="row">
            <div class="our-services-option">
                <div class="section-header">
                    <h2>List Pengajuan ISBN</h2>
                    <p></p>
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
                            <!-- <h5 class="contact-title">List</h5> -->
                            <!-- Custom Filter -->
                            <!-- End Custom Filter -->
                            <table id="dokumen" class="display table table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="15%">Judul</th>
                                        <th width="15%">Penulis</th>
                                        <th width="35%">Deskripsi</th>
                                        <th width="10%">Status</th>
                                        <th width="10%">View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php $i = 1;
                                    foreach ($isbn as $isbn) { ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $isbn->judul ?></td>
                                            <td><?php echo $isbn->penulis ?></td>
                                            <td><?php echo character_limiter(strip_tags($isbn->deskripsi), 130); ?></td>
                                            <td><?php echo $isbn->status ?></td>
                                            <td>
                                                <a href="<?php echo base_url('isbn/view/' . $isbn->slug) ?>" class="btn btn-primary btn-xs" target="_blank">
                                                    <i class="fa fa-eye"></i> View</a>
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