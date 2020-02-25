<?php $this->layout('admin/layout', ['title' => 'Добавить сеанс', 'second_title' => 'Session']); ?>


<div class="content-wrapper">
    <section class="content container-fluid">
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="box-header">
                        <h2 class="box-title">Добавить сеанс</h2>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <form action="/admin/session/store" method="POST">
                                <div class="form-group">
                                    <label for="films">Фильм</label>
                                    <select name="films" id="films" class="form-control">
                                        <option selected disabled>--- Выберите фильм ---</option>
                                        <?php foreach ($films as $film):?>
                                            <option value="<?= $film->id; ?>"><?=$film->name;?></option>
                                        <?php endforeach;?>
                                    </select>

                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <label for="cinemas">Кинотеатр</label>
                                            <select name="cinemas" id="cinemas" class="form-control">
                                                <option value="0" selected disabled>--- Выберите кинотеатр ---</option>
                                                <?php foreach ($cinemas as $cinema):?>
                                                    <option value="<?=$cinema->id;?>"><?=$cinema->name;?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for="halls">Залы</label>
                                            <select name="halls" id="halls" class="form-control">
                                                <option selected disabled>--- Выберите зал ---</option>
                                            </select>
                                            <div id="updated">Обновлено</div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-4">
                                            <label for="date">Дата</label>
                                            <input type="date" name="date" id="date" class="form-control" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="time">Время</label>
                                            <input type="time" name="time" id="time" class="form-control" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="cost">Цена</label>
                                            <input type="number" name="cost" id="cost" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="flash-input">
                                    <?= flash(); ?>
                                </div>

                                <div class="form-group">
                                    <a href="/admin/session" class="btn btn-dark">Назад</a>
                                    <button class="btn btn-success pull-right" type="submit">Добавить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>