<?php $this->layout('admin/layout', ['title' => 'Изменить зал', 'second_title' => 'Cinema']); ?>


<div class="content-wrapper">
    <section class="content container-fluid">
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="box-header">
                        <h2 class="box-title">Измените начальное и конечные места для каждого ряда</h2>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <form action="/admin/cinema/<?=$cinema;?>/halls/<?=$hall;?>/edit-hall-places" method="POST">
                                <div class="form-group">
                                    <?php for ($i = 1; $i <= $rows; $i++):?>
                                        <?php $finishPlace = Helpers::getFinishPlace($hall, $i);?>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="start-<?=$i;?>">Начальное место (Ряд <?= $i;?>)</label>
                                                <input type="number" class="form-control" disabled value="1" name="start-<?=$i;?>">
                                            </div>
                                            <div class="col-6">
                                                <label for="<?=$i;?>">Конечное место (Ряд <?= $i;?>)</label>
                                                <input type="text" class="form-control" name="<?=$i;?>" value="<?=$finishPlace[0]->finish_place;?>">
                                            </div>
                                        </div>
                                    <?php endfor;?>
                                </div>

                                <div class="form-group">
                                    <a href="/admin/cinema/<?=$cinema;?>/halls" class="btn btn-dark">Назад</a>
                                    <input type="text" name="name" value="<?= $name ;?>" hidden>
                                    <input type="text" name="count_of_row" value="<?= $rows ;?>" hidden>
                                    <input type="text" name="cinema" value="<?= $cinema ;?>" hidden>
                                    <input type="text" name="hall" value="<?= $hall ;?>" hidden>
                                    <button class="btn btn-warning pull-right" type="submit">Изменить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>