<?php


include dirname(__DIR__). '/engine/controller.php';

//$page = 'index';
//if (isset($_GET['page'])) {
//    $page = $_GET['page'];
//}
//$page = $_GET['page'] ?? 'index';

$url_array = explode('/', $_SERVER['REDIRECT_URL']);

switch ($url_array[1]) {
    case 'queries':
        include ROOT . $_SERVER['REDIRECT_URL'];
        die();

    case '':
        $page = 'index';
        break;

    default:
        $page = $url_array[1];
}

$params = prepareVariables($page, $calcArgs, $resultJS, $feedbackToChange);

echo render($page, $params);



