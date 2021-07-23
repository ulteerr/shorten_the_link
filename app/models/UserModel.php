<?php
require 'DB.php';

class UserModel
{
    private $login;
    private $email;
    private $pass;


    private $_db = null;

    public function __construct()
    {
        $this->_db = DB::getInstence();
    }

    public function setData($login, $email, $pass)
    {
        $this->login = $login;
        $this->email = $email;
        $this->pass = $pass;
    }

    public function validForm()
    {
        $result = $this->_db->query("SELECT * FROM `users` WHERE `login` = '$this->login' 
                         OR `email` = '$this->email'");
        $user = $result->fetch(PDO::FETCH_ASSOC);
        if (strlen($this->email) < 3)
            return "Email слишком короткий";
        else if ($user['email'] == $_POST['email'])
            return 'Пользователь с таким Email уже существует';
        else if (strlen($this->login) < 3)
            return "Логин слишком короткий";
        else if ($user['login'] == $_POST['login'])
            return 'Пользователь с таким Логином уже существует';
        else if (strlen($this->pass) < 3)
            return "Пароль не менее 3 символов";
        else
            return "Верно";
    }


    public function addUser()
    {
        $sql = 'INSERT INTO users(login, email, pass) VALUES(:login, :email, :pass)';
        $query = $this->_db->prepare($sql);

        $pass = password_hash($this->pass, PASSWORD_DEFAULT);
        $query->execute(['login' => $this->login, 'email' => $this->email, 'pass' => $pass]);

        $this->setAuth($this->login);

    }

    public function getUser()
    {
        $login = $_COOKIE['login'];
        $result = $this->_db->query("SELECT * FROM `users` WHERE `login` = '$login'");
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function logOut()
    {
        setcookie('login', $this->email, time() - 3600, '/');
        unset($_COOKIE['login']);
        header('Location: /user/auth');
    }

    public function auth($login, $pass)
    {
        $result = $this->_db->query("SELECT * FROM `users` WHERE `login` = '$login'");
        $user = $result->fetch(PDO::FETCH_ASSOC);

        if ($user['login'] == '')
            return 'Пользователя с таким логином не существует';
        else if (password_verify($pass, $user['pass']))
            $this->setAuth($login);
        else
            return 'Пароли не совпадают';
    }

    public function setAuth($login)
    {
        setcookie('login', $login, time() + 3600, '/');
        header('Location: /user/dashboard');
    }

}
