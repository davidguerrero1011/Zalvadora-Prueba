<?php


class Category_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function count_categories()
    {
        return $this->db->count_all('categories');
    }

    public function get_all_categories($limit = null, $offset = null)
    {
        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->get('categories')->result();
    }

    public function create_category($data)
    {
        return $this->db->insert('categories', $data);
    }

    public function get_category_by_id($id)
    {
        return $this->db->get_where('categories', array('id' => $id))->row();
    }

    public function update_category($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('categories', $data);
    }

    public function has_products($id)
    {
        $this->db->where('category_id', $id);
        return $this->db->count_all_results('products') > 0;
    }

    public function delete_category($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('categories');
    }

    public function name_exists($name, $exclude_id)
    {
        $this->db->where('name', $name);
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }

        return $this->db->count_all_results('categories') > 0;
    }
}