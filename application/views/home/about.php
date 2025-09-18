<!-- About Section dengan Scroll Animation -->
<section class="bg-about-greenforest py-5 scroll-animate" id="about-section">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <?php $noprof = 1;
            foreach ($profil as $profil) {
                if ($noprof == 1) { ?>
                    <div class="col-lg-12 col-md-12 animate-on-scroll" data-animation="fadeInUp" data-delay="200">
                        <div class="card shadow-lg border-0 rounded-4 overflow-hidden hover-lift">
                            <div class="row g-0 align-items-center">
                                <div class="col-md-7 bg-light d-flex align-items-center justify-content-center animate-on-scroll" data-animation="slideInLeft" data-delay="400">
                                    <div class="about-greenforest-img p-3 position-relative">
                                        <!-- PERBAIKAN: Simplified Image Loading -->
                                        <img data-src="<?php echo base_url('assets/upload/pages/' . $profil->gambar); ?>"
                                            src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='320'%3E%3Crect width='100%25' height='100%25' fill='%23f8f9fa'/%3E%3Ctext x='50%25' y='50%25' text-anchor='middle' dy='.3em' fill='%236c757d' font-family='Arial,sans-serif' font-size='16'%3EMemuat gambar...%3C/text%3E%3C/svg%3E"
                                            alt="about-greenforest-img"
                                            class="img-fluid rounded-4 shadow about-image-lazy zoom-on-hover animate-on-scroll"
                                            data-animation="zoomIn"
                                            data-delay="600"
                                            loading="lazy"
                                            width="400"
                                            height="320"
                                            style="border-top-right-radius: 50px; border-bottom-left-radius: 50px; object-fit:cover; max-height:320px;" />

                                        <!-- Loading overlay untuk feedback visual -->
                                        <div class="about-image-loading-overlay">
                                            <div class="about-loading-content">
                                                <div class="about-loading-spinner"></div>
                                                <span class="about-loading-text">Memuat gambar...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 p-4 animate-on-scroll" data-animation="slideInRight" data-delay="500">
                                    <div class="about-greenforest-content">
                                        <h2 class="fw-bold mb-3 animate-on-scroll" data-animation="fadeInDown" data-delay="700">
                                            <a href="<?php echo base_url('pages/tentang/' . $profil->slug_pages); ?>"
                                                class="text-decoration-none text-primary-dark hover-underline">
                                                <?php echo $profil->judul_pages ?>
                                            </a>
                                        </h2>
                                        <p class="text-secondary mb-3 text-justify animate-on-scroll" data-animation="fadeIn" data-delay="800">
                                            <?php echo character_limiter(strip_tags($profil->isi), 500); ?>
                                        </p>
                                        <div class="about-features animate-on-scroll" data-animation="fadeInUp" data-delay="900">
                                            <div class="row g-2">
                                                <div class="col-6 animate-on-scroll" data-animation="bounceIn" data-delay="1000">
                                                    <div class="feature-item d-flex align-items-center">
                                                        <i class="fa fa-check-circle text-success me-2"></i>
                                                        <small class="text-muted">Terakreditasi Unggul</small>
                                                    </div>
                                                </div>
                                                <div class="col-6 animate-on-scroll" data-animation="bounceIn" data-delay="1100">
                                                    <div class="feature-item d-flex align-items-center">
                                                        <i class="fa fa-graduation-cap text-primary me-2"></i>
                                                        <small class="text-muted">10+ Program Studi</small>
                                                    </div>
                                                </div>
                                                <div class="col-6 animate-on-scroll" data-animation="bounceIn" data-delay="1200">
                                                    <div class="feature-item d-flex align-items-center">
                                                        <i class="fa fa-users text-info me-2"></i>
                                                        <small class="text-muted">3000+ Mahasiswa</small>
                                                    </div>
                                                </div>
                                                <div class="col-6 animate-on-scroll" data-animation="bounceIn" data-delay="1300">
                                                    <div class="feature-item d-flex align-items-center">
                                                        <i class="fa fa-trophy text-warning me-2"></i>
                                                        <small class="text-muted">Prestasi Unggulan</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="about-action mt-4 animate-on-scroll" data-animation="fadeInUp" data-delay="1400">
                                            <a href="<?php echo base_url('pages/tentang/' . $profil->slug_pages); ?>"
                                                class="btn btn-primary btn-sm px-4 py-2 rounded-pill text-white pulse-button">
                                                <i class="fa fa-arrow-right me-2"></i>Selengkapnya
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accreditation-section mt-3 animate-on-scroll" data-animation="slideInUp" data-delay="1500">
                                <div class="card border-0 bg-white shadow-sm">
                                    <div class="card-body p-3">
                                        <div class="row align-items-center g-3">
                                            <div class="col-12 col-md-8">
                                                <h6 class="mb-2 small fw-bold animate-on-scroll" data-animation="fadeIn" data-delay="1600">Terakreditasi & Diakui:</h6>
                                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                                    <img src="<?php echo base_url('assets/images/logos/ban-pt.webp'); ?>"
                                                        alt="BAN-PT" height="30" class="img-fluid animate-on-scroll floating-logo"
                                                        data-animation="rotateIn" data-delay="1700">
                                                    <img src="<?php echo base_url('assets/images/logos/dikti-saintek.webp'); ?>"
                                                        alt="Dikti Saintek" height="30" class="img-fluid animate-on-scroll floating-logo"
                                                        data-animation="rotateIn" data-delay="1800">
                                                    <span class="badge bg-success animate-on-scroll" data-animation="pulse" data-delay="1900">Akreditasi A</span>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 text-start text-md-end">
                                                <div class="trust-indicators d-flex flex-wrap gap-1 justify-content-start justify-content-md-end">
                                                    <span class="badge bg-warning text-dark animate-on-scroll" data-animation="bounceIn" data-delay="2000">
                                                        <i class="bi bi-shield-check me-1"></i>Terpercaya
                                                    </span>
                                                    <span class="badge bg-info text-white animate-on-scroll" data-animation="bounceIn" data-delay="2100">
                                                        <i class="bi bi-award me-1"></i>Bersertifikat
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php }
                $noprof++;
            } ?>
        </div>
    </div>
