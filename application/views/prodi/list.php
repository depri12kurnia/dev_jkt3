<section class="bg-blog-style-2">
    <div class="container">
        <div class="row">
            <div class="blog-style-2">
                <div class="row">
                    <div class="col-md-8">
                        <?php foreach ($prodi as $prodi) { ?>
                            <div class="blog-items">
                                <div class="blog-img" style="width:100%;height:50%;">
                                    <!-- <div class="blog-img" style="width:770px;height:370px;"> -->
                                    <a href="<?php echo base_url('prodi/read/' . $prodi->slug_prodi); ?>"><img src="<?php echo base_url('assets/upload/image/' . $prodi->gambar) ?>" alt="blog-img-10" class="img-responsive" /></a>
                                </div>
                                <!-- .blog-img -->
                                <div class="blog-content-box">
                                    <div class="blog-content">
                                        <h4><a href="<?php echo base_url('prodi/read/' . $prodi->slug_prodi); ?>"><?php echo $prodi->judul_prodi; ?></a>
                                        </h4>
                                        <ul class="meta-post">
                                            <li><i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo date('d M Y', strtotime($prodi->tanggal_publish)); ?></li>
                                            <li><i class="fa fa-user"></i> <?php echo $prodi->nama_kategori; ?></li>
                                            <li><a href="#"><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $prodi->hits; ?> Viewer</a></li>
                                        </ul>
                                        <p class="text-justify">
                                            <?php echo character_limiter(strip_tags($prodi->isi), 200); ?></p>
                                        <a href="<?php echo base_url('prodi/read/' . $prodi->slug_prodi); ?>"><i class="fa fa-chevron-right"></i> Selengkapnya</a>
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
                                        <a href="#" aria-label="Previous">
                                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li><a href="#">1</a></li>
                                    <li class="active"><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">...</a></li>
                                    <li><a href="#">5</a></li>
                                    <li>
                                        <a href="#" aria-label="Next">
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
                                            <li><a href="<?php echo base_url('prodi/kategori/' . $kt->slug_kategori); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <?php echo $kt->nama_kategori; ?> <span><?php echo $kt->total; ?></span></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <!-- .widget-content -->
                            </div>
                            <div class="widget">
                                <h4 class="sidebar-widget-title">prodi Terpopuler</h4>
                                <div class="widget-content">
                                    <ul class="popular-news-option">
                                        <?php foreach ($populer as $populer) { ?>
                                            <li>
                                                <div class="popular-news-img" style="width: 80px; height: 80px;">
                                                    <a href="#"><img src="<?php if ($populer->gambar == "") {
                                                                                echo base_url('assets/upload/image/thumbs/' . $site->icon);
                                                                            } else {
                                                                                echo base_url('assets/upload/image/thumbs/' . $populer->gambar);
                                                                            } ?>" alt="popular-news-img-1" /></a>
                                                </div>
                                                <!-- .popular-news-img -->
                                                <div class="popular-news-contant">
                                                    <h5><a href="<?php echo base_url('prodi/read/' . $populer->slug_prodi); ?>"><?php echo $populer->judul_prodi; ?></a>
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
                                                <div class="popular-news-img" style="width: 80px; height: 80px;">
                                                    <a href="#"><img src="<?php if ($pengumuman->gambar == "") {
                                                                                echo base_url('assets/upload/image/thumbs/' . $site->icon);
                                                                            } else {
                                                                                echo base_url('assets/upload/image/thumbs/' . $pengumuman->gambar);
                                                                            } ?>" alt="popular-news-img-1" /></a>
                                                </div>
                                                <!-- .popular-news-img -->
                                                <div class="popular-news-contant">
                                                    <h5><a href="<?php echo base_url('prodi/read/' . $pengumuman->slug_prodi); ?>"><?php echo $pengumuman->judul_prodi; ?></a>
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
                        <!-- .sidebar -->
                    </div>
                </div>
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
</section>