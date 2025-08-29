<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Captcha extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->config->load('recaptcha');
    }

    public function index()
    {
        $data['recaptcha_site_key'] = $this->config->item('recaptcha_site_key');
        $this->load->view('captcha_form', $data);
    }

    public function validate_recaptcha()
    {
        $recaptcha_response = $this->input->post('g-recaptcha-response');
        $recaptcha_secret = $this->config->item('recaptcha_secret_key');

        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$recaptcha_response);
        $responseKeys = json_decode($response, true);

        if(intval($responseKeys["success"]) !== 1) {
            echo json_encode(['success' => true, 'message' => 'reCAPTCHA completed successfully!']);
        } else {
            
            echo json_encode(['success' => false, 'message' => 'Please complete the reCAPTCHA']);
        }
    }
}