</section>

<style>
    /* Base Animation Styles */
    .animate-on-scroll {
        opacity: 0;
        transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        will-change: transform, opacity;
    }

    .animate-on-scroll.animated {
        opacity: 1;
    }

    /* === SIMPLIFIED LAZY LOADING STYLES === */

    /* About Image Lazy Loading - SIMPLIFIED */
    .about-image-lazy {
        opacity: 1;
        /* PERBAIKAN: Tetap terlihat saat loading */
        transition: opacity 0.6s ease-in-out, transform 0.3s ease;
        will-change: opacity, transform;
        transform: translateZ(0);
        backface-visibility: hidden;
    }

    .about-image-lazy.about-loaded {
        opacity: 1;
    }

    .about-image-lazy.about-error {
        background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        opacity: 1;
    }

    /* Loading Overlay - SIMPLIFIED */
    .about-image-loading-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(255, 255, 255, 0.9);
        border-radius: 12px;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        z-index: 10;
        backdrop-filter: blur(2px);
        transition: all 0.6s ease-in-out;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .about-image-loading-overlay.about-hidden {
        opacity: 0;
        pointer-events: none;
        visibility: hidden;
    }

    .about-loading-content {
        text-align: center;
        color: #6c757d;
    }

    .about-loading-spinner {
        width: 32px;
        height: 32px;
        border: 3px solid rgba(108, 117, 125, 0.2);
        border-left-color: #00B9AD;
        border-radius: 50%;
        animation: about-spin 1s linear infinite;
        margin-bottom: 0.5rem;
    }

    .about-loading-text {
        font-size: 0.9rem;
        font-weight: 500;
    }

    @keyframes about-spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* Animation Keyframes */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-50px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-100px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(100px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(100px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.3);
        }

        50% {
            opacity: 1;
            transform: scale(1.05);
        }

        70% {
            transform: scale(0.9);
        }

        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes rotateIn {
        from {
            opacity: 0;
            transform: rotate(-360deg);
        }

        to {
            opacity: 1;
            transform: rotate(0deg);
        }
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }

    /* Animation Classes */
    .fadeIn {
        animation: fadeIn 0.8s ease-out;
    }

    .fadeInUp {
        animation: fadeInUp 0.8s ease-out;
    }

    .fadeInDown {
        animation: fadeInDown 0.8s ease-out;
    }

    .slideInLeft {
        animation: slideInLeft 0.8s ease-out;
    }

    .slideInRight {
        animation: slideInRight 0.8s ease-out;
    }

    .slideInUp {
        animation: slideInUp 0.8s ease-out;
    }

    .zoomIn {
        animation: zoomIn 0.8s ease-out;
    }

    .bounceIn {
        animation: bounceIn 0.8s ease-out;
    }

    .rotateIn {
        animation: rotateIn 0.8s ease-out;
    }

    .pulse {
        animation: pulse 1s ease-in-out;
    }

    /* Hover Effects */
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
    }

    .zoom-on-hover {
        transition: transform 0.3s ease;
    }

    .zoom-on-hover:hover {
        transform: scale(1.05) translateZ(0);
    }

    .hover-underline {
        position: relative;
        text-decoration: none !important;
    }

    .hover-underline::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -2px;
        left: 0;
        background: linear-gradient(90deg, #00B9AD, #4CAF50);
        transition: width 0.3s ease;
    }

    .hover-underline:hover::after {
        width: 100%;
    }

    /* Floating Animation for Logos */
    .floating-logo {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    /* Pulse Button */
    .pulse-button {
        position: relative;
        overflow: hidden;
    }

    .pulse-button::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .pulse-button:hover::before {
        width: 300px;
        height: 300px;
    }

    /* Background with Parallax Effect */
    .bg-about-greenforest {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        position: relative;
        overflow: hidden;
    }

    /* Feature Items */
    .feature-item {
        transition: all 0.3s ease;
    }

    .feature-item:hover {
        transform: translateX(10px);
        color: #00B9AD;
    }

    .feature-item i {
        transition: all 0.3s ease;
    }

    .feature-item:hover i {
        transform: scale(1.2);
        color: #00B9AD !important;
    }

    /* Trust Indicators Animation */
    .trust-indicators .badge {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .trust-indicators .badge:hover {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .animate-on-scroll {
            transition-duration: 0.6s;
        }

        .slideInLeft,
        .slideInRight {
            animation-name: fadeInUp;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
        }

        .about-loading-spinner {
            width: 28px;
            height: 28px;
            border-width: 2px;
        }

        .about-loading-text {
            font-size: 0.8rem;
        }
    }

    @media (max-width: 480px) {
        .about-loading-spinner {
            width: 24px;
            height: 24px;
        }

        .about-loading-text {
            font-size: 0.75rem;
        }
    }

    /* Accessibility */
    @media (prefers-reduced-motion: reduce) {

        .animate-on-scroll,
        .hover-lift,
        .zoom-on-hover,
        .floating-logo,
        .pulse-button,
        .feature-item {
            animation: none !important;
            transition: opacity 0.3s ease !important;
        }

        .about-loading-spinner {
            animation: none;
            border-left-color: transparent;
            border-top-color: #00B9AD;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // === SIMPLIFIED ABOUT IMAGE LAZY LOADER ===

        function loadAboutImage() {
            const aboutImage = document.querySelector('.about-image-lazy');
            const loadingOverlay = document.querySelector('.about-image-loading-overlay');

            if (!aboutImage || !aboutImage.dataset.src) return;

            // Langsung load gambar tanpa kompleksitas berlebihan
            const img = new Image();

            img.onload = function() {
                // Update src
                aboutImage.src = aboutImage.dataset.src;
                aboutImage.removeAttribute('data-src');
                aboutImage.classList.add('about-loaded');

                // Hide loading overlay
                if (loadingOverlay) {
                    loadingOverlay.classList.add('about-hidden');
                    setTimeout(() => {
                        loadingOverlay.style.display = 'none';
                    }, 600);
                }
            };

            img.onerror = function() {
                aboutImage.classList.add('about-error');
                if (loadingOverlay) {
                    loadingOverlay.innerHTML = '<div class="about-loading-content"><span class="about-loading-text" style="color: #dc3545;">Gagal memuat gambar</span></div>';
                }
                console.warn('Failed to load about image');
            };

            // Start loading
            img.src = aboutImage.dataset.src;
        }

        // Setup intersection observer untuk about image
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        loadAboutImage();
                        imageObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '50px 0px'
            });

            const aboutImage = document.querySelector('.about-image-lazy');
            if (aboutImage) {
                imageObserver.observe(aboutImage);
            }
        } else {
            // Fallback untuk browser tanpa IntersectionObserver
            loadAboutImage();
        }

        // === ANIMATION INTERSECTION OBSERVER ===

        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const element = entry.target;

                    if (element.classList.contains('animated') ||
                        element.classList.contains('about-image-lazy')) {
                        return;
                    }

                    const animation = element.dataset.animation;
                    const delay = parseInt(element.dataset.delay) || 0;

                    setTimeout(() => {
                        element.classList.add('animated', animation);
                    }, delay);

                    observer.unobserve(element);
                }
            });
        }, observerOptions);

        // Observe all animate elements
        const animateElements = document.querySelectorAll('.animate-on-scroll');
        animateElements.forEach(element => {
            observer.observe(element);
        });

        // === FALLBACK LOADING (backup jika lazy loading gagal) ===

        setTimeout(() => {
            const aboutImage = document.querySelector('.about-image-lazy');
            if (aboutImage && aboutImage.dataset.src && !aboutImage.classList.contains('about-loaded')) {
                console.log('Fallback: Loading about image directly');
                loadAboutImage();
            }
        }, 2000);
    });
</script>