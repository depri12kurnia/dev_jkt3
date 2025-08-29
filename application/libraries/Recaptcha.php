<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recaptcha {

    private $site_key;
    private $secret_key;

    public function __construct() {
        $this->site_key = '6LfqJRMqAAAAAIeZPSEHC0mt9wtUTAt9KvcRrc1q'; // Ganti dengan Site Key Anda
        $this->secret_key = '6LfqJRMqAAAAAOVjuVNdIDOp7bHaP_zCZHVe1f-c'; // Ganti dengan Secret Key Anda
    }

    public function create_box() {
        return '<div class="g-recaptcha" data-sitekey="'.$this->site_key.'"></div>';
    }

    public function verify_response($response, $remoteip) {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => $this->secret_key,
            'response' => $response,
            'remoteip' => $remoteip
        );

        $options = array(
            'http' => array (
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );

        $context  = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captcha_success = json_decode($verify);

        return $captcha_success->success;
    }
}
