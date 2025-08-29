<?php
defined('BASEPATH') or exit('No direct script access allowed');

class isbn extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('isbn_model');
		$this->load->model('kategori_model');
	}

	// Main page
	public function index()
	{
		$site = $this->konfigurasi_model->listing();
        $isbn = $this->isbn_model->isbn();
        // End paginasi

        $data = array(
            'title' => 'List ISBN',
            'deskripsi' => 'Daftar Pengajuan ISBN Jakarta III',
            'keywords' => 'Daftar Pengajuan ISBN Jakarta III',
            'isbn' => $isbn,
            'site' => $site,
            'isi' => 'isbn/list'
        );
        $this->load->view('layout/wrapper', $data, false);
	}

	// Read isbn detail
	public function view($slug)
	{
		$site 		= $this->konfigurasi_model->listing();
		$isbn 	    = $this->isbn_model->view($slug);

		if (count(array($isbn)) < 1) {
			redirect(base_url('oops'), 'refresh');
		}

		$data = array(
			'title'		    => $isbn->judul . '-' . $site->namaweb,
			'deskripsi'	    => $isbn->deskripsi . '-' . $site->namaweb,
			'keywords'	    => $isbn->judul . '-' . $site->namaweb,
			'isbn'	        => $isbn,
			'site'		    => $site,
			'isi'		    => 'isbn/view'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	
}

/* End of file isbn.php */
/* Location: ./application/controllers/isbn.php */