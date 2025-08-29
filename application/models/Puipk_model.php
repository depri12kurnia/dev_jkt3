<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Puipk_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	// Listing
	public function listing()
	{
		$this->db->select('*');
		$this->db->from('video');
		$this->db->like('posisi', 'Pui-pk');
		$this->db->order_by('urutan', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}
	// Listing semua
	public function total_video()
	{
		$this->db->select('*');
		$this->db->from('video');
		$this->db->like('posisi', 'Pui-pk');
		$this->db->order_by('id_video', 'DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}

	// Listing semua
	public function video($limit, $start)
	{
		$this->db->select('*');
		$this->db->from('video');
		$this->db->limit($limit, $start);
		$this->db->like('posisi', 'Pui-pk');
		$this->db->order_by('id_video', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing semua
	public function total()
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('video');
		$this->db->like('posisi', 'Pui-pk');
		$this->db->order_by('id_video', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}

	// Detail
	public function detail($id_video)
	{
		$this->db->select('*');
		$this->db->from('video');
		$this->db->where('id_video', $id_video);
		$this->db->like('posisi', 'Pui-pk');
		$this->db->order_by('id_video', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}
}
