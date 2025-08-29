<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan_model extends CI_Model
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
		$this->db->from('jurusan');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Jumlah total data
	public function jumlah()
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('jurusan');
		$query = $this->db->get();
		return $query->row();
	}

	// Listing untuk homepage (tanpa join users karena tidak ada id_user di tabel)
	public function home()
	{
		$this->db->select('*');
		$this->db->from('jurusan');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Detail data berdasarkan ID
	public function detail($id)
	{
		$this->db->select('*');
		$this->db->from('jurusan');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	// Detail data berdasarkan slug
	public function detail_by_slug($slug)
	{
		$this->db->select('*');
		$this->db->from('jurusan');
		$this->db->where('slug', $slug);
		$query = $this->db->get();
		return $query->row();
	}

	// Check apakah slug sudah ada (untuk validasi)
	public function check_slug($slug, $id = null)
	{
		$this->db->from('jurusan');
		$this->db->where('slug', $slug);

		// Jika edit, exclude ID yang sedang diedit
		if ($id !== null) {
			$this->db->where('id !=', $id);
		}

		return $this->db->count_all_results() > 0;
	}

	// Generate slug unik
	public function generate_slug($nama, $id = null)
	{
		// Load text helper untuk create_slug
		$this->load->helper('text');

		// Buat slug dasar dari nama
		$slug = url_title($nama, 'dash', TRUE);
		$original_slug = $slug;
		$counter = 1;

		// Loop sampai dapat slug yang unik
		while ($this->check_slug($slug, $id)) {
			$slug = $original_slug . '-' . $counter;
			$counter++;
		}

		return $slug;
	}

	// Tambah data
	public function tambah($data)
	{
		// Generate slug jika belum ada
		if (empty($data['slug']) && !empty($data['nama'])) {
			$data['slug'] = $this->generate_slug($data['nama']);
		}

		// Set created_at jika belum ada (meskipun sudah ada DEFAULT di DB)
		if (empty($data['created_at'])) {
			$data['created_at'] = date('Y-m-d H:i:s');
		}

		return $this->db->insert('jurusan', $data);
	}

	// Edit data
	public function edit($data)
	{
		$id = $data['id'];

		// Generate slug baru jika nama berubah
		if (!empty($data['nama'])) {
			$data['slug'] = $this->generate_slug($data['nama'], $id);
		}

		// Hapus id dari data untuk update
		unset($data['id']);

		$this->db->where('id', $id);
		return $this->db->update('jurusan', $data);
	}

	// Delete data
	public function delete($data)
	{
		$this->db->where('id', $data['id']);
		return $this->db->delete('jurusan');
	}

	// Search jurusan berdasarkan nama
	public function search($keyword)
	{
		$this->db->select('*');
		$this->db->from('jurusan');
		$this->db->like('nama', $keyword);
		$this->db->or_like('deskripsi', $keyword);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing dengan pagination
	public function listing_paginated($limit, $start)
	{
		$this->db->select('*');
		$this->db->from('jurusan');
		$this->db->order_by('id', 'DESC');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query->result();
	}

	// Listing untuk dropdown/select option
	public function dropdown()
	{
		$this->db->select('id, nama');
		$this->db->from('jurusan');
		$this->db->order_by('nama', 'ASC');
		$query = $this->db->get();

		$dropdown = array();
		$dropdown[''] = 'Pilih Jurusan';

		foreach ($query->result() as $row) {
			$dropdown[$row->id] = $row->nama;
		}

		return $dropdown;
	}

	// Get jurusan terbaru
	public function get_latest($limit = 5)
	{
		$this->db->select('*');
		$this->db->from('jurusan');
		$this->db->order_by('created_at', 'DESC');
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query->result();
	}

	// Validasi data sebelum insert/update
	public function validate_data($data, $id = null)
	{
		$errors = array();

		// Validasi nama
		if (empty($data['nama'])) {
			$errors[] = 'Nama jurusan harus diisi';
		} elseif (strlen($data['nama']) > 100) {
			$errors[] = 'Nama jurusan maksimal 100 karakter';
		}

		// Validasi slug jika diisi manual
		if (!empty($data['slug'])) {
			if (strlen($data['slug']) > 100) {
				$errors[] = 'Slug maksimal 100 karakter';
			}

			// Check unique slug
			if ($this->check_slug($data['slug'], $id)) {
				$errors[] = 'Slug sudah digunakan';
			}
		}

		return $errors;
	}

	// Update multiple records
	public function update_batch($data, $key)
	{
		return $this->db->update_batch('jurusan', $data, $key);
	}

	// Soft delete (jika ingin implementasi soft delete)
	public function soft_delete($id)
	{
		$data = array(
			'deleted_at' => date('Y-m-d H:i:s')
		);

		$this->db->where('id', $id);
		return $this->db->update('jurusan', $data);
	}

	// To Frontend: Get jurusan by slug
	public function get_by_slug($slug)
	{
		$this->db->select('*');
		$this->db->from('jurusan');
		$this->db->where('slug', $slug);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		return $query->row();
	}

	// Get prodi by jurusan ID
	public function by_jurusan($jurusan_id)
	{
		$this->db->select('prodi.*, jurusan.nama as nama_jurusan');
		$this->db->from('prodi');
		$this->db->join('jurusan', 'prodi.jurusan_id = jurusan.id', 'left');
		$this->db->where('prodi.jurusan_id', $jurusan_id);
		$this->db->order_by('prodi.jenjang', 'ASC');
		$this->db->order_by('prodi.nama', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	/**
	 * Get jurusan data by slug
	 */
	public function get_jurusan_by_slug($slug)
	{
		$this->db->where('slug', $slug);
		$query = $this->db->get('jurusan');
		return $query->row();
	}

	/**
	 * Get SDM by jurusan slug
	 * Filter berdasarkan level jabatan dan jurusan_id
	 */
	public function get_sdm_by_jurusan_slug($slug)
	{
		// Ambil jurusan_id berdasarkan slug
		$jurusan = $this->get_jurusan_by_slug($slug);

		if (!$jurusan) {
			return array();
		}

		$this->db->select('
            s.id, 
            s.nama, 
            s.nip, 
            s.jenis_kelamin, 
            s.email, 
            s.no_hp, 
            s.foto_url, 
            s.deskripsi,
            js.level,
            js.jabatan,
            js.periode_mulai,
            js.periode_akhir,
            js.jurusan_id,
            js.prodi_id
        ');

		$this->db->from('sdm s');
		$this->db->join('jabatan_sdm js', 's.id = js.sdm_id', 'left');

		// Filter berdasarkan jurusan
		$this->db->group_start();
		// Level jurusan dengan jurusan_id yang sesuai
		$this->db->group_start();
		$this->db->where('js.level', 'jurusan');
		$this->db->where('js.jurusan_id', $jurusan->id);
		$this->db->group_end();

		// ATAU level prodi yang berada di bawah jurusan ini
		$this->db->or_group_start();
		$this->db->where('js.level', 'prodi');
		$this->db->where('js.jurusan_id', $jurusan->id);
		$this->db->group_end();

		// ATAU level institusi (tampil di semua jurusan)
		$this->db->or_where('js.level', 'institusi');
		$this->db->group_end();

		// Urutkan berdasarkan level dan nama
		$this->db->order_by('
            CASE js.level 
                WHEN "institusi" THEN 1 
                WHEN "jurusan" THEN 2 
                WHEN "prodi" THEN 3 
                ELSE 4 
            END
        ');
		$this->db->order_by('s.nama', 'ASC');

		$query = $this->db->get();
		return $query->result();
	}

	/**
	 * Get program studi by jurusan slug
	 */
	public function get_prodi_by_jurusan_slug($slug)
	{
		$jurusan = $this->get_jurusan_by_slug($slug);

		if (!$jurusan) {
			return array();
		}

		$this->db->where('jurusan_id', $jurusan->id);
		$this->db->where('status', 'aktif');
		$this->db->order_by('nama', 'ASC');
		$query = $this->db->get('program_studi');
		return $query->result();
	}

	/**
	 * Get statistik SDM by jurusan
	 */
	public function get_sdm_statistics_by_jurusan($jurusan_id)
	{
		// Total SDM
		$this->db->select('COUNT(*) as total');
		$this->db->from('sdm s');
		$this->db->join('jabatan_sdm js', 's.id = js.sdm_id');
		$this->db->group_start();
		$this->db->where('js.jurusan_id', $jurusan_id);
		$this->db->or_where('js.level', 'institusi');
		$this->db->group_end();
		$total_sdm = $this->db->get()->row()->total;

		// Total ASN
		$this->db->select('COUNT(*) as total_asn');
		$this->db->from('sdm s');
		$this->db->join('jabatan_sdm js', 's.id = js.sdm_id');
		$this->db->where('s.nip IS NOT NULL');
		$this->db->where('s.nip !=', '');
		$this->db->group_start();
		$this->db->where('js.jurusan_id', $jurusan_id);
		$this->db->or_where('js.level', 'institusi');
		$this->db->group_end();
		$total_asn = $this->db->get()->row()->total_asn;

		// By Level
		$this->db->select('js.level, COUNT(*) as total');
		$this->db->from('sdm s');
		$this->db->join('jabatan_sdm js', 's.id = js.sdm_id');
		$this->db->group_start();
		$this->db->where('js.jurusan_id', $jurusan_id);
		$this->db->or_where('js.level', 'institusi');
		$this->db->group_end();
		$this->db->group_by('js.level');
		$by_level = $this->db->get()->result();

		// By Gender
		$this->db->select('s.jenis_kelamin, COUNT(*) as total');
		$this->db->from('sdm s');
		$this->db->join('jabatan_sdm js', 's.id = js.sdm_id');
		$this->db->group_start();
		$this->db->where('js.jurusan_id', $jurusan_id);
		$this->db->or_where('js.level', 'institusi');
		$this->db->group_end();
		$this->db->group_by('s.jenis_kelamin');
		$by_gender = $this->db->get()->result();

		return [
			'total_sdm' => $total_sdm,
			'total_asn' => $total_asn,
			'total_non_asn' => $total_sdm - $total_asn,
			'by_level' => $by_level,
			'by_gender' => $by_gender
		];
	}

	/**
	 * Get all jurusan for listing
	 */
	public function get_all_jurusan()
	{
		$this->db->where('status', 'aktif');
		$this->db->order_by('nama', 'ASC');
		$query = $this->db->get('jurusan');
		return $query->result();
	}

	/**
	 * Check if jurusan exists by slug
	 */
	public function jurusan_exists($slug)
	{
		$this->db->where('slug', $slug);
		$this->db->where('status', 'aktif');
		$query = $this->db->get('jurusan');
		return $query->num_rows() > 0;
	}
}

/* End of file jurusan_model.php */
/* Location: ./application/models/jurusan_model.php */