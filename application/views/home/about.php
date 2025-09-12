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
                                    <div class="about-greenforest-img p-3">
                                        <img src="<?php echo base_url('assets/upload/pages/' . $profil->gambar) ?>"
                                            alt="about-greenforest-img"
                                            class="img-fluid rounded-4 shadow lazyload zoom-on-hover animate-on-scroll"
                                            data-animation="zoomIn" data-delay="600"
                                            style="border-top-right-radius: 50px; border-bottom-left-radius: 50px; object-fit:cover; max-height:320px;" />
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
                                                    <img src="<?php echo base_url('assets/images/logos/ban-pt.png'); ?>"
                                                        alt="BAN-PT" height="30" class="img-fluid animate-on-scroll floating-logo"
                                                        data-animation="rotateIn" data-delay="1700">
                                                    <img src="<?php echo base_url('assets/images/logos/dikti-saintek.png'); ?>"
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
        transform: scale(1.05);
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

    .bg-about-greenforest::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="%23000" opacity="0.02"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        animation: grain 20s linear infinite;
    }

    @keyframes grain {

        0%,
        100% {
            transform: translate(0, 0);
        }

        10% {
            transform: translate(-5%, -10%);
        }

        20% {
            transform: translate(-15%, 5%);
        }

        30% {
            transform: translate(7%, -25%);
        }

        40% {
            transform: translate(-5%, 25%);
        }

        50% {
            transform: translate(-15%, 10%);
        }

        60% {
            transform: translate(15%, 0%);
        }

        70% {
            transform: translate(0%, 15%);
        }

        80% {
            transform: translate(3%, 35%);
        }

        90% {
            transform: translate(-10%, 10%);
        }
    }

    /* Staggered Animation for Feature Items */
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

    /* Responsive Animations */
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
    }

    /* Reduce motion for accessibility */
    @media (prefers-reduced-motion: reduce) {

        .animate-on-scroll,
        .hover-lift,
        .zoom-on-hover,
        .floating-logo,
        .pulse-button,
        .feature-item {
            animation: none !important;
            transition: none !important;
        }

        .bg-about-greenforest::before {
            animation: none !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const element = entry.target;
                    const animation = element.dataset.animation;
                    const delay = element.dataset.delay || 0;

                    setTimeout(() => {
                        element.classList.add('animated', animation);
                    }, delay);

                    observer.unobserve(element);
                }
            });
        }, observerOptions);

        // Observe all elements with animate-on-scroll class
        const animateElements = document.querySelectorAll('.animate-on-scroll');
        animateElements.forEach(element => {
            observer.observe(element);
        });

        // Parallax effect for background
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const aboutSection = document.getElementById('about-section');

            if (aboutSection) {
                const rate = scrolled * -0.5;
                const bgElement = aboutSection.querySelector('::before');
                if (bgElement) {
                    bgElement.style.transform = `translateY(${rate}px)`;
                }
            }
        });

        // Counter animation for numbers
        const counterElements = document.querySelectorAll('[data-counter]');
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const element = entry.target;
                    const target = parseInt(element.dataset.counter);
                    let current = 0;
                    const increment = target / 100;

                    const counterInterval = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            element.textContent = target;
                            clearInterval(counterInterval);
                        } else {
                            element.textContent = Math.floor(current);
                        }
                    }, 30);
                }
            });
        }, observerOptions);

        // Observe all counter elements
        counterElements.forEach(element => {
            counterObserver.observe(element);
        });
    });
</script>