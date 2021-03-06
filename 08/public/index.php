<?php

session_start();

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include dirname(__DIR__) . "/config/config.php";
include ROOT . '/engine/controller.php';


//$page = 'index';
//if (isset($_GET['page'])) {
//    $page = $_GET['page'];
//}
//$page = $_GET['page'] ?? 'index';
$url = preg_replace('/\?[a-z0-9=_]*/','', $_SERVER['REQUEST_URI']);
$url_array = explode('/', $url);
$action = '';

switch ($url_array[1]) {
    case '':
        $page = 'index';
        break;

    default:
        $page = $url_array[1];
        if (isset($url_array[2])) {
            $action = $url_array[2];
        }
}

$params = prepareVariables($page, $action);
$layout = $params['layout'] ?? 'main';

echo render($page, $params, $layout);



