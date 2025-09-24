<section class="bg-page-header">
    <div class="page-header-overlay">
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <div class="page-title">
                        <h3>Data SDM</h3>
                    </div>
                    <div class="page-header-content">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('/'); ?>">Home ></a></li>
                            <li>Data SDM</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="bg-team-section">
    <div class="container">
        <div class="row justify-content-center">
            <?php
            if (!empty($direktur)) {
                foreach ($direktur as $sdm) { ?>
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card shadow border-0 h-100">
                            <img src="<?php echo !empty($sdm->foto_url) ? base_url('assets/upload/sdm/' . $sdm->foto_url) : base_url('assets/images/staff/default-avatar.jpg'); ?>"
                                alt="<?php echo htmlspecialchars($sdm->nama_sdm); ?>"
                                class="card-img-top responsive-profile-img">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold mb-2"><?php echo $sdm->nama_sdm; ?></h5>
                                <span class="badge bg-primary mb-2"><?php echo !empty($sdm->jabatan) ? $sdm->jabatan : 'Staff'; ?></span>
                                <div class="mb-2"></div>
                                <a href="<?php echo base_url('sdm/detail/' . $sdm->slug); ?>" class="btn btn-outline-primary btn-sm mt-2">Lihat Profil</a>
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <div class="col-12 text-center py-5">
                    <h4 class="text-muted">Belum ada data.</h4>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<section class="bg-team-section">
    <div class="container">
        <div class="row justify-content-center">
            <?php
            if (!empty($wakil_direktur)) {
                foreach ($wakil_direktur as $sdm) { ?>
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card shadow border-0 h-100">
                            <img src="<?php echo !empty($sdm->foto_url) ? base_url('assets/upload/sdm/' . $sdm->foto_url) : base_url('assets/images/staff/default-avatar.jpg'); ?>"
                                alt="<?php echo htmlspecialchars($sdm->nama_sdm); ?>"
                                class="card-img-top responsive-profile-img">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold mb-2"><?php echo $sdm->nama_sdm; ?></h5>
                                <span class="badge bg-primary mb-2"><?php echo !empty($sdm->jabatan) ? $sdm->jabatan : 'Staff'; ?></span>
                                <div class="mb-2"></div>
                                <a href="<?php echo base_url('sdm/detail/' . $sdm->slug); ?>" class="btn btn-outline-primary btn-sm mt-2">Lihat Profil</a>
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <div class="col-12 text-center py-5">
                    <h4 class="text-muted">Belum ada data.</h4>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<section class="bg-team-section">
    <div class="container">
        <?php if (!empty($sdm_list)): ?>
            <?php
            $max_display = 6;
            $total_sdm = count($sdm_list);
            ?>
            <div class="row justify-content-center" id="sdm-container">
                <?php foreach ($sdm_list as $index => $sdm): ?>
                    <div class="col-md-4 col-sm-6 mb-4 sdm-item <?php echo $index >= $max_display ? 'hidden-item' : ''; ?>"
                        style="<?php echo $index >= $max_display ? 'display: none;' : ''; ?>">
                        <div class="card shadow border-0 h-100">
                            <img src="<?php echo !empty($sdm->foto_url) ? base_url('assets/upload/sdm/' . $sdm->foto_url) : base_url('assets/images/staff/default-avatar.jpg'); ?>"
                                alt="<?php echo htmlspecialchars($sdm->nama_sdm); ?>"
                                class="card-img-top responsive-profile-img">
                            <div class="card-body text-center">
                                <h6 class="card-title fw-bold mb-2"><?php echo $sdm->nama_sdm; ?></h6>
                                <span class="badge bg-primary mb-2 text-wrap text-break"><?php echo !empty($sdm->jabatan) ? $sdm->jabatan : 'Staff'; ?></span>
                                <div class="mb-2"></div>
                                <a href="<?php echo base_url('sdm/detail/' . $sdm->slug); ?>" class="btn btn-outline-primary btn-sm mt-2"><i class="bi bi-info-circle-fill me-1"></i> Lihat Profil</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Dynamic Show More Button -->
            <?php if ($total_sdm > $max_display): ?>
                <div class="text-center mt-4">
                    <button id="btn-show-more-sdm" class="btn btn-outline-primary">
                        <i class="bi bi-chevron-down me-1"></i>
                        <span class="btn-text">Tampilkan Lebih</span>
                        <span class="badge bg-primary ms-2"><?php echo $total_sdm - $max_display; ?> lainnya</span>
                    </button>
                </div>
            <?php endif; ?>

        <?php else: ?>
            <div class="row justify-content-center">
                <div class="col-12 text-center py-5">
                    <i class="bi bi-person-x" style="font-size: 3rem; color: #6c757d;"></i>
                    <h4 class="text-muted mt-3">Belum ada data SDM</h4>
                    <p class="text-muted">Data SDM untuk pusat ini belum tersedia.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnShowMore = document.getElementById('btn-show-more-sdm');
        const hiddenItems = document.querySelectorAll('.hidden-item');
        const maxDisplay = 6; // Items per batch
        const totalItems = <?php echo !empty($sdm_list) ? count($sdm_list) : 0; ?>;
        let currentlyShown = <?php echo $max_display; ?>; // Initially shown items
        let isExpanded = false;

        if (btnShowMore && hiddenItems.length > 0) {
            // Update initial button text
            updateButtonText();

            btnShowMore.addEventListener('click', function() {
                console.log('Button clicked. Currently shown:', currentlyShown, 'Total:', totalItems);

                if (!isExpanded) {
                    // Show next batch of items
                    const itemsToShow = [];
                    for (let i = 0; i < hiddenItems.length && itemsToShow.length < maxDisplay; i++) {
                        const item = hiddenItems[i];
                        if (item.style.display === 'none' || item.classList.contains('d-none')) {
                            itemsToShow.push(item);
                        }
                    }

                    // Show items with staggered animation
                    itemsToShow.forEach((item, index) => {
                        setTimeout(() => {
                            item.style.display = 'block';
                            item.classList.remove('d-none');
                            setTimeout(() => {
                                item.style.opacity = '1';
                                item.style.transform = 'translateY(0)';
                            }, 50);
                        }, index * 100);
                    });

                    currentlyShown += itemsToShow.length;

                    // Check if all items are now shown
                    if (currentlyShown >= totalItems) {
                        isExpanded = true;
                    }

                    updateButtonText();
                } else {
                    // Hide all items beyond initial max_display
                    const itemsToHide = [];
                    hiddenItems.forEach((item) => {
                        if (item.style.display !== 'none') {
                            itemsToHide.push(item);
                        }
                    });

                    // Hide items with staggered animation
                    itemsToHide.forEach((item, index) => {
                        setTimeout(() => {
                            item.style.opacity = '0';
                            item.style.transform = 'translateY(20px)';
                            setTimeout(() => {
                                item.style.display = 'none';
                                item.classList.add('d-none');
                            }, 300);
                        }, index * 50);
                    });

                    currentlyShown = <?php echo $max_display; ?>;
                    isExpanded = false;
                    updateButtonText();

                    // Scroll to container
                    setTimeout(() => {
                        document.getElementById('sdm-container').scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }, 800);
                }
            });

            function updateButtonText() {
                const remainingItems = totalItems - currentlyShown;

                if (!isExpanded && remainingItems > 0) {
                    const nextBatch = Math.min(remainingItems, maxDisplay);
                    btnShowMore.innerHTML = `
                        <i class="bi bi-chevron-down me-1"></i>
                        <span class="btn-text">Tampilkan ${nextBatch} Lagi</span>
                        <span class="badge bg-primary ms-2">${remainingItems} tersisa</span>
                    `;
                } else if (isExpanded) {
                    btnShowMore.innerHTML = `
                        <i class="bi bi-chevron-up me-1"></i>
                        <span class="btn-text">Tampilkan Lebih Sedikit</span>
                    `;
                } else {
                    // All items shown, hide button
                    btnShowMore.style.display = 'none';
                }
            }
        } else {
            console.log('Button not found or no hidden items');
        }

        // Debug logs
        console.log('Hidden items found:', hiddenItems.length);
        console.log('Initially shown:', currentlyShown);
        console.log('Total items:', totalItems);
    });
</script>

<style>
    .hidden-item {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.4s ease;
    }

    .sdm-item {
        transition: all 0.4s ease;
    }

    #btn-show-more-sdm {
        transition: all 0.3s ease;
        min-width: 200px;
        /* Prevent button width jumping */
    }

    #btn-show-more-sdm:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Ensure smooth display transitions */
    .hidden-item[style*="display: block"] {
        opacity: 1;
        transform: translateY(0);
    }

    .hidden-item[style*="display: none"] {
        opacity: 0;
        transform: translateY(20px);
    }

    /* Statistics Section Styling */
    .stats-title {
        color: #00B9AD;
        font-weight: 700;
        font-size: 2rem;
        position: relative;
        margin-bottom: 1rem;
    }

    .stats-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #00B9AD, #4CAF50);
        border-radius: 2px;
    }

    .stats-subtitle {
        color: #6c757d;
        font-size: 1.1rem;
        font-weight: 400;
    }

    /* Main Stats Cards */
    .stats-card {
        background: #fff;
        border-radius: 16px;
        padding: 2rem 1.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        height: 100%;
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--stats-color);
        transition: height 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .stats-card:hover::before {
        height: 6px;
    }

    .stats-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--stats-bg);
        color: var(--stats-color);
        font-size: 1.8rem;
        flex-shrink: 0;
    }

    .stats-content {
        flex: 1;
    }

    .stats-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--stats-color);
        margin: 0;
        line-height: 1;
    }

    .stats-label {
        color: #6c757d;
        font-size: 0.95rem;
        font-weight: 500;
        margin: 0.5rem 0 0 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Color Variants */
    .stats-primary {
        --stats-color: #007bff;
        --stats-bg: rgba(0, 123, 255, 0.1);
    }

    .stats-success {
        --stats-color: #28a745;
        --stats-bg: rgba(40, 167, 69, 0.1);
    }

    .stats-info {
        --stats-color: #17a2b8;
        --stats-bg: rgba(23, 162, 184, 0.1);
    }

    .stats-warning {
        --stats-color: #ffc107;
        --stats-bg: rgba(255, 193, 7, 0.1);
    }

    .stats-danger {
        --stats-color: #dc3545;
        --stats-bg: rgba(220, 53, 69, 0.1);
    }

    .stats-secondary {
        --stats-color: #6f42c1;
        --stats-bg: rgba(111, 66, 193, 0.1);
    }

    /* Mini Stats Cards */
    .stats-card-mini {
        background: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .stats-card-mini:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12);
    }

    .stats-icon-mini {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--stats-bg);
        color: var(--stats-color);
        font-size: 1.3rem;
        margin-bottom: 1rem;
    }

    .stats-number-mini {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--stats-color);
        margin: 0;
    }

    .stats-label-mini {
        color: #6c757d;
        font-size: 0.85rem;
        font-weight: 500;
        margin: 0.3rem 0 0 0;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    /* Gender Stats Special Card */
    .stats-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .stats-gradient .stats-label-mini {
        color: rgba(255, 255, 255, 0.8);
    }

    .gender-stats {
        display: flex;
        align-items: center;
        justify-content: space-around;
        margin-bottom: 0.5rem;
    }

    .gender-item {
        text-align: center;
        flex: 1;
    }

    .gender-icon-male {
        color: #4fc3f7;
        font-size: 1.5rem;
        display: block;
        margin-bottom: 0.3rem;
    }

    .gender-icon-female {
        color: #f06292;
        font-size: 1.5rem;
        display: block;
        margin-bottom: 0.3rem;
    }

    .gender-count {
        display: block;
        font-size: 1.4rem;
        font-weight: 700;
        color: white;
    }

    .gender-divider {
        width: 1px;
        height: 40px;
        background: rgba(255, 255, 255, 0.3);
        margin: 0 1rem;
    }

    /* Summary Card */
    .summary-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .summary-header {
        background: linear-gradient(135deg, #00B9AD, #4CAF50);
        padding: 1.5rem;
        color: white;
    }

    .summary-title {
        margin: 0;
        font-weight: 600;
        font-size: 1.3rem;
    }

    .summary-body {
        padding: 2rem;
    }

    .summary-badge {
        background: var(--badge-bg);
        color: var(--badge-color);
        border: 1px solid var(--badge-border);
        border-radius: 12px;
        padding: 0.8rem 1.2rem;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        height: 100%;
    }

    .summary-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px var(--badge-shadow);
    }

    .summary-badge-primary {
        --badge-bg: rgba(0, 123, 255, 0.1);
        --badge-color: #007bff;
        --badge-border: rgba(0, 123, 255, 0.2);
        --badge-shadow: rgba(0, 123, 255, 0.2);
    }

    .summary-badge-success {
        --badge-bg: rgba(40, 167, 69, 0.1);
        --badge-color: #28a745;
        --badge-border: rgba(40, 167, 69, 0.2);
        --badge-shadow: rgba(40, 167, 69, 0.2);
    }

    .summary-badge-info {
        --badge-bg: rgba(23, 162, 184, 0.1);
        --badge-color: #17a2b8;
        --badge-border: rgba(23, 162, 184, 0.2);
        --badge-shadow: rgba(23, 162, 184, 0.2);
    }

    .summary-badge-warning {
        --badge-bg: rgba(255, 193, 7, 0.1);
        --badge-color: #ffc107;
        --badge-border: rgba(255, 193, 7, 0.2);
        --badge-shadow: rgba(255, 193, 7, 0.2);
    }

    .summary-text {
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* Counter Animation */
    @keyframes countUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .counter-number {
        animation: countUp 0.6s ease;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .stats-card {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }

        .stats-number {
            font-size: 2rem;
        }

        .stats-title {
            font-size: 1.6rem;
        }

        .gender-stats {
            flex-direction: column;
            gap: 1rem;
        }

        .gender-divider {
            width: 40px;
            height: 1px;
            margin: 0.5rem 0;
        }
    }

    @media (max-width: 576px) {
        .stats-card {
            padding: 1.5rem 1rem;
        }

        .stats-number {
            font-size: 1.8rem;
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
    }

    /* Responsive Profile Image Styling */
    .responsive-profile-img {
        width: 100%;
        object-fit: cover;
        object-position: center;
        transition: all 0.3s ease;
    }

    /* Desktop - Large screens */
    @media (min-width: 1200px) {
        .responsive-profile-img {
            height: 400px;
        }
    }

    /* Desktop - Medium screens */
    @media (min-width: 992px) and (max-width: 1199px) {
        .responsive-profile-img {
            height: 350px;
        }
    }

    /* Tablet */
    @media (min-width: 768px) and (max-width: 991px) {
        .responsive-profile-img {
            height: 300px;
        }
    }

    /* Mobile - Large */
    @media (min-width: 576px) and (max-width: 767px) {
        .responsive-profile-img {
            height: 280px;
        }
    }

    /* Mobile - Small */
    @media (max-width: 575px) {
        .responsive-profile-img {
            height: 250px;
        }
    }

    /* Hover effect for better interaction */
    .card:hover .responsive-profile-img {
        transform: scale(1.02);
    }

    /* Ensure card maintains proper aspect ratio */
    .card {
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
    }
</style>

<!-- Enhanced Dynamic Statistics Section -->
<div class="row mt-5 pt-4 border-top">
    <div class="col-12">
        <h4 class="text-center mb-4 stats-title">Statistik SDM</h4>
        <p class="text-center mb-4 stats-subtitle">Tim Profesional dan Berdedikasi</p>
    </div>

    <?php
    // Calculate dynamic statistics from real data
    $total_sdm = !empty($sdm_data) ? count($sdm_data) : 0;
    $total_asn = 0;
    $total_non_asn = 0;
    $total_institusi = 0;
    $total_pusat = 0;
    $total_jurusan = 0;
    $total_laki = 0;
    $total_perempuan = 0;

    if (!empty($sdm_data)) {
        foreach ($sdm_data as $sdm) {
            // Hitung berdasarkan status ASN
            if (!empty($sdm->nip)) {
                $total_asn++;
            } else {
                $total_non_asn++;
            }

            // Hitung berdasarkan jenis kelamin
            if ($sdm->jenis_kelamin == 'L') {
                $total_laki++;
            } elseif ($sdm->jenis_kelamin == 'P') {
                $total_perempuan++;
            }

            // Hitung berdasarkan level jabatan
            switch ($sdm->level) {
                case 'institusi':
                    $total_institusi++;
                    break;
                case 'pusat':
                    $total_pusat++;
                    break;
                case 'jurusan':
                    $total_jurusan++;
                    break;
            }
        }
    }
    ?>

    <div class="col-md-3 col-sm-6 mb-4">
        <div class="stats-card stats-primary">
            <div class="stats-icon">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stats-content">
                <h3 class="stats-number counter-number" data-target="<?php echo $total_sdm; ?>">0</h3>
                <p class="stats-label">Total SDM</p>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 mb-4">
        <div class="stats-card stats-success">
            <div class="stats-icon">
                <i class="bi bi-award-fill"></i>
            </div>
            <div class="stats-content">
                <h3 class="stats-number counter-number" data-target="<?php echo $total_asn; ?>">0</h3>
                <p class="stats-label">ASN</p>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 mb-4">
        <div class="stats-card stats-info">
            <div class="stats-icon">
                <i class="bi bi-briefcase-fill"></i>
            </div>
            <div class="stats-content">
                <h3 class="stats-number counter-number" data-target="<?php echo $total_non_asn; ?>">0</h3>
                <p class="stats-label">Non-ASN</p>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 mb-4">
        <div class="stats-card stats-warning">
            <div class="stats-icon">
                <i class="bi bi-building"></i>
            </div>
            <div class="stats-content">
                <h3 class="stats-number counter-number" data-target="<?php echo $total_pusat; ?>">0</h3>
                <p class="stats-label">Level Pusat</p>
            </div>
        </div>
    </div>
</div>

<!-- Additional Statistics Row -->
<?php if ($total_sdm > 0): ?>
    <div class="row mt-4">
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="stats-card-mini stats-danger">
                <div class="stats-icon-mini">
                    <i class="bi bi-diagram-3-fill"></i>
                </div>
                <div class="stats-content-mini">
                    <h4 class="stats-number-mini counter-number" data-target="<?php echo $total_institusi; ?>">0</h4>
                    <p class="stats-label-mini">Level Institusi</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 mb-3">
            <div class="stats-card-mini stats-secondary">
                <div class="stats-icon-mini">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
                <div class="stats-content-mini">
                    <h4 class="stats-number-mini counter-number" data-target="<?php echo $total_jurusan; ?>">0</h4>
                    <p class="stats-label-mini">Level Jurusan</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12 mb-3">
            <div class="stats-card-mini stats-gradient">
                <div class="gender-stats">
                    <div class="gender-item">
                        <i class="bi bi-person gender-icon-male"></i>
                        <span class="gender-count counter-number" data-target="<?php echo $total_laki; ?>">0</span>
                        <small>Laki-laki</small>
                    </div>
                    <div class="gender-divider"></div>
                    <div class="gender-item">
                        <i class="bi bi-person-dress gender-icon-female"></i>
                        <span class="gender-count counter-number" data-target="<?php echo $total_perempuan; ?>">0</span>
                        <small>Perempuan</small>
                    </div>
                </div>
                <p class="stats-label-mini mt-2">Gender Ratio</p>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- SDM Summary Cards -->
<?php if (!empty($sdm_list)): ?>
    <div class="row mt-5">
        <div class="col-12">
            <div class="summary-card">
                <div class="summary-header">
                    <h5 class="summary-title">
                        <i class="bi bi-graph-up me-2"></i>
                        Ringkasan SDM
                    </h5>
                </div>
                <div class="summary-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="summary-badge summary-badge-primary">
                                <i class="bi bi-people me-2"></i>
                                <span class="summary-text">Total: <strong><?php echo $total_sdm; ?></strong> Orang</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="summary-badge summary-badge-success">
                                <i class="bi bi-shield-check me-2"></i>
                                <span class="summary-text">ASN: <strong><?php echo $total_asn; ?></strong> Orang</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="summary-badge summary-badge-info">
                                <i class="bi bi-briefcase me-2"></i>
                                <span class="summary-text">Non-ASN: <strong><?php echo $total_non_asn; ?></strong> Orang</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="summary-badge summary-badge-warning">
                                <i class="bi bi-diagram-3 me-2"></i>
                                <span class="summary-text">Multi Level</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<style>
    /* Statistics Section Styling */
    .stats-title {
        color: #00B9AD;
        font-weight: 700;
        font-size: 2rem;
        position: relative;
        margin-bottom: 1rem;
    }

    .stats-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #00B9AD, #4CAF50);
        border-radius: 2px;
    }

    .stats-subtitle {
        color: #6c757d;
        font-size: 1.1rem;
        font-weight: 400;
    }

    /* Main Stats Cards */
    .stats-card {
        background: #fff;
        border-radius: 16px;
        padding: 2rem 1.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        height: 100%;
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--stats-color);
        transition: height 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .stats-card:hover::before {
        height: 6px;
    }

    .stats-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--stats-bg);
        color: var(--stats-color);
        font-size: 1.8rem;
        flex-shrink: 0;
    }

    .stats-content {
        flex: 1;
    }

    .stats-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--stats-color);
        margin: 0;
        line-height: 1;
    }

    .stats-label {
        color: #6c757d;
        font-size: 0.95rem;
        font-weight: 500;
        margin: 0.5rem 0 0 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Color Variants */
    .stats-primary {
        --stats-color: #007bff;
        --stats-bg: rgba(0, 123, 255, 0.1);
    }

    .stats-success {
        --stats-color: #28a745;
        --stats-bg: rgba(40, 167, 69, 0.1);
    }

    .stats-info {
        --stats-color: #17a2b8;
        --stats-bg: rgba(23, 162, 184, 0.1);
    }

    .stats-warning {
        --stats-color: #ffc107;
        --stats-bg: rgba(255, 193, 7, 0.1);
    }

    .stats-danger {
        --stats-color: #dc3545;
        --stats-bg: rgba(220, 53, 69, 0.1);
    }

    .stats-secondary {
        --stats-color: #6f42c1;
        --stats-bg: rgba(111, 66, 193, 0.1);
    }

    /* Mini Stats Cards */
    .stats-card-mini {
        background: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .stats-card-mini:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12);
    }

    .stats-icon-mini {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--stats-bg);
        color: var(--stats-color);
        font-size: 1.3rem;
        margin-bottom: 1rem;
    }

    .stats-number-mini {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--stats-color);
        margin: 0;
    }

    .stats-label-mini {
        color: #6c757d;
        font-size: 0.85rem;
        font-weight: 500;
        margin: 0.3rem 0 0 0;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    /* Gender Stats Special Card */
    .stats-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .stats-gradient .stats-label-mini {
        color: rgba(255, 255, 255, 0.8);
    }

    .gender-stats {
        display: flex;
        align-items: center;
        justify-content: space-around;
        margin-bottom: 0.5rem;
    }

    .gender-item {
        text-align: center;
        flex: 1;
    }

    .gender-icon-male {
        color: #4fc3f7;
        font-size: 1.5rem;
        display: block;
        margin-bottom: 0.3rem;
    }

    .gender-icon-female {
        color: #f06292;
        font-size: 1.5rem;
        display: block;
        margin-bottom: 0.3rem;
    }

    .gender-count {
        display: block;
        font-size: 1.4rem;
        font-weight: 700;
        color: white;
    }

    .gender-divider {
        width: 1px;
        height: 40px;
        background: rgba(255, 255, 255, 0.3);
        margin: 0 1rem;
    }

    /* Summary Card */
    .summary-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .summary-header {
        background: linear-gradient(135deg, #00B9AD, #4CAF50);
        padding: 1.5rem;
        color: white;
    }

    .summary-title {
        margin: 0;
        font-weight: 600;
        font-size: 1.3rem;
    }

    .summary-body {
        padding: 2rem;
    }

    .summary-badge {
        background: var(--badge-bg);
        color: var(--badge-color);
        border: 1px solid var(--badge-border);
        border-radius: 12px;
        padding: 0.8rem 1.2rem;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        height: 100%;
    }

    .summary-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px var(--badge-shadow);
    }

    .summary-badge-primary {
        --badge-bg: rgba(0, 123, 255, 0.1);
        --badge-color: #007bff;
        --badge-border: rgba(0, 123, 255, 0.2);
        --badge-shadow: rgba(0, 123, 255, 0.2);
    }

    .summary-badge-success {
        --badge-bg: rgba(40, 167, 69, 0.1);
        --badge-color: #28a745;
        --badge-border: rgba(40, 167, 69, 0.2);
        --badge-shadow: rgba(40, 167, 69, 0.2);
    }

    .summary-badge-info {
        --badge-bg: rgba(23, 162, 184, 0.1);
        --badge-color: #17a2b8;
        --badge-border: rgba(23, 162, 184, 0.2);
        --badge-shadow: rgba(23, 162, 184, 0.2);
    }

    .summary-badge-warning {
        --badge-bg: rgba(255, 193, 7, 0.1);
        --badge-color: #ffc107;
        --badge-border: rgba(255, 193, 7, 0.2);
        --badge-shadow: rgba(255, 193, 7, 0.2);
    }

    .summary-text {
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* Counter Animation */
    @keyframes countUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .counter-number {
        animation: countUp 0.6s ease;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .stats-card {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }

        .stats-number {
            font-size: 2rem;
        }

        .stats-title {
            font-size: 1.6rem;
        }

        .gender-stats {
            flex-direction: column;
            gap: 1rem;
        }

        .gender-divider {
            width: 40px;
            height: 1px;
            margin: 0.5rem 0;
        }
    }

    @media (max-width: 576px) {
        .stats-card {
            padding: 1.5rem 1rem;
        }

        .stats-number {
            font-size: 1.8rem;
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
    }
</style>

<script>
    // Counter Animation
    document.addEventListener('DOMContentLoaded', function() {
        const counterNumbers = document.querySelectorAll('.counter-number');

        const animateCounter = (element) => {
            const target = parseInt(element.getAttribute('data-target'));
            const duration = 2000; // 2 seconds
            const increment = target / (duration / 16); // 60 FPS
            let current = 0;

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.ceil(current);
                }
            }, 16);
        };

        // Intersection Observer for animation trigger
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        });

        counterNumbers.forEach(counter => {
            observer.observe(counter);
        });
    });
</script>