<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pages_model');
		$this->load->model('berita_model');

		// model download
		$this->load->model('download_model');
		$this->load->model('kategori_download_model');
		$this->load->model('jenis_download_model');
	}

	// Main page
	public function index()
	{
		$site 		= $this->konfigurasi_model->listing();
		$populer	= $this->pages_model->populer();
		$pengumuman	= $this->pages_model->pengumuman();
		$list_side	= $this->kategori_model->list_side();

		// pages dan paginasi
		$this->load->library('pagination');
		$config['base_url'] 		= base_url() . 'pages/index/';
		$config['total_rows'] 		= $this->db->count_all('pages');
		$config['num_links'] 		= 5;
		$config['uri_segment'] 		= 3;

		$config['per_page'] 		= 2;
		$config['first_url'] 		= base_url() . 'pages/';

		$config['full_tag_open'] 	= '<ul class="pagination">';
		$config['full_tag_close'] 	= '</ul>';

		$config['first_link'] 		= '&laquo;';
		$config['first_tag_open'] 	= '<li class="prev page">';
		$config['first_tag_close'] 	= '</li>';

		$config['last_link'] 		= '&raquo;';
		$config['last_tag_open'] 	= '<li class="next page">';
		$config['last_tag_close'] 	= '</li>';

		$config['next_link'] 		= '&rarr;';
		$config['next_tag_open'] 	= '<li class="next page">';
		$config['next_tag_close'] 	= '</li>';

		$config['prev_link'] 		= '&larr;';
		$config['prev_tag_open'] 	= '<li class="prev page">';
		$config['prev_tag_close'] 	= '</li>';

		$config['cur_tag_open'] 	= '<li class="active"><a href="">';
		$config['cur_tag_close'] 	= '</a></li>';

		$config['num_tag_open'] 	= '<li class="page">';
		$config['num_tag_close'] 	= '</li>';

		$page 		= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$this->pagination->initialize($config);

		$pages 	= $this->pages_model->pages($config['per_page'], $page);

		$pagination = $this->pagination->create_links();

		$data = array(
			'title'			=> 'pages - ' . $site->namaweb,
			'deskripsi'		=> 'pages - ' . $site->namaweb,
			'keywords'		=> 'pages - ' . $site->namaweb,
			'pagination' 	=> $pagination,
			'pages'			=> $pages,
			'site'			=> $site,
			'populer'		=> $populer,
			'pengumuman' 	=> $pengumuman,
			'list_side'		=> $list_side,
			'isi'			=> 'pages/list'
		);
		$this->load->view('layout/wrapper', $data, false);
	}

	// Profil pages detail
	public function tentang($slug_pages)
	{
		$site 		= $this->konfigurasi_model->listing();
		$pages 		= $this->pages_model->read($slug_pages);
		$profil 	= $this->nav_model->nav_profil();

		if (count(array($pages)) < 1) {
			redirect(base_url('oops'), 'refresh');
		}

		// Update hit
		if ($pages) {
			$newhits = $pages->hits + 1;
			$hit = array(
				'id_pages'	=> $pages->id_pages,
				'hits'		=> $newhits
			);
			$this->pages_model->update_hit($hit);
		}
		//  End update hit

		$data = array(
			'title'		=> $pages->judul_pages . '-' . $site->namaweb,
			'deskripsi'	=> $pages->judul_pages . '-' . $site->namaweb,
			'keywords'	=> $pages->judul_pages . '-' . $site->namaweb,
			'pages'		=> $pages,
			'site'		=> $site,
			'listing'	=> $profil,
			'isi'		=> 'pages/profil'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Page Jurusan
	public function jurusan($slug_pages)
	{
		$site 		= $this->konfigurasi_model->listing();
		$pages 		= $this->pages_model->read($slug_pages);
		$jurusan 	= $this->nav_model->nav_jurusan();

		if (count(array($pages)) < 1) {
			redirect(base_url('oops'), 'refresh');
		}

		// $listing 	= $this->pages_model->listing_jurusan();

		// Update hit
		if ($pages) {
			$newhits = $pages->hits + 1;
			$hit = array(
				'id_pages'	=> $pages->id_pages,
				'hits'		=> $newhits
			);
			$this->pages_model->update_hit($hit);
		}
		//  End update hit

		$data = array(
			'title'		=> $pages->judul_pages . '-' . $site->namaweb,
			'deskripsi'	=> $pages->judul_pages . '-' . $site->namaweb,
			'keywords'	=> $pages->judul_pages . '-' . $site->namaweb,
			'pages'	=> $pages,
			'site'		=> $site,
			'listing'	=> $jurusan,
			'isi'		=> 'pages/jurusan'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Page Alumni
	public function alumni($slug_pages)
	{
		$site 		= $this->konfigurasi_model->listing();
		$pages 		= $this->pages_model->read($slug_pages);
		$alumni 	= $this->nav_model->nav_alumni();
		$pengumuman	= $this->berita_model->pengumuman();

		if (count(array($pages)) < 1) {
			redirect(base_url('oops'), 'refresh');
		}

		// $listing 	= $this->pages_model->listing_jurusan();

		// Update hit
		if ($pages) {
			$newhits = $pages->hits + 1;
			$hit = array(
				'id_pages'	=> $pages->id_pages,
				'hits'		=> $newhits
			);
			$this->pages_model->update_hit($hit);
		}
		//  End update hit

		$data = array(
			'title'		=> $pages->judul_pages . '-' . $site->namaweb,
			'deskripsi'	=> $pages->judul_pages . '-' . $site->namaweb,
			'keywords'	=> $pages->judul_pages . '-' . $site->namaweb,
			'pages'		=> $pages,
			'site'		=> $site,
			'pengumuman' => $pengumuman,
			'listing'	=> $alumni,
			'isi'		=> 'pages/alumni'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Profil pages detail
	public function pendidikan($slug_pages)
	{
		$site 		= $this->konfigurasi_model->listing();
		$pages 		= $this->pages_model->read($slug_pages);
		$profil 	= $this->nav_model->nav_pendidikan();
		$download 	= $this->download_model->download();
		$pa 	= $this->download_model->listingPA();
		$ka 	= $this->download_model->listingKA();
		$pengumuman	= $this->berita_model->pengumuman();

		if (count(array($pages)) < 1) {
			redirect(base_url('oops'), 'refresh');
		}

		// $listing 	= $this->pages_model->listing_pendidikan();

		// Update hit
		if ($pages) {
			$newhits = $pages->hits + 1;
			$hit = array(
				'id_pages'	=> $pages->id_pages,
				'hits'		=> $newhits
			);
			$this->pages_model->update_hit($hit);
		}
		//  End update hit

		$data = array(
			'title'		=> $pages->judul_pages . '-' . $site->namaweb,
			'deskripsi'	=> $pages->judul_pages . '-' . $site->namaweb,
			'keywords'	=> $pages->judul_pages . '-' . $site->namaweb,
			'pages'		=> $pages,
			'peraturan_akademik'   => $pa,
			'kalender_akademik'   => $ka,
			'pengumuman' => $pengumuman,
			'site'		=> $site,
			'listing'	=> $profil,
			'isi'		=> 'pages/pendidikan'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Profil pages detail
	public function layanan($slug_pages)
	{
		$site 		= $this->konfigurasi_model->listing();
		$pages 		= $this->pages_model->read($slug_pages);
		$profil 	= $this->nav_model->nav_pendidikan();
		$download 	= $this->download_model->download();
		$pa 	= $this->download_model->listingPA();
		$ka 	= $this->download_model->listingKA();
		$pengumuman	= $this->berita_model->pengumuman();

		if (count(array($pages)) < 1) {
			redirect(base_url('oops'), 'refresh');
		}

		// $listing 	= $this->pages_model->listing_pendidikan();

		// Update hit
		if ($pages) {
			$newhits = $pages->hits + 1;
			$hit = array(
				'id_pages'	=> $pages->id_pages,
				'hits'		=> $newhits
			);
			$this->pages_model->update_hit($hit);
		}
		//  End update hit

		$data = array(
			'title'		=> $pages->judul_pages . '-' . $site->namaweb,
			'deskripsi'	=> $pages->judul_pages . '-' . $site->namaweb,
			'keywords'	=> $pages->judul_pages . '-' . $site->namaweb,
			'pages'		=> $pages,
			'peraturan_akademik'   => $pa,
			'kalender_akademik'   => $ka,
			'pengumuman' => $pengumuman,
			'site'		=> $site,
			'listing'	=> $profil,
			'isi'		=> 'pages/layanan'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// SPI pages detail
	public function spi($slug_pages)
	{
		$site 		= $this->konfigurasi_model->listing();
		$pages 		= $this->pages_model->read($slug_pages);
		$spi 	    = $this->nav_model->nav_spi();

		if (count(array($pages)) < 1) {
			redirect(base_url('oops'), 'refresh');
		}

		// Update hit
		if ($pages) {
			$newhits = $pages->hits + 1;
			$hit = array(
				'id_pages'	=> $pages->id_pages,
				'hits'		=> $newhits
			);
			$this->pages_model->update_hit($hit);
		}
		//  End update hit

		$data = array(
			'title'		=> $pages->judul_pages . '-' . $site->namaweb,
			'deskripsi'	=> $pages->judul_pages . '-' . $site->namaweb,
			'keywords'	=> $pages->judul_pages . '-' . $site->namaweb,
			'pages'		=> $pages,
			'site'		=> $site,
			'listing'	=> $spi,
			'isi'		=> 'pages/spi'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Unduh
	public function unduh($id_download)
	{
		$this->load->helper('download');
		$download = $this->download_model->detail($id_download);
		// Contents of photo.jpg will be automatically read
		force_download('./assets/upload/file/' . $download->gambar, null);
	}
}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */