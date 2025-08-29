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
                                 <h3 class="fw-bold text-primary mb-1" data-target="10" data-suffix="+">0+</h3>
                                 <p class="small text-muted mb-0">Program Studi</p>
                             </div>
                         </div>
                         <div class="col-4">
                             <div class="stat-item text-center">
                                 <h3 class="fw-bold text-primary mb-1" data-target="2500" data-suffix="+">0+</h3>
                                 <p class="small text-muted mb-0">Mahasiswa Aktif</p>
                             </div>
                         </div>
                         <div class="col-4">
                             <div class="stat-item text-center">
                                 <h3 class="fw-bold text-primary mb-1" data-target="96" data-suffix="%">0%</h3>
                                 <p class="small text-muted mb-0">Tingkat Kelulusan</p>
                             </div>
                         </div>
                     </div>
                     <div class="video-actions d-flex gap-3 flex-wrap">
                         <a href="#" class="btn btn-primary btn-lg px-4">
                             <i class="fa fa-graduation-cap me-2"></i>Daftar Sekarang
                         </a>
                         <a href="https://www.youtube.com/@officialpoltekkesjakarta3" class="btn btn-primary btn-lg px-4">
                             <i class="fa fa-play-circle me-2"></i>Lihat Semua Video
                         </a>
                     </div>
                 </div>
             </div>
             <div class="col-lg-6">
                 <div class="video-player-wrapper">
                     <div class="video-thumbnail position-relative">
                         <img src="<?php echo base_url('assets/video/video-thumbnail.jpg'); ?>" alt="Video Kampus PolkesJati" class="img-fluid rounded-4 shadow-lg">
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
                 <h5 class="modal-title fw-bold" id="videoModalLabel">Video Profil PolkesJati</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body p-0">
                 <div class="ratio ratio-16x9">
                     <iframe id="videoFrame" src="" title="Video Profil Kampus" allowfullscreen class="rounded-bottom-4"></iframe>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- End Video Promotion Section -->