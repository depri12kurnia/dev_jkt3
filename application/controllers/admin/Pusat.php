<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pusat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pusat_model');
        $this->load->helper('text');
        $this->log_user->add_log();
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan = $this->session->set_userdata('pengalihan', $url_pengalihan);
        $this->simple_login->check_login($pengalihan);
    }

    // Halaman utama
    public function index()
    {
        $valid = $this->form_validation;

        $valid->set_rules('nama', 'Nama pusat', 'required|max_length[100]', [
            'required' => 'Nama pusat harus diisi',
            'max_length' => 'Nama pusat maksimal 100 karakter'
        ]);
        $valid->set_rules('slug', 'Slug', 'max_length[100]', [
            'max_length' => 'Slug maksimal 100 karakter'
        ]);
        $valid->set_rules('deskripsi', 'Deskripsi', 'max_length[1000]', [
            'max_length' => 'Deskripsi maksimal 1000 karakter'
        ]);
        $valid->set_rules('tagline', 'Tagline', 'max_length[200]', [
            'max_length' => 'Tagline maksimal 200 karakter'
        ]);

        if ($valid->run() === false) {
            $data = [
                'title' => 'Data Pusat',
                'pusat' => $this->pusat_model->listing(),
                'isi' => 'admin/pusat/list'
            ];
            $this->load->view('admin/layout/wrapper', $data, false);
        } else {
            $i = $this->input;
            $image_name = '';
            if (!empty($_FILES['image']['name'])) {
                $image_name = $this->_upload_image();
                if (!$image_name) {
                    $this->session->set_flashdata('error', 'Gagal upload gambar');
                    redirect(base_url('admin/pusat'), 'refresh');
                }
            }
            $slug = $i->post('slug');
            if (empty($slug)) {
                $slug = url_title($i->post('nama'), '-', true);
            }
            $features = array();
            $feature_icons = $i->post('feature_icon');
            $feature_colors = $i->post('feature_color');
            $feature_texts = $i->post('feature_text');
            if (!empty($feature_icons)) {
                for ($index = 0; $index < count($feature_icons); $index++) {
                    if (!empty($feature_texts[$index])) {
                        $features[] = [
                            'icon' => $feature_icons[$index],
                            'color' => $feature_colors[$index],
                            'text' => $feature_texts[$index]
                        ];
                    }
                }
            }
            $data = [
                'nama' => $i->post('nama'),
                'slug' => $slug,
                'deskripsi' => $i->post('deskripsi'),
                'tagline' => $i->post('tagline'),
                'features' => !empty($features) ? json_encode($features) : null,
                'image' => $image_name
            ];
            $result = $this->pusat_model->tambah($data);
            if ($result) {
                $this->session->set_flashdata('sukses', 'Data pusat telah berhasil ditambahkan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data pusat');
            }
            redirect(base_url('admin/pusat'), 'refresh');
        }
    }

    // Edit pusat
    public function edit($id)
    {
        $pusat = $this->pusat_model->detail($id);
        if (!$pusat) {
            $this->session->set_flashdata('error', 'Data pusat tidak ditemukan');
            redirect(base_url('admin/pusat'), 'refresh');
        }
        $valid = $this->form_validation;
        $valid->set_rules('nama', 'Nama pusat', 'required|max_length[100]', [
            'required' => 'Nama pusat harus diisi',
            'max_length' => 'Nama pusat maksimal 100 karakter'
        ]);
        $valid->set_rules('slug', 'Slug', 'max_length[100]', [
            'max_length' => 'Slug maksimal 100 karakter'
        ]);
        $valid->set_rules('deskripsi', 'Deskripsi', 'max_length[1000]', [
            'max_length' => 'Deskripsi maksimal 1000 karakter'
        ]);
        $valid->set_rules('tagline', 'Tagline', 'max_length[200]', [
            'max_length' => 'Tagline maksimal 200 karakter'
        ]);
        if ($valid->run() === false) {
            $existing_features = [];
            if (!empty($pusat->features)) {
                $existing_features = json_decode($pusat->features, true);
            }
            $data = [
                'title' => 'Edit Pusat',
                'pusat' => $pusat,
                'existing_features' => $existing_features,
                'isi' => 'admin/pusat/edit'
            ];
            $this->load->view('admin/layout/wrapper', $data, false);
        } else {
            $i = $this->input;
            $image_name = $pusat->image;
            if (!empty($_FILES['image']['name'])) {
                $new_image = $this->_upload_image();
                if ($new_image) {
                    if (!empty($pusat->image) && file_exists('./assets/images/pusat/' . $pusat->image)) {
                        unlink('./assets/images/pusat/' . $pusat->image);
                    }
                    $image_name = $new_image;
                }
            }
            $slug = $i->post('slug');
            if (empty($slug)) {
                $slug = url_title($i->post('nama'), '-', true);
            }
            $features = array();
            $feature_icons = $i->post('feature_icon');
            $feature_colors = $i->post('feature_color');
            $feature_texts = $i->post('feature_text');
            if (!empty($feature_icons)) {
                for ($index = 0; $index < count($feature_icons); $index++) {
                    if (!empty($feature_texts[$index])) {
                        $features[] = [
                            'icon' => $feature_icons[$index],
                            'color' => $feature_colors[$index],
                            'text' => $feature_texts[$index]
                        ];
                    }
                }
            }
            $data = [
                'id' => $id,
                'nama' => $i->post('nama'),
                'slug' => $slug,
                'deskripsi' => $i->post('deskripsi'),
                'tagline' => $i->post('tagline'),
                'features' => !empty($features) ? json_encode($features) : null,
                'image' => $image_name
            ];
            $result = $this->pusat_model->edit($data);
            if ($result) {
                $this->session->set_flashdata('sukses', 'Data pusat telah berhasil diperbarui');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui data pusat');
            }
            redirect(base_url('admin/pusat'), 'refresh');
        }
    }

    // Delete pusat
    public function delete($id)
    {
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan = $this->session->set_userdata('pengalihan', $url_pengalihan);
        $this->simple_login->check_login($pengalihan);

        $pusat = $this->pusat_model->detail($id);
        if (!$pusat) {
            $this->session->set_flashdata('error', 'Data pusat tidak ditemukan');
            redirect(base_url('admin/pusat'), 'refresh');
        }
        if (!empty($pusat->image) && file_exists('./assets/images/pusat/' . $pusat->image)) {
            unlink('./assets/images/pusat/' . $pusat->image);
        }
        $data = ['id' => $id];
        $result = $this->pusat_model->delete($data);
        if ($result) {
            $this->session->set_flashdata('sukses', 'Data pusat telah berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data pusat');
        }
        redirect(base_url('admin/pusat'), 'refresh');
    }

    // Detail pusat
    public function detail($id)
    {
        $pusat = $this->pusat_model->detail($id);
        if (!$pusat) {
            $this->session->set_flashdata('error', 'Data pusat tidak ditemukan');
            redirect(base_url('admin/pusat'), 'refresh');
        }
        $features = [];
        if (!empty($pusat->features)) {
            $features = json_decode($pusat->features, true);
        }
        $data = [
            'title' => 'Detail Pusat: ' . $pusat->nama,
            'pusat' => $pusat,
            'features' => $features,
            'isi' => 'admin/pusat/detail'
        ];
        $this->load->view('admin/layout/wrapper', $data, false);
    }

    // Search pusat
    public function search()
    {
        $keyword = $this->input->get('q');
        if (empty($keyword)) {
            redirect(base_url('admin/pusat'), 'refresh');
        }
        $pusat = $this->pusat_model->search($keyword);
        foreach ($pusat as $row) {
            $row->nama = $this->highlight_search($row->nama, $keyword);
            $row->slug = $this->highlight_search($row->slug, $keyword);
            if (!empty($row->deskripsi)) {
                $row->deskripsi = $this->highlight_search(character_limiter(strip_tags($row->deskripsi), 100), $keyword);
            }
            if (!empty($row->tagline)) {
                $row->tagline = $this->highlight_search($row->tagline, $keyword);
            }
        }
        $data = [
            'title' => 'Hasil Pencarian: ' . $keyword,
            'keyword' => $keyword,
            'pusat' => $pusat,
            'isi' => 'admin/pusat/search'
        ];
        $this->load->view('admin/layout/wrapper', $data, false);
    }

    // Upload image method
    private function _upload_image()
    {
        $config['upload_path'] = './assets/images/pusat/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
        $config['max_size'] = 2048;
        $config['max_width'] = 2000;
        $config['max_height'] = 2000;
        $config['encrypt_name'] = TRUE;
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
            $pusat = $this->pusat_model->detail($id);
            if ($pusat && !empty($pusat->image)) {
                if (file_exists('./assets/images/pusat/' . $pusat->image)) {
                    unlink('./assets/images/pusat/' . $pusat->image);
                }
                $result = $this->pusat_model->edit(['id' => $id, 'image' => '']);
                echo json_encode(['status' => $result ? 'success' : 'error']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Image not found']);
            }
        } else {
            show_404();
        }
    }

    // API endpoint to get all pusat as JSON
    public function api()
    {
        $pusat = $this->pusat_model->listing();
        header('Content-Type: application/json');
        echo json_encode($pusat);
    }

    // API endpoint to get pusat by ID as JSON
    public function api_detail($id)
    {
        $pusat = $this->pusat_model->detail($id);
        if (!$pusat) {
            header('HTTP/1.0 404 Not Found');
            echo json_encode(['error' => 'Pusat tidak ditemukan']);
        } else {
            header('Content-Type: application/json');
            echo json_encode($pusat);
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