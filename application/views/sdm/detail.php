<section class="bg-page-header">
    <div class="page-header-overlay">
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <div class="page-title">
                        <h3>SDM</h3>
                    </div>
                    <div class="page-header-content">
                        <ol class="breadcrumb">
                            <li><a href="index.html">Home</a></li>
                            <li>SDM</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-single-team">
    <div class="container">
        <div class="row">
            <div class="single-team">
                <div class="row">
                    <div class="col-md-6">
                        <div class="single-team-img">
                            <img src="<?php echo base_url('assets/upload/staff/' . $staff->gambar) ?>" class="img-responsive lazyload" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-team-details">
                            <h3><?php echo $staff->nama ?></h3>
                            <h5><?php echo $staff->jabatan ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>