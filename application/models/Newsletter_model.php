<?php
class Newsletter_model extends CI_Model
{

    public function save_subscriber($email, $token)
    {
        // Cek apakah email sudah ada
        $exists = $this->db->get_where('subscribers', ['email' => $email])->row();
        if ($exists) return false;

        return $this->db->insert('subscribers', [
            'email' => $email,
            'confirmation_token' => $token,
            'is_confirmed' => 0
        ]);
    }

    public function confirm_token($token)
    {
        $row = $this->db->get_where('subscribers', ['confirmation_token' => $token])->row();

        if ($row) {
            $this->db->where('id', $row->id)->update('subscribers', [
                'is_confirmed' => 1,
                'confirmation_token' => null
            ]);
            return true;
        }
        return false;
    }

    public function get_confirmed_subscribers()
    {
        return $this->db->get_where('subscribers', ['is_confirmed' => 1])->result();
    }
}
