<section class="fasilitas-section" id="fasilitas">
    <div class="container">
        <div class="fasilitas-header">
            <h2>Fasilitas Kampus</h2>
            <p>Nikmati berbagai fasilitas modern dan lengkap yang mendukung proses pembelajaran dan pengembangan diri mahasiswa</p>
        </div>

        <div class="fasilitas-grid">
            <div class="fasilitas-card">
                <div class="fasilitas-image">
                    <img src="<?= base_url('assets/images/fasilitas/perpustakaan.jpg') ?>" alt="Perpustakaan Digital">
                    <div class="fasilitas-overlay">
                        <div class="fasilitas-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                    </div>
                    <div class="image-decoration"></div>
                </div>
                <div class="fasilitas-content">
                    <h3>Perpustakaan Digital</h3>
                    <p>Perpustakaan modern dengan koleksi buku digital dan fisik yang lengkap, ruang baca yang nyaman, dan akses internet 24/7.</p>
                </div>
            </div>

            <div class="fasilitas-card">
                <div class="fasilitas-image">
                    <img src="<?= base_url('assets/images/fasilitas/lab-komputer.jpg') ?>" alt="Laboratorium Komputer">
                    <div class="fasilitas-overlay">
                        <div class="fasilitas-icon">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                    </div>
                    <div class="image-decoration"></div>
                </div>
                <div class="fasilitas-content">
                    <h3>Laboratorium Komputer</h3>
                    <p>Lab komputer dengan teknologi terkini, software development terbaru, dan peralatan multimedia untuk mendukung pembelajaran IT.</p>
                </div>
            </div>

            <div class="fasilitas-card">
                <div class="fasilitas-image">
                    <img src="<?= base_url('assets/images/fasilitas/lab-sains.jpg') ?>" alt="Laboratorium Sains">
                    <div class="fasilitas-overlay">
                        <div class="fasilitas-icon">
                            <i class="fas fa-flask"></i>
                        </div>
                    </div>
                    <div class="image-decoration"></div>
                </div>
                <div class="fasilitas-content">
                    <h3>Laboratorium Sains</h3>
                    <p>Laboratorium lengkap untuk praktikum fisika, kimia, dan biologi dengan peralatan standar internasional.</p>
                </div>
            </div>

            <div class="fasilitas-card">
                <div class="fasilitas-image">
                    <img src="<?= base_url('assets/images/fasilitas/gym.jpg') ?>" alt="Pusat Olahraga">
                    <div class="fasilitas-overlay">
                        <div class="fasilitas-icon">
                            <i class="fas fa-dumbbell"></i>
                        </div>
                    </div>
                    <div class="image-decoration"></div>
                </div>
                <div class="fasilitas-content">
                    <h3>Pusat Olahraga</h3>
                    <p>Fasilitas olahraga lengkap meliputi gym, lapangan basket, futsal, dan berbagai peralatan fitness modern.</p>
                </div>
            </div>

            <div class="fasilitas-card">
                <div class="fasilitas-image">
                    <img src="<?= base_url('assets/images/fasilitas/kantin.jpg') ?>" alt="Kantin & Cafeteria">
                    <div class="fasilitas-overlay">
                        <div class="fasilitas-icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                    </div>
                    <div class="image-decoration"></div>
                </div>
                <div class="fasilitas-content">
                    <h3>Kantin & Cafeteria</h3>
                    <p>Area makan dengan berbagai pilihan makanan sehat, ruang santai yang nyaman, dan harga yang terjangkau untuk mahasiswa.</p>
                </div>
            </div>

            <div class="fasilitas-card">
                <div class="fasilitas-image">
                    <img src="<?= base_url('assets/images/fasilitas/wifi-area.jpg') ?>" alt="WiFi Campus">
                    <div class="fasilitas-overlay">
                        <div class="fasilitas-icon">
                            <i class="fas fa-wifi"></i>
                        </div>
                    </div>
                    <div class="image-decoration"></div>
                </div>
                <div class="fasilitas-content">
                    <h3>WiFi Campus</h3>
                    <p>Akses internet berkecepatan tinggi di seluruh area kampus dengan coverage 100% dan keamanan data terjamin.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating elements untuk dekorasi -->
    <div class="floating-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
        <div class="shape shape-5"></div>
    </div>
</section>

