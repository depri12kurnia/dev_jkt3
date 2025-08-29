<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends CI_Controller
{

    // Load database
    public function __construct()
    {
        parent::__construct();
        $this->load->model('unit_model');
        $this->load->helper('text'); // Load text helper untuk slug
        $this->log_user->add_log();
        // Tambahkan proteksi halaman
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan = $this->session->set_userdata('pengalihan', $url_pengalihan);
        // Ambil check login dari simple_login
        $this->simple_login->check_login($pengalihan);
    }

    // Halaman utama
    public function index()
    {
        // Validasi
        $valid = $this->form_validation;

        $valid->set_rules(
            'nama',
            'Nama unit',
            'required|max_length[100]',
            array(
                'required' => 'Nama unit harus diisi',
                'max_length' => 'Nama unit maksimal 100 karakter'
            )
        );

        $valid->set_rules(
            'slug',
            'Slug',
            'max_length[100]',
            array(
                'max_length' => 'Slug maksimal 100 karakter'
            )
        );

        $valid->set_rules(
            'deskripsi',
            'Deskripsi',
            'max_length[1000]',
            array(
                'max_length' => 'Deskripsi maksimal 1000 karakter'
            )
        );

        $valid->set_rules(
            'tagline',
            'Tagline',
            'max_length[200]',
            array(
                'max_length' => 'Tagline maksimal 200 karakter'
            )
        );

        if ($valid->run() === false) {
            // End validasi
            $data = array(
                'title' => 'Data Unit',
                'unit' => $this->unit_model->listing(),
                'isi' => 'admin/unit/list'
            );
            $this->load->view('admin/layout/wrapper', $data, false);
        } else {
            $i = $this->input;

            // Handle image upload
            $image_name = '';
            if (!empty($_FILES['image']['name'])) {
                $image_name = $this->_upload_image();
                if (!$image_name) {
                    $this->session->set_flashdata('error', 'Gagal upload gambar');
                    redirect(base_url('admin/unit'), 'refresh');
                }
            }

            // Generate slug if empty
            $slug = $i->post('slug');
            if (empty($slug)) {
                $slug = url_title($i->post('nama'), '-', true);
            }

            // Process features
            $features = array();
            $feature_icons = $i->post('feature_icon');
            $feature_colors = $i->post('feature_color');
            $feature_texts = $i->post('feature_text');

            if (!empty($feature_icons)) {
                for ($index = 0; $index < count($feature_icons); $index++) {
                    if (!empty($feature_texts[$index])) {
                        $features[] = array(
                            'icon' => $feature_icons[$index],
                            'color' => $feature_colors[$index],
                            'text' => $feature_texts[$index]
                        );
                    }
                }
            }

            $data = array(
                'nama' => $i->post('nama'),
                'slug' => $slug,
                'deskripsi' => $i->post('deskripsi'),
                'tagline' => $i->post('tagline'),
                'features' => !empty($features) ? json_encode($features) : null,
                'image' => $image_name
            );

            $result = $this->unit_model->tambah($data);

            if ($result) {
                $this->session->set_flashdata('sukses', 'Data unit telah berhasil ditambahkan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data unit');
            }

            redirect(base_url('admin/unit'), 'refresh');
        }
    }

    // Edit unit
    public function edit($id)
    {
        // Check apakah unit exists
        $unit = $this->unit_model->detail($id);
        if (!$unit) {
            $this->session->set_flashdata('error', 'Data unit tidak ditemukan');
            redirect(base_url('admin/unit'), 'refresh');
        }

        // Validasi
        $valid = $this->form_validation;

        $valid->set_rules(
            'nama',
            'Nama unit',
            'required|max_length[100]',
            array(
                'required' => 'Nama unit harus diisi',
                'max_length' => 'Nama unit maksimal 100 karakter'
            )
        );

        $valid->set_rules(
            'slug',
            'Slug',
            'max_length[100]',
            array(
                'max_length' => 'Slug maksimal 100 karakter'
            )
        );

        $valid->set_rules(
            'deskripsi',
            'Deskripsi',
            'max_length[1000]',
            array(
                'max_length' => 'Deskripsi maksimal 1000 karakter'
            )
        );

        $valid->set_rules(
            'tagline',
            'Tagline',
            'max_length[200]',
            array(
                'max_length' => 'Tagline maksimal 200 karakter'
            )
        );

        if ($valid->run() === false) {
            // Parse existing features for editing
            $existing_features = array();
            if (!empty($unit->features)) {
                $existing_features = json_decode($unit->features, true);
            }

            $data = array(
                'title' => 'Edit Unit',
                'unit' => $unit,
                'existing_features' => $existing_features,
                'isi' => 'admin/unit/edit'
            );
            $this->load->view('admin/layout/wrapper', $data, false);
        } else {
            $i = $this->input;

            // Handle image upload
            $image_name = $unit->image; // Keep existing image
            if (!empty($_FILES['image']['name'])) {
                $new_image = $this->_upload_image();
                if ($new_image) {
                    // Delete old image if exists
                    if (!empty($unit->image) && file_exists('./assets/images/unit/' . $unit->image)) {
                        unlink('./assets/images/unit/' . $unit->image);
                    }
                    $image_name = $new_image;
                }
            }

            // Generate slug if empty
            $slug = $i->post('slug');
            if (empty($slug)) {
                $slug = url_title($i->post('nama'), '-', true);
            }

            // Process features
            $features = array();
            $feature_icons = $i->post('feature_icon');
            $feature_colors = $i->post('feature_color');
            $feature_texts = $i->post('feature_text');

            if (!empty($feature_icons)) {
                for ($index = 0; $index < count($feature_icons); $index++) {
                    if (!empty($feature_texts[$index])) {
                        $features[] = array(
                            'icon' => $feature_icons[$index],
                            'color' => $feature_colors[$index],
                            'text' => $feature_texts[$index]
                        );
                    }
                }
            }

            $data = array(
                'id' => $id,
                'nama' => $i->post('nama'),
                'slug' => $slug,
                'deskripsi' => $i->post('deskripsi'),
                'tagline' => $i->post('tagline'),
                'features' => !empty($features) ? json_encode($features) : null,
                'image' => $image_name
            );

            $result = $this->unit_model->edit($data);

            if ($result) {
                $this->session->set_flashdata('sukses', 'Data unit telah berhasil diperbarui');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui data unit');
            }

            redirect(base_url('admin/unit'), 'refresh');
        }
    }

    // Delete unit
    public function delete($id)
    {
        // Proteksi proses delete harus login
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan = $this->session->set_userdata('pengalihan', $url_pengalihan);
        $this->simple_login->check_login($pengalihan);

        // Check apakah unit exists
        $unit = $this->unit_model->detail($id);
        if (!$unit) {
            $this->session->set_flashdata('error', 'Data unit tidak ditemukan');
            redirect(base_url('admin/unit'), 'refresh');
        }

        // Delete image file if exists
        if (!empty($unit->image) && file_exists('./assets/images/unit/' . $unit->image)) {
            unlink('./assets/images/unit/' . $unit->image);
        }

        $data = array('id' => $id);
        $result = $this->unit_model->delete($data);

        if ($result) {
            $this->session->set_flashdata('sukses', 'Data unit telah berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data unit');
        }

        redirect(base_url('admin/unit'), 'refresh');
    }

    // Detail unit
    public function detail($id)
    {
        $unit = $this->unit_model->detail($id);

        if (!$unit) {
            $this->session->set_flashdata('error', 'Data unit tidak ditemukan');
            redirect(base_url('admin/unit'), 'refresh');
        }

        // Parse features for display
        $features = array();
        if (!empty($unit->features)) {
            $features = json_decode($unit->features, true);
        }

        $data = array(
            'title' => 'Detail Unit: ' . $unit->nama,
            'unit' => $unit,
            'features' => $features,
            'isi' => 'admin/unit/detail'
        );
        $this->load->view('admin/layout/wrapper', $data, false);
    }

    // Search unit
    public function search()
    {
        $keyword = $this->input->get('q');

        if (empty($keyword)) {
            redirect(base_url('admin/unit'), 'refresh');
        }

        $unit = $this->unit_model->search($keyword);

        // Process highlighting
        foreach ($unit as $row) {
            $row->nama = $this->highlight_search($row->nama, $keyword);
            $row->slug = $this->highlight_search($row->slug, $keyword);
            if (!empty($row->deskripsi)) {
                $row->deskripsi = $this->highlight_search(character_limiter(strip_tags($row->deskripsi), 100), $keyword);
            }
            if (!empty($row->tagline)) {
                $row->tagline = $this->highlight_search($row->tagline, $keyword);
            }
        }

        $data = array(
            'title' => 'Hasil Pencarian: ' . $keyword,
            'keyword' => $keyword,
            'unit' => $unit,
            'isi' => 'admin/unit/search'
        );
        $this->load->view('admin/layout/wrapper', $data, false);
    }

    // Export data unit ke CSV
    public function export()
    {
        $this->load->helper('download');
        $this->load->helper('file');

        $unit = $this->unit_model->listing();

        // Buat header CSV
        $csv_content = "ID,Nama Unit,Slug,Deskripsi,Tagline,Features,Image,Tanggal Dibuat\n";

        // Tambahkan data
        foreach ($unit as $row) {
            $csv_content .= '"' . $row->id . '",';
            $csv_content .= '"' . str_replace('"', '""', $row->nama) . '",';
            $csv_content .= '"' . $row->slug . '",';
            $csv_content .= '"' . str_replace('"', '""', $row->deskripsi) . '",';
            $csv_content .= '"' . str_replace('"', '""', $row->tagline) . '",';
            $csv_content .= '"' . str_replace('"', '""', $row->features) . '",';
            $csv_content .= '"' . $row->image . '",';
            $csv_content .= '"' . $row->created_at . '"' . "\n";
        }

        $filename = 'data_unit_' . date('Y-m-d_H-i-s') . '.csv';
        force_download($filename, $csv_content);
    }

    // Import data unit dari CSV
    public function import()
    {
        if ($this->input->post('submit')) {
            // Konfigurasi upload
            $config['upload_path'] = './uploads/temp/';
            $config['allowed_types'] = 'csv';
            $config['max_size'] = 2048; // 2MB
            $config['file_name'] = 'import_unit_' . time();

            // Buat folder jika belum ada
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0755, true);
            }

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('csv_file')) {
                $file_data = $this->upload->data();
                $file_path = $file_data['full_path'];

                // Baca file CSV
                $csv_data = array();
                if (($handle = fopen($file_path, 'r')) !== FALSE) {
                    $header = fgetcsv($handle); // Skip header
                    while (($data = fgetcsv($handle)) !== FALSE) {
                        if (!empty($data[0])) { // Pastikan nama tidak kosong
                            $csv_data[] = array(
                                'nama' => $data[0],
                                'slug' => isset($data[1]) ? $data[1] : url_title($data[0], '-', true),
                                'deskripsi' => isset($data[2]) ? $data[2] : '',
                                'tagline' => isset($data[3]) ? $data[3] : ''
                            );
                        }
                    }
                    fclose($handle);
                }

                // Import ke database
                if (!empty($csv_data)) {
                    $result = $this->unit_model->import_batch($csv_data);

                    $this->session->set_flashdata(
                        'sukses',
                        'Import berhasil! ' . $result['success'] . ' dari ' . $result['total'] . ' data berhasil diimport'
                    );

                    if (!empty($result['errors'])) {
                        $this->session->set_flashdata(
                            'error',
                            'Beberapa data gagal diimport: ' . implode(', ', array_slice($result['errors'], 0, 5))
                        );
                    }
                } else {
                    $this->session->set_flashdata('error', 'File CSV kosong atau format tidak valid');
                }

                // Hapus file temporary
                unlink($file_path);
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
            }

            redirect(base_url('admin/unit'), 'refresh');
        }

        // Tampilkan form import
        $data = array(
            'title' => 'Import Data Unit',
            'isi' => 'admin/unit/import'
        );
        $this->load->view('admin/layout/wrapper', $data, false);
    }

    // Generate slug manual (AJAX)
    public function generate_slug()
    {
        if ($this->input->is_ajax_request()) {
            $nama = $this->input->post('nama');
            $id = $this->input->post('id'); // Untuk edit

            if (!empty($nama)) {
                $slug = $this->unit_model->generate_slug($nama, $id);
                echo json_encode(array('status' => 'success', 'slug' => $slug));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Nama tidak boleh kosong'));
            }
        } else {
            show_404();
        }
    }

    // Check slug availability (AJAX)
    public function check_slug()
    {
        if ($this->input->is_ajax_request()) {
            $slug = $this->input->post('slug');
            $id = $this->input->post('id'); // Untuk edit

            if (!empty($slug)) {
                $exists = $this->unit_model->check_slug($slug, $id);
                echo json_encode(array('exists' => $exists));
            } else {
                echo json_encode(array('exists' => false));
            }
        } else {
            show_404();
        }
    }

    // Get features data (AJAX)
    public function get_features($id)
    {
        if ($this->input->is_ajax_request()) {
            $unit = $this->unit_model->detail($id);
            $features = array();

            if ($unit && !empty($unit->features)) {
                $features = json_decode($unit->features, true);
            }

            echo json_encode($features);
        } else {
            show_404();
        }
    }

    // Upload image method
    private function _upload_image()
    {
        $config['upload_path'] = './assets/images/unit/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
        $config['max_size'] = 2048; // 2MB
        $config['max_width'] = 2000;
        $config['max_height'] = 2000;
        $config['encrypt_name'] = TRUE;

        // Buat folder jika belum ada
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, true);
        }

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $upload_data = $this->upload->data();
            return $upload_data['file_name'];
        } else {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            return false;
        }
    }

    // Delete image
    public function delete_image($id)
    {
        if ($this->input->is_ajax_request()) {
            $unit = $this->unit_model->detail($id);

            if ($unit && !empty($unit->image)) {
                // Delete file
                if (file_exists('./assets/images/unit/' . $unit->image)) {
                    unlink('./assets/images/unit/' . $unit->image);
                }

                // Update database
                $result = $this->unit_model->edit(array('id' => $id, 'image' => ''));

                echo json_encode(array('status' => $result ? 'success' : 'error'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Image not found'));
            }
        } else {
            show_404();
        }
    }

    // Preview unit (untuk melihat tampilan frontend)
    public function preview($id)
    {
        $unit = $this->unit_model->detail($id);

        if (!$unit) {
            $this->session->set_flashdata('error', 'Data unit tidak ditemukan');
            redirect(base_url('admin/unit'), 'refresh');
        }

        $data = array(
            'title' => 'Preview Unit: ' . $unit->nama,
            'unit_data' => $unit,
            'is_preview' => true
        );

        $this->load->view('unit/detail', $data, false);
    }

    // Get unit by slug (untuk public access)
    public function view($slug)
    {
        $unit = $this->unit_model->get_by_slug($slug);

        if (!$unit) {
            show_404();
        }

        // Parse features for display
        $features = array();
        if (!empty($unit->features)) {
            $features = json_decode($unit->features, true);
        }

        $data = array(
            'title' => $unit->nama,
            'unit' => $unit,
            'features' => $features
        );

        $this->load->view('unit/detail', $data, false);
    }

    // Bulk actions
    public function bulk_action()
    {
        if ($this->input->post('bulk_action') && $this->input->post('selected_ids')) {
            $action = $this->input->post('bulk_action');
            $ids = $this->input->post('selected_ids');

            $success_count = 0;
            $error_count = 0;

            foreach ($ids as $id) {
                switch ($action) {
                    case 'delete':
                        if ($this->unit_model->delete(array('id' => $id))) {
                            $success_count++;
                        } else {
                            $error_count++;
                        }
                        break;
                }
            }

            if ($success_count > 0) {
                $this->session->set_flashdata('sukses', $success_count . ' data berhasil diproses');
            }

            if ($error_count > 0) {
                $this->session->set_flashdata('error', $error_count . ' data gagal diproses');
            }
        }

        redirect(base_url('admin/unit'), 'refresh');
    }

    // API endpoint to get all units as JSON
    public function api()
    {
        $units = $this->unit_model->listing();
        header('Content-Type: application/json');
        echo json_encode($units);
    }

    // API endpoint to get unit by ID as JSON
    public function api_detail($id)
    {
        $unit = $this->unit_model->detail($id);

        if (!$unit) {
            header('HTTP/1.0 404 Not Found');
            echo json_encode(array('error' => 'Unit tidak ditemukan'));
        } else {
            header('Content-Type: application/json');
            echo json_encode($unit);
        }
    }

    // Private method untuk highlighting search
    private function highlight_search($text, $keyword)
    {
        if (empty($keyword)) return $text;

        $highlighted = preg_replace(
            '/(' . preg_quote($keyword, '/') . ')/i',
            '<mark>$1</mark>',
            $text
        );

        return $highlighted;
    }
}

/* End of file Unit.php */
/* Location: ./application/controllers/admin/Unit.php */