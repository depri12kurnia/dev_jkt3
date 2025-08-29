<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Monev extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('download_model');
		$this->load->model('kategori_download_model');
		$this->load->model('jenis_download_model');
	}

	// Main page
	public function index()
	{
		$site 		= $this->konfigurasi_model->listing();
		$download   = $this->download_model->download();
		$download   = $this->download_model->listingLaporanMonev();

		$data = array(
			'title'		=> 'Intrumen Monitoring - ' . $site->namaweb,
			'deskripsi'	=> 'Intrumen Monitoring - ' . $site->namaweb,
			'keywords'	=> 'Intrumen Monitoring - ' . $site->namaweb,
			'dokumen' 	=> $download,
			'site'		=> $site,
			'isi'		=> 'monev/list'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
}

/* End of file Intrumen Monitoring.php */
/* Location: ./application/controllers/Intrumen Monitoring.php */