<style>
    /* Fasilitas Campus Styles */
    .fasilitas-section {
        padding: 80px 0;
        background: linear-gradient(135deg, #00B9AD 0%, #60C0D0 50%, #CDDC29 100%);
        min-height: 100vh;
        position: relative;
        overflow: hidden;
    }

    /* Floating Background Shapes */
    .floating-shapes {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        pointer-events: none;
    }

    .shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(205, 220, 41, 0.15);
        animation: floatAround 15s infinite ease-in-out;
    }

    .shape-1 {
        width: 100px;
        height: 100px;
        top: 10%;
        left: 10%;
        animation-delay: 0s;
        animation-duration: 20s;
        background: rgba(96, 192, 208, 0.2);
    }

    .shape-2 {
        width: 60px;
        height: 60px;
        top: 20%;
        right: 15%;
        animation-delay: -3s;
        animation-duration: 25s;
        background: rgba(205, 220, 41, 0.18);
    }

    .shape-3 {
        width: 80px;
        height: 80px;
        bottom: 30%;
        left: 20%;
        animation-delay: -6s;
        animation-duration: 18s;
        background: rgba(0, 185, 173, 0.15);
    }

    .shape-4 {
        width: 120px;
        height: 120px;
        bottom: 10%;
        right: 10%;
        animation-delay: -9s;
        animation-duration: 22s;
        background: rgba(96, 192, 208, 0.12);
    }

    .shape-5 {
        width: 40px;
        height: 40px;
        top: 50%;
        left: 5%;
        animation-delay: -12s;
        animation-duration: 16s;
        background: rgba(205, 220, 41, 0.2);
    }

    @keyframes floatAround {

        0%,
        100% {
            transform: translate(0, 0) rotate(0deg) scale(1);
            opacity: 0.3;
        }

        25% {
            transform: translate(50px, -30px) rotate(90deg) scale(1.1);
            opacity: 0.6;
        }

        50% {
            transform: translate(30px, 40px) rotate(180deg) scale(0.9);
            opacity: 0.4;
        }

        75% {
            transform: translate(-20px, -60px) rotate(270deg) scale(1.2);
            opacity: 0.7;
        }
    }

    .fasilitas-header {
        text-align: center;
        margin-bottom: 60px;
        color: white;
        position: relative;
        z-index: 2;
    }

    .fasilitas-header h2 {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        animation: bounceInDown 1.2s ease-out;
        color: #ffffff;
    }

    .fasilitas-header p {
        font-size: 1.2rem;
        opacity: 0.95;
        max-width: 600px;
        margin: 0 auto;
        animation: fadeInUp 1.5s ease-out 0.3s both;
        color: #ffffff;
    }

    @keyframes bounceInDown {
        0% {
            transform: translateY(-100px) scale(0.8);
            opacity: 0;
        }

        60% {
            transform: translateY(20px) scale(1.1);
            opacity: 1;
        }

        100% {
            transform: translateY(0) scale(1);
            opacity: 1;
        }
    }

    @keyframes fadeInUp {
        0% {
            transform: translateY(50px);
            opacity: 0;
        }

        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .fasilitas-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 40px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 2;
    }

    .fasilitas-card {
        background: white;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 185, 173, 0.15);
        transform: translateY(80px) rotateX(15deg);
        opacity: 0;
        transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        will-change: transform;
    }

    .fasilitas-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: conic-gradient(from 0deg, transparent, rgba(0, 185, 173, 0.3), transparent, rgba(96, 192, 208, 0.3), transparent, rgba(205, 220, 41, 0.3), transparent);
        animation: rotate 4s linear infinite;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: -1;
    }

    .fasilitas-card:hover::before {
        opacity: 1;
    }

    @keyframes rotate {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .fasilitas-card.animate {
        transform: translateY(0) rotateX(0deg);
        opacity: 1;
    }

    .fasilitas-card:hover {
        transform: translateY(-20px) rotateY(5deg) scale(1.02);
        box-shadow: 0 25px 50px rgba(0, 185, 173, 0.25);
    }

    .fasilitas-image {
        position: relative;
        height: 220px;
        overflow: hidden;
        border-radius: 25px 25px 0 0;
    }

    .fasilitas-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        filter: brightness(0.9);
    }

    .fasilitas-card:hover .fasilitas-image img {
        transform: scale(1.15) rotate(2deg);
        filter: brightness(1.1);
    }

    .image-decoration {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 60px;
        height: 60px;
        background: rgba(205, 220, 41, 0.25);
        border-radius: 50%;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(205, 220, 41, 0.4);
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px) scale(1);
        }

        50% {
            transform: translateY(-10px) scale(1.05);
        }
    }

    .fasilitas-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at center, rgba(0, 185, 173, 0.85), rgba(96, 192, 208, 0.9));
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        transform: scale(0.8);
    }

    .fasilitas-card:hover .fasilitas-overlay {
        opacity: 1;
        transform: scale(1);
    }

    .fasilitas-icon {
        width: 90px;
        height: 90px;
        background: rgba(255, 255, 255, 0.25);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        color: white;
        position: relative;
        backdrop-filter: blur(15px);
        border: 3px solid rgba(205, 220, 41, 0.6);
        animation: iconBounce 2s ease-in-out infinite;
        transform: scale(0);
        transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .fasilitas-card:hover .fasilitas-icon {
        transform: scale(1);
        animation-play-state: running;
    }

    @keyframes iconBounce {

        0%,
        100% {
            transform: scale(1) rotate(0deg);
        }

        25% {
            transform: scale(1.1) rotate(-5deg);
        }

        75% {
            transform: scale(0.95) rotate(5deg);
        }
    }

    .fasilitas-icon::after {
        content: '';
        position: absolute;
        width: 120%;
        height: 120%;
        border-radius: 50%;
        border: 2px solid rgba(205, 220, 41, 0.5);
        animation: rippleWave 3s infinite;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    @keyframes rippleWave {
        0% {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
        }

        100% {
            transform: translate(-50%, -50%) scale(1.8);
            opacity: 0;
        }
    }

    .fasilitas-content {
        padding: 30px;
        text-align: center;
        position: relative;
    }

    .fasilitas-content::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, #00B9AD, #60C0D0, #CDDC29);
        transform: translateX(-50%) scaleX(0);
        transition: transform 0.5s ease;
        border-radius: 2px;
    }

    .fasilitas-card:hover .fasilitas-content::before {
        transform: translateX(-50%) scaleX(1);
    }

    .fasilitas-content h3 {
        font-size: 1.6rem;
        font-weight: 600;
        color: #686969;
        margin: 15px 0;
        transition: all 0.3s ease;
        position: relative;
    }

    .fasilitas-card:hover .fasilitas-content h3 {
        color: #00B9AD;
        transform: translateY(-5px);
    }

    .fasilitas-content p {
        color: #686969;
        line-height: 1.8;
        margin: 0;
        transition: color 0.3s ease;
    }

    .fasilitas-card:hover .fasilitas-content p {
        color: #60C0D0;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .fasilitas-header h2 {
            font-size: 2.2rem;
        }

        .fasilitas-grid {
            grid-template-columns: 1fr;
            gap: 25px;
            padding: 0 15px;
        }

        .fasilitas-image {
            height: 200px;
        }

        .fasilitas-content {
            padding: 25px 20px;
        }

        .fasilitas-card:hover {
            transform: translateY(-10px) scale(1.02);
        }
    }

    /* Staggered Animation for Cards */
    .fasilitas-card:nth-child(1) {
        animation-delay: 0.1s;
        transform: translateY(80px) rotateX(15deg) rotateZ(-2deg);
    }

    .fasilitas-card:nth-child(2) {
        animation-delay: 0.3s;
        transform: translateY(80px) rotateX(15deg) rotateZ(1deg);
    }

    .fasilitas-card:nth-child(3) {
        animation-delay: 0.5s;
        transform: translateY(80px) rotateX(15deg) rotateZ(-1deg);
    }

    .fasilitas-card:nth-child(4) {
        animation-delay: 0.7s;
        transform: translateY(80px) rotateX(15deg) rotateZ(2deg);
    }

    .fasilitas-card:nth-child(5) {
        animation-delay: 0.9s;
        transform: translateY(80px) rotateX(15deg) rotateZ(-1deg);
    }

    .fasilitas-card:nth-child(6) {
        animation-delay: 1.1s;
        transform: translateY(80px) rotateX(15deg) rotateZ(1deg);
    }
</style>

<script>
    // Enhanced JavaScript untuk animasi scroll yang lebih smooth
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.fasilitas-card');

        // Intersection Observer untuk animasi scroll
        const observerOptions = {
            threshold: 0.15,
            rootMargin: '0px 0px -80px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    // Tambahkan delay berbeda untuk setiap card
                    setTimeout(() => {
                        entry.target.classList.add('animate');
                    }, index * 200);
                }
            });
        }, observerOptions);

        cards.forEach(card => {
            observer.observe(card);
        });

        // Parallax effect untuk floating shapes
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const shapes = document.querySelectorAll('.shape');

            shapes.forEach((shape, index) => {
                const speed = (index + 1) * 0.5;
                const yPos = -(scrolled * speed);
                shape.style.transform = `translateY(${yPos}px)`;
            });
        });

        // Mouse move effect untuk cards
        cards.forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const centerX = rect.width / 2;
                const centerY = rect.height / 2;

                const rotateX = (y - centerY) / 20;
                const rotateY = (centerX - x) / 20;

                card.style.transform = `translateY(-20px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.02)`;
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(-20px) rotateX(0deg) rotateY(0deg) scale(1.02)';
            });
        });
    });
</script>