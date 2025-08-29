<!-- Start Menu (Bootstrap Navbar) -->
<?php
$nav_profil = $this->nav_model->nav_profil();
$nav_pendidikan = $this->nav_model->nav_pendidikan();
$nav_alumni = $this->nav_model->nav_alumni();
$nav_layanan = $this->nav_model->nav_layanan();
$nav_spi = $this->nav_model->nav_spi();
$nav_jurusan = $this->nav_model->nav_jurusan();
$nav_pusat = $this->nav_model->nav_pusat();
$nav_unit = $this->nav_model->nav_unit();
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
                                    <li><a class="dropdown-item" href="<?php echo base_url('sdm'); ?>">SDM</a></li>
                                </div>
                                <div class="col-4">
                                    <div class="dropdown-header fw-bold text-default">Pusat</div>
                                    <?php foreach ($nav_pusat as $nav) { ?>
                                        <li><a class="dropdown-item" href="<?php echo base_url('pusat/' . $nav->slug) ?>"><?php echo $nav->nama ?></a>
                                        </li>
                                    <?php } ?>
                                </div>
                                <div class="col-4">
                                    <div class="dropdown-header fw-bold text-default">Unit</div>
                                    <?php foreach ($nav_unit as $nav) { ?>
                                        <li><a class="dropdown-item" href="<?php echo base_url('unit/' . $nav->slug) ?>"><?php echo $nav->nama ?></a>
                                        </li>
                                    <?php } ?>
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
                                    <?php foreach ($nav_jurusan as $nav) { ?>
                                        <li><a class="dropdown-item" href="<?php echo base_url('jurusan/' . $nav->slug) ?>"><?php echo $nav->nama ?></a>
                                        </li>
                                    <?php } ?>
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
                                    <li><a class="dropdown-item" href="<?php echo base_url('unduhan/dokumen') ?>">Dokumen</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url('unduhan/akuntabilitas') ?>">Akuntabilitas</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url('unduhan/standardpelayanan') ?>">Standard Pelayanan</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url('unduhan/prestasi') ?>">Prestasi & Penghargaan</a></li>
                                </div>
                                <div class="col-4">
                                    <div class="dropdown-header fw-bold text-default">Layanan Publik</div>
                                    <li><a class="dropdown-item" href="<?php echo base_url('unduhan/akademik') ?>">Akademik</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url('unduhan/kemahasiswaan') ?>">Kemahasiswaan</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url('unduhan/layananpelanggan') ?>">Layanan Pelanggan</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url('unduhan/layananperpustakaan') ?>">Layanan Perpustakaan</a></li>
                                </div>
                                <div class="col-4">
                                    <div class="dropdown-header fw-bold text-default">Standar Layanan</div>
                                    <?php foreach ($nav_layanan as $nav_layanan) { ?>
                                        <li><a class="dropdown-item" href="<?php echo base_url('pages/layanan/' . $nav_layanan->slug_pages) ?>"><?php echo $nav_layanan->judul_pages ?></a></li>
                                    <?php } ?>

                                    <div class="dropdown-header fw-bold text-default">Organisasi & Tatalaksana</div>
                                    <li><a class="dropdown-item" href="<?php echo base_url('unduhan/listasn') ?>">Peraturan ASN</a></li>
                                    <li><a class="dropdown-item" href="<?php echo base_url('unduhan/listpdosen') ?>">Peraturan Dosen</a></li>
                                </div>

                            </div>
                        </div>
                    </ul>
                </li>
                <!-- ============================================ -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="zonaIntegritasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Zona Integritas</a>
                    <ul class="dropdown-menu dropdown-menu-3col p-0" aria-labelledby="zonaIntegritasDropdown">
                        <div class="container">
                            <div class="row">
                                <div class="col-4">
                                    <div class="dropdown-header fw-bold text-default">Pengaduan</div>
                                    <?php foreach ($nav_spi as $nav_spi) { ?>
                                        <a class="dropdown-item" href="<?php echo base_url('pages/spi/' . $nav_spi->slug_pages) ?>"><?php echo $nav_spi->judul_pages ?></a>
                                    <?php } ?>
                                    <li><a class="dropdown-item" href="https://sipadu.poltekkesjakarta3.ac.id/" target="_blank">Lapor Gratifikasi</a></li>
                                    <li><a class="dropdown-item" href="https://sipadu.poltekkesjakarta3.ac.id/" target="_blank">Lapor Pengaduan</a></li>
                                    <li><a class="dropdown-item" href="https://sipadu.poltekkesjakarta3.ac.id/" target="_blank">Conflict Of Interest</a></li>
                                    <li><a class="dropdown-item" href="https://wbs.kemkes.go.id/" target="_blank">Whistle Blowing System</a></li>
                                </div>
                                <div class="col-4">
                                    <div class="dropdown-header fw-bold text-default">Aplikasi</div>
                                    <li><a class="dropdown-item" href="https://forms.gle/ep6bV5EBkHKDbPcs9" target="_blank">SPIP</a></li>
                                    <li><a class="dropdown-item" href="https://rmis.bpkp.go.id/login" target="_blank">RMIS</a></li>
                                    <li><a class="dropdown-item" href="https://docs.google.com/forms/d/e/1FAIpQLSeWjOT-EAdFJz6ZR4EJ-lljcbDDKp4KTl6LeFbORGatLu8Qhg/viewform" target="_blank">Kepuasan Pelanggan</a></li>
                                </div>
                                <div class="col-4">
                                    <div class="dropdown-header fw-bold text-default">Capaian</div>
                                    <li><a class="dropdown-item" href="<?php echo base_url('capaian') ?>">Dashboard Capaian ZI</a></li>
                                </div>
                            </div>
                        </div>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="bluDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">BLU</a>
                    <ul class="dropdown-menu dropdown-menu-3col p-0" aria-labelledby="bluDropdown">
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <div class="dropdown-header fw-bold text-default">Dashboard</div>
                                    <li><a class="dropdown-item" href="<?php echo base_url('maturity') ?>">Maturity Rating BLU</a></li>
                                    <li><a class="dropdown-item" href="#" target="_blank">Bios Feeder BLU</a></li>
                                </div>
                                <div class="col-6">
                                    <div class="dropdown-header fw-bold text-default">Aplikasi</div>
                                    <li><a class="dropdown-item" href="#" target="_blank">#</a></li>
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
                                    <a class="dropdown-item" href="https://srv179.niagahoster.com:2096/" target="_blank">Webmail</a>
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
            <!-- Replace existing language switcher with this -->
            <div class="google-translate-container ms-auto">
            </div>
        </div>
    </div>
</nav>