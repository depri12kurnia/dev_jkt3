<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Maturity extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('maturity_model');

		$this->log_user->add_log();
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);
	}

	// Halaman maturity
	public function index()
	{
		$maturity = $this->maturity_model->listing();
		$site 	= $this->konfigurasi_model->listing();

		$data = array(
			'title'			=> 'Maturity Rating (' . count($maturity) . ')',
			'maturity'		=> $maturity,
			'site'			=> $site,
			'isi'			=> 'admin/maturity/list'
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
		$this->load->view('admin/maturity/files', $data, FALSE);
	}

	// Halaman download
	public function gambar()
	{
		$galeri = $this->galeri_model->listing();
		$data = array(
			'title'			=> 'Galeri',
			'galeri'		=> $galeri
		);
		$this->load->view('admin/maturity/gambar', $data, FALSE);
	}

	// Status maturity
	public function status_maturity($status_maturity)
	{
		$maturity = $this->maturity_model->status_admin($status_maturity);
		$data = array(
			'title'			=> 'Status maturity: ' . $status_maturity . ' (' . count($maturity) . ')',
			'maturity'		=> $maturity,
			'isi'			=> 'admin/maturity/list'
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
			$id_maturitynya		= $inp->post('id_maturity');

			for ($i = 0; $i < sizeof($id_maturitynya); $i++) {
				$maturity 	= $this->maturity_model->detail($id_maturitynya[$i]);
				if ($maturity->gambar != '') {
					unlink('./assets/upload/maturity/' . $maturity->gambar);
					unlink('./assets/upload/maturity/thumbs/' . $maturity->gambar);
				}
				$data = array('id_maturity'	=> $id_maturitynya[$i]);
				$this->maturity_model->delete($data);
			}

			$this->session->set_flashdata('sukses', 'Data telah dihapus');
			redirect(base_url('admin/maturity'), 'refresh');
			// PROSES SETTING DRAFT
		} elseif (isset($_POST['draft'])) {
			$inp 				= $this->input;
			$id_maturitynya		= $inp->post('id_maturity');

			for ($i = 0; $i < sizeof($id_maturitynya); $i++) {
				$maturity 	= $this->maturity_model->detail($id_maturitynya[$i]);
				$data = array(
					'id_maturity'		=> $id_maturitynya[$i],
					'status_maturity'	=> 'Draft'
				);
				$this->maturity_model->edit($data);
			}

			$this->session->set_flashdata('sukses', 'Data telah diset untuk tidak dipublikasikan');
			redirect(base_url('admin/maturity'), 'refresh');
			// PROSES SETTING PUBLISH
		} elseif (isset($_POST['publish'])) {
			$inp 				= $this->input;
			$id_maturitynya		= $inp->post('id_maturity');

			for ($i = 0; $i < sizeof($id_maturitynya); $i++) {
				$maturity 	= $this->maturity_model->detail($id_maturitynya[$i]);
				$data = array(
					'id_maturity'		=> $id_maturitynya[$i],
					'status_maturity'	=> 'Publish'
				);
				$this->maturity_model->edit($data);
			}

			$this->session->set_flashdata('sukses', 'Data telah dipublikasikan');
			redirect(base_url('admin/maturity'), 'refresh');
		}
	}


	// Tambah maturity
	public function tambah()
	{
		// $this->session->set_userdata('upload_image_file_manager',true);
		$this->session->set_userdata('upload_image_file_manager', true);

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'judul_maturity',
			'Judul',
			'required',
			array('required'	=> 'Judul harus diisi')
		);

		$valid->set_rules(
			'isi',
			'Isi',
			'required',
			array('required'	=> 'Isi maturity harus diisi')
		);

		if ($valid->run()) {
			if (!empty($_FILES['gambar']['name'])) {
				$config['upload_path']   = './assets/upload/maturity/';
				$config['allowed_types'] = 'jpg|png|jpeg|webp|pdf';
				$config['max_size']      = '2000'; // KB  
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar')) {
					// End validasi

					$data = array(
						'title'			=> 'Tambah maturity',
						'error'    		=> $this->upload->display_errors(),
						'isi'			=> 'admin/maturity/tambah'
					);
					$this->load->view('admin/layout/wrapper', $data, FALSE);
					// Masuk database
				} else {
					$upload_data        		= array('uploads' => $this->upload->data());
					// Image Editor
					$config['image_library']  	= 'gd2';
					$config['source_image']   	= './assets/upload/maturity/' . $upload_data['uploads']['file_name'];
					$config['new_image']     	= './assets/upload/maturity/thumbs/';
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
					$slug 	= url_title($i->post('judul_maturity'), 'dash', TRUE);

					$data = array(
						'id_user'		=> $this->session->userdata('id_user'),
						'slug_maturity'	=> $slug,
						'judul_maturity'	=> $i->post('judul_maturity'),
						'isi'			=> $i->post('isi'),
						'status_maturity'	=> $i->post('status_maturity'),
						'gambar'		=> $upload_data['uploads']['file_name'],
					);
					$this->maturity_model->tambah($data);
					$this->session->set_flashdata('sukses', 'Data telah ditambah');
					redirect(base_url('admin/maturity/status_maturity/' . $i->post('status_maturity')), 'refresh');
				}
			} else {
				$i 		= $this->input;
				$slug 	= url_title($i->post('judul_maturity'), 'dash', TRUE);

				$data = array(
					'id_user'		=> $this->session->userdata('id_user'),
					'slug_maturity'	=> $slug,
					'judul_maturity'	=> $i->post('judul_maturity'),
					'isi'			=> $i->post('isi'),
					'status_maturity'	=> $i->post('status_maturity'),
					'gambar'		=> $upload_data['uploads']['file_name'],
				);
				$this->maturity_model->tambah($data);
				$this->session->set_flashdata('sukses', 'Data telah ditambah');
				redirect(base_url('admin/maturity/status_maturity/' . $i->post('status_maturity')), 'refresh');
			}
		}
		// End masuk database
		$data = array(
			'title'			=> 'Tambah maturity',
			'isi'			=> 'admin/maturity/tambah'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Edit maturity
	public function edit($id_maturity)
	{
		$this->session->set_userdata('upload_image_file_manager', true);
		$maturity 	= $this->maturity_model->detail($id_maturity);
		$this->session->set_userdata('upload_image_file_manager', true);

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'judul_maturity',
			'Judul',
			'required',
			array('required'	=> 'Judul harus diisi')
		);

		$valid->set_rules(
			'isi',
			'Isi',
			'required',
			array('required'	=> 'Isi maturity harus diisi')
		);

		if ($valid->run()) {

			if (!empty($_FILES['gambar']['name'])) {

				$config['upload_path']   = './assets/upload/maturity/';
				$config['allowed_types'] = 'jpg|png|jpeg|webp|pdf';
				$config['max_size']      = '2000'; // KB  
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar')) {
					// End validasi

					$data = array(
						'title'			=> 'Edit maturity',
						'maturity'		=> $maturity,
						'error'    		=> $this->upload->display_errors(),
						'isi'			=> 'admin/maturity/edit'
					);
					$this->load->view('admin/layout/wrapper', $data, FALSE);
					// Masuk database
				} else {
					$upload_data        		= array('uploads' => $this->upload->data());
					// Image Editor
					$config['image_library']  	= 'gd2';
					$config['source_image']   	= './assets/upload/maturity/' . $upload_data['uploads']['file_name'];
					$config['new_image']     	= './assets/upload/maturity/thumbs/';
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
					if ($maturity->gambar != "") {
						unlink('./assets/upload/maturity/' . $maturity->gambar);
						unlink('./assets/upload/maturity/thumbs/' . $maturity->gambar);
					}
					// End hapus

					$i 		= $this->input;
					$slug 	= url_title($i->post('judul_maturity'), 'dash', TRUE);

					$data = array(
						'id_maturity'		=> $id_maturity,
						'id_user'		=> $this->session->userdata('id_user'),
						'slug_maturity'	=> $slug,
						'judul_maturity'	=> $i->post('judul_maturity'),
						'isi'			=> $i->post('isi'),
						'status_maturity'	=> $i->post('status_maturity'),
						'gambar'		=> $upload_data['uploads']['file_name'],

					);
					$this->maturity_model->edit($data);
					$this->session->set_flashdata('sukses', 'Data telah diedit');
					redirect(base_url('admin/maturity/status_maturity/' . $i->post('status_maturity')), 'refresh');
				}
			} else {
				$i 		= $this->input;
				$slug 	= url_title($i->post('judul_maturity'), 'dash', TRUE);

				$data = array(
					'id_maturity'		=> $id_maturity,
					'id_user'		=> $this->session->userdata('id_user'),
					'slug_maturity'	=> $slug,
					'judul_maturity'	=> $i->post('judul_maturity'),
					'isi'			=> $i->post('isi'),
					'status_maturity'	=> $i->post('status_maturity'),
					// 'gambar'		=> $upload_data['uploads']['file_name'],

				);
				$this->maturity_model->edit($data);
				$this->session->set_flashdata('sukses', 'Data telah diedit');
				redirect(base_url('admin/maturity/status_maturity/' . $i->post('status_maturity')), 'refresh');
			}
		}
		// End masuk database
		$data = array(
			'title'			=> 'Edit maturity',
			'maturity'		=> $maturity,
			'isi'			=> 'admin/maturity/edit'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}


	// Delete
	public function delete($id_maturity)
	{
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);


		$maturity = $this->maturity_model->detail($id_maturity);
		// Proses hapus gambar
		if ($maturity->gambar != "") {
			unlink('./assets/upload/maturity/' . $maturity->gambar);
			unlink('./assets/upload/maturity/thumbs/' . $maturity->gambar);
		}
		// End hapus gambar
		$data = array('id_maturity'	=> $id_maturity);
		$this->maturity_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/maturity'), 'refresh');
	}
}

/* End of file maturity.php */
/* Location: ./application/controllers/admin/maturity.php */