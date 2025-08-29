<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Magazine_model extends CI_Model
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
        $this->db->from('magazine');
        $this->db->order_by('tanggal', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing data
    public function dasbor()
    {
        $this->db->select('*');
        $this->db->from('magazine');
        $this->db->order_by('id_magazine', 'DESC');
        $this->db->limit(20);
        $query = $this->db->get();
        return $query->result();
    }

    // Listing data
    public function bulanan($bulan)
    {
        $this->db->select('*');
        $this->db->from('magazine');
        $this->db->where('DATE_FORMAT(magazine.tanggal,"%Y-%m")', $bulan);
        $this->db->order_by('hits', 'DESC');
        $this->db->limit(20);
        $query = $this->db->get();
        return $query->result();
    }

    // Listing data
    public function tahunan($tahun)
    {
        $this->db->select('*');
        $this->db->from('magazine');
        $this->db->where('DATE_FORMAT(magazine.tanggal,"%Y")', $tahun);
        $this->db->order_by('hits', 'DESC');
        $this->db->limit(20);
        $query = $this->db->get();
        return $query->result();
    }

    // Kunjungan magazine teramai
    public function populer()
    {
        $this->db->select('*');
        $this->db->from('magazine');
        $this->db->where(array('magazine.status_magazine' => 'Publish'));
        $this->db->order_by('hits', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
    }

    // Kunjungan magazine teramai
    public function pengumuman()
    {
        $this->db->select('*');
        $this->db->from('magazine');
        $this->db->where('status_magazine', 'Publish');
        $this->db->order_by('hits', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
    }

    // Kunjungan magazine teramai
    public function hits()
    {
        $this->db->select('*');
        $this->db->from('magazine');
        $this->db->order_by('hits', 'DESC');
        $this->db->limit(10000);
        $query = $this->db->get();
        return $query->result();
    }

    // Listing jurusan
    public function jurusan_admin($id_jurusan)
    {
        $this->db->select('*');
        $this->db->from('magazine');
        $this->db->where(array('magazine.id_jurusan' => $id_jurusan));
        $this->db->order_by('id_magazine', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing status
    public function status_admin($status_magazine)
    {
        $this->db->select('*');
        $this->db->from('magazine');
        $this->db->where(array('magazine.status_magazine' => $status_magazine));
        $this->db->order_by('id_magazine', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing author
    public function author_admin($id_user)
    {
        $this->db->select('*');
        $this->db->from('magazine');
        $this->db->where(array('magazine.id_user' => $id_user));
        $this->db->order_by('id_magazine', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing jurusan
    public function jurusan($id_jurusan, $limit, $start)
    {
        $this->db->select('*');
        $this->db->from('magazine');
        $this->db->where(array(
            'magazine.id_jurusan' => $id_jurusan,
            'magazine.status_magazine' => 'Publish'
        ));
        $this->db->order_by('id_magazine', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    // Listing jurusan
    public function all_jurusan($id_jurusan)
    {
        $this->db->select('*');
        $this->db->from('magazine');
        $this->db->where(array(
            'magazine.id_jurusan' => $id_jurusan,
            'magazine.status_magazine' => 'Publish'
        ));
        $this->db->order_by('id_magazine', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing magazine
    public function magazine($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('magazine');
        $this->db->where(array(
            'magazine.status_magazine' => 'Publish'
        ));
        $this->db->order_by('magazine.tanggal', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    // Listing total
    public function total()
    {
        $this->db->select('*');
        $this->db->from('magazine');
        $this->db->where(array(
            'magazine.status_magazine' => 'Publish'
        ));
        $this->db->order_by('id_magazine', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing magazine
    public function search($keywords, $limit, $start)
    {
        $this->db->select('*');
        $this->db->from('magazine');
        $this->db->where(array(
            'magazine.status_magazine' => 'Publish'
        ));
        $this->db->like('magazine.judul_magazine', $keywords);
        $this->db->or_like('magazine.isi', $keywords);
        $this->db->group_by('id_magazine');
        $this->db->order_by('id_magazine', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    // Listing total
    public function total_search($keywords)
    {
        $this->db->select('*');
        $this->db->from('magazine');
        $this->db->where(array(
            'magazine.status_magazine' => 'Publish'
        ));
        $this->db->like('magazine.judul_magazine', $keywords);
        $this->db->or_like('magazine.isi', $keywords);
        $this->db->group_by('id_magazine');
        $this->db->order_by('id_magazine', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing read
    public function listing_read()
    {
        $this->db->select('*');
        $this->db->from('magazine');
        $this->db->where(array(
            'magazine.status_magazine' => 'Publish'
        ));
        $this->db->order_by('id_magazine', 'DESC');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result();
    }

    // Listing profil
    public function listing_profil()
    {
        $this->db->select('*');
        $this->db->from('magazine');
        $this->db->where(array(
            'magazine.status_magazine' => 'Publish'
        ));
        $this->db->order_by('id_magazine', 'DESC');
        $this->db->limit(20);
        $query = $this->db->get();
        return $query->result();
    }

    // Listing Jurusan
    public function listing_jurusan()
    {
        $this->db->select('*');
        $this->db->from('magazine');
        $this->db->where(array(
            'magazine.status_magazine' => 'Publish'
        ));
        $this->db->order_by('id_magazine', 'DESC');
        $this->db->limit(20);
        $query = $this->db->get();
        return $query->result();
    }

    // Listing layanan
    public function listing_layanan()
    {
        $this->db->select('*');
        $this->db->from('magazine');
        $this->db->where(array(
            'magazine.status_magazine' => 'Publish'
        ));
        $this->db->order_by('id_magazine', 'DESC');
        $this->db->limit(20);
        $query = $this->db->get();
        return $query->result();
    }

    // Listing headline
    public function listing_headline()
    {
        $this->db->select('*');
        $this->db->from('magazine');
        $this->db->where(array(
            'magazine.status_magazine' => 'Publish'
        ));
        $this->db->order_by('id_magazine', 'DESC');
        $this->db->limit(9);
        $query = $this->db->get();
        return $query->result();
    }

    // Read data
    public function read($slug_magazine)
    {
        $this->db->select('*');
        $this->db->from('magazine');
        $this->db->where('slug_magazine', $slug_magazine);
        $this->db->order_by('id_magazine', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    // Detail data
    public function detail($id_magazine)
    {
        $this->db->select('*');
        $this->db->from('magazine');
        $this->db->where('id_magazine', $id_magazine);
        $this->db->order_by('id_magazine', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    // Tambah
    public function tambah($data)
    {
        $this->db->insert('magazine', $data);
    }

    // Edit
    public function edit($data)
    {
        $this->db->where('id_magazine', $data['id_magazine']);
        $this->db->update('magazine', $data);
    }

    // Edit hit
    public function update_hit($hit)
    {
        $this->db->where('id_magazine', $hit['id_magazine']);
        $this->db->update('magazine', $hit);
    }

    // Delete
    public function delete($data)
    {
        $this->db->where('id_magazine', $data['id_magazine']);
        $this->db->delete('magazine', $data);
    }
}

/* End of file magazine_model.php */
/* Location: ./application/models/magazine_model.php */