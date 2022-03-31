<?php

session_start();

include dirname(__DIR__) . "/config/config.php";
include ROOT . '/engine/controller.php';


//$page = 'index';
//if (isset($_GET['page'])) {
//    $page = $_GET['page'];
//}
//$page = $_GET['page'] ?? 'index';

$url_array = explode('/', $_SERVER['REDIRECT_URL']);

switch ($url_array[1]) {
    case '':
        $page = 'index';
        break;

    default:
        $page = $url_array[1];
}

$params = prepareVariables($page);

echo render($page, $params);



