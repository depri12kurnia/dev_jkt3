<!-- latestnews -->
<section id="latestnews" class="px-2 latest_news">
    <div class="container py-2">
        <h2 class="display-6 fw-semibold text-body-emphasis m-0">Berita Terbaru</h2>
        <hr class="mt-2 mb-1">
        <div class="row py-3 row-cols-2 row-cols-lg-4">
            <?php foreach ($berita as $berita) { ?>
                <div class="col mb-2">
                    <div class="text-black bg-body-secondary mb-3 text-center post-images">
                        <a href="<?php echo base_url('berita/read/' . $berita->slug_berita); ?>"
                            title="<?php echo ucfirst(mb_strtolower(character_limiter(strip_tags($berita->judul_berita), 100))); ?>"
                            class=""><img src="<?php echo base_url('assets/upload/image/thumbs/' . $berita->gambar); ?>"
                                alt="<?php echo ucfirst(mb_strtolower(character_limiter(strip_tags($berita->judul_berita), 100))); ?>"
                                class="img-fluid "></a>

                    </div>
                    <a href="<?php echo base_url('berita/read/' . $berita->slug_berita); ?>"
                        title="<?php echo ucfirst(mb_strtolower(character_limiter(strip_tags($berita->judul_berita), 100))); ?>">
                        <h3 class="fs-6 fw-semibold mb-3"><?php echo ucfirst(mb_strtolower(character_limiter(strip_tags($berita->judul_berita), 100))); ?></h3>
                    </a>
                    <small class="fs-7 text-capitalize badge bg-warning text-dark">Utama</small>
                    <small class="fs-7 badge bg-light text-dark"> <?php echo date('d M Y H:i', strtotime($berita->tanggal_publish)); ?> </small>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="container btn-more d-flex justify-content-end align-items-center ">
        <a href="<?php echo base_url('berita'); ?>" class="px-4 py-2 rounded-pillb fs-7 fw-semibold mx-1" title="Selengkapnya"><i class="bi bi-arrow-right text-default fs-5"></i> Selengkapnya</a>
    </div>
</section>
<!-- End latestnews -->