<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Maintenance extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Ambil check login dari simple_login

    }

    public function index()
    {
        $this->load->view('maintenance');
    }
}

/* End of file Surat.php */
/* Location: ./application/controllers/Surat.php */