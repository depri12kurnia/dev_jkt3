<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sdm_jurusan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Method untuk mendapatkan SDM berdasarkan jurusan
     * Menampilkan SDM dengan level: institusi, jurusan tertentu, dan prodi dalam jurusan
     */
    public function get_sdm_by_jurusan($jurusan_id)
    {
        try {
            // Cek apakah tabel sdm dan jabatan_sdm ada
            if (!$this->db->table_exists('sdm') || !$this->db->table_exists('jabatan_sdm')) {
                log_message('error', 'Tabel sdm atau jabatan_sdm tidak ditemukan');
                return array();
            }

            // Clear any previous queries
            $this->db->reset_query();

            // Query untuk mendapatkan SDM berdasarkan jurusan
            $this->db->select('
                s.id as sdm_id, 
                s.nama, 
                s.nip, 
                s.jenis_kelamin, 
                s.email, 
                s.no_hp, 
                s.foto_url, 
                s.deskripsi,
                s.slug as sdm_slug,
                js.id as jabatan_id,
                js.level,
                js.jabatan,
                js.periode_mulai,
                js.periode_akhir,
                js.jurusan_id,
                js.prodi_id,
                js.unit_id,
                js.pusat_id
            ');

            $this->db->from('sdm s');
            $this->db->join('jabatan_sdm js', 's.id = js.sdm_id', 'inner');

            // Dapatkan prodi IDs terlebih dahulu
            $prodi_ids = $this->get_prodi_ids_by_jurusan($jurusan_id);

            // Filter berdasarkan level dan jurusan
            $this->db->group_start();

            // 1. Level institusi (tampil di semua jurusan)
            $this->db->where('js.level', 'institusi');

            // 2. ATAU level jurusan dengan jurusan_id yang sesuai
            $this->db->or_group_start();
            $this->db->where('js.level', 'jurusan');
            $this->db->where('js.jurusan_id', $jurusan_id);
            $this->db->group_end();

            // 3. ATAU level prodi yang berada di bawah jurusan ini
            if (!empty($prodi_ids) && $prodi_ids[0] != 0) {
                $this->db->or_group_start();
                $this->db->where('js.level', 'prodi');
                $this->db->where_in('js.prodi_id', $prodi_ids);
                $this->db->group_end();
            }

            // 4. ATAU level unit yang terkait dengan jurusan ini (jika ada)
            $this->db->or_group_start();
            $this->db->where('js.level', 'unit');
            $this->db->where('js.jurusan_id', $jurusan_id);
            $this->db->group_end();

            $this->db->group_end();

            // Urutkan berdasarkan prioritas level dan nama
            $order_case = "CASE js.level 
                WHEN 'institusi' THEN 1 
                WHEN 'jurusan' THEN 2 
                WHEN 'prodi' THEN 3 
                WHEN 'unit' THEN 4 
                WHEN 'pusat' THEN 5 
                ELSE 6 
            END";

            $this->db->order_by($order_case, '', FALSE);
            $this->db->order_by('s.nama', 'ASC');

            $query = $this->db->get();

            if ($query === FALSE) {
                $error = $this->db->error();
                log_message('error', 'Query SDM by jurusan gagal: ' . $error['message']);
                log_message('error', 'Last query: ' . $this->db->last_query());
                return array();
            }

            $result = $query->result();

            // Log untuk debugging
            log_message('info', 'Query SDM berhasil untuk jurusan_id: ' . $jurusan_id . ', Total: ' . count($result));

            return $result;
        } catch (Exception $e) {
            log_message('error', 'Error dalam get_sdm_by_jurusan: ' . $e->getMessage());
            return array();
        }
    }

    /**
     * Helper method untuk mendapatkan ID prodi berdasarkan jurusan
     */
    public function get_prodi_ids_by_jurusan($jurusan_id)
    {
        try {
            // Cek apakah tabel prodi ada
            if (!$this->db->table_exists('prodi')) {
                log_message('error', 'Tabel prodi tidak ditemukan');
                return array(0);
            }

            // Clear previous query
            $this->db->reset_query();

            $this->db->select('p.id');
            $this->db->from('prodi p');
            $this->db->where('p.jurusan_id', $jurusan_id);
            $query = $this->db->get();

            if ($query === FALSE) {
                $error = $this->db->error();
                log_message('error', 'Query prodi by jurusan gagal: ' . $error['message']);
                log_message('error', 'Last query: ' . $this->db->last_query());
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
    public function get_sdm_statistics($jurusan_id)
    {
        $sdm_list = $this->get_sdm_by_jurusan($jurusan_id);

        $statistics = array(
            'total_sdm' => 0,
            'total_asn' => 0,
            'total_non_asn' => 0,
            'total_institusi' => 0,
            'total_jurusan' => 0,
            'total_prodi' => 0,
            'total_unit' => 0,
            'total_pusat' => 0,
            'total_laki' => 0,
            'total_perempuan' => 0,
            'by_level' => array(),
            'by_gender' => array()
        );

        if (!empty($sdm_list)) {
            $statistics['total_sdm'] = count($sdm_list);

            foreach ($sdm_list as $sdm) {
                // Hitung berdasarkan status ASN (berdasarkan NIP)
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
                    case 'unit':
                        $statistics['total_unit']++;
                        break;
                    case 'pusat':
                        $statistics['total_pusat']++;
                        break;
                }

                // Hitung berdasarkan jenis kelamin
                if ($sdm->jenis_kelamin == 'L') {
                    $statistics['total_laki']++;
                } elseif ($sdm->jenis_kelamin == 'P') {
                    $statistics['total_perempuan']++;
                }

                // Group by level
                if (!isset($statistics['by_level'][$sdm->level])) {
                    $statistics['by_level'][$sdm->level] = 0;
                }
                $statistics['by_level'][$sdm->level]++;

                // Group by gender
                if (!isset($statistics['by_gender'][$sdm->jenis_kelamin])) {
                    $statistics['by_gender'][$sdm->jenis_kelamin] = 0;
                }
                $statistics['by_gender'][$sdm->jenis_kelamin]++;
            }
        }

        return $statistics;
    }

    /**
     * Method untuk mendapatkan SDM berdasarkan prodi
     */
    public function get_sdm_by_prodi($prodi_id)
    {
        try {
            // Cek apakah tabel ada
            if (!$this->db->table_exists('sdm') || !$this->db->table_exists('jabatan_sdm')) {
                log_message('error', 'Tabel sdm atau jabatan_sdm tidak ditemukan');
                return array();
            }

            // Clear previous query
            $this->db->reset_query();

            $this->db->select('
                s.id as sdm_id, 
                s.nama, 
                s.nip, 
                s.jenis_kelamin, 
                s.email, 
                s.no_hp, 
                s.foto_url, 
                s.deskripsi,
                s.slug as sdm_slug,
                js.id as jabatan_id,
                js.level,
                js.jabatan,
                js.periode_mulai,
                js.periode_akhir
            ');

            $this->db->from('sdm s');
            $this->db->join('jabatan_sdm js', 's.id = js.sdm_id', 'inner');

            // Filter untuk prodi tertentu dan level institusi
            $this->db->group_start();
            $this->db->where('js.level', 'institusi');
            $this->db->or_group_start();
            $this->db->where('js.level', 'prodi');
            $this->db->where('js.prodi_id', $prodi_id);
            $this->db->group_end();
            $this->db->group_end();

            // Urutkan berdasarkan level dan nama
            $order_case = "CASE js.level 
                WHEN 'institusi' THEN 1 
                WHEN 'prodi' THEN 2 
                ELSE 3 
            END";

            $this->db->order_by($order_case, '', FALSE);
            $this->db->order_by('s.nama', 'ASC');

            $query = $this->db->get();

            if ($query === FALSE) {
                $error = $this->db->error();
                log_message('error', 'Query SDM by prodi gagal: ' . $error['message']);
                return array();
            }

            return $query->result();
        } catch (Exception $e) {
            log_message('error', 'Error dalam get_sdm_by_prodi: ' . $e->getMessage());
            return array();
        }
    }

    /**
     * Method untuk mendapatkan semua SDM dengan jabatan aktif
     */
    public function get_all_active_sdm()
    {
        try {
            // Clear previous query
            $this->db->reset_query();

            $this->db->select('
                s.id as sdm_id, 
                s.nama, 
                s.nip, 
                s.jenis_kelamin, 
                s.email, 
                s.no_hp, 
                s.foto_url, 
                s.deskripsi,
                s.slug as sdm_slug,
                js.id as jabatan_id,
                js.level,
                js.jabatan,
                js.periode_mulai,
                js.periode_akhir,
                js.jurusan_id,
                js.prodi_id
            ');

            $this->db->from('sdm s');
            $this->db->join('jabatan_sdm js', 's.id = js.sdm_id', 'inner');

            // Filter jabatan yang masih aktif (periode_akhir kosong atau >= tahun sekarang)
            $current_year = date('Y');
            $this->db->group_start();
            $this->db->where('js.periode_akhir IS NULL');
            $this->db->or_where('js.periode_akhir >=', $current_year);
            $this->db->group_end();

            $this->db->order_by('s.nama', 'ASC');

            $query = $this->db->get();

            if ($query === FALSE) {
                $error = $this->db->error();
                log_message('error', 'Query all active SDM gagal: ' . $error['message']);
                return array();
            }

            return $query->result();
        } catch (Exception $e) {
            log_message('error', 'Error dalam get_all_active_sdm: ' . $e->getMessage());
            return array();
        }
    }
}

/* End of file Sdm_jurusan_model.php */
/* Location: ./application/models/Sdm_jurusan_model.php */