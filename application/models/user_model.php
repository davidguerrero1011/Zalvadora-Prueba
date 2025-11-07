<?php


class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_user_by_email($email)
    {
        return $this->db->get_where('users', array('email' => $email))->row();
    }

    public function count_users()
    {
        return $this->db->count_all('users');
    }

    public function get_all_users($limit = null, $offset = null)
    {
        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->get('users')->result();
    }

    public function create_user($data)
    {
        return $this->db->insert('users', $data);
    }

    public function get_user_by_id($id)
    {
        return $this->db->get_where('users', array('id' => $id))->row();
    }

    public function update_user($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function delete_user($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

    public function email_exists($email, $exclude_id = null)
    {
        $this->db->where('email', $email);
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        return $this->db->count_all_results('users') > 0;
    }
}