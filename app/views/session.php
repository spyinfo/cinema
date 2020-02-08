<?php $this->layout('layout', ['title' => 'Сеанс']) ?>

<section class="section-session">
    <div class="container">
        <div class="about-film about-film_session">
            <div class="about-film__img">
                <img src="data:image/jpeg;base64,<?= base64_encode($film->image);?>" alt="<?= $film->name;?>" width="298px" height="298px">
            </div>
            <div class="about-film__text">
                <div class="about-film__name">
                    <?= $film->name; ?>
                </div>
                <div class="about-film__description">
                    <div class="theatres">
                        <div class="theatres__item">
                            <div class="theatres__about">
                                <div class="theatres__name theatres__name_session">
                                    <?= $_GET['cinema'];?>
                                </div>
                                <div class="theatres__address theatres__address_session">
                                    <?= $cinema->street . " " . $cinema->house;?>
                                </div>
                                <div class="theatres__date-time">
                                    <?= $_GET['date'] . " " . date("H:i", strtotime($_GET['time']));?>
                                </div>
                                <div class="theatres__hall">
                                    <?= $hall->name;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="hall-plan">
            <div class="hall-plan__rectangle"></div>
            <div class="hall-plan__structure">
                <?php foreach ($rows as $row):?>

                    <div class="hall-plan__row">
                        <div class="hall-plan__counter"><?= $row->start_place + array_search($row, $rows);?></div>
                    <?php for ($i = intval($row->start_place); $i <= intval($row->finish_place); $i++):?>
                            <div class="hall-plan__place" data-row="<?= $row->id_row ;?>" data-place="<?= $i;?>"></div>
                    <?php endfor;?>
                        <div class="hall-plan__counter"><?= $row->start_place + array_search($row, $rows);?></div>
                        </div>
                <?php endforeach;?>

<!--                <div class="hall-plan__row">-->
<!--                    <div class="hall-plan__counter">1</div>-->
<!--                    <div class="hall-plan__place"></div>-->
<!--                    <div class="hall-plan__place"></div>-->
<!--                    <div class="hall-plan__place hall-plan__place_not-active"></div>-->
<!--                    <div class="hall-plan__place hall-plan__place_not-active"></div>-->
<!--                    <div class="hall-plan__place hall-plan__place_not-active"></div>-->
<!--                </div>-->
            </div>
        </div>

        <div class="buy">
            <a href="#" class="button buy__button">Перейти к оформлению</a>
        </div>

    </div>
</section>