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
                            <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
                            <li>SDM</li>
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
                                class="card-img-top" style="height:280px;object-fit:cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold mb-2"><?php echo $sdm->nama_sdm; ?></h5>
                                <span class="badge bg-primary mb-2"><?php echo !empty($sdm->jabatan) ? $sdm->jabatan : 'Staff'; ?></span>
                                <?php if (!empty($sdm->nip)): ?>
                                    <div class="mb-2"><small class="text-muted">NIP: <?php echo $sdm->nip; ?></small></div>
                                <?php endif; ?>
                                <a href="<?php echo base_url('sdm/detail/' . $sdm->slug); ?>" class="btn btn-outline-primary btn-sm mt-2">Lihat Profil</a>
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
                                class="card-img-top" style="height:280px;object-fit:cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold mb-2"><?php echo $sdm->nama_sdm; ?></h5>
                                <span class="badge bg-primary mb-2"><?php echo !empty($sdm->jabatan) ? $sdm->jabatan : 'Staff'; ?></span>
                                <?php if (!empty($sdm->nip)): ?>
                                    <div class="mb-2"><small class="text-muted">NIP: <?php echo $sdm->nip; ?></small></div>
                                <?php endif; ?>
                                <a href="<?php echo base_url('sdm/detail/' . $sdm->slug); ?>" class="btn btn-outline-primary btn-sm mt-2">Lihat Profil</a>
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
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card shadow border-0 h-100">
                            <img src="<?php echo !empty($sdm->foto_url) ? base_url('assets/upload/sdm/' . $sdm->foto_url) : base_url('assets/images/staff/default-avatar.jpg'); ?>"
                                alt="<?php echo htmlspecialchars($sdm->nama_sdm); ?>"
                                class="card-img-top" style="height:280px;object-fit:cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold mb-2"><?php echo $sdm->nama_sdm; ?></h5>
                                <span class="badge bg-primary mb-2"><?php echo !empty($sdm->jabatan) ? $sdm->jabatan : 'Staff'; ?></span>
                                <?php if (!empty($sdm->nip)): ?>
                                    <div class="mb-2"><small class="text-muted">NIP: <?php echo $sdm->nip; ?></small></div>
                                <?php endif; ?>
                                <?php if (!empty($sdm->email)): ?>
                                    <div class="mb-2"><small class="text-muted"><i class="bi bi-envelope"></i> <?php echo $sdm->email; ?></small></div>
                                <?php endif; ?>
                                <?php if (!empty($sdm->no_hp)): ?>
                                    <div class="mb-2"><small class="text-muted"><i class="bi bi-telephone"></i> <?php echo $sdm->no_hp; ?></small></div>
                                <?php endif; ?>
                                <a href="<?php echo base_url('sdm/detail/' . $sdm->slug); ?>" class="btn btn-outline-primary btn-sm mt-2">Lihat Profil</a>
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