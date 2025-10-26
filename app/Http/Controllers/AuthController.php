<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
class AuthController extends Controller
{

    private $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
    }
    public function register_view()
    {
        view('register');
    }

    public function login_view()
    {
        view('login');
    }

    public function register_post()
    {
        if (isset($_POST['submit'])) {
            $user = $this->userModel->getByEmail($_POST);
            if ($user) {
                $_SESSION['error'] = 'Email sudah digunakan';
                $this->redirect('/register');
                exit;
            } else {
                $this->userModel->registerUser($_POST);
                $this->redirect('/login');
            }
        }
    }
    public function login_post()
    {
        if (isset($_POST['submit'])) {
            $user = $this->userModel->checkCredential($_POST);

            if ($user) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ];
                $this->redirect('/home');
                exit;
            } else {
                $_SESSION['error'] = 'Email atau password salah';
                $this->redirect('/login');
                exit;
            }
        }
    }

    public function logout() {
          if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $_SESSION = [];
        
        session_destroy();
        
        $this->redirect('/login');
        exit;
    }
}
