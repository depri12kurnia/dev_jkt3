<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Eoffice extends CI_Controller
{

    // Load database
    public function __construct()
    {
        parent::__construct();
    }

    // Main page
    public function index()
    {
        $site       = $this->konfigurasi_model->listing();

        $data = array(
            'title'     => 'E-Office-' . $site->namaweb,
            'deskripsi' => 'E-Office-' . $site->namaweb,
            'keywords'  => 'E-Office-' . $site->namaweb,
            'site'      => $site,
            'isi'       => 'pages/eoffice'
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
