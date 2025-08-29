<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mitra extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mitra_model');

		$this->log_user->add_log();
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);
	}

	// Halaman mitra
	public function index()
	{
		$mitra = $this->mitra_model->listing();
		$site 	= $this->konfigurasi_model->listing();

		$data = array(
			'title'			=> 'mitra (' . count($mitra) . ')',
			'mitra'			=> $mitra,
			'site'			=> $site,
			'isi'			=> 'admin/mitra/list'
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
		$this->load->view('admin/mitra/files', $data, FALSE);
	}

	// Halaman download
	public function gambar()
	{
		$galeri = $this->galeri_model->listing();
		$data = array(
			'title'			=> 'Galeri',
			'galeri'		=> $galeri
		);
		$this->load->view('admin/mitra/gambar', $data, FALSE);
	}

	// Status mitra
	public function status_mitra($status_mitra)
	{
		$mitra = $this->mitra_model->status_admin($status_mitra);
		$data = array(
			'title'			=> 'Status mitra: ' . $status_mitra . ' (' . count($mitra) . ')',
			'mitra'			=> $mitra,
			'isi'			=> 'admin/mitra/list'
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
			$id_mitranya		= $inp->post('id_mitra');

			for ($i = 0; $i < sizeof($id_mitranya); $i++) {
				$mitra 	= $this->mitra_model->detail($id_mitranya[$i]);
				if ($mitra->gambar != '') {
					unlink('./assets/upload/mitra/' . $mitra->gambar);
					unlink('./assets/upload/mitra/thumbs/' . $mitra->gambar);
				}
				$data = array('id_mitra'	=> $id_mitranya[$i]);
				$this->mitra_model->delete($data);
			}

			$this->session->set_flashdata('sukses', 'Data telah dihapus');
			redirect(base_url('admin/mitra'), 'refresh');
			// PROSES SETTING DRAFT
		} elseif (isset($_POST['draft'])) {
			$inp 				= $this->input;
			$id_mitranya		= $inp->post('id_mitra');

			for ($i = 0; $i < sizeof($id_mitranya); $i++) {
				$mitra 	= $this->mitra_model->detail($id_mitranya[$i]);
				$data = array(
					'id_mitra'		=> $id_mitranya[$i],
					'status_mitra'	=> 'Draft'
				);
				$this->mitra_model->edit($data);
			}

			$this->session->set_flashdata('sukses', 'Data telah diset untuk tidak dipublikasikan');
			redirect(base_url('admin/mitra'), 'refresh');
			// PROSES SETTING PUBLISH
		} elseif (isset($_POST['publish'])) {
			$inp 				= $this->input;
			$id_mitranya		= $inp->post('id_mitra');

			for ($i = 0; $i < sizeof($id_mitranya); $i++) {
				$mitra 	= $this->mitra_model->detail($id_mitranya[$i]);
				$data = array(
					'id_mitra'		=> $id_mitranya[$i],
					'status_mitra'	=> 'Publish'
				);
				$this->mitra_model->edit($data);
			}

			$this->session->set_flashdata('sukses', 'Data telah dipublikasikan');
			redirect(base_url('admin/mitra'), 'refresh');
		}
	}


	// Tambah mitra
	public function tambah()
	{
		// $this->session->set_userdata('upload_image_file_manager',true);
		$this->session->set_userdata('upload_image_file_manager', true);

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'judul_mitra',
			'Judul',
			'required',
			array('required'	=> 'Judul harus diisi')
		);

		$valid->set_rules(
			'isi',
			'Isi',
			'required',
			array('required'	=> 'Isi mitra harus diisi')
		);

		if ($valid->run()) {
			if (!empty($_FILES['gambar']['name'])) {
				$config['upload_path']   = './assets/upload/mitra/';
				$config['allowed_types'] = 'jpg|png|jpeg|webp';
				$config['max_size']      = '2000'; // KB  
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar')) {
					// End validasi

					$data = array(
						'title'			=> 'Tambah mitra',
						'error'    		=> $this->upload->display_errors(),
						'isi'			=> 'admin/mitra/tambah'
					);
					$this->load->view('admin/layout/wrapper', $data, FALSE);
					// Masuk database
				} else {
					$upload_data        		= array('uploads' => $this->upload->data());
					// Image Editor
					$config['image_library']  	= 'gd2';
					$config['source_image']   	= './assets/upload/mitra/' . $upload_data['uploads']['file_name'];
					$config['new_image']     	= './assets/upload/mitra/thumbs/';
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
					$slug 	= url_title($i->post('judul_mitra'), 'dash', TRUE);

					$data = array(
						'id_user'		=> $this->session->userdata('id_user'),
						'slug_mitra'	=> $slug,
						'judul_mitra'	=> $i->post('judul_mitra'),
						'isi'			=> $i->post('isi'),
						'link_mitra'	=> $i->post('link_mitra'),
						'status_mitra'	=> $i->post('status_mitra'),
						'gambar'		=> $upload_data['uploads']['file_name'],
						'urutan'	    => $i->post('urutan'),
					);
					$this->mitra_model->tambah($data);
					$this->session->set_flashdata('sukses', 'Data telah ditambah');
					redirect(base_url('admin/mitra/status_mitra/' . $i->post('status_mitra')), 'refresh');
				}
			} else {
				$i 		= $this->input;
				$slug 	= url_title($i->post('judul_mitra'), 'dash', TRUE);

				$data = array(
					'id_user'		=> $this->session->userdata('id_user'),
					'slug_mitra'	=> $slug,
					'judul_mitra'	=> $i->post('judul_mitra'),
					'isi'			=> $i->post('isi'),
					'link_mitra'	=> $i->post('link_mitra'),
					'status_mitra'	=> $i->post('status_mitra'),
					'urutan'	    => $i->post('urutan'),
				);
				$this->mitra_model->tambah($data);
				$this->session->set_flashdata('sukses', 'Data telah ditambah');
				redirect(base_url('admin/mitra/status_mitra/' . $i->post('status_mitra')), 'refresh');
			}
		}
		// End masuk database
		$data = array(
			'title'			=> 'Tambah mitra',
			'isi'			=> 'admin/mitra/tambah'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Edit mitra
	public function edit($id_mitra)
	{
		$this->session->set_userdata('upload_image_file_manager', true);
		$mitra 	= $this->mitra_model->detail($id_mitra);
		$this->session->set_userdata('upload_image_file_manager', true);

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'judul_mitra',
			'Judul',
			'required',
			array('required'	=> 'Judul harus diisi')
		);

		$valid->set_rules(
			'isi',
			'Isi',
			'required',
			array('required'	=> 'Isi mitra harus diisi')
		);

		if ($valid->run()) {

			if (!empty($_FILES['gambar']['name'])) {

				$config['upload_path']   = './assets/upload/mitra/';
				$config['allowed_types'] = 'jpg|png|jpeg|webp';
				$config['max_size']      = '2000'; // KB  
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar')) {
					// End validasi

					$data = array(
						'title'			=> 'Edit mitra',
						'mitra'		=> $mitra,
						'error'    		=> $this->upload->display_errors(),
						'isi'			=> 'admin/mitra/edit'
					);
					$this->load->view('admin/layout/wrapper', $data, FALSE);
					// Masuk database
				} else {
					$upload_data        		= array('uploads' => $this->upload->data());
					// Image Editor
					$config['image_library']  	= 'gd2';
					$config['source_image']   	= './assets/upload/mitra/' . $upload_data['uploads']['file_name'];
					$config['new_image']     	= './assets/upload/mitra/thumbs/';
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
					if ($mitra->gambar != "") {
						unlink('./assets/upload/mitra/' . $mitra->gambar);
						unlink('./assets/upload/mitra/thumbs/' . $mitra->gambar);
					}
					// End hapus

					$i 		= $this->input;
					$slug 	= url_title($i->post('judul_mitra'), 'dash', TRUE);

					$data = array(
						'id_mitra'		=> $id_mitra,
						'id_user'		=> $this->session->userdata('id_user'),
						'slug_mitra'	=> $slug,
						'judul_mitra'	=> $i->post('judul_mitra'),
						'isi'			=> $i->post('isi'),
						'link_mitra'	=> $i->post('link_mitra'),
						'status_mitra'	=> $i->post('status_mitra'),
						'gambar'		=> $upload_data['uploads']['file_name'],
						'urutan'	    => $i->post('urutan'),
					);
					$this->mitra_model->edit($data);
					$this->session->set_flashdata('sukses', 'Data telah diedit');
					redirect(base_url('admin/mitra/status_mitra/' . $i->post('status_mitra')), 'refresh');
				}
			} else {
				$i 		= $this->input;
				$slug 	= url_title($i->post('judul_mitra'), 'dash', TRUE);

				$data = array(
					'id_mitra'		=> $id_mitra,
					'id_user'		=> $this->session->userdata('id_user'),
					'slug_mitra'	=> $slug,
					'judul_mitra'	=> $i->post('judul_mitra'),
					'isi'			=> $i->post('isi'),
					'link_mitra'	=> $i->post('link_mitra'),
					'status_mitra'	=> $i->post('status_mitra'),
					// 'gambar'		=> $upload_data['uploads']['file_name'],
					'urutan'	    => $i->post('urutan'),
				);
				$this->mitra_model->edit($data);
				$this->session->set_flashdata('sukses', 'Data telah diedit');
				redirect(base_url('admin/mitra/status_mitra/' . $i->post('status_mitra')), 'refresh');
			}
		}
		// End masuk database
		$data = array(
			'title'			=> 'Edit mitra',
			'mitra'		=> $mitra,
			'isi'			=> 'admin/mitra/edit'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}


	// Delete
	public function delete($id_mitra)
	{
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);


		$mitra = $this->mitra_model->detail($id_mitra);
		// Proses hapus gambar
		if ($mitra->gambar != "") {
			unlink('./assets/upload/mitra/' . $mitra->gambar);
			unlink('./assets/upload/mitra/thumbs/' . $mitra->gambar);
		}
		// End hapus gambar
		$data = array('id_mitra'	=> $id_mitra);
		$this->mitra_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/mitra'), 'refresh');
	}
}

/* End of file mitra.php */
/* Location: ./application/controllers/admin/mitra.php */