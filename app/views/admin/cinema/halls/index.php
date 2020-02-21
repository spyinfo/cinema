<?php $this->layout('admin/layout', ['title' => 'Залы', 'second_title' => 'Cinema']); ?>

<div class="content-wrapper">
    <section class="content container-fluid">
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                </div>
                <div class="box-body">
                    <div class="box-header text-center">
                        <h2 class="box-title default-title">Все залы кинотеатра <strong><?= $cinema->name ;?></strong></h2>
                    </div>
                    <div class="box-body">
                        <a href="/admin/cinema/<?=$cinema->id;?>/halls/create" class="btn btn-success">Добавить зал</a> <br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название зала</th>
                                <th>Количество рядов</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($halls as $row):?>
                                <tr>
                                    <td><?= $row->id;?></td>
                                    <td><?= $row->name;?></td>
                                    <td><?= $row->count_of_row;?></td>
                                    <td>
                                        <a href="/admin/cinema/<?=$cinema->id?>/halls/<?=$row->id;?>" class="btn btn-info">Схема зала</a>
                                        <a href="/admin/cinema/<?= $row->id;?>/edit" class="btn btn-warning">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="/admin/cinema/<?= $row->id;?>/delete" class="btn btn-danger" onclick="return confirm('Вы действительно хотите удалить этот зал?');">
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

