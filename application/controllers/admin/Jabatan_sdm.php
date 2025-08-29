<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan_sdm extends CI_Controller
{

    // Load database
    public function __construct()
    {
        parent::__construct();
        $this->load->model('jabatansdm_model');
        $this->load->model('konfigurasi_model');
        $this->load->model('sdm_model');
        $this->load->model('jurusan_model');
        $this->load->model('prodi_model');
        $this->load->model('unit_model');
        $this->load->model('pusat_model');

        $this->log_user->add_log();
        // Tambahkan proteksi halaman
        $url_pengalihan = str_replace('index.php/', '', current_url());
        $pengalihan     = $this->session->set_userdata('pengalihan', $url_pengalihan);
        // Ambil check login dari simple_login
        $this->simple_login->check_login($pengalihan);
    }

    // Halaman Jabatan SDM
    public function index()
    {
        $jabatan_sdm = $this->jabatansdm_model->listing();
        $site = $this->konfigurasi_model->listing();

        $data = array(
            'title'        => 'Data Jabatan SDM (' . count($jabatan_sdm) . ')',
            'jabatan_sdm'  => $jabatan_sdm,
            'site'         => $site,
            'isi'          => 'admin/jabatan_sdm/list'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // Proses
    public function proses()
    {
        $site = $this->konfigurasi_model->listing();
        // PROSES HAPUS MULTIPLE
        if (isset($_POST['hapus'])) {
            $inp = $this->input;
            $id_jabatan_sdmnya = $inp->post('id_jabatan_sdm');

            for ($i = 0; $i < sizeof($id_jabatan_sdmnya); $i++) {
                $data = array('id' => $id_jabatan_sdmnya[$i]);
                $this->jabatansdm_model->delete($data);
            }

            $this->session->set_flashdata('sukses', 'Data telah dihapus');
            redirect(base_url('admin/jabatan_sdm'), 'refresh');
        }
    }

    // Tambah Jabatan SDM
    public function tambah()
    {
        // Load data untuk dropdown
        $sdm_list = $this->sdm_model->listing();
        $jurusan_list = $this->jurusan_model->listing();
        $prodi_list = $this->prodi_model->listing();
        $unit_list = $this->unit_model->listing();
        $pusat_list = $this->pusat_model->listing();
        // Tambahkan baris ini untuk debug POST
        log_message('debug', 'POST: ' . json_encode($this->input->post()));

        // Validasi
        $valid = $this->form_validation;

        $valid->set_rules(
            'sdm_id',
            'SDM',
            'required|numeric',
            array(
                'required' => 'SDM harus dipilih',
                'numeric' => 'SDM tidak valid'
            )
        );

        $valid->set_rules(
            'level',
            'Level Jabatan',
            'required|in_list[institusi,jurusan,prodi,unit,pusat]',
            array(
                'required' => 'Level jabatan harus dipilih',
                'in_list' => 'Level jabatan tidak valid'
            )
        );

        $valid->set_rules(
            'jabatan',
            'Nama Jabatan',
            'required|max_length[100]',
            array(
                'required' => 'Nama jabatan harus diisi',
                'max_length' => 'Nama jabatan maksimal 100 karakter'
            )
        );

        $valid->set_rules(
            'periode_mulai',
            'Periode Mulai',
            'required|numeric|greater_than[1900]|less_than[2100]',
            array(
                'required' => 'Periode mulai harus diisi',
                'numeric' => 'Periode mulai harus berupa tahun',
                'greater_than' => 'Periode mulai tidak valid',
                'less_than' => 'Periode mulai tidak valid'
            )
        );

        $valid->set_rules(
            'periode_akhir',
            'Periode Akhir',
            'required|numeric|greater_than[1900]|less_than[2100]',
            array(
                'required' => 'Periode akhir harus diisi',
                'numeric' => 'Periode akhir harus berupa tahun',
                'greater_than' => 'Periode akhir tidak valid',
                'less_than' => 'Periode akhir tidak valid'
            )
        );

        // Validasi conditional berdasarkan level
        if ($this->input->post('level') == 'jurusan') {
            $valid->set_rules(
                'jurusan_id',
                'Jurusan',
                'required|numeric',
                array(
                    'required' => 'Jurusan harus dipilih untuk level jurusan',
                    'numeric' => 'Jurusan tidak valid'
                )
            );
        }
        if ($this->input->post('level') == 'prodi') {
            $valid->set_rules(
                'prodi_id',
                'Program Studi',
                'required|numeric',
                array(
                    'required' => 'Program Studi harus dipilih untuk level prodi',
                    'numeric' => 'Program Studi tidak valid'
                )
            );
        }
        if ($this->input->post('level') == 'unit') {
            $valid->set_rules(
                'unit_id',
                'Unit',
                'required|numeric',
                array(
                    'required' => 'Unit harus dipilih untuk level unit',
                    'numeric' => 'Unit tidak valid'
                )
            );
        }
        if ($this->input->post('level') == 'pusat') {
            $valid->set_rules(
                'pusat_id',
                'Pusat',
                'required|numeric',
                array(
                    'required' => 'Pusat harus dipilih untuk level pusat',
                    'numeric' => 'Pusat tidak valid'
                )
            );
        }

        if ($valid->run()) {
            $i = $this->input;

            $data = array(
                'sdm_id'         => $i->post('sdm_id'),
                'level'          => $i->post('level'),
                'jurusan_id'     => ($i->post('level') == 'jurusan') ? $i->post('jurusan_id') : null,
                'prodi_id'       => ($i->post('level') == 'prodi') ? $i->post('prodi_id') : null,
                'unit_id'        => ($i->post('level') == 'unit') ? $i->post('unit_id') : null,
                'pusat_id'       => ($i->post('level') == 'pusat') ? $i->post('pusat_id') : null,
                'jabatan'        => $i->post('jabatan'),
                'periode_mulai'  => $i->post('periode_mulai'),
                'periode_akhir'  => $i->post('periode_akhir')
            );

            // Validasi custom menggunakan model
            $result = $this->jabatansdm_model->tambah($data);

            if ($result['status']) {
                $this->session->set_flashdata('sukses', 'Data jabatan SDM telah ditambah');
                redirect(base_url('admin/jabatan_sdm'), 'refresh');
            } else {
                $error_msg = implode('<br>', $result['errors']);
                $this->session->set_flashdata('error', $error_msg);
            }
        }

        // End masuk database
        $data = array(
            'title'        => 'Tambah Data Jabatan SDM',
            'sdm_list'     => $sdm_list,
            'jurusan_list' => $jurusan_list,
            'prodi_list'   => $prodi_list,
            'unit_list'    => $unit_list,
            'pusat_list'   => $pusat_list,
            'isi'          => 'admin/jabatan_sdm/tambah'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // Edit Jabatan SDM
    public function edit($id)
    {
        $jabatan_sdm = $this->jabatansdm_model->detail($id);

        if (!$jabatan_sdm) {
            $this->session->set_flashdata('error', 'Data jabatan SDM tidak ditemukan');
            redirect(base_url('admin/jabatan_sdm'));
        }

        // Load data untuk dropdown
        $sdm_list = $this->sdm_model->listing();
        $jurusan_list = $this->jurusan_model->listing();
        $prodi_list = $this->prodi_model->listing();
        $unit_list = $this->db->get('unit')->result(); // Tambah
        $pusat_list = $this->db->get('pusat')->result(); // Tambah

        // Validasi
        $valid = $this->form_validation;

        $valid->set_rules(
            'sdm_id',
            'SDM',
            'required|numeric',
            array(
                'required' => 'SDM harus dipilih',
                'numeric' => 'SDM tidak valid'
            )
        );

        $valid->set_rules(
            'level',
            'Level Jabatan',
            'required|in_list[institusi,jurusan,prodi,unit,pusat]',
            array(
                'required' => 'Level jabatan harus dipilih',
                'in_list' => 'Level jabatan tidak valid'
            )
        );

        $valid->set_rules(
            'jabatan',
            'Nama Jabatan',
            'required|max_length[100]',
            array(
                'required' => 'Nama jabatan harus diisi',
                'max_length' => 'Nama jabatan maksimal 100 karakter'
            )
        );

        $valid->set_rules(
            'periode_mulai',
            'Periode Mulai',
            'required|numeric|greater_than[1900]|less_than[2100]',
            array(
                'required' => 'Periode mulai harus diisi',
                'numeric' => 'Periode mulai harus berupa tahun',
                'greater_than' => 'Periode mulai tidak valid',
                'less_than' => 'Periode mulai tidak valid'
            )
        );

        $valid->set_rules(
            'periode_akhir',
            'Periode Akhir',
            'required|numeric|greater_than[1900]|less_than[2100]',
            array(
                'required' => 'Periode akhir harus diisi',
                'numeric' => 'Periode akhir harus berupa tahun',
                'greater_than' => 'Periode akhir tidak valid',
                'less_than' => 'Periode akhir tidak valid'
            )
        );

        // Validasi conditional berdasarkan level
        if ($this->input->post('level') == 'jurusan') {
            $valid->set_rules(
                'jurusan_id',
                'Jurusan',
                'required|numeric',
                array(
                    'required' => 'Jurusan harus dipilih untuk level jurusan',
                    'numeric' => 'Jurusan tidak valid'
                )
            );
        }
        if ($this->input->post('level') == 'prodi') {
            $valid->set_rules(
                'prodi_id',
                'Program Studi',
                'required|numeric',
                array(
                    'required' => 'Program Studi harus dipilih untuk level prodi',
                    'numeric' => 'Program Studi tidak valid'
                )
            );
        }
        if ($this->input->post('level') == 'unit') {
            $valid->set_rules(
                'unit_id',
                'Unit',
                'required|numeric',
                array(
                    'required' => 'Unit harus dipilih untuk level unit',
                    'numeric' => 'Unit tidak valid'
                )
            );
        }
        if ($this->input->post('level') == 'pusat') {
            $valid->set_rules(
                'pusat_id',
                'Pusat',
                'required|numeric',
                array(
                    'required' => 'Pusat harus dipilih untuk level pusat',
                    'numeric' => 'Pusat tidak valid'
                )
            );
        }

        if ($valid->run()) {
            $i = $this->input;

            $data = array(
                'id'             => $id,
                'sdm_id'         => $i->post('sdm_id'),
                'level'          => $i->post('level'),
                'jurusan_id'     => ($i->post('level') == 'jurusan') ? $i->post('jurusan_id') : null,
                'prodi_id'       => ($i->post('level') == 'prodi') ? $i->post('prodi_id') : null,
                'unit_id'        => ($i->post('level') == 'unit') ? $i->post('unit_id') : null,
                'pusat_id'       => ($i->post('level') == 'pusat') ? $i->post('pusat_id') : null,
                'jabatan'        => $i->post('jabatan'),
                'periode_mulai'  => $i->post('periode_mulai'),
                'periode_akhir'  => $i->post('periode_akhir')
            );

            // Validasi custom menggunakan model
            $result = $this->jabatansdm_model->edit($data);

            if ($result['status']) {
                $this->session->set_flashdata('sukses', 'Data jabatan SDM telah diedit');
                redirect(base_url('admin/jabatan_sdm'), 'refresh');
            } else {
                $error_msg = implode('<br>', $result['errors']);
                $this->session->set_flashdata('error', $error_msg);
            }
        }

        // End masuk database
        $data = array(
            'title'        => 'Edit Data Jabatan SDM',
            'jabatan_sdm'  => $jabatan_sdm,
            'sdm_list'     => $sdm_list,
            'jurusan_list' => $jurusan_list,
            'prodi_list'   => $prodi_list,
            'unit_list'    => $unit_list, // Tambah
            'pusat_list'   => $pusat_list, // Tambah
            'isi'          => 'admin/jabatan_sdm/edit'
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

        $data = array('id' => $id);
        $this->jabatansdm_model->delete($data);
        $this->session->set_flashdata('sukses', 'Data telah dihapus');
        redirect(base_url('admin/jabatan_sdm'), 'refresh');
    }

    // Detail Jabatan SDM
    public function detail($id)
    {
        $jabatan_sdm = $this->jabatansdm_model->detail($id);

        if (!$jabatan_sdm) {
            $this->session->set_flashdata('error', 'Data jabatan SDM tidak ditemukan');
            redirect(base_url('admin/jabatan_sdm'));
        }

        $data = array(
            'title'       => 'Detail Data Jabatan SDM',
            'jabatan_sdm' => $jabatan_sdm,
            'isi'         => 'admin/jabatan_sdm/detail'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // Search Jabatan SDM
    public function search()
    {
        $keyword = $this->input->get('q');

        if (empty($keyword)) {
            redirect(base_url('admin/jabatan_sdm'));
        }

        $jabatan_sdm = $this->jabatansdm_model->search($keyword);

        $data = array(
            'title'       => 'Pencarian Data Jabatan SDM: ' . $keyword,
            'jabatan_sdm' => $jabatan_sdm,
            'keyword'     => $keyword,
            'isi'         => 'admin/jabatan_sdm/list'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // Export Excel
    public function export()
    {
        // Load PHPExcel library
        $this->load->library('PHPExcel');

        $jabatan_sdm_data = $this->jabatansdm_model->listing();

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Jabatan SDM System")
            ->setLastModifiedBy("Jabatan SDM System")
            ->setTitle("Data Jabatan SDM")
            ->setSubject("Data Jabatan SDM Export")
            ->setDescription("Export data jabatan SDM to Excel");

        // Add header
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nama SDM')
            ->setCellValue('C1', 'NIP')
            ->setCellValue('D1', 'Level')
            ->setCellValue('E1', 'Jurusan')
            ->setCellValue('F1', 'Program Studi')
            ->setCellValue('G1', 'Unit')
            ->setCellValue('H1', 'Pusat')
            ->setCellValue('I1', 'Jabatan')
            ->setCellValue('J1', 'Periode Mulai')
            ->setCellValue('K1', 'Periode Akhir');

        // Add data
        $row = 2;
        $no = 1;
        foreach ($jabatan_sdm_data as $jabatan) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $row, $no++)
                ->setCellValue('B' . $row, $jabatan->nama_sdm)
                ->setCellValue('C' . $row, $jabatan->nip)
                ->setCellValue('D' . $row, ucfirst($jabatan->level))
                ->setCellValue('E' . $row, $jabatan->nama_jurusan)
                ->setCellValue('F' . $row, $jabatan->nama_prodi)
                ->setCellValue('G' . $row, $jabatan->nama_unit)
                ->setCellValue('H' . $row, $jabatan->nama_pusat)
                ->setCellValue('I' . $row, $jabatan->jabatan)
                ->setCellValue('J' . $row, $jabatan->periode_mulai)
                ->setCellValue('K' . $row, $jabatan->periode_akhir);
            $row++;
        }

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Data Jabatan SDM');

        // Set active sheet index to the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client's web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data_jabatan_sdm_' . date('Y-m-d') . '.xlsx"');
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
                        $nama_sdm = $worksheet->getCell('A' . $row)->getValue();
                        $level = strtolower($worksheet->getCell('B' . $row)->getValue());
                        $nama_jurusan = $worksheet->getCell('C' . $row)->getValue();
                        $nama_prodi = $worksheet->getCell('D' . $row)->getValue();
                        $nama_unit = $worksheet->getCell('E' . $row)->getValue();
                        $nama_pusat = $worksheet->getCell('F' . $row)->getValue();
                        $jabatan = $worksheet->getCell('G' . $row)->getValue();
                        $periode_mulai = $worksheet->getCell('H' . $row)->getValue();
                        $periode_akhir = $worksheet->getCell('I' . $row)->getValue();

                        if (!empty($nama_sdm) && !empty($level) && !empty($jabatan)) {
                            // Get SDM ID
                            $sdm = $this->db->where('nama', $nama_sdm)->get('sdm')->row();
                            if (!$sdm) continue;

                            $data = array(
                                'sdm_id' => $sdm->id,
                                'level' => $level,
                                'jurusan_id' => null,
                                'prodi_id' => null,
                                'unit_id' => null,
                                'pusat_id' => null,
                                'jabatan' => $jabatan,
                                'periode_mulai' => $periode_mulai,
                                'periode_akhir' => $periode_akhir
                            );

                            // Get Jurusan ID if needed
                            if ($level == 'jurusan' && !empty($nama_jurusan)) {
                                $jurusan = $this->db->where('nama', $nama_jurusan)->get('jurusan')->row();
                                if ($jurusan) {
                                    $data['jurusan_id'] = $jurusan->id;
                                }
                            }

                            // Get Prodi ID if needed
                            if ($level == 'prodi' && !empty($nama_prodi)) {
                                $prodi = $this->db->where('nama', $nama_prodi)->get('prodi')->row();
                                if ($prodi) {
                                    $data['prodi_id'] = $prodi->id;
                                }
                            }

                            // Get Unit ID if needed
                            if ($level == 'unit' && !empty($nama_unit)) {
                                $unit = $this->db->where('nama', $nama_unit)->get('unit')->row();
                                if ($unit) {
                                    $data['unit_id'] = $unit->id;
                                }
                            }

                            // Get Pusat ID if needed
                            if ($level == 'pusat' && !empty($nama_pusat)) {
                                $pusat = $this->db->where('nama', $nama_pusat)->get('pusat')->row();
                                if ($pusat) {
                                    $data['pusat_id'] = $pusat->id;
                                }
                            }

                            $result = $this->jabatansdm_model->tambah($data);
                            if ($result['status']) {
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

            redirect(base_url('admin/jabatan_sdm'), 'refresh');
        }

        $data = array(
            'title' => 'Import Data Jabatan SDM',
            'isi'   => 'admin/jabatan_sdm/import'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // Get struktur organisasi
    public function struktur_organisasi($tahun = null)
    {
        if ($tahun === null) {
            $tahun = date('Y');
        }

        $struktur = $this->jabatansdm_model->get_struktur_organisasi($tahun);

        $data = array(
            'title'    => 'Struktur Organisasi Tahun ' . $tahun,
            'struktur' => $struktur,
            'tahun'    => $tahun,
            'isi'      => 'admin/jabatan_sdm/struktur_organisasi'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // Get riwayat jabatan SDM
    public function riwayat($sdm_id)
    {
        $sdm = $this->sdm_model->detail($sdm_id);
        if (!$sdm) {
            $this->session->set_flashdata('error', 'Data SDM tidak ditemukan');
            redirect(base_url('admin/jabatan_sdm'));
        }

        $riwayat = $this->jabatansdm_model->get_riwayat_jabatan($sdm_id);

        $data = array(
            'title'   => 'Riwayat Jabatan ' . $sdm->nama,
            'sdm'     => $sdm,
            'riwayat' => $riwayat,
            'isi'     => 'admin/jabatan_sdm/riwayat'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // Get jabatan aktif berdasarkan tahun
    public function aktif($tahun = null)
    {
        if ($tahun === null) {
            $tahun = date('Y');
        }

        $jabatan_aktif = $this->jabatansdm_model->get_active($tahun);

        $data = array(
            'title'         => 'Jabatan Aktif Tahun ' . $tahun,
            'jabatan_aktif' => $jabatan_aktif,
            'tahun'         => $tahun,
            'isi'           => 'admin/jabatan_sdm/aktif'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // Get statistik
    public function statistik()
    {
        $stats = $this->jabatansdm_model->get_statistics();

        $data = array(
            'title' => 'Statistik Jabatan SDM',
            'stats' => $stats,
            'isi'   => 'admin/jabatan_sdm/statistik'
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    // AJAX: Get prodi berdasarkan jurusan
    public function get_prodi_by_jurusan()
    {
        $jurusan_id = $this->input->post('jurusan_id');

        $this->db->where('jurusan_id', $jurusan_id);
        $prodi = $this->db->get('prodi')->result();

        header('Content-Type: application/json');
        echo json_encode($prodi);
    }

    // AJAX: Validasi periode overlap
    public function check_periode_overlap()
    {
        $sdm_id = $this->input->post('sdm_id');
        $level = $this->input->post('level');
        $jurusan_id = $this->input->post('jurusan_id');
        $prodi_id = $this->input->post('prodi_id');
        $periode_mulai = $this->input->post('periode_mulai');
        $periode_akhir = $this->input->post('periode_akhir');
        $id = $this->input->post('id'); // untuk edit

        $data = array(
            'sdm_id' => $sdm_id,
            'level' => $level,
            'jurusan_id' => $jurusan_id,
            'prodi_id' => $prodi_id,
            'periode_mulai' => $periode_mulai,
            'periode_akhir' => $periode_akhir
        );

        $errors = $this->jabatansdm_model->validate_data($data, $id);

        header('Content-Type: application/json');
        echo json_encode(array('valid' => empty($errors), 'errors' => $errors));
    }
}

/* End of file Jabatan_sdm.php */
/* Location: ./application/controllers/admin/Jabatan_sdm.php */
