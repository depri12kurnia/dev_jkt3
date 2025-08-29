<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('jurusan_model');
		$this->load->model('prodi_model');
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

		$valid->set_rules(
			'nama',
			'Nama jurusan',
			'required|max_length[100]',
			array(
				'required' => 'Nama jurusan harus diisi',
				'max_length' => 'Nama jurusan maksimal 100 karakter'
			)
		);

		$valid->set_rules(
			'deskripsi',
			'Deskripsi',
			'max_length[1000]',
			array(
				'max_length' => 'Deskripsi maksimal 1000 karakter'
			)
		);

		$valid->set_rules(
			'color',
			'Color Theme',
			'in_list[primary,secondary,success,danger,warning,info,light,dark]',
			array(
				'in_list' => 'Color theme harus dipilih dari opsi yang tersedia'
			)
		);

		$valid->set_rules(
			'status',
			'Status',
			'max_length[100]',
			array(
				'max_length' => 'Status maksimal 100 karakter'
			)
		);

		$valid->set_rules(
			'tagline',
			'Tagline',
			'max_length[200]',
			array(
				'max_length' => 'Tagline maksimal 200 karakter'
			)
		);

		$valid->set_rules(
			'link_brosur',
			'Link Brosur',
			'valid_url|max_length[255]',
			array(
				'valid_url' => 'Link brosur harus berupa URL yang valid',
				'max_length' => 'Link brosur maksimal 255 karakter'
			)
		);

		$valid->set_rules(
			'link_virtual_tour',
			'Link Virtual Tour',
			'valid_url|max_length[255]',
			array(
				'valid_url' => 'Link virtual tour harus berupa URL yang valid',
				'max_length' => 'Link virtual tour maksimal 255 karakter'
			)
		);

		if ($valid->run() === false) {
			// End validasi

			$data = array(
				'title' => 'Data Jurusan',
				'jurusan' => $this->jurusan_model->listing(),
				'isi' => 'admin/jurusan/list'
			);
			$this->load->view('admin/layout/wrapper', $data, false);
		} else {
			$i = $this->input;

			// Handle image upload
			$image_name = '';
			if (!empty($_FILES['image']['name'])) {
				$image_name = $this->_upload_image();
				if (!$image_name) {
					$this->session->set_flashdata('error', 'Gagal upload gambar');
					redirect(base_url('admin/jurusan'), 'refresh');
				}
			}

			// Process features
			$features = array();
			$feature_icons = $i->post('feature_icon');
			$feature_colors = $i->post('feature_color');
			$feature_texts = $i->post('feature_text');

			if (!empty($feature_icons)) {
				for ($index = 0; $index < count($feature_icons); $index++) {
					if (!empty($feature_texts[$index])) {
						$features[] = array(
							'icon' => $feature_icons[$index],
							'color' => $feature_colors[$index],
							'text' => $feature_texts[$index]
						);
					}
				}
			}

			$data = array(
				'nama' => $i->post('nama'),
				'deskripsi' => $i->post('deskripsi'),
				'color' => $i->post('color') ?: 'primary',
				'icon' => $i->post('icon') ?: 'bi bi-mortarboard',
				'status' => $i->post('status') ?: 'Jurusan Unggulan',
				'tagline' => $i->post('tagline'),
				'features' => !empty($features) ? json_encode($features) : null,
				'link_brosur' => $i->post('link_brosur'),
				'link_virtual_tour' => $i->post('link_virtual_tour'),
				'image' => $image_name
			);

			$result = $this->jurusan_model->tambah($data);

			if ($result) {
				$this->session->set_flashdata('sukses', 'Data jurusan telah berhasil ditambahkan');
			} else {
				$this->session->set_flashdata('error', 'Gagal menambahkan data jurusan');
			}

			redirect(base_url('admin/jurusan'), 'refresh');
		}
	}

	// Edit jurusan
	public function edit($id)
	{
		// Check apakah jurusan exists
		$jurusan = $this->jurusan_model->detail($id);
		if (!$jurusan) {
			$this->session->set_flashdata('error', 'Data jurusan tidak ditemukan');
			redirect(base_url('admin/jurusan'), 'refresh');
		}

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'nama',
			'Nama jurusan',
			'required|max_length[100]',
			array(
				'required' => 'Nama jurusan harus diisi',
				'max_length' => 'Nama jurusan maksimal 100 karakter'
			)
		);

		$valid->set_rules(
			'deskripsi',
			'Deskripsi',
			'max_length[1000]',
			array(
				'max_length' => 'Deskripsi maksimal 1000 karakter'
			)
		);

		$valid->set_rules(
			'color',
			'Color Theme',
			'in_list[primary,secondary,success,danger,warning,info,light,dark]',
			array(
				'in_list' => 'Color theme harus dipilih dari opsi yang tersedia'
			)
		);

		$valid->set_rules(
			'status',
			'Status',
			'max_length[100]',
			array(
				'max_length' => 'Status maksimal 100 karakter'
			)
		);

		$valid->set_rules(
			'tagline',
			'Tagline',
			'max_length[200]',
			array(
				'max_length' => 'Tagline maksimal 200 karakter'
			)
		);

		$valid->set_rules(
			'link_brosur',
			'Link Brosur',
			'valid_url|max_length[255]',
			array(
				'valid_url' => 'Link brosur harus berupa URL yang valid',
				'max_length' => 'Link brosur maksimal 255 karakter'
			)
		);

		$valid->set_rules(
			'link_virtual_tour',
			'Link Virtual Tour',
			'valid_url|max_length[255]',
			array(
				'valid_url' => 'Link virtual tour harus berupa URL yang valid',
				'max_length' => 'Link virtual tour maksimal 255 karakter'
			)
		);

		if ($valid->run() === false) {
			// Parse existing features for editing
			$existing_features = array();
			if (!empty($jurusan->features)) {
				$existing_features = json_decode($jurusan->features, true);
			}

			$data = array(
				'title' => 'Edit Jurusan',
				'jurusan' => $jurusan,
				'existing_features' => $existing_features,
				'isi' => 'admin/jurusan/edit'
			);
			$this->load->view('admin/layout/wrapper', $data, false);
		} else {
			$i = $this->input;

			// Handle image upload
			$image_name = $jurusan->image; // Keep existing image
			if (!empty($_FILES['image']['name'])) {
				$new_image = $this->_upload_image();
				if ($new_image) {
					// Delete old image if exists
					if (!empty($jurusan->image) && file_exists('./assets/images/jurusan/' . $jurusan->image)) {
						unlink('./assets/images/jurusan/' . $jurusan->image);
					}
					$image_name = $new_image;
				}
			}

			// Process features
			$features = array();
			$feature_icons = $i->post('feature_icon');
			$feature_colors = $i->post('feature_color');
			$feature_texts = $i->post('feature_text');

			if (!empty($feature_icons)) {
				for ($index = 0; $index < count($feature_icons); $index++) {
					if (!empty($feature_texts[$index])) {
						$features[] = array(
							'icon' => $feature_icons[$index],
							'color' => $feature_colors[$index],
							'text' => $feature_texts[$index]
						);
					}
				}
			}

			$data = array(
				'id' => $id,
				'nama' => $i->post('nama'),
				'deskripsi' => $i->post('deskripsi'),
				'color' => $i->post('color') ?: 'primary',
				'icon' => $i->post('icon') ?: 'bi bi-mortarboard',
				'status' => $i->post('status') ?: 'Jurusan Unggulan',
				'tagline' => $i->post('tagline'),
				'features' => !empty($features) ? json_encode($features) : null,
				'link_brosur' => $i->post('link_brosur'),
				'link_virtual_tour' => $i->post('link_virtual_tour'),
				'image' => $image_name
			);

			$result = $this->jurusan_model->edit($data);

			if ($result) {
				$this->session->set_flashdata('sukses', 'Data jurusan telah berhasil diperbarui');
			} else {
				$this->session->set_flashdata('error', 'Gagal memperbarui data jurusan');
			}

			redirect(base_url('admin/jurusan'), 'refresh');
		}
	}

	// Delete jurusan
	public function delete($id)
	{
		// Proteksi proses delete harus login
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan = $this->session->set_userdata('pengalihan', $url_pengalihan);
		$this->simple_login->check_login($pengalihan);

		// Check apakah jurusan exists
		$jurusan = $this->jurusan_model->detail($id);
		if (!$jurusan) {
			$this->session->set_flashdata('error', 'Data jurusan tidak ditemukan');
			redirect(base_url('admin/jurusan'), 'refresh');
		}

		// Check apakah jurusan masih digunakan oleh prodi
		$this->load->model('prodi_model');
		$prodi_count = $this->prodi_model->count_by_jurusan($id);

		if ($prodi_count > 0) {
			$this->session->set_flashdata('error', 'Tidak dapat menghapus jurusan karena masih memiliki program studi');
			redirect(base_url('admin/jurusan'), 'refresh');
		}

		// Delete image file if exists
		if (!empty($jurusan->image) && file_exists('./assets/images/jurusan/' . $jurusan->image)) {
			unlink('./assets/images/jurusan/' . $jurusan->image);
		}

		$data = array('id' => $id);
		$result = $this->jurusan_model->delete($data);

		if ($result) {
			$this->session->set_flashdata('sukses', 'Data jurusan telah berhasil dihapus');
		} else {
			$this->session->set_flashdata('error', 'Gagal menghapus data jurusan');
		}

		redirect(base_url('admin/jurusan'), 'refresh');
	}

	// Detail jurusan
	public function detail($id)
	{
		$jurusan = $this->jurusan_model->detail($id);

		if (!$jurusan) {
			$this->session->set_flashdata('error', 'Data jurusan tidak ditemukan');
			redirect(base_url('admin/jurusan'), 'refresh');
		}

		// Parse features for display
		$features = array();
		if (!empty($jurusan->features)) {
			$features = json_decode($jurusan->features, true);
		}

		// Load model prodi untuk menampilkan prodi dalam jurusan ini
		$this->load->model('prodi_model');
		$prodi_list = $this->prodi_model->by_jurusan($id);

		$data = array(
			'title' => 'Detail Jurusan: ' . $jurusan->nama,
			'jurusan' => $jurusan,
			'features' => $features,
			'prodi_list' => $prodi_list,
			'isi' => 'admin/jurusan/detail'
		);
		$this->load->view('admin/layout/wrapper', $data, false);
	}

	// Search jurusan
	public function search()
	{
		$keyword = $this->input->get('q');

		if (empty($keyword)) {
			redirect(base_url('admin/jurusan'), 'refresh');
		}

		$jurusan = $this->jurusan_model->search($keyword);

		// Process highlighting
		foreach ($jurusan as $row) {
			$row->nama = $this->highlight_search($row->nama, $keyword);
			$row->slug = $this->highlight_search($row->slug, $keyword);
			if (!empty($row->deskripsi)) {
				$row->deskripsi = $this->highlight_search(character_limiter(strip_tags($row->deskripsi), 100), $keyword);
			}
			if (!empty($row->tagline)) {
				$row->tagline = $this->highlight_search($row->tagline, $keyword);
			}
		}

		$data = array(
			'title' => 'Hasil Pencarian: ' . $keyword,
			'keyword' => $keyword,
			'jurusan' => $jurusan,
			'isi' => 'admin/jurusan/search'
		);
		$this->load->view('admin/layout/wrapper', $data, false);
	}

	// Export data jurusan ke CSV
	public function export()
	{
		$this->load->helper('download');
		$this->load->helper('file');

		$jurusan = $this->jurusan_model->listing();

		// Buat header CSV
		$csv_content = "ID,Nama Jurusan,Slug,Deskripsi,Color,Icon,Status,Tagline,Link Brosur,Link Virtual Tour,Image,Tanggal Dibuat\n";

		// Tambahkan data
		foreach ($jurusan as $row) {
			$csv_content .= '"' . $row->id . '",';
			$csv_content .= '"' . str_replace('"', '""', $row->nama) . '",';
			$csv_content .= '"' . $row->slug . '",';
			$csv_content .= '"' . str_replace('"', '""', $row->deskripsi) . '",';
			$csv_content .= '"' . $row->color . '",';
			$csv_content .= '"' . $row->icon . '",';
			$csv_content .= '"' . str_replace('"', '""', $row->status) . '",';
			$csv_content .= '"' . str_replace('"', '""', $row->tagline) . '",';
			$csv_content .= '"' . $row->link_brosur . '",';
			$csv_content .= '"' . $row->link_virtual_tour . '",';
			$csv_content .= '"' . $row->image . '",';
			$csv_content .= '"' . $row->created_at . '"' . "\n";
		}

		$filename = 'data_jurusan_' . date('Y-m-d_H-i-s') . '.csv';
		force_download($filename, $csv_content);
	}

	// Import data jurusan dari CSV
	public function import()
	{
		if ($this->input->post('submit')) {
			// Konfigurasi upload
			$config['upload_path'] = './uploads/temp/';
			$config['allowed_types'] = 'csv';
			$config['max_size'] = 2048; // 2MB
			$config['file_name'] = 'import_jurusan_' . time();

			// Buat folder jika belum ada
			if (!is_dir($config['upload_path'])) {
				mkdir($config['upload_path'], 0755, true);
			}

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('csv_file')) {
				$file_data = $this->upload->data();
				$file_path = $file_data['full_path'];

				// Baca file CSV
				$csv_data = array();
				if (($handle = fopen($file_path, 'r')) !== FALSE) {
					$header = fgetcsv($handle); // Skip header
					while (($data = fgetcsv($handle)) !== FALSE) {
						if (!empty($data[0])) { // Pastikan nama tidak kosong
							$csv_data[] = array(
								'nama' => $data[0],
								'deskripsi' => isset($data[1]) ? $data[1] : '',
								'color' => isset($data[2]) ? $data[2] : 'primary',
								'icon' => isset($data[3]) ? $data[3] : 'bi bi-mortarboard',
								'status' => isset($data[4]) ? $data[4] : 'Jurusan Unggulan',
								'tagline' => isset($data[5]) ? $data[5] : '',
								'link_brosur' => isset($data[6]) ? $data[6] : '',
								'link_virtual_tour' => isset($data[7]) ? $data[7] : ''
							);
						}
					}
					fclose($handle);
				}

				// Import ke database
				if (!empty($csv_data)) {
					$result = $this->jurusan_model->import_batch($csv_data);

					$this->session->set_flashdata(
						'sukses',
						'Import berhasil! ' . $result['success'] . ' dari ' . $result['total'] . ' data berhasil diimport'
					);

					if (!empty($result['errors'])) {
						$this->session->set_flashdata(
							'error',
							'Beberapa data gagal diimport: ' . implode(', ', array_slice($result['errors'], 0, 5))
						);
					}
				} else {
					$this->session->set_flashdata('error', 'File CSV kosong atau format tidak valid');
				}

				// Hapus file temporary
				unlink($file_path);
			} else {
				$this->session->set_flashdata('error', $this->upload->display_errors());
			}

			redirect(base_url('admin/jurusan'), 'refresh');
		}

		// Tampilkan form import
		$data = array(
			'title' => 'Import Data Jurusan',
			'isi' => 'admin/jurusan/import'
		);
		$this->load->view('admin/layout/wrapper', $data, false);
	}

	// Soft delete (jika menggunakan soft delete)
	public function soft_delete($id)
	{
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan = $this->session->set_userdata('pengalihan', $url_pengalihan);
		$this->simple_login->check_login($pengalihan);

		$jurusan = $this->jurusan_model->detail($id);
		if (!$jurusan) {
			$this->session->set_flashdata('error', 'Data jurusan tidak ditemukan');
			redirect(base_url('admin/jurusan'), 'refresh');
		}

		$result = $this->jurusan_model->soft_delete($id);

		if ($result) {
			$this->session->set_flashdata('sukses', 'Data jurusan telah berhasil dinonaktifkan');
		} else {
			$this->session->set_flashdata('error', 'Gagal menonaktifkan data jurusan');
		}

		redirect(base_url('admin/jurusan'), 'refresh');
	}

	// Generate slug manual (AJAX)
	public function generate_slug()
	{
		if ($this->input->is_ajax_request()) {
			$nama = $this->input->post('nama');
			$id = $this->input->post('id'); // Untuk edit

			if (!empty($nama)) {
				$slug = $this->jurusan_model->generate_slug($nama, $id);
				echo json_encode(array('status' => 'success', 'slug' => $slug));
			} else {
				echo json_encode(array('status' => 'error', 'message' => 'Nama tidak boleh kosong'));
			}
		} else {
			show_404();
		}
	}

	// Check slug availability (AJAX)
	public function check_slug()
	{
		if ($this->input->is_ajax_request()) {
			$slug = $this->input->post('slug');
			$id = $this->input->post('id'); // Untuk edit

			if (!empty($slug)) {
				$exists = $this->jurusan_model->check_slug($slug, $id);
				echo json_encode(array('exists' => $exists));
			} else {
				echo json_encode(array('exists' => false));
			}
		} else {
			show_404();
		}
	}

	// Get features data (AJAX)
	public function get_features($id)
	{
		if ($this->input->is_ajax_request()) {
			$jurusan = $this->jurusan_model->detail($id);
			$features = array();

			if ($jurusan && !empty($jurusan->features)) {
				$features = json_decode($jurusan->features, true);
			}

			echo json_encode($features);
		} else {
			show_404();
		}
	}

	// Upload image method
	private function _upload_image()
	{
		$config['upload_path'] = './assets/images/jurusan/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
		$config['max_size'] = 2048; // 2MB
		$config['max_width'] = 2000;
		$config['max_height'] = 2000;
		$config['encrypt_name'] = TRUE;

		// Buat folder jika belum ada
		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0755, true);
		}

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('image')) {
			$upload_data = $this->upload->data();
			return $upload_data['file_name'];
		} else {
			$this->session->set_flashdata('error', $this->upload->display_errors());
			return false;
		}
	}

	// Delete image
	public function delete_image($id)
	{
		if ($this->input->is_ajax_request()) {
			$jurusan = $this->jurusan_model->detail($id);

			if ($jurusan && !empty($jurusan->image)) {
				// Delete file
				if (file_exists('./assets/images/jurusan/' . $jurusan->image)) {
					unlink('./assets/images/jurusan/' . $jurusan->image);
				}

				// Update database
				$result = $this->jurusan_model->edit(array('id' => $id, 'image' => ''));

				echo json_encode(array('status' => $result ? 'success' : 'error'));
			} else {
				echo json_encode(array('status' => 'error', 'message' => 'Image not found'));
			}
		} else {
			show_404();
		}
	}

	// Preview jurusan (untuk melihat tampilan frontend)
	public function preview($id)
	{
		$jurusan = $this->jurusan_model->detail($id);

		if (!$jurusan) {
			$this->session->set_flashdata('error', 'Data jurusan tidak ditemukan');
			redirect(base_url('admin/jurusan'), 'refresh');
		}

		// Load prodi data
		$this->load->model('prodi_model');
		$prodi_list = $this->prodi_model->by_jurusan($id);

		$data = array(
			'title' => 'Preview Jurusan: ' . $jurusan->nama,
			'jurusan_data' => $jurusan,
			'prodi_list' => $prodi_list,
			'is_preview' => true
		);

		$this->load->view('jurusan/list', $data, false);
	}

	// Get icon list for dropdown (AJAX)
	public function get_icons()
	{
		if ($this->input->is_ajax_request()) {
			$icons = array(
				'bi bi-mortarboard' => 'Mortarboard (Default)',
				'bi bi-book' => 'Book',
				'bi bi-laptop' => 'Laptop',
				'bi bi-gear' => 'Gear',
				'bi bi-heart-pulse' => 'Heart Pulse',
				'bi bi-calculator' => 'Calculator',
				'bi bi-palette' => 'Palette',
				'bi bi-music-note' => 'Music Note',
				'bi bi-camera' => 'Camera',
				'bi bi-building' => 'Building',
				'bi bi-globe' => 'Globe',
				'bi bi-cpu' => 'CPU',
				'bi bi-microscope' => 'Microscope',
				'bi bi-graph-up' => 'Graph Up',
				'bi bi-people' => 'People',
				'bi bi-award' => 'Award'
			);

			echo json_encode($icons);
		} else {
			show_404();
		}
	}

	// Bulk actions
	public function bulk_action()
	{
		if ($this->input->post('bulk_action') && $this->input->post('selected_ids')) {
			$action = $this->input->post('bulk_action');
			$ids = $this->input->post('selected_ids');

			$success_count = 0;
			$error_count = 0;

			foreach ($ids as $id) {
				switch ($action) {
					case 'delete':
						if ($this->jurusan_model->delete(array('id' => $id))) {
							$success_count++;
						} else {
							$error_count++;
						}
						break;

					case 'soft_delete':
						if ($this->jurusan_model->soft_delete($id)) {
							$success_count++;
						} else {
							$error_count++;
						}
						break;
				}
			}

			if ($success_count > 0) {
				$this->session->set_flashdata('sukses', $success_count . ' data berhasil diproses');
			}

			if ($error_count > 0) {
				$this->session->set_flashdata('error', $error_count . ' data gagal diproses');
			}
		}

		redirect(base_url('admin/jurusan'), 'refresh');
	}

	// Private method untuk highlighting search
	private function highlight_search($text, $keyword)
	{
		if (empty($keyword)) return $text;

		$highlighted = preg_replace(
			'/(' . preg_quote($keyword, '/') . ')/i',
			'<mark>$1</mark>',
			$text
		);

		return $highlighted;
	}
}

/* End of file Jurusan.php */
/* Location: ./application/controllers/admin/Jurusan.php */
