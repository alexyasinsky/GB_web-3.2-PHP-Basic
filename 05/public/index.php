<?php

include dirname(__DIR__) . "/config/config.php";

//$page = 'index';
//if (isset($_GET['page'])) {
//    $page = $_GET['page'];
//}
//$page = $_GET['page'] ?? 'index';

$url_array = explode('/', $_SERVER['REDIRECT_URL']);


if ($url_array[1] == "") {
    $page = 'index';
} else {
    $page = $url_array[1];
}

$params = [];

switch ($page) {
    case 'index':
        $params['title'] = 'Главная';
        break;

    case 'bux':
        $params['title'] = 'Бухи';
        $params['message'] = 'Файл загружен';
        $params['files'] = getFiles('doc');
        _log($params, 'bux');
        break;

    case 'catalog':
        $params['title'] = 'Каталог';
        $params['catalog'] = getCatalog();
        break;

    case 'gallery':
        $params['title'] = 'Галерея';
//        $params['gallery'] = getFiles(VIEW_DIR);
        $params['gallery'] = getGalleryFromDB();

        if (!empty($_FILES)) {
            loadImage();
        }
        $params['message'] = $messages[$_GET['status']];
        break;

    case 'gallery_item':
        $params['title'] = 'Картинка';
        $params['item'] = getOnePictureFromDB($_GET['id']);
        break;

    case 'about':
        $params['title'] = 'О нас';
        $params['phone'] = 444333;
        break;

    case 'apicatalog':
        echo json_encode(getCatalog(), JSON_UNESCAPED_UNICODE);
        die();

    default:
        echo "404";
        die();
}

echo render($page, $params);



