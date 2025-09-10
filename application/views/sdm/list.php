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