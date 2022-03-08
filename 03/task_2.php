<?php

$i = 0;

do
{
    switch ($i)
    {
        case 0:
            echo $i . ' - это ноль.' . PHP_EOL;
            break;
        case ($i % 2 === 0):
            echo $i . ' - это четное число.' . PHP_EOL;
            break;
        default:
            echo $i . ' - это нечетное число.' . PHP_EOL;
    }
    $i++;
} while ($i <= 10);