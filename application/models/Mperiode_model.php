<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mperiode_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	// Listing
	public function listing()
	{
		$this->db->select('*');
		$this->db->from('mperiode');
		$this->db->order_by('id_mperiode', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing
	public function home()
	{
		$this->db->select('*');
		$this->db->from('mperiode');
		$this->db->order_by('id_mperiode', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing semua
	public function mperiode($limit, $start)
	{
		$this->db->select('*');
		$this->db->from('mperiode');
		$this->db->limit($limit, $start);
		$this->db->order_by('id_mperiode', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing semua
	public function total_mperiode()
	{
		$this->db->select('*');
		$this->db->from('mperiode');
		$this->db->order_by('id_mperiode', 'DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}

	// Listing semua
	public function total()
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('mperiode');
		$this->db->order_by('id_mperiode', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}

	// Detail
	public function detail($id_mperiode)
	{
		$this->db->select('*');
		$this->db->from('mperiode');
		$this->db->where('id_mperiode', $id_mperiode);
		$this->db->order_by('id_mperiode', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function tambah($data)
	{
		$this->db->insert('mperiode', $data);
	}

	// Edit
	public function edit($data)
	{
		$this->db->where('id_mperiode', $data['id_mperiode']);
		$this->db->update('mperiode', $data);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id_mperiode', $data['id_mperiode']);
		$this->db->delete('mperiode', $data);
	}
}
