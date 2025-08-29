<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Capaian extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('capaian_model');

		$this->log_user->add_log();
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);
	}

	// Halaman capaian
	public function index()
	{
		$capaian = $this->capaian_model->listing();
		$site 	= $this->konfigurasi_model->listing();

		$data = array(
			'title'			=> 'capaian (' . count($capaian) . ')',
			'capaian'		=> $capaian,
			'site'			=> $site,
			'isi'			=> 'admin/capaian/list'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Halaman download
	public function files()
	{
		$download = $this->download_model->listing();
		$data = array(
			'title'			=> 'Download',
			'download'		=> $download
		);
		$this->load->view('admin/capaian/files', $data, FALSE);
	}

	// Halaman download
	public function gambar()
	{
		$galeri = $this->galeri_model->listing();
		$data = array(
			'title'			=> 'Galeri',
			'galeri'		=> $galeri
		);
		$this->load->view('admin/capaian/gambar', $data, FALSE);
	}

	// Status capaian
	public function status_capaian($status_capaian)
	{
		$capaian = $this->capaian_model->status_admin($status_capaian);
		$data = array(
			'title'			=> 'Status capaian: ' . $status_capaian . ' (' . count($capaian) . ')',
			'capaian'		=> $capaian,
			'isi'			=> 'admin/capaian/list'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Proses
	public function proses()
	{
		$site = $this->konfigurasi_model->listing();
		// PROSES HAPUS MULTIPLE
		if (isset($_POST['hapus'])) {
			$inp 				= $this->input;
			$id_capaiannya		= $inp->post('id_capaian');

			for ($i = 0; $i < sizeof($id_capaiannya); $i++) {
				$capaian 	= $this->capaian_model->detail($id_capaiannya[$i]);
				if ($capaian->gambar != '') {
					unlink('./assets/upload/capaian/' . $capaian->gambar);
					unlink('./assets/upload/capaian/thumbs/' . $capaian->gambar);
				}
				$data = array('id_capaian'	=> $id_capaiannya[$i]);
				$this->capaian_model->delete($data);
			}

			$this->session->set_flashdata('sukses', 'Data telah dihapus');
			redirect(base_url('admin/capaian'), 'refresh');
			// PROSES SETTING DRAFT
		} elseif (isset($_POST['draft'])) {
			$inp 				= $this->input;
			$id_capaiannya		= $inp->post('id_capaian');

			for ($i = 0; $i < sizeof($id_capaiannya); $i++) {
				$capaian 	= $this->capaian_model->detail($id_capaiannya[$i]);
				$data = array(
					'id_capaian'		=> $id_capaiannya[$i],
					'status_capaian'	=> 'Draft'
				);
				$this->capaian_model->edit($data);
			}

			$this->session->set_flashdata('sukses', 'Data telah diset untuk tidak dipublikasikan');
			redirect(base_url('admin/capaian'), 'refresh');
			// PROSES SETTING PUBLISH
		} elseif (isset($_POST['publish'])) {
			$inp 				= $this->input;
			$id_capaiannya		= $inp->post('id_capaian');

			for ($i = 0; $i < sizeof($id_capaiannya); $i++) {
				$capaian 	= $this->capaian_model->detail($id_capaiannya[$i]);
				$data = array(
					'id_capaian'		=> $id_capaiannya[$i],
					'status_capaian'	=> 'Publish'
				);
				$this->capaian_model->edit($data);
			}

			$this->session->set_flashdata('sukses', 'Data telah dipublikasikan');
			redirect(base_url('admin/capaian'), 'refresh');
		}
	}


	// Tambah capaian
	public function tambah()
	{
		// $this->session->set_userdata('upload_image_file_manager',true);
		$this->session->set_userdata('upload_image_file_manager', true);

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'judul_capaian',
			'Judul',
			'required',
			array('required'	=> 'Judul harus diisi')
		);

		$valid->set_rules(
			'isi',
			'Isi',
			'required',
			array('required'	=> 'Isi capaian harus diisi')
		);

		if ($valid->run()) {
			if (!empty($_FILES['gambar']['name'])) {
				$config['upload_path']   = './assets/upload/capaian/';
				$config['allowed_types'] = 'jpg|png|jpeg|webp';
				$config['max_size']      = '2000'; // KB  
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar')) {
					// End validasi

					$data = array(
						'title'			=> 'Tambah capaian',
						'error'    		=> $this->upload->display_errors(),
						'isi'			=> 'admin/capaian/tambah'
					);
					$this->load->view('admin/layout/wrapper', $data, FALSE);
					// Masuk database
				} else {
					$upload_data        		= array('uploads' => $this->upload->data());
					// Image Editor
					$config['image_library']  	= 'gd2';
					$config['source_image']   	= './assets/upload/capaian/' . $upload_data['uploads']['file_name'];
					$config['new_image']     	= './assets/upload/capaian/thumbs/';
					$config['create_thumb']   	= TRUE;
					$config['quality']       	= "100%";
					$config['maintain_ratio']   = TRUE;
					$config['width']       		= 360; // Pixel
					$config['height']       	= 180; // Pixel
					$config['x_axis']       	= 0;
					$config['y_axis']       	= 0;
					$config['thumb_marker']   	= '';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					$i 		= $this->input;
					$slug 	= url_title($i->post('judul_capaian'), 'dash', TRUE);

					$data = array(
						'id_user'		=> $this->session->userdata('id_user'),
						'slug_capaian'	=> $slug,
						'judul_capaian'	=> $i->post('judul_capaian'),
						'isi'			=> $i->post('isi'),
						'status_capaian'	=> $i->post('status_capaian'),
						'gambar'		=> $upload_data['uploads']['file_name'],
					);
					$this->capaian_model->tambah($data);
					$this->session->set_flashdata('sukses', 'Data telah ditambah');
					redirect(base_url('admin/capaian/status_capaian/' . $i->post('status_capaian')), 'refresh');
				}
			} else {
				$i 		= $this->input;
				$slug 	= url_title($i->post('judul_capaian'), 'dash', TRUE);

				$data = array(
					'id_user'		=> $this->session->userdata('id_user'),
					'slug_capaian'	=> $slug,
					'judul_capaian'	=> $i->post('judul_capaian'),
					'isi'			=> $i->post('isi'),
					'status_capaian'	=> $i->post('status_capaian'),
					'gambar'		=> $upload_data['uploads']['file_name'],
				);
				$this->capaian_model->tambah($data);
				$this->session->set_flashdata('sukses', 'Data telah ditambah');
				redirect(base_url('admin/capaian/status_capaian/' . $i->post('status_capaian')), 'refresh');
			}
		}
		// End masuk database
		$data = array(
			'title'			=> 'Tambah capaian',
			'isi'			=> 'admin/capaian/tambah'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Edit capaian
	public function edit($id_capaian)
	{
		$this->session->set_userdata('upload_image_file_manager', true);
		$capaian 	= $this->capaian_model->detail($id_capaian);
		$this->session->set_userdata('upload_image_file_manager', true);

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'judul_capaian',
			'Judul',
			'required',
			array('required'	=> 'Judul harus diisi')
		);

		$valid->set_rules(
			'isi',
			'Isi',
			'required',
			array('required'	=> 'Isi capaian harus diisi')
		);

		if ($valid->run()) {

			if (!empty($_FILES['gambar']['name'])) {

				$config['upload_path']   = './assets/upload/capaian/';
				$config['allowed_types'] = 'jpg|png|jpeg|webp';
				$config['max_size']      = '2000'; // KB  
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar')) {
					// End validasi

					$data = array(
						'title'			=> 'Edit capaian',
						'capaian'		=> $capaian,
						'error'    		=> $this->upload->display_errors(),
						'isi'			=> 'admin/capaian/edit'
					);
					$this->load->view('admin/layout/wrapper', $data, FALSE);
					// Masuk database
				} else {
					$upload_data        		= array('uploads' => $this->upload->data());
					// Image Editor
					$config['image_library']  	= 'gd2';
					$config['source_image']   	= './assets/upload/capaian/' . $upload_data['uploads']['file_name'];
					$config['new_image']     	= './assets/upload/capaian/thumbs/';
					$config['create_thumb']   	= TRUE;
					$config['quality']       	= "100%";
					$config['maintain_ratio']   = TRUE;
					$config['width']       		= 360; // Pixel
					$config['height']       	= 180; // Pixel
					$config['x_axis']       	= 0;
					$config['y_axis']       	= 0;
					$config['thumb_marker']   	= '';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					//Hapus gambar
					if ($capaian->gambar != "") {
						unlink('./assets/upload/capaian/' . $capaian->gambar);
						unlink('./assets/upload/capaian/thumbs/' . $capaian->gambar);
					}
					// End hapus

					$i 		= $this->input;
					$slug 	= url_title($i->post('judul_capaian'), 'dash', TRUE);

					$data = array(
						'id_capaian'		=> $id_capaian,
						'id_user'		=> $this->session->userdata('id_user'),
						'slug_capaian'	=> $slug,
						'judul_capaian'	=> $i->post('judul_capaian'),
						'isi'			=> $i->post('isi'),
						'status_capaian'	=> $i->post('status_capaian'),
						'gambar'		=> $upload_data['uploads']['file_name'],

					);
					$this->capaian_model->edit($data);
					$this->session->set_flashdata('sukses', 'Data telah diedit');
					redirect(base_url('admin/capaian/status_capaian/' . $i->post('status_capaian')), 'refresh');
				}
			} else {
				$i 		= $this->input;
				$slug 	= url_title($i->post('judul_capaian'), 'dash', TRUE);

				$data = array(
					'id_capaian'		=> $id_capaian,
					'id_user'		=> $this->session->userdata('id_user'),
					'slug_capaian'	=> $slug,
					'judul_capaian'	=> $i->post('judul_capaian'),
					'isi'			=> $i->post('isi'),
					'status_capaian'	=> $i->post('status_capaian'),
					// 'gambar'		=> $upload_data['uploads']['file_name'],

				);
				$this->capaian_model->edit($data);
				$this->session->set_flashdata('sukses', 'Data telah diedit');
				redirect(base_url('admin/capaian/status_capaian/' . $i->post('status_capaian')), 'refresh');
			}
		}
		// End masuk database
		$data = array(
			'title'			=> 'Edit capaian',
			'capaian'		=> $capaian,
			'isi'			=> 'admin/capaian/edit'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}


	// Delete
	public function delete($id_capaian)
	{
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);


		$capaian = $this->capaian_model->detail($id_capaian);
		// Proses hapus gambar
		if ($capaian->gambar != "") {
			unlink('./assets/upload/capaian/' . $capaian->gambar);
			unlink('./assets/upload/capaian/thumbs/' . $capaian->gambar);
		}
		// End hapus gambar
		$data = array('id_capaian'	=> $id_capaian);
		$this->capaian_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/capaian'), 'refresh');
	}
}

/* End of file capaian.php */
/* Location: ./application/controllers/admin/capaian.php */