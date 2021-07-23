<?php

class Home extends Controller
{
    public function index()
    {
        $data = [];
        if (isset($_POST['email'])) {
            $user = $this->model('UserModel');
            $user->setData($_POST['login'], $_POST['email'], $_POST['pass']);

            $isValid = $user->validForm();
            if ($isValid == "Верно")
                $user->addUser();
            else
                $data['message'] = $isValid;
        }
        if (isset($_POST['url'])) {
            $link = $this->model('LinkModel');
            $url = $_POST['url'];
            $url = trim($url);
            $code = $_POST['code'];
            $user_name = $_COOKIE['login'];
            $link->setData($url, $code, $user_name);
            $isValid = $link->validForm();
            if ($isValid == "Верно")
                $link->addLink();
            else
                $data['message'] = $isValid;
        }
        $code = $_GET['url'];
        if (isset($_GET['url'])) {
            $link = $this->model('LinkModel');
            if ($url = $link->getUrl($code)) {
                header("Location: {$url}");
                exit();
            }
        }
        if (isset($_COOKIE['login'])) {
            $link = $this->model('LinkModel');
            $data['url'] = $link->getLink();
        }
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $link = $this->model('LinkModel');
            $link->deletelink($_POST['id']);
        }

        $this->view('home/index', $data);
    }

}