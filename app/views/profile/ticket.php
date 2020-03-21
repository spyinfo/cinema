<?php $this->layout('profile/layout', ['title' => 'Заказы', 'h1' => 'Распечатать билет']) ?>

<div class="congratulations text-center" style="padding-top: 35px;">
    <a href="/profile/orders" class="button">Назад</a>
    <div class="congratulations__desc" id="print-ticket" style="margin-bottom: 20px;">
        <div class="congratulations__film text-center">
            <strong><?=$sessionInfo->name_film;?></strong>
        </div>
        <div class="congratulations__main">
            <div>
                <div class="congratulations__cinema">
                    <?=$sessionInfo->name_cinema;?>
                </div>
                <div class="congratulations__address">
                    <?=$sessionInfo->street . " д. " . $sessionInfo->house;?>
                </div>
            </div>
            <div class="text-right">
                <div>
                    <?=$sessionInfo->name_hall;?>
                </div>
                <div class="congratulations__date_time">
                    <?=date("d.m.Y", strtotime($sessionInfo->date)) . " " . date("H:i", strtotime($sessionInfo->time));?>
                </div>
            </div>
        </div>
        <div class="congratulations__places text-center">
            <span class="border">Места</span>
            <?php foreach ($places as $place):?>
                <div>
                    [<?=$place->id_row . " ряд " . $place->id_place . " место" ;?>]
                </div>
            <?php endforeach;?>
        </div>
    </div>
    <small>Обновите страницу, чтобы распечатать билет!</small>
</div>