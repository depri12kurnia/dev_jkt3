<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Language extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
    }

    public function switch_language($language = "id")
    {
        $allowed = ['id', 'en'];
        if (in_array($language, $allowed)) {
            $this->session->set_userdata('site_lang', $language);
        }
        redirect($this->agent->referrer() ?: base_url());
    }
}
