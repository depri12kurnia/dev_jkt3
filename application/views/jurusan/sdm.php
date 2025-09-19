<div class="b-example-divider"></div>
<div class="container px-4 py-5" id="custom-cards">
    <div class="text-center mb-5">
        <h2 class="pb-2 border-bottom fw-bold" style="color: #00B9AD;">SDM Jurusan <?php echo $jurusan_data->nama; ?></h2>
        <p class="text-muted">Tim Profesional yang Berpengalaman dan Berdedikasi</p>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 py-3" id="sdm-container">
        <?php if (!empty($sdm_list)):
            $displayed_count = 0;
            $max_display = 4;
            foreach ($sdm_list as $index => $sdm):
                $is_hidden = $index >= $max_display;
                $displayed_count++;
        ?>
                <div class="col sdm-item <?php echo $is_hidden ? 'sdm-hidden d-none' : ''; ?>">
                    <div class="card h-100 shadow-lg border-0 overflow-hidden hover-lift">
                        <div class="position-relative">
                            <!-- Dynamic Image from Database -->
                            <img src="<?php
                                        if (!empty($sdm->foto_url)) {
                                            // Jika URL lengkap
                                            if (filter_var($sdm->foto_url, FILTER_VALIDATE_URL)) {
                                                echo $sdm->foto_url;
                                            } else {
                                                // Jika hanya nama file
                                                echo base_url('assets/upload/sdm/' . $sdm->foto_url);
                                            }
                                        } else {
                                            // Default avatar berdasarkan jenis kelamin
                                            $default_avatar = ($sdm->jenis_kelamin == 'P')
                                                ? 'default-female-avatar.jpg'
                                                : 'default-male-avatar.jpg';
                                            echo base_url('assets/upload/pusat/' . $default_avatar);
                                        }
                                        ?>"
                                class="card-img-top responsive-profile-img"
                                alt="Foto <?php echo htmlspecialchars($sdm->nama); ?>"
                                loading="lazy"
                                onerror="this.src='<?php echo base_url('assets/upload/sdm/default-avatar.jpg'); ?>'">

                            <!-- Dynamic Role Badge -->
                            <?php if (!empty($sdm->nip)): ?>
                                <!-- NIP Badge untuk yang memiliki NIP -->
                                <div class="position-absolute top-0 start-0 m-3">
                                    <span class="badge bg-warning text-dark rounded-pill">
                                        <i class="bi bi-award-fill me-1"></i>ASN
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="card-body text-center p-4">
                            <!-- Dynamic Name -->
                            <h5 class="card-title fw-bold mb-2">
                                <?php echo htmlspecialchars($sdm->nama); ?>
                            </h5>

                            <!-- Dynamic Position/Jabatan -->
                            <p class="text-muted mb-2">
                                <?php
                                if (!empty($sdm->jabatan)) {
                                    echo htmlspecialchars($sdm->jabatan);
                                } else {
                                    echo 'Staff';
                                }
                                ?>
                            </p>
                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-center gap-2 flex-wrap">
                                <a href="<?php echo base_url('sdm/detail/' . $sdm->sdm_slug); ?>"
                                    class="btn btn-sm btn-outline-primary"
                                    title="Informasi Detail">
                                    <i class="bi bi-info-circle-fill me-1"></i>Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <!-- No SDM Data Available -->
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-people text-muted" style="font-size: 4rem;"></i>
                    <h4 class="text-muted mt-3">Belum Ada Data SDM</h4>
                    <p class="text-muted">Data SDM untuk pusat ini sedang dalam proses input.</p>

                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Dynamic Show More Button -->
    <?php if (!empty($sdm_list) && count($sdm_list) > $max_display): ?>
        <div class="text-center mt-4">
            <button id="btn-show-more-sdm" class="btn btn-outline-primary">
                <i class="bi bi-chevron-down me-1"></i>
                <span class="btn-text">Tampilkan Lebih</span>
                <span class="badge bg-primary ms-2"><?php echo count($sdm_list) - $max_display; ?> lainnya</span>
            </button>
        </div>
    <?php endif; ?>
</div>

