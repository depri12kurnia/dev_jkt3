<!-- Start Video Promotion Section dengan Modern Scroll Effects -->
<section class="video-promotion-section py-5 animate-on-scroll" data-animation="fadeIn">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="video-content">
                    <!-- Section Header dengan scroll animation -->
                    <div class="section-header text-start animate-on-scroll" data-animation="slideInLeft" data-delay="200">
                        <span class="badge bg-primary mb-2 pulse-badge">
                            <i class="fa fa-video-camera me-1"></i>Video Kampus
                        </span>
                        <h2 class="display-5 fw-bold mb-3 animate-on-scroll" data-animation="fadeInUp" data-delay="400">
                            Jelajahi Kehidupan Kampus
                            <span class="text-gradient">PolkesJati</span>
                        </h2>
                        <p class="lead text-muted mb-4 animate-on-scroll" data-animation="fadeInUp" data-delay="600">
                            Saksikan suasana pembelajaran, fasilitas modern, dan prestasi mahasiswa Politeknik Kesehatan Jakarta III melalui video kami.
                        </p>
                    </div>

                    <!-- Video Stats dengan counter animation yang diperbaiki -->
                    <div class="video-stats row g-4 mb-4 animate-on-scroll" data-animation="slideInUp" data-delay="800">
                        <div class="col-4 animate-on-scroll" data-animation="zoomIn" data-delay="900">
                            <div class="stat-item text-center modern-stat">
                                <div class="stat-wrapper">
                                    <div class="stat-icon-bg">
                                        <div class="stat-icon">
                                            <i class="fa fa-graduation-cap"></i>
                                        </div>
                                    </div>
                                    <div class="stat-content">
                                        <h3 class="fw-bold stat-number counter-number" data-target="10" data-suffix="+">0+</h3>
                                        <p class="stat-label mb-0">Program Studi</p>
                                        <div class="stat-progress">
                                            <div class="progress-bar" data-width="85%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4 animate-on-scroll" data-animation="zoomIn" data-delay="1000">
                            <div class="stat-item text-center modern-stat">
                                <div class="stat-wrapper">
                                    <div class="stat-icon-bg">
                                        <div class="stat-icon">
                                            <i class="fa fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="stat-content">
                                        <h3 class="fw-bold stat-number counter-number" data-target="3000" data-suffix="+">0+</h3>
                                        <p class="stat-label mb-0">Mahasiswa Aktif</p>
                                        <div class="stat-progress">
                                            <div class="progress-bar" data-width="95%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4 animate-on-scroll" data-animation="zoomIn" data-delay="1100">
                            <div class="stat-item text-center modern-stat">
                                <div class="stat-wrapper">
                                    <div class="stat-icon-bg">
                                        <div class="stat-icon">
                                            <i class="fa fa-trophy"></i>
                                        </div>
                                    </div>
                                    <div class="stat-content">
                                        <h3 class="fw-bold stat-number counter-number" data-target="96" data-suffix="%">0%</h3>
                                        <p class="stat-label mb-0">Tingkat Kelulusan</p>
                                        <div class="stat-progress">
                                            <div class="progress-bar" data-width="96%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons dengan scroll animation -->
                    <div class="video-actions d-flex gap-3 flex-wrap animate-on-scroll" data-animation="fadeInUp" data-delay="1200">
                        <a href="https://sipenmaru.poltekkesjakarta3.ac.id/" target="_blank" class="btn btn-modern btn-primary-gradient btn-lg px-4 hover-shine">
                            <i class="fa fa-graduation-cap me-2"></i>
                            <span>Daftar Sekarang</span>
                        </a>
                        <a href="https://www.youtube.com/@officialpoltekkesjakarta3" target="_blank" class="btn btn-modern btn-outline-primary btn-lg px-4 hover-fill">
                            <i class="fa fa-play-circle me-2"></i>
                            <span>Lihat Semua Video</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Video Player Side -->
            <div class="col-lg-6 animate-on-scroll" data-animation="slideInRight" data-delay="300">
                <div class="video-player-wrapper">
                    <div class="video-thumbnail position-relative hover-lift-video">
                        <img src="<?php echo base_url('assets/video/video-thumbnail.jpg'); ?>"
                            alt="Video Kampus PolkesJati"
                            class="img-fluid rounded-4 shadow-lg video-image">

                        <!-- Play Button dengan pulse effect -->
                        <div class="play-button-overlay position-absolute top-50 start-50 translate-middle">
                            <button class="btn-play pulse-play" data-bs-toggle="modal" data-bs-target="#videoModal">
                                <i class="fa fa-play"></i>
                                <div class="ripple-1"></div>
                                <div class="ripple-2"></div>
                                <div class="ripple-3"></div>
                            </button>
                        </div>

                        <!-- Video Badges -->
                        <div class="video-badges position-absolute top-0 start-0 m-3">
                            <span class="badge bg-danger bg-gradient px-3 py-2 animate-badge">
                                <i class="fa fa-video-camera me-1"></i>HD Quality
                            </span>
                        </div>

                        <!-- Floating Elements -->
                        <div class="floating-elements">
                            <div class="floating-dot dot-1"></div>
                            <div class="floating-dot dot-2"></div>
                            <div class="floating-dot dot-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Background Pattern -->
    <div class="video-bg-pattern">
        <div class="pattern-shape shape-1"></div>
        <div class="pattern-shape shape-2"></div>
        <div class="pattern-shape shape-3"></div>
    </div>
