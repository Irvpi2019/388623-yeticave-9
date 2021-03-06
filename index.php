<?php
require_once('helpers.php');
require_once('functions.php');

$is_auth = rand(0, 1);
$user_name = 'Ирина Пинчук'; // укажите здесь ваше имя

// создание массивов

$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];
$lots = [
    [
        "title" => "2014 Rossignol District Snowboard",
        "category"   => "Доски и лыжи",
        "price" => 10999,
        "picture"   => "img/lot-1.jpg"
    ],
    [
        "title" => "DC Ply Mens 2016/2017 Snowboard",
        "category"   => "Доски и лыжи",
        "price" => 159999,
        "picture"   => "img/lot-2.jpg"
    ],
    [
        "title" => "Крепления Union Contact Pro 2015 года размер L/XL",
        "category"   => "Крепления",
        "price" => 8000,
        "picture"   => "img/lot-3.jpg"
    ],
    [
        "title" => "Ботинки для сноуборда DC Mutiny Charocal",
        "category"   => "Ботинки",
        "price" => 10999,
        "picture"   => "img/lot-4.jpg"
    ],
    [
        "title" => "Куртка для сноуборда DC Mutiny Charocal",
        "category"   => "Одежда",
        "price" => 7500,
        "picture"   => "img/lot-5.jpg"
    ],
    [
        "title" => "Маска Oakley Canopy",
        "category"   => "Разное",
        "price" => 5400,
        "picture"   => "img/lot-6.jpg"
    ]
];

/*
$con = mysqli_connect("localhost", "root", "","yeticave");
mysqli_set_charset($con, "utf8");

if ($con == false) {
    //$error = mysqli_connect_error();
    //$content = include_template('error.php', ['error' => $error]);
print("Ошибка подключения: " . mysqli_connect_error());

}
else {
    print("Соединение установлено");
}*/
// Пишем первую функцию
function format_price($price) {
    $price = ceil($price);
    if ($price >= 1000) {
        $price = number_format($price, 0, '' ,' ').' ₽';
    }
    return $price;
}



$page_content = include_template('index.php', [
    'categories' => $categories,
    'lots' => $lots

]);
$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'categories' => $categories,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'title' => 'Главная'
]);


print($layout_content);


?>
