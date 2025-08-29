<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sdm extends CI_Controller
{

    // Load database
    public function __construct()
    {
        parent::__construct();
        $this->load->model('sdm_model');

        $this->log_user->add_log();
        // Tambahkan proteksi halaman
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan     = $this->session->set_userdata('pengalihan', $url_pengalihan);
        // Ambil check login dari simple_login
        $this->simple_login->check_login($pengalihan);
    }

    // Halaman SDM
    public function index()
    {
        $sdm = $this->sdm_model->listing();
        $site = $this->konfigurasi_model->listing();

        $data = array(
            'title'     => 'Data SDM (' . count($sdm) . ')',
            'sdm'       => $sdm,
            'site'      => $site,
            'isi'       => 'admin/sdm/list'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // Proses
    public function proses()
    {
        $site = $this->konfigurasi_model->listing();
        // PROSES HAPUS MULTIPLE
        if (isset($_POST['hapus'])) {
            $inp        = $this->input;
            $id_sdmnya  = $inp->post('id_sdm');

            for ($i = 0; $i < sizeof($id_sdmnya); $i++) {
                $sdm = $this->sdm_model->detail($id_sdmnya[$i]);
                if ($sdm->foto_url != '') {
                    unlink('./assets/upload/sdm/' . $sdm->foto_url);
                }
                $data = array('id' => $id_sdmnya[$i]);
                $this->sdm_model->delete($data);
            }

            $this->session->set_flashdata('sukses', 'Data telah dihapus');
            redirect(base_url('admin/sdm'), 'refresh');
        }
    }

    // Tambah SDM
    public function tambah()
    {
        // Validasi
        $valid = $this->form_validation;

        $valid->set_rules(
            'nama',
            'Nama',
            'required',
            array('required' => 'Nama harus diisi')
        );

        $valid->set_rules(
            'email',
            'Email',
            'valid_email',
            array('valid_email' => 'Format email tidak valid')
        );

        $valid->set_rules(
            'deskripsi',
            'Deskripsi',
            'max_length[1000]',
            array('max_length' => 'Deskripsi maksimal 1000 karakter')
        );

        if ($valid->run()) {
            // Validasi keamanan upload file yang lebih ketat
            if (!empty($_FILES['foto']['name'])) {
                // Validasi MIME type
                $allowed_types = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif');
                $file_type = $_FILES['foto']['type'];
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime_type = finfo_file($finfo, $_FILES['foto']['tmp_name']);
                finfo_close($finfo);

                if (!in_array($mime_type, $allowed_types) || !in_array($file_type, $allowed_types)) {
                    $this->session->set_flashdata('error', 'Format file tidak diizinkan');
                    redirect(base_url('admin/sdm/tambah'));
                    return;
                }

                // Generate nama file yang aman
                $file_extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                $safe_filename = uniqid() . '_' . time() . '.' . $file_extension;

                $config['upload_path']   = './assets/upload/sdm/';
                $config['allowed_types'] = 'jpg|png|jpeg|gif';
                $config['max_size']      = '2000';
                $config['file_name']     = $safe_filename;
                $config['encrypt_name']  = FALSE; // Karena sudah custom nama

                // Validasi direktori upload
                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0755, TRUE);
                }

                // Tambahkan .htaccess untuk mencegah eksekusi script
                $htaccess_content = "Options -Indexes\n";
                $htaccess_content .= "Options -ExecCGI\n";
                $htaccess_content .= "<Files *.php>\n";
                $htaccess_content .= "    deny from all\n";
                $htaccess_content .= "</Files>\n";

                file_put_contents($config['upload_path'] . '.htaccess', $htaccess_content);

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('foto')) {
                    // End validasi
                    $data = array(
                        'title' => 'Tambah Data SDM',
                        'error' => $this->upload->display_errors(),
                        'isi'   => 'admin/sdm/tambah'
                    );
                    $this->load->view('admin/layout/wrapper', $data, FALSE);
                    // Masuk database
                } else {
                    $upload_data = array('uploads' => $this->upload->data());

                    $i = $this->input;

                    $data = array(
                        'nama'           => $i->post('nama'),
                        'nip'            => $i->post('nip'),
                        'jenis_kelamin'  => $i->post('jenis_kelamin'),
                        'email'          => $i->post('email'),
                        'no_hp'          => $i->post('no_hp'),
                        'foto_url'       => $upload_data['uploads']['file_name'],
                        'deskripsi'      => $i->post('deskripsi'),
                    );
                    $this->sdm_model->tambah($data);
                    $this->session->set_flashdata('sukses', 'Data telah ditambah');
                    redirect(base_url('admin/sdm'), 'refresh');
                }
            } else {
                $i = $this->input;

                $data = array(
                    'nama'           => $i->post('nama'),
                    'nip'            => $i->post('nip'),
                    'jenis_kelamin'  => $i->post('jenis_kelamin'),
                    'email'          => $i->post('email'),
                    'no_hp'          => $i->post('no_hp'),
                    'foto_url'       => '',
                    'deskripsi'      => $i->post('deskripsi'),
                );
                $this->sdm_model->tambah($data);
                $this->session->set_flashdata('sukses', 'Data telah ditambah');
                redirect(base_url('admin/sdm'), 'refresh');
            }
        }
        // End masuk database
        $data = array(
            'title' => 'Tambah Data SDM',
            'isi'   => 'admin/sdm/tambah'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // Edit SDM
    public function edit($id)
    {
        $sdm = $this->sdm_model->detail($id);

        // Validasi
        $valid = $this->form_validation;

        $valid->set_rules(
            'nama',
            'Nama',
            'required',
            array('required' => 'Nama harus diisi')
        );

        $valid->set_rules(
            'email',
            'Email',
            'valid_email',
            array('valid_email' => 'Format email tidak valid')
        );

        $valid->set_rules(
            'deskripsi',
            'Deskripsi',
            'max_length[1000]',
            array('max_length' => 'Deskripsi maksimal 1000 karakter')
        );

        if ($valid->run()) {
            if (!empty($_FILES['foto']['name'])) {
                $config['upload_path']   = './assets/upload/sdm/';
                $config['allowed_types'] = 'jpg|png|jpeg|gif';
                $config['max_size']      = '2000'; // KB
                $config['encrypt_name']  = TRUE;

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('foto')) {
                    // End validasi
                    $data = array(
                        'title' => 'Edit Data SDM',
                        'sdm'   => $sdm,
                        'error' => $this->upload->display_errors(),
                        'isi'   => 'admin/sdm/edit'
                    );
                    $this->load->view('admin/layout/wrapper', $data, FALSE);
                    // Masuk database
                } else {
                    $upload_data = array('uploads' => $this->upload->data());

                    //Hapus foto lama
                    if ($sdm->foto_url != "") {
                        unlink('./assets/upload/sdm/' . $sdm->foto_url);
                    }
                    // End hapus

                    $i = $this->input;

                    $data = array(
                        'id'             => $id,
                        'nama'           => $i->post('nama'),
                        'nip'            => $i->post('nip'),
                        'jenis_kelamin'  => $i->post('jenis_kelamin'),
                        'email'          => $i->post('email'),
                        'no_hp'          => $i->post('no_hp'),
                        'foto_url'       => $upload_data['uploads']['file_name'],
                        'deskripsi'      => $i->post('deskripsi'),
                    );
                    $this->sdm_model->edit($data);
                    $this->session->set_flashdata('sukses', 'Data telah diedit');
                    redirect(base_url('admin/sdm'), 'refresh');
                }
            } else {
                $i = $this->input;

                $data = array(
                    'id'             => $id,
                    'nama'           => $i->post('nama'),
                    'nip'            => $i->post('nip'),
                    'jenis_kelamin'  => $i->post('jenis_kelamin'),
                    'email'          => $i->post('email'),
                    'no_hp'          => $i->post('no_hp'),
                    'deskripsi'      => $i->post('deskripsi')
                );
                $this->sdm_model->edit($data);
                $this->session->set_flashdata('sukses', 'Data telah diedit');
                redirect(base_url('admin/sdm'), 'refresh');
            }
        }
        // End masuk database
        $data = array(
            'title' => 'Edit Data SDM',
            'sdm'   => $sdm,
            'isi'   => 'admin/sdm/edit'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // Delete
    public function delete($id)
    {
        // Tambahkan proteksi halaman
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan     = $this->session->set_userdata('pengalihan', $url_pengalihan);
        // Ambil check login dari simple_login
        $this->simple_login->check_login($pengalihan);

        $sdm = $this->sdm_model->detail($id);
        // Proses hapus foto
        if ($sdm->foto_url != "") {
            unlink('./assets/upload/sdm/' . $sdm->foto_url);
        }
        // End hapus foto
        $data = array('id' => $id);
        $this->sdm_model->delete($data);
        $this->session->set_flashdata('sukses', 'Data telah dihapus');
        redirect(base_url('admin/sdm'), 'refresh');
    }

    // Search SDM
    public function search()
    {
        $keyword = $this->input->get('q');

        if (empty($keyword)) {
            redirect(base_url('admin/sdm'));
        }

        $sdm = $this->sdm_model->search($keyword);

        $data = array(
            'title'   => 'Pencarian Data SDM: ' . $keyword,
            'sdm'     => $sdm,
            'keyword' => $keyword,
            'isi'     => 'admin/sdm/list'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // Export Excel
    public function export()
    {
        // Load PHPExcel library
        $this->load->library('PHPExcel');

        $sdm_data = $this->sdm_model->listing();

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("SDM System")
            ->setLastModifiedBy("SDM System")
            ->setTitle("Data SDM")
            ->setSubject("Data SDM Export")
            ->setDescription("Export data SDM to Excel");

        // Add header
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nama')
            ->setCellValue('C1', 'NIP')
            ->setCellValue('D1', 'Jenis Kelamin')
            ->setCellValue('E1', 'Email')
            ->setCellValue('F1', 'No. HP')
            ->setCellValue('G1', 'Deskripsi');

        // Add data
        $row = 2;
        $no = 1;
        foreach ($sdm_data as $sdm) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $row, $no++)
                ->setCellValue('B' . $row, $sdm->nama)
                ->setCellValue('C' . $row, $sdm->nip)
                ->setCellValue('D' . $row, $sdm->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan')
                ->setCellValue('E' . $row, $sdm->email)
                ->setCellValue('F' . $row, $sdm->no_hp)
                ->setCellValue('G' . $row, $sdm->deskripsi);
            $row++;
        }

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Data SDM');

        // Set active sheet index to the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client's web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data_sdm_' . date('Y-m-d') . '.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }

    // Import Excel
    public function import()
    {
        if (isset($_POST['import'])) {
            if (!empty($_FILES['file_excel']['name'])) {
                $config['upload_path']   = './assets/temp/';
                $config['allowed_types'] = 'xlsx|xls';
                $config['max_size']      = '5000';
                $config['encrypt_name']  = TRUE;

                // Create temp directory if not exists
                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0755, TRUE);
                }

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file_excel')) {
                    $upload_data = $this->upload->data();
                    $file_path = $config['upload_path'] . $upload_data['file_name'];

                    // Load PHPExcel library
                    $this->load->library('PHPExcel');

                    $objPHPExcel = PHPExcel_IOFactory::load($file_path);
                    $worksheet = $objPHPExcel->getActiveSheet();
                    $highestRow = $worksheet->getHighestRow();

                    $success_count = 0;
                    $error_count = 0;

                    for ($row = 2; $row <= $highestRow; $row++) {
                        $nama = $worksheet->getCell('A' . $row)->getValue();
                        $nip = $worksheet->getCell('B' . $row)->getValue();
                        $jenis_kelamin = $worksheet->getCell('C' . $row)->getValue();
                        $email = $worksheet->getCell('D' . $row)->getValue();
                        $no_hp = $worksheet->getCell('E' . $row)->getValue();
                        $deskripsi = $worksheet->getCell('F' . $row)->getValue();

                        if (!empty($nama)) {
                            $data = array(
                                'nama' => $nama,
                                'nip' => $nip,
                                'jenis_kelamin' => ($jenis_kelamin == 'Laki-laki') ? 'L' : 'P',
                                'email' => $email,
                                'no_hp' => $no_hp,
                                'foto_url' => '',
                                'deskripsi' => $deskripsi
                            );

                            if ($this->sdm_model->tambah($data)) {
                                $success_count++;
                            } else {
                                $error_count++;
                            }
                        }
                    }

                    // Delete temp file
                    unlink($file_path);

                    $this->session->set_flashdata('sukses', $success_count . ' data berhasil diimport. ' . $error_count . ' data gagal.');
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                }
            } else {
                $this->session->set_flashdata('error', 'Pilih file Excel yang akan diimport');
            }

            redirect(base_url('admin/sdm'), 'refresh');
        }

        $data = array(
            'title' => 'Import Data SDM',
            'isi'   => 'admin/sdm/import'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }
}

/* End of file Sdm.php */
/* Location: ./application/controllers/admin/Sdm.php */