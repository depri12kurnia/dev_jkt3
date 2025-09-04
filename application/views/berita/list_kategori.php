<!-- latestnews -->
<section id="latestnews" class="px-2 latest_news">
    <div class="container py-2">
        <h2 class="display-6 fw-semibold text-body-emphasis m-0">Pengumuman</h2>
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
                    <small class="fs-7 text-capitalize badge bg-warning text-dark"><?php echo $berita->nama_kategori; ?></small>
                    <small class="fs-7 badge bg-light text-dark"> <?php echo date('d M Y H:i', strtotime($berita->tanggal_publish)); ?> </small>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="pagination-option">
        <nav aria-label="Page navigation">
            <?php echo $pagination; ?>
        </nav>
    </div>
</section>
<!-- End latestnews -->