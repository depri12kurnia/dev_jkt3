<div class="b-example-divider"></div>
<div class="container px-4 py-5" id="custom-cards">
    <div class="text-center mb-5">
        <h2 class="pb-2 border-bottom fw-bold text-primary">SDM Jurusan <?php echo $jurusan_data->nama; ?></h2>
        <p class="text-muted">Tim Profesional yang Berpengalaman dan Berdedikasi</p>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 py-3 sdm-grid-mobile" id="sdm-container">
        <?php if (!empty($sdm_list)):
            $displayed_count = 0;
            $max_display = 6; // Tampilkan maksimal 6 card awal
            foreach ($sdm_list as $index => $sdm):
                $is_hidden = $index >= $max_display;
                $displayed_count++;
        ?>
                <!-- Card SDM <?php echo $displayed_count; ?> -->
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
                                    } elseif ($sdm->level == 'jurusan') {
                                        $badge_color = 'primary';
                                        $badge_text = 'Jurusan';
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
                    <p class="text-muted">Data SDM untuk jurusan ini sedang dalam proses input.</p>

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
            <h4 class="text-center mb-4 text-muted">Statistik Tim SDM</h4>
        </div>

        <?php
        // Calculate dynamic statistics from real data
        $total_sdm = !empty($sdm_list) ? count($sdm_list) : 0;
        $total_asn = 0;
        $total_non_asn = 0;
        $total_institusi = 0;
        $total_jurusan = 0;
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
                    case 'jurusan':
                        $total_jurusan++;
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
                <h3 class="mt-2 mb-1 text-warning fw-bold counter-number" data-target="<?php echo $total_jurusan; ?>">0</h3>
                <p class="text-muted mb-0">Level Jurusan</p>
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
                        <h6 class="card-title text-center mb-3">Ringkasan SDM Jurusan</h6>
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