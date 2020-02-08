<?php /** @noinspection PhpUndefinedVariableInspection */
$this->layout('layout', ['title' => 'Главная']) ?>


<section class="section-films">
    <div class="container">
        <div class="films">
            <div class="film">
                <div class="film__name">
                    <?= $films->name ;?>
                </div>
                <img src="data:image/jpeg;base64,<?= base64_encode($films->image);?>" alt="<?= $films->name; ?>" width="298px" height="298px">
                <div class="film__overlay">
                    <a href="/film/<?= $films->id;?>" class="film__link">Купить билет</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!--<form action="/test" method="POST" enctype="multipart/form-data">-->
<!--    <input type="file" name="file" required/>-->
<!--    <input type="submit">-->
<!--</form>-->