</section>

<!-- Enhanced Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 modal-modern">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="videoModalLabel">
                    <i class="fa fa-play-circle me-2 text-primary"></i>Video Profil PolkesJati
                </h5>
                <button type="button" class="btn-close modern-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="ratio ratio-16x9">
                    <iframe id="videoFrame" src="" title="Video Profil Kampus" allowfullscreen class="rounded-bottom-4"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

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
            transform: translateY(80px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
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

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }

    @keyframes ripple {
        0% {
            transform: scale(0);
            opacity: 1;
        }

        100% {
            transform: scale(4);
            opacity: 0;
        }
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    @keyframes shine {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }

    /* Animation Classes */
    .fadeIn {
        animation: fadeIn 0.8s ease-out;
    }

    .fadeInUp {
        animation: fadeInUp 0.8s ease-out;
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

    .bounceIn {
        animation: bounceIn 0.8s ease-out;
    }

    /* Section Styling */
    .video-promotion-section {
        position: relative;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        overflow: hidden;
    }

    /* Background Pattern */
    .video-bg-pattern {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 0;
    }

    .pattern-shape {
        position: absolute;
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    .shape-1 {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, rgba(0, 185, 173, 0.1), rgba(76, 175, 80, 0.1));
        top: 20%;
        right: 10%;
        animation-delay: 0s;
    }

    .shape-2 {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, rgba(76, 175, 80, 0.1), rgba(0, 185, 173, 0.1));
        bottom: 30%;
        left: 5%;
        animation-delay: 2s;
    }

    .shape-3 {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, rgba(0, 185, 173, 0.15), rgba(76, 175, 80, 0.15));
        top: 60%;
        right: 30%;
        animation-delay: 4s;
    }

    /* Text Gradient */
    .text-gradient {
        background: linear-gradient(90deg, #00B9AD, #4CAF50);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Badge Effects */
    .pulse-badge {
        animation: pulse 2s infinite;
        position: relative;
        overflow: hidden;
    }

    .animate-badge {
        animation: bounceIn 1s ease-out;
    }

    /* Stats Styling */
    .stat-item {
        transition: all 0.3s ease;
    }

    .stat-circle {
        position: relative;
        padding: 1rem;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(0, 185, 173, 0.1), rgba(76, 175, 80, 0.1));
        margin-bottom: 0.5rem;
        transition: all 0.3s ease;
    }

    .modern-stat {
        background: #fff;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .modern-stat:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .hover-lift:hover {
        transform: translateY(-10px);
    }

    .hover-lift:hover .stat-circle {
        background: linear-gradient(135deg, #00B9AD, #4CAF50);
        box-shadow: 0 10px 30px rgba(0, 185, 173, 0.3);
    }

    .hover-lift:hover .counter-number {
        color: white !important;
    }

    /* Modern Buttons */
    .btn-modern {
        position: relative;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        overflow: hidden;
        border: 2px solid transparent;
    }

    .btn-primary-gradient {
        background: linear-gradient(135deg, #00B9AD, #4CAF50);
        border: none;
        color: white;
    }

    .hover-shine {
        position: relative;
        overflow: hidden;
    }

    .hover-shine::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .hover-shine:hover::before {
        left: 100%;
    }

    .hover-fill {
        border: 2px solid #00B9AD;
        color: #00B9AD;
        background: transparent;
    }

    .hover-fill::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #00B9AD, #4CAF50);
        transition: left 0.3s ease;
        z-index: -1;
    }

    .hover-fill:hover {
        color: white;
        border-color: #00B9AD;
    }

    .hover-fill:hover::before {
        left: 0;
    }

    /* Video Player Styling */
    .video-player-wrapper {
        position: relative;
        z-index: 2;
    }

    .hover-lift-video {
        transition: all 0.4s ease;
    }

    .hover-lift-video:hover {
        transform: translateY(-15px) scale(1.02);
    }

    .video-image {
        transition: all 0.4s ease;
        position: relative;
    }

    .hover-lift-video:hover .video-image {
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2);
    }

    /* Play Button dengan Ripple Effect */
    .btn-play {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #00B9AD, #4CAF50);
        border: none;
        color: white;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10;
    }

    .pulse-play {
        animation: pulse 2s infinite;
    }

    .btn-play:hover {
        transform: scale(1.1);
        box-shadow: 0 10px 30px rgba(0, 185, 173, 0.4);
    }

    /* Ripple Effects */
    .ripple-1,
    .ripple-2,
    .ripple-3 {
        position: absolute;
        border: 2px solid #00B9AD;
        border-radius: 50%;
        opacity: 0;
        animation: ripple 2s infinite;
    }

    .ripple-1 {
        animation-delay: 0s;
    }

    .ripple-2 {
        animation-delay: 0.7s;
    }

    .ripple-3 {
        animation-delay: 1.4s;
    }

    /* Floating Elements */
    .floating-elements {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }

    .floating-dot {
        position: absolute;
        width: 10px;
        height: 10px;
        background: #00B9AD;
        border-radius: 50%;
        animation: float 3s ease-in-out infinite;
    }

    .dot-1 {
        top: 20%;
        left: 10%;
        animation-delay: 0s;
    }

    .dot-2 {
        top: 70%;
        right: 15%;
        animation-delay: 1s;
    }

    .dot-3 {
        bottom: 20%;
        left: 20%;
        animation-delay: 2s;
    }

    /* Modal Enhancements */
    .modal-modern {
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        border: none;
    }

    .modern-close {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #f8f9fa;
        transition: all 0.3s ease;
    }

    .modern-close:hover {
        background: #e9ecef;
        transform: scale(1.1);
    }

    /* Counter Animation */
    .counter-number {
        transition: all 0.3s ease;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .video-stats .col-4 {
            margin-bottom: 1rem;
        }

        .btn-play {
            width: 60px;
            height: 60px;
            font-size: 1.2rem;
        }

        .video-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .video-actions .btn {
            text-align: center;
        }

        .floating-elements {
            display: none;
        }
    }

    @media (max-width: 576px) {
        .display-5 {
            font-size: 2rem;
        }

        .btn-modern {
            padding: 0.75rem 1.5rem;
            font-size: 0.9rem;
        }

        .stat-circle {
            padding: 0.5rem;
        }
    }

    /* Accessibility */
    @media (prefers-reduced-motion: reduce) {

        .animate-on-scroll,
        .pulse-badge,
        .pulse-play,
        .floating-dot,
        .pattern-shape,
        .ripple-1,
        .ripple-2,
        .ripple-3 {
            animation: none !important;
            transition: none !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Intersection Observer untuk scroll animations
        const observerOptions = {
            threshold: 0.1,
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

                    observer.unobserve(element);
                }
            });
        }, observerOptions);

        // Observe semua elemen dengan animate-on-scroll
        document.querySelectorAll('.animate-on-scroll').forEach(element => {
            observer.observe(element);
        });

        // Counter Animation
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = parseInt(counter.dataset.target);
                    const suffix = counter.dataset.suffix || '';
                    let current = 0;
                    const increment = target / 50;

                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            counter.textContent = target + suffix;
                            clearInterval(timer);
                        } else {
                            counter.textContent = Math.ceil(current) + suffix;
                        }
                    }, 40);

                    counterObserver.unobserve(counter);
                }
            });
        }, observerOptions);

        // Observe counter elements
        document.querySelectorAll('.counter-number').forEach(element => {
            counterObserver.observe(element);
        });

        // Video Modal Enhancement
        const videoModal = document.getElementById('videoModal');
        const videoFrame = document.getElementById('videoFrame');
        const playButton = document.querySelector('.btn-play');

        // Set video URL saat modal dibuka
        playButton.addEventListener('click', function() {
            const videoUrl = 'https://www.youtube.com/embed/zlBgFNwib_Q?si=gSc-FWkOTKwCvX-w&autoplay=1';
            videoFrame.src = videoUrl;
        });

        // Clear video saat modal ditutup
        videoModal.addEventListener('hidden.bs.modal', function() {
            videoFrame.src = '';
        });

        // Parallax effect untuk background shapes
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const shapes = document.querySelectorAll('.pattern-shape');

            shapes.forEach((shape, index) => {
                const rate = scrolled * (0.1 + index * 0.05);
                shape.style.transform = `translateY(${rate}px)`;
            });
        });

        // Enhanced hover effects
        document.querySelectorAll('.hover-lift').forEach(element => {
            element.addEventListener('mouseenter', function() {
                this.style.zIndex = '10';
            });

            element.addEventListener('mouseleave', function() {
                this.style.zIndex = '1';
            });
        });

        // Play button click effect
        document.querySelector('.btn-play').addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1.1)';
            }, 150);
        });
    });
</script>