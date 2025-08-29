<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_log');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        if (!$this->ion_auth->in_group('admin')) {
            show_error('You do not have permission to access this page.');
        }
    }

    public function index()
    {
        // $data['logs'] = $this->M_log->get_all();
        $data['title'] = 'Logs | Admin Panel';
        $data['content'] = 'paneladmin/logs/log_access';
        $this->load->view('layouts/adminlte3', $data);
    }

    public function getDataAll()
    {
        $this->load->helper('url');

        $list = $this->M_log->get_datatables();
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
            "recordsTotal" => $this->M_log->count_all(),
            "recordsFiltered" => $this->M_log->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
