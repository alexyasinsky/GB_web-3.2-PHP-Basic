<?php

$a = random_int(PHP_INT_MIN, PHP_INT_MAX);
$b = random_int(PHP_INT_MIN, PHP_INT_MAX);

if ($a >= 0 && $b >= 0)
{
    echo 'a и b положительные';
} elseif ($a <= 0 && $b <= 0)
{
    echo 'a и b отрицательные';
} else
{
    echo 'a и b разных знаков';
}
