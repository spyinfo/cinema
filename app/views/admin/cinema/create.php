<?php $this->layout('admin/layout', ['title' => 'Добавить кинотеатр', 'second_title' => 'Cinema']); ?>


<div class="content-wrapper">
    <section class="content container-fluid">
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="box-header">
                        <h2 class="box-title">Добавить кинотеатр</h2>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <form action="/admin/cinema/store" method="POST">
                                <div class="form-group">
                                    <label for="name">Название</label>
                                    <input type="text" class="form-control" maxlength="64" name="name" id="name" required>

                                    <label for="city">Город</label>
                                    <input type="text" class="form-control" maxlength="64" name="city" id="city" required>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="district">Район</label>
                                            <input type="text" class="form-control" maxlength="32" name="district" id="district" required>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="street">Улица</label>
                                            <input type="text" class="form-control" maxlength="64" name="street" id="street" required>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="house">Дом</label>
                                            <input type="text" class="form-control" maxlength="16" name="house" id="house" required>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <a href="/admin/cinema" class="btn btn-dark">Назад</a>
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