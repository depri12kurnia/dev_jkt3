<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_download extends CI_Controller
{

    // Load database
    public function __construct()
    {
        parent::__construct();
        $this->load->model('jenis_download_model');
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

        $valid->set_rules('nama_jenis_download', 'Nama jenis_download', 'required|is_unique[jenis_download.nama_jenis_download]',
            array('required' => 'Nama jenis_download harus diisi',
                'is_unique' => 'Nama jenis_download sudah ada. Buat Nama jenis_download baru!'));

        $valid->set_rules('urutan', 'Urutan', 'required',
            array('required' => 'Urutan harus diisi'));

        if ($valid->run() === false) {
            // End validasi

            $data = array(
                'title' => 'Jenis Download',
                'jenis_download' => $this->jenis_download_model->listing(),
                'kategori_download' => $this->jenis_download_model->get_kategori(),
                'isi' => 'admin/jenis_download/list');
            $this->load->view('admin/layout/wrapper', $data, false);
            // Proses masuk ke database
        } else {
            $i = $this->input;
            $slug = url_title($i->post('nama_jenis_download'), 'dash', true);

            $data = array(
                'id_subkategori_download' => $i->post('id_subkategori_download'),
                'nama_jenis_download' => $i->post('nama_jenis_download'),
                'slug_jenis_download' => $slug,
                'urutan' => $i->post('urutan'),
            );
            $this->jenis_download_model->tambah($data);
            $this->session->set_flashdata('sukses', 'Data telah ditambah');
            redirect(base_url('admin/jenis_download'), 'refresh');
        }
        // End proses masuk database
    }

    // Edit jenis_download
    public function edit($id_jenis_download)
    {

        // Validasi
        $valid = $this->form_validation;

        $valid->set_rules('nama_jenis_download', 'Nama jenis_download', 'required',
            array('required' => 'Nama jenis_download harus diisi'));

        $valid->set_rules('urutan', 'Urutan', 'required',
            array('required' => 'Urutan harus diisi'));

        if ($valid->run() === false) {
            // End validasi

            $data = array('title' => 'Edit Jenis Download',
                'jenis_download' => $this->jenis_download_model->detail($id_jenis_download),
                'kategori_download' => $this->jenis_download_model->get_kategori(),
                'isi' => 'admin/jenis_download/edit');
            $this->load->view('admin/layout/wrapper', $data, false);
            // Proses masuk ke database
        } else {
            $i = $this->input;
            $slug = url_title($i->post('nama_jenis_download'), 'dash', true);

            $data = array(
                'id_jenis_download' => $id_jenis_download,
                'id_subkategori_download' => $i->post('id_subkategori_download'),
                'nama_jenis_download' => $i->post('nama_jenis_download'),
                'slug_jenis_download' => $slug,
                'urutan' => $i->post('urutan'),
            );
            $this->jenis_download_model->edit($data);
            $this->session->set_flashdata('sukses', 'Data telah diedit');
            redirect(base_url('admin/jenis_download'), 'refresh');
        }
        // End proses masuk database
    }

    // Delete user
    public function delete($id_jenis_download)
    {
        // Proteksi proses delete harus login
        // Tambahkan proteksi halaman
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan = $this->session->set_userdata('pengalihan', $url_pengalihan);
// Ambil check login dari simple_login
        $this->simple_login->check_login($pengalihan);

        $data = array('id_jenis_download' => $id_jenis_download);
        $this->jenis_download_model->delete($data);
        $this->session->set_flashdata('sukses', 'Data telah dihapus');
        redirect(base_url('admin/jenis_download'), 'refresh');
    }
}

/* End of file jenis_download.php */
/* Location: ./application/controllers/admin/jenis_download.php */
