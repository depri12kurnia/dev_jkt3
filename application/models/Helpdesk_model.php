<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Helpdesk_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Listing data
    public function listing()
    {
        $this->db->select('helpdesk.*, kategori_helpdesk.nama_kategori_helpdesk, users.nama');
        $this->db->from('helpdesk');
        // Join dg 2 tabel
        $this->db->join('kategori_helpdesk', 'kategori_helpdesk.id_kategori_helpdesk = helpdesk.id_kategori_helpdesk', 'LEFT');
        $this->db->join('users', 'users.id_user = helpdesk.id_user', 'LEFT');
        // End join
        $this->db->order_by('id_helpdesk', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing data
    public function populer()
    {
        $this->db->select('*');
        $this->db->from('helpdesk');
        $this->db->order_by('hits', 'DESC');
        $this->db->limit(20);
        $query = $this->db->get();
        return $query->result();
    }

    // Listing data helpdesk
    public function helpdesk()
    {
        $this->db->select('helpdesk.*, kategori_helpdesk.nama_kategori_helpdesk, users.nama, kategori_helpdesk.slug_kategori_helpdesk');
        $this->db->from('helpdesk');
        // Join dg 2 tabel
        $this->db->join('kategori_helpdesk', 'kategori_helpdesk.id_kategori_helpdesk = helpdesk.id_kategori_helpdesk', 'LEFT');
        $this->db->join('users', 'users.id_user = helpdesk.id_user', 'LEFT');
        // End join
        $this->db->where('id_helpdesk', 'helpdesk');
        $this->db->order_by('id_helpdesk', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Kategori
    public function kategori()
    {
        $this->db->select('*');
        $this->db->from('kategori_helpdesk');
        $this->db->order_by('id_kategori_helpdesk', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Detail data
    public function detail($id_helpdesk)
    {
        $this->db->select('*');
        $this->db->from('helpdesk');
        $this->db->where('id_helpdesk', $id_helpdesk);
        $this->db->order_by('id_helpdesk', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    // Read data
    public function read($slug_helpdesk)
    {
        $this->db->select('helpdesk.*, kategori_helpdesk.nama_kategori_helpdesk, users.nama');
        $this->db->from('helpdesk');
        // Join dg 2 tabel
        $this->db->join('kategori_helpdesk', 'kategori_helpdesk.id_kategori_helpdesk = helpdesk.id_kategori_helpdesk', 'LEFT');
        $this->db->join('users', 'users.id_user = helpdesk.id_user', 'LEFT');
        $this->db->where('id_helpdesk', $slug_helpdesk);
        $this->db->order_by('id_helpdesk', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    public function get_subkategori_download($id_kategori_helpdesk)
    {
        $this->db->select('*');
        $this->db->from('kategori_helpdesk');

        $this->db->where(array('kategori_helpdesk' => $id_kategori_helpdesk));
        $this->db->order_by('nama_kategori_helpdesk', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // crud
    // Tambah
    public function tambah($data)
    {
        $this->db->insert('helpdesk', $data);
    }

    // Edit
    public function edit($data)
    {
        $this->db->where('id_helpdesk', $data['id_helpdesk']);
        $this->db->update('helpdesk', $data);
    }

    // Edit
    public function edit2($data2)
    {
        $this->db->where('id_helpdesk', $data2['id_helpdesk']);
        $this->db->update('helpdesk', $data2);
    }

    // Delete
    public function delete($data)
    {
        $this->db->where('id_helpdesk', $data['id_helpdesk']);
        $this->db->delete('helpdesk', $data);
    }

    // =========== Listing data by Kategori ======================
    public function listingAkademikKemahasiswaan()
    {
        $this->db->select('helpdesk.*, kategori_helpdesk.nama_kategori_helpdesk, users.nama');
        $this->db->from('helpdesk');
        // Join dg 2 tabel
        $this->db->join('kategori_helpdesk', 'kategori_helpdesk.id_kategori_helpdesk = helpdesk.id_kategori_helpdesk', 'LEFT');
        $this->db->join('users', 'users.id_user = helpdesk.id_user', 'LEFT');
        // End join
        $this->db->like('nama_kategori_helpdesk', 'ADAK');
        $this->db->order_by('urutan', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function listingSdm()
    {
        $this->db->select('helpdesk.*, kategori_helpdesk.nama_kategori_helpdesk, users.nama');
        $this->db->from('helpdesk');
        // Join dg 2 tabel
        $this->db->join('kategori_helpdesk', 'kategori_helpdesk.id_kategori_helpdesk = helpdesk.id_kategori_helpdesk', 'LEFT');
        $this->db->join('users', 'users.id_user = helpdesk.id_user', 'LEFT');
        // End join
        $this->db->like('nama_kategori_helpdesk', 'SDM');
        $this->db->order_by('urutan', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function listingItsarpras()
    {
        $this->db->select('helpdesk.*, kategori_helpdesk.nama_kategori_helpdesk, users.nama');
        $this->db->from('helpdesk');
        // Join dg 2 tabel
        $this->db->join('kategori_helpdesk', 'kategori_helpdesk.id_kategori_helpdesk = helpdesk.id_kategori_helpdesk', 'LEFT');
        $this->db->join('users', 'users.id_user = helpdesk.id_user', 'LEFT');
        // End join
        $this->db->like('nama_kategori_helpdesk', 'IT & Sarpras');
        $this->db->order_by('urutan', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file helpdesk_model.php */
/* Location: ./application/models/helpdesk_model.php */
