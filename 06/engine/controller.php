<?php

include "../config/config.php";


function prepareVariables($page, $calcArgs = [], $resultJS = 0, $feedbackToChange = []) {

//Для каждой страницы готовим массив со своим набором переменных
//для подстановки их в соотвествующий шаблон
    $params = [];
    $messages = getMessages();

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
            $params['catalog'] = getCatalogFromDB();
//            $params['catalog'] = getCatalog();
            break;

        case 'catalog_item':
            $params['title'] = 'Товар';
            $productId = (int)$_GET['product_id'];
            updateViewsOnProductInDB($productId);
            $params['feedbacks'] = getFeedbackOnProductFromDB($productId);
            $params['item'] = getOneProductFromDB($productId);
            $params['feedbackToChange'] = $feedbackToChange;
            break;

        case 'gallery':
            $params['title'] = 'Галерея';
//        $params['gallery'] = getFiles(VIEW_DIR);
            if (!empty($_FILES)) {
                loadImage();
            }
            $params['gallery'] = getGalleryFromDB();
            $params['message'] = $messages[$_GET['status']];
            break;

        case 'gallery_item':
            $params['title'] = 'Товар';
            $id = (int)$_GET['id'];
            updateViewsOnPictureInDB($id);
            $params['item'] = getOnePictureFromDB($id);
            break;

        case 'about':
            $params['title'] = 'О нас';
            $params['phone'] = 444333;
            break;

        case 'apicatalog':
            echo json_encode(getCatalog(), JSON_UNESCAPED_UNICODE);
            die();


        case 'calc':
            $params['title'] = 'Калькулятор';
            $params['arg1'] = $calcArgs['arg1'];
            $params['arg2'] = $calcArgs['arg2'];
            $params['operation'] = $calcArgs['operation'];
            $params['result'] = $calcArgs['result'] ?? 0;
            break;

        case 'calcJS':
            $params['title'] = 'Калькулятор на JS';
            $params['resultJS'] = $resultJS;
            break;

        default:
            echo "404";
            die();
    }

    return $params;
}