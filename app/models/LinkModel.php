<?php
require 'DB.php';

class LinkModel
{
    private $url;
    private $code;
    private $user_name;


    private $_db = null;

    public function __construct()
    {
        $this->_db = DB::getInstence();
    }

    public function setData($url, $code, $user_name)
    {
        $this->url = $url;
        $this->code = $code;
        $this->user_name = $user_name;
    }

    public function validForm()
    {
        $result = $this->_db->query("SELECT * FROM `links` WHERE `code` = '$this->code'");
        $link = $result->fetch(PDO::FETCH_ASSOC);

        if ($link['code'] == $_POST['code'])
            return 'Такое сокращение уже используется в базе';
        else
            return "Верно";
    }

    public function addLink()
    {
        $this->_db->query("INSERT INTO links(url, created) VALUES('{$this->url}', NOW())");
        $this->_db->query("UPDATE links SET code = '{$this->code}', avtor = '{$this->user_name}' WHERE url = '{$this->url}'");
        return $this->code;

    }

    public function getUrl($code)
    {
        $code = $this->_db->query("SELECT url FROM links WHERE code = '$code'");
        return $code->fetchObject()->url;

    }

    public function getLink()
    {
        $avtor = $_COOKIE['login'];
        $result = $this->_db->query("SELECT * FROM `links`  WHERE avtor ='$avtor'");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deletelink($id)
    {
        $sql = 'DELETE FROM `links` WHERE `id` = :id';
        $query = $this->_db->prepare($sql);
        $query->execute(['id' => $id]);
    }


}