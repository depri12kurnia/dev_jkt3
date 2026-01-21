<div class="b-example-divider"></div>
<div class="container px-4 py-5" id="custom-cards">
    <!-- Hero Section with Dynamic Data -->
    <div class="hero-section mb-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
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
                        <span class="text-<?php echo !empty($jurusan_data->color) ? $jurusan_data->color : 'style="color: #00B9AD;"'; ?> fw-semibold fs-4">
                            <?php echo !empty($jurusan_data->tagline) ? $jurusan_data->tagline : 'Membangun Masa Depan'; ?>
                        </span>
                        <span class="text-muted fs-4"> dengan Keunggulan Akademik</span>
                    </div>

                    <!-- Dynamic Description -->
                    <div class="content-section">
                        <div class="mb-4">
                            <div class="text-content">
                                <?php echo !empty($jurusan_data->deskripsi) ? $jurusan_data->deskripsi : 'Jurusan dengan standar pendidikan tinggi dan fokus pada pengembangan kompetensi mahasiswa.'; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile optimized features -->
                    <div class="d-block d-md-none feature-highlights-mobile">
                        <?php foreach ($features as $feature): ?>
                            <div class="feature-highlight">
                                <i class="<?php echo $feature['icon']; ?> text-<?php echo $feature['color']; ?> me-2"></i>
                                <span class="fw-semibold"><?php echo $feature['text']; ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Desktop features (existing code) -->
                    <div class="row g-3 mb-4 d-none d-md-flex">
                        <?php
                        // Default features jika tidak ada di database
                        $default_features = [
                            ['icon' => 'bi bi-award-fill', 'color' => 'warning', 'text' => 'Akreditasi Unggul'],
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
                            <i class="bi bi-pencil-square me-circle me-2"></i>
                            Pendaftaran
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
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
                            loading="lazy"
                            onerror="this.src='<?php echo base_url('assets/images/default-jurusan.png'); ?>'">

                        <!-- Add loading skeleton -->
                        <div class="skeleton-loader d-none">
                            <div class="skeleton-card"></div>
                        </div>

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
                            <div class="floating-stats stats-1 d-none d-md-block">
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
                            <div class="floating-stats stats-2 d-none d-md-block">
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
                            <div class="floating-stats stats-3 d-none d-md-block">
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
                                <div class="floating-stats stats-4 d-none d-md-block">
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
                            <div class="floating-stats stats-1 d-none d-md-block">
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

                            <div class="floating-stats stats-2 d-none d-md-block">
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

                            <div class="floating-stats stats-3 d-none d-md-block">
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
            display: none !important;
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

        .floating-stats {
            display: none !important;
        }
    }

    @media (max-width: 576px) {
        .hero-section {
            padding: 1rem 0;
        }


        .modern-tabs .nav-pills {
            flex-direction: column;
        }

        .tab-content-wrapper {
            text-align: center;
        }
    }
</style>