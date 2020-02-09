<?php $this->layout('layout', ['title' => 'Сеанс']) ?>

<?php if ($session && $cinema):?>

<section class="section-session">
    <div class="container">
        <form action="/payment  " method="POST" class="form">
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
                        <?php
                            $isPlaceFound = Helpers::objectArraySearch($tickets, "id_row", $row->id_row);

                            if ($isPlaceFound):?>
                                <div class="hall-plan__row">
                                    <div class="hall-plan__counter"><?= $row->start_place + array_search($row, $rows);?></div>
                                <?php for ($i = intval($row->start_place); $i <= intval($row->finish_place); $i++):?>
                                        <?php if ($i == $isPlaceFound->id_place):?>
                                            <label>
                                                <input type="checkbox" class="checkbox" data-row="<?= $row->id_row ;?>" data-place="<?= $i;?>" disabled name="<?= $row->id_row . "-" . $i ;?>">
                                                <span class="fake-checkbox fake-checkbox_not-active"></span>
                                            </label>
                                        <?php else:?>
                                            <label>
                                                <input type="checkbox" class="checkbox"data-row="<?= $row->id_row ;?>" data-place="<?= $i;?>" name="<?= $row->id_row . "-" . $i ;?>">
                                                <span class="fake-checkbox"></span>
                                            </label>
                                        <?php endif;?>
                                <?php endfor;?>
                                    <div class="hall-plan__counter"><?= $row->start_place + array_search($row, $rows);?></div>
                                </div>

                            <?php else:?>
                                <div class="hall-plan__row">
                                    <div class="hall-plan__counter"><?= $row->start_place + array_search($row, $rows);?></div>
                                    <?php for ($i = intval($row->start_place); $i <= intval($row->finish_place); $i++):?>
                                        <label>
                                            <input type="checkbox" class="checkbox"data-row="<?= $row->id_row ;?>" data-place="<?= $i;?>" name="<?= $row->id_row . "-" . $i ;?>">
                                            <span class="fake-checkbox"></span>
                                        </label>
                                    <?php endfor;?>
                                    <div class="hall-plan__counter"><?= $row->start_place + array_search($row, $rows);?></div>
                                </div>
                            <?php endif;?>
                    <?php endforeach;?>
                </div>
            </div>

            <div class="selected-places text-center"></div>

            <div class="buttons-session">
                <div class="back">
                    <a href="/film/<?= $film->id ;?>" class="button">Назад</a>
                </div>

                <div class="buy">
                    <input type="submit" class="button default-button-form" value="Перейти к оформлению">
                </div>
            </div>
        </form>
    </div>
</section>

<?php else:?>

    <section class="section-session">
        <div class="container">
            <div class="session-not-find">
                К сожалению, такого сеанса не существует. <br>
                Возможно вы вручную изменили URL в браузере.

                <div class="back session-not-find__back">
                    <a href="/film/<?= $film->id ;?>" class="button">Назад</a>
                </div>
            </div>
        </div>
    </section>

<?php endif;?>
