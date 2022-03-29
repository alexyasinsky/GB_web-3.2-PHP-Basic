<?php

include 'task_3.php';

function mathOperation($a, $b, $operation)
{
    switch ($operation) {
        case "sum":
            return sum($a, $b);
            break;
        case "sub":
            return sub($a, $b);
            break;
        case "mult":
            return mult($a, $b);
            break;
        case "div":
            return div($a, $b);
            break;
        default:
            return 'неверный знак операции. введите "+", "-", "*" или "/"';
    }
}

//echo 'mathOperation(3, 2, "+") = ' . mathOperation(3, 2, "+") . PHP_EOL;
//echo 'mathOperation(4, 2, "-") = ' . mathOperation(4, 2, "-") . PHP_EOL;
//echo 'mathOperation(3, 2, "*") = ' . mathOperation(3, 2, "*") . PHP_EOL;
//echo 'mathOperation(3, 2, "/") = ' . mathOperation(3, 2, "/") . PHP_EOL;
//echo 'mathOperation(3, 0, "/") = ' . mathOperation(3, 0, "/") . PHP_EOL;