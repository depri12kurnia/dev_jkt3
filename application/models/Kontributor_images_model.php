<?php
class Kontributor_images_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_images_by_kontributor($id_kontributor) {
        $this->db->where('kontributor_id', $id_kontributor);
        $query = $this->db->get('kontributor_images');
        return $query->result_array();
    }
    // End Beckend dari admin
}
?>