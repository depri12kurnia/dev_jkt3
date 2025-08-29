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
                <div class="col-lg-7">
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
                            <span class="text-<?php echo !empty($unit_data->color) ? $unit_data->color : 'primary'; ?> fw-semibold fs-4">
                                <?php echo !empty($unit_data->tagline) ? $unit_data->tagline : 'Melayani dengan Profesional'; ?>
                            </span>
                            <span class="text-muted fs-4"> untuk Kemajuan Institusi</span>
                        </div>

                        <!-- Dynamic Description -->
                        <p class="lead text-muted mb-4 lh-lg">
                            <?php echo !empty($unit_data->deskripsi) ? $unit_data->deskripsi : 'Unit ini berperan penting dalam mendukung visi dan misi institusi melalui layanan dan inovasi terbaik.'; ?>
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
                                    Website Unit
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($unit_data->link_brosur)): ?>
                                <a href="<?php echo $unit_data->link_brosur; ?>" class="btn btn-outline-<?php echo !empty($unit_data->color) ? $unit_data->color : 'primary'; ?> btn-lg">
                                    <i class="bi bi-download me-2"></i>
                                    Download Brosur
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
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
                                alt="Unit <?php echo $unit_data->nama; ?>"
                                class="img-fluid rounded-4 shadow-lg main-image"
                                loading="lazy"
                                onerror="this.src='<?php echo base_url('assets/images/default-unit.png'); ?>'">

                            <!-- Add loading skeleton -->
                            <div class="skeleton-loader d-none">
                                <div class="skeleton-card"></div>
                            </div>

                            <!-- Dynamic Floating Stats Cards from Database -->
                            <div class="floating-stats stats-1">
                                <div class="stat-card">
                                    <div class="stat-icon bg-primary">
                                        <i class="bi bi-people text-white"></i>
                                    </div>
                                    <div class="stat-content">
                                        <h6 class="stat-number"><?php echo $sdm_statistics['total_sdm'] ?? 0; ?>+</h6>
                                        <small class="stat-label">SDM</small>
                                    </div>
                                </div>
                            </div>
                            <div class="floating-stats stats-2">
                                <div class="stat-card">
                                    <div class="stat-icon bg-success">
                                        <i class="bi bi-award text-white"></i>
                                    </div>
                                    <div class="stat-content">
                                        <h6 class="stat-number"><?php echo $sdm_statistics['total_asn'] ?? 0; ?></h6>
                                        <small class="stat-label">ASN</small>
                                    </div>
                                </div>
                            </div>
                            <div class="floating-stats stats-3">
                                <div class="stat-card">
                                    <div class="stat-icon bg-warning">
                                        <i class="bi bi-person-fill text-white"></i>
                                    </div>
                                    <div class="stat-content">
                                        <h6 class="stat-number"><?php echo $sdm_statistics['total_laki'] ?? 0; ?>/<?php echo $sdm_statistics['total_perempuan'] ?? 0; ?></h6>
                                        <small class="stat-label">L/P</small>
                                    </div>
                                </div>
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
            background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
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
            <h2 class="pb-2 border-bottom fw-bold text-primary">SDM <?php echo $unit_data->nama; ?></h2>
            <p class="text-muted">Tim Profesional dan Berdedikasi</p>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 py-3" id="sdm-container">
            <?php if (!empty($sdm_list)):
                $displayed_count = 0;
                $max_display = 6;
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
                                                    echo base_url('assets/images/staff/' . $sdm->foto_url);
                                                }
                                            } else {
                                                // Default avatar berdasarkan jenis kelamin
                                                $default_avatar = ($sdm->jenis_kelamin == 'P')
                                                    ? 'default-female-avatar.jpg'
                                                    : 'default-male-avatar.jpg';
                                                echo base_url('assets/images/staff/' . $default_avatar);
                                            }
                                            ?>"
                                    class="card-img-top"
                                    alt="Foto <?php echo htmlspecialchars($sdm->nama); ?>"
                                    style="height: 250px; object-fit: cover;"
                                    loading="lazy"
                                    onerror="this.src='<?php echo base_url('assets/images/staff/default-avatar.jpg'); ?>'">

                                <!-- Dynamic Role Badge -->
                                <div class="position-absolute top-0 end-0 m-3">
                                    <?php
                                    // Tentukan warna badge berdasarkan level jabatan
                                    $badge_color = 'primary';
                                    $badge_text = 'Staff';

                                    if (!empty($sdm->jabatan)) {
                                        if ($sdm->level == 'institusi') {
                                            $badge_color = 'danger';
                                            $badge_text = 'Institusi';
                                        } elseif ($sdm->level == 'unit') {
                                            $badge_color = 'primary';
                                            $badge_text = 'Unit';
                                        } elseif ($sdm->level == 'prodi') {
                                            $badge_color = 'success';
                                            $badge_text = 'Prodi';
                                        }
                                    }
                                    ?>
                                    <span class="badge bg-<?php echo $badge_color; ?> rounded-pill">
                                        <?php echo $badge_text; ?>
                                    </span>
                                </div>

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

                                <?php if (!empty($sdm->nip)): ?>
                                    <!-- NIP Info -->
                                    <div class="mb-3">
                                        <small class="text-primary">
                                            <i class="bi bi-card-text me-1"></i>
                                            NIP: <?php echo htmlspecialchars($sdm->nip); ?>
                                        </small>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($sdm->deskripsi)): ?>
                                    <!-- Description/Bio -->
                                    <div class="mb-3">
                                        <p class="text-muted small">
                                            <?php
                                            $deskripsi = strip_tags($sdm->deskripsi);
                                            echo strlen($deskripsi) > 100
                                                ? substr($deskripsi, 0, 100) . '...'
                                                : $deskripsi;
                                            ?>
                                        </p>
                                    </div>
                                <?php endif; ?>

                                <!-- Periode Jabatan jika ada -->
                                <?php if (!empty($sdm->periode_mulai)): ?>
                                    <div class="mb-3">
                                        <small class="text-info">
                                            <i class="bi bi-calendar me-1"></i>
                                            Periode: <?php echo $sdm->periode_mulai; ?>
                                            <?php if (!empty($sdm->periode_akhir)): ?>
                                                - <?php echo $sdm->periode_akhir; ?>
                                            <?php else: ?>
                                                - Sekarang
                                            <?php endif; ?>
                                        </small>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Dynamic Footer -->
                            <div class="card-footer bg-transparent border-0 text-center pb-4">
                                <!-- Info Grid -->
                                <div class="row text-center mb-3">
                                    <div class="col-4">
                                        <small class="text-muted d-block">Status</small>
                                        <strong class="text-<?php echo !empty($sdm->nip) ? 'success' : 'primary'; ?>">
                                            <?php echo !empty($sdm->nip) ? 'ASN' : 'Non-ASN'; ?>
                                        </strong>
                                    </div>
                                    <div class="col-4">
                                        <small class="text-muted d-block">Level</small>
                                        <strong class="text-info">
                                            <?php echo ucfirst($sdm->level ?? 'Staff'); ?>
                                        </strong>
                                    </div>
                                    <div class="col-4">
                                        <small class="text-muted d-block">Gender</small>
                                        <div class="text-secondary">
                                            <i class="bi bi-<?php echo $sdm->jenis_kelamin == 'P' ? 'person-dress' : 'person'; ?>"></i>
                                            <?php echo $sdm->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki'; ?>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-3">

                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    <?php if (!empty($sdm->email)): ?>
                                        <a href="mailto:<?php echo htmlspecialchars($sdm->email); ?>"
                                            class="btn btn-sm btn-outline-primary"
                                            title="Kirim Email">
                                            <i class="bi bi-envelope me-1"></i>Email
                                        </a>
                                    <?php endif; ?>

                                    <?php if (!empty($sdm->no_hp)): ?>
                                        <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $sdm->no_hp); ?>"
                                            class="btn btn-sm btn-outline-success"
                                            title="Hubungi via WhatsApp"
                                            target="_blank">
                                            <i class="bi bi-whatsapp me-1"></i>WA
                                        </a>
                                    <?php endif; ?>

                                    <a href="<?php echo base_url('sdm/profile/' . $sdm->id); ?>"
                                        class="btn btn-sm btn-outline-secondary"
                                        title="Lihat Profile Lengkap">
                                        <i class="bi bi-person-lines-fill me-1"></i>Profile
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

        <!-- Enhanced Dynamic Statistics Section -->
        <div class="row mt-5 pt-4 border-top">
            <div class="col-12">
                <h4 class="text-center mb-4 text-muted">Statistik SDM Unit</h4>
            </div>

            <?php
            // Calculate dynamic statistics from real data
            $total_sdm = !empty($sdm_list) ? count($sdm_list) : 0;
            $total_asn = 0;
            $total_non_asn = 0;
            $total_institusi = 0;
            $total_unit = 0;
            $total_prodi = 0;
            $total_laki = 0;
            $total_perempuan = 0;

            if (!empty($sdm_list)) {
                foreach ($sdm_list as $sdm) {
                    // Hitung berdasarkan status ASN
                    if (!empty($sdm->nip)) {
                        $total_asn++;
                    } else {
                        $total_non_asn++;
                    }

                    // Hitung berdasarkan level jabatan
                    switch ($sdm->level) {
                        case 'institusi':
                            $total_institusi++;
                            break;
                        case 'unit':
                            $total_unit++;
                            break;
                        case 'prodi':
                            $total_prodi++;
                            break;
                    }

                    // Hitung berdasarkan jenis kelamin
                    if ($sdm->jenis_kelamin == 'L') {
                        $total_laki++;
                    } else {
                        $total_perempuan++;
                    }
                }
            }
            ?>

            <div class="col-md-3 text-center mb-3">
                <div class="p-3 stat-item">
                    <i class="bi bi-people-fill text-primary" style="font-size: 2rem;"></i>
                    <h3 class="mt-2 mb-1 text-primary fw-bold counter-number" data-target="<?php echo $total_sdm; ?>">0</h3>
                    <p class="text-muted mb-0">Total SDM</p>
                </div>
            </div>

            <div class="col-md-3 text-center mb-3">
                <div class="p-3 stat-item">
                    <i class="bi bi-award-fill text-success" style="font-size: 2rem;"></i>
                    <h3 class="mt-2 mb-1 text-success fw-bold counter-number" data-target="<?php echo $total_asn; ?>">0</h3>
                    <p class="text-muted mb-0">ASN</p>
                </div>
            </div>

            <div class="col-md-3 text-center mb-3">
                <div class="p-3 stat-item">
                    <i class="bi bi-briefcase-fill text-info" style="font-size: 2rem;"></i>
                    <h3 class="mt-2 mb-1 text-info fw-bold counter-number" data-target="<?php echo $total_non_asn; ?>">0</h3>
                    <p class="text-muted mb-0">Non-ASN</p>
                </div>
            </div>

            <div class="col-md-3 text-center mb-3">
                <div class="p-3 stat-item">
                    <i class="bi bi-building text-warning" style="font-size: 2rem;"></i>
                    <h3 class="mt-2 mb-1 text-warning fw-bold counter-number" data-target="<?php echo $total_unit; ?>">0</h3>
                    <p class="text-muted mb-0">Level Unit</p>
                </div>
            </div>
        </div>

        <!-- Additional Statistics Row -->
        <?php if ($total_sdm > 0): ?>
            <div class="row mt-3">
                <div class="col-md-4 text-center mb-3">
                    <div class="p-3 stat-item">
                        <i class="bi bi-diagram-3-fill text-danger" style="font-size: 1.5rem;"></i>
                        <h4 class="mt-2 mb-1 text-danger fw-bold counter-number" data-target="<?php echo $total_institusi; ?>">0</h4>
                        <p class="text-muted mb-0 small">Level Institusi</p>
                    </div>
                </div>

                <div class="col-md-4 text-center mb-3">
                    <div class="p-3 stat-item">
                        <i class="bi bi-mortarboard-fill text-success" style="font-size: 1.5rem;"></i>
                        <h4 class="mt-2 mb-1 text-success fw-bold counter-number" data-target="<?php echo $total_prodi; ?>">0</h4>
                        <p class="text-muted mb-0 small">Level Prodi</p>
                    </div>
                </div>

                <div class="col-md-4 text-center mb-3">
                    <div class="p-3 stat-item">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <div class="text-center">
                                <i class="bi bi-person text-primary" style="font-size: 1.2rem;"></i>
                                <small class="d-block text-primary fw-bold counter-number" data-target="<?php echo $total_laki; ?>">0</small>
                            </div>
                            <div class="text-center">
                                <i class="bi bi-person-dress text-pink" style="font-size: 1.2rem; color: #e91e63;"></i>
                                <small class="d-block fw-bold counter-number" style="color: #e91e63;" data-target="<?php echo $total_perempuan; ?>">0</small>
                            </div>
                        </div>
                        <p class="text-muted mb-0 small">Gender Ratio</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- SDM Summary Cards -->
        <?php if (!empty($sdm_list)): ?>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card border-0 bg-light">
                        <div class="card-body">
                            <h6 class="card-title text-center mb-3">Ringkasan SDM Unit</h6>
                            <div class="row text-center">
                                <div class="col-md-3 mb-2">
                                    <span class="badge bg-primary-subtle text-primary px-3 py-2">
                                        <i class="bi bi-people me-1"></i>
                                        Total: <?php echo $total_sdm; ?> Orang
                                    </span>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <span class="badge bg-success-subtle text-success px-3 py-2">
                                        <i class="bi bi-shield-check me-1"></i>
                                        ASN: <?php echo $total_asn; ?> Orang
                                    </span>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <span class="badge bg-info-subtle text-info px-3 py-2">
                                        <i class="bi bi-briefcase me-1"></i>
                                        Non-ASN: <?php echo $total_non_asn; ?> Orang
                                    </span>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <span class="badge bg-warning-subtle text-warning px-3 py-2">
                                        <i class="bi bi-diagram-3 me-1"></i>
                                        Multi Level
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                            'page_title': 'Unit <?php echo $unit_data->nama; ?>',
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