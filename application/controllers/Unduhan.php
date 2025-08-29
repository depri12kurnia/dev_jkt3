<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unduhan extends CI_Controller
{
    // Load database
    public function __construct()
    {
        parent::__construct();
        $this->load->model('download_model');
        $this->load->model('kategori_download_model');
        $this->load->model('jenis_download_model');
        $this->load->model('konfigurasi_model');
        $this->load->model('nav_model');

        // HAPUS BARIS INI - Security sudah built-in
        // $this->load->library('security');
        // $this->load->helper('security');

        // Load helpers yang diperlukan
        $this->load->helper('url');
        $this->load->helper('download');
    }

    // Main page
    public function index()
    {
        $site = $this->konfigurasi_model->listing();
        $download = $this->download_model->download();

        $data = array(
            'title' => 'Download - ' . $site->namaweb,
            'deskripsi' => 'Download - ' . $site->namaweb,
            'keywords' => 'Download - ' . $site->namaweb,
            'download' => $download,
            'site' => $site,
            'isi' => 'download/informasi'
        );
        $this->load->view('layout/wrapper', $data, false);
    }

    public function informasi_publik()
    {
        $site = $this->konfigurasi_model->listing();
        $download = $this->download_model->download();

        $data = array(
            'title' => 'Download - ' . $site->namaweb,
            'deskripsi' => 'Download - ' . $site->namaweb,
            'keywords' => 'Download - ' . $site->namaweb,
            'download' => $download,
            'site' => $site,
            'isi' => 'download/informasi_publik'
        );
        $this->load->view('layout/wrapper', $data, false);
    }

    public function layanan_publik()
    {
        $site = $this->konfigurasi_model->listing();
        $download = $this->download_model->download();

        $data = array(
            'title' => 'Download - ' . $site->namaweb,
            'deskripsi' => 'Download - ' . $site->namaweb,
            'keywords' => 'Download - ' . $site->namaweb,
            'download' => $download,
            'site' => $site,
            'isi' => 'download/layanan_publik'
        );
        $this->load->view('layout/wrapper', $data, false);
    }

    public function organisasi()
    {
        $site = $this->konfigurasi_model->listing();
        $download = $this->download_model->download();

        $data = array(
            'title' => 'Download - ' . $site->namaweb,
            'deskripsi' => 'Download - ' . $site->namaweb,
            'keywords' => 'Download - ' . $site->namaweb,
            'download' => $download,
            'site' => $site,
            'isi' => 'download/organisasi'
        );
        $this->load->view('layout/wrapper', $data, false);
    }

    // Kategori
    public function kategori($slug_kategori_download)
    {
        // Sanitasi dan validasi input - Security sudah built-in
        $slug_kategori_download = $this->security->xss_clean($slug_kategori_download);

        // Validasi format slug
        if (!preg_match('/^[a-zA-Z0-9\-_]+$/', $slug_kategori_download)) {
            show_404();
            return;
        }

        $site = $this->konfigurasi_model->listing();
        $kategori_download = $this->kategori_download_model->read($slug_kategori_download);

        if (!$kategori_download) {
            show_404();
            return;
        }

        $id_kategori_download = (int)$kategori_download->id_kategori_download;
        $download = $this->download_model->kategori($id_kategori_download);

        $data = array(
            'title' => 'Kategori download: ' . htmlspecialchars($kategori_download->nama_kategori_download, ENT_QUOTES, 'UTF-8'),
            'deskripsi' => 'Kategori download: ' . htmlspecialchars($kategori_download->nama_kategori_download, ENT_QUOTES, 'UTF-8'),
            'keywords' => 'Kategori download: ' . htmlspecialchars($kategori_download->nama_kategori_download, ENT_QUOTES, 'UTF-8'),
            'download' => $download,
            'site' => $site,
            'kategori_download' => $kategori_download,
            'isi' => 'download/list'
        );
        $this->load->view('layout/wrapper', $data, false);
    }

    // jenis
    public function jenis($slug_jenis_download)
    {
        // Sanitasi dan validasi input
        $slug_jenis_download = $this->security->xss_clean($slug_jenis_download);

        // Validasi format slug
        if (!preg_match('/^[a-zA-Z0-9\-_]+$/', $slug_jenis_download)) {
            show_404();
            return;
        }

        $site = $this->konfigurasi_model->listing();
        $jenis_download = $this->jenis_download_model->read($slug_jenis_download);

        if (!$jenis_download) {
            show_404();
            return;
        }

        $id_jenis_download = (int)$jenis_download->id_jenis_download;
        $download = $this->download_model->jenis($id_jenis_download);

        $data = array(
            'title' => 'Jenis download: ' . htmlspecialchars($jenis_download->nama_jenis_download, ENT_QUOTES, 'UTF-8'),
            'deskripsi' => 'Jenis download: ' . htmlspecialchars($jenis_download->nama_jenis_download, ENT_QUOTES, 'UTF-8'),
            'keywords' => 'Jenis download: ' . htmlspecialchars($jenis_download->nama_jenis_download, ENT_QUOTES, 'UTF-8'),
            'download' => $download,
            'site' => $site,
            'jenis_download' => $jenis_download,
            'isi' => 'download/list'
        );
        $this->load->view('layout/wrapper', $data, false);
    }

    // Read download detail - Dengan validasi keamanan
    public function read($slug_download)
    {
        // Sanitasi input
        $slug_download = $this->security->xss_clean($slug_download);

        // Validasi format slug
        if (!preg_match('/^[a-zA-Z0-9\-_]+$/', $slug_download)) {
            show_404();
            return;
        }

        $site = $this->konfigurasi_model->listing();
        $download = $this->download_model->read($slug_download);

        if (!$download || count(array($download)) < 1) {
            show_404();
            return;
        }

        $listing = $this->download_model->listing_read();
        $kategori = $this->nav_model->nav_download();

        $data = array(
            'title' => htmlspecialchars($download->judul_download, ENT_QUOTES, 'UTF-8'),
            'deskripsi' => htmlspecialchars($download->judul_download, ENT_QUOTES, 'UTF-8'),
            'keywords' => htmlspecialchars($download->judul_download, ENT_QUOTES, 'UTF-8'),
            'download' => $download,
            'listing' => $listing,
            'kategori' => $kategori,
            'site' => $site,
            'isi' => 'download/read'
        );
        $this->load->view('layout/wrapper', $data, false);
    }

    // Unduh - PERBAIKAN KEAMANAN
    public function unduh($id_download)
    {
        // Validasi keamanan input
        if (!is_numeric($id_download) || $id_download <= 0) {
            log_message('error', 'Invalid download ID attempt: ' . $id_download . ' from IP: ' . $this->input->ip_address());
            show_404();
            return;
        }

        // Ambil detail download dengan validasi
        $download = $this->download_model->detail((int)$id_download);

        if (!$download) {
            log_message('error', 'Download not found: ' . $id_download . ' from IP: ' . $this->input->ip_address());
            show_404();
            return;
        }

        // Validasi keberadaan file
        $filename = basename($download->gambar); // Ambil nama file saja, hapus path
        $file_path = './assets/upload/file/' . $filename;

        // Resolusi path absolut untuk mencegah path traversal
        $real_path = realpath($file_path);
        $upload_dir = realpath('./assets/upload/file/');

        // Validasi bahwa file berada dalam direktori yang diizinkan
        if (!$real_path || !$upload_dir || strpos($real_path, $upload_dir) !== 0) {
            log_message('error', 'Path traversal attempt detected: ' . $download->gambar . ' from IP: ' . $this->input->ip_address());
            show_404();
            return;
        }

        // Validasi eksistensi file yang diizinkan
        $allowed_extensions = array('pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'zip', 'rar');
        $file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!in_array($file_extension, $allowed_extensions)) {
            log_message('error', 'Unauthorized file type download attempt: ' . $filename . ' from IP: ' . $this->input->ip_address());
            show_404();
            return;
        }

        // Validasi keberadaan file fisik
        if (!file_exists($real_path)) {
            log_message('error', 'File not found: ' . $real_path . ' from IP: ' . $this->input->ip_address());
            show_404();
            return;
        }

        // Validasi ukuran file (maksimal 50MB)
        $max_file_size = 50 * 1024 * 1024; // 50MB
        if (filesize($real_path) > $max_file_size) {
            log_message('error', 'File too large: ' . $real_path . ' from IP: ' . $this->input->ip_address());
            show_error('File terlalu besar untuk diunduh', 413);
            return;
        }

        // Rate limiting - maksimal 5 download per menit per IP
        $ip_address = $this->input->ip_address();
        $cache_key = 'download_rate_' . md5($ip_address);

        $this->load->driver('cache');
        $download_count = $this->cache->get($cache_key) ?: 0;

        if ($download_count >= 5) {
            log_message('error', 'Download rate limit exceeded from IP: ' . $ip_address);
            show_error('Terlalu banyak percobaan download. Coba lagi dalam beberapa menit.', 429);
            return;
        }

        // Update counter rate limiting
        $this->cache->save($cache_key, $download_count + 1, 60); // 60 detik

        // Log download activity
        $log_data = array(
            'ip_address' => $ip_address,
            'user_agent' => $this->input->user_agent(),
            'download_id' => $id_download,
            'filename' => $filename,
            'timestamp' => date('Y-m-d H:i:s')
        );

        // Log ke file
        log_message('info', 'File downloaded: ' . json_encode($log_data));

        // Update download counter (pastikan method ini ada di model)
        if (method_exists($this->download_model, 'increment_download_count')) {
            $this->download_model->increment_download_count($id_download);
        }

        // Set header keamanan
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: DENY');

        force_download($real_path, null);
    }

    public function akuntabilitas()
    {
        $site = $this->konfigurasi_model->listing();
        $download = $this->download_model->download();

        // Cek apakah method-method ini ada di model
        $dipa = method_exists($this->download_model, 'listingDipa') ?
            $this->download_model->listingDipa() : array();
        $lapkeu = method_exists($this->download_model, 'listingLaporanKeuangan') ?
            $this->download_model->listingLaporanKeuangan() : array();
        $perencanaan = method_exists($this->download_model, 'listingPerencanaan') ?
            $this->download_model->listingPerencanaan() : array();
        $lakip = method_exists($this->download_model, 'listingLakip') ?
            $this->download_model->listingLakip() : array();
        $perjanjiankinerja = method_exists($this->download_model, 'listingPerjanjianKinerja') ?
            $this->download_model->listingPerjanjianKinerja() : array();
        $peraturan = method_exists($this->download_model, 'listingPeraturan') ?
            $this->download_model->listingPeraturan() : array();
        $lainnya = method_exists($this->download_model, 'listingLainnya') ?
            $this->download_model->listingLainnya() : array();

        $data = array(
            'title' => 'Akuntabilitas - ' . $site->namaweb,
            'deskripsi' => 'Akuntabilitas - ' . $site->namaweb,
            'keywords' => 'Akuntabilitas - ' . $site->namaweb,
            'download' => $download,
            'dipa' => $dipa,
            'lapkeu' => $lapkeu,
            'perencanaan' => $perencanaan,
            'lakip' => $lakip,
            'perjanjiankinerja' => $perjanjiankinerja,
            'peraturan' => $peraturan,
            'lainnya' => $lainnya,
            'site' => $site,
            'isi' => 'download/list_akuntabilitas'
        );
        $this->load->view('layout/wrapper', $data, false);
    }

    public function standardpelayanan()
    {
        $site = $this->konfigurasi_model->listing();
        $download = $this->download_model->download();
        $intruksikerja = $this->download_model->listingIntruksiKerja();
        $prosedur = $this->download_model->listingProsedur();
        $standard = $this->download_model->listingStandard();
        // End paginasi

        $data = array(
            'title' => 'Standard Pelayanan - ' . $site->namaweb,
            'deskripsi' => 'Standard Pelayanan - ' . $site->namaweb,
            'keywords' => 'Standard Pelayanan - ' . $site->namaweb,
            'download' => $download,
            'intruksikerja' => $intruksikerja,
            'prosedur' => $prosedur,
            'standard' => $standard,
            'site' => $site,
            'isi' => 'download/list_standardpelayanan'
        );
        $this->load->view('layout/wrapper', $data, false);
    }

    public function prestasi()
    {
        $site = $this->konfigurasi_model->listing();
        $download = $this->download_model->download();
        $mahasiswa = $this->download_model->listingMahasiswa();
        $dosen = $this->download_model->listingDosen();
        $tendik = $this->download_model->listingTendik();
        $institusi = $this->download_model->listingPenghargaanInstitusi();
        // End paginasi

        $data = array(
            'title' => 'Prestasi - ' . $site->namaweb,
            'deskripsi' => 'Prestasi - ' . $site->namaweb,
            'keywords' => 'Prestasi - ' . $site->namaweb,
            'download' => $download,
            'mahasiswa' => $mahasiswa,
            'dosen' => $dosen,
            'tendik' => $tendik,
            'institusi' => $institusi,
            'site' => $site,
            'isi' => 'download/list_prestasi'
        );
        $this->load->view('layout/wrapper', $data, false);
    }
    // Listing Akademik
    public function akademik()
    {
        $site = $this->konfigurasi_model->listing();
        $download = $this->download_model->download();
        $download = $this->download_model->listingAkademik();
        // End paginasi

        $data = array(
            'title' => 'Akademik - ' . $site->namaweb,
            'deskripsi' => 'Akademik - ' . $site->namaweb,
            'keywords' => 'Akademik - ' . $site->namaweb,
            'dokumen' => $download,
            'site' => $site,
            'isi' => 'download/list_akademik'
        );
        $this->load->view('layout/wrapper', $data, false);
    }

    // Listing Kemahasiswaan
    public function kemahasiswaan()
    {
        $site = $this->konfigurasi_model->listing();
        $download = $this->download_model->download();
        $download = $this->download_model->listingKemahasiswaan();
        // End paginasi

        $data = array(
            'title' => 'Kemahasiswaan - ' . $site->namaweb,
            'deskripsi' => 'Kemahasiswaan - ' . $site->namaweb,
            'keywords' => 'Kemahasiswaan - ' . $site->namaweb,
            'dokumen' => $download,
            'site' => $site,
            'isi' => 'download/list_kemahasiswaan'
        );
        $this->load->view('layout/wrapper', $data, false);
    }

    // Listing Layanan Pelanggan
    public function layananpelanggan()
    {
        $site = $this->konfigurasi_model->listing();
        $download = $this->download_model->download();
        $download = $this->download_model->listingLayananPelanggan();
        // End paginasi

        $data = array(
            'title' => 'Layanan Pelanggan - ' . $site->namaweb,
            'deskripsi' => 'Layanan Pelanggan - ' . $site->namaweb,
            'keywords' => 'Layanan Pelanggan - ' . $site->namaweb,
            'dokumen' => $download,
            'site' => $site,
            'isi' => 'download/list_layananpelanggan'
        );
        $this->load->view('layout/wrapper', $data, false);
    }

    // Listing Layanan Perpustakaan
    public function layananperpustakaan()
    {
        $site = $this->konfigurasi_model->listing();
        $download = $this->download_model->download();
        $download = $this->download_model->listingPerpustakaan();
        // End paginasi

        $data = array(
            'title' => 'Layanan Perpustakaan - ' . $site->namaweb,
            'deskripsi' => 'Layanan Perpustakaan - ' . $site->namaweb,
            'keywords' => 'Layanan Perpustakaan - ' . $site->namaweb,
            'dokumen' => $download,
            'site' => $site,
            'isi' => 'download/list_perpustakaan'
        );
        $this->load->view('layout/wrapper', $data, false);
    }

    // Listing Layanan peraturan
    public function listasn()
    {
        $site = $this->konfigurasi_model->listing();
        $download = $this->download_model->download();
        $download = $this->download_model->listingAsn();
        // End paginasi

        $data = array(
            'title' => 'Peraturan ASN - ' . $site->namaweb,
            'deskripsi' => 'Peraturan ASN - ' . $site->namaweb,
            'keywords' => 'Peraturan ASN - ' . $site->namaweb,
            'dokumen' => $download,
            'site' => $site,
            'isi' => 'download/list_asn'
        );
        $this->load->view('layout/wrapper', $data, false);
    }

    // Listing Layanan peraturan
    public function listpdosen()
    {
        $site = $this->konfigurasi_model->listing();
        $download = $this->download_model->download();
        $download = $this->download_model->listingPdosen();
        // End paginasi

        $data = array(
            'title' => 'Peraturan Dosen - ' . $site->namaweb,
            'deskripsi' => 'Peraturan Dosen - ' . $site->namaweb,
            'keywords' => 'Peraturan Dosen - ' . $site->namaweb,
            'dokumen' => $download,
            'site' => $site,
            'isi' => 'download/list_pdosen'
        );
        $this->load->view('layout/wrapper', $data, false);
    }
}

/* End of file Unduhan.php */
/* Location: ./application/controllers/Unduhan.php */
