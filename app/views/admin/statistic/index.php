<?php $this->layout('admin/layout', ['title' => 'Статистика', 'second_title' => 'Statistic']); ?>

<div class="content-wrapper">
    <section class="content container-fluid">
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                </div>
                <div class="box-body">
                    <div class="box-header text-center">
                        <h2 class="box-title default-title">Статистика</h2>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Дата</th>
                                <th>Кол-во проданных билетов</th>
                                <th>Общая прибыль (руб.)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($statistics as $row):?>
                                <tr>
                                    <td><?= date("d F Y", strtotime($row->date))?></td>
                                    <td><?=$row->sales;?></td>
                                    <td><?= $row->profit;?></td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>
