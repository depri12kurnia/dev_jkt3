<?php $site = $this->konfigurasi_model->listing(); ?>
<div class="box-layout">
    <!-- Header Bootstrap -->
    <header class="header-style-1">
        <!-- Back to Top Button -->
        <div class="back-to-top" id="backToTop" onclick="scrollToTopFallback()" role="button" tabindex="0" aria-label="Kembali ke atas">
            <i class="bi bi-arrow-up"></i>
        </div>
        <div class="floating-widget">
            <input type="checkbox" id="toggle-widget">
            <label for="toggle-widget" class="widget-button">
                <i class="bi bi-wechat"></i>
            </label>

            <div class="widget-menu">
                <a href="https://wa.me/6281113102256" target="_blank" class="widget-item whatsapp">
                    <i class="bi bi-whatsapp"></i> WhatsApp
                </a>
                <a href="tel:+6281112021333" class="widget-item phone">
                    <i class="bi bi-telephone-fill"></i> Telepon
                </a>
                <a href="https://instagram.com/polkesjakarta3" target="_blank" class="widget-item instagram">
                    <i class="bi bi-instagram"></i> Instagram
                </a>
                <a href="https://sippn.menpan.go.id/instansi/184132/kementerian-kesehatan-republik-indonesia/politeknik-kesehatan-kemenkes-jakarta-iii"
                    target="_blank" class="widget-item app">
                    <i class="bi bi-box-arrow-up-right"></i> Cariyanlink
                </a>
                <a href="https://sipadu.poltekkesjakarta3.ac.id" target="_blank" class="widget-item app2">
                    <i class="bi bi-exclamation-triangle"></i> Sipadu
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
                                <a href="https://wa.me/6281113102256" target="_blank"
                                    class="footer-social rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa fa-whatsapp"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://instagram.com/polkesjakarta3" target="_blank"
                                    class="footer-social rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://www.tiktok.com/@poltekkesjakarta3" target="_blank"
                                    class="footer-social rounded-circle d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
                                        <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z" />
                                    </svg>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://web.facebook.com/POLTEKKES.JAKARTA3" target="_blank"
                                    class="footer-social rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://x.com/PoltekkesJkt3" target="_blank"
                                    class="footer-social rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="<?php echo base_url('helpdesk') ?>" target="_blank" class="footer-social rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa fa-question"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="list-inline mt-2 d-flex flex-wrap gap-2 justify-content-end d-none d-lg-flex">
                            <li class="nav-item"><a href="https://sipenmaru.poltekkesjakarta3.ac.id/" target="_blank">SPMB Prestasi</a></li> |
                            <li class="nav-item"><a href="https://spmb-poltekkes.kemkes.go.id/" target="_blank">SPMB Bersama</a></li> |
                            <li class="nav-item"><a href="https://sipenmaru.poltekkesjakarta3.ac.id/" target="_blank">SPMB Mandiri</a></li> |
                            <li class="nav-item"><a href="<?php echo base_url('helpdesk') ?>" target="_blank">Faq&Helpdesk</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->