<?php /** @noinspection PhpUndefinedVariableInspection */
$this->layout('layout', ['title' => 'Главная']) ?>


<section class="section-films">
    <div class="container">
        <div class="films">
            <?php foreach ($films as $film):?>
            <div class="film">
                <div class="film__name">
                    <?= $film->name ;?>
                </div>
                <img src="data:image/jpeg;base64,<?= base64_encode($film->image);?>" alt="<?= $film->name; ?>">
                <div class="film__overlay">
                    <a href="/film/<?= $film->id . '?date=' . date("d-m-yy");?>" class="film__link">Купить билет</a>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</section>
