<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatansdm_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Listing data dengan join
    public function listing()
    {
        $this->db->select('jabatan_sdm.*, sdm.nama as nama_sdm, sdm.nip, 
                          jurusan.nama as nama_jurusan, prodi.nama as nama_prodi, pusat.nama as nama_pusat, unit.nama as nama_unit');
        $this->db->from('jabatan_sdm');
        $this->db->join('sdm', 'sdm.id = jabatan_sdm.sdm_id', 'LEFT');
        $this->db->join('jurusan', 'jurusan.id = jabatan_sdm.jurusan_id', 'LEFT');
        $this->db->join('prodi', 'prodi.id = jabatan_sdm.prodi_id', 'LEFT');
        $this->db->join('pusat', 'pusat.id = jabatan_sdm.pusat_id', 'LEFT');
        $this->db->join('unit', 'unit.id = jabatan_sdm.unit_id', 'LEFT');
        $this->db->order_by('jabatan_sdm.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Jumlah total data
    public function jumlah()
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('jabatan_sdm');
        $query = $this->db->get();
        return $query->row();
    }

    // Listing untuk homepage
    public function home()
    {
        $this->db->select('jabatan_sdm.*, sdm.nama as nama_sdm, sdm.nip, sdm.foto_url, sdm.slug,
                          jurusan.nama as nama_jurusan, prodi.nama as nama_prodi, pusat.nama as nama_pusat, unit.nama as nama_unit');
        $this->db->from('jabatan_sdm');
        $this->db->join('sdm', 'sdm.id = jabatan_sdm.sdm_id', 'LEFT');
        $this->db->join('jurusan', 'jurusan.id = jabatan_sdm.jurusan_id', 'LEFT');
        $this->db->join('prodi', 'prodi.id = jabatan_sdm.prodi_id', 'LEFT');
        $this->db->join('pusat', 'pusat.id = jabatan_sdm.pusat_id', 'LEFT');
        $this->db->join('unit', 'unit.id = jabatan_sdm.unit_id', 'LEFT');
        $this->db->order_by('jabatan_sdm.level', 'ASC');
        $this->db->order_by('jabatan_sdm.jabatan', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Detail data berdasarkan ID
    public function detail($id)
    {
        $this->db->select('jabatan_sdm.*, sdm.nama as nama_sdm, sdm.nip, sdm.email, sdm.no_hp, sdm.foto_url,
                          jurusan.nama as nama_jurusan, prodi.nama as nama_prodi, pusat.nama as nama_pusat, unit.nama as nama_unit');
        $this->db->from('jabatan_sdm');
        $this->db->join('sdm', 'sdm.id = jabatan_sdm.sdm_id', 'LEFT');
        $this->db->join('jurusan', 'jurusan.id = jabatan_sdm.jurusan_id', 'LEFT');
        $this->db->join('prodi', 'prodi.id = jabatan_sdm.prodi_id', 'LEFT');
        $this->db->join('pusat', 'pusat.id = jabatan_sdm.pusat_id', 'LEFT');
        $this->db->join('unit', 'unit.id = jabatan_sdm.unit_id', 'LEFT');
        $this->db->where('jabatan_sdm.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    // Get jabatan berdasarkan level
    public function by_level($level)
    {
        $this->db->select('jabatan_sdm.*, sdm.nama as nama_sdm, sdm.nip, sdm.foto_url,
                          jurusan.nama as nama_jurusan, prodi.nama as nama_prodi, pusat.nama as nama_pusat, unit.nama as nama_unit');
        $this->db->from('jabatan_sdm');
        $this->db->join('sdm', 'sdm.id = jabatan_sdm.sdm_id', 'LEFT');
        $this->db->join('jurusan', 'jurusan.id = jabatan_sdm.jurusan_id', 'LEFT');
        $this->db->join('prodi', 'prodi.id = jabatan_sdm.prodi_id', 'LEFT');
        $this->db->join('pusat', 'pusat.id = jabatan_sdm.pusat_id', 'LEFT');
        $this->db->join('unit', 'unit.id = jabatan_sdm.unit_id', 'LEFT');
        $this->db->where('jabatan_sdm.level', $level);
        $this->db->order_by('jabatan_sdm.jabatan', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Get jabatan berdasarkan SDM
    public function by_sdm($sdm_id)
    {
        $this->db->select('jabatan_sdm.*, sdm.nama as nama_sdm, sdm.nip,
                          jurusan.nama as nama_jurusan, prodi.nama as nama_prodi, pusat.nama as nama_pusat, unit.nama as nama_unit');
        $this->db->from('jabatan_sdm');
        $this->db->join('sdm', 'sdm.id = jabatan_sdm.sdm_id', 'LEFT');
        $this->db->join('jurusan', 'jurusan.id = jabatan_sdm.jurusan_id', 'LEFT');
        $this->db->join('prodi', 'prodi.id = jabatan_sdm.prodi_id', 'LEFT');
        $this->db->join('pusat', 'pusat.id = jabatan_sdm.pusat_id', 'LEFT');
        $this->db->join('unit', 'unit.id = jabatan_sdm.unit_id', 'LEFT');
        $this->db->where('jabatan_sdm.sdm_id', $sdm_id);
        $this->db->order_by('jabatan_sdm.periode_mulai', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Get jabatan berdasarkan jurusan
    public function by_jurusan($jurusan_id)
    {
        $this->db->select('jabatan_sdm.*, sdm.nama as nama_sdm, sdm.nip, sdm.foto_url,
                          jurusan.nama as nama_jurusan');
        $this->db->from('jabatan_sdm');
        $this->db->join('sdm', 'sdm.id = jabatan_sdm.sdm_id', 'LEFT');
        $this->db->join('jurusan', 'jurusan.id = jabatan_sdm.jurusan_id', 'LEFT');
        $this->db->where('jabatan_sdm.jurusan_id', $jurusan_id);
        $this->db->order_by('jabatan_sdm.jabatan', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    // Get jabatan berdasarkan unit
    public function by_unit($unit_id)
    {
        $this->db->select('jabatan_sdm.*, sdm.nama as nama_sdm, sdm.nip, sdm.foto_url,
                            unit.nama as nama_unit');
        $this->db->from('jabatan_sdm');
        $this->db->join('sdm', 'sdm.id = jabatan_sdm.sdm_id', 'LEFT');
        $this->db->join('unit', 'unit.id = jabatan_sdm.unit_id', 'LEFT');
        $this->db->where('jabatan_sdm.unit_id', $unit_id);
        $this->db->order_by('jabatan_sdm.jabatan', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Get jabatan berdasarkan pusat
    public function by_pusat($pusat_id)
    {
        $this->db->select('jabatan_sdm.*, sdm.nama as nama_sdm, sdm.nip, sdm.foto_url,
                          pusat.nama as nama_pusat');
        $this->db->from('jabatan_sdm');
        $this->db->join('sdm', 'sdm.id = jabatan_sdm.sdm_id', 'LEFT');
        $this->db->join('pusat', 'pusat.id = jabatan_sdm.pusat_id', 'LEFT');
        $this->db->where('jabatan_sdm.pusat_id', $pusat_id);
        $this->db->order_by('jabatan_sdm.jabatan', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Get jabatan berdasarkan prodi
    public function by_prodi($prodi_id)
    {
        $this->db->select('jabatan_sdm.*, sdm.nama as nama_sdm, sdm.nip, sdm.foto_url,
                          jurusan.nama as nama_jurusan, prodi.nama as nama_prodi');
        $this->db->from('jabatan_sdm');
        $this->db->join('sdm', 'sdm.id = jabatan_sdm.sdm_id', 'LEFT');
        $this->db->join('jurusan', 'jurusan.id = jabatan_sdm.jurusan_id', 'LEFT');
        $this->db->join('prodi', 'prodi.id = jabatan_sdm.prodi_id', 'LEFT');
        $this->db->where('jabatan_sdm.prodi_id', $prodi_id);
        $this->db->order_by('jabatan_sdm.jabatan', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Get jabatan aktif (periode masih berjalan)
    public function get_active($year = null)
    {
        if ($year === null) {
            $year = date('Y');
        }

        $this->db->select('jabatan_sdm.*, sdm.nama as nama_sdm, sdm.nip, sdm.foto_url,
                          jurusan.nama as nama_jurusan, prodi.nama as nama_prodi, pusat.nama as nama_pusat');
        $this->db->from('jabatan_sdm');
        $this->db->join('sdm', 'sdm.id = jabatan_sdm.sdm_id', 'LEFT');
        $this->db->join('jurusan', 'jurusan.id = jabatan_sdm.jurusan_id', 'LEFT');
        $this->db->join('prodi', 'prodi.id = jabatan_sdm.prodi_id', 'LEFT');
        $this->db->join('pusat', 'pusat.id = jabatan_sdm.pusat_id', 'LEFT');
        $this->db->join('unit', 'unit.id = jabatan_sdm.unit_id', 'LEFT');
        $this->db->where('jabatan_sdm.periode_mulai <=', $year);
        $this->db->where('jabatan_sdm.periode_akhir >=', $year);
        $this->db->order_by('jabatan_sdm.level', 'ASC');
        $this->db->order_by('jabatan_sdm.jabatan', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Validasi data
    public function validate_data($data, $id = null)
    {
        $errors = array();

        // Validasi sdm_id
        if (empty($data['sdm_id'])) {
            $errors[] = 'SDM harus dipilih';
        } else {
            $this->db->where('id', $data['sdm_id']);
            if ($this->db->get('sdm')->num_rows() == 0) {
                $errors[] = 'SDM yang dipilih tidak valid';
            }
        }

        // Validasi level
        $allowed_levels = array('institusi', 'jurusan', 'prodi', 'unit', 'pusat');
        if (empty($data['level'])) {
            $errors[] = 'Level jabatan harus dipilih';
        } elseif (!in_array($data['level'], $allowed_levels)) {
            $errors[] = 'Level jabatan tidak valid';
        }

        // Validasi berdasarkan level
        if (!empty($data['level'])) {
            if ($data['level'] == 'jurusan') {
                if (empty($data['jurusan_id'])) {
                    $errors[] = 'Jurusan harus dipilih untuk level jurusan';
                } else {
                    $this->db->where('id', $data['jurusan_id']);
                    if ($this->db->get('jurusan')->num_rows() == 0) {
                        $errors[] = 'Jurusan yang dipilih tidak valid';
                    }
                }
                $data['prodi_id'] = null;
                $data['unit_id'] = null;
                $data['pusat_id'] = null;
            } elseif ($data['level'] == 'prodi') {
                if (empty($data['prodi_id'])) {
                    $errors[] = 'Program Studi harus dipilih untuk level prodi';
                } else {
                    $this->db->where('id', $data['prodi_id']);
                    if ($this->db->get('prodi')->num_rows() == 0) {
                        $errors[] = 'Program Studi yang dipilih tidak valid';
                    }
                }
                $data['jurusan_id'] = null;
                $data['unit_id'] = null;
                $data['pusat_id'] = null;
            } elseif ($data['level'] == 'unit') {
                if (empty($data['unit_id'])) {
                    $errors[] = 'Unit harus dipilih untuk level unit';
                } else {
                    $this->db->where('id', $data['unit_id']);
                    if ($this->db->get('unit')->num_rows() == 0) {
                        $errors[] = 'Unit yang dipilih tidak valid';
                    }
                }
                $data['jurusan_id'] = null;
                $data['prodi_id'] = null;
                $data['pusat_id'] = null;
            } elseif ($data['level'] == 'pusat') {
                if (empty($data['pusat_id'])) {
                    $errors[] = 'Pusat harus dipilih untuk level pusat';
                } else {
                    $this->db->where('id', $data['pusat_id']);
                    if ($this->db->get('pusat')->num_rows() == 0) {
                        $errors[] = 'Pusat yang dipilih tidak valid';
                    }
                }
                $data['jurusan_id'] = null;
                $data['prodi_id'] = null;
                $data['unit_id'] = null;
            } else {
                // institusi
                $data['jurusan_id'] = null;
                $data['prodi_id'] = null;
                $data['unit_id'] = null;
                $data['pusat_id'] = null;
            }
        }

        // Validasi jabatan
        if (empty($data['jabatan'])) {
            $errors[] = 'Nama jabatan harus diisi';
        } elseif (strlen($data['jabatan']) > 100) {
            $errors[] = 'Nama jabatan maksimal 100 karakter';
        }

        // Validasi periode
        if (empty($data['periode_mulai'])) {
            $errors[] = 'Periode mulai harus diisi';
        } elseif (!is_numeric($data['periode_mulai']) || $data['periode_mulai'] < 1900 || $data['periode_mulai'] > 2100) {
            $errors[] = 'Periode mulai tidak valid';
        }

        if (empty($data['periode_akhir'])) {
            $errors[] = 'Periode akhir harus diisi';
        } elseif (!is_numeric($data['periode_akhir']) || $data['periode_akhir'] < 1900 || $data['periode_akhir'] > 2100) {
            $errors[] = 'Periode akhir tidak valid';
        }

        // Validasi periode mulai <= periode akhir
        if (!empty($data['periode_mulai']) && !empty($data['periode_akhir'])) {
            if ($data['periode_mulai'] > $data['periode_akhir']) {
                $errors[] = 'Periode mulai tidak boleh lebih besar dari periode akhir';
            }
        }

        // Check overlap jabatan untuk SDM yang sama di level dan unit/pusat/jurusan/prodi yang sama
        if (!empty($data['sdm_id']) && !empty($data['level']) && !empty($data['periode_mulai']) && !empty($data['periode_akhir'])) {
            $this->db->where('sdm_id', $data['sdm_id']);
            $this->db->where('level', $data['level']);

            if ($data['level'] == 'jurusan' && !empty($data['jurusan_id'])) {
                $this->db->where('jurusan_id', $data['jurusan_id']);
            } elseif ($data['level'] == 'prodi' && !empty($data['prodi_id'])) {
                $this->db->where('prodi_id', $data['prodi_id']);
            } elseif ($data['level'] == 'unit' && !empty($data['unit_id'])) {
                $this->db->where('unit_id', $data['unit_id']);
            } elseif ($data['level'] == 'pusat' && !empty($data['pusat_id'])) {
                $this->db->where('pusat_id', $data['pusat_id']);
            }

            // Exclude current record if editing
            if ($id !== null) {
                $this->db->where('id !=', $id);
            }

            // Check overlapping periods
            $this->db->where('((periode_mulai <= ' . $data['periode_akhir'] . ' AND periode_akhir >= ' . $data['periode_mulai'] . '))');

            $overlap = $this->db->get('jabatan_sdm')->num_rows();
            if ($overlap > 0) {
                $errors[] = 'Periode jabatan bertabrakan dengan jabatan lain dari SDM yang sama';
            }
        }

        return $errors;
    }

    // Tambah data
    public function tambah($data)
    {
        // Validasi data
        $errors = $this->validate_data($data);
        if (!empty($errors)) {
            return array('status' => false, 'errors' => $errors);
        }

        $result = $this->db->insert('jabatan_sdm', $data);

        if ($result) {
            return array('status' => true, 'id' => $this->db->insert_id());
        } else {
            return array('status' => false, 'errors' => array('Gagal menyimpan data'));
        }
    }

    // Edit data
    public function edit($data)
    {
        $id = $data['id'];

        // Validasi data
        $errors = $this->validate_data($data, $id);
        if (!empty($errors)) {
            return array('status' => false, 'errors' => $errors);
        }

        // Hapus id dari data untuk update
        unset($data['id']);

        $this->db->where('id', $id);
        $result = $this->db->update('jabatan_sdm', $data);

        if ($result) {
            return array('status' => true);
        } else {
            return array('status' => false, 'errors' => array('Gagal mengupdate data'));
        }
    }

    // Delete data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        return $this->db->delete('jabatan_sdm');
    }

    // Search jabatan
    public function search($keyword)
    {
        $this->db->select('jabatan_sdm.*, sdm.nama as nama_sdm, sdm.nip,
                          jurusan.nama as nama_jurusan, prodi.nama as nama_prodi');
        $this->db->from('jabatan_sdm');
        $this->db->join('sdm', 'sdm.id = jabatan_sdm.sdm_id', 'LEFT');
        $this->db->join('jurusan', 'jurusan.id = jabatan_sdm.jurusan_id', 'LEFT');
        $this->db->join('prodi', 'prodi.id = jabatan_sdm.prodi_id', 'LEFT');

        $this->db->group_start();
        $this->db->like('sdm.nama', $keyword);
        $this->db->or_like('sdm.nip', $keyword);
        $this->db->or_like('jabatan_sdm.jabatan', $keyword);
        $this->db->or_like('jurusan.nama', $keyword);
        $this->db->or_like('prodi.nama', $keyword);
        $this->db->group_end();

        $this->db->order_by('jabatan_sdm.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing dengan pagination
    public function listing_paginated($limit, $start)
    {
        $this->db->select('jabatan_sdm.*, sdm.nama as nama_sdm, sdm.nip,
                          jurusan.nama as nama_jurusan, prodi.nama as nama_prodi');
        $this->db->from('jabatan_sdm');
        $this->db->join('sdm', 'sdm.id = jabatan_sdm.sdm_id', 'LEFT');
        $this->db->join('jurusan', 'jurusan.id = jabatan_sdm.jurusan_id', 'LEFT');
        $this->db->join('prodi', 'prodi.id = jabatan_sdm.prodi_id', 'LEFT');
        $this->db->order_by('jabatan_sdm.id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    // Get struktur organisasi
    public function get_struktur_organisasi($year = null)
    {
        if ($year === null) {
            $year = date('Y');
        }

        $struktur = array(
            'institusi' => array(),
            'jurusan' => array(),
            'prodi' => array()
        );

        // Level Institusi
        $institusi = $this->by_level('institusi');
        foreach ($institusi as $jabatan) {
            if ($jabatan->periode_mulai <= $year && $jabatan->periode_akhir >= $year) {
                $struktur['institusi'][] = $jabatan;
            }
        }

        // Level Jurusan
        $this->db->select('jabatan_sdm.*, sdm.nama as nama_sdm, sdm.foto_url, jurusan.nama as nama_jurusan');
        $this->db->from('jabatan_sdm');
        $this->db->join('sdm', 'sdm.id = jabatan_sdm.sdm_id', 'LEFT');
        $this->db->join('jurusan', 'jurusan.id = jabatan_sdm.jurusan_id', 'LEFT');
        $this->db->where('jabatan_sdm.level', 'jurusan');
        $this->db->where('jabatan_sdm.periode_mulai <=', $year);
        $this->db->where('jabatan_sdm.periode_akhir >=', $year);
        $this->db->order_by('jurusan.nama', 'ASC');
        $jurusan_data = $this->db->get()->result();

        foreach ($jurusan_data as $jabatan) {
            if (!isset($struktur['jurusan'][$jabatan->jurusan_id])) {
                $struktur['jurusan'][$jabatan->jurusan_id] = array(
                    'nama_jurusan' => $jabatan->nama_jurusan,
                    'jabatan' => array()
                );
            }
            $struktur['jurusan'][$jabatan->jurusan_id]['jabatan'][] = $jabatan;
        }

        // Level Prodi
        $this->db->select('jabatan_sdm.*, sdm.nama as nama_sdm, sdm.foto_url, 
                          prodi.nama as nama_prodi, jurusan.nama as nama_jurusan');
        $this->db->from('jabatan_sdm');
        $this->db->join('sdm', 'sdm.id = jabatan_sdm.sdm_id', 'LEFT');
        $this->db->join('prodi', 'prodi.id = jabatan_sdm.prodi_id', 'LEFT');
        $this->db->join('jurusan', 'jurusan.id = prodi.jurusan_id', 'LEFT');
        $this->db->where('jabatan_sdm.level', 'prodi');
        $this->db->where('jabatan_sdm.periode_mulai <=', $year);
        $this->db->where('jabatan_sdm.periode_akhir >=', $year);
        $this->db->order_by('prodi.nama', 'ASC');
        $prodi_data = $this->db->get()->result();

        foreach ($prodi_data as $jabatan) {
            if (!isset($struktur['prodi'][$jabatan->prodi_id])) {
                $struktur['prodi'][$jabatan->prodi_id] = array(
                    'nama_prodi' => $jabatan->nama_prodi,
                    'nama_jurusan' => $jabatan->nama_jurusan,
                    'jabatan' => array()
                );
            }
            $struktur['prodi'][$jabatan->prodi_id]['jabatan'][] = $jabatan;
        }

        return $struktur;
    }

    // Get statistik jabatan
    public function get_statistics()
    {
        $stats = array();

        // Count by level
        $this->db->select('level, COUNT(*) as jumlah');
        $this->db->from('jabatan_sdm');
        $this->db->group_by('level');
        $stats['by_level'] = $this->db->get()->result();

        // Count active jabatan
        $year = date('Y');
        $this->db->where('periode_mulai <=', $year);
        $this->db->where('periode_akhir >=', $year);
        $stats['active_count'] = $this->db->count_all_results('jabatan_sdm');

        // Count expired jabatan
        $this->db->where('periode_akhir <', $year);
        $stats['expired_count'] = $this->db->count_all_results('jabatan_sdm');

        return $stats;
    }

    // Update batch data
    public function update_batch($data, $key)
    {
        return $this->db->update_batch('jabatan_sdm', $data, $key);
    }

    // Get riwayat jabatan SDM
    public function get_riwayat_jabatan($sdm_id)
    {
        $this->db->select('jabatan_sdm.*, jurusan.nama as nama_jurusan, prodi.nama as nama_prodi');
        $this->db->from('jabatan_sdm');
        $this->db->join('jurusan', 'jurusan.id = jabatan_sdm.jurusan_id', 'LEFT');
        $this->db->join('prodi', 'prodi.id = jabatan_sdm.prodi_id', 'LEFT');
        $this->db->where('jabatan_sdm.sdm_id', $sdm_id);
        $this->db->order_by('jabatan_sdm.periode_mulai', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Menampilkan SDM dengan jabatan Direktur yang aktif pada tahun tertentu
    public function direktur_aktif($year = null)
    {
        if ($year === null) {
            $year = date('Y');
        }
        $this->db->select('jabatan_sdm.*, sdm.nama as nama_sdm, sdm.nip, sdm.email, sdm.no_hp, sdm.foto_url, sdm.slug');
        $this->db->from('jabatan_sdm');
        $this->db->join('sdm', 'sdm.id = jabatan_sdm.sdm_id', 'LEFT');
        $this->db->where('jabatan_sdm.jabatan', 'Direktur');
        $this->db->where('jabatan_sdm.periode_mulai <=', $year);
        $this->db->where('jabatan_sdm.periode_akhir >=', $year);
        $this->db->order_by('jabatan_sdm.periode_mulai', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function wakil_direktur_aktif($year = null)
    {
        if ($year === null) {
            $year = date('Y');
        }
        $this->db->select('jabatan_sdm.*, sdm.nama as nama_sdm, sdm.nip, sdm.email, sdm.no_hp, sdm.foto_url, sdm.slug');
        $this->db->from('jabatan_sdm');
        $this->db->join('sdm', 'sdm.id = jabatan_sdm.sdm_id', 'LEFT');
        $this->db->where_in('jabatan_sdm.jabatan', [
            'Wakil Direktur I',
            'Wakil Direktur II',
            'Wakil Direktur III'
        ]);
        $this->db->where('jabatan_sdm.periode_mulai <=', $year);
        $this->db->where('jabatan_sdm.periode_akhir >=', $year);
        $this->db->order_by('jabatan_sdm.periode_mulai', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Semua data SDM Kecuali Direktur dan Wakil Direktur
    public function all($year = null)
    {
        if ($year === null) {
            $year = date('Y');
        }
        $this->db->select('jabatan_sdm.*, sdm.nama as nama_sdm, sdm.nip, sdm.email, sdm.no_hp, sdm.foto_url, sdm.slug');
        $this->db->from('jabatan_sdm');
        $this->db->join('sdm', 'sdm.id = jabatan_sdm.sdm_id', 'LEFT');
        $this->db->where_not_in('jabatan_sdm.jabatan', [
            'Direktur',
            'Wakil Direktur I',
            'Wakil Direktur II',
            'Wakil Direktur III'
        ]);
        $this->db->where('jabatan_sdm.periode_mulai <=', $year);
        $this->db->where('jabatan_sdm.periode_akhir >=', $year);
        $this->db->order_by('jabatan_sdm.periode_mulai', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file Jabatansdm_model.php */
/* Location: ./application/models/Jabatansdm_model.php */