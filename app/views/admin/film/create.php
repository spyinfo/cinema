<?php $this->layout('admin/layout', ['title' => 'Добавить фильм', 'second_title' => 'Film']); ?>


<div class="content-wrapper">
    <section class="content container-fluid">
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="box-header">
                        <h2 class="box-title">Добавить фильм</h2>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <form action="/admin/film/store" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Название</label>
                                    <input type="text" class="form-control" maxlength="255" name="name" id="name" >

                                    <label for="id_category">Категория</label>
<!--                                    <input type="text" class="form-control" maxlength="255" name="id_category" id="id_category" >-->
                                    <select class="form-control" name="id_category" id="id_category">
                                        <?php foreach($categories as $category): ?>
                                            <option value="<?= $category->id;?>"><?= $category->name;?></option>
                                        <?php endforeach;?>
                                    </select>

                                    <label for="length">Длительность (мин)</label>
                                    <input type="text" class="form-control" maxlength="255" name="length" id="length" >

                                    <label for="annotation">Аннотация</label>
                                    <textarea name="annotation" id="annotation" class="form-control" rows="15"></textarea>

                                    <input type="hidden" name="MAX_FILE_SIZE" value="8388608">

                                    <label for="image" class="mt-4">Изображение</label>
                                    <input type="file" accept=".jpg,.png,.jpeg,.gif" id="image" name="image">
                                    <small class="d-block">Максимальный размер - 8 Мб</small>
                                </div>

                                <div class="form-group">
                                    <a href="/admin/film" class="btn btn-dark">Назад</a>
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