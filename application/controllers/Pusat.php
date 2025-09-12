<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pusat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('konfigurasi_model');
        $this->load->model('pusat_model');
        $this->load->model('prodi_model');
        $this->load->model('sdm_model');
        $this->load->model('sdm_pusat_model'); // Load model SDM pusat
    }

    public function index($slug = null)
    {
        if (empty($slug)) {
            redirect('home');
            return;
        }

        $site = $this->konfigurasi_model->listing();
        $pusat = $this->pusat_model->listing();
        $pusat_data = $this->pusat_model->get_by_slug($slug);

        if (!$pusat_data) {
            redirect('pusat/oops');
            return;
        }

        // Menggunakan model SDM pusat untuk mendapatkan data SDM
        $sdm_list = $this->sdm_pusat_model->get_sdm_by_pusat_name($pusat_data->nama);

        $data = array(
            'title'              => $site->namaweb . ' - ' . $pusat_data->nama,
            'deskripsi'          => $site->deskripsi,
            'keywords'           => $site->keywords,
            'site'               => $site,
            'pusat'              => $pusat,
            'pusat_data'         => $pusat_data,
            'sdm_list'           => $sdm_list,
            'isi'                => 'pusat/list'
        );
        $this->load->view('layout/wrapper', $data);
    }

    /**
     * Method untuk halaman error 404
     */
    public function oops()
    {
        $site = $this->konfigurasi_model->listing();
        $pusat = $this->pusat_model->listing();

        $data = array(
            'title'     => $site->namaweb . ' - Halaman Tidak Ditemukan',
            'deskripsi' => $site->deskripsi,
            'keywords'  => $site->keywords,
            'site'      => $site,
            'pusat'     => $pusat,
            'isi'       => 'pusat/oops'
        );

        $this->output->set_status_header(404);
        $this->load->view('layout/wrapper', $data);
    }
}

/* End of file Pusat.php */
/* Location: ./application/controllers/Pusat.php */