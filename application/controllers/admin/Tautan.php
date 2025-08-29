<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tautan extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('tautan_model');

		$this->log_user->add_log();
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);
	}

	// Halaman tautan
	public function index()
	{
		$tautan = $this->tautan_model->listing();
		$site 	= $this->konfigurasi_model->listing();

		$data = array(
			'title'			=> 'Tautan (' . count($tautan) . ')',
			'tautan'		=> $tautan,
			'site'			=> $site,
			'isi'			=> 'admin/tautan/list'
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
		$this->load->view('admin/tautan/files', $data, FALSE);
	}

	// Halaman download
	public function gambar()
	{
		$galeri = $this->galeri_model->listing();
		$data = array(
			'title'			=> 'Galeri',
			'galeri'		=> $galeri
		);
		$this->load->view('admin/tautan/gambar', $data, FALSE);
	}

	// Status tautan
	public function status_tautan($status_tautan)
	{
		$tautan = $this->tautan_model->status_admin($status_tautan);
		$data = array(
			'title'			=> 'Status tautan: ' . $status_tautan . ' (' . count($tautan) . ')',
			'tautan'		=> $tautan,
			'isi'			=> 'admin/tautan/list'
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
			$id_tautannya		= $inp->post('id_tautan');

			for ($i = 0; $i < sizeof($id_tautannya); $i++) {
				$tautan 	= $this->tautan_model->detail($id_tautannya[$i]);
				if ($tautan->gambar != '') {
					unlink('./assets/upload/tautan/' . $tautan->gambar);
					unlink('./assets/upload/tautan/thumbs/' . $tautan->gambar);
				}
				$data = array('id_tautan'	=> $id_tautannya[$i]);
				$this->tautan_model->delete($data);
			}

			$this->session->set_flashdata('sukses', 'Data telah dihapus');
			redirect(base_url('admin/tautan'), 'refresh');
			// PROSES SETTING DRAFT
		} elseif (isset($_POST['draft'])) {
			$inp 				= $this->input;
			$id_tautannya		= $inp->post('id_tautan');

			for ($i = 0; $i < sizeof($id_tautannya); $i++) {
				$tautan 	= $this->tautan_model->detail($id_tautannya[$i]);
				$data = array(
					'id_tautan'		=> $id_tautannya[$i],
					'status_tautan'	=> 'Draft'
				);
				$this->tautan_model->edit($data);
			}

			$this->session->set_flashdata('sukses', 'Data telah diset untuk tidak dipublikasikan');
			redirect(base_url('admin/tautan'), 'refresh');
			// PROSES SETTING PUBLISH
		} elseif (isset($_POST['publish'])) {
			$inp 				= $this->input;
			$id_tautannya		= $inp->post('id_tautan');

			for ($i = 0; $i < sizeof($id_tautannya); $i++) {
				$tautan 	= $this->tautan_model->detail($id_tautannya[$i]);
				$data = array(
					'id_tautan'		=> $id_tautannya[$i],
					'status_tautan'	=> 'Publish'
				);
				$this->tautan_model->edit($data);
			}

			$this->session->set_flashdata('sukses', 'Data telah dipublikasikan');
			redirect(base_url('admin/tautan'), 'refresh');
		}
	}


	// Tambah tautan
	public function tambah()
	{
		// $this->session->set_userdata('upload_image_file_manager',true);
		$this->session->set_userdata('upload_image_file_manager', true);

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'judul_tautan',
			'Judul',
			'required',
			array('required'	=> 'Judul harus diisi')
		);

		$valid->set_rules(
			'isi',
			'Isi',
			'required',
			array('required'	=> 'Isi tautan harus diisi')
		);

		if ($valid->run()) {
			if (!empty($_FILES['gambar']['name'])) {
				$config['upload_path']   = './assets/upload/tautan/';
				$config['allowed_types'] = 'jpg|png|jpeg|webp';
				$config['max_size']      = '2000'; // KB  
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar')) {
					// End validasi

					$data = array(
						'title'			=> 'Tambah Tautan',
						'error'    		=> $this->upload->display_errors(),
						'isi'			=> 'admin/tautan/tambah'
					);
					$this->load->view('admin/layout/wrapper', $data, FALSE);
					// Masuk database
				} else {
					$upload_data        		= array('uploads' => $this->upload->data());
					// Image Editor
					$config['image_library']  	= 'gd2';
					$config['source_image']   	= './assets/upload/tautan/' . $upload_data['uploads']['file_name'];
					$config['new_image']     	= './assets/upload/tautan/thumbs/';
					$config['create_thumb']   	= TRUE;
					$config['quality']       	= "100%";
					$config['maintain_ratio']   = TRUE;
					$config['width']       		= 360; // Pixel
					$config['height']       	= 360; // Pixel
					$config['x_axis']       	= 0;
					$config['y_axis']       	= 0;
					$config['thumb_marker']   	= '';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					$i 		= $this->input;
					$slug 	= url_title($i->post('judul_tautan'), 'dash', TRUE);

					$data = array(
						'id_user'		=> $this->session->userdata('id_user'),
						'slug_tautan'	=> $slug,
						'judul_tautan'	=> $i->post('judul_tautan'),
						'isi'			=> $i->post('isi'),
						'link_tautan'	=> $i->post('link_tautan'),
						'status_tautan'	=> $i->post('status_tautan'),
						'gambar'		=> $upload_data['uploads']['file_name'],
						'urutan'	    => $i->post('urutan'),
					);
					$this->tautan_model->tambah($data);
					$this->session->set_flashdata('sukses', 'Data telah ditambah');
					redirect(base_url('admin/tautan/status_tautan/' . $i->post('status_tautan')), 'refresh');
				}
			} else {
				$i 		= $this->input;
				$slug 	= url_title($i->post('judul_tautan'), 'dash', TRUE);

				$data = array(
					'id_user'		=> $this->session->userdata('id_user'),
					'slug_tautan'	=> $slug,
					'judul_tautan'	=> $i->post('judul_tautan'),
					'isi'			=> $i->post('isi'),
					'link_tautan'	=> $i->post('link_tautan'),
					'status_tautan'	=> $i->post('status_tautan'),
					'gambar'		=> $upload_data['uploads']['file_name'],
					'urutan'	    => $i->post('urutan'),
				);
				$this->tautan_model->tambah($data);
				$this->session->set_flashdata('sukses', 'Data telah ditambah');
				redirect(base_url('admin/tautan/status_tautan/' . $i->post('status_tautan')), 'refresh');
			}
		}
		// End masuk database
		$data = array(
			'title'			=> 'Tambah Tautan',
			'isi'			=> 'admin/tautan/tambah'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Edit tautan
	public function edit($id_tautan)
	{
		$this->session->set_userdata('upload_image_file_manager', true);
		$tautan 	= $this->tautan_model->detail($id_tautan);
		$this->session->set_userdata('upload_image_file_manager', true);

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'judul_tautan',
			'Judul',
			'required',
			array('required'	=> 'Judul harus diisi')
		);

		$valid->set_rules(
			'isi',
			'Isi',
			'required',
			array('required'	=> 'Isi tautan harus diisi')
		);

		if ($valid->run()) {

			if (!empty($_FILES['gambar']['name'])) {

				$config['upload_path']   = './assets/upload/tautan/';
				$config['allowed_types'] = 'jpg|png|jpeg|webp';
				$config['max_size']      = '2000'; // KB  
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar')) {
					// End validasi

					$data = array(
						'title'			=> 'Edit Tautan',
						'tautan'		=> $tautan,
						'error'    		=> $this->upload->display_errors(),
						'isi'			=> 'admin/tautan/edit'
					);
					$this->load->view('admin/layout/wrapper', $data, FALSE);
					// Masuk database
				} else {
					$upload_data        		= array('uploads' => $this->upload->data());
					// Image Editor
					$config['image_library']  	= 'gd2';
					$config['source_image']   	= './assets/upload/tautan/' . $upload_data['uploads']['file_name'];
					$config['new_image']     	= './assets/upload/tautan/thumbs/';
					$config['create_thumb']   	= TRUE;
					$config['quality']       	= "100%";
					$config['maintain_ratio']   = TRUE;
					$config['width']       		= 360; // Pixel
					$config['height']       	= 360; // Pixel
					$config['x_axis']       	= 0;
					$config['y_axis']       	= 0;
					$config['thumb_marker']   	= '';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					//Hapus gambar
					if ($tautan->gambar != "") {
						unlink('./assets/upload/tautan/' . $tautan->gambar);
						unlink('./assets/upload/tautan/thumbs/' . $tautan->gambar);
					}
					// End hapus

					$i 		= $this->input;
					$slug 	= url_title($i->post('judul_tautan'), 'dash', TRUE);

					$data = array(
						'id_tautan'		=> $id_tautan,
						'id_user'		=> $this->session->userdata('id_user'),
						'slug_tautan'	=> $slug,
						'judul_tautan'	=> $i->post('judul_tautan'),
						'isi'			=> $i->post('isi'),
						'link_tautan'	=> $i->post('link_tautan'),
						'status_tautan'	=> $i->post('status_tautan'),
						'gambar'		=> $upload_data['uploads']['file_name'],
						'urutan'	    => $i->post('urutan'),
					);
					$this->tautan_model->edit($data);
					$this->session->set_flashdata('sukses', 'Data telah diedit');
					redirect(base_url('admin/tautan/status_tautan/' . $i->post('status_tautan')), 'refresh');
				}
			} else {
				$i 		= $this->input;
				$slug 	= url_title($i->post('judul_tautan'), 'dash', TRUE);

				$data = array(
					'id_tautan'		=> $id_tautan,
					'id_user'		=> $this->session->userdata('id_user'),
					'slug_tautan'	=> $slug,
					'judul_tautan'	=> $i->post('judul_tautan'),
					'isi'			=> $i->post('isi'),
					'link_tautan'	=> $i->post('link_tautan'),
					'status_tautan'	=> $i->post('status_tautan'),
					// 'gambar'		=> $upload_data['uploads']['file_name'],
					'urutan'	    => $i->post('urutan'),
				);
				$this->tautan_model->edit($data);
				$this->session->set_flashdata('sukses', 'Data telah diedit');
				redirect(base_url('admin/tautan/status_tautan/' . $i->post('status_tautan')), 'refresh');
			}
		}
		// End masuk database
		$data = array(
			'title'			=> 'Edit Tautan',
			'tautan'		=> $tautan,
			'isi'			=> 'admin/tautan/edit'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}


	// Delete
	public function delete($id_tautan)
	{
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);


		$tautan = $this->tautan_model->detail($id_tautan);
		// Proses hapus gambar
		if ($tautan->gambar != "") {
			unlink('./assets/upload/tautan/' . $tautan->gambar);
			unlink('./assets/upload/tautan/thumbs/' . $tautan->gambar);
		}
		// End hapus gambar
		$data = array('id_tautan'	=> $id_tautan);
		$this->tautan_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/tautan'), 'refresh');
	}
}

/* End of file tautan.php */
/* Location: ./application/controllers/admin/tautan.php */