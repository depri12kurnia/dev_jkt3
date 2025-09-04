<!-- Footer Bootstrap -->
<!-- ============ -->
<footer class="mt-5 footer-custom">
    <div class="container py-4">
        <div class="row g-4">
            <div class="col-md-4 col-sm-12">
                <h4 class="mb-3 fw-bold text-primary-dark">Lokasi</h4>
                <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.6530826872395!2d106.92392351056975!3d-6.3092254936536545!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6992ba4f085f8d%3A0x4b820032d3ad33ae!2sPoltekkes%20Kemenkes%20Jakarta%20III!5e0!3m2!1sen!2sid!4v1753666860477!5m2!1sen!2sid" width="300" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
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

<!-- cookies settings -->
<?php
$cookie_consent = isset($_COOKIE['cookie_consent']) ? $_COOKIE['cookie_consent'] : '';
$hide_cookie_banner = !empty($cookie_consent) ? 'display:none;' : '';
?>
<div id="cookie-banner" style="
    position: fixed; bottom: 0; left: 0; right: 0;
    background: #2c3e50; color: white; padding: 15px;
    display: flex; justify-content: space-between; align-items: center;
    z-index: 9999; font-size: 14px; <?php echo $hide_cookie_banner; ?>">

    <span>
        Kami menghargai privasi Anda. Situs web ini menyimpan cookies di komputer Anda
        untuk meningkatkan pengalaman, analitik, dan metrik.
        Lihat <a href="/kebijakan-cookie" style="color: #f1c40f;">Kebijakan Cookie</a>.
    </span>

    <div>
        <button onclick="acceptAllCookies()" style="background: #27ae60; color: white; border: none; padding: 8px 12px; border-radius: 5px; margin-left: 10px;">
            Terima Semua Cookie
        </button>
        <button onclick="openCookieModal()" style="background: #c0392b; color: white; border: none; padding: 8px 12px; border-radius: 5px; margin-left: 10px;">
            Kelola Cookie
        </button>
    </div>
</div>
<div id="cookie-modal" style="
    display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(0,0,0,0.6); z-index: 10000; justify-content: center; align-items: center; <?php echo $hide_cookie_banner; ?>">

    <div style="background: white; padding: 20px; border-radius: 10px; width: 400px; color: black;">
        <h3>Pengaturan Cookie</h3>
        <p>Pilih jenis cookie yang ingin Anda izinkan:</p>

        <label>
            <input type="checkbox" checked disabled> Essential (Wajib)
        </label><br>
        <label>
            <input type="checkbox" id="cookie-analytics"> Analytics
        </label><br>
        <br>

        <button onclick="saveCookiePreferences()" style="background:#27ae60; color:white; padding:8px 12px; border:none; border-radius:5px;">
            Simpan Pilihan
        </button>
        <button onclick="closeCookieModal()" style="background:#c0392b; color:white; padding:8px 12px; border:none; border-radius:5px;">
            Batal
        </button>
    </div>
</div>

<!-- Accept Cookies -->
<script>
    function getCookie(name) {
        let value = "; " + document.cookie;
        let parts = value.split("; " + name + "=");
        if (parts.length === 2) return parts.pop().split(";").shift();
        return null;
    }

    function acceptAllCookies() {
        let prefs = {
            essential: true,
            analytics: true
        };
        document.cookie = "cookie_consent=" + encodeURIComponent(JSON.stringify(prefs)) + "; path=/; max-age=" + (60 * 60 * 24 * 365);
        document.getElementById("cookie-banner").style.display = "none";
        document.getElementById("cookie-modal").style.display = "none";
    }

    function openCookieModal() {
        document.getElementById("cookie-modal").style.display = "flex";
    }

    function closeCookieModal() {
        document.getElementById("cookie-modal").style.display = "none";
    }

    function saveCookiePreferences() {
        let prefs = {
            essential: true,
            analytics: document.getElementById("cookie-analytics").checked
        };
        document.cookie = "cookie_consent=" + encodeURIComponent(JSON.stringify(prefs)) + "; path=/; max-age=" + (60 * 60 * 24 * 365);
        document.getElementById("cookie-modal").style.display = "none";
        document.getElementById("cookie-banner").style.display = "none";
    }

    window.onload = function() {
        if (getCookie("cookie_consent")) {
            document.getElementById("cookie-banner").style.display = "none";
            document.getElementById("cookie-modal").style.display = "none";
        }
    };
