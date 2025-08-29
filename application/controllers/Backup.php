<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->dbutil(); // Load Database Utility Class
    }

    public function database_backup() {
        // Batasi akses hanya melalui CLI untuk keamanan
        if (!$this->input->is_cli_request()) {
            show_error('Access denied', 403);
        }

        // Konfigurasi backup
        $prefs = array(
            'format' => 'gzip', // Format file backup (gzip, zip, txt)
            'filename' => 'my_database_backup_' . date('Y-m-d_H-i-s') . '.sql', // Nama file SQL di dalam zip
        );

        // Generate backup
        $backup = $this->dbutil->backup($prefs);

        // Set nama file backup
        $backup_filename = 'backup-on-' . date('Y-m-d_H-i-s') . '.zip';
        $save_path = './secure_backup/' . $backup_filename; // Lokasi penyimpanan backup yang aman

        // Simpan file backup
        $this->load->helper('file');
        if (write_file($save_path, $backup)) {
            echo "Backup database berhasil disimpan di: $save_path\n";
        } else {
            echo "Gagal menyimpan backup database.\n";
        }
    }
}
