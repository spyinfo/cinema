<?php $this->layout('admin/layout', ['title' => 'Пользователи', 'second_title' => 'User']); ?>

<div class="content-wrapper">
    <section class="content container-fluid">
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                </div>
                <div class="box-body">
                    <div class="box-header text-center">
                        <h2 class="box-title default-title">Все пользователи</h2>
                    </div>
                    <div class="box-body">
                        <a href="/admin/session/create" class="btn btn-success">Добавить</a> <br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Логин</th>
                                <th>Фамилия</th>
                                <th>Имя</th>
                                <th>Роль</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($users as $row):?>
                                <tr>
                                    <td><?= $row->login;?></td>
                                    <td><?=$row->surname;?></td>
                                    <td><?= $row->name_user;?></td>
                                    <td><?= $row->name_role;?></td>
                                    <td>
                                        <?php if ($row->login == $_SESSION['user']->login):?>
                                            <a href="#" class="btn btn-danger disabled">
                                                Понизить
                                            </a>
                                        <?php else:?>
                                            <?php if ($row->id_role == 1):?>
                                                <a href="/admin/user/<?= $row->login;?>/raise" class="btn btn-success" onclick="return confirm('Вы действительно хотите повысить этого пользователя?')">
                                                    Повысить
                                                </a>
                                            <?php else:?>
                                                <a href="/admin/user/<?= $row->login;?>/lower" class="btn btn-danger" onclick="return confirm('Вы действительно хотите понизить этого пользователя?')">
                                                    Понизить
                                                </a>
                                            <?php endif;?>
                                        <?php endif;?>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>