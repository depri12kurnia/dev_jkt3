<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mperiode extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mperiode_model');
		$this->log_user->add_log();
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);
	}

	// Index
	public function index()
	{
		$mperiode	= $this->mperiode_model->listing();

		$data = array(
			'title'		=> 'Periode Monitoring dan Evaluasi',
			'mperiode'	=> $mperiode,
			'isi'		=> 'admin/mperiode/list'
		);
		$this->load->view('admin/layout/wrapper', $data);
	}

	// Proses
	public function proses()
	{
		$site = $this->konfigurasi_model->listing();
		// PROSES HAPUS MULTIPLE
		if (isset($_POST['hapus'])) {
			$inp 				= $this->input;
			$id_mperiodenya		= $inp->post('id_mperiode');

			for ($i = 0; $i < sizeof($id_mperiodenya); $i++) {
				$mperiode 	= $this->mperiode_model->detail($id_mperiodenya[$i]);
				if ($mperiode->gambar != '') {
					unlink('./assets/upload/file/' . $mperiode->gambar);
				}
				$data = array('id_mperiode'	=> $id_mperiodenya[$i]);
				$this->mperiode_model->delete($data);
			}

			$this->session->set_flashdata('sukses', 'Data telah dihapus');
			redirect(base_url('admin/mperiode'), 'refresh');
			// PROSES SETTING DRAFT
		}
	}

	// Tambah
	public function tambah()
	{
		// Validasi
		$v = $this->form_validation;
		$v->set_rules('periode', 'Periode', 'required');
		$v->set_rules('isi', 'Isi', 'required');

		if ($v->run() === FALSE) {
			$data = array(
				'title'		=> 'Add Periode',
				'isi'		=> 'admin/mperiode/tambah'
			);
			$this->load->view('admin/layout/wrapper', $data);
			// Masuk database
		} else {

			$i = $this->input;
			$data = array(
				'periode'	=> $i->post('periode'),
				'isi'		=> $i->post('isi')
			);
			$this->mperiode_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data added successfully');
			redirect(base_url('admin/mperiode'));
		}
	}

	// Edit
	public function edit($id_mperiode)
	{
		// Dari database
		$mperiode		= $this->mperiode_model->detail($id_mperiode);
		// Validasi
		$v = $this->form_validation;
		$v->set_rules('periode', 'Periode', 'required');
		$v->set_rules('isi', 'Isi', 'required');

		if ($v->run() === FALSE) {
			$data = array(
				'title'		=> 'Edit mperiode',
				'mperiode'		=> $mperiode,
				'isi'		=> 'admin/mperiode/edit'
			);
			$this->load->view('admin/layout/wrapper', $data);
			// Masuk database
		} else {
			$i = $this->input;
			$data = array(
				'id_mperiode'	=> $mperiode->id_mperiode,
				'periode'		=> $i->post('periode'),
				'isi'			=> $i->post('isi')
			);
			$this->mperiode_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data updated successfully');
			redirect(base_url('admin/mperiode'));
		}
	}

	// Delete
	public function delete($id_mperiode)
	{
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);

		$mperiode	= $this->mperiode_model->detail($id_mperiode);
		$data = array('id_mperiode'	=> $id_mperiode);
		$this->mperiode_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data deleted successfully');
		redirect(base_url('admin/mperiode'));
	}
}
