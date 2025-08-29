<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kontributor extends CI_Controller
{

	// Database
	public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
        $this->load->library('session');
    }

	// Main page kontak
	public function index()
	{
		$this->load->view('laporan_berita/form1');
	}

    public function form2()
    {
        $this->load->library('form_validation');
        // Atur aturan validasi
        $this->form_validation->set_rules('lp_options', 'Option', 'required');
        $this->form_validation->set_rules('lp_id', 'Status', 'required|trim|strip_tags|xss_clean');
        $this->form_validation->set_rules('lp_kontributor', 'Nama Kontributor', 'required|trim|strip_tags|xss_clean');
        $this->form_validation->set_rules('lp_unit', 'Unit Kerja', 'required|trim|xss_clean');
        $this->form_validation->set_rules('lp_what', 'Judul dan Tema Kegiatan', 'required|trim|strip_tags|xss_clean');
        $this->form_validation->set_rules('lp_where', 'Lokasi / Tempat Kegiatan', 'required|trim|strip_tags|xss_clean');
        $this->form_validation->set_rules('lp_when', 'Waktu, Hari dan Tanggal Kegiatan', 'required|trim|strip_tags|xss_clean');
        $this->form_validation->set_rules('lp_who', 'Narasumber, Kriteria Peserta, Jumlah Peserta', 'required|trim|strip_tags|xss_clean');
        $this->form_validation->set_rules('lp_why', 'Maksud dan Tujuan Kegiatan', 'required|trim|strip_tags|xss_clean');
        $this->form_validation->set_rules('lp_how', 'Proses Pelaksanaan Kegiatan', 'required|trim|strip_tags|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembali ke form
            $this->load->view('laporan_berita/form1');
        } else {
            // Jika validasi berhasil, proses data
            $lp_options = $this->input->post('lp_options', TRUE);
            $lp_id = $this->input->post('lp_id', TRUE);
            $lp_kontributor = $this->input->post('lp_kontributor', TRUE);
            $lp_unit = $this->input->post('lp_unit', TRUE);
            $lp_what = $this->input->post('lp_what', TRUE);
            $lp_where = $this->input->post('lp_where', TRUE);
            $lp_when = $this->input->post('lp_when', TRUE);
            $lp_who = $this->input->post('lp_who', TRUE);
            $lp_why = $this->input->post('lp_why', TRUE);
            $lp_how = $this->input->post('lp_how', TRUE);
            $this->session->set_userdata('lp_options', $lp_options);
            $this->session->set_userdata('lp_id', $lp_id);
            $this->session->set_userdata('lp_kontributor', $lp_kontributor);
            $this->session->set_userdata('lp_unit', $lp_unit);
            $this->session->set_userdata('lp_what', $lp_what);
            $this->session->set_userdata('lp_where', $lp_where);
            $this->session->set_userdata('lp_when', $lp_when);
            $this->session->set_userdata('lp_who', $lp_who);
            $this->session->set_userdata('lp_why', $lp_why);
            $this->session->set_userdata('lp_how', $lp_how);

            $this->load->view('laporan_berita/form2');
        }
    }

    public function do_upload()
    {
        $files = $_FILES;
        $count = count($_FILES['images']['name']);
        $uploadedData = [];

        // Dari Session Sebelumnya
        $lp_options = $this->session->userdata('lp_options');
        $lp_id = $this->session->userdata('lp_id');
        $lp_kontributor = $this->session->userdata('lp_kontributor');
        $lp_unit = $this->session->userdata('lp_unit');
		$lp_what = $this->session->userdata('lp_what');
		$lp_where = $this->session->userdata('lp_where');
		$lp_when = $this->session->userdata('lp_when');
		$lp_who = $this->session->userdata('lp_who');
		$lp_why = $this->session->userdata('lp_why');
		$lp_how = $this->session->userdata('lp_how');

        for($i = 0; $i < $count; $i++)
        {
            $_FILES['image']['name']     = $files['images']['name'][$i];
            $_FILES['image']['type']     = $files['images']['type'][$i];
            $_FILES['image']['tmp_name'] = $files['images']['tmp_name'][$i];
            $_FILES['image']['error']    = $files['images']['error'][$i];
            $_FILES['image']['size']     = $files['images']['size'][$i];

            $this->upload->initialize($this->set_upload_options());

            if ($this->upload->do_upload('image'))
            {
                $uploadedData[] = $this->upload->data();
            }
        }

        // Save to database
        $this->load->model('kontributor_model');
        
        $kontributor_id = $this->kontributor_model->insert_kontribusi($lp_options, $lp_id, $lp_kontributor, $lp_unit, $lp_what, $lp_where, $lp_when, $lp_who, $lp_why, $lp_how);

        if (!empty($uploadedData)) {
            foreach ($uploadedData as $data) {
                $insert_data = array(
                    'kontributor_id' => $kontributor_id,
                    'file_name' => $data['file_name'],
                    'upload_at' => date('Y-m-d H:i:s')
                );
                $this->db->insert('kontributor_images', $insert_data);
            }
            // echo "Upload Successful!";
           
            $this->session->set_flashdata('message', 'Upload Berhasil </br> Terimakasih Atas Kontribusinya');

            $array_items = array($lp_options, $lp_id, $lp_kontributor, $lp_unit, $lp_what, $lp_where, $lp_when, $lp_who, $lp_why, $lp_how );
            $this->session->unset_userdata($array_items);
        } else {
            // echo "Upload Failed!";
            $this->session->set_flashdata('message', 'Upload Failed!');
        }
        $this->load->view('laporan_berita/upload_success');
    }

    private function set_upload_options()
    {
        // upload an image options
        $config = array();
        $config['upload_path'] = 'assets/upload/kontributor/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size'] = 5000; //5mb
        $config['encrypt_name'] = true;
        $config['overwrite'] = FALSE;

        return $config;
    }
}

/* End of file Contact.php */
/* Location: ./application/controllers/kontributor.php */
