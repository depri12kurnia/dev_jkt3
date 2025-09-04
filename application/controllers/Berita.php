<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('berita_model');
		$this->load->model('kategori_model');
	}

	// Main page
	public function index()
	{
		$site 		= $this->konfigurasi_model->listing();
		$populer	= $this->berita_model->populer();
		$pengumuman	= $this->berita_model->pengumuman();
		$list_side	= $this->kategori_model->list_side();

		// Berita dan paginasi
		$this->load->library('pagination');
		$config['base_url'] 		= base_url() . 'berita/index/';
		$config['total_rows'] 		= $this->db->count_all('berita');
		$config['num_links'] 		= 2;
		$config['uri_segment'] 		= 3;

		$config['per_page'] 		= 8;
		$config['first_url'] 		= base_url() . 'berita/';

		$config['full_tag_open'] 	= '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
		$config['full_tag_close'] 	= '</ul></nav>';

		$config['first_link'] 		= '<i class="bi bi-chevron-double-left"></i>';
		$config['first_tag_open'] 	= '<li class="page-item">';
		$config['first_tag_close'] 	= '</li>';

		$config['last_link'] 		= '<i class="bi bi-chevron-double-right"></i>';
		$config['last_tag_open'] 	= '<li class="page-item">';
		$config['last_tag_close'] 	= '</li>';

		$config['next_link'] 		= '<i class="bi bi-chevron-right"></i>';
		$config['next_tag_open'] 	= '<li class="page-item">';
		$config['next_tag_close'] 	= '</li>';

		$config['prev_link'] 		= '<i class="bi bi-chevron-left"></i>';
		$config['prev_tag_open'] 	= '<li class="page-item">';
		$config['prev_tag_close'] 	= '</li>';

		$config['cur_tag_open'] 	= '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] 	= '</span></li>';

		$config['num_tag_open'] 	= '<li class="page-item">';
		$config['num_tag_close'] 	= '</li>';

		$config['attributes'] = array('class' => 'page-link');

		$page 		= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$this->pagination->initialize($config);

		$berita 	= $this->berita_model->berita($config['per_page'], $page);

		$pagination = $this->pagination->create_links();

		$data = array(
			'title'			=> 'Berita - ' . $site->namaweb,
			'deskripsi'		=> 'Berita - ' . $site->namaweb,
			'keywords'		=> 'Berita - ' . $site->namaweb,
			'pagination' 	=> $pagination,
			'berita'		=> $berita,
			'site'			=> $site,
			'populer'		=> $populer,
			'pengumuman' 	=> $pengumuman,
			'list_side'		=> $list_side,
			'isi'			=> 'berita/list'
		);
		$this->load->view('layout/wrapper', $data, false);
	}

	// Category======================================================================================== 
	public function kategori($slug_kategori)
	{
		$site 			= $this->konfigurasi_model->listing();
		$populer		= $this->berita_model->populer();
		$pengumuman		= $this->berita_model->pengumuman();
		$list_side		= $this->kategori_model->list_side();
		$kategori 		= $this->kategori_model->read($slug_kategori);

		if (count(array($kategori)) < 1) {
			redirect(base_url('oops'), 'refresh');
		}

		$id_kategori	= $kategori->id_kategori;

		// Berita dan paginasi
		$this->load->library('pagination');
		$config['base_url'] 		= base_url() . 'kategori/' . $slug_kategori;
		$config['total_rows'] 		= $this->berita_model->get_count();

		$config['use_page_numbers'] = TRUE;
		$config['num_links'] 		= 2;
		$config['uri_segment'] 		= 3;

		$config['per_page'] 		= 8;
		$config['first_url'] 		= base_url() . 'kategori/' . $slug_kategori;

		$config['full_tag_open'] 	= '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
		$config['full_tag_close'] 	= '</ul></nav>';

		$config['first_link'] 		= '<i class="bi bi-chevron-double-left"></i>';
		$config['first_tag_open'] 	= '<li class="page-item">';
		$config['first_tag_close'] 	= '</li>';

		$config['last_link'] 		= '<i class="bi bi-chevron-double-right"></i>';
		$config['last_tag_open'] 	= '<li class="page-item">';
		$config['last_tag_close'] 	= '</li>';

		$config['next_link'] 		= '<i class="bi bi-chevron-right"></i>';
		$config['next_tag_open'] 	= '<li class="page-item">';
		$config['next_tag_close'] 	= '</li>';

		$config['prev_link'] 		= '<i class="bi bi-chevron-left"></i>';
		$config['prev_tag_open'] 	= '<li class="page-item">';
		$config['prev_tag_close'] 	= '</li>';

		$config['cur_tag_open'] 	= '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] 	= '</span></li>';

		$config['num_tag_open'] 	= '<li class="page-item">';
		$config['num_tag_close'] 	= '</li>';

		$config['attributes'] = array('class' => 'page-link');

		$page 		= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$this->pagination->initialize($config);

		$berita 	= $this->berita_model->kategori($id_kategori, $config['per_page'], $page);

		$pagination = $this->pagination->create_links();

		$data = array(
			'title'			=> 'Kategori berita: ' . $kategori->nama_kategori,
			'deskripsi'		=> 'Kategori berita: ' . $kategori->nama_kategori,
			'keywords'		=> 'Kategori berita: ' . $kategori->nama_kategori,
			'berita'		=> $berita,
			'pagination' 	=> $pagination,
			'site'			=> $site,
			'populer'		=> $populer,
			'pengumuman'	=> $pengumuman,
			'list_side'		=> $list_side,
			'isi'			=> 'berita/list_kategori'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	// Search
	public function cari()
	{
		$this->load->helper('security');
		$s 			= $this->input->post('s');
		$keyword 	= xss_clean($s);
		$keywords	= encode_php_tags($keyword);

		if ($keywords != "") {
			redirect(base_url('berita/search?s=' . $keywords), 'refresh');
		} else {
			redirect(base_url('berita'), 'refresh');
		}
	}

	// Read berita detail
	public function read($slug_berita)
	{
		$site 		= $this->konfigurasi_model->listing();
		$berita 	= $this->berita_model->read($slug_berita);
		$listing 	= $this->berita_model->listing_read();
		$populer	= $this->berita_model->populer();
		$pengumuman	= $this->berita_model->pengumuman();
		$berita_lainnya 	= $this->berita_model->berita_lainnya();
		$list_side	= $this->kategori_model->list_side();

		if (count(array($berita)) < 1) {
			redirect(base_url('oops'), 'refresh');
		}

		// Update hit
		if ($berita) {
			$newhits 	= $berita->hits + 1;
			$hit 		= array(
				'id_berita'	=> $berita->id_berita,
				'hits'		=> $newhits
			);
			$this->berita_model->update_hit($hit);
		}
		//  End update hit

		$data = array(
			'title'		=> $berita->judul_berita . '-' . $site->namaweb,
			'deskripsi'	=> $berita->judul_berita . '-' . $site->namaweb,
			'keywords'	=> $berita->judul_berita . '-' . $site->namaweb,
			'berita'	=> $berita,
			'listing'	=> $listing,
			'list_side'	=> $list_side,
			'populer'	=> $populer,
			'pengumuman' => $pengumuman,
			'site'		=> $site,
			'berita_lainnya' => $berita_lainnya,
			'isi'		=> 'berita/read'
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
		$populer	= $this->berita_model->populer();
		$pengumuman	= $this->berita_model->pengumuman();
		$list_side	= $this->kategori_model->list_side();

		if ($keywords == "") {
			redirect(base_url('berita'), 'refresh');
		}

		$site 		= $this->konfigurasi_model->listing();

		// Berita dan paginasi
		$this->load->library('pagination');
		$config['base_url'] 		= base_url() . 'berita/search?s=' . $keywords . '/index/';
		$config['total_rows'] 		= $this->berita_model->get_count();
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] 		= 3;
		$config['uri_segment'] 		= 3;

		$config['per_page'] 		= 10;
		$config['first_url'] 		= base_url() . 'berita/search?s=' . $keywords;

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

		$this->pagination->initialize($config);

		$page 		= ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) * $config['per_page'] : 0;

		$berita 	= $this->berita_model->search($keywords, $config['per_page'], $page);

		$pagination = $this->pagination->create_links();

		$data = array(
			'title'		=> 'Hasil pencarian: ' . $keywords,
			'deskripsi'	=> 'Berita - ' . $site->namaweb,
			'keywords'	=> 'Berita - ' . $site->namaweb,
			'pagination' 	=> $pagination,
			'berita'	=> $berita,
			'site'		=> $site,
			'populer'	=> $populer,
			'list_side'	=> $list_side,
			'pengumuman'	=> $pengumuman,
			'isi'		=> 'berita/search'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
}

/* End of file Berita.php */
/* Location: ./application/controllers/Berita.php */