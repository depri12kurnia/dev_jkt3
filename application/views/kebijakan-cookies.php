<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Cookies - <?= isset($site_title) ? $site_title : 'Website' ?></title>
    <meta name="description" content="Kebijakan penggunaan cookies pada website kami">

    <!-- Bootstrap CSS atau CSS framework lainnya -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .cookies-policy {
            padding: 40px 0;
        }

        .policy-section {
            margin-bottom: 30px;
        }

        .policy-section h3 {
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .cookie-table {
            margin-top: 20px;
        }

        .last-updated {
            font-style: italic;
            color: #6c757d;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="container cookies-policy">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h1 class="text-center mb-4">Kebijakan Cookies</h1>

                <p class="last-updated text-center">
                    Terakhir diperbarui: <?= date('d F Y') ?>
                </p>

                <div class="policy-section">
                    <h3>Apa itu Cookies?</h3>
                    <p>
                        Cookies adalah file kecil yang disimpan di perangkat Anda (komputer, tablet, atau ponsel)
                        ketika Anda mengunjungi website. Cookies membantu website mengingat informasi tentang
                        kunjungan Anda, seperti preferensi bahasa dan pengaturan lainnya.
                    </p>
                </div>

                <div class="policy-section">
                    <h3>Bagaimana Kami Menggunakan Cookies</h3>
                    <p>Website kami menggunakan cookies untuk:</p>
                    <ul>
                        <li>Menjaga Anda tetap login selama sesi browsing</li>
                        <li>Mengingat preferensi dan pengaturan Anda</li>
                        <li>Menganalisis bagaimana website kami digunakan</li>
                        <li>Memberikan pengalaman yang dipersonalisasi</li>
                        <li>Meningkatkan keamanan website</li>
                    </ul>
                </div>

                <div class="policy-section">
                    <h3>Jenis Cookies yang Kami Gunakan</h3>

                    <div class="table-responsive cookie-table">
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Jenis Cookie</th>
                                    <th>Tujuan</th>
                                    <th>Durasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Cookies Penting</strong></td>
                                    <td>Diperlukan untuk fungsi dasar website, seperti keamanan dan navigasi</td>
                                    <td>Sesi atau hingga 1 tahun</td>
                                </tr>
                                <tr>
                                    <td><strong>Cookies Fungsional</strong></td>
                                    <td>Mengingat pilihan Anda dan memberikan fitur yang ditingkatkan</td>
                                    <td>Hingga 1 tahun</td>
                                </tr>
                                <tr>
                                    <td><strong>Cookies Analitik</strong></td>
                                    <td>Membantu kami memahami bagaimana pengunjung berinteraksi dengan website</td>
                                    <td>Hingga 2 tahun</td>
                                </tr>
                                <tr>
                                    <td><strong>Cookies Marketing</strong></td>
                                    <td>Digunakan untuk menampilkan iklan yang relevan</td>
                                    <td>Hingga 1 tahun</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="policy-section">
                    <h3>Cookies Pihak Ketiga</h3>
                    <p>
                        Website kami mungkin menggunakan cookies dari pihak ketiga, seperti:
                    </p>
                    <ul>
                        <li><strong>Google Analytics:</strong> Untuk analisis lalu lintas website</li>
                        <li><strong>Google Ads:</strong> Untuk iklan yang ditargetkan</li>
                        <li><strong>Social Media:</strong> Untuk integrasi media sosial</li>
                    </ul>
                </div>

                <div class="policy-section">
                    <h3>Mengelola Cookies</h3>
                    <p>
                        Anda dapat mengontrol dan mengelola cookies melalui pengaturan browser Anda.
                        Sebagian besar browser memungkinkan Anda untuk:
                    </p>
                    <ul>
                        <li>Melihat cookies apa yang tersimpan di perangkat Anda</li>
                        <li>Menghapus cookies</li>
                        <li>Memblokir cookies dari website tertentu</li>
                        <li>Memblokir cookies pihak ketiga</li>
                        <li>Menghapus semua cookies saat menutup browser</li>
                    </ul>

                    <div class="alert alert-warning mt-3">
                        <strong>Perhatian:</strong> Menonaktifkan cookies mungkin akan mempengaruhi
                        fungsionalitas website dan mengurangi pengalaman browsing Anda.
                    </div>
                </div>

                <div class="policy-section">
                    <h3>Cara Menghapus Cookies</h3>
                    <p><strong>Google Chrome:</strong></p>
                    <ol>
                        <li>Klik menu Chrome (tiga titik) → Settings</li>
                        <li>Pilih "Privacy and security" → "Clear browsing data"</li>
                        <li>Pilih "Cookies and other site data" → "Clear data"</li>
                    </ol>

                    <p><strong>Mozilla Firefox:</strong></p>
                    <ol>
                        <li>Klik menu Firefox → Options</li>
                        <li>Pilih "Privacy & Security"</li>
                        <li>Di bagian "Cookies and Site Data", klik "Clear Data"</li>
                    </ol>

                    <p><strong>Safari:</strong></p>
                    <ol>
                        <li>Pilih Safari → Preferences</li>
                        <li>Klik tab "Privacy"</li>
                        <li>Klik "Manage Website Data" → "Remove All"</li>
                    </ol>
                </div>

                <div class="policy-section">
                    <h3>Perubahan Kebijakan</h3>
                    <p>
                        Kami dapat memperbarui Kebijakan Cookies ini dari waktu ke waktu.
                        Perubahan akan berlaku segera setelah dipublikasikan di halaman ini.
                        Kami menyarankan Anda untuk meninjau halaman ini secara berkala.
                    </p>
                </div>

                <div class="policy-section">
                    <h3>Hubungi Kami</h3>
                    <p>
                        Jika Anda memiliki pertanyaan tentang penggunaan cookies kami,
                        silakan hubungi kami melalui:
                    </p>
                    <ul>
                        <li>Email: <?php echo $site->email ?></li>
                        <li>Telepon: <?php echo $site->telepon ?></li>
                        <li>Alamat: <?php echo nl2br($site->alamat) ?></li>
                    </ul>
                </div>

                <div class="text-center mt-5">
                    <a href="<?= base_url() ?>" class="btn btn-success">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>