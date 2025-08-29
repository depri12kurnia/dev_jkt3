<!-- Slider Section -->
<section class="bg-slider-option py-0 debug-slider">
    <div class="slider-option slider-two">
        <div id="slider" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
            <!-- Indicators -->
            <div class="carousel-indicators">
                <?php foreach ($slider as $idx => $s) { ?>
                    <button type="button"
                        data-bs-target="#slider"
                        data-bs-slide-to="<?php echo $idx; ?>"
                        data-slide-number="<?php echo $idx + 1; ?>"
                        <?php if ($idx == 0) echo 'class="active" aria-current="true"'; ?>
                        aria-label="Slide <?php echo $idx + 1; ?>"></button>
                <?php } ?>
            </div>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <?php foreach ($slider as $idx => $slide) : ?>
                    <div class="carousel-item <?php if ($idx == 0) echo 'active'; ?>">
                        <img src="<?php echo base_url('assets/upload/image/' . $slide->gambar); ?>"
                            class="d-block w-100"
                            alt="<?php echo htmlspecialchars($slide->judul_galeri); ?>">
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
                <span class="fa fa-chevron-left" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
                <span class="fa fa-chevron-right" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
<!-- End Slider Section -->