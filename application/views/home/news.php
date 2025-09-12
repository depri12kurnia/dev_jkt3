<!-- Latest News dengan Scroll Effects -->
<section id="latestnews" class="px-2 latest_news py-4 animate-on-scroll" data-animation="fadeIn">
    <div class="container py-2">
        <!-- Header dengan scroll effect -->
        <div class="news-header animate-on-scroll" data-animation="fadeInDown" data-delay="200">
            <h2 class="display-6 fw-semibold text-body-emphasis m-0 position-relative">
                Berita Terbaru
                <span class="title-underline"></span>
            </h2>
            <hr class="mt-2 mb-1 animate-line">
        </div>

        <!-- News Grid dengan staggered animation -->
        <div class="row py-3 row-cols-2 row-cols-lg-4">
            <?php $delay = 300;
            foreach ($berita as $index => $berita) { ?>
                <div class="col mb-2 animate-on-scroll" data-animation="fadeInUp" data-delay="<?php echo $delay; ?>">
                    <article class="news-item h-100">
                        <!-- Image Container -->
                        <div class="post-images text-black bg-body-secondary mb-3 text-center position-relative overflow-hidden rounded-3">
                            <a href="<?php echo base_url('berita/read/' . $berita->slug_berita); ?>"
                                title="<?php echo htmlspecialchars(strip_tags($berita->judul_berita)); ?>"
                                class="d-block image-link">
                                <img src="<?php echo base_url('assets/upload/image/thumbs/' . $berita->gambar); ?>"
                                    alt="<?php echo htmlspecialchars(strip_tags($berita->judul_berita)); ?>"
                                    class="img-fluid news-image lazyload">
                                <div class="image-overlay">
                                    <i class="bi bi-eye text-white"></i>
                                </div>
                            </a>
                        </div>

                        <!-- Content -->
                        <div class="news-content">
                            <a href="<?php echo base_url('berita/read/' . $berita->slug_berita); ?>"
                                title="<?php echo htmlspecialchars(strip_tags($berita->judul_berita)); ?>"
                                class="text-decoration-none">
                                <h3 class="fs-6 fw-semibold mb-3 news-title">
                                    <?php echo character_limiter(strip_tags($berita->judul_berita), 80); ?>
                                </h3>
                            </a>

                            <!-- Meta Info -->
                            <div class="news-meta d-flex flex-wrap gap-1">
                                <small class="badge bg-gradient-primary text-white pulse-badge">
                                    <i class="bi bi-star me-1"></i>Utama
                                </small>
                                <small class="badge bg-light text-dark border">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    <?php echo date('d M Y H:i', strtotime($berita->tanggal_publish)); ?>
                                </small>
                            </div>
                        </div>
                    </article>
                </div>
            <?php $delay += 100;
            } ?>
        </div>
    </div>

    <!-- More Button dengan scroll effect -->
    <div class="container btn-more d-flex justify-content-end align-items-center animate-on-scroll"
        data-animation="slideInRight" data-delay="<?php echo $delay + 200; ?>">
        <a href="<?php echo base_url('berita'); ?>"
            class="btn-more-link px-4 py-2 fs-7 fw-semibold mx-1"
            title="Selengkapnya">
            <span class="btn-text">Selengkapnya</span>
            <i class="bi bi-arrow-right ms-2"></i>
        </a>
    </div>
</section>

