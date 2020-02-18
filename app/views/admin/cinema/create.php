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
                            <form action="/admin/news/store" method="POST">
                                <div class="form-group">
                                    <label for="title">Название</label>
                                    <input type="text" class="form-control" maxlength="255" name="title" id="title" required>

                                    <label for="text">Город</label>
                                    <input type="text" class="form-control" maxlength="255" name="title" id="title" required>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="text">Район</label>
                                            <input type="text" class="form-control" maxlength="255" name="title" id="title" required>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="text">Улица</label>
                                            <input type="text" class="form-control" maxlength="255" name="title" id="title" required>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="text">Дом</label>
                                            <input type="text" class="form-control" maxlength="255" name="title" id="title" required>
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