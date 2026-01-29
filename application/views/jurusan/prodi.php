<div class="container-fluid px-3 px-lg-5 py-4 py-lg-5">
    <div class="text-center mb-5">
        <h2 class="pb-2 border-bottom fw-bold" style="color: #00B9AD;">Program Studi</h2>
        <p class="text-muted fs-6">Pilihan Program Pendidikan di Jurusan <?php echo $jurusan_data->nama; ?></p>
    </div>

    <?php if (!empty($prodi_list)): ?>
        <!-- Modern Responsive Tabs -->
        <div class="modern-tabs-wrapper">
            <nav class="modern-tabs">
                <div class="nav nav-pills flex-column flex-lg-row justify-content-center" id="modern-tab" role="tablist">
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

                        <!-- Main Content Row -->
                        <div class="row g-3 g-lg-4 mb-4">
                            <!-- Left Column - Main Content -->
                            <div class="col-12 col-xl-8">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body p-3 p-lg-4">
                                        <!-- Header Section -->
                                        <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center mb-4">
                                            <div class="program-icon bg-<?php echo !empty($prodi->color) ? $prodi->color : 'primary'; ?> bg-gradient rounded-circle p-3 me-0 me-sm-3 mb-3 mb-sm-0 align-self-center">
                                                <i class="<?php echo !empty($prodi->icon) ? $prodi->icon : 'bi bi-mortarboard'; ?> text-white" style="font-size: 1.5rem;"></i>
                                            </div>
                                            <div class="text-center text-sm-start">
                                                <h4 class="mb-2 text-<?php echo !empty($prodi->color) ? $prodi->color : 'primary'; ?> fw-bold">
                                                    <?php echo $prodi->nama; ?>
                                                </h4>
                                                <span class="badge bg-<?php echo !empty($prodi->color) ? $prodi->color : 'primary'; ?>-subtle text-<?php echo !empty($prodi->color) ? $prodi->color : 'primary'; ?> fs-6">
                                                    <?php echo !empty($prodi->durasi) ? $prodi->durasi : '4'; ?> Tahun •
                                                    <?php echo !empty($prodi->total_sks) ? $prodi->total_sks : '144'; ?> SKS
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Content Section -->
                                        <div class="content-section">
                                            <div class="mb-4">
                                                <div class="text-content">
                                                    <?php echo !empty($prodi->deskripsi) ? $prodi->deskripsi : 'Program studi yang mempersiapkan lulusan dengan kompetensi tinggi dan keahlian profesional.'; ?>
                                                </div>
                                            </div>

                                            <!-- Visi Misi in Columns for larger screens -->
                                            <div class="row g-3 mb-4">
                                                <div class="col-12 col-lg-6">
                                                    <div class="content-card">
                                                        <h6 class="fw-bold text-<?php echo !empty($prodi->color) ? $prodi->color : 'primary'; ?> mb-3">
                                                            <i class="bi bi-eye me-2"></i>Visi
                                                        </h6>
                                                        <div class="text-content small">
                                                            <?php echo !empty($prodi->visi) ? $prodi->visi : 'Visi Program Studi'; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <div class="content-card">
                                                        <h6 class="fw-bold text-<?php echo !empty($prodi->color) ? $prodi->color : 'primary'; ?> mb-3">
                                                            <i class="bi bi-bullseye me-2"></i>Misi
                                                        </h6>
                                                        <div class="text-content small">
                                                            <?php echo !empty($prodi->misi) ? $prodi->misi : 'Misi Program Studi'; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Keunggulan Section -->
                                            <div class="mb-4">
                                                <h6 class="fw-bold text-<?php echo !empty($prodi->color) ? $prodi->color : 'primary'; ?> mb-3">
                                                    <i class="bi bi-star me-2"></i>Keunggulan Program
                                                </h6>
                                                <div class="row g-2">
                                                    <?php
                                                    $keunggulan = !empty($prodi->keunggulan) ? json_decode($prodi->keunggulan, true) : [
                                                        'Pembelajaran Praktik Intensif',
                                                        'Laboratorium Modern',
                                                        'Kerjasama Industri',
                                                        'Sertifikasi Profesional'
                                                    ];
                                                    foreach ($keunggulan as $item): ?>
                                                        <div class="col-12 col-md-6">
                                                            <div class="feature-item">
                                                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                                <span class="small"><?php echo $item; ?></span>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>

                                            <!-- Action Buttons -->
                                            <div class="d-flex flex-column flex-sm-row gap-2">
                                                <a href="<?php echo !empty($prodi->link_brosur) ? $prodi->link_brosur : '#'; ?>"
                                                    class="btn btn-<?php echo !empty($prodi->color) ? $prodi->color : 'primary'; ?> flex-fill flex-sm-grow-0">
                                                    <i class="bi bi-pencil-square me-1"></i>Pendaftaran & Brosur
                                                </a>
                                                <a target="_blank" href="<?php echo !empty($prodi->link_detail) ? $prodi->link_detail : '#'; ?>"
                                                    class="btn btn-outline-<?php echo !empty($prodi->color) ? $prodi->color : 'primary'; ?> flex-fill flex-sm-grow-0">
                                                    <i class="bi bi-info-circle me-1"></i>Rumusan Capaian Pembelajaran Lulusan
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column - Sidebar -->
                            <div class="col-12 col-xl-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-body p-3 p-lg-4">
                                        <h6 class="card-title text-center mb-4 fw-bold">
                                            <i class="bi bi-briefcase me-2"></i>
                                            <?php echo !empty($prodi->prospek_title) ? $prodi->prospek_title : 'Prospek Karir'; ?>
                                        </h6>
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
                                                    <i class="<?php echo $karir['icon']; ?> text-<?php echo $karir['color']; ?> me-3"></i>
                                                    <span class="small"><?php echo $karir['text']; ?></span>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Info Section -->
                        <?php if (!empty($prodi->akreditasi) || !empty($prodi->gelar)): ?>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card border-0 bg-light">
                                        <div class="card-body p-3">
                                            <div class="row g-3 text-center">
                                                <?php if (!empty($prodi->akreditasi)): ?>
                                                    <div class="col-6 col-md-3">
                                                        <div class="info-item">
                                                            <i class="bi bi-award text-warning mb-2"></i>
                                                            <h6 class="mb-1 small fw-bold">Akreditasi</h6>
                                                            <small class="text-muted"><?php echo $prodi->akreditasi; ?></small>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($prodi->gelar)): ?>
                                                    <div class="col-6 col-md-3">
                                                        <div class="info-item">
                                                            <i class="bi bi-mortarboard text-primary mb-2"></i>
                                                            <h6 class="mb-1 small fw-bold">Gelar</h6>
                                                            <small class="text-muted"><?php echo $prodi->gelar; ?></small>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($prodi->mode_kuliah)): ?>
                                                    <div class="col-6 col-md-3">
                                                        <div class="info-item">
                                                            <i class="bi bi-clock text-info mb-2"></i>
                                                            <h6 class="mb-1 small fw-bold">Mode Kuliah</h6>
                                                            <small class="text-muted"><?php echo $prodi->mode_kuliah; ?></small>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (!empty($prodi->biaya_kuliah)): ?>
                                                    <div class="col-6 col-md-3">
                                                        <div class="info-item">
                                                            <i class="bi bi-currency-dollar text-success mb-2"></i>
                                                            <h6 class="mb-1 small fw-bold">Biaya</h6>
                                                            <small class="text-muted"><?php echo $prodi->biaya_kuliah; ?></small>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Accreditation Section -->
                                    <div class="accreditation-section mt-3">
                                        <div class="card border-0 bg-white shadow-sm">
                                            <div class="card-body p-3">
                                                <div class="row align-items-center g-3">
                                                    <div class="col-12 col-md-8">
                                                        <h6 class="mb-2 small fw-bold">Terakreditasi & Diakui:</h6>
                                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                                            <img src="<?php echo base_url('assets/images/logos/ban-pt.webp'); ?>" alt="BAN-PT" height="30" class="img-fluid">
                                                            <img src="<?php echo base_url('assets/images/logos/dikti-saintek.webp'); ?>" alt="Dikti Saintek" height="30" class="img-fluid">
                                                            <span class="badge bg-success">Akreditasi <?php echo $prodi->akreditasi; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4 text-start text-md-end">
                                                        <div class="trust-indicators d-flex flex-wrap gap-1 justify-content-start justify-content-md-end">
                                                            <span class="badge bg-warning text-dark">
                                                                <i class="bi bi-shield-check me-1"></i>Terpercaya
                                                            </span>
                                                            <span class="badge bg-info text-white">
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
                        <?php endif; ?>
                    </div>
                <?php $first_tab = false;
                endforeach; ?>
            </div>
        </div>
    <?php else: ?>
        <!-- No Program Studi Available -->
        <div class="text-center py-5">
            <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
            <h4 class="text-muted mt-3">Belum Ada Program Studi</h4>
            <p class="text-muted">Program studi untuk jurusan ini sedang dalam pengembangan.</p>
        </div>
    <?php endif; ?>
