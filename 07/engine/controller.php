<?php

include "../config/config.php";


function prepareVariables($page) {

//Для каждой страницы готовим массив со своим набором переменных
//для подстановки их в соотвествующий шаблон
    $params = [];

    switch ($page) {
        case 'index':
            $params['title'] = 'Главная';
            break;

        case 'catalog':
            $params['title'] = 'Каталог';
            $params['catalog'] = getCatalogFromDB();
            break;

        case 'product':
            $params['title'] = 'Товар';
            $productId = (int)$_GET['product_id'];
            updateViewsOnProductInDB($productId);
            if (isset($_REQUEST['feedback'])) {
                $params['feedbackToChange'] = doFeedbackAction($_REQUEST['feedback']);
            }
            $params['feedbacks'] = getFeedbackOnProductFromDB($productId);
            $params['item'] = getOneProductFromDB($productId);
            break;

        case 'about':
            $params['title'] = 'О нас';
            $params['phone'] = 444333;
            break;

        default:
            echo "404";
            die();
    }

    return $params;
}