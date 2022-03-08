<?php
$regions = [
    'Московская область' => ['Москва', 'Зеленоград', 'Клин'],
    'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
];

foreach ($regions as $oblast => $cities)
{
    echo $oblast . ':' . PHP_EOL;
//    echo implode(", ", $cities) . '.' . PHP_EOL;
    $str = '';
    foreach ($cities as $city)
    {
        if (mb_substr($city, 0, 1) === 'К') $str .= $city . ', ';
    }
    if (mb_strlen($str) > 0)
    {
        $str[strlen($str) - 2] = '.';
        $str[strlen($str) - 1] = PHP_EOL;
    }
    echo $str;
}

