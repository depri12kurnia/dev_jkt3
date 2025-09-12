<section class="bg-page-header">
    <div class="page-header-overlay">
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <div class="page-title">
                        <h3>Unit</h3>
                    </div>
                    <!-- .page-title -->
                    <div class="page-header-content">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('/'); ?>">Home</a></li>
                            <li class="breadcrumb-item">Unit</li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $unit_data->nama; ?></li>
                        </ol>
                    </div>
                    <!-- .page-header-content -->
                </div>
                <!-- .page-header -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </div>
    <!-- .page-header-overlay -->
</section>
<section>
    <div class="b-example-divider"></div>
    <div class="container px-4 py-5" id="custom-cards">
        <!-- Hero Section with Dynamic Data -->
        <div class="hero-section mb-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <!-- Dynamic Badge with Unit Status -->
                        <div class="hero-badge mb-3">
                            <span class="badge bg-<?php echo !empty($unit_data->color) ? $unit_data->color : 'primary'; ?>-subtle text-<?php echo !empty($unit_data->color) ? $unit_data->color : 'primary'; ?> px-3 py-2 rounded-pill">
                                <i class="<?php echo !empty($unit_data->icon) ? $unit_data->icon : 'bi bi-building'; ?> me-1"></i>
                                <?php echo !empty($unit_data->status) ? $unit_data->status : 'Unit Unggulan'; ?>
                            </span>
                        </div>

                        <!-- Dynamic Title -->
                        <h1 class="hero-title display-5 fw-bold text-dark mb-3">
                            <?php echo $unit_data->nama; ?>
                        </h1>

                        <!-- Dynamic Subtitle -->
                        <div class="hero-subtitle mb-4">
                            <span class="text-<?php echo !empty($unit_data->color) ? $unit_data->color : '#00B9AD'; ?> fw-semibold fs-4">
                                <?php echo !empty($unit_data->tagline) ? $unit_data->tagline : 'Melayani dengan Profesional'; ?>
                            </span>
                            <span class="text-muted fs-4"> untuk Kemajuan Institusi</span>
                        </div>

                        <!-- Dynamic Description -->
                        <p class="lead text-muted mb-4 lh-lg">
                            <?php echo !empty($unit_data->deskripsi) ? $unit_data->deskripsi : 'unit ini berperan penting dalam mendukung visi dan misi institusi melalui layanan dan inovasi terbaik.'; ?>
                        </p>

                        <!-- Dynamic Key Features from Unit Data -->
                        <div class="row g-3 mb-4">
                            <?php
                            // Default features jika tidak ada di database
                            $default_features = [
                                ['icon' => 'bi bi-award-fill', 'color' => 'warning', 'text' => 'Pelayanan Prima'],
                                ['icon' => 'bi bi-people-fill', 'color' => 'success', 'text' => 'Tim Profesional'],
                                ['icon' => 'bi bi-lightbulb', 'color' => 'info', 'text' => 'Inovatif'],
                                ['icon' => 'bi bi-graph-up', 'color' => 'primary', 'text' => 'Kontribusi Nyata']
                            ];

                            // Gunakan features dari database jika ada, jika tidak gunakan default
                            $features = [];
                            if (!empty($unit_data->features)) {
                                $features = json_decode($unit_data->features, true);
                            }

                            if (empty($features)) {
                                $features = $default_features;
                            }

                            foreach ($features as $feature): ?>
                                <div class="col-sm-6">
                                    <div class="feature-highlight">
                                        <i class="<?php echo $feature['icon']; ?> text-<?php echo $feature['color']; ?> me-2"></i>
                                        <span class="fw-semibold"><?php echo $feature['text']; ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Dynamic Action Buttons -->
                        <div class="hero-actions">
                            <?php if (!empty($unit_data->website)): ?>
                                <a href="<?php echo $unit_data->website; ?>" class="btn btn-<?php echo !empty($unit_data->color) ? $unit_data->color : 'primary'; ?> btn-lg me-3" target="_blank">
                                    <i class="bi bi-globe me-2"></i>
                                    Website unit
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hero-image-wrapper">
                        <div class="image-container">
                            <!-- Dynamic Image -->
                            <img src="<?php
                                        $image_path = '';
                                        if (!empty($unit_data->image)) {
                                            $image_path = base_url('assets/images/unit/' . $unit_data->image);
                                        } else {
                                            // Generate image name from unit name
                                            $image_name = strtolower(str_replace(' ', '-', $unit_data->nama)) . '-hero.jpg';
                                            $image_path = base_url('assets/images/unit/' . $image_name);
                                        }
                                        echo $image_path;
                                        ?>"
                                alt="unit <?php echo $unit_data->nama; ?>"
                                class="img-fluid rounded-4 shadow-lg main-image"
                                loading="lazy"
                                onerror="this.src='<?php echo base_url('assets/images/default-unit.png'); ?>'">

                            <!-- Add loading skeleton -->
                            <div class="skeleton-loader d-none">
                                <div class="skeleton-card"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Enhanced Hero Section Styling */
        .hero-section {
            padding: 2rem 0;
            position: relative;
            min-height: 60vh;
            display: flex;
            align-items: center;
        }

        .hero-content {
            padding-right: 2rem;
            animation: fadeInLeft 0.8s ease-out;
        }

        .hero-badge .badge {
            font-size: 0.9rem;
            font-weight: 500;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .hero-badge .badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .hero-title {
            background: linear-gradient(135deg, #00B9AD 100%);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.2;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        .hero-subtitle {
            animation: fadeInUp 0.8s ease-out 0.4s both;
        }

        .feature-highlight {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 12px;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
            font-size: 0.95rem;
            animation: fadeInUp 0.6s ease-out both;
        }

        .feature-highlight:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .hero-actions {
            margin-top: 2rem;
            animation: fadeInUp 0.8s ease-out 0.6s both;
        }

        .hero-actions .btn {
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .hero-actions .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        /* Enhanced Image Container */
        .hero-image-wrapper {
            position: relative;
            height: 100%;
            animation: fadeInRight 0.8s ease-out 0.3s both;
        }

        .image-container {
            position: relative;
            height: 500px;
            overflow: visible;
        }

        .main-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px !important;
            transition: transform 0.3s ease;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            will-change: transform;
            backface-visibility: hidden;
        }

        .main-image:hover {
            transform: scale(1.02);
        }

        /* Enhanced Floating Statistics Cards */
        .floating-stats {
            position: absolute;
            animation: float 3s ease-in-out infinite;
            z-index: 10;
        }

        .stats-1 {
            top: 10%;
            right: -10px;
            animation-delay: 0s;
        }

        .stats-2 {
            bottom: 30%;
            left: -20px;
            animation-delay: 1s;
        }

        .stats-3 {
            bottom: 10%;
            right: 10px;
            animation-delay: 2s;
        }

        .stats-4 {
            top: 50%;
            right: -30px;
            animation-delay: 0.5s;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 15px;
            padding: 1rem;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            min-width: 140px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .stat-card.mini {
            min-width: 120px;
            padding: 0.75rem;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .stat-content {
            flex: 1;
        }

        .stat-number {
            font-weight: 700;
            font-size: 1.1rem;
            margin: 0;
            color: #333;
            background: linear-gradient(135deg, #333, #666);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-label {
            color: #666;
            font-size: 0.75rem;
            font-weight: 500;
        }

        /* Animation Keyframes */
        @keyframes fadeInLeft {
            0% {
                opacity: 0;
                transform: translateX(-30px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            0% {
                opacity: 0;
                transform: translateX(30px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
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
                transform: translateY(-10px);
            }
        }

        /* Critical CSS - inline this */
        .hero-section {
            min-height: 60vh;
            display: flex;
            align-items: center;
        }

        /* Lazy load animations */
        .animate-in {
            animation: fadeInUp 0.6s ease forwards;
        }

        /* Optimize images */
        .main-image {
            will-change: transform;
            backface-visibility: hidden;
        }

        /* Reduce layout shift */
        .skeleton-card {
            height: 200px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .hero-content {
                padding-right: 0;
                margin-bottom: 2rem;
            }

            .image-container {
                height: 400px;
            }

            .floating-stats {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-actions {
                text-align: center;
            }

            .hero-actions .btn {
                display: block;
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .image-container {
                height: 300px;
            }

            .feature-highlight {
                margin-bottom: 0.5rem;
            }
        }

        @media (max-width: 576px) {
            .hero-section {
                padding: 1rem 0;
            }

            .floating-stats {
                position: relative !important;
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
                margin-top: 2rem;
            }

            .stats-1,
            .stats-2,
            .stats-3,
            .stats-4 {
                position: relative !important;
                top: auto !important;
                left: auto !important;
                right: auto !important;
                bottom: auto !important;
            }

            .modern-tabs .nav-pills {
                flex-direction: column;
            }

            .tab-content-wrapper {
                text-align: center;
            }
        }
    </style>

    <!-- SDM Section -->
    <div class="container px-0 py-5">
        <div class="text-center mb-5">
            <h2 class="pb-2 border-bottom fw-bold" style="color: #00B9AD;">SDM <?php echo $unit_data->nama; ?></h2>
            <p class="text-muted">Tim Profesional dan Berdedikasi</p>
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
                                                echo base_url('assets/upload/unit/' . $default_avatar);
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
                                    <a href="<?php echo base_url('sdm/detail/' . $sdm->sdm_slug); ?>" class="btn btn-outline-primary btn-sm mt-2"><i class="bi bi-info-circle-fill me-1"></i> Lihat Profil</a>
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
                        <p class="text-muted">Data SDM untuk unit ini sedang dalam proses input.</p>

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
                            'page_title': '<?php echo $unit_data->nama; ?>',
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