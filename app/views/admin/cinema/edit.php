<?php $this->layout('admin/layout', ['title' => 'Изменить кинотеатр', 'second_title' => 'Cinema']); ?>


<div class="content-wrapper">
    <section class="content container-fluid">
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="">
                        <div class="box-header">
                            <h2 class="box-title news-title">Изменить кинотеатр</h2>
                        </div>
                        <div class="box-body">
                            <div class="col-md-6">
                                <form action="/admin/cinema/<?=$cinema->id;?>/update" method="POST">
                                    <div class="form-group">
                                        <label for="name">Название</label>
                                        <input type="text" class="form-control" maxlength="64" name="name" id="name" required value="<?= $cinema->name ;?>">

                                        <label for="city">Город</label>
                                        <input type="text" class="form-control" maxlength="64" name="city" id="city" required value="<?= $cinema->city ;?>">

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label for="district">Район</label>
                                                <input type="text" class="form-control" maxlength="32" name="district" id="district" value="<?= $cinema->district ;?>">
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="street">Улица</label>
                                                <input type="text" class="form-control" maxlength="64" name="street" id="street" required value="<?= $cinema->street ;?>">
                                            </div>
                                            <div class="col-lg-2">
                                                <label for="house">Дом</label>
                                                <input type="text" class="form-control" maxlength="16" name="house" id="house" required value="<?= $cinema->house ;?>">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <a href="/admin/cinema" class="btn btn-dark">Назад</a>
                                        <button class="btn btn-warning pull-right" type="submit">Изменить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>




