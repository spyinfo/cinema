<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
                <input type="text" class="form__input" placeholder="Фамилия" name="surnam" maxlength="64" required>
            </label>
            <label>
                <input type="text" class="form__input" placeholder="Имя" name="name" maxlength="64" required>
            </label>
            <label>
                <input type="date" class="form__input" placeholder="Дата рождения" name="date_birth" required>
            </label>
            <label>
                <input type="text" class="form__input" placeholder="Логин" name="login" maxlength="32" required>
            </label>
            <label>
                <input type="password" class="form__input" placeholder="Пароль" name="password" maxlength="32" required>
            </label>
            <label>
                <input type="password" class="form__input" placeholder="Повторите пароль" name="repeat_password" maxlength="32" required>
            </label>
            <input type="submit" class="button form__button" value="Зарегистрироваться">
        </form>
    </div>
</section>
</body>
</html>
