<?php

class MY_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }
}

class Admin_controller extends MY_controller {
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', 'Debe iniciar sesión para acceder.');
            redirect('auth/login');
        }
    }

    public function check_admin()
    {
        if ($this->session->userdata('user_role') !== 'admin') {
            show_error('No tiene permisos para acceder a esta sección', 403);
        }
    }
}