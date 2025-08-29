<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sitemap_model extends CI_Model
{

    function pages()
    {

        return $this->db->order_by('tanggal_publish', 'desc')->get('pages')->result_array();
    }

    function alumni()
    {
        $this->db->select('slug_pages,tanggal_publish');
        $this->db->where('jenis_pages', 'Alumni');
        $this->db->where('status_pages', 'Publish');
        return $this->db->order_by('tanggal_publish', 'desc')->get('pages')->result_array();
    }

    function pendidikan()
    {
        $this->db->select('slug_pages,tanggal_publish');
        $this->db->where('jenis_pages', 'Pendidikan');
        $this->db->where('status_pages', 'Publish');
        return $this->db->order_by('tanggal_publish', 'desc')->get('pages')->result_array();
    }

    function tentang()
    {
        $this->db->select('slug_pages,tanggal_publish');
        $this->db->where('jenis_pages', 'Profil');
        $this->db->where('status_pages', 'Publish');
        return $this->db->order_by('tanggal_publish', 'desc')->get('pages')->result_array();
    }

    function berita()
    {
        $this->db->select('slug_berita,tanggal_publish');
        $this->db->where('jenis_berita', 'Berita');
        $this->db->where('status_berita', 'Publish');
        return $this->db->order_by('tanggal_publish', 'desc')->get('berita')->result_array();
    }

    function prodi()
    {
        $this->db->select('slug_prodi,tanggal');
        $this->db->where('status_prodi', 'Publish');
        return $this->db->order_by('tanggal', 'desc')->get('prodi')->result_array();
    }
}
