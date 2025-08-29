<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mitra_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Listing data
	public function listing()
	{
		$this->db->select('mitra.*, users.nama');
		$this->db->from('mitra');
		// Join dg 2 tabel
		$this->db->join('users', 'users.id_user = mitra.id_user', 'LEFT');
		// End join
		$this->db->order_by('urutan', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing to homepage
	public function home()
	{
		$this->db->select('mitra.*, users.nama');
		$this->db->from('mitra');
		// Join dg 2 tabel
		$this->db->join('users', 'users.id_user = mitra.id_user', 'LEFT');
		// End join
		$this->db->order_by('urutan', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing data
	public function dasbor()
	{
		$this->db->select('mitra.*, users.nama');
		$this->db->from('mitra');
		// Join dg 2 tabel
		$this->db->join('users', 'users.id_user = mitra.id_user', 'LEFT');
		// End join
		$this->db->order_by('urutan', 'DESC');
		$this->db->limit(20);
		$query = $this->db->get();
		return $query->result();
	}

	// total
	public function total($id_mitra = FALSE)
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('mitra');
		if ($id_mitra) {
			$this->db->where('mitra.id_mitra', $id_mitra);
		}
		$query = $this->db->get();
		return $query->row();
	}

	// Kunjungan mitra teramai
	public function hits()
	{
		$this->db->select('*');
		$this->db->from('mitra');
		$this->db->order_by('hits', 'DESC');
		$this->db->limit(100);
		$query = $this->db->get();
		return $query->result();
	}

	// Listing kategori
	public function status_admin($status_mitra)
	{
		$this->db->select('mitra.*, users.nama');
		$this->db->from('mitra');
		// Join dg 2 tabel

		$this->db->join('users', 'users.id_user = mitra.id_user', 'LEFT');
		// End join
		$this->db->where(array('mitra.status_mitra'	=> $status_mitra));
		$this->db->order_by('urutan', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing kategori
	public function author_admin($id_user)
	{
		$this->db->select('mitra.*, users.nama');
		$this->db->from('mitra');
		// Join dg 2 tabel

		$this->db->join('users', 'users.id_user = mitra.id_user', 'LEFT');
		// End join
		$this->db->where(array('mitra.id_user'	=> $id_user));
		$this->db->order_by('urutan', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Detail data
	public function detail($id_mitra)
	{
		$this->db->select('*');
		$this->db->from('mitra');
		$this->db->where('id_mitra', $id_mitra);
		$this->db->order_by('urutan', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function tambah($data)
	{
		$this->db->insert('mitra', $data);
	}

	// Edit
	public function edit($data)
	{
		$this->db->where('id_mitra', $data['id_mitra']);
		$this->db->update('mitra', $data);
	}

	// Edit hit
	public function update_hit($hit)
	{
		$this->db->where('id_mitra', $hit['id_mitra']);
		$this->db->update('mitra', $hit);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id_mitra', $data['id_mitra']);
		$this->db->delete('mitra', $data);
	}
}

/* End of file mitra_model.php */
/* Location: ./application/models/mitra_model.php */