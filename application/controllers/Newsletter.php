<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Newsletter extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Newsletter_model');
        $this->load->library('email');
        $this->load->helper(['url', 'string']);
    }

    public function subscribe()
    {
        $email = $this->input->post('email', TRUE);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => false, 'message' => 'Email tidak valid']);
            return;
        }

        $token = random_string('alnum', 40);
        $saved = $this->Newsletter_model->save_subscriber($email, $token);

        if ($saved) {
            $this->_send_confirmation($email, $token);
            echo json_encode(['status' => true, 'message' => 'Silakan periksa email Anda untuk konfirmasi.']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Email sudah terdaftar.']);
        }
    }

    public function confirm($token = null)
    {
        if ($this->Newsletter_model->confirm_token($token)) {

            echo "Email Anda berhasil dikonfirmasi!";
        } else {

            echo "Token tidak valid atau sudah kadaluarsa.";
        }
    }

    private function _send_confirmation($email, $token)
    {
        $link = base_url("newsletter/confirm/$token");

        // Inisialisasi email pakai config
        $this->email->initialize();

        $this->email->from('newsletter@poltekkesjakarta3.ac.id', 'Newsletter Poltekkes Jakarta III');
        $this->email->to($email);
        $this->email->subject('Konfirmasi Langganan Newsletter');
        $this->email->message("Klik link berikut untuk konfirmasi langganan:\n\n$link");

        if ($this->email->send()) {
            log_message('info', "Email konfirmasi dikirim ke $email");
        } else {
            log_message('error', $this->email->print_debugger());
        }
    }
}
