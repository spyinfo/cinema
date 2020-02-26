<?php $this->layout('profile/layout', ['title' => 'Личный кабинет', 'h1' => 'Добро пожаловать в личный кабинет, ' . \App\components\Roles::getLogin() . '!']) ?>


<section class="section-profile-main">
    <div class="container">
        <div class="buttons text-center">
            <div>
                <a href="/profile/orders" class="button buttons__button">Заказы</a>
            </div>
            <div>
                <a href="#" class="button buttons__button" style="text-decoration: line-through">Настройки</a>
            </div>
            <div>
                <a href="/" class="button buttons__button">Перейти на сайт</a>
            </div>
            <div>
                <a href="/logout" class="button buttons__button">Выйти</a>
            </div>
        </div>
    </div>
</section>