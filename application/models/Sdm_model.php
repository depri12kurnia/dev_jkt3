<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sdm_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Listing data
    public function listing()
    {
        $this->db->select('*');
        $this->db->from('sdm');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Jumlah total data
    public function jumlah()
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('sdm');
        $query = $this->db->get();
        return $query->row();
    }

    // Listing untuk homepage
    public function home()
    {
        $this->db->select('*');
        $this->db->from('sdm');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Detail data berdasarkan ID
    public function detail($id)
    {
        $this->db->select('*');
        $this->db->from('sdm');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    // Detail data berdasarkan NIP
    public function detail_by_nip($nip)
    {
        $this->db->select('*');
        $this->db->from('sdm');
        $this->db->where('nip', $nip);
        $query = $this->db->get();
        return $query->row();
    }

    // Check apakah NIP sudah ada (untuk validasi)
    public function check_nip($nip, $id = null)
    {
        $this->db->from('sdm');
        $this->db->where('nip', $nip);

        // Jika edit, exclude ID yang sedang diedit
        if ($id !== null) {
            $this->db->where('id !=', $id);
        }

        return $this->db->count_all_results() > 0;
    }

    // Check apakah email sudah ada (untuk validasi)
    public function check_email($email, $id = null)
    {
        $this->db->from('sdm');
        $this->db->where('email', $email);

        // Jika edit, exclude ID yang sedang diedit
        if ($id !== null) {
            $this->db->where('id !=', $id);
        }

        return $this->db->count_all_results() > 0;
    }

    // Validasi data sebelum insert/update
    public function validate_data($data, $id = null)
    {
        $errors = array();

        // Validasi nama
        if (empty($data['nama'])) {
            $errors[] = 'Nama harus diisi';
        } elseif (strlen($data['nama']) > 100) {
            $errors[] = 'Nama maksimal 100 karakter';
        }

        // Validasi NIP
        if (!empty($data['nip'])) {
            if (strlen($data['nip']) > 50) {
                $errors[] = 'NIP maksimal 50 karakter';
            }

            // Check unique NIP
            if ($this->check_nip($data['nip'], $id)) {
                $errors[] = 'NIP sudah digunakan';
            }
        }

        // Validasi jenis kelamin
        if (!empty($data['jenis_kelamin'])) {
            if (!in_array($data['jenis_kelamin'], array('L', 'P'))) {
                $errors[] = 'Jenis kelamin harus L atau P';
            }
        }

        // Validasi email
        if (!empty($data['email'])) {
            if (strlen($data['email']) > 100) {
                $errors[] = 'Email maksimal 100 karakter';
            }

            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Format email tidak valid';
            }

            // Check unique email
            if ($this->check_email($data['email'], $id)) {
                $errors[] = 'Email sudah digunakan';
            }
        }

        // Validasi no_hp
        if (!empty($data['no_hp'])) {
            if (strlen($data['no_hp']) > 20) {
                $errors[] = 'Nomor HP maksimal 20 karakter';
            }

            // Validasi format nomor HP (optional, sesuaikan dengan kebutuhan)
            if (!preg_match('/^[0-9+\-\s()]+$/', $data['no_hp'])) {
                $errors[] = 'Format nomor HP tidak valid';
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

        $result = $this->db->insert('sdm', $data);

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
        $result = $this->db->update('sdm', $data);

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
        return $this->db->delete('sdm');
    }

    // Search SDM berdasarkan nama, NIP, atau email
    public function search($keyword)
    {
        $this->db->select('*');
        $this->db->from('sdm');
        $this->db->like('nama', $keyword);
        $this->db->or_like('nip', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing dengan pagination
    public function listing_paginated($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('sdm');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    // Listing untuk dropdown/select option
    public function dropdown()
    {
        $this->db->select('id, nama');
        $this->db->from('sdm');
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get();

        $dropdown = array();
        $dropdown[''] = 'Pilih SDM';

        foreach ($query->result() as $row) {
            $dropdown[$row->id] = $row->nama;
        }

        return $dropdown;
    }

    // Filter berdasarkan jenis kelamin
    public function by_gender($jenis_kelamin)
    {
        $this->db->select('*');
        $this->db->from('sdm');
        $this->db->where('jenis_kelamin', $jenis_kelamin);
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Count berdasarkan jenis kelamin
    public function count_by_gender($jenis_kelamin)
    {
        $this->db->from('sdm');
        $this->db->where('jenis_kelamin', $jenis_kelamin);
        return $this->db->count_all_results();
    }

    // Get statistik gender
    public function get_gender_statistics()
    {
        $this->db->select('jenis_kelamin, COUNT(*) as jumlah');
        $this->db->from('sdm');
        $this->db->group_by('jenis_kelamin');
        $query = $this->db->get();
        return $query->result();
    }

    // Get SDM dengan foto
    public function with_photo()
    {
        $this->db->select('*');
        $this->db->from('sdm');
        $this->db->where('foto_url IS NOT NULL');
        $this->db->where('foto_url !=', '');
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Get SDM tanpa foto
    public function without_photo()
    {
        $this->db->select('*');
        $this->db->from('sdm');
        $this->db->where('(foto_url IS NULL OR foto_url = "")');
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Update foto
    public function update_foto($id, $foto_url)
    {
        $data = array('foto_url' => $foto_url);
        $this->db->where('id', $id);
        return $this->db->update('sdm', $data);
    }

    // Delete foto
    public function delete_foto($id)
    {
        $data = array('foto_url' => null);
        $this->db->where('id', $id);
        return $this->db->update('sdm', $data);
    }

    // Advanced search dengan filter
    public function advanced_search($filters)
    {
        $this->db->select('*');
        $this->db->from('sdm');

        // Filter nama
        if (!empty($filters['nama'])) {
            $this->db->like('nama', $filters['nama']);
        }

        // Filter NIP
        if (!empty($filters['nip'])) {
            $this->db->like('nip', $filters['nip']);
        }

        // Filter jenis kelamin
        if (!empty($filters['jenis_kelamin'])) {
            $this->db->where('jenis_kelamin', $filters['jenis_kelamin']);
        }

        // Filter email
        if (!empty($filters['email'])) {
            $this->db->like('email', $filters['email']);
        }

        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Count advanced search
    public function count_advanced_search($filters)
    {
        $this->db->from('sdm');

        if (!empty($filters['nama'])) {
            $this->db->like('nama', $filters['nama']);
        }

        if (!empty($filters['nip'])) {
            $this->db->like('nip', $filters['nip']);
        }

        if (!empty($filters['jenis_kelamin'])) {
            $this->db->where('jenis_kelamin', $filters['jenis_kelamin']);
        }

        if (!empty($filters['email'])) {
            $this->db->like('email', $filters['email']);
        }

        return $this->db->count_all_results();
    }

    // Update batch data
    public function update_batch($data, $key)
    {
        return $this->db->update_batch('sdm', $data, $key);
    }

    // Import data dari CSV/Excel
    public function import_batch($data_array)
    {
        $success = 0;
        $errors = array();

        foreach ($data_array as $index => $data) {
            // Validasi setiap baris
            $validation_errors = $this->validate_data($data);

            if (empty($validation_errors)) {
                if ($this->db->insert('sdm', $data)) {
                    $success++;
                } else {
                    $errors[] = "Baris " . ($index + 1) . ": Gagal menyimpan data";
                }
            } else {
                $errors[] = "Baris " . ($index + 1) . ": " . implode(', ', $validation_errors);
            }
        }

        return array(
            'success' => $success,
            'errors' => $errors,
            'total' => count($data_array)
        );
    }

    // Get random SDM (untuk testimonial, dll)
    public function get_random($limit = 5)
    {
        $this->db->select('*');
        $this->db->from('sdm');
        $this->db->order_by('RAND()');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }

    // Soft delete (jika ingin implementasi soft delete)
    public function soft_delete($id)
    {
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s')
        );

        $this->db->where('id', $id);
        return $this->db->update('sdm', $data);
    }
}

/* End of file Sdm_model.php */
/* Location: ./application/models/Sdm_model.php */