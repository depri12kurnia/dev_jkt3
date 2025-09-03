<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sdm extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('sdm_model');
		$this->load->model('jabatansdm_model');
		$this->load->model('konfigurasi_model');
		$this->load->model('nav_model');
	}

	// Main page: daftar semua SDM
	public function index()
	{
		$site = $this->konfigurasi_model->listing();
		$direktur	= $this->jabatansdm_model->direktur_aktif();
		$wakil_direktur = $this->jabatansdm_model->wakil_direktur_aktif();
		$sdm_list = $this->jabatansdm_model->all();

		$data = array(
			'title'      => 'SDM - ' . $site->namaweb,
			'deskripsi'  => 'SDM - ' . $site->namaweb,
			'keywords'   => 'SDM - ' . $site->namaweb,
			'direktur'   => $direktur,
			'wakil_direktur' => $wakil_direktur,
			'sdm_list'   => $sdm_list,
			'site'       => $site,
			'isi'        => 'sdm/list'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Detail SDM
	public function detail($slug)
	{
		$site = $this->konfigurasi_model->listing();
		$sdm = $this->jabatansdm_model->detail($slug);

		if (!$sdm) {
			redirect(base_url('oops'), 'refresh');
		}

		$listing = $this->sdm_model->listing();
		$kategori = $this->nav_model->nav_sdm();

		$data = array(
			'title'     => $sdm->nama,
			'deskripsi' => $sdm->jabatan,
			'keywords'  => $sdm->nama,
			'sdm'       => $sdm,
			'listing'   => $listing,
			'kategori'  => $kategori,
			'site'      => $site,
			'isi'       => 'sdm/detail'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
}

/* End of file Sdm.php */
/* Location: ./application/controllers/Sdm.php */