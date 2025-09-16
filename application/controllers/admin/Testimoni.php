<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testimoni extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Testimoni_model');
        $this->load->model('Konfigurasi_model');
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->log_user->add_log();
        // Tambahkan proteksi halaman
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan = $this->session->set_userdata('pengalihan', $url_pengalihan);
        // Ambil check login dari simple_login
        $this->simple_login->check_login($pengalihan);
    }

    // List semua testimoni dengan pagination dan filter
    public function index()
    {
        // Setup pagination
        $config['base_url'] = base_url('admin/testimoni/index');
        $config['per_page'] = 10;
        $page = ($this->input->get('page')) ? $this->input->get('page') : 0;

        // Get filters
        $filters = array();
        if ($this->input->get('status')) {
            $filters['status'] = $this->input->get('status');
        }
        if ($this->input->get('role')) {
            $filters['role'] = $this->input->get('role');
        }
        if ($this->input->get('search')) {
            $filters['search'] = $this->input->get('search');
        }

        // Get data
        $config['total_rows'] = $this->Testimoni_model->count_all($filters);
        $this->pagination->initialize($config);

        $testimoni = $this->Testimoni_model->get_all_paginated($config['per_page'], $page, $filters);
        $statistics = $this->Testimoni_model->get_statistics();
        $site = $this->Konfigurasi_model->listing();

        $data = array(
            'title'           => 'Testimoni (' . $config['total_rows'] . ')',
            'testimoni'       => $testimoni,
            'statistics'      => $statistics,
            'role_options'    => $this->Testimoni_model->get_role_options(),
            'status_options'  => $this->Testimoni_model->get_status_options(),
            'pagination'      => $this->pagination->create_links(),
            'filters'         => $filters,
            'site'            => $site,
            'csrf_token_name' => $this->security->get_csrf_token_name(),
            'csrf_hash'       => $this->security->get_csrf_hash(),
            'isi'             => 'admin/testimoni/list'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // Tambah testimoni (AJAX)
    public function create()
    {
        if ($this->input->post()) {
            $data = [
                'nama' => $this->input->post('nama'),
                'asal_prodi' => $this->input->post('asal_prodi'),
                'jabatan' => $this->input->post('jabatan'),
                'role' => $this->input->post('role'),
                'isi'  => $this->input->post('isi'),
                'status' => $this->input->post('status')
            ];

            // Upload foto jika ada
            if (!empty($_FILES['foto']['name'])) {
                $config['upload_path'] = './assets/images/testimoni/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048;
                $config['encrypt_name'] = TRUE;

                // Create directory if not exists
                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0755, TRUE);
                }

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto')) {
                    $data['foto'] = $this->upload->data('file_name');
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Upload foto gagal: ' . $this->upload->display_errors(),
                        'csrf_token_name' => $this->security->get_csrf_token_name(),
                        'csrf_hash' => $this->security->get_csrf_hash()
                    ];
                    echo json_encode($response);
                    return;
                }
            }

            if ($this->Testimoni_model->insert($data)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Testimoni berhasil ditambahkan.',
                    'csrf_token_name' => $this->security->get_csrf_token_name(),
                    'csrf_hash' => $this->security->get_csrf_hash()
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Testimoni gagal ditambahkan. Pastikan semua field wajib terisi.',
                    'csrf_token_name' => $this->security->get_csrf_token_name(),
                    'csrf_hash' => $this->security->get_csrf_hash()
                ];
            }
            echo json_encode($response);
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Invalid request',
                'csrf_token_name' => $this->security->get_csrf_token_name(),
                'csrf_hash' => $this->security->get_csrf_hash()
            ];
            echo json_encode($response);
        }
    }

    // Get testimoni by ID for edit (AJAX)
    public function get_by_id($id)
    {
        if (!$this->Testimoni_model->exists($id)) {
            $response = [
                'status' => 'error',
                'message' => 'Testimoni tidak ditemukan.',
                'csrf_token_name' => $this->security->get_csrf_token_name(),
                'csrf_hash' => $this->security->get_csrf_hash()
            ];
            echo json_encode($response);
            return;
        }

        $testimoni = $this->Testimoni_model->get_by_id($id);
        $response = [
            'status' => 'success',
            'data' => $testimoni,
            'csrf_token_name' => $this->security->get_csrf_token_name(),
            'csrf_hash' => $this->security->get_csrf_hash()
        ];
        echo json_encode($response);
    }

    // Edit testimoni (AJAX)
    public function edit($id)
    {
        if (!$this->Testimoni_model->exists($id)) {
            $response = [
                'status' => 'error',
                'message' => 'Testimoni tidak ditemukan.',
                'csrf_token_name' => $this->security->get_csrf_token_name(),
                'csrf_hash' => $this->security->get_csrf_hash()
            ];
            echo json_encode($response);
            return;
        }

        if ($this->input->post()) {
            $testimoni = $this->Testimoni_model->get_by_id($id);

            $update = [
                'nama' => $this->input->post('nama'),
                'asal_prodi' => $this->input->post('asal_prodi'),
                'jabatan' => $this->input->post('jabatan'),
                'role' => $this->input->post('role'),
                'isi'  => $this->input->post('isi'),
                'status' => $this->input->post('status')
            ];

            // Upload foto jika ada
            if (!empty($_FILES['foto']['name'])) {
                $config['upload_path'] = './assets/images/testimoni/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048;
                $config['encrypt_name'] = TRUE;

                // Create directory if not exists
                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0755, TRUE);
                }

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto')) {
                    // Delete old file
                    if (!empty($testimoni->foto)) {
                        $old_file = FCPATH . 'assets/images/testimoni/' . $testimoni->foto;
                        if (file_exists($old_file)) {
                            unlink($old_file);
                        }
                    }
                    $update['foto'] = $this->upload->data('file_name');
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Upload foto gagal: ' . $this->upload->display_errors(),
                        'csrf_token_name' => $this->security->get_csrf_token_name(),
                        'csrf_hash' => $this->security->get_csrf_hash()
                    ];
                    echo json_encode($response);
                    return;
                }
            }

            if ($this->Testimoni_model->update($id, $update)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Testimoni berhasil diupdate.',
                    'csrf_token_name' => $this->security->get_csrf_token_name(),
                    'csrf_hash' => $this->security->get_csrf_hash()
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Testimoni gagal diupdate.',
                    'csrf_token_name' => $this->security->get_csrf_token_name(),
                    'csrf_hash' => $this->security->get_csrf_hash()
                ];
            }
            echo json_encode($response);
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Invalid request',
                'csrf_token_name' => $this->security->get_csrf_token_name(),
                'csrf_hash' => $this->security->get_csrf_hash()
            ];
            echo json_encode($response);
        }
    }

    // Detail testimoni (AJAX)
    public function detail($id)
    {
        if (!$this->Testimoni_model->exists($id)) {
            echo '<div class="alert alert-danger">Testimoni tidak ditemukan.</div>';
            return;
        }

        $testimoni = $this->Testimoni_model->get_by_id($id);
        $role_options = $this->Testimoni_model->get_role_options();
        $status_options = $this->Testimoni_model->get_status_options();

        $html = '<div class="row">';

        if (!empty($testimoni->foto)) {
            $html .= '<div class="col-md-4">';
            $html .= '<img src="' . base_url('assets/images/testimoni/' . $testimoni->foto) . '" class="img-responsive img-thumbnail" alt="Foto Testimoni">';
            $html .= '</div>';
            $html .= '<div class="col-md-8">';
        } else {
            $html .= '<div class="col-md-12">';
        }

        $html .= '<table class="table table-bordered">';
        $html .= '<tr><th width="150">Nama</th><td>' . $testimoni->nama . '</td></tr>';
        $html .= '<tr><th>Asal Prodi</th><td>' . $testimoni->asal_prodi . '</td></tr>';
        $html .= '<tr><th>Jabatan</th><td>' . $testimoni->jabatan . '</td></tr>';
        $html .= '<tr><th>Role</th><td><span class="label label-info">' . $role_options[$testimoni->role] . '</span></td></tr>';

        $status_class = '';
        switch ($testimoni->status) {
            case 'publish':
                $status_class = 'label-success';
                break;
            case 'pending':
                $status_class = 'label-warning';
                break;
            case 'rejected':
                $status_class = 'label-danger';
                break;
        }
        $html .= '<tr><th>Status</th><td><span class="label ' . $status_class . '">' . $status_options[$testimoni->status] . '</span></td></tr>';
        $html .= '<tr><th>Tanggal</th><td>' . date('d/m/Y H:i', strtotime($testimoni->created_at)) . '</td></tr>';
        $html .= '<tr><th>Isi Testimoni</th><td>' . nl2br($testimoni->isi) . '</td></tr>';
        $html .= '</table>';
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    }

    // Hapus testimoni (AJAX)
    public function delete($id)
    {
        if (!$this->Testimoni_model->exists($id)) {
            $response = [
                'status' => 'error',
                'message' => 'Testimoni tidak ditemukan.',
                'csrf_token_name' => $this->security->get_csrf_token_name(),
                'csrf_hash' => $this->security->get_csrf_hash()
            ];
        } else {
            if ($this->Testimoni_model->delete($id)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Testimoni berhasil dihapus.',
                    'csrf_token_name' => $this->security->get_csrf_token_name(),
                    'csrf_hash' => $this->security->get_csrf_hash()
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Testimoni gagal dihapus.',
                    'csrf_token_name' => $this->security->get_csrf_hash()
                ];
            }
        }
        echo json_encode($response);
    }

    // Bulk delete
    public function bulk_delete()
    {
        $ids = $this->input->post('ids');
        if (!empty($ids) && is_array($ids)) {
            if ($this->Testimoni_model->bulk_delete($ids)) {
                $this->session->set_flashdata('success', count($ids) . ' testimoni berhasil dihapus.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus testimoni.');
            }
        } else {
            $this->session->set_flashdata('error', 'Tidak ada testimoni yang dipilih.');
        }
        redirect('admin/testimoni');
    }

    // Update status
    public function update_status($id)
    {
        $status = $this->input->post('status');
        if ($this->Testimoni_model->update_status($id, $status)) {
            $this->session->set_flashdata('success', 'Status testimoni berhasil diupdate.');
        } else {
            $this->session->set_flashdata('error', 'Status testimoni gagal diupdate.');
        }
        redirect('admin/testimoni');
    }

    // Bulk update status
    public function bulk_update_status()
    {
        $ids = $this->input->post('ids');
        $status = $this->input->post('status');

        if (!empty($ids) && is_array($ids) && !empty($status)) {
            if ($this->Testimoni_model->bulk_update_status($ids, $status)) {
                $this->session->set_flashdata('success', count($ids) . ' testimoni berhasil diupdate statusnya.');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate status testimoni.');
            }
        } else {
            $this->session->set_flashdata('error', 'Data tidak valid.');
        }
        redirect('admin/testimoni');
    }

    // Export testimoni (optional)
    public function export()
    {
        $filters = array();
        if ($this->input->get('status')) {
            $filters['status'] = $this->input->get('status');
        }
        if ($this->input->get('role')) {
            $filters['role'] = $this->input->get('role');
        }

        $testimoni = $this->Testimoni_model->get_all($filters);

        // Set headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="testimoni_' . date('Y-m-d') . '.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, array('ID', 'Nama', 'Asal Prodi', 'Jabatan', 'Role', 'Isi', 'Status', 'Tanggal Dibuat'));

        foreach ($testimoni as $row) {
            fputcsv($output, array(
                $row->id,
                $row->nama,
                $row->asal_prodi,
                $row->jabatan,
                $row->role,
                strip_tags($row->isi),
                $row->status,
                $row->created_at
            ));
        }

        fclose($output);
    }
}

/* End of file Testimoni.php */
/* Location: ./application/controllers/admin/Testimoni.php */