<!-- Start Agenda Section -->
<section class="agenda-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center mb-4">
                    <h2 class="fw-bold">Agenda</h2>
                    <p class="text-muted">Ikuti update terbaru agenda akademik dan non-akademik di website ini.</p>
                </div>
            </div>
            <!-- Agenda Grid -->
            <div class="agenda-container">
                <?php if (!empty($agenda)) : ?>
                    <?php foreach ($agenda as $item) : ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="agenda-card h-100">
                                <div class="agenda-date">
                                    <div class="date-container">
                                        <span class="day"><?= date('d', strtotime($item->mulai)) ?></span>
                                        <span class="month"><?= date('M', strtotime($item->mulai)) ?></span>
                                        <span class="year"><?= date('Y', strtotime($item->mulai)) ?></span>
                                    </div>
                                </div>

                                <div class="agenda-content">
                                    <h3 class="agenda-title">
                                        <a href="<?= base_url('agenda/detail/' . $item->slug_agenda) ?>"
                                            class="text-decoration-none">
                                            <?= character_limiter($item->nama, 80) ?>
                                        </a>
                                    </h3>

                                    <div class="agenda-location">
                                        <i class="bi bi-geo-alt text-primary me-1"></i>
                                        <small class="text-muted">
                                            <?= character_limiter($item->tempat, 60) ?>
                                        </small>
                                    </div>

                                    <?php if (!empty($item->isi)) : ?>
                                        <p class="agenda-description">
                                            <?= character_limiter(strip_tags($item->isi), 100) ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <!-- Empty State -->
                    <div class="col-12">
                        <div class="empty-agenda text-center py-5">
                            <div class="empty-icon mb-3">
                                <i class="bi bi-calendar-x text-muted" style="font-size: 4rem;"></i>
                            </div>
                            <h4 class="text-muted">Belum Ada Agenda</h4>
                            <p class="text-muted">Agenda kegiatan akan ditampilkan di sini</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
</section>
<!-- End Agenda Section -->