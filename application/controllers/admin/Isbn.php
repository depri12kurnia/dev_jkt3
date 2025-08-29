<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Isbn extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('isbn_model');
		
		$this->log_user->add_log();
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);
	}

	// Halaman isbn
	public function index()
	{
		$isbn 	= $this->isbn_model->listing();
		$site 	= $this->konfigurasi_model->listing();

		$data = array(
			'title'			=> 'Data Pengajuan ISBN',
			'isbn'			=> $isbn,
			'site'			=> $site,
			'isi'			=> 'admin/isbn/list'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Tambah isbn
	public function tambah()
	{
		$this->session->set_userdata('upload_image_file_manager', true);

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'judul',
			'Judul',
			'required',
			array('required'	=> 'Judul harus diisi')
		);

		$valid->set_rules(
			'penulis',
			'Penulis',
			'required',
			array('required'	=> 'Penulis harus diisi')
		);

		$valid->set_rules(
			'deskripsi',
			'Deskripsi',
			'required',
			array('required'	=> 'Deskripsi harus diisi')
		);

		if ($valid->run()) {
			if (!empty($_FILES['attachment']['name'])) {
				$config['upload_path']   = './assets/upload/isbn/';
				$config['allowed_types'] = 'pdf';
				$config['max_size']      = '1000'; // KB 
				$config['encrypt_name'] = TRUE;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('attachment')) {
					// End validasi

					$data = array(
						'title'			=> 'Tambah Pengajuan ISBN',
						'error'    		=> $this->upload->display_errors(),
						'isi'			=> 'admin/isbn/tambah'
					);
					$this->load->view('admin/layout/wrapper', $data, FALSE);
					// Masuk database
				} else {
					$upload_data     = array('uploads' => $this->upload->data());

					$i 		= $this->input;
					$slug 	= url_title($i->post('judul'), 'dash', TRUE);

					$data = array(
						'id_user'		=> $this->session->userdata('id_user'),
						'slug'			=> $slug,
						'judul'			=> $i->post('judul'),
						'penulis'		=> $i->post('penulis'),
						'deskripsi'		=> $i->post('deskripsi'),
						'status'		=> $i->post('status'),
						'attachment'	=> $upload_data['uploads']['file_name'],
						'created_at'	=> date('Y-m-d H:i:s'),
					);

					$this->isbn_model->tambah($data);

					$this->session->set_flashdata('sukses', 'Data telah ditambah');
					redirect(base_url('admin/isbn'), 'refresh');
				}
			} else {
				$i 		= $this->input;
				$slug 	= url_title($i->post('judul'), 'dash', TRUE);

				$data = array(
						'id_user'		=> $this->session->userdata('id_user'),
						'slug'			=> $slug,
						'judul'			=> $i->post('judul'),
						'penulis'		=> $i->post('penulis'),
						'deskripsi'		=> $i->post('deskripsi'),
						'status'		=> $i->post('status'),
						'created_at'	=> date('Y-m-d H:i:s'),
				);
				$this->isbn_model->tambah($data);
				$this->session->set_flashdata('sukses', 'Data telah ditambah');
				redirect(base_url('admin/isbn'), 'refresh');
			}
		}
		// End masuk database
		$data = array(
			'title'			=> 'Pengajuan ISBN',
			'isi'			=> 'admin/isbn/tambah'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Edit isbn
	public function edit($id_isbn)
	{
		$isbn 	= $this->isbn_model->detail($id_isbn);
		$this->session->set_userdata('upload_image_file_manager', true);

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'judul',
			'Judul',
			'required',
			array('required'	=> 'Judul harus diisi')
		);

		$valid->set_rules(
			'penulis',
			'Penulis',
			'required',
			array('required'	=> 'Penulis harus diisi')
		);

		$valid->set_rules(
			'deskripsi',
			'Deskripsi',
			'required',
			array('required'	=> 'Deskripsi harus diisi')
		);

		if ($valid->run()) {

			if (!empty($_FILES['attachment']['name'])) {

				$config['upload_path']   = './assets/upload/isbn/';
				$config['allowed_types'] = 'pdf';
				$config['max_size']      = '1000'; // KB 
				$config['encrypt_name'] = TRUE;

				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('attachment')) {
					// End validasi

					$data = array(
						'title'			=> 'Edit Pengajuan ISBN',
						'isbn'			=> $isbn,
						'error'    		=> $this->upload->display_errors(),
						'isi'			=> 'admin/isbn/edit'
					);
					$this->load->view('admin/layout/wrapper', $data, FALSE);
					// Masuk database
				} else {
					$upload_data = array('uploads' => $this->upload->data());

					$i 		= $this->input;
					$slug 	= url_title($i->post('judul'), 'dash', TRUE);

					$data = array(
						'id_isbn'		=> $id_isbn,
						'id_user'		=> $this->session->userdata('id_user'),
						'slug'			=> $slug,
						'judul'			=> $i->post('judul'),
						'penulis'		=> $i->post('penulis'),
						'deskripsi'		=> $i->post('deskripsi'),
						'status'		=> $i->post('status'),
						'attachment'	=> $upload_data['uploads']['file_name'],
						'created_at'	=> date('Y-m-d H:i:s'),
					);
					$this->isbn_model->edit($data);
					$this->session->set_flashdata('sukses', 'Data telah diedit');
					redirect(base_url('admin/isbn'), 'refresh');
				}
			} else {
				$i 		= $this->input;
				$slug 	= url_title($i->post('judul'), 'dash', TRUE);

				$data = array(
					'id_isbn'		=> $id_isbn,
					'id_user'		=> $this->session->userdata('id_user'),
					'slug'			=> $slug,
					'judul'			=> $i->post('judul'),
					'penulis'		=> $i->post('penulis'),
					'deskripsi'		=> $i->post('deskripsi'),
					'status'		=> $i->post('status'),
					'created_at'	=> date('Y-m-d H:i:s'),
				);
				$this->isbn_model->edit($data);
				$this->session->set_flashdata('sukses', 'Data telah diedit');
				redirect(base_url('admin/isbn'), 'refresh');
			}
		}
		// End masuk database
		$data = array(
			'title'			=> 'Edit Pengajuan SBN',
			'isbn'			=> $isbn,
			'isi'			=> 'admin/isbn/edit'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}


	// Delete
	public function delete($id_isbn)
	{
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);


		$isbn = $this->isbn_model->detail($id_isbn);
        unlink('./assets/upload/isbn/' . $isbn->attachment);
       
        // End hapus gambar
		$data = array('id_isbn'	=> $id_isbn);
		$this->isbn_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/isbn'), 'refresh');
	}
}

/* End of file isbn.php */
/* Location: ./application/controllers/admin/isbn.php */