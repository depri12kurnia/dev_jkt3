<!-- Start partners Section -->
<section class="partners-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="partners-option">
                    <div class="section-header">
                        <h4>Mitra Dalam & Luar Negeri</h4>
                    </div>
                    <!-- .section-header -->
                    <div class="partners-container">
                        <div class="swiper-wrapper">
                            <?php
                            // Original slides
                            foreach ($mitra as $partner) : ?>
                                <div class="swiper-slide">
                                    <div class="sopnsors-items">
                                        <a target="_blank" href="<?php echo $partner->link_mitra ?>" rel="noopener noreferrer">
                                            <img src="<?php echo base_url('assets/upload/mitra/' . $partner->gambar); ?>"
                                                alt="<?php echo $partner->nama_mitra ?? 'Partner Logo' ?>"
                                                class="img-responsive"
                                                loading="lazy" />
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <!-- .swiper-wrapper -->
                    </div>
                    <!-- .partners-container -->
                </div>
                <!-- .partners-option -->
            </div>
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>
<!-- End partners Section -->