<?php

function prepareVariables($page, $action) {

//Для каждой страницы готовим массив со своим набором переменных
//для подстановки их в соотвествующий шаблон
    $params = [];
    $params['auth'] = isAuth();
    $params['name'] = get_user();
    $params['statusMessage'] = setStatusMessage();
    $params['basketAmount'] = getBasketAmount();

    switch ($page) {

        case 'login':
            loginActions();
            break;

        case 'logout':
            unsetCookiesAndSession();
            header("Location: /?status=exit");
            die();

        case 'index':
            $params['title'] = 'Главная';
            break;

        case 'catalog':
            $params['title'] = 'Каталог';
            $params['styles'] = getStyles('catalog');
            $params['catalog'] = getCatalogFromDB();
            break;

        case 'product':
            $params['title'] = 'Товар';
            $params['styles'] = getStyles('catalog');
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

        case 'basket':
            $params['title'] = 'Корзина';
            $params['basket'] = getBasket();
            $params['total'] = getTotalCostOfBasket($params['basket']);
            break;

        case 'basketapi':
            doBasketActions($action);

        default:
            echo "404";
            die();
    }

    return $params;
}