<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testimoni extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Testimoni_model');
        $this->load->library('session');
        $this->log_user->add_log();
        // Tambahkan proteksi halaman
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan = $this->session->set_userdata('pengalihan', $url_pengalihan);
        // Ambil check login dari simple_login
        $this->simple_login->check_login($pengalihan);
    }

    // List semua testimoni
    public function index()
    {
        $data['testimoni'] = $this->Testimoni_model->get_all();
        $data['title'] = 'Data Testimoni';
        $this->load->view('admin/testimoni/index', $data);
    }

    // Tambah testimoni
    public function create()
    {
        if ($this->input->post()) {
            $data = [
                'nama' => $this->input->post('nama'),
                'role' => $this->input->post('role'),
                'isi'  => $this->input->post('isi'),
                'status' => $this->input->post('status')
            ];

            // Upload foto jika ada
            if (!empty($_FILES['foto']['name'])) {
                $config['upload_path'] = './uploads/testimoni/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 2048;
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto')) {
                    $data['foto'] = $this->upload->data('file_name');
                }
            }

            $this->Testimoni_model->insert($data);
            $this->session->set_flashdata('success', 'Testimoni berhasil ditambahkan.');
            redirect('admin/testimoni');
        }
        $this->load->view('admin/testimoni/create');
    }

    // Edit testimoni
    public function edit($id)
    {
        $data['testimoni'] = $this->Testimoni_model->get($id);
        if ($this->input->post()) {
            $update = [
                'nama' => $this->input->post('nama'),
                'role' => $this->input->post('role'),
                'isi'  => $this->input->post('isi'),
                'status' => $this->input->post('status')
            ];

            // Upload foto jika ada
            if (!empty($_FILES['foto']['name'])) {
                $config['upload_path'] = './uploads/testimoni/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 2048;
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto')) {
                    $update['foto'] = $this->upload->data('file_name');
                }
            }

            $this->Testimoni_model->update($id, $update);
            $this->session->set_flashdata('success', 'Testimoni berhasil diupdate.');
            redirect('admin/testimoni');
        }
        $this->load->view('admin/testimoni/edit', $data);
    }

    // Hapus testimoni
    public function delete($id)
    {
        $this->Testimoni_model->delete($id);
        $this->session->set_flashdata('success', 'Testimoni berhasil dihapus.');
        redirect('admin/testimoni');
    }
}

/* End of file Testimoni.php */
/* Location: ./application/controllers/admin/Testimoni.php */