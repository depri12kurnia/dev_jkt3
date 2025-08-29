<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	// load model
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('recaptcha');
		$this->load->library('ip_blocker');
        $this->ip_blocker->check_ip();

	}

	// Login page
	public function index()
	{
		// Validasi input
		$this->form_validation->set_rules(
			'username',
			'Username',
			'required',
			array('required|trim|xss_clean'	=> '%s harus diisi')
		);

		$this->form_validation->set_rules(
			'password',
			'Password',
			'required',
			array('required|trim|xss_clean'	=> '%s harus diisi')
		);

		if ($this->form_validation->run()) {
			$username 	= strip_tags($this->input->post('username', TRUE));
			$password 	= strip_tags($this->input->post('password', TRUE));
			// Proses ke simple login
			$this->simple_login->login($username, $password);
		}
		// End validasi

		$data = array('title'		=> 'Halaman Login');
		$this->load->view('login/list', $data, FALSE);
	}

	// Logout
	public function logout()
	{
		// Panggil library logout
		$this->simple_login->logout();
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */