<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Magazine extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('magazine_model');
		$this->log_user->add_log();
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);
	}

	// Halaman magazine
	public function index()
	{
		$magazine = $this->magazine_model->listing();
		$site 	= $this->konfigurasi_model->listing();

		$data = array(
			'title'			=> 'E-Magazine (' . count($magazine) . ')',
			'magazine'		=> $magazine,
			'site'			=> $site,
			'isi'			=> 'admin/magazine/list'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}


	// Status magazine
	public function status_magazine($status_magazine)
	{
		$magazine = $this->magazine_model->status_admin($status_magazine);
		$data = array(
			'title'			=> 'Status magazine: ' . $status_magazine . ' (' . count($magazine) . ')',
			'magazine'		=> $magazine,
			'isi'			=> 'admin/magazine/list'
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
			$id_magazinenya		= $inp->post('id_magazine');

			for ($i = 0; $i < sizeof($id_magazinenya); $i++) {
				$magazine 	= $this->magazine_model->detail($id_magazinenya[$i]);
				if ($magazine->pdfmagazine != '') {
					unlink('./assets/upload/magazine/' . $magazine->pdfmagazine);
					unlink('./assets/upload/magazine/thumb/' . $magazine->pdfmagazine);
				}
				$data = array('id_magazine'	=> $id_magazinenya[$i]);
				$this->magazine_model->delete($data);
			}

			$this->session->set_flashdata('sukses', 'Data telah dihapus');
			redirect(base_url('admin/magazine'), 'refresh');
			// PROSES SETTING DRAFT
		} elseif (isset($_POST['draft'])) {
			$inp 				= $this->input;
			$id_magazinenya		= $inp->post('id_magazine');

			for ($i = 0; $i < sizeof($id_magazinenya); $i++) {
				$magazine 	= $this->magazine_model->detail($id_magazinenya[$i]);
				$data = array(
					'id_magazine'		=> $id_magazinenya[$i],
					'status_magazine'	=> 'Draft'
				);
				$this->magazine_model->edit($data);
			}

			$this->session->set_flashdata('sukses', 'Data telah diset untuk tidak dipublikasikan');
			redirect(base_url('admin/magazine'), 'refresh');
			// PROSES SETTING PUBLISH
		} elseif (isset($_POST['publish'])) {
			$inp 				= $this->input;
			$id_magazinenya		= $inp->post('id_magazine');

			for ($i = 0; $i < sizeof($id_magazinenya); $i++) {
				$magazine 	= $this->magazine_model->detail($id_magazinenya[$i]);
				$data = array(
					'id_magazine'		=> $id_magazinenya[$i],
					'status_magazine'	=> 'Publish'
				);
				$this->magazine_model->edit($data);
			}

			$this->session->set_flashdata('sukses', 'Data telah dipublikasikan');
			redirect(base_url('admin/magazine'), 'refresh');
		}
	}

	// Tambah magazine
	public function tambah()
	{
		$this->session->set_userdata('upload_image_file_manager', true);

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'judul_magazine',
			'Judul_magazine',
			'required',
			array('required' => 'Judul Magazine Harus Diisi')
		);

		$valid->set_rules(
			'isi',
			'Isi',
			'required',
			array('required' => 'Deskripsi Magazine Harus Diisi')
		);

		$valid->set_rules(
			'status_magazine',
			'Status_magazine',
			'required',
			array('required' => 'Status Magazine Harus Dipilih')
		);

		$valid->set_rules(
			'urutan',
			'Urutan',
			'required',
			array('required' => 'Urutan Magazine Harus Diisi')
		);

		if ($valid->run()) {
			if (!empty($_FILES['pdfmagazine']['name'])) {
				$config['upload_path']   = './assets/upload/magazine/';
				$config['allowed_types'] = 'pdf';
				$config['max_size']      = '12000'; // KB  
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('pdfmagazine')) {
					// End validasi

					$data = array(
						'title'			=> 'Tambah Magazine',
						'jurusan'		=> $jurusan,
						'error'    		=> $this->upload->display_errors(),
						'isi'			=> 'admin/magazine/tambah'
					);
					$this->load->view('admin/layout/wrapper', $data, FALSE);
					// Masuk database
				} else {
					$upload_data        		= array('uploads' => $this->upload->data());
					// Image Editor
					$config['image_library']  	= 'gd2';
					$config['source_image']   	= './assets/upload/magazine/' . $upload_data['uploads']['file_name'];
					$config['new_image']     	= './assets/upload/magazine/thumb/';
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
					$slug 	= url_title($i->post('judul_magazine'), 'dash', TRUE);

					$data = array(
						'judul_magazine'    => $i->post('judul_magazine'),
						'keywords'          => $i->post('keywords'),
						'isi'               => $i->post('isi'),
						'pdfmagazine'       => $upload_data['uploads']['file_name'],
						'slug_magazine'     => $slug,
						'status_magazine'   => $i->post('status_magazine'),
						'urutan'   			=> $i->post('urutan'),
						'tanggal'           => date('Y-m-d H:i:s'),
					);
					$this->magazine_model->tambah($data);
					$this->session->set_flashdata('sukses', 'Data telah ditambah');
					redirect(base_url('admin/magazine'), 'refresh');
				}
			} else {
				$i 		= $this->input;
				$slug 	= url_title($i->post('judul_magazine'), 'dash', TRUE);

				$data = array(
					'judul_magazine'    => $i->post('judul_magazine'),
					'keywords'          => $i->post('keywords'),
					'isi'               => $i->post('isi'),
					'slug_magazine'     => $slug,
					'status_magazine'   => $i->post('status_magazine'),
					'urutan'   			=> $i->post('urutan'),
					'tanggal'           => date('Y-m-d H:i:s'),
				);
				$this->magazine_model->tambah($data);
				$this->session->set_flashdata('sukses', 'Data telah ditambah');
				redirect(base_url('admin/magazine'), 'refresh');
			}
		}
		// End masuk database
		$data = array(
			'title'			=> 'Tambah Magazine',
			'isi'			=> 'admin/magazine/tambah'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Edit magazine
	public function edit($id_magazine)
	{
		$this->session->set_userdata('upload_image_file_manager', true);
		$magazine 	= $this->magazine_model->detail($id_magazine);
		$this->session->set_userdata('upload_image_file_manager', true);

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'judul_magazine',
			'Judul_magazine',
			'required',
			array('required' => 'Judul Magazine Harus Diisi')
		);

		$valid->set_rules(
			'isi',
			'Isi',
			'required',
			array('required' => 'Deskripsi Magazine Harus Diisi')
		);

		$valid->set_rules(
			'status_magazine',
			'Status_magazine',
			'required',
			array('required' => 'Status Magazine Harus Dipilih')
		);

		$valid->set_rules(
			'urutan',
			'Urutan',
			'required',
			array('required' => 'Urutan Magazine Harus Diisi')
		);

		if ($valid->run()) {

			if (!empty($_FILES['pdfmagazine']['name'])) {

				$config['upload_path']   = './assets/upload/magazine/';
				$config['allowed_types'] = 'pdf';
				$config['max_size']      = '12000'; // KB  
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('pdfmagazine')) {
					// End validasi

					$data = array(
						'title'			=> 'Edit Magazine',
						'jurusan'		=> $jurusan,
						'magazine'		=> $magazine,
						'error'    		=> $this->upload->display_errors(),
						'isi'			=> 'admin/magazine/edit'
					);
					$this->load->view('admin/layout/wrapper', $data, FALSE);
					// Masuk database
				} else {
					$upload_data        		= array('uploads' => $this->upload->data());
					// Image Editor
					$config['image_library']  	= 'gd2';
					$config['source_image']   	= './assets/upload/magazine/' . $upload_data['uploads']['file_name'];
					$config['new_image']     	= './assets/upload/magazine/thumb/';
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

					//Hapus pdfmagazine
					if ($magazine->pdfmagazine != "") {
						unlink('./assets/upload/magazine/' . $magazine->pdfmagazine);
						unlink('./assets/upload/magazine/thumb/' . $magazine->pdfmagazine);
					}
					// End hapus

					$i 		= $this->input;
					$slug 	= url_title($i->post('judul_magazine'), 'dash', TRUE);

					$data = array(
						'id_magazine'		=> $id_magazine,
						'judul_magazine'    => $i->post('judul_magazine'),
						'keywords'          => $i->post('keywords'),
						'isi'               => $i->post('isi'),
						'pdfmagazine'       => $upload_data['uploads']['file_name'],
						'slug_magazine'     => $slug,
						'status_magazine'   => $i->post('status_magazine'),
						'urutan'   			=> $i->post('urutan'),
						'tanggal'           => date('Y-m-d H:i:s'),
					);
					$this->magazine_model->edit($data);
					$this->session->set_flashdata('sukses', 'Data telah diedit');
					redirect(base_url('admin/magazine'), 'refresh');
				}
			} else {
				$i 		= $this->input;
				$slug 	= url_title($i->post('judul_magazine'), 'dash', TRUE);

				$data = array(
					'id_magazine'		=> $id_magazine,
					'judul_magazine'    => $i->post('judul_magazine'),
					'keywords'          => $i->post('keywords'),
					'isi'               => $i->post('isi'),
					'slug_magazine'     => $slug,
					'status_magazine'   => $i->post('status_magazine'),
					'urutan'   			=> $i->post('urutan'),
					'tanggal'           => date('Y-m-d H:i:s'),
				);
				$this->magazine_model->edit($data);
				$this->session->set_flashdata('sukses', 'Data telah diedit');
				redirect(base_url('admin/magazine'), 'refresh');
			}
		}
		// End masuk database
		$data = array(
			'title'			=> 'Edit Magazine',
			'magazine'		=> $magazine,
			'isi'			=> 'admin/magazine/edit'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}


	// Delete
	public function delete($id_magazine)
	{
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);


		$magazine = $this->magazine_model->detail($id_magazine);
		// Proses hapus pdfmagazine
		if ($magazine->pdfmagazine != "") {
			unlink('./assets/upload/magazine/' . $magazine->pdfmagazine);
			unlink('./assets/upload/magazine/thumb/' . $magazine->pdfmagazine);
		}
		// End hapus pdfmagazine
		$data = array('id_magazine'	=> $id_magazine);
		$this->magazine_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/magazine'), 'refresh');
	}
}

/* End of file magazine.php */
/* Location: ./application/controllers/admin/magazine.php */