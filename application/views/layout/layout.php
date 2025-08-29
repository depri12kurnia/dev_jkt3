<?php
// Site
$site_info = $this->konfigurasi_model->listing();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="description" content="<?php echo strip_tags($site_info->tentang) . ', ' . $title ?>">
    <meta name="keywords" content="<?php echo $site_info->keywords . ', ' . $title  ?>">
    <meta name="author" content="<?php echo $site_info->namaweb ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- icon -->
    <link rel="shortcut icon" href="<?php echo $this->website->icon(); ?>">
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">

    <!-- DataTables CSS untuk Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/responsive.css">
</head>

<body>
    <?php $site = $this->konfigurasi_model->listing(); ?>
    <div class="box-layout">
        <!-- Header Bootstrap -->
        <header class="header-style-1">
            <div class="floating-widget">
                <input type="checkbox" id="toggle-widget">
                <label for="toggle-widget" class="widget-button">
                    <i class="bi bi-chat-dots-fill"></i>
                </label>
                <div class="widget-menu">
                    <a href="https://wa.me/6281234567890" target="_blank" class="widget-item whatsapp">
                        <i class="bi bi-whatsapp"></i> WhatsApp
                    </a>
                    <a href="tel:+6281234567890" class="widget-item phone">
                        <i class="bi bi-telephone-fill"></i> Telepon
                    </a>
                    <a href="https://instagram.com/akunmu" target="_blank" class="widget-item instagram">
                        <i class="bi bi-instagram"></i> Instagram
                    </a>
                    <a href="https://apps.example.com" target="_blank" class="widget-item app">
                        <i class="bi bi-box-arrow-up-right"></i> Cariyanlink
                    </a>
                </div>
            </div>


            <div class="bg-header-top py-2" style="background: var(--primary,#00B9AD); url('https://www.transparenttextures.com/patterns/geometry2.png') repeat; color: #fff;">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-3 d-flex align-items-center mb-2 mb-md-0">
                            <a href="<?php echo base_url() ?>">
                                <img src="<?php echo $this->website->logo() ?>" alt="logo" class="img-fluid rounded" style="max-height:100px;">
                            </a>
                        </div>
                        <div class="col-md-9">
                            <ul class="list-inline mt-3 d-flex flex-wrap gap-2 justify-content-end d-none d-lg-flex">
                                <li class="list-inline-item">
                                    <a href="https://wa.me/<?php echo $site->whatsapp; ?>" target="_blank" class="footer-social rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa fa-whatsapp"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="<?php echo $site->facebook ?>" target="_blank" class="footer-social rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="<?php echo $site->twitter; ?>" target="_blank" class="footer-social rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="<?php echo $site->instagram; ?>" target="_blank" class="footer-social rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="<?php echo $site->youtube; ?>" target="_blank" class="footer-social rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa fa-youtube"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="<?php echo base_url('helpdesk') ?>" target="_blank" class="footer-social rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa fa-question"></i>
                                    </a>
                                </li>
                            </ul>
                            <ul class="list-inline mt-2 d-flex flex-wrap gap-2 justify-content-end d-none d-lg-flex">
                                <li class="nav-item"><a href="#">SPMB Prestasi</a></li> |
                                <li class="nav-item"><a href="#">SPMB Bersama</a></li> |
                                <li class="nav-item"><a href="#">SPMB Mandiri</a></li> |
                                <li class="nav-item"><a href="#">Faq&Helpdesk</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- End Header -->

        <!-- Start Menu (Bootstrap Navbar) -->
        <?php
        $nav_profil = $this->nav_model->nav_profil();
        $nav_pendidikan = $this->nav_model->nav_pendidikan();
        $nav_alumni = $this->nav_model->nav_alumni();
        $nav_layanan = $this->nav_model->nav_layanan();
        $nav_spi = $this->nav_model->nav_spi();
        ?>
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background: var(--primary,#00B9AD);">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNavbar">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('/') ?>">Home</a></li>
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="beritaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Berita</a>
                            <ul class="dropdown-menu" aria-labelledby="beritaDropdown">
                                <li><a class="dropdown-item" href="<?php echo base_url('berita') ?>">Indeks Berita</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('capaian') ?>">Dashboard Capaian ZI</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('maturity') ?>">Maturity Rating BLU</a></li>
                            </ul>
                        </li> -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tentang</a>
                            <ul class="dropdown-menu dropdown-menu-3col p-0" aria-labelledby="profilDropdown">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="dropdown-header fw-bold text-default">Profil</div>
                                            <?php foreach ($nav_profil as $nav_profil) { ?>
                                                <li><a class="dropdown-item" href="<?php echo base_url('pages/tentang/' . $nav_profil->slug_pages) ?>"><?php echo $nav_profil->judul_pages ?></a>
                                                </li>
                                            <?php } ?>
                                            <li><a class="dropdown-item" href="<?php echo base_url('akreditasi'); ?>">Akreditasi</a></li>
                                            <li><a class="dropdown-item" href="<?php echo base_url('jajaran-manajemen'); ?>">Jajaran Manajemen</a></li>
                                        </div>
                                        <div class="col-4">
                                            <div class="dropdown-header fw-bold text-default">Pusat</div>
                                            <li><a class="dropdown-item" href="#">Pusat Penjamin Mutu</a></li>
                                            <li><a class="dropdown-item" href="#">Pusat Penelitian dan Pengabdian Masyarakat</a></li>
                                            <li><a class="dropdown-item" href="#">Pusat Pengembangan Pendidikan</a></li>
                                        </div>
                                        <div class="col-4">
                                            <div class="dropdown-header fw-bold text-default">Unit</div>
                                            <li><a class="dropdown-item" href="#">Unit Laboratorium Terpadu</a></li>
                                            <li><a class="dropdown-item" href="#">Unit Pengembangan Bahasa</a></li>
                                            <li><a class="dropdown-item" href="#">Unit Pengembangan Kompetensi</a></li>
                                            <li><a class="dropdown-item" href="#">Unit Perpustakaan Terpadu</a></li>
                                            <li><a class="dropdown-item" href="#">Unit Teknologi Informasi</a></li>
                                            <li><a class="dropdown-item" href="#">Unit Usaha/Bisnis</a></li>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="pendidikanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pendidikan</a>
                            <ul class="dropdown-menu dropdown-menu-3col p-0" aria-labelledby="pendidikanDropdown">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="dropdown-header fw-bold text-default">Jurusan</div>
                                            <li><a class="dropdown-item" href="<?php echo base_url('keperawatan'); ?>">Keperawatan</a></li>
                                            <li><a class="dropdown-item" href="<?php echo base_url('kebidanan'); ?>">Kebidanan</a></li>
                                            <li><a class="dropdown-item" href="<?php echo base_url('fisioterapi'); ?>">Fisioterapi</a></li>
                                            <li><a class="dropdown-item" href="<?php echo base_url('tlm'); ?>">TLM</a></li>
                                        </div>
                                        <div class="col-4">
                                            <div class="dropdown-header fw-bold text-default">Akademik</div>
                                            <?php foreach ($nav_pendidikan as $nav_pendidikan) { ?>
                                                <li><a class="dropdown-item" href="<?php echo base_url('pages/pendidikan/' . $nav_pendidikan->slug_pages) ?>"><?php echo $nav_pendidikan->judul_pages ?></a></li>
                                            <?php } ?>
                                            <li><a class="dropdown-item" href="<?php echo base_url('monev'); ?>">Monev Pembelajaran</a></li>
                                        </div>
                                        <div class="col-4">
                                            <div class="dropdown-header fw-bold text-default">E-Learning</div>
                                            <li><a class="dropdown-item" href="https://perpustakaan.poltekkesjakarta3.ac.id/" target="_blank">e-Library</a></li>
                                            <li><a class="dropdown-item" href="https://elearning.pusilkom.com/jakarta3/" target="_blank">e-Learning</a></li>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </li>
                        <!-- ============================================ -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="spiDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">SPI</a>
                            <ul class="dropdown-menu dropdown-menu-3col p-0" aria-labelledby="spiDropdown">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="dropdown-header fw-bold text-default">Pengaduan</div>
                                            <?php foreach ($nav_spi as $nav_spi) { ?>
                                                <a class="dropdown-item" href="<?php echo base_url('pages/spi/' . $nav_spi->slug_pages) ?>"><?php echo $nav_spi->judul_pages ?></a>
                                            <?php } ?>
                                            <li><a class="dropdown-item" href="https://sipadu.poltekkesjakarta3.ac.id/" target="_blank">Lapor Gratifikasi</a></li>
                                            <li><a class="dropdown-item" href="https://sipadu.poltekkesjakarta3.ac.id/" target="_blank">Lapor Pengaduan</a></li>
                                            <li><a class="dropdown-item" href="https://sipadu.poltekkesjakarta3.ac.id/" target="_blank">Conflict Of Interest</a></li>
                                            <li><a class="dropdown-item" href="https://wbs.kemkes.go.id/" target="_blank">Whistle Blowing System</a></li>
                                        </div>
                                        <div class="col-6">
                                            <div class="dropdown-header fw-bold text-default">Aplikasi</div>
                                            <li><a class="dropdown-item" href="https://forms.gle/ep6bV5EBkHKDbPcs9" target="_blank">SPIP</a></li>
                                            <li><a class="dropdown-item" href="https://rmis.bpkp.go.id/login" target="_blank">RMIS</a></li>
                                            <li><a class="dropdown-item" href="https://docs.google.com/forms/d/e/1FAIpQLSeWjOT-EAdFJz6ZR4EJ-lljcbDDKp4KTl6LeFbORGatLu8Qhg/viewform" target="_blank">Kepuasan Pelanggan</a></li>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="https://upksdmk.poltekkesjakarta3.ac.id/" target="_blank">UPK-SDMK</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="spiDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Alumni</a>
                            <ul class="dropdown-menu dropdown-menu-3col p-0" aria-labelledby="spiDropdown">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="dropdown-header fw-bold text-default">Legalisir Online</div>
                                            <?php foreach ($nav_alumni as $nav_alumni) { ?>
                                                <li><a class="dropdown-item" href="<?php echo base_url('pages/alumni/' . $nav_alumni->slug_pages) ?>"><?php echo $nav_alumni->judul_pages ?></a></li>
                                            <?php } ?>
                                            <li><a class="dropdown-item" href="#" target="_blank">Tracers Study</a></li>
                                        </div>
                                        <div class="col-6">
                                            <div class="dropdown-header fw-bold text-default">Bursa Kerja</div>
                                            <li><a class="dropdown-item" href="http://bursanakes.kemkes.go.id/bursa2019/" target="_blank">Bursa Nakes</a></li>
                                            <li><a class="dropdown-item" href="https://alumnijkt3.pusilkom.com/" target="_blank">Portal Alumni</a></li>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="pelayananPublikDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pelayanan Publik</a>
                            <ul class="dropdown-menu dropdown-menu-3col p-0" aria-labelledby="pelayananPublikDropdown">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="dropdown-header fw-bold text-default">Informasi Publik</div>
                                            <li><a class="dropdown-item" href="<?php echo base_url('unduhan/dokumen') ?>" target="_blank">Dokumen</a></li>
                                            <li><a class="dropdown-item" href="<?php echo base_url('unduhan/akuntabilitas') ?>" target="_blank">Akuntabilitas</a></li>
                                            <li><a class="dropdown-item" href="<?php echo base_url('unduhan/standardpelayanan') ?>" target="_blank">Standard Pelayanan</a></li>
                                            <li><a class="dropdown-item" href="<?php echo base_url('unduhan/prestasi') ?>" target="_blank">Prestasi & Penghargaan</a></li>
                                        </div>
                                        <div class="col-4">
                                            <div class="dropdown-header fw-bold text-default">Layanan Publik</div>
                                            <li><a class="dropdown-item" href="<?php echo base_url('unduhan/akademik') ?>" target="_blank">Akademik</a></li>
                                            <li><a class="dropdown-item" href="<?php echo base_url('unduhan/kemahasiswaan') ?>" target="_blank">Kemahasiswaan</a></li>
                                            <li><a class="dropdown-item" href="<?php echo base_url('unduhan/layananpelanggan') ?>" target="_blank">Layanan Pelanggan</a></li>
                                            <li><a class="dropdown-item" href="<?php echo base_url('unduhan/layananperpustakaan') ?>" target="_blank">Layanan Perpustakaan</a></li>
                                        </div>
                                        <div class="col-4">
                                            <div class="dropdown-header fw-bold text-default">Standar Layanan</div>
                                            <?php foreach ($nav_layanan as $nav_layanan) { ?>
                                                <li><a class="dropdown-item" href="<?php echo base_url('pages/layanan/' . $nav_layanan->slug_pages) ?>"><?php echo $nav_layanan->judul_pages ?></a></li>
                                            <?php } ?>

                                            <div class="dropdown-header fw-bold text-default">Organisasi & Tatalaksana</div>
                                            <li><a class="dropdown-item" href="<?php echo base_url('unduhan/listasn') ?>" target="_blank">Peraturan ASN</a></li>
                                            <li><a class="dropdown-item" href="<?php echo base_url('unduhan/listpdosen') ?>" target="_blank">Peraturan Dosen</a></li>
                                        </div>

                                    </div>
                                </div>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="eofficeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">E-Office</a>
                            <ul class="dropdown-menu dropdown-menu-3col p-3" aria-labelledby="eofficeDropdown">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="dropdown-header fw-bold text-default">SPMB</div>
                                            <a class="dropdown-item" href="#" target="_blank">SPMB Prestasi</a>
                                            <a class="dropdown-item" href="#" target="_blank">SPMB Bersama</a>

                                            <div class="dropdown-header fw-bold text-default">Akademik & Kemahasiswaan</div>
                                            <a class="dropdown-item" href="https://jakarta3.pusilkom.com/" target="_blank">Siakad EUIS</a>
                                            <a class="dropdown-item" href="https://elearning.pusilkom.com/jakarta3/" target="_blank">e-Learning VILC</a>
                                            <a class="dropdown-item" href="https://ruang.pusilkom.com/#/login" target="_blank">Siruang</a>
                                            <a class="dropdown-item" href="https://alumnijkt3.pusilkom.com/" target="_blank">Portal Alumni</a>

                                            <div class="dropdown-header fw-bold text-default">Kepegawaian & UMUM</div>
                                            <a class="dropdown-item" href="http://sister.poltekkesjakarta3.ac.id/auth/login" target="_blank">Sister</a>
                                            <a class="dropdown-item" href="http://114.7.227.163:8843/kinerja-v2-2024/" target="_blank">E-Kinerja</a>
                                            <a class="dropdown-item" href="https://siaker.poltekkesjakarta3.sch.id/" target="_blank">Siaker</a>
                                            <a class="dropdown-item" href="https://rent.poltekkesjakarta3.ac.id/" target="_blank">Rental</a>
                                        </div>
                                        <div class="col-4">
                                            <div class="dropdown-header fw-bold text-default">Perpustakaan</div>
                                            <a class="dropdown-item" href="http://perpustakaan.poltekkesjakarta3.ac.id/" target="_blank">Perpustakaan</a>
                                            <a class="dropdown-item" href="http://45.112.126.114/library/" target="_blank">Repository</a>
                                            <a class="dropdown-item" href="https://lisa.poltekkesjakarta3.ac.id/perpustakaan/" target="_blank">Lisa</a>
                                            <a class="dropdown-item" href="<?php echo base_url('isbn') ?>" target="_blank">ISBN</a>

                                            <div class="dropdown-header fw-bold text-default">Publikasi</div>
                                            <a class="dropdown-item" href="https://ejurnal.poltekkesjakarta3.ac.id/index.php/jitek" target="_blank">Jitek</a>
                                            <a class="dropdown-item" href="https://ejurnal.poltekkesjakarta3.ac.id/index.php/jkep" target="_blank">Jkep</a>

                                            <div class="dropdown-header fw-bold text-default">Pengadaan</div>
                                            <a class="dropdown-item" href="http://www.lkpp.go.id/v3/" target="_blank">LKPP</a>
                                            <a class="dropdown-item" href="https://lpse.kemkes.go.id/eproc4" target="_blank">LPSE</a>
                                        </div>
                                        <div class="col-4">
                                            <div class="dropdown-header fw-bold text-default">Lainnya</div>
                                            <a class="dropdown-item" href="https://e-performance.poltekkesjakarta3.ac.id/" target="_blank">ePerformance</a>
                                            <a class="dropdown-item" href="<?php echo base_url('magazine') ?>" target="_blank">Magazine</a>
                                            <a class="dropdown-item" href="http://pusat-mutu.poltekkesjakarta3.ac.id/" target="_blank">Mutu</a>
                                            <a class="dropdown-item" href="https://wrhc-indonesia.com/" target="_blank">WRHC</a>
                                            <a class="dropdown-item" href="https://sippn.menpan.go.id/instansi/184132/kementerian-kesehatan-republik-indonesia/politeknik-kesehatan-kemenkes-jakarta-iii" target="_blank">SIPPN KemenpanRB</a>
                                            <a class="dropdown-item" href="https://srv76.niagahoster.com:2096/" target="_blank">Webmail</a>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </li>

                    </ul>
                    <!-- <form class="d-flex" action="<?php echo base_url('berita/search') ?>" method="GET">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search Here" aria-label="Search">
                        <button class="btn btn-outline-light" type="submit"><i class="fa fa-search"></i></button>
                    </form> -->
                    <ul class="d-flex align-items-end list-unstyled mb-0 ms-auto">
                        <a href="lang/id" class="mx-2" title="Bahasa Indonesia"><img src="<?php echo base_url(); ?>assets/flag/idn.png" alt="Bahasa Indonesia"></a>
                        <a href="lang/en" class="mx-2" title="English"><img src="<?php echo base_url(); ?>assets/flag/eng.png" alt="English"></a>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Menu -->

        <!-- Slider Section -->
        <section class="bg-slider-option py-0">
            <div class="slider-option slider-two">
                <div id="slider" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <!-- Indicators -->
                    <div class="carousel-indicators">
                        <?php foreach ($slider as $idx => $s) { ?>
                            <button type="button" data-bs-target="#slider" data-bs-slide-to="<?php echo $idx; ?>" <?php if ($idx == 0) echo 'class="active" aria-current="true"'; ?> aria-label="Slide <?php echo $idx + 1; ?>"></button>
                        <?php } ?>
                    </div>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <?php foreach ($slider as $idx => $slider) : ?>
                            <div class="carousel-item <?php if ($idx == 0) echo 'active'; ?>">
                                <img src="<?php echo base_url('assets/upload/image/' . $slider->gambar); ?>" class="d-block w-100 lazyload" alt="<?php echo $slider->judul_galeri; ?>" style="max-height:600px; object-fit:cover;">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- Controls -->
                    <button class="carousel-control-prev btn btn-light btn-sm rounded-circle shadow position-absolute top-50 start-0 translate-middle-y ms-2" type="button" data-bs-target="#slider" data-bs-slide="prev" style="width:36px; height:36px; z-index:2;">
                        <span class="fa fa-chevron-left text-primary-dark" aria-hidden="true" style="font-size:1.2em;"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next btn btn-light btn-sm rounded-circle shadow position-absolute top-50 end-0 translate-middle-y me-2" type="button" data-bs-target="#slider" data-bs-slide="next" style="width:36px; height:36px; z-index:2;">
                        <span class="fa fa-chevron-right text-primary-dark" aria-hidden="true" style="font-size:1.2em;"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>
        <!-- End Slider Section -->

        <!-- About Section dengan Scroll Animation -->
        <section class="bg-about-greenforest py-5 scroll-animate">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <?php $noprof = 1;
                    foreach ($profil as $profil) {
                        if ($noprof == 1) { ?>
                            <div class="col-lg-12 col-md-12 scale-in delay-200">
                                <div class="card shadow-lg border-0 rounded-4 overflow-hidden hover-lift">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-md-7 bg-light d-flex align-items-center justify-content-center slide-left delay-300">
                                            <div class="about-greenforest-img p-3">
                                                <img src="<?php echo base_url('assets/upload/pages/' . $profil->gambar) ?>"
                                                    alt="about-greenforest-img"
                                                    class="img-fluid rounded-4 shadow lazyload zoom-on-hover"
                                                    style="border-top-right-radius: 50px; border-bottom-left-radius: 50px; object-fit:cover; max-height:320px;" />
                                            </div>
                                        </div>
                                        <div class="col-md-5 p-4 slide-right delay-400">
                                            <div class="about-greenforest-content">
                                                <h2 class="fw-bold mb-3 reveal-text">
                                                    <a href="<?php echo base_url('pages/tentang/' . $profil->slug_pages); ?>"
                                                        class="text-decoration-none text-primary-dark hover-underline">
                                                        <?php echo $profil->judul_pages ?>
                                                    </a>
                                                </h2>
                                                <p class="text-secondary mb-3 text-justify fade-in delay-600">
                                                    <?php echo character_limiter(strip_tags($profil->isi), 500); ?>
                                                </p>
                                                <div class="about-features bounce-in delay-700">
                                                    <div class="row g-2">
                                                        <div class="col-6">
                                                            <div class="feature-item d-flex align-items-center">
                                                                <i class="fa fa-check-circle text-success me-2"></i>
                                                                <small class="text-muted">Terakreditasi Unggul</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="feature-item d-flex align-items-center">
                                                                <i class="fa fa-graduation-cap text-primary me-2"></i>
                                                                <small class="text-muted">10+ Program Studi</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="feature-item d-flex align-items-center">
                                                                <i class="fa fa-users text-info me-2"></i>
                                                                <small class="text-muted">2500+ Mahasiswa</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="feature-item d-flex align-items-center">
                                                                <i class="fa fa-trophy text-warning me-2"></i>
                                                                <small class="text-muted">Prestasi Unggulan</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="about-action mt-4 slide-up delay-800">
                                                    <a href="<?php echo base_url('pages/tentang/' . $profil->slug_pages); ?>"
                                                        class="btn btn-primary btn-sm px-4 py-2 rounded-pillb text-white">
                                                        <i class="fa fa-arrow-right me-2"></i>Selengkapnya
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }
                        $noprof++;
                    } ?>
                </div>
            </div>
        </section>
        <!-- end About -->

        <!-- latestnews -->
        <section id="latestnews" class="px-2 latest_news">
            <div class="container py-2">
                <h2 class="display-6 fw-semibold text-body-emphasis m-0">Berita Terbaru</h2>
                <hr class="mt-2 mb-1">
                <div class="row py-3 row-cols-2 row-cols-lg-4">
                    <?php foreach ($berita as $berita) { ?>
                        <div class="col mb-2">
                            <div class="text-black bg-body-secondary mb-3 text-center post-images">
                                <a href="<?php echo base_url('berita/read/' . $berita->slug_berita); ?>"
                                    title="<?php echo ucfirst(mb_strtolower(character_limiter(strip_tags($berita->judul_berita), 100))); ?>"
                                    class=""><img src="<?php echo base_url('assets/upload/image/thumbs/' . $berita->gambar); ?>"
                                        alt="<?php echo ucfirst(mb_strtolower(character_limiter(strip_tags($berita->judul_berita), 100))); ?>"
                                        class="img-fluid "></a>

                            </div>
                            <a href="<?php echo base_url('berita/read/' . $berita->slug_berita); ?>"
                                title="<?php echo ucfirst(mb_strtolower(character_limiter(strip_tags($berita->judul_berita), 100))); ?>">
                                <h3 class="fs-6 fw-semibold mb-3"><?php echo ucfirst(mb_strtolower(character_limiter(strip_tags($berita->judul_berita), 100))); ?></h3>
                            </a>
                            <small class="fs-7 text-capitalize badge bg-warning text-dark">Utama</small>
                            <small class="fs-7 badge bg-light text-dark"> <?php echo date('d M Y H:i', strtotime($berita->tanggal_publish)); ?> </small>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="container btn-more d-flex justify-content-end align-items-center ">
                <a href="<?php echo base_url('berita'); ?>" class="px-4 py-2 rounded-pillb fs-7 fw-semibold mx-1" title="Selengkapnya"><i class="bi bi-arrow-right text-default fs-5"></i> Selengkapnya</a>
            </div>
        </section>
        <!-- End latestnews -->

        <!-- Integrated Services Section -->
        <section class="integrated-services-section py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header text-center mb-4">
                            <h2 class="fw-bold">Layanan Terintegrasi</h2>
                            <p class="text-muted">Akses layanan e-office dan informasi penting lainnya dengan mudah</p>
                        </div>

                        <!-- Nav Tabs -->
                        <ul class="nav nav-tabs" id="servicesTab" role="tablist">

                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="academic-tab" data-bs-toggle="tab" data-bs-target="#academic" type="button" role="tab">
                                    <i class="fa fa-graduation-cap me-2"></i>Akademik
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="eoffice-tab" data-bs-toggle="tab" data-bs-target="#eoffice" type="button" role="tab">
                                    <i class="fa fa-desktop me-2"></i>E-Office
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="public-tab" data-bs-toggle="tab" data-bs-target="#public" type="button" role="tab">
                                    <i class="fa fa-users me-2"></i>Layanan Publik
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="information-tab" data-bs-toggle="tab" data-bs-target="#information" type="button" role="tab">
                                    <i class="fa fa-info-circle me-2"></i>Informasi
                                </button>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content" id="servicesTabContent">

                            <!-- Academic Tab -->
                            <div class="tab-pane fade show active" id="academic" role="tabpanel">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="service-card">
                                            <div class="icon">
                                                <i class="fa fa-globe"></i>
                                            </div>
                                            <h5>Siakad EUIS</h5>
                                            <p>Sistem Informasi Akademik untuk mahasiswa dan dosen</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="service-card">
                                            <div class="icon">
                                                <i class="fa fa-laptop"></i>
                                            </div>
                                            <h5>E-Learning VILC</h5>
                                            <p>Platform pembelajaran online untuk mendukung perkuliahan</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="service-card">
                                            <div class="icon">
                                                <i class="fa fa-book"></i>
                                            </div>
                                            <h5>E-Library</h5>
                                            <p>Perpustakaan digital dengan koleksi lengkap</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- E-Office Tab -->
                            <div class="tab-pane fade" id="eoffice" role="tabpanel">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="service-card">
                                            <div class="icon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <h5>Surat Menyurat</h5>
                                            <p>Sistem manajemen surat elektronik untuk administrasi yang efisien</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="service-card">
                                            <div class="icon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <h5>Agenda Kegiatan</h5>
                                            <p>Manajemen jadwal dan kegiatan institusi secara terpusat</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="service-card">
                                            <div class="icon">
                                                <i class="fa fa-archive"></i>
                                            </div>
                                            <h5>Arsip Digital</h5>
                                            <p>Penyimpanan dan pengelolaan dokumen secara digital</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Public Services Tab -->
                            <div class="tab-pane fade" id="public" role="tabpanel">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="service-card">
                                            <div class="icon">
                                                <i class="fa fa-user-plus"></i>
                                            </div>
                                            <h5>Pendaftaran</h5>
                                            <p>Sistem pendaftaran mahasiswa baru online</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="service-card">
                                            <div class="icon">
                                                <i class="fa fa-certificate"></i>
                                            </div>
                                            <h5>Legalisir</h5>
                                            <p>Layanan legalisir dokumen akademik</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="service-card">
                                            <div class="icon">
                                                <i class="fa fa-comments"></i>
                                            </div>
                                            <h5>Pengaduan</h5>
                                            <p>Sistem pengaduan dan aspirasi masyarakat</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Information Tab -->
                            <div class="tab-pane fade" id="information" role="tabpanel">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="service-card">
                                            <div class="icon">
                                                <i class="fa fa-newspaper-o"></i>
                                            </div>
                                            <h5>Berita Terkini</h5>
                                            <p>Update informasi dan berita terbaru kampus</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="service-card">
                                            <div class="icon">
                                                <i class="fa fa-bullhorn"></i>
                                            </div>
                                            <h5>Pengumuman</h5>
                                            <p>Pengumuman resmi dari institusi</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="service-card">
                                            <div class="icon">
                                                <i class="fa fa-question-circle"></i>
                                            </div>
                                            <h5>FAQ & Help</h5>
                                            <p>Bantuan dan pertanyaan yang sering diajukan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Integrated Services Section -->

        <!-- Start Video Promotion Section -->
        <section class="video-promotion-section py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <div class="video-content">
                            <div class="section-header text-start">
                                <span class="badge bg-primary mb-2">Video Kampus</span>
                                <h2 class="display-5 fw-bold mb-3">Jelajahi Kehidupan Kampus PolkesJati</h2>
                                <p class="lead text-muted mb-4">Saksikan suasana pembelajaran, fasilitas modern, dan prestasi mahasiswa Politeknik Kesehatan Jakarta III melalui video kami.</p>
                            </div>
                            <div class="video-stats row g-3 mb-4">
                                <div class="col-4">
                                    <div class="stat-item text-center">
                                        <h3 class="fw-bold text-primary mb-1">10+</h3>
                                        <p class="small text-muted mb-0">Program Studi</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-item text-center">
                                        <h3 class="fw-bold text-primary mb-1">2500+</h3>
                                        <p class="small text-muted mb-0">Mahasiswa Aktif</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-item text-center">
                                        <h3 class="fw-bold text-primary mb-1">96%</h3>
                                        <p class="small text-muted mb-0">Tingkat Kelulusan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="video-actions d-flex gap-3 flex-wrap">
                                <a href="<?php echo base_url('pendaftaran'); ?>" class="btn btn-primary btn-lg px-4">
                                    <i class="fa fa-graduation-cap me-2"></i>Daftar Sekarang
                                </a>
                                <a href="https://www.youtube.com/@officialpoltekkesjakarta3" target="_blank" class="btn btn-outline-primary btn-lg px-4">
                                    <i class="fa fa-play-circle me-2"></i>Lihat Semua Video
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="video-player-wrapper">
                            <div class="video-thumbnail position-relative">
                                <img src="<?php echo base_url('assets/upload/video-thumbnail.jpg'); ?>" alt="Video Kampus PolkesJati" class="img-fluid rounded-4 shadow-lg">
                                <div class="play-button-overlay position-absolute top-50 start-50 translate-middle">
                                    <button class="btn-play" data-bs-toggle="modal" data-bs-target="#videoModal">
                                        <i class="fa fa-play"></i>
                                    </button>
                                </div>
                                <div class="video-badges position-absolute top-0 start-0 m-3">
                                    <span class="badge bg-danger bg-gradient px-3 py-2">
                                        <i class="fa fa-video-camera me-1"></i>HD Quality
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Video Modal -->
        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 rounded-4">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold" id="videoModalLabel">Video Promosi PolkesJati</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="ratio ratio-16x9">
                            <iframe id="videoFrame" src="" title="Video Promosi Kampus" allowfullscreen class="rounded-bottom-4"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Video Promotion Section -->

        <!-- Start partners Section -->
        <section class="partners-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="partners-option">
                            <div class="section-header">
                                <h4>Mitra Dalam & Luar Negeri</h4>
                            </div>
                            <!-- .section-header -->
                            <div class="partners-container">
                                <div class="swiper-wrapper">
                                    <?php $i = 1;
                                    foreach ($mitra as $mitra) : ?>
                                        <div class="swiper-slide">
                                            <div class="sopnsors-items">
                                                <a target="_blank" href="<?php echo $mitra->link_mitra ?>"><img src="<?php echo base_url('assets/upload/mitra/' . $mitra->gambar); ?>" alt="partners-img-<?php echo $mitra->urutan ?>" class="img-responsive" /></a>
                                            </div>
                                            <!-- .partners-items -->
                                        </div>
                                    <?php $i++;
                                    endforeach; ?>
                                    <!-- .swiper-slide -->
                                </div>
                                <!-- .swiper-wrapper -->
                            </div>
                            <!-- .partners-container -->
                        </div>
                        <!-- .partners-option -->
                    </div>
                </div>
                <!-- .row -->
            </div>
            <!-- .container -->
        </section>
        <!-- End partners Section -->

        <!-- Footer Bootstrap -->
        <!-- ============ -->
        <footer class="mt-5 footer-custom">
            <div class="container py-4">
                <div class="row g-4">
                    <div class="col-md-4 col-sm-12">
                        <h4 class="mb-3 fw-bold text-primary-dark">Lokasi</h4>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.6530826872395!2d106.92392351056975!3d-6.3092254936536545!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6992ba4f085f8d%3A0x4b820032d3ad33ae!2sPoltekkes%20Kemenkes%20Jakarta%20III!5e0!3m2!1sen!2sid!4v1753666860477!5m2!1sen!2sid" width="300" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <h5 class="mb-2 fw-semibold text-primary-dark">Social Media</h5>
                        <ul class="list-inline mt-3 d-flex flex-wrap gap-2">
                            <li class="list-inline-item">
                                <a href="https://wa.me/<?php echo $site->whatsapp; ?>" target="_blank" class="footer-social rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa fa-whatsapp"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="<?php echo $site->facebook ?>" target="_blank" class="footer-social rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="<?php echo $site->twitter; ?>" target="_blank" class="footer-social rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="<?php echo $site->instagram; ?>" target="_blank" class="footer-social rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="<?php echo $site->youtube; ?>" target="_blank" class="footer-social rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa fa-youtube"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="<?php echo base_url('helpdesk') ?>" target="_blank" class="footer-social rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa fa-question"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <h4 class="mb-3 fw-bold text-primary-dark">PolkesJati</h4>
                        <ul class="list-unstyled mb-3">
                            <li class="mb-2 d-flex align-items-center">
                                <i class="fa fa-map-marker text-primary-dark" style="font-size:1.3em; min-width:28px; text-align:center;"></i>
                                <span><?php echo nl2br($site->alamat) ?></span>
                            </li>
                            <li class="mb-2 d-flex align-items-center">
                                <i class="fa fa-phone text-primary-dark" style="font-size:1.3em; min-width:28px; text-align:center;"></i>
                                <span><?php echo $site->telepon ?></span>
                            </li>
                            <li class="mb-2 d-flex align-items-center">
                                <i class="fa fa-fax text-primary-dark" style="font-size:1.3em; min-width:28px; text-align:center;"></i>
                                <span><?php echo $site->fax ?></span>
                            </li>
                            <li class="mb-2 d-flex align-items-center">
                                <i class="fa fa-mobile text-primary-dark" style="font-size:1.3em; min-width:28px; text-align:center;"></i>
                                <span><?php echo $site->hp ?></span>
                            </li>
                            <li class="mb-2 d-flex align-items-center">
                                <i class="fa fa-envelope-o text-primary-dark" style="font-size:1.3em; min-width:28px; text-align:center;"></i>
                                <span><?php echo $site->email ?></span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <h4 class="mb-3 fw-bold text-primary-dark">Sistem Informasi</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="https://jakarta3.pusilkom.com/" target="_blank" class="footer-link"><i class="fa fa-university"></i> Sistem Informasi Akademik EUIS</a></li>
                            <li class="mb-2"><a href="https://alumnijkt3.pusilkom.com/" target="_blank" class="footer-link"><i class="fa fa-graduation-cap"></i> Sistem Informasi Portal Alumni</a></li>
                            <li class="mb-2"><a href="https://sipadu.poltekkesjakarta3.ac.id/" target="_blank" class="footer-link"><i class="fa fa-edit"></i> SiPadu Poltekkes Jakarta III</a></li>
                            <li class="mb-2"><a href="https://ruang.pusilkom.com/#/login" target="_blank" class="footer-link"><i class="fa fa-building"></i> Sistem Informasi Ruangan</a></li>
                            <li class="mb-2"><a href="https://rent.poltekkesjakarta3.ac.id/" target="_blank" class="footer-link"><i class="fa fa-car"></i> Sistem Informasi Rental Properti</a></li>
                            <li class="mb-2"><a href="https://sippn.menpan.go.id/instansi/184132/kementerian-kesehatan-republik-indonesia/politeknik-kesehatan-kemenkes-jakarta-iii" target="_blank" class="footer-link"><i class="fa fa-globe me-2"></i> SIPPN KemenpanRB</a></li>
                        </ul>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12 text-center mt-4">
                        <hr class="mb-3" style="border-color:var(--primary-dark);opacity:.2;">
                        <div>
                            <p class="mb-0 small text-secondary">
                                &copy; <?php echo date('Y') ?>. Designer By
                                <a href="https://poltekkesjakarta3.ac.id/" class="footer-link fw-bold" title="PolkesJati">PolkesJati</a>
                                &mdash; Page rendered in <strong>{elapsed_time}</strong> seconds.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->
    </div>

    <!-- jQuery (WAJIB untuk DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS untuk Bootstrap 5 -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- DataTables Responsive untuk Bootstrap 5 -->
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <!-- DataTables Buttons (opsional) -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            // Konfigurasi default untuk semua DataTables
            $.extend(true, $.fn.dataTable.defaults, {
                responsive: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                },
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                    '<"row"<"col-sm-12"tr>>' +
                    '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50, 100],
                columnDefs: [{
                        responsivePriority: 1,
                        targets: 0
                    },
                    {
                        responsivePriority: 2,
                        targets: -1
                    }
                ]
            });

            // Initialize DataTables
            $("#dokumen").DataTable();
            $("#example1").DataTable();

            // Untuk tabel dengan fitur tambahan
            $("#advanced-table").DataTable({
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"B>>' +
                    '<"row"<"col-sm-12 col-md-6"f>>' +
                    '<"row"<"col-sm-12"tr>>' +
                    '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>'
            });
        });


        // Video Modal Handler
        document.addEventListener('DOMContentLoaded', function() {
            const videoModal = document.getElementById('videoModal');
            const videoFrame = document.getElementById('videoFrame');

            // URL video YouTube atau embed lainnya
            const videoUrl = 'https://www.youtube.com/embed/zlBgFNwib_Q?si=gSc-FWkOTKwCvX-w';

            // Saat modal dibuka
            videoModal.addEventListener('show.bs.modal', function() {
                videoFrame.src = videoUrl;
            });

            // Saat modal ditutup
            videoModal.addEventListener('hide.bs.modal', function() {
                videoFrame.src = '';
            });
        });
    </script>
</body>

</html>