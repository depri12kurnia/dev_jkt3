<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sitemap extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('sitemap_model', 'sitemap');
    }

    public function alumni()
    {

        $post = $this->sitemap->alumni();

        $data = [
            'post'   => $post
        ];

        $this->load->view('sitemap/sitemap_alumni', $data);
    }

    public function berita()
    {

        $post = $this->sitemap->berita();

        $data = [
            'post'   => $post
        ];

        $this->load->view('sitemap/sitemap_berita', $data);
    }

    public function pendidikan()
    {

        $post = $this->sitemap->pendidikan();

        $data = [
            'post'   => $post
        ];

        $this->load->view('sitemap/sitemap_pendidikan', $data);
    }

    public function tentang()
    {

        $post = $this->sitemap->pages();

        $data = [
            'post'   => $post
        ];

        $this->load->view('sitemap/sitemap_tentang', $data);
    }

    public function prodi()
    {

        $post = $this->sitemap->prodi();

        $data = [
            'post'   => $post
        ];

        $this->load->view('sitemap/sitemap_prodi', $data);
    }
    
    public function custom()
    {
        
        $this->load->view('sitemap/sitemap_custom');
        
    }
}
