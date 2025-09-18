<div class="modal fade animated-popup popup-modal-wrapper" id="iklanModal" tabindex="-1" aria-label="iklanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content text-center">
            <div class="modal-header gradient-header">
                <button type="button" class="btn-close btn-close-white animated-close" data-bs-dismiss="modal" aria-label="Tutup"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body p-0">
                <?php if (isset($popup) && !empty($popup)): ?>
                    <?php foreach ($popup as $index => $item) : ?>
                        <div class="popup-image-container" data-popup-index="<?php echo $index; ?>">
                            <!-- PERBAIKAN: Simplified Image Loading -->
                            <?php if ($index === 0): ?>
                                <!-- First image: Load immediately -->
                                <img src="<?php echo base_url('assets/upload/image/' . $item->gambar); ?>"
                                    width="100%"
                                    height="auto"
                                    class="img-fluid popup-image popup-primary"
                                    loading="eager"
                                    fetchpriority="high"
                                    alt="Pengumuman <?php echo htmlspecialchars($item->nama_popup ?? 'Poltekkes Jakarta III'); ?>"
                                    style="object-fit: cover; max-height: 400px;">
                            <?php else: ?>
                                <!-- Secondary images: Lazy load -->
                                <img data-src="<?php echo base_url('assets/upload/image/' . $item->gambar); ?>"
                                    src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='600' height='400'%3E%3Crect width='100%25' height='100%25' fill='%23f8f9fa'/%3E%3Ctext x='50%25' y='50%25' text-anchor='middle' dy='.3em' fill='%236c757d' font-family='Arial,sans-serif' font-size='16'%3EMemuat pengumuman...%3C/text%3E%3C/svg%3E"
                                    width="100%"
                                    height="auto"
                                    class="img-fluid popup-image popup-lazy"
                                    loading="lazy"
                                    alt="Pengumuman <?php echo htmlspecialchars($item->nama_popup ?? 'Poltekkes Jakarta III'); ?>"
                                    style="object-fit: cover; max-height: 400px;">

                                <!-- Loading overlay for secondary images -->
                                <div class="popup-loading-overlay">
                                    <div class="popup-loading-content">
                                        <div class="popup-loading-spinner"></div>
                                        <span class="popup-loading-text">Memuat pengumuman...</span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Modal Footer with Buttons -->
                        <div class="modal-footer p-2">
                            <div class="d-flex flex-wrap justify-content-center gap-1 w-100">
                                <a class="btn btn-success btn-sm popup-btn" target="_blank" href="https://sipadu.poltekkesjakarta3.ac.id">
                                    <span class="d-none d-md-inline">SIPADU</span>
                                    <span class="d-inline d-md-none">Pengaduan</span>
                                </a>
                                <a class="btn btn-primary btn-sm popup-btn" target="_blank" href="https://drive.google.com/file/d/1x7Nl5nK7dfESTDMwUELCk2ZH9jIIntvR/view?usp=sharing">
                                    <span class="d-none d-md-inline">Biaya UKT</span>
                                    <span class="d-inline d-md-none">UKT</span>
                                </a>
                                <a class="btn btn-warning btn-sm popup-btn" target="_blank" href="https://jakarta3.pusilkom.com/">
                                    <span class="d-none d-md-inline">Siakad EUIS</span>
                                    <span class="d-inline d-md-none">EUIS</span>
                                </a>
                                <a class="btn btn-info btn-sm popup-btn" target="_blank" href="https://alumnijkt3.pusilkom.com/">
                                    <span class="d-none d-md-inline">Portal Alumni</span>
                                    <span class="d-inline d-md-none">Alumni</span>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>