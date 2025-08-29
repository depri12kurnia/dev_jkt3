<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prodi_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Listing data
	public function listing()
	{
		$this->db->select('prodi.*, jurusan.nama as nama_jurusan');
		$this->db->from('prodi');
		$this->db->join('jurusan', 'jurusan.id = prodi.jurusan_id', 'LEFT');
		$this->db->order_by('prodi.id', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing untuk homepage
	public function home()
	{
		$this->db->select('prodi.*, jurusan.nama as nama_jurusan');
		$this->db->from('prodi');
		$this->db->join('jurusan', 'jurusan.id = prodi.jurusan_id', 'LEFT');
		$this->db->order_by('prodi.id', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing untuk dashboard
	public function dasbor()
	{
		$this->db->select('prodi.*, jurusan.nama as nama_jurusan');
		$this->db->from('prodi');
		$this->db->join('jurusan', 'jurusan.id = prodi.jurusan_id', 'LEFT');
		$this->db->order_by('prodi.id', 'DESC');
		$this->db->limit(20);
		$query = $this->db->get();
		return $query->result();
	}

	// Detail data berdasarkan ID
	public function detail($id)
	{
		$this->db->select('prodi.*, jurusan.nama as nama_jurusan');
		$this->db->from('prodi');
		$this->db->join('jurusan', 'jurusan.id = prodi.jurusan_id', 'LEFT');
		$this->db->where('prodi.id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	// Listing berdasarkan jurusan
	public function by_jurusan($jurusan_id, $limit = null, $start = 0)
	{
		$this->db->select('prodi.*, jurusan.nama as nama_jurusan');
		$this->db->from('prodi');
		$this->db->join('jurusan', 'jurusan.id = prodi.jurusan_id', 'LEFT');
		$this->db->where('prodi.jurusan_id', $jurusan_id);
		$this->db->order_by('prodi.id', 'ASC');

		if ($limit !== null) {
			$this->db->limit($limit, $start);
		}

		$query = $this->db->get();
		return $query->result();
	}

	// Count prodi berdasarkan jurusan
	public function count_by_jurusan($jurusan_id)
	{
		$this->db->from('prodi');
		$this->db->where('jurusan_id', $jurusan_id);
		return $this->db->count_all_results();
	}

	// Search prodi
	public function search($keyword, $limit = null, $start = 0)
	{
		$this->db->select('prodi.*, jurusan.nama as nama_jurusan');
		$this->db->from('prodi');
		$this->db->join('jurusan', 'jurusan.id = prodi.jurusan_id', 'LEFT');
		$this->db->like('prodi.nama', $keyword);
		$this->db->or_like('jurusan.nama', $keyword);
		$this->db->order_by('prodi.id', 'DESC');

		if ($limit !== null) {
			$this->db->limit($limit, $start);
		}

		$query = $this->db->get();
		return $query->result();
	}

	// Count search results
	public function count_search($keyword)
	{
		$this->db->from('prodi');
		$this->db->join('jurusan', 'jurusan.id = prodi.jurusan_id', 'LEFT');
		$this->db->like('prodi.nama', $keyword);
		$this->db->or_like('jurusan.nama', $keyword);
		return $this->db->count_all_results();
	}

	// Jumlah total prodi
	public function jumlah()
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('prodi');
		$query = $this->db->get();
		return $query->row();
	}

	// Listing dengan pagination
	public function listing_paginated($limit, $start)
	{
		$this->db->select('prodi.*, jurusan.nama as nama_jurusan');
		$this->db->from('prodi');
		$this->db->join('jurusan', 'jurusan.id = prodi.jurusan_id', 'LEFT');
		$this->db->order_by('prodi.id', 'DESC');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query->result();
	}

	// Dropdown untuk form
	public function dropdown()
	{
		$this->db->select('id, nama');
		$this->db->from('prodi');
		$this->db->order_by('nama', 'ASC');
		$query = $this->db->get();

		$dropdown = array();
		$dropdown[''] = 'Pilih Program Studi';

		foreach ($query->result() as $row) {
			$dropdown[$row->id] = $row->nama;
		}

		return $dropdown;
	}

	// Dropdown berdasarkan jurusan (untuk AJAX)
	public function dropdown_by_jurusan($jurusan_id)
	{
		$this->db->select('id, nama');
		$this->db->from('prodi');
		$this->db->where('jurusan_id', $jurusan_id);
		$this->db->order_by('nama', 'ASC');
		$query = $this->db->get();

		$dropdown = array();
		$dropdown[''] = 'Pilih Program Studi';

		foreach ($query->result() as $row) {
			$dropdown[$row->id] = $row->nama;
		}

		return $dropdown;
	}

	// Get prodi terbaru
	public function get_latest($limit = 5)
	{
		$this->db->select('prodi.*, jurusan.nama as nama_jurusan');
		$this->db->from('prodi');
		$this->db->join('jurusan', 'jurusan.id = prodi.jurusan_id', 'LEFT');
		$this->db->order_by('prodi.id', 'DESC');
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query->result();
	}

	// Check slug availability
	public function check_slug_exists($slug, $id = null)
	{
		$this->db->where('slug', $slug);

		// Jika ini untuk edit, exclude ID yang sedang diedit
		if ($id !== null) {
			$this->db->where('id !=', $id);
		}

		$query = $this->db->get('prodi');
		return $query->num_rows() > 0;
	}

	// Generate unique slug
	public function generate_unique_slug($nama, $id = null)
	{
		// Basic slug generation
		$slug = strtolower(trim($nama));
		$slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
		$slug = preg_replace('/-+/', '-', $slug);
		$slug = trim($slug, '-');

		// Check if slug exists
		$original_slug = $slug;
		$counter = 1;

		while ($this->check_slug_exists($slug, $id)) {
			$slug = $original_slug . '-' . $counter;
			$counter++;
		}

		return $slug;
	}

	// Check if nama already exists in same jurusan
	public function check_nama_exists($nama, $jurusan_id, $id = null)
	{
		$this->db->where('nama', $nama);
		$this->db->where('jurusan_id', $jurusan_id);

		if ($id !== null) {
			$this->db->where('id !=', $id);
		}

		$query = $this->db->get('prodi');
		return $query->num_rows() > 0;
	}

	// Detail by slug
	public function detail_by_slug($slug)
	{
		$this->db->select('prodi.*, jurusan.nama as nama_jurusan');
		$this->db->from('prodi');
		$this->db->join('jurusan', 'jurusan.id = prodi.jurusan_id', 'LEFT');
		$this->db->where('prodi.slug', $slug);
		$query = $this->db->get();
		return $query->row();
	}

	// Filter by jenjang
	public function by_jenjang($jenjang, $limit = null, $start = 0)
	{
		$this->db->select('prodi.*, jurusan.nama as nama_jurusan');
		$this->db->from('prodi');
		$this->db->join('jurusan', 'jurusan.id = prodi.jurusan_id', 'LEFT');
		$this->db->where('prodi.jenjang', $jenjang);
		$this->db->order_by('prodi.nama', 'ASC');

		if ($limit !== null) {
			$this->db->limit($limit, $start);
		}

		$query = $this->db->get();
		return $query->result();
	}

	// Filter by akreditasi
	public function by_akreditasi($akreditasi, $limit = null, $start = 0)
	{
		$this->db->select('prodi.*, jurusan.nama as nama_jurusan');
		$this->db->from('prodi');
		$this->db->join('jurusan', 'jurusan.id = prodi.jurusan_id', 'LEFT');
		$this->db->where('prodi.akreditasi', $akreditasi);
		$this->db->order_by('prodi.nama', 'ASC');

		if ($limit !== null) {
			$this->db->limit($limit, $start);
		}

		$query = $this->db->get();
		return $query->result();
	}

	// Enhanced search dengan filter
	public function advanced_search($filters = array(), $limit = null, $start = 0)
	{
		$this->db->select('prodi.*, jurusan.nama as nama_jurusan');
		$this->db->from('prodi');
		$this->db->join('jurusan', 'jurusan.id = prodi.jurusan_id', 'LEFT');

		// Apply filters
		if (!empty($filters['keyword'])) {
			$this->db->group_start();
			$this->db->like('prodi.nama', $filters['keyword']);
			$this->db->or_like('prodi.deskripsi', $filters['keyword']);
			$this->db->or_like('jurusan.nama', $filters['keyword']);
			$this->db->group_end();
		}

		if (!empty($filters['jurusan_id'])) {
			$this->db->where('prodi.jurusan_id', $filters['jurusan_id']);
		}

		if (!empty($filters['jenjang'])) {
			$this->db->where('prodi.jenjang', $filters['jenjang']);
		}

		if (!empty($filters['akreditasi'])) {
			$this->db->where('prodi.akreditasi', $filters['akreditasi']);
		}

		$this->db->order_by('prodi.nama', 'ASC');

		if ($limit !== null) {
			$this->db->limit($limit, $start);
		}

		$query = $this->db->get();
		return $query->result();
	}

	// Count advanced search results
	public function count_advanced_search($filters = array())
	{
		$this->db->from('prodi');
		$this->db->join('jurusan', 'jurusan.id = prodi.jurusan_id', 'LEFT');

		// Apply same filters as advanced_search
		if (!empty($filters['keyword'])) {
			$this->db->group_start();
			$this->db->like('prodi.nama', $filters['keyword']);
			$this->db->or_like('prodi.deskripsi', $filters['keyword']);
			$this->db->or_like('jurusan.nama', $filters['keyword']);
			$this->db->group_end();
		}

		if (!empty($filters['jurusan_id'])) {
			$this->db->where('prodi.jurusan_id', $filters['jurusan_id']);
		}

		if (!empty($filters['jenjang'])) {
			$this->db->where('prodi.jenjang', $filters['jenjang']);
		}

		if (!empty($filters['akreditasi'])) {
			$this->db->where('prodi.akreditasi', $filters['akreditasi']);
		}

		return $this->db->count_all_results();
	}

	// Get related data count (untuk check sebelum delete)
	public function get_related_data_count($prodi_id)
	{
		$related = array();

		// Contoh: check mahasiswa (sesuaikan dengan tabel yang ada)
		// $this->db->where('prodi_id', $prodi_id);
		// $mahasiswa_count = $this->db->count_all_results('mahasiswa');
		// if ($mahasiswa_count > 0) {
		//     $related['mahasiswa'] = $mahasiswa_count;
		// }

		// Contoh: check dosen (sesuaikan dengan tabel yang ada)
		// $this->db->where('prodi_id', $prodi_id);
		// $dosen_count = $this->db->count_all_results('dosen');
		// if ($dosen_count > 0) {
		//     $related['dosen'] = $dosen_count;
		// }

		// Untuk sementara return empty array
		return $related;
	}

	// Enhanced validation dengan struktur database baru
	public function validate_data($data, $id = null)
	{
		$errors = array();

		// Validasi nama
		if (empty($data['nama'])) {
			$errors[] = 'Nama program studi harus diisi';
		} elseif (strlen($data['nama']) > 100) {
			$errors[] = 'Nama program studi maksimal 100 karakter';
		}

		// Validasi jurusan_id
		if (empty($data['jurusan_id'])) {
			$errors[] = 'Jurusan harus dipilih';
		} else {
			// Check apakah jurusan exists
			$this->db->where('id', $data['jurusan_id']);
			$jurusan_exists = $this->db->get('jurusan')->num_rows();
			if ($jurusan_exists == 0) {
				$errors[] = 'Jurusan yang dipilih tidak valid';
			}
		}

		// Validasi jenjang
		if (!empty($data['jenjang'])) {
			$valid_jenjang = array('D3', 'STr', 'Profesi');
			if (!in_array($data['jenjang'], $valid_jenjang)) {
				$errors[] = 'Jenjang tidak valid';
			}
		}

		// Validasi akreditasi
		if (!empty($data['akreditasi']) && strlen($data['akreditasi']) > 10) {
			$errors[] = 'Akreditasi maksimal 10 karakter';
		}

		// Validasi deskripsi
		if (!empty($data['deskripsi']) && strlen($data['deskripsi']) > 5000) {
			$errors[] = 'Deskripsi maksimal 5000 karakter';
		}

		// Validasi visi
		if (!empty($data['visi']) && strlen($data['visi']) > 1000) {
			$errors[] = 'Visi maksimal 1000 karakter';
		}

		// Validasi misi
		if (!empty($data['misi']) && strlen($data['misi']) > 2000) {
			$errors[] = 'Misi maksimal 2000 karakter';
		}

		// Check unique nama dalam jurusan yang sama
		if (!empty($data['nama']) && !empty($data['jurusan_id'])) {
			if ($this->check_nama_exists($data['nama'], $data['jurusan_id'], $id)) {
				$errors[] = 'Nama program studi sudah ada dalam jurusan ini';
			}
		}

		// Validasi slug jika ada
		if (!empty($data['slug'])) {
			if ($this->check_slug_exists($data['slug'], $id)) {
				$errors[] = 'Slug sudah digunakan';
			}
		}

		return $errors;
	}

	// Enhanced tambah method
	public function tambah($data)
	{
		// Generate slug jika belum ada
		if (empty($data['slug']) && !empty($data['nama'])) {
			$data['slug'] = $this->generate_unique_slug($data['nama']);
		}

		// Validasi data
		$errors = $this->validate_data($data);
		if (!empty($errors)) {
			return array('status' => false, 'errors' => $errors);
		}

		// Set created_at jika ada kolom tersebut
		if ($this->db->field_exists('created_at', 'prodi')) {
			$data['created_at'] = date('Y-m-d H:i:s');
		}

		$result = $this->db->insert('prodi', $data);

		if ($result) {
			return array('status' => true, 'id' => $this->db->insert_id());
		} else {
			return array('status' => false, 'errors' => array('Gagal menyimpan data'));
		}
	}

	// Enhanced edit method
	public function edit($data)
	{
		$id = $data['id'];

		// Generate slug baru jika nama berubah
		if (!empty($data['nama'])) {
			// Get current data
			$current = $this->detail($id);
			if ($current && $current->nama !== $data['nama']) {
				$data['slug'] = $this->generate_unique_slug($data['nama'], $id);
			}
		}

		// Validasi data
		$errors = $this->validate_data($data, $id);
		if (!empty($errors)) {
			return array('status' => false, 'errors' => $errors);
		}

		// Remove id from data array
		unset($data['id']);

		// Set updated_at jika ada kolom tersebut
		if ($this->db->field_exists('updated_at', 'prodi')) {
			$data['updated_at'] = date('Y-m-d H:i:s');
		}

		$this->db->where('id', $id);
		$result = $this->db->update('prodi', $data);

		if ($result) {
			return array('status' => true);
		} else {
			return array('status' => false, 'errors' => array('Gagal mengupdate data'));
		}
	}

	// Delete data
	public function delete($data)
	{
		$this->db->where('id', $data['id']);
		return $this->db->delete('prodi');
	}

	// Enhanced import method
	public function import_batch($data_array)
	{
		$success = 0;
		$errors = array();

		foreach ($data_array as $index => $data) {
			// Generate slug
			if (empty($data['slug']) && !empty($data['nama'])) {
				$data['slug'] = $this->generate_unique_slug($data['nama']);
			}

			// Set created_at
			if ($this->db->field_exists('created_at', 'prodi')) {
				$data['created_at'] = date('Y-m-d H:i:s');
			}

			// Validasi setiap baris
			$validation_errors = $this->validate_data($data);

			if (empty($validation_errors)) {
				if ($this->db->insert('prodi', $data)) {
					$success++;
				} else {
					$errors[] = "Baris " . ($index + 1) . ": Gagal menyimpan data";
				}
			} else {
				$errors[] = "Baris " . ($index + 1) . ": " . implode(', ', $validation_errors);
			}
		}

		return array(
			'success' => $success,
			'errors' => $errors,
			'total' => count($data_array)
		);
	}
}

/* End of file Prodi_model.php */
/* Location: ./application/models/Prodi_model.php */