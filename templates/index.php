<?php
require_once('functions.php');

$con = mysqli_connect("localhost", "root", "","yeticave");
mysqli_set_charset($con, "utf8");

if ($con == false) {
    print("Ошибка подключения: " . mysqli_connect_error());
}
else {
?>

<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <?php $sql = "SELECT id, name FROM categories ORDER BY id";
            $result = mysqli_query($con, $sql);
            $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
            ?>
            <!--заполнение списка из БД категорий-->
            <?php foreach ($categories as $cat): ?>
            <li class="promo__item promo__item--<?=$cat['code']; ?>">
                <a class="promo__link" href="pages/all-lots.html"><?=$cat['name'] ?></a>
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
            <?php
            // выполнение запросов
            // Получить самые новые, открытые лоты
            $sql = "SELECT l.name, start_price, img_url, MAX(sum_rate) as max_rate, c.name as category_name
               FROM lots l
            INNER JOIN categories c ON l.cat_id = c.id
            INNER JOIN rates r ON r.lot_id = l.id
               WHERE dt_fin > NOW()
               GROUP BY l.id
               ORDER BY l.dt_fin DESC
               LIMIT 9";
            $result = mysqli_query($con, $sql);
            if (!$result) {
            $error = mysqli_error($con);
            print("Ошибка MySQL: " . $error);
            }
            $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);

            foreach ($lots as $lot):  ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?=$lot['img_url']; ?>" width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?=$lot['category_name']; ?></span>
                    <h3 class="lot__title"><a class="text-link" href="pages/lot.html"><?=$lot['name']; ?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?=format_price($lot['start_price']); ?><b class="rub">р</b></span>
                        </div>
                        <div class="lot__timer timer <?=is_last_hour('tomorrow') ? "timer--finishing" : '' ?>">
                               <?=get_time_to_timer("tomorrow") ?>

                        </div>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>
</div>
<?php } ?>
