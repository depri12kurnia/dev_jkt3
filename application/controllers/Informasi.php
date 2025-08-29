<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Informasi extends CI_Controller
{

    // Load database
    public function __construct()
    {
        parent::__construct();
        $this->load->model('download_model');
        $this->load->model('kategori_download_model');
        $this->load->model('jenis_download_model');
    }

    // Main page
    public function index()
    {
        $site = $this->konfigurasi_model->listing();
        $download = $this->download_model->download();
        // End paginasi

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
        // End paginasi

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
        // End paginasi

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
        // End paginasi

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
        $site = $this->konfigurasi_model->listing();
        $kategori_download = $this->kategori_download_model->read($slug_kategori_download);

        // if(count(array($kategori_download) < 1)) {
        //     redirect(base_url('oops'),'refresh');
        // }

        $id_kategori_download = $kategori_download->id_kategori_download;

        $download = $this->download_model->kategori($id_kategori_download);

        $data = array(
            'title' => 'Kategori download: ' .
                $kategori_download->nama_kategori_download,
            'deskripsi' => 'Kategori download: ' .
                $kategori_download->nama_kategori_download,
            'keywords' => 'Kategori download: ' .
                $kategori_download->nama_kategori_download,
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
        $site = $this->konfigurasi_model->listing();
        $jenis_download = $this->jenis_download_model->read($slug_jenis_download);

        // if(count(array($jenis_download) < 1)) {
        //     redirect(base_url('oops'),'refresh');
        // }

        $id_jenis_download = $jenis_download->id_jenis_download;

        $download = $this->download_model->jenis($id_jenis_download);

        $data = array(
            'title' => 'Jenis download: ' .
                $jenis_download->nama_jenis_download,
            'deskripsi' => 'Jenis download: ' .
                $jenis_download->nama_jenis_download,
            'keywords' => 'Jenis download: ' .
                $jenis_download->nama_jenis_download,
            'download' => $download,
            'site' => $site,
            'jenis_download' => $jenis_download,
            'isi' => 'download/list'
        );
        $this->load->view('layout/wrapper', $data, false);
    }

    // Read download detail
    public function read($slug_download)
    {
        $site = $this->konfigurasi_model->listing();
        $download = $this->download_model->read($slug_download);

        if (count(array($download)) < 1) {
            redirect(base_url('oops'), 'refresh');
        }

        $listing = $this->download_model->listing_read();
        $kategori = $this->nav_model->nav_download();

        $data = array(
            'title' => $download->judul_download,
            'deskripsi' => $download->judul_download,
            'keywords' => $download->judul_download,
            'download' => $download,
            'listing' => $listing,
            'kategori' => $kategori,
            'site' => $site,
            'isi' => 'download/read'
        );
        $this->load->view('layout/wrapper', $data, false);
    }

    // Unduh
    public function unduh($id_download)
    {
        $this->load->helper('download');
        $download = $this->download_model->detail($id_download);
        // Contents of photo.jpg will be automatically read
        force_download('./assets/upload/file/' . $download->gambar, null);
    }
    // Sorting Berdasarkan kategori
    public function dokumen()
    {
        $site = $this->konfigurasi_model->listing();
        $download = $this->download_model->download();
        $download = $this->download_model->listingDokumen();
        // End paginasi

        $data = array(
            'title' => 'Dokumen - ' . $site->namaweb,
            'deskripsi' => 'Dokumen - ' . $site->namaweb,
            'keywords' => 'Dokumen - ' . $site->namaweb,
            'dokumen' => $download,
            'site' => $site,
            'isi' => 'download/list_dokumen'
        );
        $this->load->view('layout/wrapper', $data, false);
    }

    public function akuntabilitas()
    {
        $site = $this->konfigurasi_model->listing();
        $download = $this->download_model->download();
        $dipa = $this->download_model->listingDipa();
        $lapkeu = $this->download_model->listingLaporanKeuangan();
        $perencanaan = $this->download_model->listingPerencanaan();
        $lakip = $this->download_model->listingLakip();
        $perjanjiankinerja = $this->download_model->listingPerjanjianKinerja();
        $peraturan = $this->download_model->listingPeraturan();
        $lainnya = $this->download_model->listingLainnya();
        // End paginasi

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

/* End of file Download.php */
/* Location: ./application/controllers/Download.php */
