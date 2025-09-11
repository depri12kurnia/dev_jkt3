<section class="bg-page-header">
    <div class="page-header-overlay">
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <div class="page-title">
                        <h3>Data SDM</h3>
                    </div>
                    <div class="page-header-content">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('/'); ?>">Home ></a></li>
                            <li>Data SDM</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="bg-team-section">
    <div class="container">
        <div class="row justify-content-center">
            <?php
            if (!empty($direktur)) {
                foreach ($direktur as $sdm) { ?>
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card shadow border-0 h-100">
                            <img src="<?php echo !empty($sdm->foto_url) ? base_url('assets/upload/sdm/' . $sdm->foto_url) : base_url('assets/images/staff/default-avatar.jpg'); ?>"
                                alt="<?php echo htmlspecialchars($sdm->nama_sdm); ?>"
                                class="card-img-top responsive-profile-img">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold mb-2"><?php echo $sdm->nama_sdm; ?></h5>
                                <span class="badge bg-primary mb-2"><?php echo !empty($sdm->jabatan) ? $sdm->jabatan : 'Staff'; ?></span>
                                <!-- <?php if (!empty($sdm->nip)): ?>
                                    <div class="mb-2"><small class="text-muted">NIP: <?php echo $sdm->nip; ?></small></div>
                                <?php endif; ?>
                                <a href="<?php echo base_url('sdm/detail/' . $sdm->slug); ?>" class="btn btn-outline-primary btn-sm mt-2">Lihat Profil</a> -->
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <div class="col-12 text-center py-5">
                    <h4 class="text-muted">Belum ada data.</h4>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<section class="bg-team-section">
    <div class="container">
        <div class="row justify-content-center">
            <?php
            if (!empty($wakil_direktur)) {
                foreach ($wakil_direktur as $sdm) { ?>
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card shadow border-0 h-100">
                            <img src="<?php echo !empty($sdm->foto_url) ? base_url('assets/upload/sdm/' . $sdm->foto_url) : base_url('assets/images/staff/default-avatar.jpg'); ?>"
                                alt="<?php echo htmlspecialchars($sdm->nama_sdm); ?>"
                                class="card-img-top responsive-profile-img">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold mb-2"><?php echo $sdm->nama_sdm; ?></h5>
                                <span class="badge bg-primary mb-2"><?php echo !empty($sdm->jabatan) ? $sdm->jabatan : 'Staff'; ?></span>
                                <!-- <?php if (!empty($sdm->nip)): ?>
                                    <div class="mb-2"><small class="text-muted">NIP: <?php echo $sdm->nip; ?></small></div>
                                <?php endif; ?>
                                <a href="<?php echo base_url('sdm/detail/' . $sdm->slug); ?>" class="btn btn-outline-primary btn-sm mt-2">Lihat Profil</a> -->
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <div class="col-12 text-center py-5">
                    <h4 class="text-muted">Belum ada data.</h4>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<section class="bg-team-section">
    <div class="container">
        <div class="row justify-content-center">
            <?php
            if (!empty($sdm_list)) {
                foreach ($sdm_list as $sdm) { ?>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card shadow border-0 h-100">
                            <img src="<?php echo !empty($sdm->foto_url) ? base_url('assets/upload/sdm/' . $sdm->foto_url) : base_url('assets/images/staff/default-avatar.jpg'); ?>"
                                alt="<?php echo htmlspecialchars($sdm->nama_sdm); ?>"
                                class="card-img-top responsive-profile-img">
                            <div class="card-body text-center">
                                <h6 class="card-title fw-bold mb-2"><?php echo $sdm->nama_sdm; ?></h6>
                                <span class="badge bg-primary mb-2 text-wrap text-break"><?php echo !empty($sdm->jabatan) ? $sdm->jabatan : 'Staff'; ?></span>
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <div class="col-12 text-center py-5">
                    <h4 class="text-muted">Belum ada data.</h4>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- Enhanced Dynamic Statistics Section -->
<div class="row mt-5 pt-4 border-top">
    <div class="col-12">
        <h4 class="text-center mb-4 text-muted">Statistik SDM</h4>
    </div>

    <?php
    // Calculate dynamic statistics from real data
    $total_sdm = !empty($sdm_list) ? count($sdm_list) : 0;
    $total_asn = 0;
    $total_non_asn = 0;
    $total_institusi = 0;
    $total_pusat = 0;
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
                case 'pusat':
                    $total_pusat++;
                    break;
                case 'prodi':
                    $total_prodi++;
                    break;
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
            <h3 class="mt-2 mb-1 text-warning fw-bold counter-number" data-target="<?php echo $total_pusat; ?>">0</h3>
            <p class="text-muted mb-0">Level Pusat</p>
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
                    <h6 class="card-title text-center mb-3">Ringkasan SDM Pusat</h6>
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
<style>
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