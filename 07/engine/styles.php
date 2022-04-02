<?php

function getStyles($page) {
    $styles = [
        'catalog' => ['catalog'],
        'basket' => ['basket']
    ];
    return $styles[$page];
}