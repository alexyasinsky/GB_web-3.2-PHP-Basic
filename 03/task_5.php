<?php

$str_to_format = 'Написать функцию, которая заменяет в строке пробелы на подчеркивания и возвращает видоизмененную строчку. Можно через str_replace';

function format_str($str)
{
    return str_replace(" ", "_", $str);
}

//echo format_str($str_to_format);



