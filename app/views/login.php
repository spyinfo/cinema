<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap&subset=cyrillic" rel="stylesheet">
    <link rel="stylesheet" href="/static/css/main.css">
    <title>Login</title>
</head>
<body>
<section class="section-register">
    <div class="container">
        <a href="/" class="button">Назад</a>
        <h2 class="text-center">Вход в личный кабинет</h2>

        <form action="/login/check" method="POST" class="form form-register text-center">
            <label>
                <input type="text" class="form__input" placeholder="Логин" name="login">
            </label>
            <label>
                <input type="password" class="form__input" placeholder="Пароль" name="password">
            </label>
            <input type="submit" class="button form__button" value="Войти">
            <div class="flash-login">
                <?= flash(); ?>
            </div>
        </form>
    </div>
</section>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/main.js"></script>
</body>
</html>
