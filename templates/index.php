
<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <!--заполните этот список из массива категорий-->
            <?php foreach ($categories as $cat): ?>
            <li class="promo__item promo__item--boards">
                <a class="promo__link" href="pages/all-lots.html"><?=$cat ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">
            <!--заполните этот список из массива с товарами-->
            <?php foreach ($lots as $lot): ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?=$lot['picture']; ?>" width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?=$lot['category']; ?></span>
                    <h3 class="lot__title"><a class="text-link" href="pages/lot.html"><?=$lot['title']; ?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?=format_price($lot['price']); ?><b class="rub">р</b></span>
                        </div>
                        <div class="lot__timer timer

                            <?php
                              date_default_timezone_set("Europe/Moscow");
                              $ts_midnight = strtotime('tomorrow');
                              $sec_to_midnight = $ts_midnight - time();
                              $hours = floor($sec_to_midnight/3600);
                              $minutes = floor(($sec_to_midnight % 3600) / 60);

                                 if ($minutes < 10) {
                                  $minutes = '0' . $minutes;
                                 }
                              $time_to_midnight = $hours . ':' . $minutes;

                                 if ($sec_to_midnight <= 3600) {
                                  echo ' timer--finishing';
                                 }?>">
                                  <?=$time_to_midnight; ?>
                        </div>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>
</div>
