<section class="bg-page-header">
    <div class="page-header-overlay">
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <div class="page-title">
                        <h3>pages</h3>
                    </div>
                    <div class="page-header-content">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('/'); ?>">Home > </a></li>
                            <li>Pages > </li>
                            <li><?php echo character_limiter(strip_tags($pages->judul_pages), 30); ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .page-header-overlay -->
</section>
<section class="bg-single-blog">
    <div class="container">
        <div class="row">
            <div class="single-blog">
                <div class="row">
                    <div class="col-md-8">
                        <div class="blog-items">
                            <?php if ($pages->gambar != "") { ?>
                                <div class="blog-img" style="width:100%;height:50%;">
                                    <a href="#"><img src="<?php echo base_url('assets/upload/pages/' . $pages->gambar) ?>" alt="blog-img-10" class="img-responsive" /></a>
                                </div>
                            <?php } ?>
                            <div class="blog-content-box">
                                <div class="meta-box">
                                    <div class="event-author-option">
                                        <div class="event-author-name">
                                            <p>Posted by : <a href="#"> <?php echo $pages->nama; ?></a></p>
                                        </div>
                                    </div>
                                    <ul class="meta-post">
                                        <li><i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo date('d M Y', strtotime($pages->tanggal_publish)); ?></li>
                                        <li><a href="#"><i class="fa fa-eye" aria-hidden="true"></i>
                                                <?php echo $pages->hits; ?> Viewer</a></li>
                                    </ul>
                                </div>
                                <div class="blog-content">
                                    <h4><?php echo $pages->judul_pages; ?></h4>
                                    <?php echo $pages->isi; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar -->
                    <div class="col-md-4">
                        <div class="sidebar">
                            <div class="widget">
                                <h4 class="sidebar-widget-title">All Categores</h4>
                                <div class="widget-content">
                                    <ul class="catagories">
                                        <?php foreach ($list_side as $kt) { ?>
                                            <li><a href="<?php echo base_url('pages/kategori/' . $kt->slug_kategori); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <?php echo $kt->nama_kategori; ?> <span><?php echo $kt->total; ?></span></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>

                            </div>
                            <div class="widget">
                                <h4 class="sidebar-widget-title">pages Terpopuler</h4>
                                <div class="widget-content">
                                    <ul class="popular-news-option">
                                        <?php foreach ($populer as $populer) { ?>
                                            <li>
                                                <div class="popular-news-contant">
                                                    <h5><a href="<?php echo base_url('pages/read/' . $populer->slug_pages); ?>"><?php echo $populer->judul_pages; ?></a>
                                                    </h5>
                                                    <p>
                                                        <i class="fa fa-calendar"></i>
                                                        <?php echo date('d M Y', strtotime($populer->tanggal_publish)); ?>
                                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i>
                                                            <?php echo $populer->hits; ?> Viewer</a>
                                                    </p>
                                                </div>

                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="widget">
                                <h4 class="sidebar-widget-title">Pengumuman</h4>
                                <div class="widget-content">
                                    <ul class="popular-news-option">
                                        <?php foreach ($pengumuman as $pengumuman) { ?>
                                            <li>
                                                <div class="popular-news-contant">
                                                    <h5><a href="<?php echo base_url('pages/read/' . $pengumuman->slug_pages); ?>"><?php echo $pengumuman->judul_pages; ?></a>
                                                    </h5>
                                                    <p>
                                                        <i class="fa fa-calendar"></i>
                                                        <?php echo date('d M Y', strtotime($pengumuman->tanggal_publish)); ?>
                                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i>
                                                            <?php echo $pengumuman->hits; ?> Viewer</a>
                                                    </p>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>