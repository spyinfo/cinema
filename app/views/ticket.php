<?php $this->layout('layout', ['title' => 'Покупка билетов']) ?>

<section class="section-ticket">
    <div class="container">
        <div class="congratulations">
            <div class="congratulations__head text-center">
                Поздравляем, Вы успешно оплатили!
            </div>
            <div class="congratulations__ticket text-center">
                Вам необходимо распечатать билет!
            </div>

            <div class="print text-center">
                <a href="#" id="print" class="button">Распечатать</a>
            </div>
            <div class="congratulations__desc">
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
                            [<?=$place[0] . " ряд " . $place[1] . " место" ;?>]
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</section>
