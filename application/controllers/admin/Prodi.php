<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prodi extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('prodi_model');
		$this->load->model('jurusan_model');
		$this->load->helper('text'); // Load text helper untuk slug
		$this->log_user->add_log();
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan = $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);
	}

	// Halaman utama
	public function index()
	{
		// Validasi
		$valid = $this->form_validation;

		// Validasi field wajib
		$valid->set_rules(
			'jurusan_id',
			'Jurusan',
			'required|numeric',
			array(
				'required' => 'Jurusan harus dipilih',
				'numeric' => 'Jurusan tidak valid'
			)
		);

		$valid->set_rules(
			'nama',
			'Nama Program Studi',
			'required|max_length[100]',
			array(
				'required' => 'Nama program studi harus diisi',
				'max_length' => 'Nama program studi maksimal 100 karakter'
			)
		);

		// Validasi field opsional
		$valid->set_rules('jenjang', 'Jenjang', 'max_length[50]');
		$valid->set_rules('akreditasi', 'Akreditasi', 'max_length[20]');
		$valid->set_rules('mode_kuliah', 'Mode Kuliah', 'max_length[100]');
		$valid->set_rules('biaya_kuliah', 'Biaya Kuliah', 'max_length[100]');
		$valid->set_rules('icon', 'Icon', 'max_length[100]');
		$valid->set_rules('color', 'Color', 'max_length[50]');
		$valid->set_rules('prospek_title', 'Prospek Title', 'max_length[100]');
		$valid->set_rules('link_brosur', 'Link Brosur', 'max_length[255]|valid_url');
		$valid->set_rules('link_detail', 'Link Detail', 'max_length[255]|valid_url');
		$valid->set_rules('durasi', 'Durasi', 'numeric|max_length[2]');
		$valid->set_rules('total_sks', 'Total SKS', 'numeric|max_length[3]');
		$valid->set_rules('gelar', 'Gelar', 'max_length[50]');

		// Validasi field baru
		$valid->set_rules('alumni_count', 'Jumlah Alumni', 'numeric');
		$valid->set_rules('job_placement', 'Job Placement', 'numeric|decimal');
		$valid->set_rules('rating', 'Rating', 'numeric|decimal');

		if ($valid->run() === false) {
			// End validasi
			$data = array(
				'title' => 'Data Program Studi',
				'prodi' => $this->prodi_model->listing(),
				'jurusan_dropdown' => $this->jurusan_model->dropdown(),
				'isi' => 'admin/prodi/list'
			);
			$this->load->view('admin/layout/wrapper', $data, false);
		} else {
			// Proses masuk ke database
			$i = $this->input;

			// Persiapkan data keunggulan (convert dari array ke JSON)
			$keunggulan = $i->post('keunggulan');
			if (is_array($keunggulan)) {
				$keunggulan = json_encode(array_filter($keunggulan)); // Filter empty values
			}

			// Persiapkan data prospek karir (convert dari array ke JSON)
			$prospek_karir = $i->post('prospek_karir');
			if (is_array($prospek_karir)) {
				$prospek_karir = json_encode(array_filter($prospek_karir)); // Filter empty values
			}

			// Validasi dan format data numerik baru
			$alumni_count = $i->post('alumni_count');
			$job_placement = $i->post('job_placement');
			$rating = $i->post('rating');

			// Set default values jika kosong
			if (empty($alumni_count) || !is_numeric($alumni_count)) {
				$alumni_count = 100;
			}
			if (empty($job_placement) || !is_numeric($job_placement)) {
				$job_placement = 90.00;
			}
			if (empty($rating) || !is_numeric($rating)) {
				$rating = 4.50;
			}

			// Validasi range nilai
			$job_placement = max(0, min(100, $job_placement)); // 0-100%
			$rating = max(0, min(5, $rating)); // 0-5 rating

			$data = array(
				'jurusan_id' => $i->post('jurusan_id'),
				'nama' => $i->post('nama'),
				'jenjang' => $i->post('jenjang'),
				'akreditasi' => $i->post('akreditasi'),
				'mode_kuliah' => $i->post('mode_kuliah'),
				'biaya_kuliah' => $i->post('biaya_kuliah'),
				'icon' => $i->post('icon'),
				'color' => $i->post('color'),
				'keunggulan' => $keunggulan,
				'prospek_karir' => $prospek_karir,
				'prospek_title' => $i->post('prospek_title'),
				'link_brosur' => $i->post('link_brosur'),
				'link_detail' => $i->post('link_detail'),
				'status' => $i->post('status') ?: 'active',
				'deskripsi' => $i->post('deskripsi'),
				'durasi' => $i->post('durasi'),
				'total_sks' => $i->post('total_sks'),
				'gelar' => $i->post('gelar'),
				'visi' => $i->post('visi'),
				'misi' => $i->post('misi'),
				// Field baru
				'alumni_count' => (int)$alumni_count,
				'job_placement' => (float)$job_placement,
				'rating' => (float)$rating
			);

			// Gunakan method tambah dari model
			$result = $this->prodi_model->tambah($data);

			if ($result) {
				$this->session->set_flashdata('sukses', 'Data program studi telah berhasil ditambahkan');
			} else {
				$this->session->set_flashdata('error', 'Gagal menambahkan data program studi');
			}

			redirect(base_url('admin/prodi'), 'refresh');
		}
	}

	// Edit prodi
	public function edit($id)
	{
		// Check apakah prodi exists
		$prodi = $this->prodi_model->detail($id);
		if (!$prodi) {
			$this->session->set_flashdata('error', 'Data program studi tidak ditemukan');
			redirect(base_url('admin/prodi'), 'refresh');
		}

		// Validasi
		$valid = $this->form_validation;

		// Validasi field wajib
		$valid->set_rules(
			'jurusan_id',
			'Jurusan',
			'required|numeric',
			array(
				'required' => 'Jurusan harus dipilih',
				'numeric' => 'Jurusan tidak valid'
			)
		);

		$valid->set_rules(
			'nama',
			'Nama Program Studi',
			'required|max_length[100]',
			array(
				'required' => 'Nama program studi harus diisi',
				'max_length' => 'Nama program studi maksimal 100 karakter'
			)
		);

		// Validasi field opsional
		$valid->set_rules('jenjang', 'Jenjang', 'max_length[50]');
		$valid->set_rules('akreditasi', 'Akreditasi', 'max_length[20]');
		$valid->set_rules('mode_kuliah', 'Mode Kuliah', 'max_length[100]');
		$valid->set_rules('biaya_kuliah', 'Biaya Kuliah', 'max_length[100]');
		$valid->set_rules('icon', 'Icon', 'max_length[100]');
		$valid->set_rules('color', 'Color', 'max_length[50]');
		$valid->set_rules('prospek_title', 'Prospek Title', 'max_length[100]');
		$valid->set_rules('link_brosur', 'Link Brosur', 'max_length[255]|valid_url');
		$valid->set_rules('link_detail', 'Link Detail', 'max_length[255]|valid_url');
		$valid->set_rules('durasi', 'Durasi', 'numeric|max_length[2]');
		$valid->set_rules('total_sks', 'Total SKS', 'numeric|max_length[3]');
		$valid->set_rules('gelar', 'Gelar', 'max_length[50]');

		// Validasi field baru
		$valid->set_rules('alumni_count', 'Jumlah Alumni', 'numeric');
		$valid->set_rules('job_placement', 'Job Placement', 'numeric|decimal');
		$valid->set_rules('rating', 'Rating', 'numeric|decimal');

		if ($valid->run() === false) {
			// Decode JSON data untuk form
			$prodi->keunggulan_array = !empty($prodi->keunggulan) ? json_decode($prodi->keunggulan, true) : array();
			$prodi->prospek_karir_array = !empty($prodi->prospek_karir) ? json_decode($prodi->prospek_karir, true) : array();

			$data = array(
				'title' => 'Edit Program Studi',
				'prodi' => $prodi,
				'jurusan_dropdown' => $this->jurusan_model->dropdown(),
				'isi' => 'admin/prodi/edit'
			);
			$this->load->view('admin/layout/wrapper', $data, false);
		} else {
			// Proses update ke database
			$i = $this->input;

			// Persiapkan data keunggulan (convert dari array ke JSON)
			$keunggulan = $i->post('keunggulan');
			if (is_array($keunggulan)) {
				$keunggulan = json_encode(array_filter($keunggulan));
			}

			// Persiapkan data prospek karir (convert dari array ke JSON)
			$prospek_karir = $i->post('prospek_karir');
			if (is_array($prospek_karir)) {
				$prospek_karir = json_encode(array_filter($prospek_karir));
			}

			// Validasi dan format data numerik baru
			$alumni_count = $i->post('alumni_count');
			$job_placement = $i->post('job_placement');
			$rating = $i->post('rating');

			// Gunakan nilai existing jika input kosong
			if (empty($alumni_count) || !is_numeric($alumni_count)) {
				$alumni_count = $prodi->alumni_count ?: 100;
			}
			if (empty($job_placement) || !is_numeric($job_placement)) {
				$job_placement = $prodi->job_placement ?: 90.00;
			}
			if (empty($rating) || !is_numeric($rating)) {
				$rating = $prodi->rating ?: 4.50;
			}

			// Validasi range nilai
			$job_placement = max(0, min(100, $job_placement)); // 0-100%
			$rating = max(0, min(5, $rating)); // 0-5 rating

			$data = array(
				'id' => $id,
				'jurusan_id' => $i->post('jurusan_id'),
				'nama' => $i->post('nama'),
				'jenjang' => $i->post('jenjang'),
				'akreditasi' => $i->post('akreditasi'),
				'mode_kuliah' => $i->post('mode_kuliah'),
				'biaya_kuliah' => $i->post('biaya_kuliah'),
				'icon' => $i->post('icon'),
				'color' => $i->post('color'),
				'keunggulan' => $keunggulan,
				'prospek_karir' => $prospek_karir,
				'prospek_title' => $i->post('prospek_title'),
				'link_brosur' => $i->post('link_brosur'),
				'link_detail' => $i->post('link_detail'),
				'status' => $i->post('status'),
				'deskripsi' => $i->post('deskripsi'),
				'durasi' => $i->post('durasi'),
				'total_sks' => $i->post('total_sks'),
				'gelar' => $i->post('gelar'),
				'visi' => $i->post('visi'),
				'misi' => $i->post('misi'),
				// Field baru
				'alumni_count' => (int)$alumni_count,
				'job_placement' => (float)$job_placement,
				'rating' => (float)$rating,
				'updated_at' => date('Y-m-d H:i:s')
			);

			// Gunakan method edit dari model
			$result = $this->prodi_model->edit($data);

			if ($result) {
				$this->session->set_flashdata('sukses', 'Data program studi telah berhasil diperbarui');
			} else {
				$this->session->set_flashdata('error', 'Gagal memperbarui data program studi');
			}

			redirect(base_url('admin/prodi'), 'refresh');
		}
	}

	// Delete prodi
	public function delete($id)
	{
		// Proteksi proses delete harus login
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan = $this->session->set_userdata('pengalihan', $url_pengalihan);
		$this->simple_login->check_login($pengalihan);

		// Check apakah prodi exists
		$prodi = $this->prodi_model->detail($id);
		if (!$prodi) {
			$this->session->set_flashdata('error', 'Data program studi tidak ditemukan');
			redirect(base_url('admin/prodi'), 'refresh');
		}

		$data = array('id' => $id);
		$result = $this->prodi_model->delete($data);

		if ($result) {
			$this->session->set_flashdata('sukses', 'Data program studi telah berhasil dihapus');
		} else {
			$this->session->set_flashdata('error', 'Gagal menghapus data program studi');
		}

		redirect(base_url('admin/prodi'), 'refresh');
	}

	// Detail prodi
	public function detail($id)
	{
		$prodi = $this->prodi_model->detail($id);

		if (!$prodi) {
			$this->session->set_flashdata('error', 'Data program studi tidak ditemukan');
			redirect(base_url('admin/prodi'), 'refresh');
		}

		// Decode JSON data untuk tampilan
		$prodi->keunggulan_array = !empty($prodi->keunggulan) ? json_decode($prodi->keunggulan, true) : array();
		$prodi->prospek_karir_array = !empty($prodi->prospek_karir) ? json_decode($prodi->prospek_karir, true) : array();

		$data = array(
			'title' => 'Detail Program Studi: ' . $prodi->nama,
			'prodi' => $prodi,
			'isi' => 'admin/prodi/detail'
		);
		$this->load->view('admin/layout/wrapper', $data, false);
	}

	// Get prodi by jurusan (AJAX)
	public function get_by_jurusan()
	{
		if ($this->input->is_ajax_request()) {
			$jurusan_id = $this->input->post('jurusan_id');

			if (!empty($jurusan_id)) {
				$prodi_list = $this->prodi_model->by_jurusan($jurusan_id);

				$result = array();
				foreach ($prodi_list as $prodi) {
					$result[] = array(
						'id' => $prodi->id,
						'nama' => $prodi->nama,
						'jenjang' => $prodi->jenjang,
						'slug' => $prodi->slug,
						'akreditasi' => $prodi->akreditasi,
						'job_placement' => $prodi->job_placement,
						'rating' => $prodi->rating,
						'alumni_count' => $prodi->alumni_count
					);
				}

				echo json_encode(array('status' => 'success', 'data' => $result));
			} else {
				echo json_encode(array('status' => 'error', 'message' => 'Jurusan ID tidak valid'));
			}
		} else {
			show_404();
		}
	}

	// Change status (active/inactive)
	public function change_status($id)
	{
		$prodi = $this->prodi_model->detail($id);
		if (!$prodi) {
			$this->session->set_flashdata('error', 'Data program studi tidak ditemukan');
			redirect(base_url('admin/prodi'), 'refresh');
		}

		$new_status = ($prodi->status == 'active') ? 'inactive' : 'active';

		$data = array(
			'id' => $id,
			'status' => $new_status,
			'updated_at' => date('Y-m-d H:i:s')
		);

		$result = $this->prodi_model->edit($data);

		if ($result) {
			$status_text = ($new_status == 'active') ? 'diaktifkan' : 'dinonaktifkan';
			$this->session->set_flashdata('sukses', 'Program studi telah berhasil ' . $status_text);
		} else {
			$this->session->set_flashdata('error', 'Gagal mengubah status program studi');
		}

		redirect(base_url('admin/prodi'), 'refresh');
	}

	// Update statistik prodi (AJAX)
	public function update_statistics($id)
	{
		if ($this->input->is_ajax_request()) {
			$prodi = $this->prodi_model->detail($id);
			if (!$prodi) {
				echo json_encode(array('status' => 'error', 'message' => 'Data program studi tidak ditemukan'));
				return;
			}

			// Validasi input
			$alumni_count = $this->input->post('alumni_count');
			$job_placement = $this->input->post('job_placement');
			$rating = $this->input->post('rating');

			// Validasi numerik
			if (!is_numeric($alumni_count) || !is_numeric($job_placement) || !is_numeric($rating)) {
				echo json_encode(array('status' => 'error', 'message' => 'Data harus berupa angka'));
				return;
			}

			// Validasi range
			$alumni_count = max(0, (int)$alumni_count);
			$job_placement = max(0, min(100, (float)$job_placement));
			$rating = max(0, min(5, (float)$rating));

			$data = array(
				'id' => $id,
				'alumni_count' => $alumni_count,
				'job_placement' => $job_placement,
				'rating' => $rating,
				'updated_at' => date('Y-m-d H:i:s')
			);

			$result = $this->prodi_model->edit($data);

			if ($result) {
				echo json_encode(array(
					'status' => 'success',
					'message' => 'Statistik berhasil diperbarui',
					'data' => array(
						'alumni_count' => $alumni_count,
						'job_placement' => $job_placement,
						'rating' => $rating
					)
				));
			} else {
				echo json_encode(array('status' => 'error', 'message' => 'Gagal memperbarui statistik'));
			}
		} else {
			show_404();
		}
	}

	// Get statistics summary (AJAX)
	public function get_statistics()
	{
		if ($this->input->is_ajax_request()) {
			$stats = $this->prodi_model->get_statistics_summary();

			echo json_encode(array(
				'status' => 'success',
				'data' => array(
					'total_prodi' => $stats->total_prodi,
					'active_prodi' => $stats->active_prodi,
					'total_alumni' => $stats->total_alumni,
					'avg_job_placement' => round($stats->avg_job_placement, 2),
					'avg_rating' => round($stats->avg_rating, 2),
					'highest_rating' => $stats->highest_rating,
					'lowest_rating' => $stats->lowest_rating
				)
			));
		} else {
			show_404();
		}
	}

	// Export prodi data (CSV)
	public function export_csv()
	{
		$this->load->helper('download');

		$prodi_list = $this->prodi_model->listing();

		$csv_content = "ID,Nama Prodi,Jurusan,Jenjang,Akreditasi,Durasi,Total SKS,Gelar,Alumni Count,Job Placement,Rating,Status,Created At\n";

		foreach ($prodi_list as $prodi) {
			$csv_content .= sprintf(
				'"%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s"' . "\n",
				$prodi->id,
				$prodi->nama,
				$prodi->nama_jurusan,
				$prodi->jenjang,
				$prodi->akreditasi,
				$prodi->durasi,
				$prodi->total_sks,
				$prodi->gelar,
				$prodi->alumni_count,
				$prodi->job_placement,
				$prodi->rating,
				$prodi->status,
				$prodi->created_at
			);
		}

		$filename = 'data_prodi_' . date('Y-m-d_H-i-s') . '.csv';
		force_download($filename, $csv_content);
	}

	// Bulk update status
	public function bulk_status()
	{
		if ($this->input->is_ajax_request()) {
			$ids = $this->input->post('ids');
			$new_status = $this->input->post('status');

			if (empty($ids) || !in_array($new_status, array('active', 'inactive'))) {
				echo json_encode(array('status' => 'error', 'message' => 'Data tidak valid'));
				return;
			}

			$success_count = 0;
			foreach ($ids as $id) {
				$data = array(
					'id' => $id,
					'status' => $new_status,
					'updated_at' => date('Y-m-d H:i:s')
				);

				if ($this->prodi_model->edit($data)) {
					$success_count++;
				}
			}

			$total_ids = count($ids);
			$status_text = ($new_status == 'active') ? 'diaktifkan' : 'dinonaktifkan';

			echo json_encode(array(
				'status' => 'success',
				'message' => "$success_count dari $total_ids program studi berhasil $status_text"
			));
		} else {
			show_404();
		}
	}

	// Preview prodi (for frontend view)
	public function preview($id)
	{
		$prodi = $this->prodi_model->detail($id);
		if (!$prodi) {
			show_404();
		}

		// Decode JSON data
		$prodi->keunggulan_array = !empty($prodi->keunggulan) ? json_decode($prodi->keunggulan, true) : array();
		$prodi->prospek_karir_array = !empty($prodi->prospek_karir) ? json_decode($prodi->prospek_karir, true) : array();

		$data = array(
			'title' => 'Preview: ' . $prodi->nama,
			'prodi' => $prodi,
			'isi' => 'admin/prodi/preview'
		);
		$this->load->view('admin/layout/wrapper', $data, false);
	}
}

/* End of file Prodi.php */
/* Location: ./application/controllers/admin/Prodi.php */