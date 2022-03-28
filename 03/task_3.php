<?php
$regions = [
    'Московская область' => ['Москва', 'Зеленоград', 'Клин'],
    'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
];

foreach ($regions as $oblast => $cities)
{
    echo $oblast . ':' . PHP_EOL;
    echo implode(", ", $cities) . '.' . PHP_EOL;
}

