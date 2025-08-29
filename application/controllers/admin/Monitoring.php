<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Monitoring extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('monitoring_model');
		$this->load->model('mperiode_model');
		$this->log_user->add_log();
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan = $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);
		require APPPATH . 'libraries/phpmailer/src/Exception.php';
		require APPPATH . 'libraries/phpmailer/src/PHPMailer.php';
		require APPPATH . 'libraries/phpmailer/src/SMTP.php';
	}

	// Halaman utama
	public function index()
	{

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'nama',
			'Nama',
			'required'
		);

		$valid->set_rules(
			'email',
			'Email',
			'required'
		);

		$valid->set_rules(
			'jabatan',
			'Jabatan',
			'required'
		);

		if ($valid->run() === false) {
			// End validasi

			$data = array(
				'title' => 'Notifikasi Email Monitoring',
				'monitoring' => $this->monitoring_model->listing(),
				'isi' => 'admin/monitoring/list'
			);
			$this->load->view('admin/layout/wrapper', $data, false);
			// Proses masuk ke database
		} else {
			$i = $this->input;

			$data = array(
				'nama' 			=> $i->post('nama'),
				'email' 		=> $i->post('email'),
				'jabatan' 		=> $i->post('jabatan'),
				'tanggal'		=> date('Y-m-d H:i:s'),
			);
			$this->monitoring_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data telah ditambah');
			redirect(base_url('admin/monitoring'), 'refresh');
		}
		// End proses masuk database
	}

	// Edit monitoring
	public function edit($id_monitoring)
	{

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'nama',
			'Nama',
			'required'
		);

		$valid->set_rules(
			'email',
			'Email',
			'required'
		);

		$valid->set_rules(
			'jabatan',
			'Jabatan',
			'required'
		);

		if ($valid->run() === false) {
			// End validasi

			$data = array(
				'title' => 'Edit Monitoring',
				'monitoring' => $this->monitoring_model->detail($id_monitoring),
				'isi' => 'admin/monitoring/edit'
			);
			$this->load->view('admin/layout/wrapper', $data, false);
			// Proses masuk ke database
		} else {
			$i = $this->input;

			$data = array(
				'id_monitoring' => $id_monitoring,
				'nama' 			=> $i->post('nama'),
				'email' 		=> $i->post('email'),
				'jabatan' 		=> $i->post('jabatan'),
				'tanggal'		=> date('Y-m-d H:i:s'),

			);
			$this->monitoring_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('admin/monitoring'), 'refresh');
		}
		// End proses masuk database
	}

	// Delete user
	public function delete($id_monitoring)
	{
		// Proteksi proses delete harus login
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan = $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);

		$data = array('id_monitoring' => $id_monitoring);
		$this->monitoring_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/monitoring'), 'refresh');
	}
	// Verify Email
	public function verify($id_monitoring)
	{
		$data = array(
			'title' => 'Edit Monitoring',
			'monitoring' => $this->monitoring_model->detail($id_monitoring),
			'periode' => $this->mperiode_model->listing(),
			'isi' => 'admin/monitoring/verify'
		);
		$this->load->view('admin/layout/wrapper', $data, false);
	}

	public function send()
	{
		// PHPMailer object
		$response = false;
		$mail = new PHPMailer();

		// SMTP configuration
		$mail->isSMTP();
		$mail->Host     	= 'smtp.gmail.com';
		$mail->SMTPAuth 	= true;
		$mail->Username 	= 'shortlinkjakarta3@gmail.com'; // user email anda
		$mail->Password 	= 'xsnottnbrmrgboss'; // diisi dengan App Password yang sudah di generate
		$mail->SMTPSecure 	= 'ssl';
		$mail->Port     	= 465;

		$mail->setFrom('shortlinkjakarta3@gmail.com', 'adak@poltekkesjakarta3.ac.id'); // user email anda
		$mail->addReplyTo('shortlinkjakarta3@gmail.com', 'adak@poltekkesjakarta3.ac.id'); //user email anda

		// Email subject
		$mail->Subject = 'Notifikasi Pengisian Instrumen Monitoring dan Evaluasi'; //subject email

		// Add a recipient
		$mail->addAddress($this->input->post('email')); //email tujuan pengiriman email

		// Set email format to HTML
		$mail->isHTML(true);

		// Email body content
		$mailContent = "<p>Yth. Bapak/Ibu <b>" . $this->input->post('nama') . "</b> Ini adalah notifikasi pengisian Instrumen Monitoring dan Evaluasi:</p>
   <table>
     <tr>
       <td>Nama</td>
       <td>:</td>
       <td>" . $this->input->post('nama') . "</td>
     </tr>
     <tr>
       <td>Jabatan</td>
       <td>:</td>
       <td>" . $this->input->post('jabatan') . "</td>
     </tr>
     <tr>
       <td>Periode</td>
       <td>:</td>
       <td>" . $this->input->post('periode') . "</td>
     </tr>
	 
   </table>
   <p>Yth.<br />Bapak/Ibu</p>
   <p>Di Mohon Bapak/Ibu Untuk Pengisian Data Intrumen Monitoring dan Evaluasi " . $this->input->post('periode') . "<br />Berikut Link Pengisian Berdasarkan Periode</p>
   " . $this->input->post('isi') . "
   	Terimakasih."; // isi email
		$mail->Body = $mailContent;

		// Send email
		if (!$mail->send()) {
			$this->session->set_flashdata('gagal', 'Notifikasi Gagal Dikirim');
			redirect(base_url('admin/monitoring'), 'refresh');
		} else {
			$this->session->set_flashdata('sukses', 'Notifikasi Berhasil Dikirim');
			redirect(base_url('admin/monitoring'), 'refresh');
		}
	}
}

/* End of file monitoring.php */
/* Location: ./application/controllers/admin/monitoring.php */
