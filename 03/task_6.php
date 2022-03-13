<?php
$submenu = [
    'пункт 4' => [
        'name' => 'пункт 4',
        'link' => 'http:\\link4',
    ],
    'пункт 5' => [
        'name' => 'пункт 5',
        'link' => 'http:\\link5',
    ],
];

$menu = [
    'пункт 1' => [
        'name' => 'пункт 1',
        'link' => 'http:\\link1',
        'contains' => $submenu,
    ],
    'пункт 2' => [
        'name' => 'пункт 2',
        'link' => 'http:\\link2',
        'contains' => '',
    ],
    'пункт 3' => [
        'name' => 'пункт 3',
        'link' => 'http:\\link3',
    ],
];

function renderMenu($menu) {
    $str = '<ul>';
    foreach ($menu as $item => $attributes)
    {
        $link = $attributes['link'];
        $name = $attributes['name'];
        $str .= "<li><a href='$link'>$name</a>";
        if ($attributes['contains'] != '')
        {
            $str .= renderMenu($attributes['contains']);
        }
        $str .= "</li>";
    }
    $str .= '</ul>';
    return $str;
}
?>
<?=renderMenu($menu)?>



