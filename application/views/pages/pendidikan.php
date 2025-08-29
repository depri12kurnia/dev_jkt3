<section class="bg-page-header">
    <div class="page-header-overlay">
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <div class="page-title">
                        <h3><?php echo $pages->jenis_pages; ?></h3>
                    </div>
                    <div class="page-header-content">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('/'); ?>">Home > </a></li>
                            <li>Pendidikan > </li>
                            <li> <?php echo $pages->judul_pages; ?></li>
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
                                <h4 class="sidebar-widget-title">Pendaftaran</h4>
                                <div class="widget-content">
                                    <div class="download-option">
                                        <a href="https://jakarta3.pusilkom.com/" target="_blank" class="download-btn"><i class="fa fa-globe" aria-hidden="true"></i> Pendaftaran PMDP<span><i class="fa fa-arrow-right" aria-hidden="true"></i></span></a>
                                        <a href="https://simama-poltekkes.kemkes.go.id/" target="_blank" class="download-btn"><i class="fa fa-globe" aria-hidden="true"></i> Pendaftaran SIMAMA<span><i class="fa fa-arrow-right" aria-hidden="true"></i></span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="widget">
                                <h4 class="sidebar-widget-title">Kalender Pendidikan</h4>
                                <div class="widget-content">
                                    <ul class="catagories">
                                        <?php foreach ($kalender_akademik as $ka) { ?>
                                            <li><a href="<?php echo base_url('unduhan/unduh/' . $ka->id_download) ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <?php echo $ka->judul_download ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="widget">
                                <h4 class="sidebar-widget-title">Peraturan Akademik</h4>
                                <div class="widget-content">
                                    <ul class="catagories">
                                        <?php foreach ($peraturan_akademik as $pa) { ?>
                                            <li><a href="<?php echo base_url('unduhan/unduh/' . $pa->id_download) ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <?php echo $pa->judul_download ?></a></li>
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
                                                    <h5><a href="<?php echo base_url('berita/read/' . $pengumuman->slug_berita); ?>"><?php echo $pengumuman->judul_berita; ?></a>
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