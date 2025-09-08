<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Import data
    public function insert_import_mahasiswa($data)
    {
        return $this->db->insert('ds_mahasiswa', $data);
    }

    public function insert_import_sdm($data)
    {
        return $this->db->insert('ds_sdm', $data);
    }
}

/* End of file Dashboard_model.php */
/* Location: ./application/models/Dashboard_model.php */