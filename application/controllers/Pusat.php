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
        $sdm_statistics = $this->get_sdm_statistics($pusat_data->id);

        $data = array(
            'title'              => $site->namaweb . ' - ' . $pusat_data->nama,
            'deskripsi'          => $site->deskripsi,
            'keywords'           => $site->keywords,
            'site'               => $site,
            'pusat'              => $pusat,
            'pusat_data'         => $pusat_data,
            'sdm_list'           => $sdm_list,
            'sdm_statistics'     => $sdm_statistics,
            'isi'                => 'pusat/list'
        );
        $this->load->view('layout/wrapper', $data);
    }

    /**
     * Method untuk mendapatkan SDM berdasarkan pusat
     * @param int $pusat_id
     */
    private function get_sdm_by_pusat($pusat_id)
    {
        try {
            return $this->sdm_pusat_model->get_sdm_by_pusat_id($pusat_id);
        } catch (Exception $e) {
            log_message('error', 'Error dalam get_sdm_by_pusat: ' . $e->getMessage());
            return array();
        }
    }

    /**
     * Method untuk mendapatkan statistik SDM berdasarkan pusat
     * @param int $pusat_id
     */
    private function get_sdm_statistics($pusat_id)
    {
        try {
            $sdm_list = $this->get_sdm_by_pusat($pusat_id);

            $statistics = array(
                'total_sdm' => 0,
                'total_laki' => 0,
                'total_perempuan' => 0,
                'total_pusat' => 0,
                'by_gender' => array(
                    'L' => 0,
                    'P' => 0
                ),
                'by_jabatan' => array()
            );

            if (!empty($sdm_list)) {
                $statistics['total_sdm'] = count($sdm_list);
                $statistics['total_pusat'] = count($sdm_list);

                foreach ($sdm_list as $sdm) {
                    // Hitung berdasarkan jenis kelamin
                    if ($sdm->jenis_kelamin == 'L') {
                        $statistics['total_laki']++;
                        $statistics['by_gender']['L']++;
                    } elseif ($sdm->jenis_kelamin == 'P') {
                        $statistics['total_perempuan']++;
                        $statistics['by_gender']['P']++;
                    }

                    // Hitung berdasarkan jabatan
                    $jabatan = !empty($sdm->jabatan) ? $sdm->jabatan : 'Tidak Ada Jabatan';
                    if (!isset($statistics['by_jabatan'][$jabatan])) {
                        $statistics['by_jabatan'][$jabatan] = 0;
                    }
                    $statistics['by_jabatan'][$jabatan]++;
                }
            }

            return $statistics;
        } catch (Exception $e) {
            log_message('error', 'Error dalam get_sdm_statistics: ' . $e->getMessage());
            return array(
                'total_sdm' => 0,
                'total_laki' => 0,
                'total_perempuan' => 0,
                'total_pusat' => 0,
                'by_gender' => array('L' => 0, 'P' => 0),
                'by_jabatan' => array()
            );
        }
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

    /**
     * Method untuk mendapatkan semua pusat (untuk keperluan navigasi, dll)
     */
    public function get_all()
    {
        try {
            $pusat_list = $this->sdm_pusat_model->get_all_pusat();

            // Return sebagai JSON jika diperlukan
            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($pusat_list));
                return;
            }

            return $pusat_list;
        } catch (Exception $e) {
            log_message('error', 'Error dalam get_all pusat: ' . $e->getMessage());
            return array();
        }
    }
}

/* End of file Pusat.php */
/* Location: ./application/controllers/Pusat.php */