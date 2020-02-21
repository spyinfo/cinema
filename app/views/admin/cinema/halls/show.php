<?php $this->layout('admin/layout', ['title' => 'Зал', 'second_title' => 'Cinema']); ?>

<style>
    .hall-plan {
    margin-top: 85px
    }

    .hall-plan__rectangle {
    width: 800px;
    height: 8px;
    margin: 0 auto;
    background: #59636b
    }

    .hall-plan__structure {
    margin-top: 56px
    }

    .hall-plan__counter {
    display: inline-block;
    font-size: 1.55rem;
    margin: 0 40px
    }

    .hall-plan__row {
    text-align: center
    }

    .hall-plan__place {
    width: 18px;
    height: 18px;
    background: #c4c4c4;
    display: inline-block;
    margin: 1px
    }

    .hall-plan__place:hover {
    background: #b70000;
    cursor: pointer
    }

    .hall-plan__place_not-active {
    background: #36393e
    }

    .hall-plan__place_not-active:hover {
    background: #36393e;
    cursor: default
    }

    .hall-plan__place_active {
    background: #b70000
    }

    .checkbox {
    display: none
    }

    .fake-checkbox {
    display: inline-block;
    width: 18px;
    height: 18px;
    background: #c4c4c4;
    margin: 1px;
    position: relative
    }

    .fake-checkbox:hover {
    background: #b7524d;
    cursor: pointer
    }

    .fake-checkbox::before {
    position: absolute;
    content: "";
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: block;
    width: 18px;
    height: 18px;
    background: #b70000;
    opacity: 0;
    transition: .2s
    }

    .fake-checkbox_not-active {
    background: #36393e
    }

    .fake-checkbox_not-active:hover {
    background: #36393e;
    cursor: default
    }
</style>
<div class="content-wrapper">
    <section class="content container-fluid">
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <a href="/admin/cinema/<?=$cinemaAndHall->id_cinema;?>/halls" class="btn btn-info">Назад</a>
                    <div class="box-header text-center">
                        <h2 class="box-title default-title">Кинотеатр: <?=$cinemaAndHall->name_cinema;?></h2> <br> <br>
                        <h2 class="box-title default-title"><?= $cinemaAndHall->name_hall;?></h2>
                    </div>
                    <div class="box-body">
                        <div class="hall-plan">
                            <div class="hall-plan__rectangle" style=""></div>
                            <div class="hall-plan__structure">
                                <?php foreach ($rows as $row):?>
                                    <div class="hall-plan__row">
                                        <div class="hall-plan__counter"><?= $row->start_place + array_search($row, $rows);?></div>
                                        <?php for ($i = intval($row->start_place); $i <= intval($row->finish_place); $i++):?>
                                            <label>
                                                <input type="checkbox" class="checkbox" data-row="<?= $row->id_row ;?>" data-place="<?= $i;?>">
                                                <span class="fake-checkbox"></span>
                                            </label>
                                        <?php endfor;?>
                                        <div class="hall-plan__counter"><?= $row->start_place + array_search($row, $rows);?></div>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>