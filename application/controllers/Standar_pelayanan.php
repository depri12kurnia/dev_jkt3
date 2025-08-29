<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Standar_layanan extends CI_Controller
{

	// Main page
	public function index()
	{
		$site 			= $this->konfigurasi_model->listing();

		$data = array(
			'title'		=> 'Standar Layanan - ' . $site->namaweb,
			'deskripsi'	=> 'Standar Layanan - ' . $site->namaweb,
			'keywords'	=> 'Standar Layanan - ' . $site->namaweb,
			'site'		=> $site,
			'isi'		=> 'layanan/vstandar_layanan'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
}

/* End of file Standar_layanan.php */
/* Location: ./application/controllers/Standar_layanan.php */