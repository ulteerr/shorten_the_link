<?php

class User extends Controller
{
    public function dashboard()
    {

        $user = $this->model('UserModel');

        if (isset($_POST['exit_btn'])) {
            $user->logOut();
            exit();
        }
        $this->view('user/dashboard', $user->getUser());
    }

    public function auth()
    {

        $data = [];
        if (isset($_POST['login'])) {
            $user = $this->model('UserModel');
            $data['message'] = $user->auth($_POST['login'], $_POST['pass']);
        }

        $this->view('user/auth', $data);
    }

}