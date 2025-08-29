<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Download extends CI_Controller
{

    // Load database
    public function __construct()
    {
        parent::__construct();
        $this->load->model('download_model');
        $this->load->model('kategori_download_model');
        $this->load->model('jenis_download_model');
        $this->log_user->add_log();
        // Tambahkan proteksi halaman
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan = $this->session->set_userdata('pengalihan', $url_pengalihan);
        // Ambil check login dari simple_login
        $this->simple_login->check_login($pengalihan);
    }

    // Halaman download
    public function index()
    {
        $download = $this->download_model->listing();
        $data = array(
            'title' => 'Download All',
            'download' => $download,
            'isi' => 'admin/download/list'
        );
        $this->load->view('admin/layout/wrapper', $data, false);
    }
    
    // View Admin Dashboard List Layanan Publik
    public function listLayananAkademik()
    {
        $download = $this->download_model->listLayananAkademik();
        $data = array(
            'title' => 'Daftar Layanan Akademik',
            'download' => $download,
            'isi' => 'admin/download/listLayananAkademik'
        );
        $this->load->view('admin/layout/wrapper', $data, false);
    }
    
    public function listLayananKemahasiswaan()
    {
        $download = $this->download_model->listLayananKemahasiswaan();
        $data = array(
            'title' => 'Daftar Layanan Kemahasiswaan',
            'download' => $download,
            'isi' => 'admin/download/listLayananKemahasiswaan'
        );
        $this->load->view('admin/layout/wrapper', $data, false);
    }
    
    public function listLayananPelanggan()
    {
        $download = $this->download_model->listLayananPelanggan();
        $data = array(
            'title' => 'Daftar Layanan Pelanggan',
            'download' => $download,
            'isi' => 'admin/download/listLayananPelanggan'
        );
        $this->load->view('admin/layout/wrapper', $data, false);
    }
    
    public function listLayananPerpustakaan()
    {
        $download = $this->download_model->listLayananPerpustakaan();
        $data = array(
            'title' => 'Daftar Layanan Perpustakaan',
            'download' => $download,
            'isi' => 'admin/download/listLayananPerpustakaan'
        );
        $this->load->view('admin/layout/wrapper', $data, false);
    }
    // End View Admin Dashboard List Layanan Publik
    
    // View Admin Dashboard List Informasi Publik
    public function listDokumen()
    {
        $download = $this->download_model->listDokumen();
        $data = array(
            'title' => 'Daftar Dokumen',
            'download' => $download,
            'isi' => 'admin/download/listDokumen'
        );
        $this->load->view('admin/layout/wrapper', $data, false);
    }
    
    public function listAkuntabilitas()
    {
        $download = $this->download_model->listAkuntabilitas();
        $data = array(
            'title' => 'Daftar Akuntabilitas',
            'download' => $download,
            'isi' => 'admin/download/listAkuntabilitas'
        );
        $this->load->view('admin/layout/wrapper', $data, false);
    }
    
    public function listStandardPelayanan()
    {
        $download = $this->download_model->listStandardPelayanan();
        $data = array(
            'title' => 'Daftar Standard Pelayanan',
            'download' => $download,
            'isi' => 'admin/download/listStandardPelayanan'
        );
        $this->load->view('admin/layout/wrapper', $data, false);
    }
    
    public function listPrestasi()
    {
        $download = $this->download_model->listPrestasi();
        $data = array(
            'title' => 'Daftar Prestasi & Penghargaan',
            'download' => $download,
            'isi' => 'admin/download/listPrestasi'
        );
        $this->load->view('admin/layout/wrapper', $data, false);
    }
    // End Admin Dashboard List Informasi Publik
    
    // Admin Dashboard List Organisasi dan Tatalaksana
    public function listPeraturanAsn()
    {
        $download = $this->download_model->listPeraturanAsn();
        $data = array(
            'title' => 'Daftar Peraturan ASN',
            'download' => $download,
            'isi' => 'admin/download/listPeraturanAsn'
        );
        $this->load->view('admin/layout/wrapper', $data, false);
    }
    
    public function listPeraturanDosen()
    {
        $download = $this->download_model->listPeraturanDosen();
        $data = array(
            'title' => 'Daftar Peraturan Dosen',
            'download' => $download,
            'isi' => 'admin/download/listPeraturanDosen'
        );
        $this->load->view('admin/layout/wrapper', $data, false);
    }
    // End Admin Dashboard List Organisasi dan Tatalaksana

    public function get_subkategori_download()
    {
        $id_kategori_download = $this->input->post('id', true);
        $data = $this->download_model->get_subkategori_download($id_kategori_download)->result();
        echo json_encode($data);
    }

    // Proses
    public function proses()
    {
        $site = $this->konfigurasi_model->listing();
        // PROSES HAPUS MULTIPLE
        if (isset($_POST['hapus'])) {
            $inp = $this->input;
            $id_downloadnya = $inp->post('id_download');

            for ($i = 0; $i < sizeof($id_downloadnya); $i++) {
                $download = $this->download_model->detail($id_downloadnya[$i]);
                if ($download->gambar != '') {
                    unlink('./assets/upload/file/' . $download->gambar);
                }
                $data = array('id_download' => $id_downloadnya[$i]);
                $this->download_model->delete($data);
            }

            $this->session->set_flashdata('sukses', 'Data telah dihapus');
            redirect(base_url('admin/download'), 'refresh');
            // PROSES SETTING DRAFT
        }
    }

    // Download file
    public function unduh($id_download)
    {
        $download = $this->download_model->detail($id_download);
        // Contents of photo.jpg will be automatically read
        force_download('./assets/upload/file/' . $download->gambar, null);
    }

    // Tambah download
    public function tambah()
    {
        $kategori_download = $this->kategori_download_model->listing();
        $jenis_download = $this->jenis_download_model->listing();

        // Validasi
        $valid = $this->form_validation;

        $valid->set_rules(
            'judul_download',
            'Judul',
            'required',
            array('required' => 'Judul harus diisi')
        );

        $valid->set_rules(
            'isi',
            'Isi',
            'required',
            array('required' => 'Isi download harus diisi')
        );

        if ($valid->run()) {
            $config['upload_path'] = './assets/upload/file/';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = '200000';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('gambar')) {
                // End validasi

                $data = array(
                    'title' => 'Tambah Download',
                    'kategori_download' => $kategori_download,
                    'jenis_download' => $jenis_download,
                    'error' => $this->upload->display_errors(),
                    'isi' => 'admin/download/tambah'
                );
                $this->load->view('admin/layout/wrapper', $data, false);
                // Masuk database
            } else {
                $upload_data = array('uploads' => $this->upload->data());
                $i = $this->input;
                $slug = url_title($i->post('judul_download'), 'dash', true);

                $data = array(
                    'id_kategori_download' => $i->post('id_kategori_download'),
                    'id_jenis_download' => $i->post('id_jenis_download'),
                    'id_user' => $this->session->userdata('id_user'),
                    'judul_download' => $i->post('judul_download'),
                    'isi' => $i->post('isi'),
                    'gambar' => $upload_data['uploads']['file_name'],
                    'type_dowload' => $i->post('type_dowload'),
                    'slug_download' => $slug,
                    'tanggal_post' => date('Y-m-d H:i:s'),
                );
                $this->download_model->tambah($data);
                $this->session->set_flashdata('sukses', 'Data telah ditambah');
                redirect(base_url('admin/download'), 'refresh');
            }
        }
        // End masuk database
        $data = array(
            'title' => 'Tambah Download',
            'kategori_download' => $kategori_download,
            'jenis_download' => $jenis_download,
            'isi' => 'admin/download/tambah'
        );
        $this->load->view('admin/layout/wrapper', $data, false);
    }

    // Edit download
    public function edit($id_download)
    {
        $kategori_download = $this->kategori_download_model->listing();
        $jenis_download = $this->jenis_download_model->listing();
        $download = $this->download_model->detail($id_download);

        // Validasi
        $valid = $this->form_validation;

        $valid->set_rules(
            'judul_download',
            'Judul',
            'required',
            array('required' => 'Judul harus diisi')
        );

        $valid->set_rules(
            'isi',
            'Isi',
            'required',
            array('required' => 'Isi download harus diisi')
        );

        if ($valid->run()) {

            if (!empty($_FILES['gambar']['name'])) {

                $config['upload_path'] = './assets/upload/file/';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = '200000'; // KB
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('gambar')) {
                    // End validasi

                    $data = array(
                        'title' => 'Edit Download',
                        'kategori_download' => $kategori_download,
                        'jenis_download' => $jenis_download,
                        'download' => $download,
                        'error' => $this->upload->display_errors(),
                        'isi' => 'admin/download/edit'
                    );
                    $this->load->view('admin/layout/wrapper', $data, false);
                    // Masuk database
                } else {
                    $upload_data = array('uploads' => $this->upload->data());
                    $i = $this->input;
                    $slug = url_title($i->post('judul_download'), 'dash', true);

                    $data = array(
                        'id_download' => $id_download,
                        'id_kategori_download' => $i->post('id_kategori_download'),
                        'id_jenis_download' => $i->post('id_jenis_download'),
                        'id_user' => $this->session->userdata('id_user'),
                        'judul_download' => $i->post('judul_download'),
                        'isi' => $i->post('isi'),
                        'gambar' => $upload_data['uploads']['file_name'],
                        'type_dowload' => $i->post('type_dowload'),
                        'slug_download' => $slug,
                        'tanggal_post' => date('Y-m-d H:i:s'),
                    );
                    $this->download_model->edit($data);
                    $this->session->set_flashdata('sukses', 'Data telah diedit');
                    redirect(base_url('admin/download'), 'refresh');
                }
            } else {

                $i = $this->input;
                $slug = url_title($i->post('judul_download'), 'dash', true);

                $data = array(
                    'id_download' => $id_download,
                    'id_kategori_download' => $i->post('id_kategori_download'),
                    'id_jenis_download' => $i->post('id_jenis_download'),
                    'id_user' => $this->session->userdata('id_user'),
                    'judul_download' => $i->post('judul_download'),
                    'isi' => $i->post('isi'),
                    'type_dowload' => $i->post('type_dowload'),
                    'slug_download' => $slug,
                    'tanggal_post' => date('Y-m-d H:i:s'),
                );
                $this->download_model->edit($data);
                $this->session->set_flashdata('sukses', 'Data telah diedit');
                redirect(base_url('admin/download'), 'refresh');
            }
        }
        // End masuk database
        $data = array(
            'title' => 'Edit Download',
            'kategori_download' => $kategori_download,
            'jenis_download' => $jenis_download,
            'download' => $download,
            'isi' => 'admin/download/edit'
        );
        $this->load->view('admin/layout/wrapper', $data, false);
    }

    // Delete
    public function delete($id_download)
    {
        // Tambahkan proteksi halaman
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan = $this->session->set_userdata('pengalihan', $url_pengalihan);
        // Ambil check login dari simple_login
        $this->simple_login->check_login($pengalihan);

        $download = $this->download_model->detail($id_download);
        // Proses hapus gambar
        if ($download->gambar != "") {
            unlink('./assets/upload/file/' . $download->gambar);
        }
        // End hapus gambar
        $data = array('id_download' => $id_download);
        $this->download_model->delete($data);
        $this->session->set_flashdata('sukses', 'Data telah dihapus');
        redirect(base_url('admin/download'), 'refresh');
    }
}

/* End of file Download.php */
/* Location: ./application/controllers/admin/Download.php */
