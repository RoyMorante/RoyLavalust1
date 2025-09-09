<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->call->library('session');
        $this->call->library('form_validation');
        $this->call->model('StudentsModel');
    }

    /** LOGIN */
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->form_validation->name('email')->required()->valid_email()->max_length(100);
            $this->form_validation->name('password')->required()->min_length(6)->max_length(20);

            if ($this->form_validation->run()) {
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);

                $user = $this->StudentsModel->find_by_email($email);

                if ($user) {
                    // password check (you should use password_hash later)
                    if ($user['password'] === $password) {
                        $this->session->set_userdata('logged_in', true);
                        $this->session->set_userdata('user_id', $user['id']);
                        $this->session->set_userdata('role', $user['role']); // ✅ set role

                        if ($user['role'] === 'admin') {
                            redirect('students/get-all');
                        } else {
                            redirect('user/dashboard');
                        }
                        return;
                    } else {
                        $error = "Incorrect password.";
                    }
                } else {
                    $error = "Email not found.";
                }

                $this->call->view('auth/login', ['error' => $error]);
                return;
            }
        }

        $this->call->view('auth/login');
    }

    /** REGISTER (ADMIN ONLY) */
    public function register() {
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->form_validation->name('first_name')->required()->max_length(50);
            $this->form_validation->name('last_name')->required()->max_length(50);
            $this->form_validation->name('email')->required()->valid_email()->max_length(100);
            $this->form_validation->name('password')->required()->min_length(6)->max_length(20);

            if ($this->form_validation->run()) {
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);
                $role = $_POST['role'] ?? 'user'; // default role is user

                if ($this->StudentsModel->find_by_email($email)) {
                    $error = "Email already exists.";
                    $this->call->view('auth/register', ['error' => $error]);
                    return;
                }

                $this->StudentsModel->create_account([
                    'first_name' => $_POST['first_name'],
                    'last_name'  => $_POST['last_name'],
                    'email'      => $email,
                    'password'   => $password,
                    'role'       => $role
                ]);

                redirect('auth/login');
            }
        }

        $this->call->view('auth/register');
    }

    /** LOGOUT */
    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('role');
        redirect('auth/login');
    }
}
