<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pages_model');

		$this->load->model('download_model');

		$this->log_user->add_log();
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);
	}

	// Halaman pages
	public function index()
	{
		$pages = $this->pages_model->listing();
		$site 	= $this->konfigurasi_model->listing();

		$data = array(
			'title'			=> 'Pages (' . count($pages) . ')',
			'pages'			=> $pages,
			'site'			=> $site,
			'isi'			=> 'admin/pages/list'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}


	// Jenis pages
	public function jenis_pages($jenis_pages)
	{
		$pages = $this->pages_model->jenis_admin($jenis_pages);
		$data = array(
			'title'			=> 'Jenis Pages: ' . $jenis_pages . ' (' . count($pages) . ')',
			'pages'			=> $pages,
			'isi'			=> 'admin/pages/list'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Status pages
	public function status_pages($status_pages)
	{
		$pages = $this->pages_model->status_admin($status_pages);
		$data = array(
			'title'			=> 'Status Pages: ' . $status_pages . ' (' . count($pages) . ')',
			'pages'			=> $pages,
			'isi'			=> 'admin/pages/list'
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
			$id_pagesnya		= $inp->post('id_pages');

			for ($i = 0; $i < sizeof($id_pagesnya); $i++) {
				$pages 	= $this->pages_model->detail($id_pagesnya[$i]);
				if ($pages->gambar != '') {
					unlink('./assets/upload/pages/' . $pages->gambar);
					unlink('./assets/upload/pages/thumbs/' . $pages->gambar);
				}
				$data = array('id_pages'	=> $id_pagesnya[$i]);
				$this->pages_model->delete($data);
			}

			$this->session->set_flashdata('sukses', 'Data telah dihapus');
			redirect(base_url('admin/pages'), 'refresh');
			// PROSES SETTING DRAFT
		} elseif (isset($_POST['draft'])) {
			$inp 				= $this->input;
			$id_pagesnya		= $inp->post('id_pages');

			for ($i = 0; $i < sizeof($id_pagesnya); $i++) {
				$pages 	= $this->pages_model->detail($id_pagesnya[$i]);
				$data = array(
					'id_pages'		=> $id_pagesnya[$i],
					'status_pages'	=> 'Draft'
				);
				$this->pages_model->edit($data);
			}

			$this->session->set_flashdata('sukses', 'Data telah diset untuk tidak dipublikasikan');
			redirect(base_url('admin/pages'), 'refresh');
			// PROSES SETTING PUBLISH
		} elseif (isset($_POST['publish'])) {
			$inp 				= $this->input;
			$id_pagesnya		= $inp->post('id_pages');

			for ($i = 0; $i < sizeof($id_pagesnya); $i++) {
				$pages 	= $this->pages_model->detail($id_pagesnya[$i]);
				$data = array(
					'id_pages'		=> $id_pagesnya[$i],
					'status_pages'	=> 'Publish'
				);
				$this->pages_model->edit($data);
			}

			$this->session->set_flashdata('sukses', 'Data telah dipublikasikan');
			redirect(base_url('admin/pages'), 'refresh');
		}
	}


	// Author pages
	public function author($id_user)
	{
		$pages 		= $this->pages_model->author_admin($id_user);
		$user 		= $this->user_model->detail($id_user);

		$data = array(
			'title'			=> 'Penulis Pages: ' . $user->nama . ' (' . count($pages) . ')',
			'pages'			=> $pages,
			'isi'			=> 'admin/pages/list'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Tambah pages
	public function tambah()
	{
		// $this->session->set_userdata('upload_image_file_manager',true);
		$this->session->set_userdata('upload_image_file_manager', true);

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'judul_pages',
			'Judul',
			'required',
			array('required'	=> 'Judul harus diisi')
		);

		$valid->set_rules(
			'isi',
			'Isi',
			'required',
			array('required'	=> 'Isi pages harus diisi')
		);

		if ($valid->run()) {
			if (!empty($_FILES['gambar']['name'])) {
				$config['upload_path']   = './assets/upload/pages/';
				$config['allowed_types'] = 'jpg|png|jpeg|webp';
				$config['max_size']      = '2000'; // KB  
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar')) {
					// End validasi

					$data = array(
						'title'			=> 'Tambah Pages Baru',
						'error'    		=> $this->upload->display_errors(),
						'isi'			=> 'admin/pages/tambah'
					);
					$this->load->view('admin/layout/wrapper', $data, FALSE);
					// Masuk database
				} else {
					$upload_data        		= array('uploads' => $this->upload->data());
					// Image Editor
					$config['image_library']  	= 'gd2';
					$config['source_image']   	= './assets/upload/pages/' . $upload_data['uploads']['file_name'];
					$config['new_image']     	= './assets/upload/pages/thumbs/';
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
					$slug 	= url_title($i->post('judul_pages'), 'dash', TRUE);

					$data = array(
						'id_user'			=> $this->session->userdata('id_user'),
						'jenis_pages'		=> $i->post('jenis_pages'),
						'slug_pages'		=> $slug,
						'judul_pages'		=> $i->post('judul_pages'),
						'isi'				=> $i->post('isi'),
						'status_pages'		=> $i->post('status_pages'),
						'gambar'			=> $upload_data['uploads']['file_name'],
						'icon'				=> $i->post('icon'),
						'keywords'			=> $i->post('keywords'),
						'tanggal_publish' 	=> date('Y-m-d', strtotime($i->post('tanggal_publish'))) . ' ' . $i->post('jam_publish'),
						'urutan'			=> $i->post('urutan'),
						'tanggal_post'		=> date('Y-m-d H:i:s'),
					);
					$this->pages_model->tambah($data);
					$this->session->set_flashdata('sukses', 'Data telah ditambah');
					redirect(base_url('admin/pages/jenis_pages/' . $i->post('jenis_pages')), 'refresh');
				}
			} else {
				$i 		= $this->input;
				$slug 	= url_title($i->post('judul_pages'), 'dash', TRUE);

				$data = array(
					'id_user'		=> $this->session->userdata('id_user'),
					'status_pages'	=> $i->post('status_pages'),
					'slug_pages'	=> $slug,
					'judul_pages'	=> $i->post('judul_pages'),
					'isi'			=> $i->post('isi'),
					'jenis_pages'	=> $i->post('jenis_pages'),
					'icon'			=> $i->post('icon'),
					'keywords'		=> $i->post('keywords'),
					'tanggal_publish' => date('Y-m-d', strtotime($i->post('tanggal_publish'))) . ' ' . $i->post('jam_publish'),
					// 'tanggal_mulai'		=> $i->post('tanggal_mulai'),
					// 'tanggal_selesai'		=> $i->post('tanggal_selesai'),
					'urutan'	=> $i->post('urutan'),
					'tanggal_post'	=> date('Y-m-d H:i:s'),
				);
				$this->pages_model->tambah($data);
				$this->session->set_flashdata('sukses', 'Data telah ditambah');
				redirect(base_url('admin/pages/jenis_pages/' . $i->post('jenis_pages')), 'refresh');
			}
		}
		// End masuk database
		$data = array(
			'title'			=> 'Tambah Pages',
			'isi'			=> 'admin/pages/tambah'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Edit pages
	public function edit($id_pages)
	{
		$this->session->set_userdata('upload_image_file_manager', true);
		$pages 	= $this->pages_model->detail($id_pages);
		$this->session->set_userdata('upload_image_file_manager', true);

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'judul_pages',
			'Judul',
			'required',
			array('required'	=> 'Judul harus diisi')
		);

		$valid->set_rules(
			'isi',
			'Isi',
			'required',
			array('required'	=> 'Isi pages harus diisi')
		);

		if ($valid->run()) {

			if (!empty($_FILES['gambar']['name'])) {

				$config['upload_path']   = './assets/upload/pages/';
				$config['allowed_types'] = 'jpg|png|jpeg|webp';
				$config['max_size']      = '2000'; // KB  
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar')) {
					// End validasi

					$data = array(
						'title'			=> 'Edit Pages',
						'pages'			=> $pages,
						'error'    		=> $this->upload->display_errors(),
						'isi'			=> 'admin/pages/edit'
					);
					$this->load->view('admin/layout/wrapper', $data, FALSE);
					// Masuk database
				} else {
					$upload_data        		= array('uploads' => $this->upload->data());
					// Image Editor
					$config['image_library']  	= 'gd2';
					$config['source_image']   	= './assets/upload/pages/' . $upload_data['uploads']['file_name'];
					$config['new_image']     	= './assets/upload/pages/thumbs/';
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
					if ($pages->gambar != "") {
						unlink('./assets/upload/pages/' . $pages->gambar);
						unlink('./assets/upload/pages/thumbs/' . $pages->gambar);
					}
					// End hapus

					$i 		= $this->input;
					$slug 	= url_title($i->post('judul_pages'), 'dash', TRUE);

					$data = array(
						'id_pages'		=> $id_pages,
						'id_user'		=> $this->session->userdata('id_user'),
						'jenis_pages'	=> $i->post('jenis_pages'),
						'slug_pages'	=> $slug,
						'judul_pages'	=> $i->post('judul_pages'),
						'isi'			=> $i->post('isi'),
						'status_pages'	=> $i->post('status_pages'),
						'icon'			=> $i->post('icon'),
						'gambar'		=> $upload_data['uploads']['file_name'],
						'keywords'		=> $i->post('keywords'),
						'tanggal_publish' => date('Y-m-d', strtotime($i->post('tanggal_publish'))) . ' ' . $i->post('jam_publish'),
						'urutan'	=> $i->post('urutan'),
					);
					$this->pages_model->edit($data);
					$this->session->set_flashdata('sukses', 'Data telah diedit');
					redirect(base_url('admin/pages/jenis_pages/' . $i->post('jenis_pages')), 'refresh');
				}
			} else {
				$i 		= $this->input;
				$slug 	= url_title($i->post('judul_pages'), 'dash', TRUE);

				$data = array(
					'id_pages'		=> $id_pages,
					'id_user'		=> $this->session->userdata('id_user'),
					'jenis_pages'	=> $i->post('jenis_pages'),
					'slug_pages'	=> $slug,
					'judul_pages'	=> $i->post('judul_pages'),
					'isi'			=> $i->post('isi'),
					'status_pages'	=> $i->post('status_pages'),
					'icon'			=> $i->post('icon'),
					'keywords'		=> $i->post('keywords'),
					'tanggal_publish' => date('Y-m-d', strtotime($i->post('tanggal_publish'))) . ' ' . $i->post('jam_publish'),
					'urutan'	=> $i->post('urutan'),
				);
				$this->pages_model->edit($data);
				$this->session->set_flashdata('sukses', 'Data telah diedit');
				redirect(base_url('admin/pages/jenis_pages/' . $i->post('jenis_pages')), 'refresh');
			}
		}
		// End masuk database
		$data = array(
			'title'			=> 'Edit Pages',
			'pages'			=> $pages,
			'isi'			=> 'admin/pages/edit'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}


	// Delete
	public function delete($id_pages)
	{
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);


		$pages = $this->pages_model->detail($id_pages);
		// Proses hapus gambar
		if ($pages->gambar != "") {
			unlink('./assets/upload/pages/' . $pages->gambar);
			unlink('./assets/upload/pages/thumbs/' . $pages->gambar);
		}
		// End hapus gambar
		$data = array('id_pages'	=> $id_pages);
		$this->pages_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/pages'), 'refresh');
	}
}

/* End of file pages.php */
/* Location: ./application/controllers/admin/pages.php */