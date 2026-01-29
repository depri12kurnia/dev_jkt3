<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Log extends CI_Controller
{

    // Load database
    public function __construct()
    {
        parent::__construct();
        $this->load->model('log_model');
        $this->log_user->add_log();
        // Tambahkan proteksi halaman
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan     = $this->session->set_userdata('pengalihan', $url_pengalihan);
        // Ambil check login dari simple_login
        $this->simple_login->check_login($pengalihan);
    }

    // Halaman prodi
    public function index()
    {
        $site     = $this->konfigurasi_model->listing();

        $data = array(
            'title'          => 'Logs',
            'site'           => $site,
            'isi'            => 'admin/logs/list'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function getDataAll()
    {
        $this->load->helper('url');

        $list = $this->log_model->get_datatables();
        $data = array();
        $i = 1;
        $no = $_POST['start'];
        foreach ($list as $val) {
            $no++;
            $row = array();
            $row[] = $val->id;
            $row[] = $val->timestamp;
            $row[] = $val->ip_address;
            $row[] = $val->user_agent;
            $row[] = $val->uri;
            $row[] = $val->method;
            $row[] = $val->message;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->log_model->count_all(),
            "recordsFiltered" => $this->log_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function delete_all_logs()
    {
        try {
            $deleted_rows = $this->log_model->delete_all_logs();

            if ($deleted_rows !== false) {
                echo json_encode([
                    'status' => 'success',
                    'message' => "Deleted $deleted_rows old log(s) successfully",
                    'csrf_token' => $this->security->get_csrf_hash()
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to delete logs'
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage()
            ]);
        }
    }
}

/* End of file prodi.php */
/* Location: ./application/controllers/admin/log.php */