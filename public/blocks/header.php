<header>
    <div class="container menu">
        <div class="nav">
            <div class="logo">
                <img src="/public/img/logo.svg" alt="Logo">
                <span>Уберем все
                    <br>лишнее из ссылки!</span>
            </div>
            <div>
                <a href="/">Главная</a>
                <a href="/contact">Контакты</a>
                <a href="/contact/about">Про нас</a>
                <?php
                if($_COOKIE['login'] == ''):
                ?>
                <a href="/user/auth">Войти</a>
                <?php
                else:
                    ?>
                    <a href="/user/dashboard">Личный кабинет</a>
                <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</header>