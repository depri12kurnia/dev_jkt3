<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_download_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    // Listing data
    public function listing()
    {
        $this->db->select('jenis_download.*, kategori_download.nama_kategori_download');
        $this->db->from('jenis_download');
        // Join dg 1 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = jenis_download.id_subkategori_download', 'LEFT');
        // End join
        $this->db->order_by('nama_jenis_download', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Detail data
    public function detail($id_jenis_download)
    {
        $this->db->select('jenis_download.*, kategori_download.nama_kategori_download');
        $this->db->from('jenis_download');
        // Join dg 1 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = jenis_download.id_subkategori_download', 'LEFT');
        // End Join
        $this->db->where('id_jenis_download', $id_jenis_download);
        $this->db->order_by('id_jenis_download', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    public function get_subkategori_download($id_kategori_download)
    {
        $this->db->select('jenis_download.*, kategori_download.nama_kategori_download, kategori_download.slug_kategori_download');
        $this->db->from('jenis_download');
        // Join
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = jenis_download.id_subkategori_download');
        // End Join
        $this->db->where(array('jenis_download', 'kategori_download.id_kategori_download' => $id_kategori_download));
        $this->db->order_by('nama_kategori_download', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_kategori()
    {
        $this->db->select('*');
        $this->db->from('kategori_download');
        $this->db->order_by('id_kategori_download', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    // Detail data
    public function read($slug_jenis_download)
    {
        $this->db->select('jenis_download.*, kategori_download.nama_kategori_download');
        $this->db->from('jenis_download');
        // Join dg 1 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = jenis_download.id_subkategori_download', 'LEFT');
        // End Join
        $this->db->where('slug_jenis_download', $slug_jenis_download);
        $query = $this->db->get();
        return $query->row();
    }

    // Tambah
    public function tambah($data)
    {
        $this->db->insert('jenis_download', $data);
    }

    // Edit
    public function edit($data)
    {
        $this->db->where('id_jenis_download', $data['id_jenis_download']);
        $this->db->update('jenis_download', $data);
    }

    // Delete
    public function delete($data)
    {
        $this->db->where('id_jenis_download', $data['id_jenis_download']);
        $this->db->delete('jenis_download', $data);
    }
}

/* End of file jenis_download_model.php */
/* Location: ./application/models/jenis_download_model.php */
