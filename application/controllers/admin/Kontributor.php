<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kontributor extends CI_Controller
{
	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('kontributor_model');
		$this->load->model('kontributor_images_model');
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
		$kontributor   = $this->kontributor_model->store();
		$data = array(
			'title' => 'Data Kontributor',
			'kontributor' => $kontributor,
			'isi' => 'admin/kontributor/list'
		);
		$this->load->view('admin/layout/wrapper', $data, false);
	}

	public function detail($id_kontributor)
	{
		$kontributor = $this->kontributor_model->get_kontributor($id_kontributor);
		$images = $this->kontributor_model->get_images_by_kontributor($id_kontributor);

		$data = array(
			'title' => 'Data Kontributor',
			'kontributor' => $kontributor,
			'images' => $images,
			'isi' => 'admin/kontributor/detail'
		);
		$this->load->view('admin/layout/wrapper', $data, false);
	}

	function download($images)
	{
		$this->load->helper('download');

		// Tentukan path file
		$path = './assets/upload/kontributor/' . $images;

		// Periksa apakah file ada
		if (file_exists($path)) {
			// Download file
			force_download($path, NULL);
		} else {
			// Tampilkan error jika file tidak ditemukan
			show_404();
		}
	}

	// Delete
	public function delete($id_kontributor)
	{
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);

		// $kontributor = $this->kontributor_model->get_kontributor($id_kontributor);
		$images = $this->kontributor_model->get_images_by_kontributor($id_kontributor);
		// Proses hapus gambar
		if ($images->file_name != "") {
			unlink('./assets/upload/kontributor/' . $images->file_name);
		}
		// End hapus gambar
		$data = array('id_kontributor'	=> $id_kontributor);
		$this->kontributor_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/kontributor'), 'refresh');
	}
}
