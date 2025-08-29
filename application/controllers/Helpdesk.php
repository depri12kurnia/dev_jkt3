<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Helpdesk extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('helpdesk_model');
	}

	// Main page
	public function index()
	{
		$site 		= $this->konfigurasi_model->listing();
		$helpdesk 	= $this->helpdesk_model->listing();
		// End paginasi

		$data = array(
			'title'		=> 'Helpdesk - ' . $site->namaweb,
			'deskripsi'	=> 'Helpdesk - ' . $site->namaweb,
			'keywords'	=> 'Helpdesk - ' . $site->namaweb,
			'helpdesk'	=> $helpdesk,
			'site'		=> $site,
			'isi'		=> 'helpdesk/list'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Kategori
	public function kategori($slug_kategori_helpdesk)
	{
		$site 					= $this->konfigurasi_model->listing();
		$kategori_helpdesk 		= $this->kategori_helpdesk_model->read($slug_kategori_helpdesk);

		$id_kategori_helpdesk	= $kategori_helpdesk->id_kategori_helpdesk;

		$helpdesk 				= $this->helpdesk_model->kategori($id_kategori_helpdesk);

		$data = array(
			'title'				=> 'Kategori helpdesk: ' .
				$kategori_helpdesk->nama_kategori_helpdesk,
			'deskripsi'			=> 'Kategori helpdesk: ' .
				$kategori_helpdesk->nama_kategori_helpdesk,
			'keywords'			=> 'Kategori helpdesk: ' .
				$kategori_helpdesk->nama_kategori_helpdesk,
			'helpdesk'			=> $helpdesk,
			'site'				=> $site,
			'kategori_helpdesk'	=> $kategori_helpdesk,
			'isi'		=> 'helpdesk/list'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Listing Layanan FAQ dan Helpdesk
	public function adak()
	{
		$site = $this->konfigurasi_model->listing();
		$helpdesk = $this->helpdesk_model->helpdesk();
		$adak = $this->helpdesk_model->listingAkademikKemahasiswaan();
		// End paginasi

		$data = array(
			'title' => 'Faq&Helpdesk Adak - ' . $site->namaweb,
			'deskripsi' => 'Faq&Helpdesk Adak - ' . $site->namaweb,
			'keywords' => 'Faq&Helpdesk Adak - ' . $site->namaweb,
			'dokumen' => $helpdesk,
			'adak' => $adak,
			'site' => $site,
			'isi' => 'helpdesk/list_adak'
		);
		$this->load->view('layout/wrapper', $data, false);
	}

	public function sdm()
	{
		$site = $this->konfigurasi_model->listing();
		$helpdesk = $this->helpdesk_model->helpdesk();
		$sdm = $this->helpdesk_model->listingSdm();
		// End paginasi

		$data = array(
			'title' => 'Faq&Helpdesk SDM - ' . $site->namaweb,
			'deskripsi' => 'Faq&Helpdesk SDM - ' . $site->namaweb,
			'keywords' => 'Faq&Helpdesk SDM - ' . $site->namaweb,
			'dokumen' => $helpdesk,
			'sdm' => $sdm,
			'site' => $site,
			'isi' => 'helpdesk/list_sdm'
		);
		$this->load->view('layout/wrapper', $data, false);
	}

	public function itsarpras()
	{
		$site = $this->konfigurasi_model->listing();
		$helpdesk = $this->helpdesk_model->helpdesk();
		$itsarpras = $this->helpdesk_model->listingItsarpras();
		// End paginasi

		$data = array(
			'title' => 'Faq&Helpdesk IT & Sarpras - ' . $site->namaweb,
			'deskripsi' => 'Faq&Helpdesk IT & Sarpras - ' . $site->namaweb,
			'keywords' => 'Faq&Helpdesk IT & Sarpras - ' . $site->namaweb,
			'dokumen' => $helpdesk,
			'itsarpras' => $itsarpras,
			'site' => $site,
			'isi' => 'helpdesk/list_itsarpras'
		);
		$this->load->view('layout/wrapper', $data, false);
	}
}

/* End of file helpdesk.php */
/* Location: ./application/controllers/helpdesk.php */