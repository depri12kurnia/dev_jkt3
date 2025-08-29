<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Capaian extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('capaian_model');
	}

	// Main page
	public function index()
	{
		$site 			= $this->konfigurasi_model->listing();
		$dashboard		= $this->capaian_model->listing();

		$data = array(
			'title'		=> 'Capaian - ' . $site->namaweb,
			'deskripsi'	=> 'Capaian - ' . $site->namaweb,
			'keywords'	=> 'Capaian - ' . $site->namaweb,
			'dashboard'	=> $dashboard,
			'site'		=> $site,
			'isi'		=> 'capaian/list'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Read capaian detail
	public function read($slug_capaian)
	{
		$site 			= $this->konfigurasi_model->listing();
		$dashboard 		= $this->capaian_model->read($slug_capaian);
		$listing 		= $this->capaian_model->listing_read();
		$listcapaian 	= $this->capaian_model->listcapaian();

		$data = array(
			'title'		=> 'Dashboard-' . $dashboard->judul_capaian,
			'deskripsi'	=> $dashboard->judul_capaian,
			'keywords'	=> $dashboard->judul_capaian,
			'dashboard'	=> $dashboard,
			'listing'	=> $listing,
			'listcapaian'	=> $listcapaian,
			'site'		=> $site,
			'isi'		=> 'capaian/read'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
}

/* End of file capaian.php */
/* Location: ./application/controllers/capaian.php */