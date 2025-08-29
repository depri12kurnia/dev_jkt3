<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokumen extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		// Proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$this->session->set_userdata('pengalihan', $url_pengalihan);
		$this->simple_login->check_login($url_pengalihan);

		// Load Seafile library
		$this->load->library('seafile');
	}

	// Halaman daftar repositori Seafile
	public function index()
	{
		$repos = $this->seafile->listLibraries();
		$data = array(
			'title' => 'Dokumen dari Seafile',
			'repos' => $repos,
			'isi'   => 'admin/seafile/list'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Halaman detail file dalam repo tertentu
	public function detail($repo_id, $path = '/')
	{
		$files = $this->seafile->listFiles($repo_id, $path);
		$data = array(
			'title' => 'Detail File dari Seafile',
			'files' => $files,
			'repo_id' => $repo_id,
			'path' => $path,
			'isi'   => 'admin/seafile/detail'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Preview file
	public function preview_file($repo_id)
	{
		$file_path = urldecode($this->input->get('file_path'));
		$link = $this->seafile->generateSharedLink($repo_id, $file_path);
		redirect($link['url']);
	}



	// Download file
	public function download_file($repo_id, $file_path)
	{
		$link = $this->seafile->generateSharedLink($repo_id, urldecode($file_path));
		redirect($link['url']); // atau gunakan header download manual
	}
}
