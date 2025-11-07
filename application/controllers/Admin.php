<?php

/**
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Pagination $pagination
 * @property CI_URI $uri
 * @property User_model $user_model
 */
class Admin extends Admin_controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        redirect('admin/dashboard');
    }

    public function dashboard()
    {
        $data['title'] = 'Dashboard';
        $this->load->view('layout/header', $data);
        $this->load->view('admin/dashboard');
        $this->load->view('layout/footer');
    }

    public function users()
    {
        $this->check_admin();

        $this->load->model('user_model');
        $this->load->library('pagination');

        $config['base_url'] = base_url('admin/users');
        $config['total_rows'] = $this->user_model->count_users();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['users'] = $this->user_model->get_all_users($config['per_page'], $page);
        $data['pagination'] = $this->pagination->create_links();
        $data['title'] = "Gestion de Usuarios";

        $this->load->view('layout/header', $data);
        $this->load->view('admin/users/index', $data);
        $this->load->view('layout/footer');
    }

    public function user_create()
    {
        $this->check_admin();
        $this->load->model('user_model');

        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Nombre', 'required|min_length[3]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email_unique');
            $this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[7]');
            $this->form_validation->set_rules('role', 'Rol', 'required|in_list[admin,user]');

            if ($this->form_validation->run()) {
                $data = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'role' => $this->input->post('role'),
                );

                if ($this->user_model->create_user($data)) {
                    $this->session->set_flashdata('success', 'Usuario creado correctamente.');
                    redirect('admin/users');
                } else {
                    $this->session->set_flashdata('error', 'Error al crear el usuario.');
                }
            }
        }

        $data['title'] = 'Crear Usuario';
        $this->load->view('layout/header', $data);
        $this->load->view('admin/users/create');
        $this->load->view('layout/footer');
    }

    public function user_edit($id)
    {
        $this->check_admin();
        $this->load->model('user_model');

        $user = $this->user_model->get_user_by_id($id);
        if (!$user) {
            show_404();
        }

        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Nombre', 'required|min_length[3]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email_unique['. $id .']');
            $this->form_validation->set_rules('role', 'Rol', 'required|in_list[admin,user]');

            if ($this->form_validation->run()) {
                $data = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'role' => $this->input->post('role')
                );

                if ($this->input->post('password')) {
                    $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                }

                if ($this->user_model->update_user($id, $data)) {
                    $this->session->set_flashdata('success', 'Usuario actualizado correctamente.');
                    redirect('admin/users');
                } else {
                    $this->session->set_flashdata('error', 'Error al actualizar el usuario.');
                }
            }
        }

        $data['user'] = $user;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/users/edit', $data);
        $this->load->view('layout/footer');
    }

    public function user_delete($id)
    {
        $this->check_admin();
        $this->load->model('user_model');

        if ($this->user_model->delete_user($id)) {
            $this->session->set_flashdata('success', 'Usuario borrado exitosamente.');
        } else {
            $this->session->set_flashdata('success', 'Error al intentar borrar el usuario.');
        }

        redirect('admin/users');
    }

    public function check_email_unique($email, $exclude_id = null)
    {
        $this->load->model('user_model');
        if ($this->user_model->email_exists($email, $exclude_id)) {
            $this->form_validation->set_message('check_email_unique', 'El mail ya esta en uso');
            return FALSE;
        }
        return TRUE;
    }
}