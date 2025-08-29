<?php
$site = $this->konfigurasi_model->listing();
$site_nav = $this->konfigurasi_model->listing();
$nav_profil = $this->nav_model->nav_profil();
// $nav_download               = $this->nav_model->nav_download();
$nav_berita = $this->nav_model->nav_berita();
$nav_agenda = $this->nav_model->nav_agenda();
$nav_pendidikan = $this->nav_model->nav_pendidikan();
$nav_jurusan = $this->nav_model->nav_jurusan();
$nav_alumni = $this->nav_model->nav_alumni();
$nav_layanan = $this->nav_model->nav_layanan();
$nav_spi = $this->nav_model->nav_spi();
?>
<!-- Start Menu -->
<div class="bg-main-menu menu-scroll">
    <div class="container">
        <div class="row">
            <div class="main-menu">
                <!-- <a class="show-res-logo" href="<?php echo base_url() ?>"><img src="<?php echo $this->website->logo() ?>" alt="logo" class="img-responsive" style="max-height: 85px; width: auto;" /></a> -->
                <nav class="navbar">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!-- <a class="navbar-brand" href="<?php echo base_url() ?>"><img src="<?php echo $this->website->logo() ?>" alt="logo" class="img-responsive" style="max-height: 56px; width: auto;" /></a> -->
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <!-- home -->
                            <li><a href="<?php echo base_url('/') ?>" style="padding-left: 6px; padding-right: 6px;">Home</a></li>

                            <!-- berita -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-left: 6px; padding-right: 6px;">Berita <span class="caret"></span></a>
                                <ul class="dropdown-menu sub-menu">
                                    <li><a href="<?php echo base_url('berita') ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Indeks
                                            Berita</a></li>
                                    <li><a href="<?php echo base_url('capaian') ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Dashboard Capaian ZI</a></li>
                                    <li><a href="<?php echo base_url('maturity') ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Maturity Rating BLU</a></li>
                                </ul>
                            </li>

                            <!-- PROFIL -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-left: 6px; padding-right: 6px;">Tentang<span class="caret"></span></a>
                                <ul class="dropdown-menu sub-menu">
                                    <?php foreach ($nav_profil as $nav_profil) { ?>
                                        <li><a href="<?php echo base_url('pages/tentang/' . $nav_profil->slug_pages) ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                                <?php echo $nav_profil->judul_pages ?></a></li>
                                    <?php } ?>
                                    <li><a href="<?php echo base_url('akreditasi'); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Akreditasi</a>
                                    <li><a href="<?php echo base_url('jajaran-manajemen'); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Jajaran Manajemen</a>
                                </ul>

                            </li>

                            <!-- PENDIDIKAN -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-left: 6px; padding-right: 6px;">Pendidikan<span class="caret"></span></a>
                                <ul class="dropdown-menu sub-menu">
                                    <li><a href="<?php echo base_url('jurusan'); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Jurusan</a>
                                        <!-- <li><a href="<?php echo base_url('akademik'); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Akademik</a> -->
                                        <?php foreach ($nav_pendidikan as $nav_pendidikan) { ?>
                                    <li><a href="<?php echo base_url('pages/pendidikan/' . $nav_pendidikan->slug_pages) ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                            <?php echo $nav_pendidikan->judul_pages ?></a></li>
                                <?php } ?>
                                <li><a href="https://perpustakaan.poltekkesjakarta3.ac.id/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> e-library</a>
                                <li><a href="https://elearning.pusilkom.com/jakarta3/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> e-learning</a>
                                <li><a href="<?php echo base_url('monev'); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Monev Pembelajaran</a>
                                </ul>
                            </li>

                            <!-- Pengawasan -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-left: 6px; padding-right: 6px;">SPI<span class="caret"></span></a>
                                <ul class="dropdown-menu sub-menu">
                                    <?php foreach ($nav_spi as $nav_spi) { ?>
                                        <li><a href="<?php echo base_url('pages/spi/' . $nav_spi->slug_pages) ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                                <?php echo $nav_spi->judul_pages ?></a></li>
                                    <?php } ?>
                                    <li><a href="https://docs.google.com/forms/d/e/1FAIpQLSeSxqFEcWG4jC3UWUoQF1bMQ-ZC0ZXgPVxysPeF5q_MDj8Nkw/viewform?pli=1" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Gratifikasi</a></li>
                                    <li><a href="https://forms.gle/wuqW5C1JvMWxifLv8" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Pengaduan</a></li>
                                    <li><a href="https://forms.gle/ep6bV5EBkHKDbPcs9" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> SPIP</a></li>
                                    <li><a href="https://docs.google.com/forms/d/e/1FAIpQLSevZSOiqHVms6kaVT6lq61i-UmyA3Z0x_FpjzYzxD0CXve9Bw/viewform?usp=sf_link" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Conflict Of Interest</a></li>
                                    <li><a href="https://docs.google.com/forms/d/e/1FAIpQLSf1ReS2VpVeIGWjGxLglNNLfeLN0_0qkTpoNbLqon3Ae4uF2Q/viewform?pli=1" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Whistle Blowing System</a></li>
                                    <li><a href="https://docs.google.com/forms/d/e/1FAIpQLSeWjOT-EAdFJz6ZR4EJ-lljcbDDKp4KTl6LeFbORGatLu8Qhg/viewform" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Kepuasan Pelanggan</a></li>
                                </ul>
                            </li>

                            <!-- PUI-PK -->
                            <li><a href="<?php echo base_url('puipk') ?>" style="padding-left: 6px; padding-right: 6px;">PUIPK</a></li>

                            <!-- galeri -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-left: 6px; padding-right: 6px;">Galeri <span class="caret"></span></a>
                                <ul class="dropdown-menu sub-menu">

                                    <li><a href="<?php echo base_url('galeri'); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Galeri Foto</a>
                                    </li>
                                    <li><a href="<?php echo base_url('video'); ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Galeri
                                            Video</a></li>
                                </ul>
                            </li>

                            <!-- Alumni -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-left: 6px; padding-right: 6px;">Alumni<span class="caret"></span></a>
                                <ul class="dropdown-menu sub-menu">
                                    <?php foreach ($nav_alumni as $nav_alumni) { ?>
                                        <li><a href="<?php echo base_url('pages/alumni/' . $nav_alumni->slug_pages) ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                                <?php echo $nav_alumni->judul_pages ?></a></li>
                                    <?php } ?>
                                    <li><a href="https://forms.gle/KhbYyCxuG5f8cAwS9" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Tracers Study</a>
                                    <li><a href="http://bursanakes.kemkes.go.id/bursa2019/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Lowongan Kerja</a>
                                    <li><a href="https://alumnijkt3.pusilkom.com/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Portal Alumni</a>
                                </ul>
                            </li>

                            <!-- UNDUHAN -->

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-left: 6px; padding-right: 6px;">Pelayanan Publik<span class="caret"></span></a>
                                <ul class="dropdown-menu sub-menu">
                                    <?php foreach ($nav_layanan as $nav_layanan) { ?>
                                        <li><a href="<?php echo base_url('pages/layanan/' . $nav_layanan->slug_pages) ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                                <?php echo $nav_layanan->judul_pages ?></a></li>
                                    <?php } ?>
                                    <li><a href="<?php echo base_url('unduhan/layanan_publik') ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Layanan Publik</a>
                                    <li><a href="<?php echo base_url('unduhan/informasi_publik') ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Informasi Publik</a>
                                    <li><a href="<?php echo base_url('unduhan/organisasi') ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Organisasi & Tatalaksana</a>
                                </ul>
                            </li>

                            <!-- APLIKASI  -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true" style="padding-left: 6px; padding-right: 6px;">e-office<span class="caret"></span></a>
                                <ul class="dropdown-menu sub-menu">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Sipenmaru<span class="caret"></span></a>
                                        <ul class="dropdown-menu sub-sub-menu">
                                            <li><a href="https://sipenmaru.poltekkesjakarta3.ac.id/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Sipenmaru PMDP/Prestasi</a></li>
                                            <li><a href="https://simama-poltekkes.kemkes.go.id/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Sipenmaru Bersama</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Akademik<span class="caret"></span></a>
                                        <ul class="dropdown-menu sub-sub-menu">
                                            <li><a href="https://jakarta3.pusilkom.com/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> EUIS</a></li>
                                            <li><a href="https://elearning.pusilkom.com/jakarta3/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> VILC</a></li>
                                            <li><a href="https://ruang.pusilkom.com/#/login" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Siruang</a></li>
                                            <li><a href="https://presensi-v2.poltekkesjakarta3.ac.id/student/public/signin" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Presensi Mahasiswa</a></li>
                                            <li><a href="https://presensi-v2.poltekkesjakarta3.ac.id/lecturer/public/signin" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Presensi Dosen</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Kemahasiswaan<span class="caret"></span></a>
                                        <ul class="dropdown-menu sub-sub-menu">
                                            <li><a href="https://sipenmaru.poltekkesjakarta3.ac.id/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Sipenmaru</a></li>
                                            <li><a href="https://alumnijkt3.pusilkom.com/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Portal Alumni</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Perpustakaan<span class="caret"></span></a>
                                        <ul class="dropdown-menu sub-sub-menu">
                                            <li><a href="http://perpustakaan.poltekkesjakarta3.ac.id/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> e-library</a></li>
                                            <li><a href="http://45.112.126.114/library/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Repository</a></li>
                                            <li><a href="https://lisa.poltekkesjakarta3.ac.id/perpustakaan/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Lisa</a></li>
                                            <li><a href="<?php echo base_url('isbn') ?>" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> ISBN</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Kepegawaian & UMUM<span class="caret"></span></a>
                                        <ul class="dropdown-menu sub-sub-menu">
                                            <li><a href="http://sister.poltekkesjakarta3.ac.id/auth/login" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> sister</a></li>
                                            <li><a href="http://114.7.227.163:8843/kinerja-v2-2024/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> e-kinerja</a></li>
                                            <li><a href="https://siaker.poltekkesjakarta3.sch.id/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> siaker</a></li>
                                            <li><a href="https://rent.poltekkesjakarta3.ac.id/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> rental property</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="fa fa-angle-double-right" aria-hidden="true"></i> e-Jurnal<span class="caret"></span></a>
                                        <ul class="dropdown-menu sub-sub-menu">
                                            <li><a href="https://ejurnal.poltekkesjakarta3.ac.id/index.php/jitek" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Jurnal Jitek</a></li>
                                            <li><a href="https://ejurnal.poltekkesjakarta3.ac.id/index.php/jkep" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Jurnal Jkep</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Pengadaaan<span class="caret"></span></a>
                                        <ul class="dropdown-menu sub-sub-menu">
                                            <li><a href="http://www.lkpp.go.id/v3/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> LKPP</a></li>
                                            <li><a href="https://lpse.kemkes.go.id/eproc4" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> LPSE</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="https://e-performance.poltekkesjakarta3.ac.id/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> E-Performance</a></li>
                                    <li><a href="<?php echo base_url('magazine') ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> E-Majalah</a></li>
                                    <li><a href="http://pusat-mutu.poltekkesjakarta3.ac.id/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Pusat Mutu</a></li>
                                    <li><a href="https://wrhc-indonesia.com/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> WRHC</a></li>
                                    <li><a href="https://sippn.menpan.go.id/instansi/184132/kementerian-kesehatan-republik-indonesia/politeknik-kesehatan-kemenkes-jakarta-iii" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> SIPPN KemenpanRB</a></li>
                                    <li><a href="https://srv76.niagahoster.com:2096/" target="_blank"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Webmail</a></li>

                                </ul>
                            </li>

                        </ul>
                        <div class="menu-right-option pull-right">

                            <div class="search-box">
                                <i class="fa fa-search first_click" aria-hidden="true" style="display: block;"></i>
                                <i class="fa fa-times second_click" aria-hidden="true" style="display: none;"></i>
                            </div>
                            <div class="search-box-text">
                                <form action="<?php echo base_url('berita/search') ?>" method="GET">
                                    <input type="text" name="search" id="all-search" placeholder="Search Here">
                                </form>
                            </div>
                        </div>
                        <!-- .header-search-box -->
                    </div>
                    <!-- .navbar-collapse -->
                </nav>
            </div>
            <!-- .main-menu -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</div>
<!-- .bg-main-menu -->
</header>