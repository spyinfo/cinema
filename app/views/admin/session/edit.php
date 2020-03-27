<?php $this->layout('admin/layout', ['title' => 'Изменить сеанс', 'second_title' => 'Session']); ?>


<div class="content-wrapper">
    <section class="content container-fluid">
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="box-header">
                        <h2 class="box-title">Изменить сеанс</h2>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <form action="/admin/session/<?=$session->id;?>/update" method="POST">
                                <div class="form-group">
                                    <label for="films">Фильм</label>
                                    <select name="films" id="films" class="form-control" required>
                                        <?php foreach ($films as $film):?>
                                            <?php if ($film->id == $session->id_film) :?>
                                                <option value="<?= $film->id; ?>" selected><?=$film->name;?></option>
                                            <?php else:?>
                                                <option value="<?= $film->id; ?>"><?=$film->name;?></option>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </select>

                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <label for="cinemas">Кинотеатр</label>
                                            <select name="cinemas" id="cinemas" class="form-control" required>
                                                <?php foreach ($cinemas as $cinema):?>
                                                    <?php if ($cinema->id == $session->id_cinema):?>
                                                        <option value="<?=$cinema->id;?>" selected><?=$cinema->name;?></option>
                                                    <?php else:?>
                                                        <option value="<?=$cinema->id;?>"><?=$cinema->name;?></option>
                                                    <?php endif;?>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for="halls">Залы</label>
                                            <select name="halls" id="halls" class="form-control" required>
                                                <option value="<?=$session->id_hall;?>" selected><?=$session->name_hall;?></option>
                                            </select>
                                            <div id="updated">Обновлено</div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-4">
                                            <label for="date">Дата</label>
                                            <input type="date" name="date" id="date" class="form-control" required value="<?=$session->date;?>">
                                        </div>
                                        <div class="col-4">
                                            <label for="time">Время</label>
                                            <input type="time" name="time" id="time" class="form-control" required value="<?=$session->time;?>">
                                        </div>
                                        <div class="col-4">
                                            <label for="cost">Цена</label>
                                            <input type="number" name="cost" id="cost" class="form-control" required value="<?=$session->cost;?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="flash-input">
                                    <?= flash(); ?>
                                </div>

                                <div class="form-group">
                                    <a href="/admin/session" class="btn btn-dark">Назад</a>
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
<script>
    const today = new Date().toISOString().split("T")[0];
    document.querySelector("#date").setAttribute("min", today);
</script>