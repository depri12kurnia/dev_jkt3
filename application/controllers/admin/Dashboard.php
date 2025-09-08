<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan     = $this->session->set_userdata('pengalihan', $url_pengalihan);
        $this->simple_login->check_login($pengalihan);
        $this->load->model('Dashboard_model');
        $this->load->library('session');
    }

    public function index()
    {
        $data = array(
            'title'                  => 'Halaman Dashboard Mahasiswa & Dosen',
            'isi'                    => 'admin/dashboard/list'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function import_mahasiswa()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['excel_file']['name'])) {
            require_once APPPATH . 'third_party/vendor/autoload.php'; // pastikan path autoload benar

            use PhpOffice\PhpSpreadsheet\IOFactory;

            $file = $_FILES['excel_file']['tmp_name'];
            $spreadsheet = IOFactory::load($file);
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();

            // Mulai dari baris ke-1 (skip header)
            for ($i = 1; $i < count($data); $i++) {
                $row = $data[$i];
                // Pastikan urutan kolom: periode, prodi, Aktif, Total, L, P
                $insert = [
                    'periode' => $row[0],
                    'prodi'   => $row[1],
                    'aktif'   => $row[2],
                    'total'   => $row[3],
                    'l'       => $row[4],
                    'p'       => $row[5]
                ];
                $this->Dashboard_model->insert_import_data($insert);
            }

            $this->session->set_flashdata('success', 'Import mahasiswa berhasil!');
            redirect('admin/dashboard');
        } else {
            $this->load->view('admin/import_dashboard');
        }
    }
}
