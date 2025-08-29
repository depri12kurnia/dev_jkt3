<?php
$site = $this->konfigurasi_model->listing();
?>
<!-- Floating Widget -->
<div class="floating-widget mb-2">
    <img src="<?php echo base_url('assets/logo-cariyanlik.svg') ?>" alt="Widget">
</div>

<div class="box-layout">
    <header class="header-style-1">
        <div class="bg-header-top py-2" style="background: var(--primary); color: #fff;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-3 d-flex align-items-center mb-2 mb-md-0">
                        <a href="<?php echo base_url() ?>">
                            <img src="<?php echo $this->website->logo() ?>" alt="logo" class="img-responsive" style="max-height:70px;">
                        </a>
                    </div>
                    <div class="col-md-9">
                        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center gap-2">
                            <div class="d-flex align-items-center gap-3">
                                <div class="h-adress-content">
                                    <div class="donate-option d-flex flex-wrap gap-2">
                                        <a href="https://wa.me/<?php echo str_replace('+', '', $site->whatsapp) ?>?text=Saya%20perlu%20informasi%20tentang%20Poltekkes%20Jakarta%20III.%20Apakah%20bisa%20dibantu?" target="_blank" class="btn btn-sm btn-success d-flex align-items-center gap-1">
                                            <i class="fa fa-whatsapp"></i> <?php echo $site->whatsapp ?>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-secondary d-flex align-items-center gap-1">
                                            <i class="fa fa-mobile"></i> <?php echo $site->hp ?>
                                        </a>
                                        <a href="tel:<?php echo $site->telepon ?>" class="btn btn-sm btn-info d-flex align-items-center gap-1">
                                            <i class="fa fa-phone"></i> <?php echo $site->telepon ?>
                                        </a>
                                        <a href="<?php echo base_url('kontak') ?>" class="btn btn-sm btn-warning d-flex align-items-center gap-1">
                                            <i class="fa fa-envelope"></i> Kontak
                                        </a>
                                        <a href="<?php echo base_url('helpdesk') ?>" class="btn btn-sm btn-danger d-flex align-items-center gap-1">
                                            <i class="fa fa-question-circle"></i> Faq & Helpdesk
                                        </a>
                                    </div>
                                </div>
                                <ul class="list-unstyled d-flex flex-wrap gap-3 mb-0 header-contact">
                                    <li class="d-flex align-items-start bg-white bg-opacity-10 rounded px-3 py-2 shadow-sm" style="min-width:150px;">
                                        <i class="flaticon-time-left fs-4 me-2"></i>
                                        <div>
                                            <h6 class="mb-1 text-uppercase fw-bold" style="font-size:11px; color:#fff;">Waktu Pelayanan</h6>
                                            <p class="mb-0" style="font-size:11px; color:#e0f7f6;">Senin-Kamis : 08:00 WIB - 16:00 WIB<br>Jum'at: 08:00 WIB - 16:30 WIB</p>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-start bg-white bg-opacity-10 rounded px-3 py-2 shadow-sm" style="min-width:150px;">
                                        <i class="flaticon-vibrating-phone fs-4 me-2"></i>
                                        <div>
                                            <h6 class="mb-1 text-uppercase fw-bold" style="font-size:11px; color:#fff;">Telepon</h6>
                                            <p class="mb-0" style="font-size:11px; color:#e0f7f6;">(021) 84978693<br>081112021333</p>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-start bg-white bg-opacity-10 rounded px-3 py-2 shadow-sm" style="min-width:150px;">
                                        <i class="flaticon-placeholder fs-4 me-2"></i>
                                        <div>
                                            <h6 class="mb-1 text-uppercase fw-bold" style="font-size:11px; color:#fff;">Alamat</h6>
                                            <p class="mb-0" style="font-size:11px; color:#e0f7f6;">Jl.Arteri JORR Jatiwarna Pondok Melati<br>Kota Bekasi Jawa Barat 17415</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </header>
</div>