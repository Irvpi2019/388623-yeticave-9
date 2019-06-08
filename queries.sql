USE YetiCave;

/* Добавление в БД необходимых данных */

INSERT INTO categories
SET name = 'Доски и лыжи', code = 'boards';
INSERT INTO categories
SET name = 'Крепления', code = 'attachment';
INSERT INTO categories
SET name = 'Ботинки', code = 'boots';
INSERT INTO categories
SET name = 'Одежда', code = 'clothing';
INSERT INTO categories
SET name = 'Инструменты', code = 'tools';
INSERT INTO categories
SET name = 'Разное', code = 'other';

INSERT INTO users (dt_add, email, name, password, info, avatar_path)
VALUES ('2019-02-12 09:46', 'i_pin@gmail.com', 'Irina Pinchuk', '123456pass', 'France', 'img/avatar1.jpg'),
       ('2019-03-15 17:20', 'mixx@mail.ru', 'Михаил Фролов', 'secret', 'tel. +330625017865', 'img/avatar2.jpg'),
       ('2019-04-23 15:19', 'lena_k@hotmail.com', 'Elena K', 'pass12345', 'Switzerland', 'img/avatar3.jpg'),
       (NOW(), 'cat_dog@rambler.ru', 'Baby', 'supersecret', 'cats and dogs', 'img/avatar4.jpg');


INSERT INTO lots (name, descr, cat_id, start_price, img_url, dt_add, dt_fin, rate_step, author_id)
VALUES
    ('2014 Rossignol District Snowboard', 'Легкий маневренный сноуборд', 1, 10999, 'img/lot-1.jpg', NOW(), NOW() + INTERVAL 10 DAY, '100', 1),
    ('DC Ply Mens 2016/2017 Snowboard', 'Легкий маневренный сноуборд', 1, 159999, 'img/lot-2.jpg', '2019-05-15 10:30', '2019-05-25 10:30','1000', 3),
    ('Крепления Union Contact Pro 2015 года размер L/XL', 'Крепления', 2, 8000, 'img/lot-3.jpg', NOW(), NOW() + INTERVAL 10 DAY, '100', 2),
    ('Ботинки для сноуборда DC Mutiny Charocal', 'Ботинки для сноуборда', 3, 10999, 'img/lot-4.jpg', '2019-05-28 19:40', '2019-06-07 19:40', '100', 1),
    ('Куртка для сноуборда DC Mutiny Charocal', 'Куртка для сноуборда', 4, 7500, 'img/lot-5.jpg', NOW() - INTERVAL 1 DAY, NOW() + INTERVAL 9 DAY, '100', 3),
    ('Маска Oakley Canopy', 'Маска', 6, 5400, 'img/lot-6.jpg', NOW(), NOW() + INTERVAL 10 DAY, '100', 4);

INSERT INTO rates (dt_add, sum_rate, user_id, lot_id)
VALUES (NOW(), '11099', '1', '1'), (NOW(), '161999', '2', '2'), (NOW() - INTERVAL 1 DAY, '160999', '2', '2')
       (NOW() - INTERVAL 1 DAY, '8100', '1', '3'), (NOW(), '11099', '3', '4'), (NOW() - INTERVAL 2 DAY, '7600', '2', '5');


/* Получение данных */

/*получить все категории*/
SELECT * FROM categories;

/*только названия категорий*/
SELECT name FROM categories;

/* Получить самые новые, открытые лоты.
   Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену, название категории */
SELECT l.name, l.dt_fin,start_price, img_url, MAX(sum_rate) as max_rate, c.name as category_name
   FROM lots l
INNER JOIN categories c ON l.cat_id = c.id
INNER JOIN rates r ON r.lot_id = l.id
   WHERE dt_fin > NOW()
   GROUP BY l.id
   ORDER BY l.dt_fin DESC
   LIMIT 9;

/*показать лот по его id. Получите также название категории, к которой принадлежит лот*/
SELECT l.id, l.name as lot_name, c.name as category_name
   FROM lots l
JOIN categories c ON l.cat_id = c.id
   WHERE l.id = 1;

/*обновить название лота по его идентификатору;*/
UPDATE lots SET name = '2014 Rossignol District Snowboard. Updated'
   WHERE id = 1;

/*получить список самых свежих ставок для лота по его идентификатору*/
SELECT id, sum_rate as last_rate FROM rates
   WHERE lot_id = 2
   ORDER BY dt_add DESC
   LIMIT 3;
