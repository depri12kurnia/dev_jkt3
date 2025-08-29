<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_helpdesk_model extends CI_Model
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
		$this->db->from('kategori_helpdesk');
		$this->db->order_by('id_kategori_helpdesk', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	// Detail data
	public function detail($id_kategori_helpdesk)
	{
		$this->db->select('*');
		$this->db->from('id_kategori_helpdesk');
		$this->db->where('id_kategori_helpdesk', $id_kategori_helpdesk);
		$this->db->order_by('id_kategori_helpdesk', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}

	// Detail data
	public function read($slug_id_kategori_helpdesk)
	{
		$this->db->select('*');
		$this->db->from('id_kategori_helpdesk');
		$this->db->where('slug_id_kategori_helpdesk', $slug_id_kategori_helpdesk);
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function tambah($data)
	{
		$this->db->insert('kategori_helpdesk', $data);
	}

	// Edit
	public function edit($data)
	{
		$this->db->where('id_kategori_helpdesk', $data['id_kategori_helpdesk']);
		$this->db->update('kategori_helpdesk', $data);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id_kategori_helpdesk', $data['id_kategori_helpdesk']);
		$this->db->delete('kategori_helpdesk', $data);
	}
}

/* End of file id_kategori_helpdesk_model.php */
/* Location: ./application/models/id_kategori_helpdesk_model.php */