</div>

<style>
    /* Modern Responsive Tabs Styling */
    .modern-tabs-wrapper {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 15px;
        padding: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .modern-tabs .nav-pills .nav-link {
        border-radius: 12px;
        border: none;
        background: transparent;
        color: #6c757d;
        padding: 12px 16px;
        margin: 4px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        white-space: nowrap;
        min-height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modern-tabs .nav-pills .nav-link.active {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        color: white;
        box-shadow: 0 6px 20px rgba(13, 110, 253, 0.3);
        transform: translateY(-1px);
    }

    .modern-tabs .nav-pills .nav-link:not(.active):hover {
        background: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        transform: translateY(-1px);
    }

    .tab-content-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
        min-width: 0;
    }

    .tab-icon {
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .tab-text {
        display: flex;
        flex-direction: column;
        min-width: 0;
        flex: 1;
    }

    .tab-title {
        font-weight: 600;
        font-size: 0.9rem;
        line-height: 1.2;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .tab-subtitle {
        font-size: 0.7rem;
        opacity: 0.8;
        line-height: 1;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .modern-tab-content {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    .program-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        flex-shrink: 0;
    }

    .content-card {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 15px;
        height: 100%;
        border-left: 4px solid #0d6efd;
    }

    .text-content {
        line-height: 1.6;
        text-align: justify;
    }

    /* Styling for numbered content in text-content */
    .text-content {
        line-height: 1.6;
        text-align: justify;
    }

    /* Automatic numbering for ordered lists */
    .text-content ol {
        counter-reset: item-counter;
        padding-left: 0;
        list-style: none;
    }

    .text-content ol li {
        counter-increment: item-counter;
        position: relative;
        padding-left: 40px;
        margin-bottom: 12px;
        display: flex;
        align-items: flex-start;
    }

    .text-content ol li::before {
        content: counter(item-counter);
        position: absolute;
        left: 0;
        top: 0;
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        color: white;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.85rem;
        box-shadow: 0 2px 8px rgba(13, 110, 253, 0.3);
    }

    /* Custom numbering with manual numbers */
    .text-content .numbered-item {
        position: relative;
        padding-left: 40px;
        margin-bottom: 12px;
        display: flex;
        align-items: flex-start;
    }

    .text-content .numbered-item[data-number]::before {
        content: attr(data-number);
        position: absolute;
        left: 0;
        top: 0;
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        color: white;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.85rem;
        box-shadow: 0 2px 8px rgba(13, 110, 253, 0.3);
    }

    /* Alternative: Using CSS counters for paragraphs with class */
    .text-content.numbered-paragraphs {
        counter-reset: paragraph-counter;
    }

    .text-content.numbered-paragraphs p {
        counter-increment: paragraph-counter;
        position: relative;
        padding-left: 40px;
        margin-bottom: 15px;
    }

    .text-content.numbered-paragraphs p::before {
        content: counter(paragraph-counter);
        position: absolute;
        left: 0;
        top: 2px;
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        color: white;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.85rem;
        box-shadow: 0 2px 8px rgba(13, 110, 253, 0.3);
    }

    /* Different color variations for numbering */
    .text-content.success-numbered ol li::before,
    .text-content.success-numbered .numbered-item::before,
    .text-content.success-numbered p::before {
        background: linear-gradient(135deg, #198754 0%, #157347 100%);
        box-shadow: 0 2px 8px rgba(25, 135, 84, 0.3);
    }

    .text-content.warning-numbered ol li::before,
    .text-content.warning-numbered .numbered-item::before,
    .text-content.warning-numbered p::before {
        background: linear-gradient(135deg, #ffc107 0%, #ffb500 100%);
        color: #000;
        box-shadow: 0 2px 8px rgba(255, 193, 7, 0.3);
    }

    .text-content.info-numbered ol li::before,
    .text-content.info-numbered .numbered-item::before,
    .text-content.info-numbered p::before {
        background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%);
        box-shadow: 0 2px 8px rgba(13, 202, 240, 0.3);
    }

    /* Mobile responsive adjustments */
    @media (max-width: 576px) {

        .text-content ol li,
        .text-content .numbered-item,
        .text-content.numbered-paragraphs p {
            padding-left: 35px;
        }

        .text-content ol li::before,
        .text-content .numbered-item::before,
        .text-content.numbered-paragraphs p::before {
            width: 24px;
            height: 24px;
            font-size: 0.75rem;
        }
    }

    /* Hover effects */
    .text-content ol li:hover::before,
    .text-content .numbered-item:hover::before,
    .text-content.numbered-paragraphs p:hover::before {
        transform: scale(1.1);
        transition: transform 0.2s ease;
    }

    .modern-tab-content {
        padding: 20px;
    }

    .program-icon {
        width: 60px;
        height: 60px;
    }

    .program-icon i {
        font-size: 1.5rem !important;
    }

    .content-card {
        padding: 15px;
    }

    .feature-item {
        display: flex;
        align-items: center;
        padding: 8px 0;
        font-weight: 500;
    }

    .career-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .career-item {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        background: #f8f9fa;
        border-radius: 10px;
        border-left: 4px solid #0d6efd;
        transition: all 0.3s ease;
    }

    .career-item:hover {
        background: #e9ecef;
        transform: translateX(3px);
    }

    .info-item {
        padding: 10px 0;
    }

    .info-item i {
        font-size: 1.5rem;
        display: block;
    }

    /* Mobile Specific Styles */
    @media (max-width: 576px) {
        .container-fluid {
            padding-left: 15px !important;
            padding-right: 15px !important;
        }

        .modern-tabs-wrapper {
            padding: 10px;
            margin-bottom: 1rem;
        }

        .modern-tabs .nav-pills .nav-link {
            padding: 10px 12px;
            margin: 2px;
            min-height: 60px;
            text-align: center;
        }

        .tab-content-wrapper {
            flex-direction: column;
            gap: 4px;
        }

        .tab-title {
            font-size: 0.85rem;
        }

        .tab-subtitle {
            font-size: 0.65rem;
        }

        .modern-tab-content {
            padding: 15px;
        }

        .program-icon {
            width: 50px;
            height: 50px;
        }

        .program-icon i {
            font-size: 1.2rem !important;
        }

        .content-card {
            padding: 12px;
        }

        .career-item {
            padding: 10px 12px;
        }

        .info-item i {
            font-size: 1.2rem;
        }
    }

    /* Tablet Styles */
    @media (min-width: 577px) and (max-width: 991px) {
        .tab-content-wrapper {
            gap: 8px;
        }

        .modern-tabs .nav-pills .nav-link {
            padding: 10px 14px;
        }
    }

    /* Large Screen Styles */
    @media (min-width: 1200px) {
        .modern-tab-content {
            padding: 30px;
        }

        .tab-title {
            font-size: 1rem;
        }
    }

    /* Animation for tab content */
    .tab-pane {
        animation: fadeInUp 0.4s ease-in-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Prevent text overflow and improve readability */
    .card-body {
        overflow-wrap: break-word;
        word-wrap: break-word;
    }

    /* Ensure buttons stack properly on mobile */
    @media (max-width: 576px) {
        .d-flex.flex-column.flex-sm-row.gap-2>* {
            margin-bottom: 0;
        }
    }
</style>