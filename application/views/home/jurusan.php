<!-- Start Recent Project Section -->
<section class="bg-recent-project">
    <div class="container">
        <div class="row">
            <div class="recent-project">
                <div class="section-header">
                    <h2 style="color: #686969;">Jurusan</h2>
                    <p style="color: #686969;">Progam Studi Di Politeknik Kesehatan Kemenkes Jakarta III</p>
                </div>
                <!-- .section-header -->

                <div id="filters" class="button-group ">
                    <button class="button is-checked" data-filter="*">Show All</button>
                    <?php foreach ($jurusan1 as $jurusan) { ?>
                        <button class="button" data-filter=".cat-<?php echo $jurusan->id_jurusan ?>"><?php echo $jurusan->nama_jurusan ?></button>
                    <?php } ?>
                </div>
                <div class="portfolio-items">
                    <?php foreach ($prodi as $pr) { ?>
                        <div class="item cat-<?php echo $pr->id_jurusan ?>" data-category="transition">
                            <div class="item-inner">
                                <div class="portfolio-img lazyload">
                                    <div class="overlay-project"></div>
                                    <!-- .overlay-project -->
                                    <img style="width:100%;height:50%;" src="<?php echo base_url('assets/upload/prodi/thumbs/' . $pr->gambar); ?>" alt="recent-project-img-<?php echo $pr->id_jurusan ?>">
                                    <ul class="project-link-option">
                                        <li class="project-link"><a href="<?php echo base_url('prodi/read/' . $pr->slug_prodi . '/' . $pr->id_prodi); ?>"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                        <li class="project-search"><a href="<?php echo base_url('assets/upload/prodi/thumbs/' . $pr->gambar); ?>" data-rel="lightcase:myCollection"><i class="fa fa-search-plus" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                                <!-- /.portfolio-img -->
                                <!--<div class="recent-project-content">-->
                                <!--<h4><a href="<?php echo base_url('prodi/read/' . $pr->slug_prodi); ?>"><?php echo $pr->nama_prodi ?></a></h4>-->
                                <!-- <p><?php echo character_limiter(strip_tags($pr->isi), 80); ?></p> -->
                                <!--</div>-->
                                <!-- .latest-port-content -->
                            </div>
                            <!-- .item-inner -->
                        </div>
                        <!-- .items -->
                    <?php } ?>
                </div>
                <!-- .isotope-items -->
            </div>
            <!-- .recent-project -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>


<!-- End Recent Project Section -->