<?php
class UserController extends Controller{
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('UserModel');
    }

    public function index() {
        $users = $this->userModel->getAllUsers();
        view('user', $users);
    }
}
