<?php

function prepareVariables($page, $action) {

    $params = [];
    $params['auth'] = isAuth();
    $params['name'] = get_user();
    $params['statusMessage'] = setStatusMessage();

    switch ($page) {

        case 'login':
            $login = mysqli_real_escape_string(getDb(), strip_tags(stripslashes($_POST['login'])));
            $password = strip_tags(stripslashes($_POST['password']));
            $action = $_POST['action'];
            loginActions($login, $password, $action);
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
            $params['layout'] = 'catalog';
            $params['catalog'] = getCatalogFromDB();
            break;

        case 'product':
            $params['title'] = 'Товар';
            $params['layout'] = 'catalog';
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
            break;

        default:
            echo "404";
            die();
    }

    return $params;
}