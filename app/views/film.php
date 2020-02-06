<?php $this->layout('layout', ['title' => "Фильм - " . $film->name]) ?>
<section class="section-film">
    <div class="container">
        <div class="about-film">
            <div class="about-film__img">
                <img src="data:image/jpeg;base64,<?= base64_encode($film->image);?>" alt="<?= $film->name;?>" width="298px" height="298px">
            </div>
            <div class="about-film__text">
                <div class="about-film__name">
                    <?= $film->name; ?>
                </div>
                <div class="about-film__description">
                    <?= $film->annotation; ?>
                </div>
            </div>
        </div>

        <!--   TODO доделать вывод на экран всех сеансов     -->

        <div class="theatres">
            <h3 class="theatres__title text-center">Кинотеатры</h3>

            <?php foreach ($cinemas as $cinema):?>

            <div class="theatres__item">
                <div class="theatres__about">
                    <div class="theatres__name">
                        <?= $cinema->name;?>
                    </div>
                    <div class="theatres__address">
<!--                        ул. Ходынский бульвар д. 4, ТЦ "АВИАПАРК".-->
                        <?= $cinema->street . " " . $cinema->house;?>
                    </div>
                </div>
                <div class="theatres__times">

                    <?php
                        $sessions = getSessionsForFilms($film->id, $cinema->id);

                        foreach ($sessions as $session):?>

                    <a class="theatres__time" href="?time=<?=date("H.i", strtotime($session->time));?>&date=<?=date("d.m.Y", strtotime($session->time));?>&cinema=<?=$cinema->name;?>">
                        <?= date("H:i", strtotime($session->time));?>
                    </a>
                    <?php endforeach;?>
                </div>
            </div>

            <?php endforeach;?>
        </div>
    </div>
</section>
