<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Activity extends CI_Controller
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

    public function index()
    {
        $site     = $this->konfigurasi_model->listing();

        $data = array(
            'title'            => 'Activity Logs',
            'site'           => $site,
            'isi'            => 'admin/logs/activity'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function get_data()
    {
        $csrf_token = $this->input->server('HTTP_X_CSRF_TOKEN');
        $valid_token = $this->security->get_csrf_hash();

        log_message('debug', 'CSRF Token dari request POST: ' . ($csrf_token ?: 'TIDAK ADA'));
        log_message('debug', 'CSRF Token yang valid: ' . $valid_token);
        log_message('debug', 'Session CSRF Token: ' . $this->session->userdata('csrf_token_jkt3'));


        if (empty($csrf_token)) {
            log_message('error', 'CSRF Token kosong, periksa apakah dikirim dari frontend.');
        }

        if ($csrf_token !== $valid_token) {
            echo json_encode(['status' => 'Error', 'message' => 'Invalid CSRF Token']);
            exit();
        }

        $list = $this->M_log_user->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $crud) {
            $no++;
            $row = array();
            $row[] = $crud->id;
            $row[] = $crud->user_id;
            $row[] = $crud->action;
            $row[] = $crud->timestamp;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_log_user->count_all(),
            "recordsFiltered" => $this->M_log_user->count_filtered(),
            "data" => $data,
            "csrf_token" => $this->security->get_csrf_hash() // Kirim token CSRF baru
        );
        echo json_encode($output);
    }

    public function delete_all_activity()
    {
        try {
            $deleted_rows = $this->M_log_user->delete_all_activity();

            $output = array(
                "status" => "success",
                "message" => "Deleted $deleted_rows old log(s)",
                "deleted_rows" => $deleted_rows,
                "csrf_token" => $this->security->get_csrf_hash()
            );
        } catch (Exception $e) {
            $output = array(
                "status" => "error",
                "message" => "Failed to delete activity logs: " . $e->getMessage(),
                "csrf_token" => $this->security->get_csrf_hash()
            );
        }

        header('Content-Type: application/json');
        echo json_encode($output);
    }
}
