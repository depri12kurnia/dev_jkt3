<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backups extends CI_Controller
{
    // load data
    public function __construct()
    {
        parent::__construct();
        $this->log_user->add_log();
        // Tambahkan proteksi halaman
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan = $this->session->set_userdata('pengalihan', $url_pengalihan);
        // Ambil check login dari simple_login
        $this->simple_login->check_login($pengalihan);
    }
    
    public function index()
    {
        $site 	= $this->konfigurasi_model->listing();
        $data = array(
			'title'					=> 'Backup Data and Database',
			'site'	                => $site,
			'isi'					=> 'admin/backup/v_backup'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
// $this->load->view('backup/v_backup');
    }

    public function backup_db()
    {
        date_default_timezone_set("Asia/Jakarta"); // set waktu sesuai lokasi

        $this->load->dbutil();
        $pref = [
            'format' => 'zip',
            'filename' => 'database_all.sql'
        ];

        $backup     = $this->dbutil->backup($pref);
        $db_name    = 'backup_database_jakarta3_' . date("d-m-Y__H-i-s") . '.zip'; // nama backup dalam bentuk zip
        $save       = '.assets/backups/' . $db_name; //folder tempat database disimpan

        $this->load->helper('file'); // load helper file
        write_file($save, $backup);

        $this->load->helper("download"); // load helper download
        force_download($db_name, $backup);
    }

    public function backup_files()
    {
        $this->load->library('zip');

        $path = FCPATH . '/assets/upload';

        $this->zip->read_dir($path, FALSE);

        // Download the file to your desktop. Name it "my_backup.zip"
        $this->zip->download('my_backup_files_assets_upload_jakarta3.zip');
    }
    
}
