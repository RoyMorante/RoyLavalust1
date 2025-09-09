<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class StudentsController extends Controller {
    private $upload_dir;
    private $upload_url;

    public function __construct() {
        parent::__construct();
        $this->call->library('pagination');
        $this->call->library('session');
        $this->call->model('StudentsModel');

        $this->upload_dir = realpath(__DIR__ . '/../../public/uploads') . '/';
        $this->upload_url = BASE_URL . 'public/uploads/';

        if (!is_dir($this->upload_dir)) {
            mkdir($this->upload_dir, 0777, true);
        }

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    /** GET ALL STUDENTS (ADMIN ONLY) */
    public function get_all($page = 1) {
        if ($this->session->userdata('role') !== 'admin') {
            redirect('user/dashboard');
            return;
        }

        $per_page = 5;
        $search   = isset($_GET['search']) ? trim($_GET['search']) : null;
        $show_deleted = isset($_GET['show']) && $_GET['show'] === 'deleted';

        $offset = ($page - 1) * $per_page;
        $limit_clause = "LIMIT {$offset}, {$per_page}";

        if ($show_deleted) {
            $total_rows = $this->StudentsModel->count_deleted_records($search);
            $base_url   = '/students/get-all?show=deleted';
            $records    = $this->StudentsModel->get_deleted_with_pagination($limit_clause, $search);
        } else {
            $total_rows = $this->StudentsModel->count_all_records($search);
            $base_url   = '/students/get-all';
            $records    = $this->StudentsModel->get_records_with_pagination($limit_clause, $search);
        }

        $pagination_data = $this->pagination->initialize($total_rows, $per_page, $page, $base_url, 5);

        $data = [
            'records'         => $records,
            'total_records'   => $total_rows,
            'per_page'        => $per_page,
            'page'            => $page,
            'pagination_data' => $pagination_data,
            'pagination_links'=> $this->pagination->paginate(),
            'search'          => $search,
            'show_deleted'    => $show_deleted,
            'upload_url'      => $this->upload_url
        ];

        $this->call->view('ui/get_all', $data);
    }

    /** CREATE STUDENT (ADMIN ONLY) */
    public function create() {
        if ($this->session->userdata('role') !== 'admin') {
            redirect('user/dashboard');
            return;
        }

        $this->call->library('form_validation');
        $error_message = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->form_validation->name('first_name')->required()->max_length(50);
            $this->form_validation->name('last_name')->required()->max_length(50);
            $this->form_validation->name('email')->required()->valid_email()->max_length(100);
            $this->form_validation->name('password')->required()->min_length(6)->max_length(20);

            if ($this->form_validation->run()) {
                $photo = null;
                if (isset($_FILES['photo']) && is_uploaded_file($_FILES['photo']['tmp_name'])) {
                    $this->call->library('upload', $_FILES['photo']);
                    $this->upload->set_dir($this->upload_dir)
                                 ->allowed_extensions(['jpg','jpeg','png','jfif'])
                                 ->allowed_mimes(['image/jpeg','image/png','image/jfif'])
                                 ->max_size(2)
                                 ->is_image();
                    if ($this->upload->do_upload()) {
                        $photo = $this->upload->get_filename();
                    }
                }

                $data = [
                    'first_name' => $_POST['first_name'],
                    'last_name'  => $_POST['last_name'],
                    'email'      => $_POST['email'],
                    'password'   => $_POST['password'], // plain text
                    'photo'      => $photo,
                    'role'       => $_POST['role'] ?? 'user'
                ];

                try {
                    $this->StudentsModel->insert($data);
                    redirect('students/get-all');
                } catch (PDOException $e) {
                    if (str_contains($e->getMessage(), 'Duplicate entry')) {
                        $error_message = "The email is already taken.";
                    } else {
                        $error_message = "Something went wrong: " . $e->getMessage();
                    }
                }
            }
        }

        $this->call->view('ui/create', ['error_message' => $error_message]);
    }

    /** ADMIN UPDATE USER */
    public function update($id) {
        if ($this->session->userdata('role') !== 'admin') {
            redirect('user/dashboard');
            return;
        }

        $this->call->library('form_validation');
        $contents = $this->StudentsModel->find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->form_validation->name('first_name')->required()->max_length(50);
            $this->form_validation->name('last_name')->required()->max_length(50);
            $this->form_validation->name('email')->required()->valid_email()->max_length(100);

            if ($this->form_validation->run()) {
                $photo = $contents['photo'];

                if (isset($_FILES['photo']) && is_uploaded_file($_FILES['photo']['tmp_name'])) {
                    $this->call->library('upload', $_FILES['photo']);
                    $this->upload->set_dir($this->upload_dir)
                                 ->allowed_extensions(['jpg','jpeg','png','jfif'])
                                 ->allowed_mimes(['image/jpeg','image/png','image/jfif'])
                                 ->max_size(2)
                                 ->is_image();
                    if ($this->upload->do_upload()) {
                        $photo = $this->upload->get_filename();
                    }
                }

                $data = [
                    'first_name' => $_POST['first_name'],
                    'last_name'  => $_POST['last_name'],
                    'email'      => $_POST['email'],
                    'password'   => !empty($_POST['password']) ? $_POST['password'] : $contents['password'], // plain text
                    'photo'      => $photo,
                    'role'       => $_POST['role'] ?? $contents['role']
                ];

                $this->StudentsModel->update($id, $data);
                redirect('students/get-all');
            }
        }

        $this->call->view('ui/update', ['user' => $contents, 'upload_url' => $this->upload_url]);
    }

    /** USER UPDATING OWN PROFILE */
    public function update_profile() {
        $id = $this->session->userdata('id');
        $contents = $this->StudentsModel->find($id);

        $this->call->library('form_validation');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->form_validation->name('first_name')->required()->max_length(50);
            $this->form_validation->name('last_name')->required()->max_length(50);
            $this->form_validation->name('email')->required()->valid_email()->max_length(100);

            if ($this->form_validation->run()) {
                $photo = $contents['photo'];

                if (isset($_FILES['photo']) && is_uploaded_file($_FILES['photo']['tmp_name'])) {
                    $this->call->library('upload', $_FILES['photo']);
                    $this->upload->set_dir($this->upload_dir)
                                 ->allowed_extensions(['jpg','jpeg','png','jfif'])
                                 ->allowed_mimes(['image/jpeg','image/png','image/jfif'])
                                 ->max_size(2)
                                 ->is_image();
                    if ($this->upload->do_upload()) {
                        $photo = $this->upload->get_filename();
                    }
                }

                $data = [
                    'first_name' => $_POST['first_name'],
                    'last_name'  => $_POST['last_name'],
                    'email'      => $_POST['email'],
                    'password'   => !empty($_POST['password']) ? $_POST['password'] : $contents['password'], // plain text
                    'photo'      => $photo
                ];

                $this->StudentsModel->update($id, $data);
                redirect('user/profile');
            }
        }

        $this->call->view('ui/profile', ['user' => $contents, 'upload_url' => $this->upload_url]);
    }

    public function delete($id) {
        if ($this->session->userdata('role') !== 'admin') {
            redirect('user/dashboard');
            return;
        }
        $this->StudentsModel->soft_delete($id);
        redirect('students/get-all');
    }

    public function hard_delete($id) {
        if ($this->session->userdata('role') !== 'admin') {
            redirect('user/dashboard');
            return;
        }
        $this->StudentsModel->hard_delete($id);
        redirect('students/get-all?show=deleted');
    }

    public function restore($id) {
        if ($this->session->userdata('role') !== 'admin') {
            redirect('user/dashboard');
            return;
        }
        $this->StudentsModel->restore($id);
        redirect('students/get-all?show=deleted');
    }
}
