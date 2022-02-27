<?php

$x = 1;
$y = 2;

echo "x = $x, y = $y";
echo PHP_EOL;

//$x = $x + $y;
//$y = $x - $y;
//$x = $x - $y;

//$x = $x - $y = -$y + $x = $x + $y;

//$x = $x ^ $y; // 0001 XOR 0010 = 0011
//$y = $x ^ $y; //0011 XOR 0010 = 0001
//$x = $x ^ $y; // 0011 XOR 0001 = 0010

$y = $y ^ $x = $x ^ $y = $x ^ $y;

echo "x = $x, y = $y";