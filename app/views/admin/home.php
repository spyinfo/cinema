<?php $this->layout('admin/layout', ['title' => 'Панель управления сайтом', 'second_title' => 'Home']); ?>

<div class="content-wrapper">
    <section class="content container-fluid">
        <section class="content">
            <div class="box">
                <div class="box-body text-center p-5">
                    <h3>Здравствуйте <strong><?=\App\components\Roles::getLogin();?></strong>!</h3>
                    <h3>Добро пожаловать в панель управления содержимым сайта!</h3>
                </div>
            </div>
        </section>
    </section>
</div>