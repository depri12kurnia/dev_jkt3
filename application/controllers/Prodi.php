<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prodi extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('prodi_model');
		$this->load->model('jurusan_model');
		$this->load->model('berita_model');

		// model download
		$this->load->model('download_model');
		$this->load->model('kategori_download_model');
		$this->load->model('jenis_download_model');
	}

	// Search
	public function cari()
	{
		$this->load->helper('security');
		$s 			= $this->input->post('s');
		$keyword 	= xss_clean($s);
		$keywords	= encode_php_tags($keyword);

		if ($keywords != "") {
			redirect(base_url('prodi/search?s=' . $keywords), 'refresh');
		} else {
			redirect(base_url('prodi'), 'refresh');
		}
	}

	// Read prodi detail
	public function read($slug_prodi)
	{
		$site 		= $this->konfigurasi_model->listing();
		$prodi 		= $this->prodi_model->read($slug_prodi);
		$listing 	= $this->prodi_model->listing_read();
		$list_side_prodi	= $this->prodi_model->list_side();
		$pengumuman	= $this->berita_model->pengumuman();
		$pa 	= $this->download_model->listingPA();

		if (count(array($prodi)) < 1) {
			redirect(base_url('oops'), 'refresh');
		}

		// Update hit
		if ($prodi) {
			$newhits 	= $prodi->hits + 1;
			$hit 		= array(
				'id_prodi'	=> $prodi->id_prodi,
				'hits'		=> $newhits
			);
			$this->prodi_model->update_hit($hit);
		}
		//  End update hit

		$data = array(
			'title'		=> $prodi->nama_prodi,
			'deskripsi'	=> $prodi->nama_prodi,
			'keywords'	=> $prodi->nama_prodi,
			'prodi'		=> $prodi,
			'listing'	=> $listing,
			'list_side'	=> $list_side_prodi,
			'peraturan_akademik'   => $pa,
			// 'populer'	=> $populer,
			'pengumuman' => $pengumuman,
			'site'		=> $site,
			'isi'		=> 'prodi/read'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	// Search
	public function search()
	{
		$this->load->helper('security');
		$s 			= $this->input->get('search');
		$keyword 	= xss_clean($s);
		$keywords	= encode_php_tags($keyword);
		$populer	= $this->prodi_model->populer();
		$pengumuman	= $this->prodi_model->pengumuman();

		if ($keywords == "") {
			redirect(base_url('prodi'), 'refresh');
		}

		$site 		= $this->konfigurasi_model->listing();

		// prodi dan paginasi
		$this->load->library('pagination');
		$config['base_url'] 		= base_url() . 'prodi/search?s=' . $keywords . '/index/';
		$config['total_rows'] 		= count(array($this->prodi_model->total_search($keywords)));
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] 		= 5;
		$config['uri_segment'] 		= 3;
		$config['full_tag_open'] 	= '<ul class="pagination">';
		$config['full_tag_close'] 	= '</ul>';
		$config['first_link'] 		= '&laquo; Awal';
		$config['first_tag_open'] 	= '<li class="prev page">';
		$config['first_tag_close'] 	= '</li>';

		$config['last_link'] 		= 'Akhir &raquo;';
		$config['last_tag_open'] 	= '<li class="next page">';
		$config['last_tag_close'] 	= '</li>';

		$config['next_link'] 		= 'Selanjutnya &rarr;';
		$config['next_tag_open'] 	= '<li class="next page">';
		$config['next_tag_close'] 	= '</li>';

		$config['prev_link'] 		= '&larr; Sebelumnya';
		$config['prev_tag_open'] 	= '<li class="prev page">';
		$config['prev_tag_close'] 	= '</li>';

		$config['cur_tag_open'] 	= '<li class="active"><a href="">';
		$config['cur_tag_close'] 	= '</a></li>';

		$config['num_tag_open'] 	= '<li class="page">';
		$config['num_tag_close'] 	= '</li>';
		$config['per_page'] 		= 10;
		$config['first_url'] 		= base_url() . 'prodi/search?s=' . $keywords;
		$this->pagination->initialize($config);
		$page 		= ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) * $config['per_page'] : 0;
		$prodi 	= $this->prodi_model->search($keywords, $config['per_page'], $page);

		$data = array(
			'title'		=> 'Hasil pencarian: ' . $keywords,
			'deskripsi'	=> 'prodi - ' . $site->namaweb,
			'keywords'	=> 'prodi - ' . $site->namaweb,
			'pagin' 	=> $this->pagination->create_links(),
			'prodi'	=> $prodi,
			'site'		=> $site,
			'populer'	=> $populer,
			'pengumuman'	=> $pengumuman,
			'isi'		=> 'prodi/list2'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Profil prodi detail
	public function profil($slug_prodi)
	{
		$site 		= $this->konfigurasi_model->listing();
		$prodi 	= $this->prodi_model->read($slug_prodi);
		$profil 	= $this->nav_model->nav_profil();

		if (count(array($prodi)) < 1) {
			redirect(base_url('oops'), 'refresh');
		}

		$listing 	= $this->prodi_model->listing_profil();

		// Update hit
		if ($prodi) {
			$newhits = $prodi->hits + 1;
			$hit = array(
				'id_prodi'	=> $prodi->id_prodi,
				'hits'		=> $newhits
			);
			$this->prodi_model->update_hit($hit);
		}
		//  End update hit

		$data = array(
			'title'		=> $prodi->nama_prodi,
			'deskripsi'	=> $prodi->nama_prodi,
			'keywords'	=> $prodi->nama_prodi,
			'prodi'		=> $prodi,
			'site'		=> $site,
			'listing'	=> $profil,
			'isi'		=> 'prodi/profil'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Profil prodi detail
	public function jurusan($slug_prodi)
	{
		$site 		= $this->konfigurasi_model->listing();
		$prodi 	= $this->prodi_model->read($slug_prodi);
		$jurusan 	= $this->nav_model->nav_jurusan();

		if (count(array($prodi)) < 1) {
			redirect(base_url('oops'), 'refresh');
		}

		$listing 	= $this->prodi_model->listing_jurusan();

		// Update hit
		if ($prodi) {
			$newhits = $prodi->hits + 1;
			$hit = array(
				'id_prodi'	=> $prodi->id_prodi,
				'hits'		=> $newhits
			);
			$this->prodi_model->update_hit($hit);
		}
		//  End update hit

		$data = array(
			'title'		=> $prodi->nama_prodi,
			'deskripsi'	=> $prodi->nama_prodi,
			'keywords'	=> $prodi->nama_prodi,
			'prodi'		=> $prodi,
			'site'		=> $site,
			'listing'	=> $jurusan,
			'isi'		=> 'prodi/jurusan'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Profil prodi detail
	public function layanan($slug_prodi)
	{
		$site 		= $this->konfigurasi_model->listing();
		$prodi 	= $this->prodi_model->read($slug_prodi);
		$profil 	= $this->nav_model->nav_layanan();

		if (count(array($prodi)) < 1) {
			redirect(base_url('oops'), 'refresh');
		}

		$listing 	= $this->prodi_model->listing_layanan();

		// Update hit
		if ($prodi) {
			$newhits = $prodi->hits + 1;
			$hit = array(
				'id_prodi'	=> $prodi->id_prodi,
				'hits'		=> $newhits
			);
			$this->prodi_model->update_hit($hit);
		}
		//  End update hit

		$data = array(
			'title'		=> $prodi->nama_prodi,
			'deskripsi'	=> $prodi->nama_prodi,
			'keywords'	=> $prodi->nama_prodi,
			'prodi'	=> $prodi,
			'site'		=> $site,
			'listing'	=> $profil,
			'isi'		=> 'prodi/layanan'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Profil prodi detail
	public function prodi($slug_prodi)
	{
		$site 		= $this->konfigurasi_model->listing();
		$prodi 	= $this->prodi_model->read($slug_prodi);
		$profil 	= $this->nav_model->nav_layanan();

		if (count(array($prodi)) < 1) {
			redirect(base_url('oops'), 'refresh');
		}

		$listing 	= $this->prodi_model->listing_layanan();

		// Update hit
		if ($prodi) {
			$newhits = $prodi->hits + 1;
			$hit = array(
				'id_prodi'	=> $prodi->id_prodi,
				'hits'		=> $newhits
			);
			$this->prodi_model->update_hit($hit);
		}
		//  End update hit

		$data = array(
			'title'		=> $prodi->nama_prodi,
			'deskripsi'	=> $prodi->nama_prodi,
			'keywords'	=> $prodi->nama_prodi,
			'prodi'		=> $prodi,
			'site'		=> $site,
			'listing'	=> $profil,
			'isi'		=> 'prodi/prodi'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
}

/* End of file prodi.php */
/* Location: ./application/controllers/prodi.php */