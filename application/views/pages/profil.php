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
                            <li>Profil > </li>
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
                    <div class="col-md-12">
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
                </div>
            </div>
        </div>
    </div>
</section>