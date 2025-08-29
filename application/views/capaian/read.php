<section class="bg-page-header lazyload">
    <div class="page-header-overlay">
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <div class="page-title">
                        <h3>Dashboard</h3>
                    </div>
                    <!-- .page-title -->
                    <div class="page-header-content">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('/'); ?>">Home ></a></li>
                            <li> Capaian ZI ></li>
                            <li> <?php echo $dashboard->judul_capaian; ?></li>
                        </ol>
                    </div>
                    <!-- .page-header-content -->
                </div>
                <!-- .page-header -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </div>
    <!-- .page-header-overlay -->
</section>
<section class="bg-blog-style-2">
    <div class="container">
        <div class="row">
            <div class="blog-style-2">
                <div class="row">
                    <div class="col-md-4">
                        <div class="sidebar">
                            <div class="widget">
                                <h4 class="sidebar-widget-title">Dashboard Capaian ZI</h4>
                                <div class="widget-content">
                                    <ul class="catagories">
                                        <?php foreach ($listcapaian as $kt) { ?>
                                            <li><a href="<?php echo base_url('capaian/read/' . $kt->slug_capaian); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <?php echo $kt->judul_capaian; ?> <span></span></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <!-- .widget-content -->
                            </div>
                        </div>
                    </div>
                    <!-- .col-md-8 -->
                    <div class="col-md-8">
                        <div class="blog-items">
                            <div class="blog-content-box">
                                <div class="blog-content">
                                    <h4><a href="#"><?php echo $dashboard->judul_capaian; ?></a>
                                    </h4>
                                </div>
                                <!-- .blog-content -->
                            </div>
                            <!-- .blog-content-box -->
                            <?php if ($dashboard->gambar != "") { ?>
                                <div class="blog-img" style="width:100%;height:80%;">
                                    <a href="#"><img src="<?php echo base_url('assets/upload/capaian/' . $dashboard->gambar) ?>" alt="blog-img-10" class="img-responsive lazyload" /></a>
                                </div>
                            <?php } ?>
                            <!-- .blog-img -->

                        </div>

                    </div>
                </div>
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
</section>