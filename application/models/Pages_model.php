<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Listing data
	public function listing()
	{
		$this->db->select('pages.*, users.nama');
		$this->db->from('pages');
		// Join dg 1 tabel
		$this->db->join('users', 'users.id_user = pages.id_user', 'LEFT');
		// End join
		$this->db->order_by('id_pages', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing data
	public function dasbor()
	{
		$this->db->select('pages.*, users.nama');
		$this->db->from('pages');
		// Join dg 1 tabel
		$this->db->join('users', 'users.id_user = pages.id_user', 'LEFT');
		// End join
		$this->db->order_by('id_pages', 'DESC');
		$this->db->limit(20);
		$query = $this->db->get();
		return $query->result();
	}

	// Listing data
	public function bulanan($bulan)
	{
		$this->db->select('pages.*, users.nama');
		$this->db->from('pages');
		// Join dg 1 tabel
		$this->db->join('users', 'users.id_user = pages.id_user', 'LEFT');
		// End join
		$this->db->where('DATE_FORMAT(pages.tanggal,"%Y-%m")', $bulan);
		$this->db->order_by('hits', 'DESC');
		$this->db->limit(20);
		$query = $this->db->get();
		return $query->result();
	}

	// Listing data
	public function tahunan($tahun)
	{
		$this->db->select('pages.*, users.nama');
		$this->db->from('pages');
		// Join dg 1 tabel
		$this->db->join('users', 'users.id_user = pages.id_user', 'LEFT');
		// End join
		$this->db->where('DATE_FORMAT(pages.tanggal,"%Y")', $tahun);
		$this->db->order_by('hits', 'DESC');
		$this->db->limit(20);
		$query = $this->db->get();
		return $query->result();
	}

	// Kunjungan pages teramai
	public function populer()
	{
		$this->db->select('*');
		$this->db->from('pages');
		$this->db->where(array('pages.status_pages'	=> 'Publish'));
		$this->db->order_by('hits', 'DESC');
		$this->db->limit(3);
		$query = $this->db->get();
		return $query->result();
	}

	// Kunjungan pages teramai
	public function pengumuman()
	{
		$this->db->select('pages.*, users.nama');
		$this->db->from('pages');
		// Join dg 1 tabel
		$this->db->join('users', 'users.id_user = pages.id_user', 'LEFT');
		// End join
		$this->db->where('kategori.nama_kategori', 'Pengumuman');
		$this->db->order_by('hits', 'DESC');
		$this->db->limit(2);
		$query = $this->db->get();
		return $query->result();
	}

	// Kunjungan pages teramai
	public function hits()
	{
		$this->db->select('*');
		$this->db->from('pages');
		$this->db->order_by('hits', 'DESC');
		$this->db->limit(10000);
		$query = $this->db->get();
		return $query->result();
	}

	// Listing kategori
	public function kategori_admin($id_kategori)
	{
		$this->db->select('pages.*, users.nama');
		$this->db->from('pages');
		// Join dg 1 tabel
		$this->db->join('users', 'users.id_user = pages.id_user', 'LEFT');
		// End join
		$this->db->where(array('pages.id_kategori'	=> $id_kategori));
		$this->db->order_by('id_pages', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing kategori
	public function status_admin($status_pages)
	{
		$this->db->select('pages.*, users.nama');
		$this->db->from('pages');
		// Join dg 1 tabel
		$this->db->join('users', 'users.id_user = pages.id_user', 'LEFT');
		// End join
		$this->db->where(array('pages.status_pages'	=> $status_pages));
		$this->db->order_by('id_pages', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing kategori
	public function jenis_admin($jenis_pages)
	{
		$this->db->select('pages.*, users.nama');
		$this->db->from('pages');
		// Join dg 1 tabel
		$this->db->join('users', 'users.id_user = pages.id_user', 'LEFT');
		// End join
		$this->db->where(array('pages.jenis_pages'	=> $jenis_pages));
		$this->db->order_by('id_pages', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing kategori
	public function author_admin($id_user)
	{
		$this->db->select('pages.*, users.nama');
		$this->db->from('pages');
		// Join dg 1 tabel
		$this->db->join('users', 'users.id_user = pages.id_user', 'LEFT');
		// End join
		$this->db->where(array('pages.id_user'	=> $id_user));
		$this->db->order_by('id_pages', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing kategori
	public function kategori($limit, $start)
	{
		$this->db->select('pages.*, users.nama');
		$this->db->from('pages');
		// Join dg 1 tabel
		$this->db->join('users', 'users.id_user = pages.id_user', 'LEFT');
		// End join
		$this->db->where(array(
			'pages.status_pages'	=> 'Publish'
		));
		$this->db->order_by('id_pages', 'DESC');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query->result();
	}


	// Listing pages
	public function pages($limit, $start)
	{
		$this->db->select('pages.*, users.nama');
		$this->db->from('pages');
		// Join dg 1 tabel

		$this->db->join('users', 'users.id_user = pages.id_user', 'LEFT');
		// End join
		$this->db->where(array(
			'pages.status_pages'	=> 'Publish'
		));
		$this->db->order_by('pages.tanggal_publish', 'DESC');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query->result();
	}


	// Listing total
	public function total()
	{
		$this->db->select('pages.*, users.nama');
		$this->db->from('pages');
		// Join dg 1 tabel

		$this->db->join('users', 'users.id_user = pages.id_user', 'LEFT');
		// End join
		$this->db->where(array(
			'pages.status_pages'	=> 'Publish'
		));
		$this->db->order_by('id_pages', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing pages
	public function search($keywords, $limit, $start)
	{
		$this->db->select('pages.*, 
					users.nama, 
					kategori.nama_kategori, kategori.slug_kategori,
					kategori.slug_kategori
					');
		$this->db->from('pages');
		// Join dg 1 tabel

		$this->db->join('users', 'users.id_user = pages.id_user', 'LEFT');
		// End join
		$this->db->where(array(
			'pages.status_pages'	=> 'Publish'
		));
		$this->db->like('pages.judul_pages', $keywords);
		$this->db->or_like('pages.isi', $keywords);
		$this->db->group_by('id_pages');
		$this->db->order_by('id_pages', 'DESC');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query->result();
	}

	// Listing total
	public function total_search($keywords)
	{
		$this->db->select('pages.*, users.nama');
		$this->db->from('pages');
		// Join dg 1 tabel

		$this->db->join('users', 'users.id_user = pages.id_user', 'LEFT');
		// End join
		$this->db->where(array(
			'pages.status_pages'	=> 'Publish'
		));
		$this->db->like('pages.judul_pages', $keywords);
		$this->db->or_like('pages.isi', $keywords);
		$this->db->group_by('id_pages');
		$this->db->order_by('id_pages', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing read
	public function listing_read()
	{
		$this->db->select('pages.*, users.nama');
		$this->db->from('pages');
		// Join dg 1 tabel

		$this->db->join('users', 'users.id_user = pages.id_user', 'LEFT');
		// End join
		$this->db->where(array(
			'pages.status_pages'	=> 'Publish'
		));
		$this->db->order_by('id_pages', 'DESC');
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result();
	}

	// Listing profil
	public function listing_profil()
	{
		$this->db->select('pages.*, users.nama');
		$this->db->from('pages');
		// Join dg 1 tabel

		$this->db->join('users', 'users.id_user = pages.id_user', 'LEFT');
		// End join
		$this->db->where(array(
			'pages.status_pages'	=> 'Publish',
			'pages.jenis_pages'	=> 'Profil'
		));
		$this->db->order_by('id_pages', 'DESC');
		$this->db->limit(20);
		$query = $this->db->get();
		return $query->result();
	}

	// Listing Jurusan
	public function listing_alumni()
	{
		$this->db->select('pages.*, users.nama');
		$this->db->from('pages');
		// Join dg 1 tabel

		$this->db->join('users', 'users.id_user = pages.id_user', 'LEFT');
		// End join
		$this->db->where(array(
			'pages.status_pages'	=> 'Publish',
			'pages.jenis_pages'	=> 'Alumni'
		));
		$this->db->order_by('id_pages', 'DESC');
		$this->db->limit(20);
		$query = $this->db->get();
		return $query->result();
	}

	// Listing layanan
	public function listing_pendidikan()
	{
		$this->db->select('pages.*, users.nama');
		$this->db->from('pages');
		// Join dg 1 tabel

		$this->db->join('users', 'users.id_user = pages.id_user', 'LEFT');
		// End join
		$this->db->where(array(
			'pages.status_pages'	=> 'Publish',
			'pages.jenis_pages'		=> 'Pendidikan'
		));
		$this->db->order_by('id_pages', 'DESC');
		$this->db->limit(20);
		$query = $this->db->get();
		return $query->result();
	}

	// Read data
	public function read($slug_pages)
	{
		$this->db->select('pages.*, users.nama');
		$this->db->from('pages');
		// Join dg 1 tabel
		$this->db->join('users', 'users.id_user = pages.id_user', 'LEFT');
		$this->db->where('slug_pages', $slug_pages);
		$this->db->order_by('id_pages', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}

	// Detail data
	public function detail($id_pages)
	{
		$this->db->select('*');
		$this->db->from('pages');
		$this->db->where('id_pages', $id_pages);
		$this->db->order_by('id_pages', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function tambah($data)
	{
		$this->db->insert('pages', $data);
	}

	// Edit
	public function edit($data)
	{
		$this->db->where('id_pages', $data['id_pages']);
		$this->db->update('pages', $data);
	}

	// Edit hit
	public function update_hit($hit)
	{
		$this->db->where('id_pages', $hit['id_pages']);
		$this->db->update('pages', $hit);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id_pages', $data['id_pages']);
		$this->db->delete('pages', $data);
	}
}

/* End of file pages_model.php */
/* Location: ./application/models/pages_model.php */