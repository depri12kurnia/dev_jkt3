<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function jumlah()
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('kategori');
		$query = $this->db->get();
		return $query->row();
	}

	// Listing data
	public function list_side()
	{
		$this->db->select('kategori.id_kategori, kategori.nama_kategori, kategori.slug_kategori, COUNT(berita.id_berita) AS total');
		$this->db->from('berita');
		// Join dg 2 tabel
		$this->db->join('kategori', 'kategori.id_kategori = berita.id_kategori', 'LEFT');
		$this->db->join('users', 'users.id_user = berita.id_user', 'LEFT');
		// End join
		// $this->db->where('kategori.nama_kategori', 'berita');
		$this->db->where("(nama_kategori='berita' OR nama_kategori='pengumuman')", NULL, FALSE);
		$this->db->group_by('nama_kategori');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing kategori
	public function kategori($id_kategori)
	{
		$this->db->select('berita.*, users.nama, kategori.nama_kategori, kategori.slug_kategori');
		$this->db->from('berita');
		// Join dg 2 tabel
		$this->db->join('kategori', 'kategori.id_kategori = berita.id_kategori', 'LEFT');
		$this->db->join('users', 'users.id_user = berita.id_user', 'LEFT');
		// End join
		$this->db->where(array(
			'berita.id_kategori'	=> $id_kategori,
			'berita.status_berita'	=> 'Publish'
		));
		$this->db->order_by('id_berita', 'DESC');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result();
	}
	// Read data
	public function read($slug_kategori)
	{
		$this->db->select('*');
		$this->db->from('kategori');
		$this->db->where('slug_kategori', $slug_kategori);
		$this->db->order_by('id_kategori', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}

	// =====Crud Admin========
	// Listing data
	public function listing()
	{
		$this->db->select('*');
		$this->db->from('kategori');
		$this->db->order_by('id_kategori', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Detail data
	public function detail($id_kategori)
	{
		$this->db->select('*');
		$this->db->from('kategori');
		$this->db->where('id_kategori', $id_kategori);
		$this->db->order_by('id_kategori', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function tambah($data)
	{
		$this->db->insert('kategori', $data);
	}

	// Edit
	public function edit($data)
	{
		$this->db->where('id_kategori', $data['id_kategori']);
		$this->db->update('kategori', $data);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id_kategori', $data['id_kategori']);
		$this->db->delete('kategori', $data);
	}
}

/* End of file Kategori_model.php */
/* Location: ./application/models/Kategori_model.php */