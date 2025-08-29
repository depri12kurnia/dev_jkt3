<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Capaian_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Listing data
	public function listing()
	{
		$this->db->select('capaian.*, users.nama');
		$this->db->from('capaian');
		// Join dg 2 tabel
		$this->db->join('users', 'users.id_user = capaian.id_user', 'LEFT');
		// End join
		$this->db->order_by('id_capaian', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	// Read data
	public function read($slug_capaian)
	{
		$this->db->select('capaian.*, 
					users.nama');
		$this->db->from('capaian');
		// Join dg 2 tabel
		$this->db->join('users', 'users.id_user = capaian.id_user', 'LEFT');
		$this->db->where('slug_capaian', $slug_capaian);
		$this->db->order_by('id_capaian', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}

	public function listcapaian()
	{
		$this->db->select('capaian.*, users.nama');
		$this->db->from('capaian');
		// Join dg 2 tabel
		$this->db->join('users', 'users.id_user = capaian.id_user', 'LEFT');
		// End join
		$this->db->order_by('id_capaian', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing read
	public function listing_read()
	{
		$this->db->select('capaian.*, users.nama');
		$this->db->from('capaian');
		// Join dg 2 tabel

		$this->db->join('users', 'users.id_user = capaian.id_user', 'LEFT');
		// End join
		$this->db->where(array(
			'capaian.status_capaian'	=> 'Publish'
		));
		$this->db->order_by('id_capaian', 'DESC');
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result();
	}

	// Listing to homepage
	public function home()
	{
		$this->db->select('capaian.*, users.nama');
		$this->db->from('capaian');
		// Join dg 2 tabel
		$this->db->join('users', 'users.id_user = capaian.id_user', 'LEFT');
		// End join
		$this->db->order_by('id_capaian', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing data
	public function dasbor()
	{
		$this->db->select('capaian.*, users.nama');
		$this->db->from('capaian');
		// Join dg 2 tabel
		$this->db->join('users', 'users.id_user = capaian.id_user', 'LEFT');
		// End join
		$this->db->order_by('id_capaian', 'DESC');
		$this->db->limit(20);
		$query = $this->db->get();
		return $query->result();
	}

	// total
	public function total($id_capaian = FALSE)
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('capaian');
		if ($id_capaian) {
			$this->db->where('capaian.id_capaian', $id_capaian);
		}
		$query = $this->db->get();
		return $query->row();
	}


	// Listing kategori
	public function status_admin($status_capaian)
	{
		$this->db->select('capaian.*, users.nama');
		$this->db->from('capaian');
		// Join dg 2 tabel

		$this->db->join('users', 'users.id_user = capaian.id_user', 'LEFT');
		// End join
		$this->db->where(array('capaian.status_capaian'	=> $status_capaian));
		$this->db->order_by('id_capaian', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing kategori
	public function author_admin($id_user)
	{
		$this->db->select('capaian.*, users.nama');
		$this->db->from('capaian');
		// Join dg 2 tabel

		$this->db->join('users', 'users.id_user = capaian.id_user', 'LEFT');
		// End join
		$this->db->where(array('capaian.id_user'	=> $id_user));
		$this->db->order_by('id_capaian', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Detail data
	public function detail($id_capaian)
	{
		$this->db->select('*');
		$this->db->from('capaian');
		$this->db->where('id_capaian', $id_capaian);
		$this->db->order_by('id_capaian', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function tambah($data)
	{
		$this->db->insert('capaian', $data);
	}

	// Edit
	public function edit($data)
	{
		$this->db->where('id_capaian', $data['id_capaian']);
		$this->db->update('capaian', $data);
	}

	// Edit hit
	public function update_hit($hit)
	{
		$this->db->where('id_capaian', $hit['id_capaian']);
		$this->db->update('capaian', $hit);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id_capaian', $data['id_capaian']);
		$this->db->delete('capaian', $data);
	}
}

/* End of file capaian_model.php */
/* Location: ./application/models/capaian_model.php */