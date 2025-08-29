<section class="bg-page-header">
    <div class="page-header-overlay">
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <div class="page-title">
                        <h3>Data SDM</h3>
                    </div>
                    <div class="page-header-content">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
                            <li>SDM</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-team-section">
    <div class="container">
        <div class="row">
            <div class="volunteers-option">
                <div class="row">
                    <?php
                    foreach ($staff as $staff) { ?>
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <div class="volunteers-items">
                                <div class="volunteers-img">
                                    <img src="<?php echo base_url('assets/upload/staff/' . $staff->gambar) ?>" alt="volunteers-img-1" class="img-responsive lazyload" />
                                </div>
                                <div class="volunteers-content">
                                    <h5><?php echo $staff->jabatan; ?></h5>
                                    <p><a href="<?php echo base_url('staff/detail/' . $staff->id_staff) ?>"><?php echo $staff->nama ?></a></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>