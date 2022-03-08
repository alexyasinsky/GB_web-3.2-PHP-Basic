<?php

include 'task_4.php';
include 'task_5.php';

function format_and_transliterate($str, $alfabet) {
    $newStr = format_str($str);
    $newStr = transliterate($newStr, $alfabet);
    return $newStr;
}

echo format_and_transliterate($str, $alfabet);