<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('konfigurasi_model');
        $this->load->model('unit_model');
        $this->load->model('prodi_model');
        $this->load->model('sdm_model');
        $this->load->model('sdm_unit_model');
    }

    public function index($slug = null)
    {
        if (empty($slug)) {
            redirect('home');
            return;
        }

        $site = $this->konfigurasi_model->listing();
        $unit = $this->unit_model->listing();
        $unit_data = $this->unit_model->get_by_slug($slug);

        if (!$unit_data) {
            redirect('unit/oops');
            return;
        }

        $sdm_list = $this->sdm_unit_model->get_sdm_by_unit_name($unit_data->nama);

        $data = array(
            'title'              => $site->namaweb . ' - ' . $unit_data->nama,
            'deskripsi'          => $site->deskripsi,
            'keywords'           => $site->keywords,
            'site'               => $site,
            'unit'               => $unit,
            'unit_data'          => $unit_data,
            'sdm_list'           => $sdm_list,
            'isi'                => 'unit/list'
        );
        $this->load->view('layout/wrapper', $data);
    }

    // Oops - halaman tidak ditemukan
    public function oops()
    {
        $site = $this->konfigurasi_model->listing();

        $data = array(
            'title'                => 'Halaman Tidak Ditemukan - ' . $site->namaweb,
            'deskripsi'            => $site->deskripsi,
            'keywords'            => $site->keywords,
            'site'                => $site,
            'isi'                => 'home/oops'
        );
        $this->load->view('layout/wrapper', $data);
    }
}

/* End of file Unit.php */
/* Location: ./application/controllers/Unit.php */