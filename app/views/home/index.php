<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <meta name="description" content="Главная страница сайта" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/main.css" type="text/css" charset="utf-8">
    <link rel="stylesheet" href="/public/css/link.css" type="text/css" charset="utf-8">

</head>
<body>
    <?php require_once 'public/blocks/header.php'; ?>
    <div class="container main">
        <h1>Сокра.тим</h1>
        <span>Вам нужно сократить ссылку?
            <?php
            if($_COOKIE['login'] == ''):
            ?>
        Прежде чем это сделать<br> зарегистрируйтесь на сайте</span>
        <form action="" method="post" class="form-control">
            <input type="email" name="email" placeholder="Введите email" value="<?=$_POST['email']?>"><br>
            <input type="text" name="login" placeholder="Введите логин" value="<?=$_POST['login']?>"><br>
            <input type="password" name="pass" placeholder="Введите пароль" value="<?=$_POST['pass']?>"><br>
            <div class="error"><?=$data['message']?></div>
            <button class="btn" id="send">Зарегистрироваться</button>
        </form><br>
        <span>Есть аккаунт? Тогда вы можете <a href="/user/auth">авторизоваться</a></span>
        <?php
        else:
            ?>
            <form action="" method="post" class="form-control">
                <input type="url" name="url" placeholder="Введите URL" autocomplete="off">
                <input type="text" name="code" placeholder="Введите короткий" autocomplete="off">
                <div class="error"><?=$data['message']?></div>
                <br><br><button type="submit" class="btn" id="send">Уменьшить</button>
            </form><br><br>
            <?
                foreach($data['url'] as $el) {

                    echo '<div class="linkblock" id="'.$el['id'].'"><br>
              <b>Длинная ссылка:</b> <a href="'.$el['url'].'">'.$el['url'].'</a>,<br> <b>Короткая ссылка:</b> <a href="http://localhost/'.$el['code'].'">http://localhost/'.$el['code'].'</a>
              <br><br><button onclick="deleteLink(\''.$el['id'].'\')" class="btn btn-danger">Удалить<i class="fas fa-trash-alt"></i></button>
            </div><br><br>';
                }
                ?>
        <?php
        endif;
        ?>
    </div>
    <?php require_once 'public/blocks/footer.php'; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/public/js/ajax.js"></script>
</body>
</html>