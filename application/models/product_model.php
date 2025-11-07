<?php


class Product_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function count_products($search)
    {
        $this->db->from('products');

        if ($search) {
            $this->db->where("(name LIKE '%{$search}%' OR sku LIKE '%{$search}%')");
        }
        return $this->db->count_all_results();
    }

    public function get_all_products($limit = null, $offset = null, $search = null, $order_by = 'name', $order_dir = 'ASC')
    {
        $this->db->select('products.*, categories.name as category_name');
        $this->db->from('products');
        $this->db->join('categories', 'categories.id = products.category_id');

        if ($search) {
            $this->db->where("(products.name LIKE '%{$search}%' OR products.sku LIKE '%{$search}%')");
        }

        $this->db->order_by($order_by, $order_dir);

        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        return $this->db->get()->result();
    }

    public function create_product($data)
    {
        return $this->db->insert('products', $data);
    }

    public function get_product_by_id($id)
    {
        $this->db->select('products.*, categories.name as category_name');
        $this->db->from('products');
        $this->db->join('categories', 'categories.id = products.category_id');
        $this->db->where('products.id', $id);

        return $this->db->get()->row();
    }

    public function update_product($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }

    public function delete_product($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('products');
    }

    public function sku_exists($sku, $exclude_id = null)
    {
        $this->db->where('sku', $sku);
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }

        return $this->db->count_all_results('products') > 0;
    }
}