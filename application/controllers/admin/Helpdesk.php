<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Helpdesk extends CI_Controller
{

    // Load database
    public function __construct()
    {
        parent::__construct();
        $this->load->model('helpdesk_model');
        $this->load->model('kategori_helpdesk_model');
        $this->log_user->add_log();
        // Tambahkan proteksi halaman
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan     = $this->session->set_userdata('pengalihan', $url_pengalihan);
        // Ambil check login dari simple_login
        $this->simple_login->check_login($pengalihan);
    }

    // Index
    public function index()
    {
        $helpdesk    = $this->helpdesk_model->listing();

        $data = array(
            'title'    => 'Faq & Helpdesk',
            'helpdesk'    => $helpdesk,
            'isi'    => 'admin/helpdesk/list'
        );
        $this->load->view('admin/layout/wrapper', $data);
    }

    public function get_subkategori_helpdesk()
    {
        $id_kategori_helpdesk = $this->input->post('id', true);
        $data = $this->helpdesk_model->get_subkategori_helpdesk($id_kategori_helpdesk)->result();
        echo json_encode($data);
    }

    // Proses
    public function proses()
    {
        $site = $this->konfigurasi_model->listing();
        // PROSES HAPUS MULTIPLE
        if (isset($_POST['hapus'])) {
            $inp                 = $this->input;
            $id_helpdesknya        = $inp->post('id_helpdesk');

            for ($i = 0; $i < sizeof($id_helpdesknya); $i++) {
                $helpdesk     = $this->helpdesk_model->detail($id_helpdesknya[$i]);
                if ($helpdesk->gambar != '') {
                    unlink('./assets/upload/file/' . $helpdesk->gambar);
                }
                $data = array('id_helpdesk'    => $id_helpdesknya[$i]);
                $this->helpdesk_model->delete($data);
            }

            $this->session->set_flashdata('sukses', 'Data telah dihapus');
            redirect(base_url('admin/helpdesk'), 'refresh');
            // PROSES SETTING DRAFT
        }
    }

    // Tambah
    public function tambah()
    {
        $kategori_helpdesk = $this->kategori_helpdesk_model->listing();
        // Validasi
        $v = $this->form_validation;
        $v->set_rules('pertanyaan', 'Pertanyaan', 'required');
        $v->set_rules('jawaban', 'Jawaban', 'required');
        $v->set_rules('id_kategori_helpdesk', 'Kategori Helpdesk', 'required');

        if ($v->run() === FALSE) {
            $data = array(
                'title'         => 'Tambah Faq & Helpdesk',
                'kategori_helpdesk' => $kategori_helpdesk,
                'isi'           => 'admin/helpdesk/tambah'
            );
            $this->load->view('admin/layout/wrapper', $data);
            // Masuk database
        } else {

            $i = $this->input;
            $data = array(
                'id_user'               => $this->session->userdata('id_user'),
                'id_kategori_helpdesk'  => $i->post('id_kategori_helpdesk'),
                'pertanyaan'            => $i->post('pertanyaan'),
                'jawaban'               => $i->post('jawaban'),
                'urutan'                => $i->post('urutan')
            );
            $this->helpdesk_model->tambah($data);
            $this->session->set_flashdata('sukses', 'Data added successfully');
            redirect(base_url('admin/helpdesk'));
        }
    }

    // Edit
    public function edit($id_helpdesk)
    {
        // Dari database
        $kategori_helpdesk = $this->kategori_helpdesk_model->listing();
        $helpdesk        = $this->helpdesk_model->detail($id_helpdesk);
        // Validasi
        $v = $this->form_validation;
        $v->set_rules('pertanyaan', 'Pertanyaan', 'required');
        $v->set_rules('jawaban', 'Jawaban', 'required');
        $v->set_rules('id_kategori_helpdesk', 'Kategori Helpdesk', 'required');

        if ($v->run() === FALSE) {
            $data = array(
                'title'             => 'Edit Faq & Helpdesk',
                'kategori_helpdesk' => $kategori_helpdesk,
                'helpdesk'          => $helpdesk,
                'isi'               => 'admin/helpdesk/edit'
            );
            $this->load->view('admin/layout/wrapper', $data);
            // Masuk database
        } else {
            $i = $this->input;
            $data = array(
                'id_helpdesk'               => $helpdesk->id_helpdesk,
                'id_kategori_helpdesk'      => $i->post('id_kategori_helpdesk'),
                'id_user'                   => $this->session->userdata('id_user'),
                'pertanyaan'                => $i->post('pertanyaan'),
                'jawaban'                   => $i->post('jawaban'),
                'urutan'                    => $i->post('urutan')
            );
            $this->helpdesk_model->edit($data);
            $this->session->set_flashdata('sukses', 'Data updated successfully');
            redirect(base_url('admin/helpdesk'));
        }
    }

    // Delete
    public function delete($id_helpdesk)
    {
        // Tambahkan proteksi halaman
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan     = $this->session->set_userdata('pengalihan', $url_pengalihan);
        // Ambil check login dari simple_login
        $this->simple_login->check_login($pengalihan);

        $data        = array('id_helpdesk'    => $id_helpdesk);
        $this->helpdesk_model->delete($data);
        $this->session->set_flashdata('sukses', 'Data deleted successfully');
        redirect(base_url('admin/helpdesk'));
    }
}
