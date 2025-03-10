<?php $this->layout('profile/layout', ['title' => 'Заказы', 'h1' => 'Ваши заказы, ' . \App\components\Roles::getLogin() . '!']) ?>

<section class="section-profile-main text-center" style="padding-top: 45px;">
    <a href="/profile" class="button">Назад</a>
    <table class="table table-hover table-dark" style="margin-top: 45px;">
        <thead>
        <tr class="section-profile-main__rows">
            <th scope="col">Дата и время</th>
            <th scope="col">Фильм</th>
            <th scope="col">Кинотеатр</th>
            <th scope="col">Зал</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $order):?>
            <tr>
                <td class="text-center"><?=date("d.m.Y", strtotime($order->date));?> <?=date("H:i", strtotime($order->time));?> </td>
                <td class="text-center"><?=$order->film_name;?></td>
                <td class="text-center"><?=$order->cinema_name;?></td>
                <td class="text-center"><?=$order->hall;?></td>
                <td class="text-center">
                    <a href="/profile/orders/ticket?session=<?=$order->id_session;?>" style="text-decoration: underline;">Распечатать билет</a>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</section>
