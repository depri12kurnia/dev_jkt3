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
        $this->load->model('sdm_model'); // Aktifkan model SDM
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

        // Get SDM berdasarkan jurusan - PERBAIKAN UTAMA
        $sdm_list = $this->get_sdm_by_jurusan($jurusan_data->id);

        // Get statistik SDM untuk jurusan ini
        $sdm_statistics = $this->get_sdm_statistics($jurusan_data->id);

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
            'sdm_statistics'     => $sdm_statistics,
            'isi'                => 'jurusan/list'
        );
        $this->load->view('layout/wrapper', $data);
    }

    /**
     * Method untuk mendapatkan SDM berdasarkan jurusan
     * Menampilkan SDM dengan level: institusi, jurusan tertentu, dan prodi dalam jurusan
     */
    private function get_sdm_by_jurusan($jurusan_id)
    {
        try {
            // Cek apakah tabel sdm dan jabatan_sdm ada
            if (!$this->db->table_exists('sdm') || !$this->db->table_exists('jabatan_sdm')) {
                log_message('error', 'Tabel sdm atau jabatan_sdm tidak ditemukan');
                return array();
            }

            $this->db->select('
                s.id, 
                s.nama, 
                s.nip, 
                s.jenis_kelamin, 
                s.email, 
                s.no_hp, 
                s.foto_url, 
                s.deskripsi,
                js.level,
                js.jabatan,
                js.periode_mulai,
                js.periode_akhir,
                js.jurusan_id,
                js.prodi_id
            ');

            $this->db->from('sdm s');
            $this->db->join('jabatan_sdm js', 's.id = js.sdm_id', 'left');

            // Dapatkan prodi IDs terlebih dahulu
            $prodi_ids = $this->get_prodi_ids_by_jurusan($jurusan_id);

            // Filter berdasarkan jurusan
            $this->db->group_start();
            // Level institusi (tampil di semua jurusan)
            $this->db->where('js.level', 'institusi');

            // ATAU level jurusan dengan jurusan_id yang sesuai
            $this->db->or_group_start();
            $this->db->where('js.level', 'jurusan');
            $this->db->where('js.jurusan_id', $jurusan_id);
            $this->db->group_end();

            // ATAU level prodi yang berada di bawah jurusan ini
            if (!empty($prodi_ids) && $prodi_ids[0] != 0) {
                $this->db->or_group_start();
                $this->db->where('js.level', 'prodi');
                $this->db->where_in('js.prodi_id', $prodi_ids);
                $this->db->group_end();
            }
            $this->db->group_end();

            // Urutkan berdasarkan prioritas level dan nama
            $this->db->order_by('
                CASE js.level 
                    WHEN "institusi" THEN 1 
                    WHEN "jurusan" THEN 2 
                    WHEN "prodi" THEN 3 
                    ELSE 4 
                END
            ');
            $this->db->order_by('s.nama', 'ASC');

            $query = $this->db->get();

            if ($query === FALSE) {
                log_message('error', 'Query SDM by jurusan gagal: ' . $this->db->error()['message']);
                return array();
            }

            return $query->result();
        } catch (Exception $e) {
            log_message('error', 'Error dalam get_sdm_by_jurusan: ' . $e->getMessage());
            return array();
        }
    }

    /**
     * Helper method untuk mendapatkan ID prodi berdasarkan jurusan
     */
    private function get_prodi_ids_by_jurusan($jurusan_id)
    {
        try {
            // Cek apakah tabel prodi ada
            if (!$this->db->table_exists('prodi')) {
                log_message('error', 'Tabel prodi tidak ditemukan');
                return array(0);
            }

            $this->db->select('id');
            $this->db->where('jurusan_id', $jurusan_id);
            $query = $this->db->get('prodi');

            if ($query === FALSE) {
                log_message('error', 'Query prodi by jurusan gagal: ' . $this->db->error()['message']);
                return array(0);
            }

            $prodi_ids = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $prodi) {
                    $prodi_ids[] = $prodi->id;
                }
            }

            return !empty($prodi_ids) ? $prodi_ids : array(0);
        } catch (Exception $e) {
            log_message('error', 'Error dalam get_prodi_ids_by_jurusan: ' . $e->getMessage());
            return array(0);
        }
    }

    /**
     * Method untuk mendapatkan statistik SDM berdasarkan jurusan
     */
    private function get_sdm_statistics($jurusan_id)
    {
        $sdm_list = $this->get_sdm_by_jurusan($jurusan_id);

        $statistics = array(
            'total_sdm' => 0,
            'total_asn' => 0,
            'total_non_asn' => 0,
            'total_institusi' => 0,
            'total_jurusan' => 0,
            'total_prodi' => 0,
            'total_laki' => 0,
            'total_perempuan' => 0,
            'by_level' => array(),
            'by_gender' => array()
        );

        if (!empty($sdm_list)) {
            $statistics['total_sdm'] = count($sdm_list);

            foreach ($sdm_list as $sdm) {
                // Hitung berdasarkan status ASN
                if (!empty($sdm->nip)) {
                    $statistics['total_asn']++;
                } else {
                    $statistics['total_non_asn']++;
                }

                // Hitung berdasarkan level jabatan
                switch ($sdm->level) {
                    case 'institusi':
                        $statistics['total_institusi']++;
                        break;
                    case 'jurusan':
                        $statistics['total_jurusan']++;
                        break;
                    case 'prodi':
                        $statistics['total_prodi']++;
                        break;
                }

                // Hitung berdasarkan jenis kelamin
                if ($sdm->jenis_kelamin == 'L') {
                    $statistics['total_laki']++;
                } else {
                    $statistics['total_perempuan']++;
                }
            }
        }

        return $statistics;
    }

    /**
     * Method untuk mendapatkan SDM berdasarkan prodi
     */
    private function get_sdm_by_prodi($prodi_id)
    {
        try {
            // Cek apakah tabel ada
            if (!$this->db->table_exists('sdm') || !$this->db->table_exists('jabatan_sdm')) {
                log_message('error', 'Tabel sdm atau jabatan_sdm tidak ditemukan');
                return array();
            }

            $this->db->select('
                s.id, 
                s.nama, 
                s.nip, 
                s.jenis_kelamin, 
                s.email, 
                s.no_hp, 
                s.foto_url, 
                s.deskripsi,
                js.level,
                js.jabatan,
                js.periode_mulai,
                js.periode_akhir
            ');

            $this->db->from('sdm s');
            $this->db->join('jabatan_sdm js', 's.id = js.sdm_id', 'left');

            // Filter untuk prodi tertentu
            $this->db->group_start();
            $this->db->where('js.level', 'institusi');
            $this->db->or_group_start();
            $this->db->where('js.level', 'prodi');
            $this->db->where('js.prodi_id', $prodi_id);
            $this->db->group_end();
            $this->db->group_end();

            $this->db->order_by('js.level', 'ASC');
            $this->db->order_by('s.nama', 'ASC');

            $query = $this->db->get();

            if ($query === FALSE) {
                log_message('error', 'Query SDM by prodi gagal: ' . $this->db->error()['message']);
                return array();
            }

            return $query->result();
        } catch (Exception $e) {
            log_message('error', 'Error dalam get_sdm_by_prodi: ' . $e->getMessage());
            return array();
        }
    }

    // Method untuk listing semua jurusan
    public function listing()
    {
        $site = $this->konfigurasi_model->listing();
        $jurusan = $this->jurusan_model->listing();

        $data = array(
            'title'              => $site->namaweb . ' - Daftar Jurusan',
            'deskripsi'          => $site->deskripsi,
            'keywords'           => $site->keywords,
            'site'               => $site,
            'jurusan'            => $jurusan,
            'isi'                => 'jurusan/listing'
        );
        $this->load->view('layout/wrapper', $data);
    }

    // Method untuk detail prodi dalam jurusan
    public function prodi($jurusan_slug, $prodi_slug)
    {
        $site = $this->konfigurasi_model->listing();
        $jurusan_data = $this->jurusan_model->get_by_slug($jurusan_slug);

        if (!$jurusan_data) {
            redirect('jurusan/oops');
            return;
        }

        $prodi_data = $this->prodi_model->get_by_slug($prodi_slug);

        if (!$prodi_data || $prodi_data->jurusan_id != $jurusan_data->id) {
            redirect('jurusan/oops');
            return;
        }

        // Get SDM khusus untuk prodi ini
        $sdm_prodi = $this->get_sdm_by_prodi($prodi_data->id);

        $data = array(
            'title'              => $site->namaweb . ' - ' . $prodi_data->nama,
            'deskripsi'          => $site->deskripsi,
            'keywords'           => $site->keywords,
            'site'               => $site,
            'jurusan_data'       => $jurusan_data,
            'prodi_data'         => $prodi_data,
            'sdm_prodi'          => $sdm_prodi,
            'isi'                => 'prodi/detail'
        );
        $this->load->view('layout/wrapper', $data);
    }

    // Search jurusan
    public function search()
    {
        $keyword = $this->input->get('q');

        if (empty($keyword)) {
            redirect('home');
            return;
        }

        $site = $this->konfigurasi_model->listing();
        $jurusan = $this->jurusan_model->search($keyword);

        $data = array(
            'title'              => $site->namaweb . ' - Pencarian: ' . $keyword,
            'deskripsi'          => $site->deskripsi,
            'keywords'           => $site->keywords,
            'site'               => $site,
            'jurusan'            => $jurusan,
            'keyword'            => $keyword,
            'isi'                => 'jurusan/search'
        );
        $this->load->view('layout/wrapper', $data);
    }

    // Ajax method untuk get prodi by jurusan
    public function get_prodi_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $jurusan_id = $this->input->post('jurusan_id');

            if (!empty($jurusan_id)) {
                $prodi_list = $this->prodi_model->by_jurusan($jurusan_id);

                $result = array();
                foreach ($prodi_list as $prodi) {
                    $result[] = array(
                        'id' => $prodi->id,
                        'nama' => $prodi->nama,
                        'jenjang' => $prodi->jenjang,
                        'slug' => $prodi->slug
                    );
                }

                echo json_encode(array('status' => 'success', 'data' => $result));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Jurusan ID tidak valid'));
            }
        } else {
            show_404();
        }
    }

    // Ajax method untuk get SDM by jurusan
    public function get_sdm_ajax()
    {
        if ($this->input->is_ajax_request()) {
            $jurusan_id = $this->input->post('jurusan_id');

            if (!empty($jurusan_id)) {
                $sdm_list = $this->get_sdm_by_jurusan($jurusan_id);
                $sdm_statistics = $this->get_sdm_statistics($jurusan_id);

                $result = array();
                foreach ($sdm_list as $sdm) {
                    $result[] = array(
                        'id' => $sdm->id,
                        'nama' => $sdm->nama,
                        'nip' => $sdm->nip,
                        'jenis_kelamin' => $sdm->jenis_kelamin,
                        'email' => $sdm->email,
                        'no_hp' => $sdm->no_hp,
                        'foto_url' => $sdm->foto_url,
                        'level' => $sdm->level,
                        'jabatan' => $sdm->jabatan,
                        'periode_mulai' => $sdm->periode_mulai,
                        'periode_akhir' => $sdm->periode_akhir
                    );
                }

                echo json_encode(array(
                    'status' => 'success',
                    'data' => $result,
                    'statistics' => $sdm_statistics,
                    'total' => count($result)
                ));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Jurusan ID tidak valid'));
            }
        } else {
            show_404();
        }
    }

    // Method untuk debugging database
    public function debug_tables()
    {
        header('Content-Type: application/json');

        $debug_info = array(
            'sdm_table_exists' => $this->db->table_exists('sdm'),
            'jabatan_sdm_table_exists' => $this->db->table_exists('jabatan_sdm'),
            'prodi_table_exists' => $this->db->table_exists('prodi'),
            'database_name' => $this->db->database,
        );

        // Jika tabel ada, cek struktur
        if ($debug_info['sdm_table_exists']) {
            $debug_info['sdm_fields'] = $this->db->list_fields('sdm');
        }

        if ($debug_info['jabatan_sdm_table_exists']) {
            $debug_info['jabatan_sdm_fields'] = $this->db->list_fields('jabatan_sdm');
        }

        if ($debug_info['prodi_table_exists']) {
            $debug_info['prodi_fields'] = $this->db->list_fields('prodi');
        }

        echo json_encode($debug_info, JSON_PRETTY_PRINT);
    }

    // Method untuk menampilkan SDM dalam format JSON (untuk debugging)
    public function debug_sdm($jurusan_slug)
    {
        $jurusan_data = $this->jurusan_model->get_by_slug($jurusan_slug);

        if (!$jurusan_data) {
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'Jurusan tidak ditemukan'));
            return;
        }

        $sdm_list = $this->get_sdm_by_jurusan($jurusan_data->id);
        $sdm_statistics = $this->get_sdm_statistics($jurusan_data->id);

        header('Content-Type: application/json');
        echo json_encode(array(
            'jurusan' => $jurusan_data,
            'sdm_list' => $sdm_list,
            'statistics' => $sdm_statistics,
            'debug' => array(
                'jurusan_id' => $jurusan_data->id,
                'prodi_ids' => $this->get_prodi_ids_by_jurusan($jurusan_data->id),
                'last_query' => $this->db->last_query()
            )
        ), JSON_PRETTY_PRINT);
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