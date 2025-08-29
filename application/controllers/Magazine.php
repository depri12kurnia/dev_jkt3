<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Magazine extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('magazine_model');
		$this->load->model('jurusan_model');
	}

	// Main page
	public function index()
	{
		$site 		= $this->konfigurasi_model->listing();
		$magazine	= $this->magazine_model->listing();

		$data = array(
			'title'		=> 'E-Magazine - ' . $site->namaweb,
			'deskripsi'	=> 'E-Magazine - ' . $site->namaweb,
			'keywords'	=> 'malajah jakarta3 - ' . $site->namaweb,
			'magazine'	=> $magazine,
			'site'		=> $site,
			'isi'		=> 'magazine/list'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}


	// Read magazine detail
	public function read($slug_magazine)
	{
		$site 		= $this->konfigurasi_model->listing();
		$magazine 	= $this->magazine_model->read($slug_magazine);
		$listing 	= $this->magazine_model->listing_read();
		$populer	= $this->magazine_model->populer();
		$pengumuman	= $this->magazine_model->pengumuman();
		// $list_side	= $this->jurusan_model->list_side();

		if (count(array($magazine)) < 1) {
			redirect(base_url('oops'), 'refresh');
		}

		// Update hit
		if ($magazine) {
			$newhits 	= $magazine->hits + 1;
			$hit 		= array(
				'id_magazine'	=> $magazine->id_magazine,
				'hits'		=> $newhits
			);
			$this->magazine_model->update_hit($hit);
		}
		//  End update hit

		$data = array(
			'title'		=> $magazine->judul_magazine,
			'deskripsi'	=> $magazine->judul_magazine,
			'keywords'	=> $magazine->judul_magazine,
			'magazine'	=> $magazine,
			'listing'	=> $listing,
			'populer'	=> $populer,
			'pengumuman' => $pengumuman,
			'site'		=> $site,
			'isi'		=> 'magazine/read'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
}

/* End of file magazine.php */
/* Location: ./application/controllers/magazine.php */