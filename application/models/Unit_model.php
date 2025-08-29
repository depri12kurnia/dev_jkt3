<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit_model extends CI_Model
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
        $this->db->from('unit');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Jumlah total data
    public function jumlah()
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('unit');
        $query = $this->db->get();
        return $query->row();
    }

    // Listing untuk homepage
    public function home()
    {
        $this->db->select('*');
        $this->db->from('unit');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Detail data berdasarkan ID
    public function detail($id)
    {
        $this->db->select('*');
        $this->db->from('unit');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    // Detail data berdasarkan slug
    public function detail_by_slug($slug)
    {
        $this->db->select('*');
        $this->db->from('unit');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        return $query->row();
    }

    // Check apakah slug sudah ada (untuk validasi)
    public function check_slug($slug, $id = null)
    {
        $this->db->from('unit');
        $this->db->where('slug', $slug);

        if ($id !== null) {
            $this->db->where('id !=', $id);
        }

        return $this->db->count_all_results() > 0;
    }

    // Generate slug unik
    public function generate_slug($nama, $id = null)
    {
        $this->load->helper('text');
        $slug = url_title($nama, 'dash', TRUE);
        $original_slug = $slug;
        $counter = 1;

        while ($this->check_slug($slug, $id)) {
            $slug = $original_slug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    // Tambah data
    public function tambah($data)
    {
        if (empty($data['slug']) && !empty($data['nama'])) {
            $data['slug'] = $this->generate_slug($data['nama']);
        }

        if (empty($data['created_at'])) {
            $data['created_at'] = date('Y-m-d H:i:s');
        }

        return $this->db->insert('unit', $data);
    }

    // Edit data
    public function edit($data)
    {
        $id = $data['id'];

        if (!empty($data['nama'])) {
            $data['slug'] = $this->generate_slug($data['nama'], $id);
        }

        unset($data['id']);

        $this->db->where('id', $id);
        return $this->db->update('unit', $data);
    }

    // Delete data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        return $this->db->delete('unit');
    }

    // Search unit berdasarkan nama/deskripsi
    public function search($keyword)
    {
        $this->db->select('*');
        $this->db->from('unit');
        $this->db->like('nama', $keyword);
        $this->db->or_like('deskripsi', $keyword);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing dengan pagination
    public function listing_paginated($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('unit');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    // Listing untuk dropdown/select option
    public function dropdown()
    {
        $this->db->select('id, nama');
        $this->db->from('unit');
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get();

        $dropdown = array();
        $dropdown[''] = 'Pilih Unit';

        foreach ($query->result() as $row) {
            $dropdown[$row->id] = $row->nama;
        }

        return $dropdown;
    }

    // Get unit terbaru
    public function get_latest($limit = 5)
    {
        $this->db->select('*');
        $this->db->from('unit');
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }

    // Validasi data sebelum insert/update
    public function validate_data($data, $id = null)
    {
        $errors = array();

        if (empty($data['nama'])) {
            $errors[] = 'Nama unit harus diisi';
        } elseif (strlen($data['nama']) > 100) {
            $errors[] = 'Nama unit maksimal 100 karakter';
        }

        if (!empty($data['slug'])) {
            if (strlen($data['slug']) > 100) {
                $errors[] = 'Slug maksimal 100 karakter';
            }
            if ($this->check_slug($data['slug'], $id)) {
                $errors[] = 'Slug sudah digunakan';
            }
        }

        return $errors;
    }

    // Update multiple records
    public function update_batch($data, $key)
    {
        return $this->db->update_batch('unit', $data, $key);
    }

    // Get unit by slug
    public function get_by_slug($slug)
    {
        $this->db->select('*');
        $this->db->from('unit');
        $this->db->where('slug', $slug);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    // Get all unit for listing
    public function get_all_unit()
    {
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get('unit');
        return $query->result();
    }

    /**
     * Check if unit exists by slug
     */
    public function unit_exists($slug)
    {
        $this->db->where('slug', $slug);
        $this->db->where('status', 'aktif');
        $query = $this->db->get('unit');
        return $query->num_rows() > 0;
    }
}
