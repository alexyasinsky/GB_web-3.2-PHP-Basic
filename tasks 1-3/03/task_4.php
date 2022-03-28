<?php
$alfabet = [
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya'
		];

$str = 'Привет, мир';
//echo transliterate($str, $alfabet);

function transliterate($str, $alfabet)
{
    $newStr = '';
//    $newStr = strtr($str, $alfabet);

    for ($i = 0; $i <= mb_strlen($str); $i++)
    {
        $char = mb_substr($str, $i, 1);
        if (mb_strtolower($char) !== $char) {
            $char = mb_strtolower($char);
            $upperCase = true;
        } else $upperCase = false;
        if (array_key_exists($char, $alfabet) && $upperCase)
        {
            $newStr .= ucfirst($alfabet[$char]);
//            $newStr .= ucfirst(strtr($char, $alfabet));
        } elseif (array_key_exists($char, $alfabet))
        {
            $newStr .= $alfabet[$char];
//            $newStr .= strtr($char, $alfabet);
        } else
        {
          $newStr .= $char;
        }
    }
    return $newStr;
}



		