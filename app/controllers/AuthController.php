<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->call->model('UserModel');

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Show the login form.
     */
    public function login()
    {
        // Already logged in? Skip straight to the product list.
        if (!empty($_SESSION['user_id'])) {
            redirect('products');
        }

        $data['error'] = $_SESSION['login_error'] ?? null;
        unset($_SESSION['login_error']);

        $this->call->view('login_view', $data);
    }

    /**
     * Handle login form submission.
     */
    public function authenticate()
    {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = $this->UserModel->find_by('username', $username);

        if ($user && !empty($user['password']) && password_verify($password, $user['password'])) {
            // Prevent session fixation
            session_regenerate_id(true);

            $_SESSION['user_id']  = $user['id'];
            $_SESSION['username'] = $user['username'];

            redirect('products');
            return;
        }

        $_SESSION['login_error'] = 'Invalid username or password.';
        redirect('login');
    }

    /**
     * Log the user out.
     */
    public function logout()
    {
        $_SESSION = [];
        session_destroy();
        redirect('login');
    }
}