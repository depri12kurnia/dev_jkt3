<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/PHPExcel.php';

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model');
        $this->load->library('session');
    }

    public function import_excel()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['excel_file']['name'])) {
            $file = $_FILES['excel_file']['tmp_name'];
            $objPHPExcel = PHPExcel_IOFactory::load($file);

            $sheet = $objPHPExcel->getActiveSheet();
            $data = [];
            foreach ($sheet->getRowIterator() as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);
                $rowData = [];
                foreach ($cellIterator as $cell) {
                    $rowData[] = $cell->getValue();
                }
                $data[] = $rowData;
            }

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

            $this->session->set_flashdata('success', 'Import berhasil!');
            redirect('admin/dashboard');
        } else {
            $this->load->view('admin/import_dashboard');
        }
    }
}
