<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_helpdesk extends CI_Controller
{

    // Load database
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kategori_helpdesk_model');
        $this->log_user->add_log();
        // Tambahkan proteksi halaman
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan = $this->session->set_userdata('pengalihan', $url_pengalihan);
        // Ambil check login dari simple_login
        $this->simple_login->check_login($pengalihan);
    }

    // Halaman utama
    public function index()
    {
        // Validasi
        $valid = $this->form_validation;

        $valid->set_rules(
            'nama_kategori_helpdesk',
            'Nama kategori helpdesk',
            'required|is_unique[kategori_helpdesk.nama_kategori_helpdesk]',
            array('required' => 'Nama kategori harus diisi', 'is_unique' => 'Nama kategori sudah ada. Buat Nama kategori baru!')
        );
        $valid->set_rules(
            'urutan',
            'Urutan',
            'required',
            array('required' => 'Urutan harus diisi')
        );
        if ($valid->run() === false) {
            // End validasi
            $data = array(
                'title' => 'Kategori Helpdesk/Penanggung Jawab',
                'kategori_helpdesk' => $this->kategori_helpdesk_model->listing(),
                'isi' => 'admin/kategori_helpdesk/list'
            );
            $this->load->view('admin/layout/wrapper', $data, false);
            // Proses masuk ke database
        } else {
            $i = $this->input;
            $slug = url_title($i->post('nama_kategori_helpdesk'), 'dash', true);

            $data = array(
                'id_user' => $this->session->userdata('id_user'),
                'nama_kategori_helpdesk' => $i->post('nama_kategori_helpdesk'),
                'slug_kategori_helpdesk' => $slug,
                'urutan' => $i->post('urutan'),
            );
            $this->kategori_helpdesk_model->tambah($data);
            $this->session->set_flashdata('sukses', 'Data telah ditambah');
            redirect(base_url('admin/kategori_helpdesk'), 'refresh');
        }
        // End proses masuk database
    }

    // Edit kategori
    public function edit($id_kategori_helpdesk)
    {
        // Validasi
        $valid = $this->form_validation;

        $valid->set_rules(
            'nama_kategori',
            'Nama kategori',
            'required',
            array('required' => 'Nama kategori harus diisi')
        );

        $valid->set_rules(
            'urutan',
            'Urutan',
            'required',
            array('required' => 'Urutan harus diisi')
        );

        if ($valid->run() === false) {
            // End validasi

            $data = array(
                'title' => 'Edit Helpdesk/Penanggung Jawab',
                'kategori' => $this->kategori_helpdesk_model->detail($id_kategori_helpdesk),
                'isi' => 'admin/kategori_helpdesk/edit'
            );
            $this->load->view('admin/layout/wrapper', $data, false);
            // Proses masuk ke database
        } else {
            $i = $this->input;
            $slug = url_title($i->post('nama_kategori'), 'dash', true);

            $data = array(
                'id_kategori_helpdesk' => $id_kategori_helpdesk,
                'id_user' => $this->session->userdata('id_user'),
                'nama_kategori_helpdesk' => $i->post('nama_kategori'),
                'slug_kategori_helpdesk' => $slug,
                'urutan' => $i->post('urutan'),
            );
            $this->kategori_helpdesk_model->edit($data);
            $this->session->set_flashdata('sukses', 'Data telah diedit');
            redirect(base_url('admin/kategori_helpdesk'), 'refresh');
        }
        // End proses masuk database
    }

    // Delete user
    public function delete($id_kategori_helpdesk)
    {
        // Proteksi proses delete harus login
        // Tambahkan proteksi halaman
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan = $this->session->set_userdata('pengalihan', $url_pengalihan);
        // Ambil check login dari simple_login
        $this->simple_login->check_login($pengalihan);

        $data = array('id_kategori_helpdesk' => $id_kategori_helpdesk);
        $this->kategori_helpdesk_model->delete($data);
        $this->session->set_flashdata('sukses', 'Data telah dihapus');
        redirect(base_url('admin/kategori_helpdesk'), 'refresh');
    }
}

/* End of file Kategori_helpdesk.php */
/* Location: ./application/controllers/admin/kategori_helpdesk.php */
