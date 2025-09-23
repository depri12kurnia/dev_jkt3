<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cookies extends CI_Controller
{

    // Load database
    public function __construct()
    {
        parent::__construct();
    }

    // Main page
    public function index()
    {
        $site             = $this->konfigurasi_model->listing();

        $data = array(
            'title'        => 'Kebijakan Cookies - ' . $site->namaweb,
            'deskripsi'    => 'Kebijakan Cookies - ' . $site->namaweb,
            'keywords'    => 'Kebijakan Cookies - ' . $site->namaweb,
            'site'        => $site,
        );
        $this->load->view('kebijakan-cookies', $data, FALSE);
    }
}
