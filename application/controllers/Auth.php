<?php

/**
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property User_model $user_model
 */
class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model'); // Carga modelo para buscar usuarios
    }
    
    public function index() {
        if ($this->session->userdata('user_id')) {
            redirect('admin');
        }

        redirect('auth/login');
    }
    
    public function login() {
        if ($this->session->userdata('user_id')) {
            redirect('admin');
        }
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');
            
            if ($this->form_validation->run()) {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                
                $user = $this->user_model->get_user_by_email($email);
                
                if ($user) {
                    if (password_verify($password, $user->password)) {
                        $session_data = array(
                            'user_id' => $user->id,
                            'user_name' => $user->name,
                            'user_email' => $user->email,
                            'user_role' => $user->role,
                            'logged_in' => TRUE
                        );
                        
                        $this->session->set_userdata($session_data);
                        $this->session->set_flashdata('success', 'Bienvenido ' . $user->name);
                        
                        redirect('admin');
                    } else {
                        $this->session->set_flashdata('error', 'Credenciales incorrectas. Verifique su email y contraseña.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Credenciales incorrectas. Verifique su email y contraseña.');
                }
            }
        }
        
        $data['title'] = 'Iniciar Sesión';
        $this->load->view('auth/login', $data);
    }
    
    public function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'Sesión cerrada correctamente');
        
        redirect('auth/login');
    }
}
