<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Monitoring_model extends CI_Model
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
		$this->db->from('monitoring');
		$this->db->order_by('id_monitoring', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function jumlah()
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('monitoring');
		$query = $this->db->get();
		return $query->row();
	}

	// Listing to homepage
	public function home()
	{
		$this->db->select('monitoring.*, users.nama');
		$this->db->from('monitoring');
		// Join dg 2 tabel
		$this->db->join('users', 'users.id_user = monitoring.id_user', 'LEFT');
		// End join
		$this->db->order_by('id_monitoring', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Detail data
	public function detail($id_monitoring)
	{
		$this->db->select('*');
		$this->db->from('monitoring');
		// End Join
		$this->db->where('id_monitoring', $id_monitoring);
		$this->db->order_by('id_monitoring', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}
	// Tambah
	public function tambah($data)
	{
		$this->db->insert('monitoring', $data);
	}

	// Edit
	public function edit($data)
	{
		$this->db->where('id_monitoring', $data['id_monitoring']);
		$this->db->update('monitoring', $data);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id_monitoring', $data['id_monitoring']);
		$this->db->delete('monitoring', $data);
	}
}

/* End of file monitoring_model.php */
/* Location: ./application/models/monitoring_model.php */