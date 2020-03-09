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

        <div class="theatres">
            <h3 class="theatres__title text-center">Кинотеатры</h3>

            <div class="text-center">
                <label>
                    <input type="text" class="form-control theatres__date" min="2020-03-08" id="date-sessions" readonly>
                    <small class="theatres__desc">Кликните, чтобы выбрать дату</small>
                </label>
            </div>

            <?php if ($cinemas):?>
                <?php foreach ($cinemas as $cinema):?>
                    <div class="theatres__item">
                        <div class="theatres__about">
                            <div class="theatres__name">
                                <?= $cinema->name;?>
                            </div>
                            <div class="theatres__address">
                                <?= $cinema->street . " " . $cinema->house;?>
                            </div>
                        </div>
                        <div class="theatres__times">

                            <?php
                                $sessions = Helpers::getSessionsForFilms($film->id, $cinema->id, $date);
                                foreach ($sessions as $session):?>
                                    <a class="theatres__time"
                                       href="?time=<?=date("H.i", strtotime($session->time));?>&date=<?=date("d.m.Y", strtotime($session->date));?>&cinema=<?=$cinema->name;?>&hall=<?=$session->id_hall;?>">
                                            <?= date("H:i", strtotime($session->time));?>
                                    </a>
                            <?php endforeach;?>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php else:?>
                <div class="theatres__no-session">
                    К сожаленю, нет сеансов на выбранную дату<br>
                    Попробуйте выбрать другую дату!
                </div>
            <?php endif;?>
        </div>
    </div>
</section>


<?php $this->start('scripts');?>
    <script>
        const date = $("#date-sessions");
        const url = window.location.href;
        const dateURL = url.match(/date=(..........)/)[1].replace(/-/g, ".");

        $(date).datepicker({
            onSelect: function(dateText) {
                // console.log("Selected date: " + dateText + "; input's current value: " + this.value);
                const date = dateText.replace(/\./g, "-");
                const match = url.match(/film\/(\d+)/);
                const id = match[1];
                window.location = `http://cinema/film/${id}?date=${date}`;
            },
            minDate: 0
        });

        $(date).datepicker("option", "dateFormat", "dd.mm.yy");
        $(date).datepicker('setDate', dateURL);
    </script>
<?php $this->stop();?>
