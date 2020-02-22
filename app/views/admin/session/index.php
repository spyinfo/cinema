<?php $this->layout('admin/layout', ['title' => 'Сеансы', 'second_title' => 'Session']); ?>

<div class="content-wrapper">
    <section class="content container-fluid">
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                </div>
                <div class="box-body">
                    <div class="box-header text-center">
                        <h2 class="box-title default-title">Все сеансы</h2>
                    </div>
                    <div class="box-body">
                        <a href="/admin/session/create" class="btn btn-success">Добавить</a> <br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Фильм</th>
                                <th>Кинотеатр</th>
                                <th>Зал</th>
                                <th>Цена (руб.)</th>
                                <th>Дата</th>
                                <th>Время</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($sessions as $row):?>
                                <tr>
                                    <td><?= $row->name_film;?></td>
                                    <td><?=$row->name_cinema;?></td>
                                    <td><?= $row->name_hall;?></td>
                                    <td><?= $row->cost;?></td>
                                    <td><?=date('d.m.Y', strtotime($row->date));?></td>
                                    <td><?=date('H:i', strtotime($row->time));?></td>
                                    <td>
                                        <a href="/admin/film/<?= $row->id_session;?>/edit" class="btn btn-warning">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="/admin/film/<?= $row->id_session;?>/delete" class="btn btn-danger" onclick="return confirm('Вы действительно хотите удалить кинотеатр?');">
                                            <i class="fa fa-remove"></i>
                                        </a>
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