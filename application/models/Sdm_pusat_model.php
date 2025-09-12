<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sdm_pusat_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Method untuk mendapatkan SDM berdasarkan pusat tertentu
     * @param string $nama_pusat - Nama pusat yang ingin ditampilkan
     */
    public function get_sdm_by_pusat_name($nama_pusat)
    {
        try {
            // Cek apakah tabel sdm, jabatan_sdm, dan pusat ada
            if (!$this->db->table_exists('sdm') || !$this->db->table_exists('jabatan_sdm') || !$this->db->table_exists('pusat')) {
                log_message('error', 'Tabel sdm, jabatan_sdm, atau pusat tidak ditemukan');
                return array();
            }

            // Clear any previous queries
            $this->db->reset_query();

            // Query untuk mendapatkan SDM berdasarkan nama pusat
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
                js.pusat_id,
                p.nama AS nama_pusat
            ');

            $this->db->from('sdm s');
            $this->db->join('jabatan_sdm js', 's.id = js.sdm_id', 'inner');
            $this->db->join('pusat p', 'js.pusat_id = p.id', 'inner');

            // Filter berdasarkan level pusat dan nama pusat
            $this->db->where('js.level', 'pusat');
            $this->db->where('p.nama', $nama_pusat);

            // Filter jabatan yang masih aktif
            $current_year = date('Y');
            $this->db->group_start();
            $this->db->where('js.periode_akhir IS NULL');
            $this->db->or_where('js.periode_akhir >=', $current_year);
            $this->db->group_end();

            // Urutkan berdasarkan nama
            $this->db->order_by('s.nama', 'ASC');

            $query = $this->db->get();

            if ($query === FALSE) {
                $error = $this->db->error();
                log_message('error', 'Query SDM by pusat gagal: ' . $error['message']);
                log_message('error', 'Last query: ' . $this->db->last_query());
                return array();
            }

            $result = $query->result();

            // Log untuk debugging
            log_message('info', 'Query SDM berhasil untuk pusat: ' . $nama_pusat . ', Total: ' . count($result));

            return $result;
        } catch (Exception $e) {
            log_message('error', 'Error dalam get_sdm_by_pusat_name: ' . $e->getMessage());
            return array();
        }
    }
}

/* End of file Sdm_pusat_model.php */
/* Location: ./application/models/Sdm_pusat_model.php */