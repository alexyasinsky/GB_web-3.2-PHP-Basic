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

function mathOperation($a, $b, $operation) {
    switch ($operation) {
        case "+":
            return plus($a, $b);
            break;
        case "-":
            return minus($a, $b);
            break;
        case "*":
            return mult($a, $b);
            break;
        case "/":
            return div($a, $b);
            break;
        default:
            return 'неверный знак операции. введите "+", "-", "*" или "/"';
    }
}

echo 'mathOperation(3, 2, "+") = ' . mathOperation(3, 2, "+") . PHP_EOL;
echo 'mathOperation(4, 2, "-") = ' . mathOperation(4, 2, "-") . PHP_EOL;
echo 'mathOperation(3, 2, "*") = ' . mathOperation(3, 2, "*") . PHP_EOL;
echo 'mathOperation(3, 2, "/") = ' . mathOperation(3, 2, "/") . PHP_EOL;
echo 'mathOperation(3, 0, "/") = ' . mathOperation(3, 0, "/") . PHP_EOL;