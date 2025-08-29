<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verify extends CI_Controller {

	public function verify_recaptcha()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $recaptcha_secret = '6Lfh7xcqAAAAALao2r6Y53lS8y5zYwNUOP1e8QxE';
            $recaptcha_response = $_POST['recaptchaResponse'];
          
            // Verify the reCAPTCHA response
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response");
            $response_keys = json_decode($response, true);
          
            if (intval($response_keys["success"]) !== 1) {
              echo 'reCAPTCHA verification failed.';
            } else {
              echo 'reCAPTCHA verification succeeded.';
              // Process further actions here
            }
          }
	}
}
