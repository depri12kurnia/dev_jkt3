<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akreditasi extends CI_Controller
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
        $site       = $this->konfigurasi_model->listing();
        $download   = $this->download_model->download();
        $download   = $this->download_model->listingDokumen();
        // End paginasi

        $data = array(
            'title'     => 'Akreditasi-' . $site->namaweb,
            'deskripsi' => 'Akreditasi-' . $site->namaweb,
            'keywords'  => 'Akreditasi-' . $site->namaweb,
            'dokumen'   => $download,
            'site'      => $site,
            'isi'       => 'pages/akreditasi'
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
}

/* End of file Download.php */
/* Location: ./application/controllers/Download.php */
