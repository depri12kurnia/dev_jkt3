<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('staff_model');
		$this->load->model('kategori_staff_model');
	}

	// Main page
	public function index()
	{
		$site 	= $this->konfigurasi_model->listing();
		$staff 	= $this->staff_model->semua();
		// End paginasi

		$data = array(
			'title'		=> 'SDM - ' . $site->namaweb,
			'deskripsi'	=> 'SDM - ' . $site->namaweb,
			'keywords'	=> 'SDM - ' . $site->namaweb,
			'staff'	    => $staff,
			'site'		=> $site,
			'isi'		=> 'staff/list'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Kategori
	public function kategori($slug_kategori_staff)
	{
		$site 					= $this->konfigurasi_model->listing();
		$kategori_staff 		= $this->kategori_staff_model->read($slug_kategori_staff);

		if (count(array($kategori_staff) < 1)) {
			redirect(base_url('oops'), 'refresh');
		}

		$id_kategori_staff	= $kategori_staff->id_kategori_staff;

		$staff 				= $this->staff_model->kategori($id_kategori_staff);

		$data = array(
			'title'				=> 'Kategori staff: ' .
				$kategori_staff->nama_kategori_staff,
			'deskripsi'			=> 'Kategori staff: ' .
				$kategori_staff->nama_kategori_staff,
			'keywords'			=> 'Kategori staff: ' .
				$kategori_staff->nama_kategori_staff,
			'staff'			    => $staff,
			'site'				=> $site,
			'kategori_staff'	=> $kategori_staff,
			'isi'		        => 'staff/list'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Read staff detail
	public function detail($slug_staff)
	{
		$site 		= $this->konfigurasi_model->listing();
		$staff 		= $this->staff_model->detail($slug_staff);

		if (count(array($staff)) < 1) {
			redirect(base_url('oops'), 'refresh');
		}

		$listing 	= $this->staff_model->listing();
		$kategori 	= $this->nav_model->nav_staff();

		$data = array(
			'title'		=> $staff->nama,
			'deskripsi'	=> $staff->jabatan,
			'keywords'	=> $staff->keywords,
			'staff'	    => $staff,
			'listing'	=> $listing,
			'kategori'	=> $kategori,
			'site'		=> $site,
			'isi'		=> 'staff/detail'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Unduh
	public function unduh($id_staff)
	{
		$this->load->helper('staff');
		$staff = $this->staff_model->detail($id_staff);
		// Contents of photo.jpg will be automatically read
		force_staff('./assets/upload/file/' . $staff->gambar, NULL);
	}
}

/* End of file staff.php */
/* Location: ./application/controllers/staff.php */