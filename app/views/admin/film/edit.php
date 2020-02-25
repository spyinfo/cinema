<?php $this->layout('admin/layout', ['title' => 'Изменить фильм', 'second_title' => 'Film']); ?>


<div class="content-wrapper">
    <section class="content container-fluid">
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <div class="box-header">
                        <h2 class="box-title">Изменить фильм</h2>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <form action="/admin/film/<?=$film->id;?>/update" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Название</label>
                                    <input type="text" class="form-control" maxlength="255" name="name" id="name" value="<?=$film->name;?>">

                                    <label for="id_category">Категория</label>
                                    <select class="form-control" name="id_category" id="id_category">
                                        <?php foreach($categories as $category): ?>
                                            <?php if ($category->id == $film->id_category):?>
                                                <option value="<?= $category->id;?>" selected><?= $category->name;?></option>
                                            <?php else:?>
                                                <option value="<?= $category->id;?>"><?= $category->name;?></option>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </select>

                                    <label for="length">Длительность (мин)</label>
                                    <input type="text" class="form-control" maxlength="255" name="length" id="length" value="<?=$film->length;?>">

                                    <label for="annotation">Аннотация</label>
                                    <textarea name="annotation" id="annotation" class="form-control" rows="12"><?=$film->annotation;?></textarea>

                                    <input type="hidden" name="MAX_FILE_SIZE" value="8388608">

                                    <label for="image" class="mt-4">Изображение</label>
                                    <input type="file" accept=".jpg,.png,.jpeg,.gif" id="image" name="image">
                                    <small class="d-block">Максимальный размер - 8 Мб</small>

                                    <div class="mt-3 d-flex flex-column">
                                        <span class="mb-1"><strong>Текущая картинка</strong></span>
                                        <img src="data:image/jpeg;base64,<?= base64_encode($film->image);?>" alt="<?= $film->name;?>" width="268px" height="268px">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <a href="/admin/film" class="btn btn-dark">Назад</a>
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