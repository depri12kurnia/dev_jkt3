<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Download_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Listing data
    public function listing()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->order_by('id_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing data
    public function populer()
    {
        $this->db->select('*');
        $this->db->from('download');
        $this->db->order_by('hits', 'DESC');
        $this->db->limit(20);
        $query = $this->db->get();
        return $query->result();
    }

    // Listing data slider
    public function slider()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, users.nama');
        $this->db->from('download');
        // Join dg 2 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->where('type_download', 'Homepage');
        $this->db->order_by('id_download', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
    }

    // Listing data download
    public function download()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama, kategori_download.slug_kategori_download, jenis_download.slug_jenis_download');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->where('id_download', 'Download');
        $this->db->order_by('id_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing data download total
    public function total()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->where('type_download', 'Download');
        $this->db->order_by('id_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Kategori
    public function kategori()
    {
        $this->db->select('*');
        $this->db->from('kategori_download');
        $this->db->order_by('id_kategori_download', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Jenis

    public function get_subkategori_download($id_kategori_download)
    {
        $this->db->select('jenis_download.*, kategori_download.nama_kategori_download, kategori_download.slug_kategori_download');
        $this->db->from('jenis_download');
        // Join
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = jenis_download.id_subkategori_download');
        // End Join
        $this->db->where(array('jenis_download', 'kategori_download.id_kategori_download' => $id_kategori_download));
        $this->db->order_by('nama_kategori_download', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function jenis()
    {
        $this->db->select('*');
        $this->db->from('jenis_download');
        $this->db->order_by('id_jenis_download', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // Detail data
    public function detail($id)
    {
        // Validasi input untuk keamanan
        if (!is_numeric($id) || $id <= 0) {
            return false;
        }

        $this->db->where('id_download', (int)$id);
        $this->db->where('status_download', 'Publish'); // Hanya file yang dipublikasi
        return $this->db->get('download')->row();
    }

    // Read data
    public function read($slug_download)
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 2 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        $this->db->where('id_download', $slug_download);
        $this->db->order_by('id_download', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    // crud
    // Tambah
    public function tambah($data)
    {
        $this->db->insert('download', $data);
    }

    // Edit
    public function edit($data)
    {
        $this->db->where('id_download', $data['id_download']);
        $this->db->update('download', $data);
    }

    // Edit
    public function edit2($data2)
    {
        $this->db->where('id_download', $data2['id_download']);
        $this->db->update('download', $data2);
    }

    // Delete
    public function delete($data)
    {
        $this->db->where('id_download', $data['id_download']);
        $this->db->delete('download', $data);
    }

    // =========== Listing data by Kategori ======================
    public function listingDokumen()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_jenis_download', 'Akreditasi');
        $this->db->order_by('judul_download', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    // ============= Listing Akuntabilitas ========================
    public function listingDipa()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_jenis_download', 'Dipa');
        $this->db->order_by('judul_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function listingLaporanKeuangan()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_jenis_download', 'Laporan Keuangan');
        $this->db->order_by('judul_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function listingPerencanaan()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_jenis_download', 'Perencanaan');
        $this->db->order_by('judul_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function listingLakip()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_jenis_download', 'Lakip');
        $this->db->order_by('judul_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function listingPerjanjianKinerja()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_jenis_download', 'Perjanjian Kinerja');
        $this->db->order_by('judul_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function listingPeraturan()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_jenis_download', 'Peraturan');
        $this->db->order_by('judul_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function listingLainnya()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_jenis_download', 'Lainnya');
        $this->db->order_by('judul_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // ============== Listing Standard Pelayanan ===================
    public function listingIntruksiKerja()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_jenis_download', 'Intruksi Kerja');
        $this->db->order_by('judul_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function listingProsedur()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_jenis_download', 'Prosedur');
        $this->db->order_by('judul_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function listingStandard()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_jenis_download', 'Standard');
        $this->db->order_by('judul_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // ============= Listing Prestasi =========================================
    public function listingMahasiswa()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_kategori_download', 'Prestasi');
        $this->db->like('nama_jenis_download', 'Mahasiswa');
        $this->db->order_by('judul_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function listingDosen()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_kategori_download', 'Prestasi');
        $this->db->like('nama_jenis_download', 'Dosen');
        $this->db->order_by('judul_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function listingTendik()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_kategori_download', 'Prestasi');
        $this->db->like('nama_jenis_download', 'Tenaga Kependidikan');
        $this->db->order_by('judul_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function listingPenghargaanInstitusi()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_kategori_download', 'Prestasi');
        $this->db->like('nama_jenis_download', 'Institusi');
        $this->db->order_by('judul_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing Layanan Akademik
    public function listingAkademik()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_jenis_download', 'Akademik');
        $this->db->order_by('judul_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing Layanan Kemahasiswaan
    public function listingKemahasiswaan()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_jenis_download', 'Kemahasiswaan');
        $this->db->order_by('judul_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Layanan Pelanggan
    public function listingLayananPelanggan()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_jenis_download', 'Layanan Pelanggan');
        $this->db->order_by('judul_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing Layanan Perpustakaan
    public function listingPerpustakaan()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_jenis_download', 'Perpustakaan');
        $this->db->order_by('judul_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing Layanan ASN
    public function listingAsn()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_jenis_download', 'ASN');
        $this->db->like('nama_kategori_download', 'Peraturan');
        $this->db->order_by('judul_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing Layanan Peraturan Dosen
    public function listingPDosen()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_jenis_download', 'Peraturan Dosen');
        $this->db->like('nama_kategori_download', 'Peraturan');
        $this->db->order_by('judul_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing Laporan Monitoring Evaluasi
    public function listingLaporanMonev()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_jenis_download', 'Laporan Monev');
        $this->db->like('nama_kategori_download', 'Laporan');
        $this->db->order_by('judul_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing Peraturan Akademik
    public function listingPA()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_jenis_download', 'Peraturan Akademik');
        $this->db->like('nama_kategori_download', 'Akademik');
        $this->db->order_by('id_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing Kalender Akademik
    public function listingKA()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_jenis_download', 'Kalender Akademik');
        $this->db->like('nama_kategori_download', 'Akademik');
        $this->db->order_by('id_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Listing Layanan Publik Untuk Short Di Admin Dashboard
    public function listLayananAkademik()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_kategori_download', 'Layanan Akademik');
        $this->db->order_by('id_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function listLayananKemahasiswaan()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_kategori_download', 'Layanan Kemahasiswaan');
        $this->db->order_by('id_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function listLayananPelanggan()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_kategori_download', 'Layanan Pelanggan');
        $this->db->order_by('id_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function listLayananPerpustakaan()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_kategori_download', 'Layanan Perpustakaan');
        $this->db->order_by('id_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // End Daftar Layanan Publik Untuk Short Di Admin Dashboard

    // Listing Informasi Publik Untuk Short Admin Dashboard
    public function listDokumen()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_kategori_download', 'Dokumen');
        $this->db->order_by('id_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function listAkuntabilitas()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_kategori_download', 'Akuntabilitas');
        $this->db->order_by('id_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function listStandardPelayanan()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_kategori_download', 'Standard Pelayanan');
        $this->db->order_by('id_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function listPrestasi()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_kategori_download', 'Prestasi');
        $this->db->order_by('id_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // End Listing Informasi Publik Untuk Short Admin Dashboard

    // Listing View Organisasi dan Tatalaksana

    public function listPeraturanAsn()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_kategori_download', 'Peraturan');
        $this->db->like('nama_jenis_download', 'ASN');
        $this->db->order_by('id_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function listPeraturanDosen()
    {
        $this->db->select('download.*, kategori_download.nama_kategori_download, jenis_download.nama_jenis_download, users.nama');
        $this->db->from('download');
        // Join dg 3 tabel
        $this->db->join('kategori_download', 'kategori_download.id_kategori_download = download.id_kategori_download', 'LEFT');
        $this->db->join('jenis_download', 'jenis_download.id_jenis_download = download.id_jenis_download', 'LEFT');
        $this->db->join('users', 'users.id_user = download.id_user', 'LEFT');
        // End join
        $this->db->like('nama_kategori_download', 'Peraturan');
        $this->db->like('nama_jenis_download', 'Peraturan Dosen');
        $this->db->order_by('id_download', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // End Listing View Organisasi dan Tatalaksana

    public function increment_download_count($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            return false;
        }

        $this->db->where('id_download', (int)$id);
        $this->db->set('download_count', 'download_count + 1', FALSE);
        return $this->db->update('download');
    }

    public function listing_read()
    {
        $this->db->where('status_download', 'Publish');
        $this->db->order_by('id_download', 'DESC');
        $this->db->limit(5);
        return $this->db->get('download')->result();
    }
}

/* End of file Download_model.php */
/* Location: ./application/models/Download_model.php */
