<?php

/**
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Pagination $pagination
 * @property CI_URI $uri
 * @property Category_model $category_model
 */
class Categories extends Admin_controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_admin();
        $this->load->model('category_model');
    }

    public function index()
    {
        $this->load->library('pagination');

        $config['base_url'] = base_url('categories');
        $config['total_rows'] = $this->category_model->count_categories();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['categories'] = $this->category_model->get_all_categories($config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();
        $data['title'] = "Gestion de Categorias";

        $this->load->view('layout/header', $data);
        $this->load->view('admin/categories/index', $data);
        $this->load->view('layout/footer');
    }

    public function create()
    {
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Nombre', 'required|min_length[3]|callback_check_name_unique');

            if ($this->form_validation->run()) {
                $data = array('name' => $this->input->post('name'));

                if ($this->category_model->create_category($data)) {
                    $this->session->set_flashdata('success', 'Categoria creada correctamente.');
                    redirect('categories');
                } else {
                    $this->session->set_flashdata('error', 'Error al crear la categoria.');
                }
            }
        }

        $data['title'] = 'Crear Categoria';
        $this->load->view('layout/header', $data);
        $this->load->view('admin/categories/create');
        $this->load->view('layout/footer');
    }

    public function edit($id)
    {
        $category = $this->category_model->get_category_by_id($id);
        if (!$category) {
            show_404();
        }

        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Nombre', 'required|min_length[3]|callback_check_name_unique[' . $id . ']');

            if ($this->form_validation->run()) {
                $data = array('name' => $this->input->post('name'));

                if ($this->category_model->update_category($id, $data)) {
                    $this->session->set_flashdata('success', 'Categoria actualizada correctamente.');
                    redirect('categories');
                } else {
                    $this->session->set_flashdata('error', 'Error al actualizar la categoria.');
                }
            }
        }

        $data['category'] = $category;
        $data['title'] = 'Editar Categoria';
        $this->load->view('layout/header', $data);
        $this->load->view('admin/categories/edit', $data);
        $this->load->view('layout/footer');
    }

    public function delete($id)
    {

        if ($this->category_model->has_products($id)) {
            $this->session->set_flashdata('error', 'No se puede eliminar esta categoria porque tiene productos asociados.');
        } else {
            if ($this->category_model->delete_category($id)) {
                $this->session->set_flashdata('success', 'Categoria eliminada exitosamente.');
            } else {
                $this->session->set_flashdata('error', 'Hubo algún error eliminando la categoria.');
            }
        }

        redirect('categories');
    }

    public function check_name_unique($name, $exclude_id = null)
    {
        if ($this->category_model->name_exists($name, $exclude_id)) {
            $this->form_validation->set_message('check_name_unique', 'El nombre ya esta en uso');
            return FALSE;
        }
        return TRUE;
    }
}