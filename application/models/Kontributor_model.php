<?php
class Kontributor_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    // Frontend
    public function insert_kontribusi($lp_options, $lp_id, $lp_kontributor, $lp_unit, $lp_what, $lp_where, $lp_when, $lp_who, $lp_why, $lp_how)
    {
        $data = array(
            'lp_options' => $lp_options,
            'lp_id' => $lp_id,
            'lp_kontributor' => $lp_kontributor,
            'lp_unit' => $lp_unit,
            'lp_what' => $lp_what,
            'lp_where' => $lp_where,
            'lp_when' => $lp_when,
            'lp_who' => $lp_who,
            'lp_why' => $lp_why,
            'lp_how' => $lp_how,
            'lp_status' => 'Proses',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        $this->db->insert('kontributor', $data);
        return $this->db->insert_id();
    }

    public function insert_images($kontributor_id, $images)
    {
        foreach ($images as $image) {
            $data = array(
                'kontributor_id' => $kontributor_id,
                'file_name' => $image['file_name'],
                'upload_at' => date('Y-m-d H:i:s')
            );

            $this->db->insert('kontributor_images', $data);
        }
    }

    // End Dari Frontend

    // Beckend dari admin
    public function store()
    {
        $this->db->select('*');
		$this->db->from('kontributor');
		// Join dg 1 tabel
		// $this->db->join('kontributor_images', 'kontributor_images.kontributor_id = kontributor.id_kontributor', 'LEFT');
		// End join
		$this->db->order_by('created_at', 'DESC');
		$query = $this->db->get();
		return $query->result();
    }

    public function get_kontributor($id_kontributor) {

        $this->db->select('*');
		$this->db->from('kontributor');
		$this->db->where('id_kontributor', $id_kontributor);
		$this->db->order_by('id_kontributor');
		$query = $this->db->get();
		return $query->row();

        // $query = $this->db->get_where('kontributor', array('id_kontributor' => $id_kontributor));
        // return $query->row_array();
    }

    public function get_images_by_kontributor($id_kontributor) {
        $this->db->where('kontributor_id', $id_kontributor);
        $query = $this->db->get('kontributor_images');
        return $query->result_array();
    }

    // Delete
	public function delete($data)
	{
		$this->db->where('id_kontributor', $data['id_kontributor']);
		$this->db->delete('kontributor', $data);
	}
    // End Beckend dari admin
}
?>