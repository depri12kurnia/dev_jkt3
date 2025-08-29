<section class="bg-page-header">
    <div class="page-header-overlay">
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <div class="page-title">
                        <h3>Jurusan</h3>
                    </div>
                    <!-- .page-title -->
                    <div class="page-header-content">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('/'); ?>">Home > </a></li>
                            <li>Jurusan > </li>
                            <li> <?php echo $jurusan_data->nama; ?></li>
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
                        <!-- Dynamic Badge with Jurusan Status -->
                        <div class="hero-badge mb-3">
                            <span class="badge bg-<?php echo !empty($jurusan_data->color) ? $jurusan_data->color : 'primary'; ?>-subtle text-<?php echo !empty($jurusan_data->color) ? $jurusan_data->color : 'primary'; ?> px-3 py-2 rounded-pill">
                                <i class="<?php echo !empty($jurusan_data->icon) ? $jurusan_data->icon : 'bi bi-mortarboard'; ?> me-1"></i>
                                <?php echo !empty($jurusan_data->status) ? $jurusan_data->status : 'Jurusan Unggulan'; ?>
                            </span>
                        </div>

                        <!-- Dynamic Title -->
                        <h1 class="hero-title display-5 fw-bold text-dark mb-3">
                            Jurusan <?php echo $jurusan_data->nama; ?>
                        </h1>

                        <!-- Dynamic Subtitle -->
                        <div class="hero-subtitle mb-4">
                            <span class="text-<?php echo !empty($jurusan_data->color) ? $jurusan_data->color : 'primary'; ?> fw-semibold fs-4">
                                <?php echo !empty($jurusan_data->tagline) ? $jurusan_data->tagline : 'Membangun Masa Depan'; ?>
                            </span>
                            <span class="text-muted fs-4"> dengan Keunggulan Akademik</span>
                        </div>

                        <!-- Dynamic Description -->
                        <p class="lead text-muted mb-4 lh-lg">
                            <?php echo !empty($jurusan_data->deskripsi) ? $jurusan_data->deskripsi : 'Jurusan dengan standar pendidikan tinggi dan fokus pada pengembangan kompetensi mahasiswa.'; ?>
                        </p>

                        <!-- Dynamic Key Features from Jurusan Data -->
                        <div class="row g-3 mb-4">
                            <?php
                            // Default features jika tidak ada di database
                            $default_features = [
                                ['icon' => 'bi bi-award-fill', 'color' => 'warning', 'text' => 'Akreditasi A'],
                                ['icon' => 'bi bi-people-fill', 'color' => 'success', 'text' => 'Dosen Berpengalaman'],
                                ['icon' => 'bi bi-building', 'color' => 'info', 'text' => 'Fasilitas Modern'],
                                ['icon' => 'bi bi-graph-up', 'color' => 'primary', 'text' => 'Prospek Karir Cerah']
                            ];

                            // Gunakan features dari database jika ada, jika tidak gunakan default
                            $features = [];
                            if (!empty($jurusan_data->features)) {
                                $features = json_decode($jurusan_data->features, true);
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
                            <a href="<?php echo !empty($jurusan_data->link_brosur) ? $jurusan_data->link_brosur : '#'; ?>"
                                class="btn btn-<?php echo !empty($jurusan_data->color) ? $jurusan_data->color : 'primary'; ?> btn-lg me-3">
                                <i class="bi bi-download me-2"></i>
                                Download Brosur
                            </a>
                            <a href="<?php echo !empty($jurusan_data->link_virtual_tour) ? $jurusan_data->link_virtual_tour : '#'; ?>"
                                class="btn btn-outline-<?php echo !empty($jurusan_data->color) ? $jurusan_data->color : 'primary'; ?> btn-lg">
                                <i class="bi bi-play-circle me-2"></i>
                                Virtual Tour
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="hero-image-wrapper">
                        <div class="image-container">
                            <!-- Dynamic Image -->
                            <img src="<?php
                                        $image_path = '';
                                        if (!empty($jurusan_data->image)) {
                                            $image_path = base_url('assets/images/jurusan/' . $jurusan_data->image);
                                        } else {
                                            // Generate image name from jurusan name
                                            $image_name = strtolower(str_replace(' ', '-', $jurusan_data->nama)) . '-hero.jpg';
                                            $image_path = base_url('assets/images/jurusan/' . $image_name);
                                        }
                                        echo $image_path;
                                        ?>"
                                alt="Jurusan <?php echo $jurusan_data->nama; ?>"
                                class="img-fluid rounded-4 shadow-lg main-image"
                                onerror="this.src='<?php echo base_url('assets/images/default-jurusan.png'); ?>'">

                            <!-- Dynamic Floating Stats Cards from Database -->
                            <?php if (!empty($prodi_list)):
                                // Calculate dynamic stats
                                $total_alumni = 0;
                                $total_job_placement = 0;
                                $total_rating = 0;
                                $count_prodi = count($prodi_list);

                                foreach ($prodi_list as $prodi) {
                                    $total_alumni += !empty($prodi->alumni_count) ? intval($prodi->alumni_count) : 100;
                                    $total_job_placement += !empty($prodi->job_placement) ? floatval($prodi->job_placement) : 90;
                                    $total_rating += !empty($prodi->rating) ? floatval($prodi->rating) : 4.5;
                                }

                                $avg_job_placement = $count_prodi > 0 ? round($total_job_placement / $count_prodi) : 95;
                                $avg_rating = $count_prodi > 0 ? round($total_rating / $count_prodi, 1) : 4.8;
                            ?>

                                <!-- Alumni Stats -->
                                <div class="floating-stats stats-1">
                                    <div class="stat-card">
                                        <div class="stat-icon bg-primary">
                                            <i class="bi bi-people text-white"></i>
                                        </div>
                                        <div class="stat-content">
                                            <h6 class="stat-number"><?php echo number_format($total_alumni); ?>+</h6>
                                            <small class="stat-label">Alumni</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Job Placement Stats -->
                                <div class="floating-stats stats-2">
                                    <div class="stat-card">
                                        <div class="stat-icon bg-success">
                                            <i class="bi bi-trophy text-white"></i>
                                        </div>
                                        <div class="stat-content">
                                            <h6 class="stat-number"><?php echo $avg_job_placement; ?>%</h6>
                                            <small class="stat-label">Job Placement</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Rating Stats -->
                                <div class="floating-stats stats-3">
                                    <div class="stat-card">
                                        <div class="stat-icon bg-warning">
                                            <i class="bi bi-star-fill text-white"></i>
                                        </div>
                                        <div class="stat-content">
                                            <h6 class="stat-number"><?php echo $avg_rating; ?></h6>
                                            <small class="stat-label">Rating</small>
                                        </div>
                                    </div>
                                </div>

                                <?php if ($count_prodi > 0): ?>
                                    <!-- Program Studi Count -->
                                    <div class="floating-stats stats-4">
                                        <div class="stat-card mini">
                                            <div class="stat-icon bg-info">
                                                <i class="bi bi-mortarboard text-white"></i>
                                            </div>
                                            <div class="stat-content">
                                                <h6 class="stat-number"><?php echo $count_prodi; ?></h6>
                                                <small class="stat-label">Program Studi</small>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            <?php else: ?>
                                <!-- Default Stats if no prodi data -->
                                <div class="floating-stats stats-1">
                                    <div class="stat-card">
                                        <div class="stat-icon bg-primary">
                                            <i class="bi bi-people text-white"></i>
                                        </div>
                                        <div class="stat-content">
                                            <h6 class="stat-number">500+</h6>
                                            <small class="stat-label">Alumni</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="floating-stats stats-2">
                                    <div class="stat-card">
                                        <div class="stat-icon bg-success">
                                            <i class="bi bi-trophy text-white"></i>
                                        </div>
                                        <div class="stat-content">
                                            <h6 class="stat-number">95%</h6>
                                            <small class="stat-label">Job Placement</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="floating-stats stats-3">
                                    <div class="stat-card">
                                        <div class="stat-icon bg-warning">
                                            <i class="bi bi-star-fill text-white"></i>
                                        </div>
                                        <div class="stat-content">
                                            <h6 class="stat-number">4.8</h6>
                                            <small class="stat-label">Rating</small>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
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
            .hero-subtitle span {
                display: block;
                margin-bottom: 0.25rem;
            }

            .feature-highlight {
                padding: 0.5rem 0.75rem;
                font-size: 0.9rem;
            }
        }
    </style>

    <!-- Program Studi Section -->
    <div class="container px-4 py-5">
        <div class="text-center mb-5">
            <h2 class="pb-2 border-bottom fw-bold text-primary">Program Studi</h2>
            <p class="text-muted">Pilihan Program Pendidikan di Jurusan <?php echo $jurusan_data->nama; ?></p>
        </div>

        <?php if (!empty($prodi_list)): ?>
            <!-- Custom Modern Tabs -->
            <div class="modern-tabs-wrapper">
                <nav class="modern-tabs">
                    <div class="nav nav-pills nav-fill" id="modern-tab" role="tablist">
                        <?php $first = true;
                        foreach ($prodi_list as $prodi): ?>
                            <button class="nav-link <?php echo $first ? 'active' : ''; ?> modern-tab-btn"
                                id="nav-prodi-<?php echo $prodi->id; ?>-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#nav-prodi-<?php echo $prodi->id; ?>"
                                type="button"
                                role="tab"
                                aria-controls="nav-prodi-<?php echo $prodi->id; ?>"
                                aria-selected="<?php echo $first ? 'true' : 'false'; ?>">
                                <div class="tab-content-wrapper">
                                    <i class="<?php echo !empty($prodi->icon) ? $prodi->icon : 'bi bi-mortarboard-fill'; ?> tab-icon"></i>
                                    <div class="tab-text">
                                        <span class="tab-title"><?php echo $prodi->nama; ?></span>
                                        <small class="tab-subtitle"><?php echo !empty($prodi->jenjang) ? $prodi->jenjang : 'Program Studi'; ?></small>
                                    </div>
                                </div>
                            </button>
                        <?php $first = false;
                        endforeach; ?>
                    </div>
                </nav>

                <div class="tab-content modern-tab-content" id="modernTabContent">
                    <?php $first_tab = true;
                    foreach ($prodi_list as $prodi): ?>
                        <!-- Tab Content for <?php echo $prodi->nama; ?> -->
                        <div class="tab-pane fade <?php echo $first_tab ? 'show active' : ''; ?>"
                            id="nav-prodi-<?php echo $prodi->id; ?>"
                            role="tabpanel"
                            aria-labelledby="nav-prodi-<?php echo $prodi->id; ?>-tab">
                            <div class="row g-4">
                                <div class="col-lg-8">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="program-icon bg-<?php echo !empty($prodi->color) ? $prodi->color : 'primary'; ?> bg-gradient rounded-circle p-3 me-3">
                                                    <i class="<?php echo !empty($prodi->icon) ? $prodi->icon : 'bi bi-mortarboard'; ?> text-white" style="font-size: 1.5rem;"></i>
                                                </div>
                                                <div>
                                                    <h4 class="mb-1 text-<?php echo !empty($prodi->color) ? $prodi->color : 'primary'; ?> fw-bold">
                                                        <?php echo $prodi->nama; ?>
                                                    </h4>
                                                    <span class="badge bg-<?php echo !empty($prodi->color) ? $prodi->color : 'primary'; ?>-subtle text-<?php echo !empty($prodi->color) ? $prodi->color : 'primary'; ?>">
                                                        <?php echo !empty($prodi->durasi) ? $prodi->durasi : '4'; ?> Tahun •
                                                        <?php echo !empty($prodi->total_sks) ? $prodi->total_sks : '144'; ?> SKS
                                                    </span>
                                                </div>
                                            </div>

                                            <p class="text-muted mb-4">
                                                <?php echo !empty($prodi->deskripsi) ? $prodi->deskripsi : 'Program studi yang mempersiapkan lulusan dengan kompetensi tinggi dan keahlian profesional.'; ?>
                                            </p>

                                            <div class="row g-3 mb-4">
                                                <?php
                                                $keunggulan = !empty($prodi->keunggulan) ? json_decode($prodi->keunggulan, true) : [
                                                    'Pembelajaran Praktik Intensif',
                                                    'Laboratorium Modern',
                                                    'Kerjasama Industri',
                                                    'Sertifikasi Profesional'
                                                ];
                                                foreach ($keunggulan as $item): ?>
                                                    <div class="col-md-6">
                                                        <div class="feature-item">
                                                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                            <span><?php echo $item; ?></span>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>

                                            <div class="d-flex gap-2">
                                                <a href="<?php echo !empty($prodi->link_brosur) ? $prodi->link_brosur : '#'; ?>"
                                                    class="btn btn-<?php echo !empty($prodi->color) ? $prodi->color : 'primary'; ?>">
                                                    <i class="bi bi-download me-1"></i>Download Brosur
                                                </a>
                                                <a href="<?php echo !empty($prodi->link_detail) ? $prodi->link_detail : '#'; ?>"
                                                    class="btn btn-outline-<?php echo !empty($prodi->color) ? $prodi->color : 'primary'; ?>">
                                                    <i class="bi bi-info-circle me-1"></i>Info Lengkap
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body p-4">
                                            <h5 class="card-title text-center mb-3">
                                                <?php echo !empty($prodi->prospek_title) ? $prodi->prospek_title : 'Prospek Karir'; ?>
                                            </h5>
                                            <div class="career-list">
                                                <?php
                                                $prospek_karir = !empty($prodi->prospek_karir) ? json_decode($prodi->prospek_karir, true) : [
                                                    ['icon' => 'bi bi-building', 'color' => 'primary', 'text' => 'Profesional di Perusahaan'],
                                                    ['icon' => 'bi bi-briefcase', 'color' => 'success', 'text' => 'Konsultan Independen'],
                                                    ['icon' => 'bi bi-people', 'color' => 'info', 'text' => 'Wirausaha'],
                                                    ['icon' => 'bi bi-mortarboard', 'color' => 'warning', 'text' => 'Akademisi']
                                                ];
                                                foreach ($prospek_karir as $karir): ?>
                                                    <div class="career-item">
                                                        <i class="<?php echo $karir['icon']; ?> text-<?php echo $karir['color']; ?> me-2"></i>
                                                        <span><?php echo $karir['text']; ?></span>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Info Section -->
                            <?php if (!empty($prodi->akreditasi) || !empty($prodi->gelar)): ?>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="card border-0 bg-light">
                                            <div class="card-body p-3">
                                                <div class="row text-center">
                                                    <?php if (!empty($prodi->akreditasi)): ?>
                                                        <div class="col-md-3">
                                                            <div class="info-item">
                                                                <i class="bi bi-award text-warning"></i>
                                                                <h6 class="mb-0">Akreditasi</h6>
                                                                <small class="text-muted"><?php echo $prodi->akreditasi; ?></small>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (!empty($prodi->gelar)): ?>
                                                        <div class="col-md-3">
                                                            <div class="info-item">
                                                                <i class="bi bi-mortarboard text-primary"></i>
                                                                <h6 class="mb-0">Gelar Lulusan</h6>
                                                                <small class="text-muted"><?php echo $prodi->gelar; ?></small>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (!empty($prodi->mode_kuliah)): ?>
                                                        <div class="col-md-3">
                                                            <div class="info-item">
                                                                <i class="bi bi-clock text-info"></i>
                                                                <h6 class="mb-0">Mode Kuliah</h6>
                                                                <small class="text-muted"><?php echo $prodi->mode_kuliah; ?></small>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (!empty($prodi->biaya_kuliah)): ?>
                                                        <div class="col-md-3">
                                                            <div class="info-item">
                                                                <i class="bi bi-currency-dollar text-success"></i>
                                                                <h6 class="mb-0">Biaya Kuliah</h6>
                                                                <small class="text-muted"><?php echo $prodi->biaya_kuliah; ?></small>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php $first_tab = false;
                    endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <!-- No Program Studi Available -->
            <div class="text-center py-5">
                <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
                <h4 class="text-muted mt-3">Belum Ada Program Studi</h4>
                <p class="text-muted">Program studi untuk jurusan ini sedang dalam pengembangan.</p>
            </div>
        <?php endif; ?>
    </div>

    <style>
        /* Modern Tabs Styling */
        .modern-tabs-wrapper {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 2rem;
        }

        .modern-tabs .nav-pills .nav-link {
            border-radius: 15px;
            border: none;
            background: transparent;
            color: #6c757d;
            padding: 1rem 1.5rem;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .modern-tabs .nav-pills .nav-link.active {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            color: white;
            box-shadow: 0 8px 25px rgba(13, 110, 253, 0.3);
            transform: translateY(-2px);
        }

        .modern-tabs .nav-pills .nav-link:not(.active):hover {
            background: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
            transform: translateY(-1px);
        }

        .tab-content-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .tab-icon {
            font-size: 1.25rem;
        }

        .tab-text {
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        .tab-title {
            font-weight: 600;
            font-size: 1rem;
            line-height: 1.2;
        }

        .tab-subtitle {
            font-size: 0.75rem;
            opacity: 0.8;
            line-height: 1;
        }

        .modern-tab-content {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .program-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            flex-shrink: 0;
        }

        .feature-item {
            display: flex;
            align-items: center;
            padding: 0.5rem 0;
            font-weight: 500;
        }

        .career-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .career-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid #0d6efd;
            transition: all 0.3s ease;
        }

        .career-item:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }

        .info-item {
            padding: 1rem 0;
        }

        .info-item i {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .tab-content-wrapper {
                flex-direction: column;
                gap: 0.25rem;
            }

            .tab-text {
                text-align: center;
            }

            .modern-tabs .nav-pills .nav-link {
                margin: 0.25rem 0;
                padding: 0.75rem 1rem;
            }

            .modern-tab-content {
                padding: 1rem;
            }
        }

        /* Animation for tab content */
        .tab-pane {
            animation: fadeInUp 0.5s ease-in-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <!-- ======================= SDM =================================-->

    <div class="b-example-divider"></div>
    <div class="container px-4 py-5" id="custom-cards">
        <div class="text-left mb-5">
            <h2 class="pb-2 border-bottom fw-bold text-primary">SDM Jurusan <?php echo $jurusan_data->nama; ?></h2>
            <p class="text-muted">Tim Profesional yang Berpengalaman dan Berdedikasi</p>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 py-3">
            <!-- Card Dosen/Staff 1 -->
            <div class="col">
                <div class="card h-100 shadow-lg border-0 overflow-hidden hover-lift">
                    <div class="position-relative">
                        <img src="<?php echo base_url('assets/images/staff/default-avatar.jpg'); ?>"
                            class="card-img-top" alt="Foto Staff" style="height: 250px; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-primary rounded-pill">Dosen</span>
                        </div>
                    </div>
                    <div class="card-body text-center p-4">
                        <h5 class="card-title fw-bold mb-2">Dr. Ahmad Fauzi, M.Fis</h5>
                        <p class="text-muted mb-3">Ketua Jurusan Fisioterapi</p>
                        <div class="mb-3">
                            <small class="text-primary">
                                <i class="bi bi-mortarboard me-1"></i>
                                S3 Fisioterapi - Universitas Indonesia
                            </small>
                        </div>
                        <div class="d-flex justify-content-center gap-2 mb-3">
                            <span class="badge bg-light text-dark">Neurologi</span>
                            <span class="badge bg-light text-dark">Pediatri</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 text-center pb-4">
                        <div class="row text-center">
                            <div class="col-4">
                                <small class="text-muted d-block">Pengalaman</small>
                                <strong class="text-primary">15 Tahun</strong>
                            </div>
                            <div class="col-4">
                                <small class="text-muted d-block">Penelitian</small>
                                <strong class="text-success">25+</strong>
                            </div>
                            <div class="col-4">
                                <small class="text-muted d-block">Rating</small>
                                <div class="text-warning">
                                    <i class="bi bi-star-fill"></i> 4.8
                                </div>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-envelope me-1"></i>Email
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-person-lines-fill me-1"></i>Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Dosen/Staff 2 -->
            <div class="col">
                <div class="card h-100 shadow-lg border-0 overflow-hidden hover-lift">
                    <div class="position-relative">
                        <img src="<?php echo base_url('assets/images/staff/default-avatar-2.jpg'); ?>"
                            class="card-img-top" alt="Foto Staff" style="height: 250px; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-success rounded-pill">Dosen</span>
                        </div>
                    </div>
                    <div class="card-body text-center p-4">
                        <h5 class="card-title fw-bold mb-2">Dr. Siti Nurhaliza, M.Fis</h5>
                        <p class="text-muted mb-3">Dosen Senior Fisioterapi</p>
                        <div class="mb-3">
                            <small class="text-primary">
                                <i class="bi bi-mortarboard me-1"></i>
                                S3 Fisioterapi - Universitas Gadjah Mada
                            </small>
                        </div>
                        <div class="d-flex justify-content-center gap-2 mb-3">
                            <span class="badge bg-light text-dark">Ortopedi</span>
                            <span class="badge bg-light text-dark">Sports</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 text-center pb-4">
                        <div class="row text-center">
                            <div class="col-4">
                                <small class="text-muted d-block">Pengalaman</small>
                                <strong class="text-primary">12 Tahun</strong>
                            </div>
                            <div class="col-4">
                                <small class="text-muted d-block">Penelitian</small>
                                <strong class="text-success">18+</strong>
                            </div>
                            <div class="col-4">
                                <small class="text-muted d-block">Rating</small>
                                <div class="text-warning">
                                    <i class="bi bi-star-fill"></i> 4.9
                                </div>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-envelope me-1"></i>Email
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-person-lines-fill me-1"></i>Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Staff Administrasi -->
            <div class="col">
                <div class="card h-100 shadow-lg border-0 overflow-hidden hover-lift">
                    <div class="position-relative">
                        <img src="<?php echo base_url('assets/images/staff/default-avatar-3.jpg'); ?>"
                            class="card-img-top" alt="Foto Staff" style="height: 250px; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-info rounded-pill">Staff</span>
                        </div>
                    </div>
                    <div class="card-body text-center p-4">
                        <h5 class="card-title fw-bold mb-2">Budi Santoso, S.Kom</h5>
                        <p class="text-muted mb-3">Staff Administrasi Akademik</p>
                        <div class="mb-3">
                            <small class="text-primary">
                                <i class="bi bi-mortarboard me-1"></i>
                                S1 Sistem Informasi
                            </small>
                        </div>
                        <div class="d-flex justify-content-center gap-2 mb-3">
                            <span class="badge bg-light text-dark">Administrasi</span>
                            <span class="badge bg-light text-dark">IT Support</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 text-center pb-4">
                        <div class="row text-center">
                            <div class="col-4">
                                <small class="text-muted d-block">Pengalaman</small>
                                <strong class="text-primary">8 Tahun</strong>
                            </div>
                            <div class="col-4">
                                <small class="text-muted d-block">Projects</small>
                                <strong class="text-success">50+</strong>
                            </div>
                            <div class="col-4">
                                <small class="text-muted d-block">Rating</small>
                                <div class="text-warning">
                                    <i class="bi bi-star-fill"></i> 4.7
                                </div>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-envelope me-1"></i>Email
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-person-lines-fill me-1"></i>Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="row mt-5 pt-4 border-top">
            <div class="col-12">
                <h4 class="text-center mb-4 text-muted">Statistik Tim SDM</h4>
            </div>
            <div class="col-md-3 text-center mb-3">
                <div class="p-3">
                    <i class="bi bi-people-fill text-primary" style="font-size: 2rem;"></i>
                    <h3 class="mt-2 mb-1 text-primary fw-bold">25</h3>
                    <p class="text-muted mb-0">Total SDM</p>
                </div>
            </div>
            <div class="col-md-3 text-center mb-3">
                <div class="p-3">
                    <i class="bi bi-mortarboard-fill text-success" style="font-size: 2rem;"></i>
                    <h3 class="mt-2 mb-1 text-success fw-bold">18</h3>
                    <p class="text-muted mb-0">Dosen</p>
                </div>
            </div>
            <div class="col-md-3 text-center mb-3">
                <div class="p-3">
                    <i class="bi bi-briefcase-fill text-info" style="font-size: 2rem;"></i>
                    <h3 class="mt-2 mb-1 text-info fw-bold">7</h3>
                    <p class="text-muted mb-0">Staff</p>
                </div>
            </div>
            <div class="col-md-3 text-center mb-3">
                <div class="p-3">
                    <i class="bi bi-award-fill text-warning" style="font-size: 2rem;"></i>
                    <h3 class="mt-2 mb-1 text-warning fw-bold">12</h3>
                    <p class="text-muted mb-0">Tahun Rata-rata Pengalaman</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
        }

        .card-img-top {
            transition: transform 0.3s ease;
        }

        .hover-lift:hover .card-img-top {
            transform: scale(1.05);
        }

        .badge {
            font-size: 0.75rem;
        }

        .card-footer hr {
            margin: 0.75rem 0;
            opacity: 0.1;
        }
    </style>

</section>