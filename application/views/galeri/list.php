<section class="bg-page-header">
    <div class="page-header-overlay">
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <div class="page-title">
                        <h3>Galeri</h3>
                    </div>
                    <!-- .page-title -->
                    <div class="page-header-content">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
                            <li>Galeri PolkesJati</li>
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
<section class="bg-recent-project-home3">
    <div class="container">
        <div class="row">
            <div class="recent-project photo-gallery">
                <div id="filters" class="button-group ">
                    <button class="button is-checked" data-filter="*">show all</button>
                    <?php if (count($kategori) > 1) {
                        foreach ($kategori as $kategori) { ?>
                            <button class="button" data-filter=".<?php echo $kategori->slug_kategori_galeri ?>"><?php echo $kategori->nama_kategori_galeri ?></button>
                    <?php }
                    } ?>
                </div>
                <div class="portfolio-items portfolio-items-home3">
                    <?php foreach ($galeri as $galeri) { ?>
                        <div class="item <?php echo $galeri->slug_kategori_galeri ?>" data-category="<?php echo $galeri->nama_kategori_galeri ?>">
                            <div class="item-inner">
                                <div class="portfolio-img">
                                    <div class="overlay-project"></div>
                                    <!-- .overlay-project -->
                                    <img src="<?php echo base_url('assets/upload/image/thumbs/' . $galeri->gambar) ?>" alt="recent-project-img-1" class="img img-fluid img-thumbnail lazyload">
                                    <div class="project-plus">
                                        <a href="<?php echo base_url('assets/upload/image/' . $galeri->gambar) ?>" data-rel="lightcase:myCollection"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="recent-project-content">
                                        <p><a href="#"><?php echo $galeri->judul_galeri; ?></a></p>
                                    </div>
                                    <!-- .latest-port-content -->
                                </div>
                                <!-- /.portfolio-img -->
                            </div>
                            <!-- .item-inner -->
                        </div>
                    <?php } ?>
                    <!-- .items -->
                </div>
                <!-- .isotope-items -->
                <div class="load-more-option">
                    <?php if (isset($pagin)) {
                        echo $pagin;
                    }  ?>
                </div>
                <!-- .load-more-option -->
            </div>
            <!-- .recent-project -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>