<?php $this->layout('admin/layout', ['title' => 'Добавить зал', 'second_title' => 'Cinema']); ?>


<div class="content-wrapper">
    <section class="content container-fluid">
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="box-header">
                        <h2 class="box-title">Добавить зал для кинотеатра <strong><?=$cinema->name;?></strong></h2>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <form action="/admin/cinema/<?=$cinema->id;?>/halls/store" method="POST">
                                <div class="form-group">
                                    <label for="name">Название зала</label>
                                    <input type="text" class="form-control" maxlength="64" name="name" id="name" required>

                                    <label for="count_of_row">Количество рядов в зале</label>
                                    <input type="number" class="form-control" maxlength="64" name="count_of_row" id="count_of_row" required>
                                </div>

                                <div class="form-group">
                                    <a href="/admin/cinema/<?=$cinema->id;?>/halls" class="btn btn-dark">Назад</a>
                                    <input type="text" name="cinema" value="<?=$cinema->id;?>" hidden>
                                    <button class="btn btn-success pull-right" type="submit">Далее</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>