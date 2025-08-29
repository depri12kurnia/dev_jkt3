<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Maturity extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('maturity_model');
	}

	// Main page
	public function index()
	{
		$site 			= $this->konfigurasi_model->listing();
		$dashboard		= $this->maturity_model->listing();

		$data = array(
			'title'		=> 'Maturity Rating - ' . $site->namaweb,
			'deskripsi'	=> 'Maturity Rating - ' . $site->namaweb,
			'keywords'	=> 'Maturity Rating - ' . $site->namaweb,
			'dashboard'	=> $dashboard,
			'site'		=> $site,
			'isi'		=> 'maturity/list'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Read maturity detail
	public function read($slug_maturity)
	{
		$site 			= $this->konfigurasi_model->listing();
		$dashboard 		= $this->maturity_model->read($slug_maturity);
		$listing 		= $this->maturity_model->listing_read();
		$listmaturity 	= $this->maturity_model->listmaturity();

		$data = array(
			'title'		=> 'Dashboard - ' . $dashboard->judul_maturity,
			'deskripsi'	=> $dashboard->judul_maturity,
			'keywords'	=> $dashboard->judul_maturity,
			'dashboard'	=> $dashboard,
			'listing'	=> $listing,
			'listmaturity'	=> $listmaturity,
			'site'		=> $site,
			'isi'		=> 'maturity/read'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
}

/* End of file maturity.php */
/* Location: ./application/controllers/maturity.php */