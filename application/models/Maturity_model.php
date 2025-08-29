<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Maturity_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Listing data
	public function listing()
	{
		$this->db->select('maturity.*, users.nama');
		$this->db->from('maturity');
		// Join dg 2 tabel
		$this->db->join('users', 'users.id_user = maturity.id_user', 'LEFT');
		// End join
		$this->db->order_by('id_maturity', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	// Read data
	public function read($slug_maturity)
	{
		$this->db->select('maturity.*, 
					users.nama');
		$this->db->from('maturity');
		// Join dg 2 tabel
		$this->db->join('users', 'users.id_user = maturity.id_user', 'LEFT');
		$this->db->where('slug_maturity', $slug_maturity);
		$this->db->order_by('id_maturity', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}

	public function listmaturity()
	{
		$this->db->select('maturity.*, users.nama');
		$this->db->from('maturity');
		// Join dg 2 tabel
		$this->db->join('users', 'users.id_user = maturity.id_user', 'LEFT');
		// End join
		$this->db->order_by('id_maturity', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing read
	public function listing_read()
	{
		$this->db->select('maturity.*, users.nama');
		$this->db->from('maturity');
		// Join dg 2 tabel

		$this->db->join('users', 'users.id_user = maturity.id_user', 'LEFT');
		// End join
		$this->db->where(array(
			'maturity.status_maturity'	=> 'Publish'
		));
		$this->db->order_by('id_maturity', 'DESC');
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result();
	}

	// Listing to homepage
	public function home()
	{
		$this->db->select('maturity.*, users.nama');
		$this->db->from('maturity');
		// Join dg 2 tabel
		$this->db->join('users', 'users.id_user = maturity.id_user', 'LEFT');
		// End join
		$this->db->order_by('id_maturity', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing data
	public function dasbor()
	{
		$this->db->select('maturity.*, users.nama');
		$this->db->from('maturity');
		// Join dg 2 tabel
		$this->db->join('users', 'users.id_user = maturity.id_user', 'LEFT');
		// End join
		$this->db->order_by('id_maturity', 'DESC');
		$this->db->limit(20);
		$query = $this->db->get();
		return $query->result();
	}

	// total
	public function total($id_maturity = FALSE)
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('maturity');
		if ($id_maturity) {
			$this->db->where('maturity.id_maturity', $id_maturity);
		}
		$query = $this->db->get();
		return $query->row();
	}


	// Listing kategori
	public function status_admin($status_maturity)
	{
		$this->db->select('maturity.*, users.nama');
		$this->db->from('maturity');
		// Join dg 2 tabel

		$this->db->join('users', 'users.id_user = maturity.id_user', 'LEFT');
		// End join
		$this->db->where(array('maturity.status_maturity'	=> $status_maturity));
		$this->db->order_by('id_maturity', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing kategori
	public function author_admin($id_user)
	{
		$this->db->select('maturity.*, users.nama');
		$this->db->from('maturity');
		// Join dg 2 tabel

		$this->db->join('users', 'users.id_user = maturity.id_user', 'LEFT');
		// End join
		$this->db->where(array('maturity.id_user'	=> $id_user));
		$this->db->order_by('id_maturity', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Detail data
	public function detail($id_maturity)
	{
		$this->db->select('*');
		$this->db->from('maturity');
		$this->db->where('id_maturity', $id_maturity);
		$this->db->order_by('id_maturity', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function tambah($data)
	{
		$this->db->insert('maturity', $data);
	}

	// Edit
	public function edit($data)
	{
		$this->db->where('id_maturity', $data['id_maturity']);
		$this->db->update('maturity', $data);
	}

	// Edit hit
	public function update_hit($hit)
	{
		$this->db->where('id_maturity', $hit['id_maturity']);
		$this->db->update('maturity', $hit);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id_maturity', $data['id_maturity']);
		$this->db->delete('maturity', $data);
	}
}

/* End of file maturity_model.php */
/* Location: ./application/models/maturity_model.php */