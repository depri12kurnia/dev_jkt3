<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testimoni_model extends CI_Model
{

    private $table = 'testimoni';

    public function __construct()
    {
        parent::__construct();
    }

    // Get all testimoni with optional filters
    public function get_all($filters = array())
    {
        if (!empty($filters['status'])) {
            $this->db->where('status', $filters['status']);
        }
        if (!empty($filters['role'])) {
            $this->db->where('role', $filters['role']);
        }
        if (!empty($filters['search'])) {
            $this->db->group_start();
            $this->db->like('nama', $filters['search']);
            $this->db->or_like('asal_prodi', $filters['search']);
            $this->db->or_like('isi', $filters['search']);
            $this->db->group_end();
        }

        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table)->result();
    }

    // Get testimoni with pagination
    public function get_all_paginated($limit, $offset, $filters = array())
    {
        if (!empty($filters['status'])) {
            $this->db->where('status', $filters['status']);
        }
        if (!empty($filters['role'])) {
            $this->db->where('role', $filters['role']);
        }
        if (!empty($filters['search'])) {
            $this->db->group_start();
            $this->db->like('nama', $filters['search']);
            $this->db->or_like('asal_prodi', $filters['search']);
            $this->db->or_like('isi', $filters['search']);
            $this->db->group_end();
        }

        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get($this->table)->result();
    }

    // Count total records for pagination
    public function count_all($filters = array())
    {
        if (!empty($filters['status'])) {
            $this->db->where('status', $filters['status']);
        }
        if (!empty($filters['role'])) {
            $this->db->where('role', $filters['role']);
        }
        if (!empty($filters['search'])) {
            $this->db->group_start();
            $this->db->like('nama', $filters['search']);
            $this->db->or_like('asal_prodi', $filters['search']);
            $this->db->or_like('isi', $filters['search']);
            $this->db->group_end();
        }

        return $this->db->count_all_results($this->table);
    }

    // Get single testimoni by ID
    public function get_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table)->row();
    }

    // Insert new testimoni
    public function insert($data)
    {
        // Validate required fields
        $required_fields = ['nama', 'asal_prodi', 'isi'];
        foreach ($required_fields as $field) {
            if (empty($data[$field])) {
                return false;
            }
        }

        // Set default values
        if (!isset($data['role'])) {
            $data['role'] = 'umum';
        }
        if (!isset($data['status'])) {
            $data['status'] = 'pending';
        }

        return $this->db->insert($this->table, $data);
    }

    // Update testimoni
    public function update($id, $data)
    {
        // Remove id from data if present
        if (isset($data['id'])) {
            unset($data['id']);
        }

        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // Delete testimoni
    public function delete($id)
    {
        // Get testimoni data before deletion (for file cleanup)
        $testimoni = $this->get_by_id($id);

        $this->db->where('id', $id);
        $result = $this->db->delete($this->table);

        // Delete associated file if exists
        if ($result && $testimoni && !empty($testimoni->foto)) {
            $file_path = FCPATH . 'assets/images/testimoni/' . $testimoni->foto;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        return $result;
    }

    // Bulk delete testimoni
    public function bulk_delete($ids)
    {
        if (empty($ids) || !is_array($ids)) {
            return false;
        }

        // Get testimoni data for file cleanup
        $this->db->where_in('id', $ids);
        $testimoni_list = $this->db->get($this->table)->result();

        $this->db->where_in('id', $ids);
        $result = $this->db->delete($this->table);

        // Delete associated files
        if ($result && $testimoni_list) {
            foreach ($testimoni_list as $testimoni) {
                if (!empty($testimoni->foto)) {
                    $file_path = FCPATH . 'assets/images/testimoni/' . $testimoni->foto;
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }
            }
        }

        return $result;
    }

    // Update status
    public function update_status($id, $status)
    {
        $allowed_status = ['pending', 'publish', 'rejected'];
        if (!in_array($status, $allowed_status)) {
            return false;
        }

        $this->db->where('id', $id);
        return $this->db->update($this->table, ['status' => $status]);
    }

    // Bulk update status
    public function bulk_update_status($ids, $status)
    {
        if (empty($ids) || !is_array($ids)) {
            return false;
        }

        $allowed_status = ['pending', 'publish', 'rejected'];
        if (!in_array($status, $allowed_status)) {
            return false;
        }

        $this->db->where_in('id', $ids);
        return $this->db->update($this->table, ['status' => $status]);
    }

    // Get published testimoni for public view
    public function get_published($limit = null)
    {
        $this->db->where('status', 'publish');
        $this->db->order_by('created_at', 'DESC');

        if ($limit) {
            $this->db->limit($limit);
        }

        return $this->db->get($this->table)->result();
    }

    // Get testimoni statistics
    public function get_statistics()
    {
        $stats = array();

        // Count by status
        $this->db->select('status, COUNT(*) as count');
        $this->db->group_by('status');
        $status_stats = $this->db->get($this->table)->result();

        foreach ($status_stats as $stat) {
            $stats['status'][$stat->status] = $stat->count;
        }

        // Count by role
        $this->db->select('role, COUNT(*) as count');
        $this->db->group_by('role');
        $role_stats = $this->db->get($this->table)->result();

        foreach ($role_stats as $stat) {
            $stats['role'][$stat->role] = $stat->count;
        }

        // Total count
        $stats['total'] = $this->db->count_all($this->table);

        return $stats;
    }

    // Check if testimoni exists
    public function exists($id)
    {
        $this->db->where('id', $id);
        return $this->db->count_all_results($this->table) > 0;
    }

    // Get role options
    public function get_role_options()
    {
        return [
            'mahasiswa' => 'Mahasiswa',
            'alumni' => 'Alumni',
            'dosen' => 'Dosen',
            'staff' => 'Staff',
            'umum' => 'Umum'
        ];
    }

    // Get status options
    public function get_status_options()
    {
        return [
            'pending' => 'Pending',
            'publish' => 'Publish',
            'rejected' => 'Rejected'
        ];
    }

    // untuk di tampilkan di halaman depan
    public function get_testimoni_home($limit = 5)
    {
        $this->db->where('status', 'publish');
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get($this->table)->result();
    }
}
