<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Puipk extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('puipk_model');
	}

	// Main page video
	public function index()
	{
		$site 		= $this->konfigurasi_model->listing();

		// Video dan paginasi
		$this->load->library('pagination');
		$config['base_url'] 		= base_url() . 'video/index/';
		$config['total_rows'] 		= $this->puipk_model->total()->total;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] 		= 5;
		$config['uri_segment'] 		= 3;
		$config['per_page'] 		= 12;
		$config['first_url'] 		= base_url() . 'video/';
		$this->pagination->initialize($config);
		$page 		= ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) * $config['per_page'] : 0;
		$video 	= $this->puipk_model->video($config['per_page'], $page);
		// End paginasi

		$data = array(
			'title'		=> 'Video - ' . $site->namaweb,
			'deskripsi'	=> 'Video - ' . $site->namaweb,
			'keywords'	=> 'Video - ' . $site->namaweb,
			'pagin' 	=> $this->pagination->create_links(),
			'video'		=> $video,
			'isi'		=> 'puipk/list'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Read page video
	public function read($id_video)
	{
		$site 		= $this->konfigurasi_model->listing();
		$video 		= $this->puipk_model->detail($id_video);

		$data = array(
			'title'		=> $video->judul,
			'deskripsi'	=> $video->judul,
			'keywords'	=> $video->judul,
			'video'		=> $video,
			'isi'		=> 'puipk/read'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
}

/* End of file Video.php */
/* Location: ./application/controllers/Video.php */