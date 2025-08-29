<!-- Start Page Header Section -->
<section class="bg-page-header">
    <div class="page-header-overlay">
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <div class="page-title">
                        <h3>Jurusan</h3>
                    </div>
                    <!-- .page-title -->
                    <div class="page-header-content">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
                            <li><?php echo $prodi->nama_jurusan ?></li>
                            <li><?php echo $prodi->nama_prodi; ?></li>
                        </ol>
                    </div>
                </div>
                <!-- .page-header -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </div>
    <!-- .page-header-overlay -->
</section>
<section class="bg-single-events">
    <div class="container">
        <div class="row">
            <div class="single-events">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="single-event-item">
                            <?php if ($prodi->gambar != "" || $prodi->gambar != NULL) { ?>
                                <div class="single-event-img">
                                    <img style="width: 100%;height: 450px;" src="<?php echo base_url('assets/upload/prodi/' . $prodi->gambar); ?>" alt="single-event-img-1" class="img-responsive" />
                                </div>
                            <?php } ?>
                            <!-- .single-event-img -->
                            <div class="single-event-content">
                                <h3><?php echo $prodi->nama_prodi; ?></h3>
                                <hr>
                                <?php echo $prodi->isi; ?>
                            </div>
                            <!-- .single-event-content -->
                        </div>
                        <!-- .single-event-item -->
                    </div>
                    <!-- .col-md-12 -->
                </div>
                <!-- .row -->
            </div>
            <!-- .single-events -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>