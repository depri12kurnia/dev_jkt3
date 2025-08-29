<section class="bg-single-blog">
    <div class="container">
        <div class="row">
            <div class="single-blog">
                <div class="row">
                    <div class="col-md-8">
                        <div class="blog-items">
                            <?php if ($capaian->gambar != "") { ?>
                                <div class="blog-img" style="width:770px;height:370px;">
                                    <a href="#"><img src="<?php echo base_url('assets/upload/capaian/' . $capaian->gambar) ?>" alt="blog-img-10" class="img-responsive" /></a>
                                </div>
                            <?php } ?>
                            <!-- .blog-img -->
                            <div class="blog-content-box">
                                <div class="meta-box">
                                    <div class="event-author-option">
                                        <div class="event-author-name">
                                            <p>Posted by : <a href="#"> <?php echo $capaian->nama; ?></a></p>
                                        </div>
                                        <!-- .author-name -->
                                    </div>
                                    <!-- .author-option -->
                                    <ul class="meta-post">
                                        <li><i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo date('d M Y', strtotime($capaian->tanggal)); ?></li>
                                        <li><a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                                <!-- .meta-box -->
                                <div class="blog-content">
                                    <h4><?php echo $capaian->judul_capaian; ?></h4>
                                    <p class="text-justify"><?php echo $capaian->isi; ?></p>
                                </div>
                                <!-- .blog-content -->
                            </div>
                            <!-- .blog-content-box -->
                        </div>
                        <!-- .blog-items -->
                    </div>
                    <!-- .col-md-8 -->
                    <div class="col-md-4">
                        <div class="sidebar">
                            <div class="widget">
                                <h4 class="sidebar-widget-title">All Categores</h4>
                                <div class="widget-content">
                                    <ul class="catagories">
                                        <?php foreach ($kategori as $kt) { ?>
                                            <li><a href="<?php echo base_url('capaian/read2/' . $kt->slug_kategori); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <?php echo $kt->nama_kategori; ?> <span><?php echo $this->kategori_model->jumlah()->total; ?></span></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <!-- .widget-content -->
                            </div>
                            <div class="widget">
                                <h4 class="sidebar-widget-title">capaian Terpopuler</h4>
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
                                                    <h5><a href="<?php echo base_url('capaian/read/' . $populer->slug_capaian); ?>"><?php echo $populer->judul_capaian; ?></a>
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
                                                    <h5><a href="<?php echo base_url('capaian/read/' . $pengumuman->slug_capaian); ?>"><?php echo $pengumuman->judul_capaian; ?></a>
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
                    <!-- .col-md-4 -->
                </div>
                <!-- .row -->
            </div>
            <!-- .single-blog -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>