<!-- Integrated Services Section dengan Scroll Effects -->
<section class="integrated-services-section py-5 animate-on-scroll" data-animation="fadeIn">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Header dengan scroll animation -->
                <div class="section-header text-center mb-5 animate-on-scroll" data-animation="fadeInDown" data-delay="200">
                    <h2 class="fw-bold position-relative services-title">
                        Layanan Terintegrasi
                        <span class="title-decoration"></span>
                    </h2>
                    <p class="text-muted mt-3 animate-on-scroll" data-animation="fadeIn" data-delay="400">
                        Akses layanan e-office dan informasi penting lainnya dengan mudah
                    </p>
                </div>

                <!-- Nav Tabs dengan scroll effect -->
                <div class="tabs-container animate-on-scroll" data-animation="slideInUp" data-delay="600">
                    <ul class="nav nav-tabs modern-tabs" id="servicesTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="academic-tab" data-bs-toggle="tab" data-bs-target="#academic" type="button" role="tab">
                                <i class="fa fa-graduation-cap me-2"></i>
                                <span>Akademik</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="eoffice-tab" data-bs-toggle="tab" data-bs-target="#eoffice" type="button" role="tab">
                                <i class="fa fa-desktop me-2"></i>
                                <span>E-Office</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="public-tab" data-bs-toggle="tab" data-bs-target="#public" type="button" role="tab">
                                <i class="fa fa-users me-2"></i>
                                <span>Layanan Publik</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="information-tab" data-bs-toggle="tab" data-bs-target="#information" type="button" role="tab">
                                <i class="fa fa-info-circle me-2"></i>
                                <span>Informasi</span>
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Tab Content dengan staggered animation -->
                <div class="tab-content modern-tab-content" id="servicesTabContent">
                    <!-- Academic Tab -->
                    <div class="tab-pane fade show active" id="academic" role="tabpanel">
                        <div class="row g-4">
                            <?php
                            $academic_services = [
                                ['url' => 'https://jakarta3.pusilkom.com/', 'icon' => 'fa-globe', 'title' => 'Siakad EUIS', 'desc' => 'Sistem informasi akademik untuk mahasiswa pengisian KRS, Pembayaran, Pengajuan Surat, Monitoring Orangtua dan Dosen'],
                                ['url' => 'https://elearning.pusilkom.com/jakarta3/', 'icon' => 'fa-laptop', 'title' => 'E-Learning VILC', 'desc' => 'Virtual Learning Center dengan Platform pembelajaran online untuk mendukung perkuliahan Mahasiswa dan Dosen'],
                                ['url' => 'https://perpustakaan.poltekkesjakarta3.ac.id', 'icon' => 'fa-book', 'title' => 'E-Library', 'desc' => 'Perpustakaan digital dengan koleksi lengkap repository, buku dan media lainnya yang bisa diakses secara online'],
                                ['url' => 'https://alumnijkt3.pusilkom.com/', 'icon' => 'fa-users', 'title' => 'Portal Alumni', 'desc' => 'Portal informasi berita, lowongan pekerjaan dan layanan untuk alumni e-legalisir ijazah dan transkrip nilai akademik'],
                                ['url' => 'https://ruang.pusilkom.com/#/login', 'icon' => 'fa-building', 'title' => 'Siruang', 'desc' => 'Portal informasi layanan pengelolaan peminjaman ruangan dan kelas terintegrasi di Poltekkes Kemenkes Jakarta III'],
                                ['url' => 'https://ejurnal.poltekkesjakarta3.ac.id/index.php/jitek/', 'icon' => 'fa-file-text', 'title' => 'Jitek', 'desc' => 'Jitek presenting timely research on all aspects of vocational health that has not been published by other media'],
                                ['url' => 'https://ejurnal.poltekkesjakarta3.ac.id/index.php/jkep/', 'icon' => 'fa-file-text-o', 'title' => 'JKep', 'desc' => 'JKep presenting timely research on all aspects of vocational health that has not been published by other media']
                            ];
                            $delay = 800;
                            foreach ($academic_services as $service): ?>
                                <div class="col-lg-4 col-md-6 service-item animate-on-scroll" data-animation="fadeInUp" data-delay="<?php echo $delay; ?>">
                                    <a href="<?php echo $service['url']; ?>" target="_blank" class="text-decoration-none service-link">
                                        <div class="service-card modern-card">
                                            <div class="icon-container">
                                                <i class="fa <?php echo $service['icon']; ?> service-icon"></i>
                                                <div class="icon-bg"></div>
                                            </div>
                                            <div class="card-content">
                                                <h5 class="service-title"><?php echo $service['title']; ?></h5>
                                                <p class="service-desc"><?php echo $service['desc']; ?></p>
                                            </div>
                                            <div class="card-footer">
                                                <span class="access-btn">
                                                    <i class="fa fa-arrow-right me-2"></i>Akses Layanan
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php $delay += 100;
                            endforeach; ?>
                        </div>
                    </div>

                    <!-- E-Office Tab -->
                    <div class="tab-pane fade" id="eoffice" role="tabpanel">
                        <div class="row g-4">
                            <?php
                            $eoffice_services = [
                                ['url' => 'https://srikandi.arsip.go.id/login', 'icon' => 'fa-envelope', 'title' => 'Srikandi', 'desc' => 'Sistem manajemen surat elektronik untuk administrasi yang efisien'],
                                ['url' => 'https://auth-eoffice.kemkes.go.id/do-login', 'icon' => 'fa-calendar', 'title' => 'E-Office Kemenkes', 'desc' => 'Portal Kementerian Kesehatan untuk layanan administrasi'],
                                ['url' => 'http://114.7.227.163:8843/kinerja-v2-2024/', 'icon' => 'fa-calendar-check-o', 'title' => 'E-Kinerja', 'desc' => 'Aplikasi berbasis web yang digunakan untuk mencatat, dan mengevaluasi kinerja pegawai secara terstruktur'],
                                ['url' => 'https://sister.kemdikbud.go.id/beranda', 'icon' => 'fa-users', 'title' => 'Sister', 'desc' => 'Sistem Informasi Sumber Daya Terintegrasi (Kemendikbudristek) yang digunakan untuk mengelola data dosen secara nasional.']
                            ];
                            foreach ($eoffice_services as $service): ?>
                                <div class="col-lg-4 col-md-6 service-item">
                                    <a href="<?php echo $service['url']; ?>" target="_blank" class="text-decoration-none service-link">
                                        <div class="service-card modern-card">
                                            <div class="icon-container">
                                                <i class="fa <?php echo $service['icon']; ?> service-icon"></i>
                                                <div class="icon-bg"></div>
                                            </div>
                                            <div class="card-content">
                                                <h5 class="service-title"><?php echo $service['title']; ?></h5>
                                                <p class="service-desc"><?php echo $service['desc']; ?></p>
                                            </div>
                                            <div class="card-footer">
                                                <span class="access-btn">
                                                    <i class="fa fa-arrow-right me-2"></i>Akses Layanan
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Public Services Tab -->
                    <div class="tab-pane fade" id="public" role="tabpanel">
                        <div class="row g-4">
                            <?php
                            $public_services = [
                                ['url' => 'https://sipenmaru.poltekkesjakarta3.ac.id/', 'icon' => 'fa-user-plus', 'title' => 'Informasi SPMB', 'desc' => 'Sistem Informasi Penerimaan Mahasiswa Baru Jalur Prestasi/Bersama/Mandiri'],
                                ['url' => 'https://jakarta3.pusilkom.com/site/index', 'icon' => 'fa-envelope', 'title' => 'Pengajuan Surat Keterangan', 'desc' => 'Layanan pengajuan surat keterangan secara online dan terintegrasi layanan tanda tangan elektronik'],
                                ['url' => 'https://sipadu.poltekkesjakarta3.ac.id/', 'icon' => 'fa-comments', 'title' => 'Sipadu', 'desc' => 'Layanan pengaduan pengaduan dari masyarakat, secara terpusat'],
                                ['url' => 'https://alumnijkt3.pusilkom.com/', 'icon' => 'fa-certificate', 'title' => 'E-Legalisir', 'desc' => 'Layanan legalisir dokumen akademik secara online dan terintegrasi layanan tanda tangan elektronik'],
                                ['url' => 'https://ppid.poltekkesjakarta3.ac.id/', 'icon' => 'fa-info-circle', 'title' => 'PPID', 'desc' => 'Layanan pengaduan pengaduan dari masyarakat, secara terpusat'],
                                ['url' => 'https://ppid.poltekkesjakarta3.ac.id/', 'icon' => 'fa-car', 'title' => 'Sewa Properti & Kendaraan', 'desc' => 'Layanan sewa properti dan kendaraan secara online dengan seperti aula gedung, asrama dan kendaraan']
                            ];
                            foreach ($public_services as $service): ?>
                                <div class="col-lg-4 col-md-6 service-item">
                                    <a href="<?php echo $service['url']; ?>" target="_blank" class="text-decoration-none service-link">
                                        <div class="service-card modern-card">
                                            <div class="icon-container">
                                                <i class="fa <?php echo $service['icon']; ?> service-icon"></i>
                                                <div class="icon-bg"></div>
                                            </div>
                                            <div class="card-content">
                                                <h5 class="service-title"><?php echo $service['title']; ?></h5>
                                                <p class="service-desc"><?php echo $service['desc']; ?></p>
                                            </div>
                                            <div class="card-footer">
                                                <span class="access-btn">
                                                    <i class="fa fa-arrow-right me-2"></i>Akses Layanan
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Information Tab -->
                    <div class="tab-pane fade" id="information" role="tabpanel">
                        <div class="row g-4">
                            <?php
                            $info_services = [
                                ['url' => base_url('berita'), 'icon' => 'fa-newspaper-o', 'title' => 'Berita Terkini', 'desc' => 'Update informasi dan berita terbaru kampus'],
                                ['url' => base_url('kategori/pengumuman'), 'icon' => 'fa-bullhorn', 'title' => 'Pengumuman', 'desc' => 'Pengumuman resmi dari institusi'],
                                ['url' => base_url('helpdesk'), 'icon' => 'fa-question-circle', 'title' => 'FAQ & Help', 'desc' => 'Bantuan dan pertanyaan yang sering diajukan']
                            ];
                            foreach ($info_services as $service): ?>
                                <div class="col-lg-4 col-md-6 service-item">
                                    <a href="<?php echo $service['url']; ?>" class="text-decoration-none service-link">
                                        <div class="service-card modern-card">
                                            <div class="icon-container">
                                                <i class="fa <?php echo $service['icon']; ?> service-icon"></i>
                                                <div class="icon-bg"></div>
                                            </div>
                                            <div class="card-content">
                                                <h5 class="service-title"><?php echo $service['title']; ?></h5>
                                                <p class="service-desc"><?php echo $service['desc']; ?></p>
                                            </div>
                                            <div class="card-footer">
                                                <span class="access-btn">
                                                    <i class="fa fa-arrow-right me-2"></i>Akses Layanan
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Background Elements -->
    <div class="background-elements">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
        <div class="floating-shape shape-3"></div>
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

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    /* Animation Classes */
    .fadeIn {
        animation: fadeIn 0.8s ease-out;
    }

    .fadeInDown {
        animation: fadeInDown 0.8s ease-out;
    }

    .fadeInUp {
        animation: fadeInUp 0.8s ease-out;
    }

    .slideInUp {
        animation: slideInUp 0.8s ease-out;
    }

    /* Section Styling */
    .integrated-services-section {
        position: relative;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        overflow: hidden;
    }

    /* Background Elements */
    .background-elements {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 0;
    }

    .floating-shape {
        position: absolute;
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    .shape-1 {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, rgba(0, 185, 173, 0.1), rgba(76, 175, 80, 0.1));
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }

    .shape-2 {
        width: 150px;
        height: 150px;
        background: linear-gradient(135deg, rgba(76, 175, 80, 0.1), rgba(0, 185, 173, 0.1));
        top: 60%;
        right: 15%;
        animation-delay: 2s;
    }

    .shape-3 {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, rgba(0, 185, 173, 0.15), rgba(76, 175, 80, 0.15));
        bottom: 20%;
        left: 20%;
        animation-delay: 4s;
    }

    /* Header Styling */
    .services-title {
        color: #2c3e50;
        position: relative;
        display: inline-block;
    }

    .title-decoration {
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 4px;
        background: linear-gradient(90deg, #00B9AD, #4CAF50);
        border-radius: 2px;
        transition: width 0.8s ease 0.5s;
    }

    .animate-on-scroll.animated .title-decoration {
        width: 100px;
    }

    /* Modern Tabs */
    .tabs-container {
        position: relative;
        z-index: 2;
    }

    .modern-tabs {
        border: none;
        background: #fff;
        border-radius: 15px;
        padding: 5px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        justify-content: center;
        margin-bottom: 3rem;
    }

    .modern-tabs .nav-link {
        border: none;
        border-radius: 12px;
        padding: 15px 25px;
        margin: 0 5px;
        color: #6c757d;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .modern-tabs .nav-link::before {
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

    .modern-tabs .nav-link:hover,
    .modern-tabs .nav-link.active {
        color: white;
        background: transparent;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 185, 173, 0.3);
    }

    .modern-tabs .nav-link:hover::before,
    .modern-tabs .nav-link.active::before {
        left: 0;
    }

    .modern-tabs .nav-link i {
        transition: transform 0.3s ease;
    }

    .modern-tabs .nav-link:hover i,
    .modern-tabs .nav-link.active i {
        transform: scale(1.1);
    }

    /* Tab Content */
    .modern-tab-content {
        position: relative;
        z-index: 2;
    }

    /* Service Cards */
    .service-item {
        transition: transform 0.3s ease;
    }

    .service-item:hover {
        transform: translateY(-5px);
    }

    .modern-card {
        background: #fff;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .modern-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #00B9AD, #4CAF50);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }

    .service-link:hover .modern-card::before {
        transform: scaleX(1);
    }

    .service-link:hover .modern-card {
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        transform: translateY(-10px);
    }

    /* Icon Container */
    .icon-container {
        position: relative;
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icon-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(0, 185, 173, 0.1), rgba(76, 175, 80, 0.1));
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .service-icon {
        font-size: 2.5rem;
        color: #00B9AD;
        z-index: 2;
        position: relative;
        transition: all 0.3s ease;
    }

    .service-link:hover .icon-bg {
        background: linear-gradient(135deg, #00B9AD, #4CAF50);
        transform: scale(1.1);
    }

    .service-link:hover .service-icon {
        color: white;
        transform: scale(1.1);
    }

    /* Card Content */
    .card-content {
        flex: 1;
        text-align: center;
    }

    .service-title {
        color: #2c3e50;
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 1rem;
        transition: color 0.3s ease;
    }

    .service-desc {
        color: #6c757d;
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .service-link:hover .service-title {
        color: #00B9AD;
    }

    /* Card Footer */
    .card-footer {
        margin-top: auto;
        text-align: center;
    }

    .access-btn {
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        background: transparent;
        border: 2px solid #00B9AD;
        border-radius: 25px;
        color: #00B9AD;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .access-btn::before {
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

    .service-link:hover .access-btn {
        color: white;
        border-color: transparent;
        transform: translateY(-2px);
    }

    .service-link:hover .access-btn::before {
        left: 0;
    }

    .access-btn i {
        transition: transform 0.3s ease;
    }

    .service-link:hover .access-btn i {
        transform: translateX(5px);
    }

    /* Tab Animation */
    .tab-pane {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.3s ease;
    }

    .tab-pane.show.active {
        opacity: 1;
        transform: translateY(0);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .modern-tabs {
            flex-direction: column;
            padding: 10px;
        }

        .modern-tabs .nav-link {
            margin: 5px 0;
            text-align: center;
        }

        .modern-card {
            padding: 1.5rem;
        }

        .service-icon {
            font-size: 2rem;
        }

        .icon-container {
            width: 60px;
            height: 60px;
        }

        .floating-shape {
            display: none;
        }
    }

    @media (max-width: 576px) {
        .modern-tabs .nav-link {
            padding: 12px 20px;
            font-size: 0.9rem;
        }

        .service-title {
            font-size: 1.1rem;
        }

        .service-desc {
            font-size: 0.85rem;
        }

        .access-btn {
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
        }
    }

    /* Accessibility */
    @media (prefers-reduced-motion: reduce) {

        .animate-on-scroll,
        .modern-card,
        .service-icon,
        .floating-shape,
        .access-btn {
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

        // Tab switching dengan animasi
        const tabButtons = document.querySelectorAll('[data-bs-toggle="tab"]');
        tabButtons.forEach(button => {
            button.addEventListener('shown.bs.tab', function(e) {
                const targetTab = document.querySelector(e.target.getAttribute('data-bs-target'));
                const serviceItems = targetTab.querySelectorAll('.service-item');

                // Reset dan animate service items
                serviceItems.forEach((item, index) => {
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(30px)';

                    setTimeout(() => {
                        item.style.transition = 'all 0.6s ease';
                        item.style.opacity = '1';
                        item.style.transform = 'translateY(0)';
                    }, index * 100);
                });
            });
        });

        // Parallax effect untuk background shapes
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const shapes = document.querySelectorAll('.floating-shape');

            shapes.forEach((shape, index) => {
                const rate = scrolled * (0.1 + index * 0.05);
                shape.style.transform = `translateY(${rate}px)`;
            });
        });

        // Service card hover sound effect (optional)
        document.querySelectorAll('.service-link').forEach(link => {
            link.addEventListener('mouseenter', function() {
                // Add any hover effects here
                this.style.zIndex = '10';
            });

            link.addEventListener('mouseleave', function() {
                this.style.zIndex = '1';
            });
        });
    });
</script>