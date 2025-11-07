<?php

/**
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Pagination $pagination
 * @property CI_URI $uri
 * @property Product_model $product_model
 * @property Category_model $category_model
 */
class Products extends Admin_controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->library('pagination');

        $search = $this->input->get('q');
        $order_by = $this->input->get('order_by') ?: 'name';
        $order_dir = $this->input->get('order_dir') ?: 'ASC';

        $config['base_url'] = base_url('products');
        $config['total_rows'] = $this->product_model->count_products($search);
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['reuse_query_string'] = TRUE;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['products'] = $this->product_model->get_all_products($config['per_page'], $page, $search, $order_by, $order_dir);
        $data['pagination'] = $this->pagination->create_links();
        $data['search'] = $search;
        $data['order_by'] = $order_by;
        $data['order_dir'] = $order_dir;
        $data['title'] = "Gestion de Productos";

        $this->load->view('layout/header', $data);
        $this->load->view('admin/products/index', $data);
        $this->load->view('layout/footer');
    }

    public function create()
    {
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Nombre', 'required|min_length[3]');
            $this->form_validation->set_rules('sku', 'SKU', 'required|callback_check_sku_unique');
            $this->form_validation->set_rules('price', 'Precio', 'required|numeric|greater_than[0]');
            $this->form_validation->set_rules('stock', 'Stock', 'required|integer|greater_than_equal_to[0]');
            $this->form_validation->set_rules('category_id', 'Categoria', 'required|integer');

            if ($this->form_validation->run()) {
                $data = array(
                    'name' => $this->input->post('name'),
                    'sku' => $this->input->post('sku'),
                    'price' => $this->input->post('price'),
                    'stock' => $this->input->post('stock'),
                    'category_id' => $this->input->post('category_id')
                );

                if ($this->product_model->create_product($data)) {
                    $this->session->set_flashdata('success', 'Producto creado correctamente.');
                    redirect('products');
                } else {
                    $this->session->set_flashdata('error', 'Error al crear el producto.');
                }
            }
        }

        $data['categories'] = $this->category_model->get_all_categories();
        $data['title'] = 'Crear Producto';
        $this->load->view('layout/header', $data);
        $this->load->view('admin/products/create', $data);
        $this->load->view('layout/footer');
    }

    public function edit($id)
    {
        $product = $this->product_model->get_product_by_id($id);
        if (!$product) {
            show_404();
        }

        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Nombre', 'required|min_length[3]');
            $this->form_validation->set_rules('sku', 'SKU', 'required|callback_check_sku_unique[' . $id . ']');
            $this->form_validation->set_rules('price', 'Precio', 'required|numeric|greater_than[0]');
            $this->form_validation->set_rules('stock', 'Stock', 'required|integer|greater_than_equal_to[0]');
            $this->form_validation->set_rules('category_id', 'Categoria', 'required|integer');

            if ($this->form_validation->run()) {
                $data = array(
                    'name' => $this->input->post('name'),
                    'sku' => $this->input->post('sku'),
                    'price' => $this->input->post('price'),
                    'stock' => $this->input->post('stock'),
                    'category_id' => $this->input->post('category_id')
                );

                if ($this->product_model->update_product($id, $data)) {
                    $this->session->set_flashdata('success', 'Producto actualizado correctamente.');
                    redirect('products');
                } else {
                    $this->session->set_flashdata('error', 'Error al actualizar el producto.');
                }
            }
        }

        $data['product'] = $product;
        $data['categories'] = $this->category_model->get_all_categories();
        $data['title'] = 'Editar Producto';
        $this->load->view('layout/header', $data);
        $this->load->view('admin/products/edit', $data);
        $this->load->view('layout/footer');
    }

    public function delete($id)
    {

        if ($this->product_model->delete_product($id)) {
            $this->session->set_flashdata('success', 'Producto eliminada exitosamente.');
        } else {
            $this->session->set_flashdata('error', 'Hubo algún error eliminando el producto.');
        }

        redirect('products');
    }

    public function check_sku_unique($sku, $exclude_id = null)
    {
        if ($this->product_model->sku_exists($sku, $exclude_id)) {
            $this->form_validation->set_message('check_sku_unique', 'El sku ya esta en uso');
            return FALSE;
        }
        return TRUE;
    }
}
