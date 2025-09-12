<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sdm_unit_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Method untuk mendapatkan SDM berdasarkan unit tertentu
     * @param string $nama_unit - Nama unit yang ingin ditampilkan
     */
    public function get_sdm_by_unit_name($nama_unit)
    {
        try {
            // Cek apakah tabel sdm, jabatan_sdm, dan unit ada
            if (!$this->db->table_exists('sdm') || !$this->db->table_exists('jabatan_sdm') || !$this->db->table_exists('unit')) {
                log_message('error', 'Tabel sdm, jabatan_sdm, atau unit tidak ditemukan');
                return array();
            }

            // Clear any previous queries
            $this->db->reset_query();

            // Query untuk mendapatkan SDM berdasarkan nama unit
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
                js.unit_id,
                p.nama AS nama_unit
            ');

            $this->db->from('sdm s');
            $this->db->join('jabatan_sdm js', 's.id = js.sdm_id', 'inner');
            $this->db->join('unit p', 'js.unit_id = p.id', 'inner');

            // Filter berdasarkan level unit dan nama unit
            $this->db->where('js.level', 'unit');
            $this->db->where('p.nama', $nama_unit);

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
                log_message('error', 'Query SDM by unit gagal: ' . $error['message']);
                log_message('error', 'Last query: ' . $this->db->last_query());
                return array();
            }

            $result = $query->result();

            // Log untuk debugging
            log_message('info', 'Query SDM berhasil untuk unit: ' . $nama_unit . ', Total: ' . count($result));

            return $result;
        } catch (Exception $e) {
            log_message('error', 'Error dalam get_sdm_by_unit_name: ' . $e->getMessage());
            return array();
        }
    }

    /**
     * Method untuk mendapatkan SDM berdasarkan ID unit
     * @param int $unit_id - ID unit yang ingin ditampilkan
     */
    public function get_sdm_by_unit_id($unit_id)
    {
        try {
            // Cek apakah tabel sdm, jabatan_sdm, dan unit ada
            if (!$this->db->table_exists('sdm') || !$this->db->table_exists('jabatan_sdm') || !$this->db->table_exists('unit')) {
                log_message('error', 'Tabel sdm, jabatan_sdm, atau unit tidak ditemukan');
                return array();
            }

            // Clear any previous queries
            $this->db->reset_query();

            // Query untuk mendapatkan SDM berdasarkan ID unit
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
                js.unit_id,
                p.nama AS nama_unit
            ');

            $this->db->from('sdm s');
            $this->db->join('jabatan_sdm js', 's.id = js.sdm_id', 'inner');
            $this->db->join('unit p', 'js.unit_id = p.id', 'inner');

            // Filter berdasarkan level unit dan ID unit
            $this->db->where('js.level', 'unit');
            $this->db->where('js.unit_id', $unit_id);

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
                log_message('error', 'Query SDM by unit ID gagal: ' . $error['message']);
                log_message('error', 'Last query: ' . $this->db->last_query());
                return array();
            }

            $result = $query->result();

            // Log untuk debugging
            log_message('info', 'Query SDM berhasil untuk unit_id: ' . $unit_id . ', Total: ' . count($result));

            return $result;
        } catch (Exception $e) {
            log_message('error', 'Error dalam get_sdm_by_unit_id: ' . $e->getMessage());
            return array();
        }
    }

    /**
     * Method untuk mendapatkan semua daftar unit
     */
    public function get_all_unit()
    {
        try {
            if (!$this->db->table_exists('unit')) {
                log_message('error', 'Tabel unit tidak ditemukan');
                return array();
            }

            $this->db->reset_query();
            $this->db->select('id, nama, slug');
            $this->db->from('unit');
            $this->db->order_by('nama', 'ASC');

            $query = $this->db->get();

            if ($query === FALSE) {
                $error = $this->db->error();
                log_message('error', 'Query get all unit gagal: ' . $error['message']);
                return array();
            }

            return $query->result();
        } catch (Exception $e) {
            log_message('error', 'Error dalam get_all_unit: ' . $e->getMessage());
            return array();
        }
    }

    /**
     * Method untuk mendapatkan info unit berdasarkan slug atau nama
     */
    public function get_unit_by_slug($slug)
    {
        try {
            if (!$this->db->table_exists('unit')) {
                log_message('error', 'Tabel unit tidak ditemukan');
                return null;
            }

            $this->db->reset_query();
            $this->db->select('id, nama, slug');
            $this->db->from('unit');
            $this->db->where('slug', $slug);

            $query = $this->db->get();

            if ($query === FALSE) {
                $error = $this->db->error();
                log_message('error', 'Query get unit by slug gagal: ' . $error['message']);
                return null;
            }

            return $query->row();
        } catch (Exception $e) {
            log_message('error', 'Error dalam get_unit_by_slug: ' . $e->getMessage());
            return null;
        }
    }
}

/* End of file Sdm_unit_model.php */
/* Location: ./application/models/Sdm_unit_model.php */