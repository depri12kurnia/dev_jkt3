<section class="bg-page-header">
    <div class="page-header-overlay">
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <div class="page-title">
                        <h3>Berita</h3>
                    </div>
                    <!-- .page-title -->
                    <div class="page-header-content">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('/'); ?>">Home > </a></li>
                            <li>Berita</li>
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
                    <div class="col-md-8">
                        <?php foreach ($berita as $berita) { ?>
                            <div class="blog-items">
                                <div class="blog-img" style="width:100%;height:50%;">
                                    <!-- <div class="blog-img" style="width:770px;height:370px;"> -->
                                    <a href="<?php echo base_url('berita/read/' . $berita->slug_berita); ?>"><img src="<?php echo base_url('assets/upload/image/' . $berita->gambar) ?>" alt="blog-img-10" class="img-responsive" /></a>
                                </div>
                                <!-- .blog-img -->
                                <div class="blog-content-box">
                                    <div class="blog-content">
                                        <h4><a href="<?php echo base_url('berita/read/' . $berita->slug_berita); ?>"><?php echo $berita->judul_berita; ?></a>
                                        </h4>
                                        <ul class="meta-post">
                                            <li><i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo date('d M Y', strtotime($berita->tanggal_publish)); ?></li>
                                            <li><i class="fa fa-user"></i> <?php echo $berita->nama_kategori; ?></li>
                                            <li><a href="#"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $berita->hits; ?> Viewer</a></li>
                                        </ul>
                                        <p class="text-justify">
                                            <?php echo character_limiter(strip_tags($berita->isi), 200); ?></p>
                                        <a href="<?php echo base_url('berita/read/' . $berita->slug_berita); ?>"><i class="fa fa-chevron-right"></i> Selengkapnya</a>
                                    </div>
                                    <!-- .blog-content -->
                                </div>
                                <!-- .blog-content-box -->
                            </div>
                        <?php } ?>
                        <div class="pagination-option">
                            <nav aria-label="Page navigation">
                                <?php echo $pagination; ?>

                                <!-- <ul class="pagination">
                                    <li>
                                        <a href="" aria-label="Previous">
                                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                        </a>
                                    </li>

                                    <li class="active"><a href="">1</a></li>

                                    <li>
                                        <a href="" aria-label="Next">
                                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                </ul> -->
                            </nav>
                        </div>
                        <!-- .pagination_option -->
                    </div>
                    <!-- .col-md-8 -->
                    <div class="col-md-4">
                        <div class="sidebar">
                            <div class="widget">
                                <h4 class="sidebar-widget-title">All Categores</h4>
                                <div class="widget-content">
                                    <ul class="catagories">
                                        <?php foreach ($list_side as $kt) { ?>
                                            <li><a href="<?php echo base_url('berita/kategori/' . $kt->slug_kategori); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <?php echo $kt->nama_kategori; ?> <span><?php echo $kt->total; ?></span></a></li>
                                        <?php } ?>
                                    </ul>
                                    <div class="download-option">
                                        <a href="#" class="download-btn"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> BROSUR.PDF <span><i class="fa fa-download" aria-hidden="true"></i></span></a>
                                    </div>
                                </div>
                                <!-- .widget-content -->
                            </div>
                            <div class="widget">
                                <h4 class="sidebar-widget-title">Berita Terpopuler</h4>
                                <div class="widget-content">
                                    <ul class="popular-news-option">
                                        <?php foreach ($populer as $populer) { ?>
                                            <li>
                                                <div class="popular-news-contant">
                                                    <h5><a href="<?php echo base_url('berita/read/' . $populer->slug_berita); ?>"><?php echo $populer->judul_berita; ?></a>
                                                    </h5>
                                                    <p>
                                                        <i class="fa fa-calendar"></i>
                                                        <?php echo date('d M Y', strtotime($populer->tanggal_publish)); ?>
                                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i>
                                                            <?php echo $populer->hits; ?> Viewer</a>
                                                    </p>
                                                </div>
                                                <!-- .popular-news-img -->
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <!-- .widget-content -->
                            </div>
                            <div class="widget">
                                <h4 class="sidebar-widget-title">Pengumuman</h4>
                                <div class="widget-content">
                                    <ul class="popular-news-option">
                                        <?php foreach ($pengumuman as $pengumuman) { ?>
                                            <li>
                                                <div class="popular-news-contant">
                                                    <h5><a href="<?php echo base_url('berita/read/' . $pengumuman->slug_berita); ?>"><?php echo $pengumuman->judul_berita; ?></a>
                                                    </h5>
                                                    <p>
                                                        <i class="fa fa-calendar"></i>
                                                        <?php echo date('d M Y', strtotime($pengumuman->tanggal_publish)); ?>
                                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i>
                                                            <?php echo $pengumuman->hits; ?> Viewer</a>
                                                    </p>
                                                </div>
                                                <!-- .popular-news-img -->
                                            </li>
                                        <?php } ?>
                                    </ul>

                                </div>
                                <!-- .widget-content -->
                            </div>
                        </div>
                    </div>
                    <!-- .sidebar -->
                </div>
                <!-- end col md 4 -->
            </div>
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>