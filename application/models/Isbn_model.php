<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Isbn_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Listing data
	public function listing()
	{
		$this->db->select('isbn.*, users.nama');
		$this->db->from('isbn');
		
		$this->db->join('users', 'users.id_user = isbn.id_user', 'LEFT');
		// End join
		$this->db->order_by('id_isbn', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Read data
	public function view($slug)
	{
		$this->db->select('isbn.*, users.nama');
		$this->db->from('isbn');
		// Join dg 2 tabel
		$this->db->join('users', 'users.id_user = isbn.id_user', 'LEFT');
		$this->db->where('slug', $slug);
		$this->db->order_by('id_isbn', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}

	public function isbn()
    {
        $this->db->select('isbn.*, users.nama');
		$this->db->from('isbn');
		
		$this->db->join('users', 'users.id_user = isbn.id_user', 'LEFT');
		// End join
		$this->db->order_by('created_at', 'DESC');
		$query = $this->db->get();
		return $query->result();
    }

	// Detail data
	public function detail($id_isbn)
	{
		$this->db->select('*');
		$this->db->from('isbn');
		$this->db->where('id_isbn', $id_isbn);
		$this->db->order_by('id_isbn', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function tambah($data)
	{
		$this->db->insert('isbn', $data);
	}

	// Edit
	public function edit($data)
	{
		$this->db->where('id_isbn', $data['id_isbn']);
		$this->db->update('isbn', $data);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id_isbn', $data['id_isbn']);
		$this->db->delete('isbn', $data);
	}
}

/* End of file isbn_model.php */
/* Location: ./application/models/isbn_model.php */