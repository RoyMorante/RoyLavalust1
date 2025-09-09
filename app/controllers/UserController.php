<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->call->library('session');
        $this->call->model('StudentsModel');

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function profile() {
        $user_id = $this->session->userdata('user_id');
        $user = $this->StudentsModel->find($user_id);
        $this->call->view('ui/profile', ['user' => $user]);
    }

    public function dashboard() {
        $this->call->view('ui/dashboard');
    }
}
