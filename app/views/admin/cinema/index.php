<?php $this->layout('admin/layout', ['title' => 'Кинотеатры', 'second_title' => 'Cinema']); ?>

<div class="content-wrapper">
    <section class="content container-fluid">
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                </div>
                <div class="box-body">
                    <div class="box-header text-center">
                        <h2 class="box-title default-title">Все кинотеатры</h2>
                    </div>
                    <div class="box-body">
                        <a href="/admin/cinema/create" class="btn btn-success">Добавить</a> <br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Город</th>
                                    <th>Район</th>
                                    <th>Улица</th>
                                    <th>Дом</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($cinemas as $row):?>
                                <tr>
                                    <td><?= $row->name;?></td>
                                    <td><?= $row->city;?></td>
                                    <td><?= $row->district;?></td>
                                    <td><?= $row->street;?></td>
                                    <td><?= $row->house;?></td>
                                    <td>
                                        <a href="/admin/cinema/<?= $row->id;?>/edit" class="btn btn-warning">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="/admin/cinema/<?= $row->id;?>/delete" class="btn btn-danger" onclick="return confirm('Вы действительно хотите удалить кинотеатр?');">
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

