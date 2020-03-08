<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/static/icon/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/static/icon/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap&subset=cyrillic" rel="stylesheet">
    <link rel="stylesheet" href="/static/css/main.css">
    <title>Регистрация</title>
</head>
<body>
<section class="section-register">
    <div class="container">
        <a href="/" class="button">Назад</a>
        <h2 class="text-center">Регистрация</h2>

        <form action="/register/store" method="POST" class="form form-register">
            <label>
                <input type="text" class="form__input" placeholder="Фамилия" name="surname" maxlength="64" required>
            </label>
            <label>
                <input type="text" class="form__input" placeholder="Имя" name="name" maxlength="64" required>
            </label>
            <label class="login-label">
                <input type="text" class="form__input" placeholder="Логин" name="login" id="login" maxlength="32" required>
            </label>
            <div id="exist"></div>
            <label class="text-center">
                <input type="password" class="form__input" placeholder="Пароль" name="password" id="password" maxlength="32" required>
                <span id="conditions" style="display: none;">
                    <span style="color: red; display: block">Строка должна содержать 1 заглавную букву</span>
                    <span style="color: red; display: block">Строка должна содержать 1 цифру</span>
                    <span style="color: red; display: block">Строка должна содержать 1 заглавную букву</span>
                </span>
            </label>
            <input type="submit" class="button form__button" value="Зарегистрироваться" id="register" disabled>
        </form>
    </div>
</section>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/main.js"></script>
<script>
    $(function () {
        const passwordInput = $("#password");

        $(passwordInput).on('focus', function () {
            $("#conditions").css('display', 'block');
        });

        $(passwordInput).on('focusout', function () {
            $("#conditions").css('display', 'none');
        });
    });
</script>
</body>
</html>
