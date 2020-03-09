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
                <input type="password" class="form__input" placeholder="Пароль" name="password" id="password" maxlength="16" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,16}" title="Пожалуйста, выполните все условия" required>
                <span class="conditions">
                        <span class="conditions__condition conditions__condition_error" id="length">Длина строки не менее 6 символов</span>
                        <span class="conditions__condition conditions__condition_error" id="lowercase">Имеет хотя бы 1 строчную букву</span>
                        <span class="conditions__condition conditions__condition_error" id="uppercase">Имеет хотя бы 1 прописную букву</span>
                        <span class="conditions__condition conditions__condition_error" id="number">Имеет хотя бы 1 цифру</span>
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
        const length = $("#length");
        const lowercase = $("#lowercase");
        const uppercase = $("#uppercase");
        const number = $("#number");

        $(passwordInput).on('focus', function () {
            $(".conditions").css('display', 'block');
        });

        $(passwordInput).on('blur', function () {
            $(".conditions").css('display', 'none');
        });

        $(passwordInput).on('keyup', function () {
            const value = $(this).val();

            // Lowercase
            validate(value.match(/[a-z]/g), lowercase);

            // Uppercase
            validate(value.match(/[A-Z]/g), uppercase);

            // Length
            validate(value.length >= 6, length);

            // Number
            validate(value.match(/[0-9]/g), number);
        });

        function validate(condition, element) {
            if (condition) {
                element.removeClass("conditions__condition_error");
                element.addClass("conditions__condition_success");
            } else {
                element.removeClass("conditions__condition_success");
                element.addClass("conditions__condition_error");
            }
        }
    });
</script>
</body>
</html>
