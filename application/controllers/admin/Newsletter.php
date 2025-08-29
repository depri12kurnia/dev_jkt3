<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Newsletter extends CI_Controller
{

    // Load model
    public function __construct()
    {
        parent::__construct();
        // Tambahkan proteksi halaman
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan     = $this->session->set_userdata('pengalihan', $url_pengalihan);
        // Ambil check login dari simple_login
        $this->simple_login->check_login($pengalihan);
        $this->load->model('newsletter_model');
    }

    // Halaman utama
    public function index()
    {
        // Ambil data newsletter
        $newsletter     = $this->newsletter_model->listing();
        $total          = $this->newsletter_model->total();

        $data = array(
            'title'        => 'Newsletter (' . $total->total . ' data)',
            'newsletter'   => $newsletter,
            'isi'          => 'admin/newsletter/list'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }


    // Proses
    public function proses()
    {
        $id_newsletternya    = $this->input->post('id_newsletter');
        $pengalihan = $this->input->post('pengalihan');

        // Check id_newsletter kosong atau tidak
        if ($id_newsletternya == "") {
            $this->session->set_flashdata('warning', 'Anda belum memilih data');
            redirect($pengalihan, 'refresh');
        }

        // Proses hapus jika klik tombol "hapus", jika ga ada yg kosong
        if (isset($_POST['hapus'])) {
            // Proses hapus diloop
            for ($i = 0; $i < sizeof($id_newsletternya); $i++) {
                $id_newsletter = $id_newsletternya[$i];
                $data = array('id_newsletter'        => $id_newsletter);
                $this->newsletter_model->delete($data);
            }
            // End proses hapus
            $this->session->set_flashdata('sukses', 'Data telah dihapus');
            redirect($pengalihan, 'refresh');
        } elseif (isset($_POST['aktifkan'])) {
            // Proses aktifkan diloop
            for ($i = 0; $i < sizeof($id_newsletternya); $i++) {
                $id_newsletter = $id_newsletternya[$i];
                $data = array(
                    'id_newsletter'        => $id_newsletter,
                    'status_newsletter'    => 'Aktif'
                );
                $this->newsletter_model->edit($data);
            }
            // End proses aktifkan
            $this->session->set_flashdata('sukses', 'Data telah diaktifkan');
            redirect($pengalihan, 'refresh');
        } elseif (isset($_POST['non_aktifkan'])) {
            // Proses non aktifkan diloop
            for ($i = 0; $i < sizeof($id_newsletternya); $i++) {
                $id_newsletter = $id_newsletternya[$i];
                $data = array(
                    'id_newsletter'        => $id_newsletter,
                    'status_newsletter'    => 'Non Aktif'
                );
                $this->newsletter_model->edit($data);
            }
            // End proses non aktifkan
            $this->session->set_flashdata('sukses', 'Data telah di non aktifkan');
            redirect($pengalihan, 'refresh');
        }
    }

    // Delete
    public function delete($id_newsletter)
    {
        $data = array('id_newsletter' => $id_newsletter);
        $this->newsletter_model->delete($data);
        $this->session->set_flashdata('sukses', 'Data telah dihapus');
        redirect(base_url('admin/newsletter'), 'refresh');
    }
}

/* End of file newsletter.php */
/* Location: ./application/controllers/admin/newsletter.php */