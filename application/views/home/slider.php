<!-- Slider Section -->
<section class="slider-fullwidth">
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
            <?php
            // Load helper untuk optimasi gambar
            $this->load->helper('image_optimizer');

            foreach ($slider as $idx => $slide) : ?>
                <div class="carousel-item <?php if ($idx == 0) echo 'active'; ?>" data-slide-index="<?php echo $idx; ?>">
                    <?php if ($idx == 0): ?>
                        <!-- Slide pertama dengan eager loading dan WebP support -->
                        <picture class="slider-picture">
                            <source
                                srcset="<?php echo base_url('assets/upload/image/' . pathinfo($slide->gambar, PATHINFO_FILENAME) . '.webp'); ?>"
                                type="image/webp"
                                class="slider-webp-source">
                            <source
                                srcset="<?php echo base_url('assets/upload/image/' . $slide->gambar); ?>"
                                type="image/<?php echo pathinfo($slide->gambar, PATHINFO_EXTENSION); ?>"
                                class="slider-fallback-source">
                            <img src="<?php echo base_url('assets/upload/image/' . $slide->gambar); ?>"
                                loading="eager"
                                fetchpriority="high"
                                class="d-block w-100 h-100 slider-loaded slider-optimized"
                                alt="<?php echo htmlspecialchars($slide->judul_galeri); ?>"
                                width="1920"
                                height="1080"
                                data-slide-index="<?php echo $idx; ?>"
                                data-original-src="<?php echo base_url('assets/upload/image/' . $slide->gambar); ?>"
                                style="object-fit: cover; object-position: center;">
                        </picture>
                    <?php else: ?>
                        <!-- Slide lainnya dengan lazy loading dan WebP support -->
                        <picture class="slider-picture">
                            <source
                                data-srcset="<?php echo base_url('assets/upload/image/' . pathinfo($slide->gambar, PATHINFO_FILENAME) . '.webp'); ?>"
                                type="image/webp"
                                class="slider-webp-source slider-lazy-source">
                            <source
                                data-srcset="<?php echo base_url('assets/upload/image/' . $slide->gambar); ?>"
                                type="image/<?php echo pathinfo($slide->gambar, PATHINFO_EXTENSION); ?>"
                                class="slider-fallback-source slider-lazy-source">
                            <img data-src="<?php echo base_url('assets/upload/image/' . $slide->gambar); ?>"
                                data-webp-src="<?php echo base_url('assets/upload/image/' . pathinfo($slide->gambar, PATHINFO_FILENAME) . '.webp'); ?>"
                                src="<?php echo generate_placeholder_svg(1920, 1080, 'Memuat gambar...'); ?>"
                                loading="lazy"
                                class="d-block w-100 h-100 slider-lazyload slider-optimized"
                                data-slide-index="<?php echo $idx; ?>"
                                alt="<?php echo htmlspecialchars($slide->judul_galeri); ?>"
                                width="1920"
                                height="1080"
                                style="object-fit: cover; object-position: center;">
                        </picture>

                        <!-- Enhanced loading overlay -->
                        <div class="slider-loading-overlay" data-slide="<?php echo $idx; ?>">
                            <div class="slider-loading-content">
                                <div class="slider-spinner"></div>
                                <span class="slider-loading-text">Memuat gambar...</span>
                                <div class="slider-progress-bar">
                                    <div class="slider-progress-fill"></div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Overlay untuk konten teks -->
                    <div class="carousel-caption">
                        <div class="hero-content" data-aos="fade-up" data-aos-delay="300">
                            <h3 class="hero-title"><?php echo htmlspecialchars($slide->judul_galeri); ?></h3>
                            <?php if (!empty($slide->isi)): ?>
                                <p class="hero-description"><?php echo ($slide->isi); ?></p>
                            <?php else: ?>
                                <p class="hero-description">Mencetak tenaga kesehatan profesional, humanis, dan berdaya saing global dengan pendidikan berkualitas tinggi.</p>
                            <?php endif; ?>
                            <div class="hero-buttons">
                                <a href="<?php echo $slide->website; ?>" class="btn-success">
                                    <i class="fa fa-info-circle"></i> Pelajari Lebih Lanjut
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Dark overlay untuk readability -->
                    <div class="slide-overlay"></div>
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
</section>

