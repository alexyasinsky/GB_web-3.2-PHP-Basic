<?php



error_reporting(E_ALL);


if (!empty($_GET)) {
    $calcArgs = [
        'arg1' => $_GET['arg1'],
        'arg2' => $_GET['arg2'],
        'operation' => $_GET['operation']
    ];

    $calcArgs['result'] = mathOperation($calcArgs['arg1'], $calcArgs['arg2'], $calcArgs['operation']);

}