<style>
    /* Enhanced SDM Card Styling with Database Integration */
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
    }

    .card-img-top {
        transition: transform 0.3s ease;
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
    }

    .hover-lift:hover .card-img-top {
        transform: scale(1.05);
    }

    .badge {
        font-size: 0.75rem;
        font-weight: 500;
    }

    .card-footer hr {
        margin: 0.75rem 0;
        opacity: 0.1;
    }

    /* SDM Show More Animation */
    .sdm-hidden {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.5s ease;
    }

    .sdm-item.show-item {
        opacity: 1;
        transform: translateY(0);
    }

    /* Statistics Animation */
    .stat-item {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .stat-item:hover {
        transform: translateY(-5px);
        background: rgba(13, 110, 253, 0.05);
        border-radius: 10px;
    }

    .counter-number {
        transition: all 0.3s ease;
    }

    /* Enhanced Badge Colors */
    .badge.bg-danger {
        background-color: #dc3545 !important;
    }

    .badge.bg-primary {
        background-color: #0d6efd !important;
    }

    .badge.bg-success {
        background-color: #198754 !important;
    }

    .badge.bg-warning {
        background-color: #ffc107 !important;
        color: #000 !important;
    }

    /* Gender Icon Styling */
    .text-pink {
        color: #e91e63 !important;
    }

    /* Responsive Design for SDM Cards */
    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem !important;
        }

        .card-footer .row .col-4 {
            margin-bottom: 0.5rem;
        }

        .d-flex.gap-2 {
            flex-direction: column;
            gap: 0.5rem !important;
        }

        .btn-sm {
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
        }

        .flex-wrap {
            justify-content: center !important;
        }
    }

    @media (max-width: 576px) {
        .row.row-cols-1.row-cols-md-2.row-cols-lg-3 {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .card-footer .row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.5rem;
            text-align: center;
        }

        .d-flex.flex-wrap {
            flex-direction: column;
            align-items: center;
        }

        .btn-sm {
            width: 100%;
            max-width: 200px;
        }
    }

    /* Loading animation for images */
    .card-img-top[src] {
        background: none;
    }

    /* Enhanced hover effects */
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    /* Badge animations */
    .badge {
        transition: all 0.3s ease;
    }

    .hover-lift:hover .badge {
        transform: scale(1.05);
    }

    /* Email and WhatsApp button specific styling */
    .btn-outline-primary:hover {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .btn-outline-success:hover {
        background-color: #25D366;
        border-color: #25D366;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    /* Summary cards styling */
    .bg-primary-subtle {
        background-color: rgba(13, 110, 253, 0.1) !important;
    }

    .bg-success-subtle {
        background-color: rgba(25, 135, 84, 0.1) !important;
    }

    .bg-info-subtle {
        background-color: rgba(13, 202, 240, 0.1) !important;
    }

    .bg-warning-subtle {
        background-color: rgba(255, 193, 7, 0.1) !important;
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Show More SDM Functionality
        const btnShowMore = document.getElementById('btn-show-more-sdm');
        const hiddenItems = document.querySelectorAll('.sdm-hidden');
        let isExpanded = false;

        if (btnShowMore) {
            btnShowMore.addEventListener('click', function() {
                if (!isExpanded) {
                    // Show hidden items with staggered animation
                    hiddenItems.forEach((item, index) => {
                        setTimeout(() => {
                            item.classList.remove('d-none');
                            item.classList.add('show-item');
                        }, index * 100);
                    });

                    // Update button
                    this.innerHTML = `
                    <i class="bi bi-chevron-up me-1"></i>
                    <span class="btn-text">Tampilkan Lebih Sedikit</span>
                `;
                    isExpanded = true;
                } else {
                    // Hide items with staggered animation
                    hiddenItems.forEach((item, index) => {
                        setTimeout(() => {
                            item.classList.remove('show-item');
                            setTimeout(() => {
                                item.classList.add('d-none');
                            }, 300);
                        }, index * 50);
                    });

                    // Update button
                    this.innerHTML = `
                    <i class="bi bi-chevron-down me-1"></i>
                    <span class="btn-text">Tampilkan Lebih</span>
                    <span class="badge bg-primary ms-2"><?php echo !empty($sdm_list) ? count($sdm_list) - $max_display : 0; ?> lainnya</span>
                `;
                    isExpanded = false;

                    // Scroll back to SDM section
                    document.getElementById('custom-cards').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        }

        // Counter Animation for Statistics
        function animateCounter(element, target) {
            let current = 0;
            const increment = target / 100;
            const timer = setInterval(() => {
                current += increment;
                element.textContent = Math.round(current);
                if (current >= target) {
                    clearInterval(timer);
                    element.textContent = target;
                }
            }, 20);
        }

        // Trigger counter animation when statistics section is visible
        const observerOptions = {
            threshold: 0.3,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counters = entry.target.querySelectorAll('.counter-number');
                    counters.forEach(counter => {
                        const target = parseInt(counter.getAttribute('data-target'));
                        animateCounter(counter, target);
                    });
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe statistics sections
        const statsSection = document.querySelector('.row.mt-5.pt-4.border-top');
        if (statsSection) {
            observer.observe(statsSection);
        }

        // Enhanced image loading with error handling
        const images = document.querySelectorAll('.card-img-top');
        images.forEach(img => {
            img.addEventListener('load', function() {
                this.style.opacity = '1';
                this.style.background = 'none';
            });

            img.addEventListener('error', function() {
                this.style.backgroundColor = '#f8f9fa';
                this.style.display = 'flex';
                this.style.alignItems = 'center';
                this.style.justifyContent = 'center';
                this.innerHTML = '<i class="bi bi-person-circle text-muted" style="font-size: 3rem;"></i>';
            });
        });

        // Track user interactions for analytics
        document.querySelectorAll('.btn, .card').forEach(element => {
            element.addEventListener('click', function() {
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'sdm_interaction', {
                        'event_category': 'SDM Section',
                        'event_label': this.textContent.trim() || this.className,
                        'page_title': '<?php echo $pusat_data->nama; ?>',
                        'total_sdm': <?php echo !empty($sdm_list) ? count($sdm_list) : 0; ?>
                    });
                }
            });
        });

        // Add tooltip for badges
        const badges = document.querySelectorAll('.badge');
        badges.forEach(badge => {
            badge.setAttribute('title', badge.textContent.trim());
        });

        // Statistics hover effects
        const statItems = document.querySelectorAll('.stat-item');
        statItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                const icon = this.querySelector('i');
                if (icon) {
                    icon.style.transform = 'scale(1.1) rotate(5deg)';
                }
            });

            item.addEventListener('mouseleave', function() {
                const icon = this.querySelector('i');
                if (icon) {
                    icon.style.transform = 'scale(1) rotate(0deg)';
                }
            });
        });
    });
</script>