<style>
    /* Full width slider styling - specific to slider only */
    .slider-fullwidth {
        width: 100vw;
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        padding: 0;
        overflow: hidden;
    }

    .slider-fullwidth .carousel {
        width: 100%;
        height: 70vh;
        min-height: 500px;
        margin: 0;
        padding: 0;
    }

    .slider-fullwidth .carousel-inner {
        height: 100%;
    }

    .slider-fullwidth .carousel-item {
        height: 100%;
        position: relative;
        /* PERBAIKAN: Tambahkan positioning */
    }

    .slider-fullwidth .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    /* Enhanced controls styling */
    .slider-fullwidth .carousel-control-prev,
    .slider-fullwidth .carousel-control-next {
        width: 60px;
        height: 60px;
        background: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0.8;
        transition: all 0.3s ease;
        border: 2px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(10px);
    }

    .slider-fullwidth .carousel-control-prev:hover,
    .slider-fullwidth .carousel-control-next:hover {
        background: rgba(0, 0, 0, 0.7);
        opacity: 1;
        transform: translateY(-50%) scale(1.1);
        border-color: rgba(255, 255, 255, 0.5);
    }

    .slider-fullwidth .carousel-control-prev {
        left: 20px;
    }

    .slider-fullwidth .carousel-control-next {
        right: 20px;
    }

    .slider-fullwidth .carousel-control-prev span,
    .slider-fullwidth .carousel-control-next span {
        font-size: 1.5rem;
        color: white;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
    }

    /* Enhanced indicators */
    .slider-fullwidth .carousel-indicators {
        bottom: 30px;
        margin-bottom: 0;
    }

    .slider-fullwidth .carousel-indicators button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin: 0 5px;
        background: rgba(255, 255, 255, 0.5);
        border: 2px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
        backdrop-filter: blur(5px);
    }

    .slider-fullwidth .carousel-indicators button.active {
        background: white;
        border-color: rgba(255, 255, 255, 0.8);
        transform: scale(1.2);
    }

    .slider-fullwidth .carousel-indicators button:hover {
        background: rgba(255, 255, 255, 0.8);
        transform: scale(1.1);
    }

    /* Slide overlay for better text readability */
    .slider-fullwidth .slide-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.2));
        z-index: 5;
    }

    /* Carousel caption styling */
    .slider-fullwidth .carousel-caption {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 10;
        text-align: center;
        color: white;
        width: 90%;
        max-width: 800px;
    }

    /* Hero content styling */
    .slider-fullwidth .hero-content {
        padding: 2rem;
    }

    .slider-fullwidth .hero-title {
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        line-height: 1.2;
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        background: linear-gradient(45deg, #ffffff, #f8f9fa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, 0.3));
    }

    .slider-fullwidth .hero-description {
        font-size: 1.25rem;
        line-height: 1.6;
        margin-bottom: 2.5rem;
        color: rgba(255, 255, 255, 0.95);
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .slider-fullwidth .hero-buttons {
        display: flex;
        gap: 1.5rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .slider-fullwidth .btn-success,
    .slider-fullwidth .btn-secondary {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.7rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.3);
        position: relative;
        overflow: hidden;
    }

    .slider-fullwidth .btn-success {
        background: linear-gradient(135deg, #06b6d4, #0891b2);
        color: white;
        box-shadow: 0 10px 25px rgba(6, 182, 212, 0.4);
    }

    .slider-fullwidth .btn-secondary {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
        color: white;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .slider-fullwidth .btn-success:hover {
        background: linear-gradient(135deg, #0891b2, #0e7490);
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 15px 35px rgba(6, 182, 212, 0.6);
    }

    .slider-fullwidth .btn-secondary:hover {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.15));
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
    }

    /* === ENHANCED CSS OPTIMIZATIONS === */

    /* Picture element styling */
    .slider-picture {
        width: 100%;
        height: 100%;
        display: block;
        position: relative;
    }

    .slider-picture source,
    .slider-picture img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    /* Enhanced Lazy Loading Styles */
    .slider-optimized {
        will-change: opacity, transform;
        transform: translateZ(0);
        backface-visibility: hidden;
    }

    .slider-lazyload {
        opacity: 1;
        transition: opacity 0.6s ease-in-out, filter 0.3s ease;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 25%, #f8f9fa 50%, #e9ecef 75%, #f8f9fa 100%);
        background-size: 400% 400%;
        animation: slider-shimmer 2s ease-in-out infinite;
        filter: blur(1px);
    }

    .slider-lazyload.slider-lazyloaded {
        background: none;
        animation: none;
        opacity: 1;
        filter: none;
    }

    .slider-lazyload.slider-lazyerror {
        background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        opacity: 1;
        animation: none;
        filter: none;
    }

    /* Enhanced Loading Overlay */
    .slider-loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg,
                rgba(248, 249, 250, 0.95) 0%,
                rgba(233, 236, 239, 0.98) 25%,
                rgba(248, 249, 250, 0.95) 50%,
                rgba(233, 236, 239, 0.98) 75%,
                rgba(248, 249, 250, 0.95) 100%);
        background-size: 400% 400%;
        animation: slider-shimmer 2.5s ease-in-out infinite;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        backdrop-filter: blur(3px);
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 8px;
        margin: 4px;
    }

    .slider-loading-overlay.slider-hidden {
        opacity: 0;
        pointer-events: none;
        visibility: hidden;
        transform: scale(0.95);
    }

    .slider-loading-content {
        text-align: center;
        color: #6c757d;
        z-index: 11;
        padding: 2rem;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        max-width: 300px;
        transform: translateY(-10px);
    }

    /* Enhanced Spinner */
    .slider-spinner {
        width: 60px;
        height: 60px;
        border: 4px solid rgba(108, 117, 125, 0.15);
        border-left-color: #007bff;
        border-top-color: #007bff;
        border-radius: 50%;
        animation: slider-spin 1.2s linear infinite;
        margin: 0 auto 1.5rem;
        position: relative;
    }

    .slider-spinner::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 30px;
        height: 30px;
        border: 2px solid transparent;
        border-left-color: rgba(0, 123, 255, 0.6);
        border-radius: 50%;
        animation: slider-spin 0.8s linear infinite reverse;
    }

    .slider-loading-text {
        font-size: 1.1rem;
        font-weight: 600;
        text-shadow: 0 1px 2px rgba(255, 255, 255, 0.8);
        margin-bottom: 1rem;
        color: #495057;
        letter-spacing: 0.5px;
    }

    /* Progress Bar */
    .slider-progress-bar {
        width: 100%;
        height: 6px;
        background: rgba(0, 0, 0, 0.1);
        border-radius: 3px;
        overflow: hidden;
        position: relative;
        margin-top: 1rem;
    }

    .slider-progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #007bff, #0056b3, #007bff);
        background-size: 200% 100%;
        border-radius: 3px;
        width: 0%;
        transition: width 0.3s ease;
        animation: slider-progress-shimmer 1.5s ease-in-out infinite;
    }

    /* Error State */
    .slider-error-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
    }

    /* WebP Support Enhancement */
    .slider-webp-source {
        transition: opacity 0.3s ease;
    }

    .slider-fallback-source {
        transition: opacity 0.3s ease;
    }

    /* Performance Optimizations */
    .slider-lazyload,
    .slider-loaded,
    .slider-optimized {
        contain: layout style paint;
        transform: translateZ(0);
        will-change: auto;
    }

    /* Enhanced Animations */
    @keyframes slider-shimmer {
        0% {
            background-position: -400% 0;
        }

        50% {
            background-position: 0% 0;
        }

        100% {
            background-position: 400% 0;
        }
    }

    @keyframes slider-spin {
        to {
            transform: rotate(360deg);
        }
    }

    @keyframes slider-progress-shimmer {
        0% {
            background-position: -200% 0;
        }

        100% {
            background-position: 200% 0;
        }
    }

    /* Smooth slide transitions */
    .slider-fullwidth .carousel-item {
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .slider-fullwidth .carousel-fade .carousel-item {
        opacity: 0;
        transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .slider-fullwidth .carousel-fade .carousel-item.active {
        opacity: 1;
    }

    /* Responsive optimizations */
    @media (max-width: 768px) {
        .slider-loading-content {
            padding: 1.5rem;
            max-width: 250px;
        }

        .slider-spinner {
            width: 50px;
            height: 50px;
            border-width: 3px;
        }

        .slider-spinner::after {
            width: 25px;
            height: 25px;
            border-width: 2px;
        }

        .slider-loading-text {
            font-size: 1rem;
        }

        .slider-progress-bar {
            height: 4px;
        }
    }

    @media (max-width: 480px) {
        .slider-loading-content {
            padding: 1rem;
            max-width: 200px;
        }

        .slider-spinner {
            width: 40px;
            height: 40px;
            border-width: 2px;
        }

        .slider-spinner::after {
            width: 20px;
            height: 20px;
            border-width: 1px;
        }

        .slider-loading-text {
            font-size: 0.9rem;
            margin-bottom: 0.8rem;
        }

        .slider-error-icon {
            font-size: 2rem;
        }
    }

    /* Prefers-reduced-motion support */
    @media (prefers-reduced-motion: reduce) {

        .slider-lazyload,
        .slider-loading-overlay,
        .slider-spinner,
        .slider-progress-fill {
            animation: none;
        }

        .slider-fullwidth .carousel-item {
            transition: none;
        }
    }

    /* High contrast mode support */
    @media (prefers-contrast: high) {
        .slider-loading-overlay {
            background: rgba(255, 255, 255, 0.98);
            border: 2px solid #000;
        }

        .slider-loading-content {
            background: #fff;
            border: 1px solid #000;
        }

        .slider-spinner {
            border-color: #000;
            border-left-color: #007bff;
        }
    }

    /* Responsive adjustments - SAMA SEPERTI SEBELUMNYA */
    @media (max-width: 768px) {
        .slider-fullwidth .carousel {
            height: 50vh;
            min-height: 350px;
        }

        .slider-fullwidth .carousel-control-prev,
        .slider-fullwidth .carousel-control-next {
            width: 45px;
            height: 45px;
        }

        .slider-fullwidth .carousel-control-prev {
            left: 10px;
        }

        .slider-fullwidth .carousel-control-next {
            right: 10px;
        }

        .slider-fullwidth .carousel-control-prev span,
        .slider-fullwidth .carousel-control-next span {
            font-size: 1.2rem;
        }

        .slider-fullwidth .carousel-indicators {
            bottom: 20px;
        }

        .slider-fullwidth .carousel-indicators button {
            width: 10px;
            height: 10px;
            margin: 0 3px;
        }

        .slider-fullwidth .hero-title {
            font-size: 1.8rem;
        }

        .slider-fullwidth .hero-description {
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        .slider-fullwidth .hero-buttons {
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .slider-fullwidth .btn-success,
        .slider-fullwidth .btn-secondary {
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
            width: auto;
            max-width: 240px;
        }

        .slider-fullwidth .hero-content {
            padding: 1.5rem;
        }

        .slider-spinner {
            width: 40px;
            height: 40px;
            border-width: 3px;
        }

        .slider-loading-text {
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .slider-fullwidth .carousel {
            height: 40vh;
            min-height: 300px;
        }

        .slider-fullwidth .carousel-control-prev,
        .slider-fullwidth .carousel-control-next {
            width: 40px;
            height: 40px;
        }

        .slider-fullwidth .carousel-control-prev span,
        .slider-fullwidth .carousel-control-next span {
            font-size: 1rem;
        }

        .slider-fullwidth .carousel-indicators button {
            width: 8px;
            height: 8px;
        }

        .slider-fullwidth .hero-title {
            font-size: 1rem;
        }

        .slider-fullwidth .hero-description {
            font-size: 1rem;
        }

        .slider-fullwidth .carousel-caption {
            width: 95%;
        }

        .slider-fullwidth .hero-content {
            padding: 1rem;
        }

        .slider-fullwidth .btn-success,
        .slider-fullwidth .btn-secondary {
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
        }

        .slider-spinner {
            width: 35px;
            height: 35px;
            border-width: 2px;
        }

        .slider-loading-text {
            font-size: 0.9rem;
        }
    }

    /* Smooth transitions */
    .slider-fullwidth .carousel-item {
        transition: transform 0.6s ease-in-out;
    }

    .slider-fullwidth .carousel-fade .carousel-item {
        opacity: 0;
        transition: opacity 0.6s ease-in-out;
    }

    .slider-fullwidth .carousel-fade .carousel-item.active {
        opacity: 1;
    }

    /* Animation enhancements */
    .slider-fullwidth .carousel-item.active .hero-content {
        animation: slideInUp 0.8s ease-out;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.getElementById('slider');
        if (!carousel) return;

        const slides = carousel.querySelectorAll('.carousel-item');
        const lazyImages = carousel.querySelectorAll('img.slider-lazyload');

        // Enhanced WebP Detection and Support
        class WebPDetector {
            constructor() {
                this.isSupported = null;
                this.detect();
            }

            async detect() {
                return new Promise((resolve) => {
                    const webp = new Image();
                    webp.onload = webp.onerror = () => {
                        this.isSupported = (webp.height === 2);
                        resolve(this.isSupported);
                    };
                    webp.src = 'data:image/webp;base64,UklGRjoAAABXRUJQVlA4IC4AAACyAgCdASoCAAIALmk0mk0iIiIiIgBoSygABc6WWgAA/veff/0PP8bA//LwYAAA';
                });
            }

            isWebPSupported() {
                return this.isSupported;
            }
        }

        // Enhanced Slider Performance Manager with WebP Support
        class SliderPerformanceManager {
            constructor() {
                this.currentSlide = 0;
                this.totalSlides = slides.length;
                this.loadedSlides = new Set([0]);
                this.loadingSlides = new Set();
                this.webpDetector = new WebPDetector();
                this.intersectionObserver = null;
                this.init();
            }

            async init() {
                // Wait for WebP detection
                await this.webpDetector.detect();

                // Initialize intersection observer for better performance
                this.initIntersectionObserver();

                // Listen carousel events
                if (carousel) {
                    carousel.addEventListener('slide.bs.carousel', (e) => {
                        this.handleSlideChange(e.to);
                    });
                }

                // Preload next slides with delay
                setTimeout(() => {
                    this.preloadNextSlides();
                }, 1000);

                // Initialize first slide WebP if supported
                this.optimizeFirstSlide();
            }

            initIntersectionObserver() {
                if ('IntersectionObserver' in window) {
                    this.intersectionObserver = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                const slideIndex = parseInt(entry.target.dataset.slideIndex);
                                if (!isNaN(slideIndex)) {
                                    this.loadSlide(slideIndex);
                                }
                            }
                        });
                    }, {
                        rootMargin: '50px'
                    });

                    // Observe all slides
                    slides.forEach(slide => {
                        this.intersectionObserver.observe(slide);
                    });
                }
            }

            optimizeFirstSlide() {
                const firstSlide = slides[0];
                if (!firstSlide) return;

                const img = firstSlide.querySelector('img.slider-optimized');
                const picture = firstSlide.querySelector('picture.slider-picture');

                if (img && picture && this.webpDetector.isWebPSupported()) {
                    const webpSource = picture.querySelector('source[type="image/webp"]');
                    if (webpSource && webpSource.srcset) {
                        // Preload WebP version
                        const link = document.createElement('link');
                        link.rel = 'preload';
                        link.as = 'image';
                        link.href = webpSource.srcset;
                        document.head.appendChild(link);
                    }
                }
            }

            handleSlideChange(nextSlideIndex) {
                this.currentSlide = nextSlideIndex;
                this.loadSlide(nextSlideIndex);
                this.preloadAdjacentSlides(nextSlideIndex);
            }

            loadSlide(slideIndex) {
                if (this.loadedSlides.has(slideIndex) || this.loadingSlides.has(slideIndex)) {
                    return;
                }

                const slide = slides[slideIndex];
                if (!slide) return;

                this.loadingSlides.add(slideIndex);

                const img = slide.querySelector('img.slider-lazyload');
                const picture = slide.querySelector('picture.slider-picture');
                const overlay = slide.querySelector('.slider-loading-overlay');
                const progressBar = overlay?.querySelector('.slider-progress-fill');

                if (!img || !img.dataset.src) {
                    this.loadingSlides.delete(slideIndex);
                    return;
                }

                // Start loading animation
                if (progressBar) {
                    progressBar.style.width = '20%';
                }

                // Determine best image source
                const useWebP = this.webpDetector.isWebPSupported() && img.dataset.webpSrc;
                const imageSrc = useWebP ? img.dataset.webpSrc : img.dataset.src;

                // Create new image for loading
                const tempImage = new Image();

                // Set up loading progress simulation
                let progress = 20;
                const progressInterval = setInterval(() => {
                    if (progress < 90) {
                        progress += Math.random() * 20;
                        if (progressBar) {
                            progressBar.style.width = Math.min(progress, 90) + '%';
                        }
                    }
                }, 200);

                tempImage.onload = () => {
                    clearInterval(progressInterval);

                    // Complete progress
                    if (progressBar) {
                        progressBar.style.width = '100%';
                    }

                    // Update picture sources
                    if (picture) {
                        const sources = picture.querySelectorAll('source.slider-lazy-source');
                        sources.forEach(source => {
                            if (source.dataset.srcset) {
                                source.srcset = source.dataset.srcset;
                                delete source.dataset.srcset;
                            }
                        });
                    }

                    // Update main image
                    img.src = imageSrc;
                    img.classList.remove('slider-lazyload');
                    img.classList.add('slider-lazyloaded');

                    // Hide loading overlay with smooth transition
                    setTimeout(() => {
                        if (overlay) {
                            overlay.classList.add('slider-hidden');
                            setTimeout(() => {
                                overlay.style.display = 'none';
                            }, 600);
                        }
                    }, 300);

                    this.loadedSlides.add(slideIndex);
                    this.loadingSlides.delete(slideIndex);
                };

                tempImage.onerror = () => {
                    clearInterval(progressInterval);
                    console.warn(`Failed to load slide ${slideIndex}:`, imageSrc);

                    // Try fallback to original format
                    if (useWebP && img.dataset.src) {
                        tempImage.src = img.dataset.src;
                        return;
                    }

                    // Show error state
                    img.classList.add('slider-lazyerror');
                    if (overlay) {
                        overlay.innerHTML = `
                            <div class="slider-loading-content">
                                <div class="slider-error-icon">⚠️</div>
                                <div class="slider-loading-text" style="color: #dc3545;">
                                    Gagal memuat gambar
                                </div>
                            </div>
                        `;
                    }

                    this.loadingSlides.delete(slideIndex);
                };

                // Start loading
                tempImage.src = imageSrc;
            }

            preloadNextSlides() {
                // Preload 2-3 slide berikutnya
                const preloadCount = Math.min(3, this.totalSlides - 1);
                for (let i = 1; i <= preloadCount; i++) {
                    setTimeout(() => {
                        this.loadSlide(i);
                    }, i * 500);
                }
            }

            preloadAdjacentSlides(currentIndex) {
                const prevIndex = currentIndex > 0 ? currentIndex - 1 : this.totalSlides - 1;
                const nextIndex = currentIndex < this.totalSlides - 1 ? currentIndex + 1 : 0;

                setTimeout(() => {
                    this.loadSlide(prevIndex);
                    this.loadSlide(nextIndex);
                }, 300);
            }

            destroy() {
                if (this.intersectionObserver) {
                    this.intersectionObserver.disconnect();
                }
            }
        }

        // Initialize enhanced slider performance manager
        let sliderManager = null;
        if (slides.length > 0) {
            sliderManager = new SliderPerformanceManager();
        }

        // Enhanced fallback loading with WebP detection
        setTimeout(() => {
            lazyImages.forEach((img, index) => {
                if (img.dataset.src && !img.classList.contains('slider-lazyloaded')) {
                    // Use WebP if supported and available
                    const webpSupported = sliderManager?.webpDetector?.isWebPSupported();
                    const imageSrc = (webpSupported && img.dataset.webpSrc) ?
                        img.dataset.webpSrc : img.dataset.src;

                    img.src = imageSrc;
                    img.classList.remove('slider-lazyload');
                    img.classList.add('slider-lazyloaded');

                    const overlay = img.closest('.carousel-item')?.querySelector('.slider-loading-overlay');
                    if (overlay) {
                        overlay.classList.add('slider-hidden');
                    }
                }
            });
        }, 3000);

        // Enhanced carousel initialization
        try {
            const carouselInstance = new bootstrap.Carousel(carousel, {
                interval: 5000,
                wrap: true,
                keyboard: true,
                pause: 'hover',
                touch: true
            });

            // Performance optimizations
            document.addEventListener('visibilitychange', function() {
                if (document.hidden) {
                    carouselInstance.pause();
                } else {
                    carouselInstance.cycle();
                }
            });

            // Cleanup on page unload
            window.addEventListener('beforeunload', () => {
                if (sliderManager) {
                    sliderManager.destroy();
                }
            });

        } catch (error) {
            console.warn('Bootstrap carousel initialization failed:', error);
        }
    });
</script>