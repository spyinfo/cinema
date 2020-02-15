<?php $this->layout('layout', ['title' => 'Оплата']) ?>

<section class="section-payment">
    <div class="container">
        <div class="payment">
            <h4>Оплата</h4>

            <div class="payment__info">
                <div class="payment__places-selected">
                    Мест выбрано: <?= $count ;?>
                </div>
                <div class="payment__cost">
                    Стоимость места: <?= $cost; ?> руб.
                </div>
                <div class="payment__total">
                    Итого к оплате: <span class="payment__sum"><?= $total; ?> руб.</span>
                </div>
            </div>

            <form action="/film/<?=$id;?>/ticket" method="POST">
            <?php foreach ($places as $place):?>
                <label>
                    <input type="text" name="<?= $place[0];?>-<?= $place[1];?>" hidden>
                </label>
            <?php endforeach;?>
            <div class="payment__button">
                <input type="text" hidden name="session" value="<?= $session ;?>">
                <input type="text" hidden name="hall" value="<?= $hall ;?>">
                <input type="submit" class="button default-button-form" value="Оплатить">
            </div>

            </form>
        </div>
    </div>
</section>