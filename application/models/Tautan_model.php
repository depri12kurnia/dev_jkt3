<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tautan_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Listing data
	public function listing() {
		$this->db->select('tautan.*, users.nama');
		$this->db->from('tautan');
		// Join dg 2 tabel
		$this->db->join('users','users.id_user = tautan.id_user','LEFT');
		// End join
		$this->db->order_by('urutan','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing to homepage
	public function home() {
		$this->db->select('tautan.*, users.nama');
		$this->db->from('tautan');
		// Join dg 2 tabel
		$this->db->join('users','users.id_user = tautan.id_user','LEFT');
		// End join
		$this->db->order_by('urutan','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing data
	public function dasbor() {
		$this->db->select('tautan.*, users.nama');
		$this->db->from('tautan');
		// Join dg 2 tabel
		$this->db->join('users','users.id_user = tautan.id_user','LEFT');
		// End join
		$this->db->order_by('id_tautan','DESC');
		$this->db->limit(20);
		$query = $this->db->get();
		return $query->result();
	}

	// total
	public function total($id_tautan=FALSE)
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('tautan');
		if($id_tautan) {
			$this->db->where('tautan.id_tautan', $id_tautan);
		}
		$query = $this->db->get();
		return $query->row();
	}

	// Kunjungan tautan teramai
	public function hits()
	{
		$this->db->select('*');
		$this->db->from('tautan');
		$this->db->order_by('hits','DESC');
		$this->db->limit(100);
		$query = $this->db->get();
		return $query->result();
	}

	// Listing kategori
	public function status_admin($status_tautan) {
		$this->db->select('tautan.*, users.nama');
		$this->db->from('tautan');
		// Join dg 2 tabel
		
		$this->db->join('users','users.id_user = tautan.id_user','LEFT');
		// End join
		$this->db->where(array(	'tautan.status_tautan'	=> $status_tautan));
		$this->db->order_by('urutan','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing kategori
	public function author_admin($id_user) {
		$this->db->select('tautan.*, users.nama');
		$this->db->from('tautan');
		// Join dg 2 tabel
		
		$this->db->join('users','users.id_user = tautan.id_user','LEFT');
		// End join
		$this->db->where(array(	'tautan.id_user'	=> $id_user));
		$this->db->order_by('id_tautan','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Detail data
	public function detail($id_tautan) {
		$this->db->select('*');
		$this->db->from('tautan');
		$this->db->where('id_tautan',$id_tautan);
		$this->db->order_by('id_tautan','DESC');
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function tambah($data) {
		$this->db->insert('tautan',$data);
	}

	// Edit
	public function edit($data) {
		$this->db->where('id_tautan',$data['id_tautan']);
		$this->db->update('tautan',$data);
	}

	// Edit hit
	public function update_hit($hit) {
		$this->db->where('id_tautan',$hit['id_tautan']);
		$this->db->update('tautan',$hit);
	}

	// Delete
	public function delete($data) {
		$this->db->where('id_tautan',$data['id_tautan']);
		$this->db->delete('tautan',$data);
	}
}

/* End of file tautan_model.php */
/* Location: ./application/models/tautan_model.php */