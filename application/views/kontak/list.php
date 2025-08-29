<section class="bg-page-header">
    <div class="page-header-overlay">
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <div class="page-title">
                        <h3>Kontak Kami</h3>
                    </div>
                    <!-- .page-title -->
                    <div class="page-header-content">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
                            <li>Kontak Kami</li>
                        </ol>
                    </div>
                    <!-- .page-header-content -->
                </div>
                <!-- .page-header -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </div>
    <!-- .page-header-overlay -->
</section>
<!-- Start Contact us Section -->
<section class="bg-contact-us page-title">
    <div class="container">
        <div class="row">
            <div class="contact-us">
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                        <!-- <h3 class="contact-title">HUBUNGI KAMI</h3> -->
                            <a target="_blank" href="https://wa.me/<?php echo str_replace('+', '', $site->whatsapp) ?>" class="btn btn-default"><i class="fa fa-whatsapp" aria-hidden="true"></i> Hotline WA Only </br> <?php echo $site->whatsapp; ?></a>
                            </br>
                            </br>
                            <a target="_blank" href="tel:<?php echo $site->hp ?>" class="btn btn-default"><i class="fa fa-mobile" aria-hidden="true"></i> Hotline Call Only </br> <?php echo $site->hp ?></a>
                            </br>
                            </br>
                            </br>
                            <li>
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span><?php echo nl2br($site->alamat) ?></span>
                            </li>
                            
                            <ul class="contact-address">
                                <li>
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <span>Telp : <?php echo $site->telepon ?></span>
                                </li>
                                <li>
                                    <i class="fa fa-fax" aria-hidden="true"></i>
                                    <span>Fax : <?php echo $site->fax ?></span>
                                </li>
                                <li>
                                    <i class="fa fa-mobile" aria-hidden="true"></i>
                                    <span>Hotline Telp: <a href="tel:<?php echo $site->hp ?>" target="_blank"><?php echo $site->hp ?></a></span>
                                </li>
                                <li>
                                    <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                    <span>Hotline WA : <a href="https://wa.me/<?php echo str_replace('+', '', $site->whatsapp) ?>?text=Saya%20tertarik%20untuk%20Menggunakan%20Layanan%20di%20PoltekkesJati%20.%20Apakah%20bisa%20dibantu?" target="_blank"><?php echo $site->whatsapp ?></a></a></span>
                                </li>
                                <li>
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                    <span>Email : <?php echo $site->email ?> </span>
                                </li>
                                
                            </ul>
                        <ul class="social-icon-rounded">
                            <li><a target="_blank" href="<?php echo $site->whatsapp; ?>"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                            <li><a target="_blank" href="<?php echo $site->facebook; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a target="_blank" href="<?php echo $site->twitter; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a target="_blank" href="<?php echo $site->instagram; ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a target="_blank" href="<?php echo $site->youtube; ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                            <li><a target="_blank" href="http://telegram.me/PolkesJatiBot" target="_blank"><i class="fa fa-telegram" aria-hidden="true"></i></a></li>
                            <li><a target="_blank" href="<?php echo base_url('helpdesk') ?>"><i class="fa fa-question" aria-hidden="true"></i></a></li>
                        </ul>

                        
                    </div>
                    <div class="col-md-4">
                    </div>
                    <?php echo $site->google_map; ?>
                </div>
                <!-- .row -->
            </div>
            <!-- .contact-us -->
        </div>
        <!-- .row -->
    </div>
    <!-- .container -->
</section>
<!-- End Contact us Section -->


<!-- STart Maps Section -->
<style type="text/css" media="screen">
    iframe {
        width: 100%;
        height: auto;
        min-height: 400px;
    }
</style>
<!-- <div id="map"><?php echo $site->google_map; ?></div> -->
<!-- End Maps Section -->