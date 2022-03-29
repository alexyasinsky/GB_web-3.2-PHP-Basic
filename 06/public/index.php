<?php


include dirname(__DIR__). '/engine/controller.php';

//$page = 'index';
//if (isset($_GET['page'])) {
//    $page = $_GET['page'];
//}
//$page = $_GET['page'] ?? 'index';

$url_array = explode('/', $_SERVER['REDIRECT_URL']);

if ($url_array[1] == 'queries') {
    include ROOT . $_SERVER['REDIRECT_URL'];
    die();
}

$url_array[1] == "" ? $page = 'index' : $page = $url_array[1];

$params = prepareVariables($page, $messages, $calcArgs, $resultJS);

echo render($page, $params);



