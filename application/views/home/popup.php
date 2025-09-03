<div class="modal fade animated-popup popup-modal-wrapper" id="iklanModal" tabindex="-1" aria-labelledby="iklanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content text-center">
            <div class="modal-header gradient-header">
                <button type="button" class="btn-close btn-close-white animated-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-0">
                <?php if (isset($popup) && !empty($popup)): ?>
                    <?php foreach ($popup as $item) : ?>
                        <div class="popup-image-container">
                            <img src="<?php echo base_url('assets/upload/image/' . $item->gambar); ?>"
                                width="100%"
                                class="img-fluid popup-image animated-image"
                                alt="Pengumuman <?php echo $item->nama_popup ?? ''; ?>">
                            <div class="image-overlay">
                                <div class="sparkle sparkle-1"></div>
                                <div class="sparkle sparkle-2"></div>
                                <div class="sparkle sparkle-3"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="d-flex flex-wrap justify-content-center gap-2 w-100">
                                <a class="btn btn-success btn-sm" target="_blank" href="https://sipadu.poltekkesjakarta3.ac.id">
                                    SIPADU (Layanan Pengaduan Terpadu)
                                </a>
                                <a class="btn btn-primary btn-sm" target="_blank" href="https://drive.google.com/file/d/1x7Nl5nK7dfESTDMwUELCk2ZH9jIIntvR/view?usp=sharing">
                                    Daftar Biaya UKT
                                </a>
                                <a class="btn btn-warning btn-sm" target="_blank" href="https://jakarta3.pusilkom.com/">
                                    Siakad EUIS
                                </a>
                                <a class="btn btn-warning btn-sm" target="_blank" href="https://alumnijkt3.pusilkom.com/">
                                    Portal Alumni
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>