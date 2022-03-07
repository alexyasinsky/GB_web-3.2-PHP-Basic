<?php

function plus($a, $b) {
    return $a + $b;
}

function minus($a, $b) {
    return $a - $b;
}

function mult($a, $b) {
    return $a * $b;
}

function div($a, $b) {
    return $b !== 0 ? $a / $b : 'ошибка деления на 0';
}

echo 'plus(3, 2) = ' . plus(3, 2) . PHP_EOL;
echo 'minus(10, 6) = ' . minus(10, 6) . PHP_EOL;
echo 'mult (10, 4) = ' . mult(10, 4) . PHP_EOL;
echo 'div (5, 2) = ' . div(5 ,2) . PHP_EOL;
echo 'div (5, 0) = ' . div(5 ,0) . PHP_EOL;