</script>

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
<!-- Swiper JS untuk carousel -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<!-- Custom JS From jsDeliver Load BEFORE open-accessibility -->
<!-- <script src="https://cdn.jsdelivr.net/gh/depri12kurnia/dev_jkt3@c98ecc060c3d5a377efcafa07a64e43faf20970f/assets/js/slider-enhanced.js"></script>
<script src="https://cdn.jsdelivr.net/gh/depri12kurnia/dev_jkt3@c98ecc060c3d5a377efcafa07a64e43faf20970f/assets/js/pendidikan-enhanced.js"></script>
<script src="https://cdn.jsdelivr.net/gh/depri12kurnia/dev_jkt3@c98ecc060c3d5a377efcafa07a64e43faf20970f/assets/js/staff-enhanced.js"></script>
<script src="https://cdn.jsdelivr.net/gh/depri12kurnia/dev_jkt3@c98ecc060c3d5a377efcafa07a64e43faf20970f/assets/js/partners-enhanced.js"></script>
<script src="https://cdn.jsdelivr.net/gh/depri12kurnia/dev_jkt3@c98ecc060c3d5a377efcafa07a64e43faf20970f/assets/js/video-enhanced.js?v=<?php echo time(); ?>"></script>
<script src="https://cdn.jsdelivr.net/gh/depri12kurnia/dev_jkt3@c98ecc060c3d5a377efcafa07a64e43faf20970f/assets/js/backtotop-enhanced.js"></script>
<script src="https://cdn.jsdelivr.net/gh/depri12kurnia/dev_jkt3@c98ecc060c3d5a377efcafa07a64e43faf20970f/assets/js/faq-enhanced.js"></script>
<script src="https://cdn.jsdelivr.net/gh/depri12kurnia/dev_jkt3@c98ecc060c3d5a377efcafa07a64e43faf20970f/assets/js/popup-enhanced.js"></script> -->


<!-- Custom JS - Load BEFORE open-accessibility -->
<script src="<?php echo base_url(); ?>assets/js/slider-enhanced.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pendidikan-enhanced.js"></script>
<script src="<?php echo base_url(); ?>assets/js/staff-enhanced.js"></script>
<script src="<?php echo base_url(); ?>assets/js/partners-enhanced.js"></script>
<script src="<?php echo base_url(); ?>assets/js/video-enhanced.js?v=<?php echo time(); ?>"></script>
<script src="<?php echo base_url(); ?>assets/js/backtotop-enhanced.js"></script>
<script src="<?php echo base_url(); ?>assets/js/faq-enhanced.js"></script>
<script src="<?php echo base_url(); ?>assets/js/popup-enhanced.js"></script>

<!-- Open-Accessibility - Load AFTER jQuery and Bootstrap -->
<script src="https://cdn.jsdelivr.net/gh/depri12kurnia/dev_jkt3@c98ecc060c3d5a377efcafa07a64e43faf20970f/assets/js/open-accessibility.js?v=<?php echo time(); ?>"></script>

<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-77QD9RNNKJ"></script> -->
<!-- <script src="<?php echo base_url(); ?>assets/js/ga4.js"></script> -->

<script>
    const base_url = '<?php echo base_url(); ?>';
</script>
<script src="https://cdn.jsdelivr.net/gh/depri12kurnia/dev_jkt3@c98ecc060c3d5a377efcafa07a64e43faf20970f/assets/js/google-translate-custom.js"></script>

<!-- DataTables initialization -->
<script>
    $(function() {
        $("#dokumen").DataTable();
        $("#example1").DataTable();
        $("#example2").DataTable();
        $("#example3").DataTable();
        $("#example4").DataTable();
        $("#example5").DataTable();
        $("#example6").DataTable();
        $("#example7").DataTable();
        $("#example8").DataTable();
        $("#example9").DataTable();
    });
</script>


</body>

</html>