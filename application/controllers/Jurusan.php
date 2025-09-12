<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('konfigurasi_model');
        $this->load->model('jurusan_model');
        $this->load->model('prodi_model');
        $this->load->model('sdm_model');
        $this->load->model('sdm_jurusan_model');
    }

    public function index($slug = null)
    {
        // Redirect ke home jika slug kosong
        if (empty($slug)) {
            redirect('home');
            return;
        }

        $site = $this->konfigurasi_model->listing();
        $jurusan = $this->jurusan_model->listing();
        $jurusan_data = $this->jurusan_model->get_by_slug($slug);

        // Check if jurusan exists
        if (!$jurusan_data) {
            redirect('jurusan/oops');
            return;
        }

        // Get prodi list berdasarkan jurusan_id dari data jurusan yang ditemukan
        $prodi_list = $this->prodi_model->by_jurusan($jurusan_data->id);

        // Get all prodi untuk keperluan lain (jika diperlukan)
        $prodi = $this->prodi_model->listing();

        // Get SDM berdasarkan jurusan menggunakan model
        $sdm_list = $this->sdm_jurusan_model->get_sdm_by_jurusan_name($jurusan_data->nama);


        $data = array(
            'title'              => $site->namaweb . ' - ' . $jurusan_data->nama,
            'deskripsi'          => $site->deskripsi,
            'keywords'           => $site->keywords,
            'site'               => $site,
            'jurusan'            => $jurusan,
            'jurusan_data'       => $jurusan_data,
            'prodi'              => $prodi,
            'prodi_list'         => $prodi_list,
            'sdm_list'           => $sdm_list,
            'isi'                => 'jurusan/list'
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

/* End of file Jurusan.php */
/* Location: ./application/controllers/Jurusan.php */