<?php $this->layout('admin/layout', ['title' => 'Фильмы', 'second_title' => 'Film']); ?>

<div class="content-wrapper">
    <section class="content container-fluid">
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                </div>
                <div class="box-body">
                    <div class="box-header text-center">
                        <h2 class="box-title default-title">Все фильмы</h2>
                    </div>
                    <div class="box-body">
                        <a href="/admin/film/create" class="btn btn-success">Добавить</a> <br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Номер категории</th>
                                <th>Длина (мин)</th>
                                <th>Картинка</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($films as $row):?>
                                <tr>
                                    <td><?= $row->name;?></td>
                                    <td><?= $row->id_category;?></td>
                                    <td><?= $row->length;?></td>
                                    <td class="text-center">
                                        <img src="data:image/jpeg;base64,<?= base64_encode($row->image);?>" alt="<?= $row->name;?>" width="100px" height="100px">
                                    </td>
                                    <td>
                                        <a href="/admin/film/<?= $row->id;?>/edit" class="btn btn-warning">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="/admin/film/<?= $row->id;?>/delete" class="btn btn-danger" onclick="return confirm('Вы действительно хотите удалить кинотеатр?');">
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

