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