<style>
    /* Base Scroll Animation Styles */
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
            transform: translateY(-30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes pulseGlow {

        0%,
        100% {
            box-shadow: 0 0 5px rgba(0, 185, 173, 0.5);
            transform: scale(1);
        }

        50% {
            box-shadow: 0 0 15px rgba(0, 185, 173, 0.8);
            transform: scale(1.02);
        }
    }

    @keyframes lineGrow {
        from {
            width: 0;
        }

        to {
            width: 100%;
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

    .slideInRight {
        animation: slideInRight 0.8s ease-out;
    }

    /* News Section Styling */
    .latest_news {
        position: relative;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    }

    /* Header Effects */
    .news-header {
        position: relative;
    }

    .title-underline {
        position: absolute;
        bottom: -5px;
        left: 0;
        height: 3px;
        background: linear-gradient(90deg, #00B9AD, #4CAF50);
        border-radius: 2px;
        width: 0;
        transition: width 0.8s ease 0.5s;
    }

    .animate-on-scroll.animated .title-underline {
        width: 80px;
    }

    .animate-line {
        position: relative;
        overflow: hidden;
    }

    .animate-line::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 0;
        background: linear-gradient(90deg, #00B9AD, #4CAF50);
        transition: width 1s ease 0.3s;
    }

    .animate-on-scroll.animated .animate-line::after {
        width: 100%;
    }

    /* News Item Styling */
    .news-item {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .news-item:hover {
        transform: translateY(-5px);
    }

    /* Image Effects */
    .post-images {
        position: relative;
        overflow: hidden;
        border-radius: 12px !important;
        height: 200px;
    }

    .news-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .image-link:hover .news-image {
        transform: scale(1.1);
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(0, 185, 173, 0.8), rgba(76, 175, 80, 0.8));
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .image-link:hover .image-overlay {
        opacity: 1;
    }

    .image-overlay i {
        font-size: 2rem;
        animation: bounceIn 0.6s ease;
    }

    @keyframes bounceIn {
        0% {
            transform: scale(0);
        }

        50% {
            transform: scale(1.2);
        }

        100% {
            transform: scale(1);
        }
    }

    /* Content Styling */
    .news-title {
        color: #2c3e50;
        transition: color 0.3s ease;
        line-height: 1.4;
    }

    .news-title:hover {
        color: #00B9AD;
    }

    /* Badge Effects */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #00B9AD, #4CAF50) !important;
        border: none;
    }

    .pulse-badge {
        animation: pulseGlow 2s infinite;
    }

    .news-meta .badge {
        transition: transform 0.3s ease;
        font-size: 0.7rem;
    }

    .news-meta .badge:hover {
        transform: translateY(-2px);
    }

    /* More Button Effects */
    .btn-more-link {
        position: relative;
        text-decoration: none;
        color: #00B9AD;
        border: 2px solid transparent;
        border-radius: 25px;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .btn-more-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, #00B9AD, #4CAF50);
        transition: left 0.3s ease;
        z-index: -1;
    }

    .btn-more-link:hover {
        color: white;
        border-color: #00B9AD;
        transform: translateY(-2px);
    }

    .btn-more-link:hover::before {
        left: 0;
    }

    .btn-more-link i {
        transition: transform 0.3s ease;
    }

    .btn-more-link:hover i {
        transform: translateX(5px);
    }

    /* Hover Effects untuk seluruh card */
    .news-item {
        border-radius: 15px;
        padding: 0.5rem;
        transition: all 0.3s ease;
    }

    .news-item:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        background: rgba(255, 255, 255, 0.8);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .post-images {
            height: 160px;
        }

        .news-title {
            font-size: 0.9rem;
        }

        .animate-on-scroll {
            transition-duration: 0.6s;
        }
    }

    @media (max-width: 576px) {
        .post-images {
            height: 140px;
        }

        .news-meta {
            gap: 0.5rem;
        }

        .news-meta .badge {
            font-size: 0.65rem;
            padding: 0.3rem 0.5rem;
        }
    }

    /* Accessibility - Reduced Motion */
    @media (prefers-reduced-motion: reduce) {

        .animate-on-scroll,
        .news-item,
        .news-image,
        .pulse-badge,
        .btn-more-link {
            animation: none !important;
            transition: none !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Intersection Observer untuk scroll animations
        const observerOptions = {
            threshold: 0.2,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const element = entry.target;
                    const animation = element.dataset.animation;
                    const delay = parseInt(element.dataset.delay) || 0;

                    setTimeout(() => {
                        element.classList.add('animated', animation);
                    }, delay);

                    // Unobserve setelah animasi
                    observer.unobserve(element);
                }
            });
        }, observerOptions);

        // Observe semua elemen dengan animate-on-scroll
        const animateElements = document.querySelectorAll('.animate-on-scroll');
        animateElements.forEach(element => {
            observer.observe(element);
        });

        // Lazy loading untuk gambar
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.classList.remove('lazyload');
                        }
                        imageObserver.unobserve(img);
                    }
                });
            });

            // Observe gambar dengan class lazyload
            document.querySelectorAll('img.lazyload').forEach(img => {
                imageObserver.observe(img);
            });
        }

        // Performance optimization - throttle scroll events
        let ticking = false;

        function updateScrollEffects() {
            // Add any additional scroll-based effects here
            ticking = false;
        }

        function requestScrollUpdate() {
            if (!ticking) {
                requestAnimationFrame(updateScrollEffects);
                ticking = true;
            }
        }

        window.addEventListener('scroll', requestScrollUpdate);
    });
</script>