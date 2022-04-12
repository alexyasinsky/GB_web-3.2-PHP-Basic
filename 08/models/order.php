<?php

function doOrderActions($action, $auth) {
    switch ($action) {
        case 'checkout':
            $customerId = getCustomerId();
            $orderId = createOrder($customerId);
            generateBasketOrderedData($orderId, $auth);
            header("Content-type: application/json");
            $response['result'] = 1;
            echo json_encode($response);
            die();

    }
}

function getCustomerId() {
    $data = json_decode(file_get_contents('php://input'));
    $name = $data->name;
    $tel = $data->tel;
    if (!checkExistingOfCustomerDB($tel)) {
        createNewCustomer($tel, $name);
    };
    return executeSql("SELECT `id` FROM `customers` WHERE tel={$tel}");
}

function checkExistingOfCustomerDB($tel) {
    return getOneResult("SELECT `id` FROM `customers` WHERE tel={$tel}");
}

function createNewCustomer($tel, $name) {
    return executeSql("INSERT INTO `customers` (`tel`, `name`) VALUES ({$tel}, '{$name}')");
}

function createOrder($customerId) {
    executeSql("INSERT INTO `orders` (`customer_id`) VALUES ({$customerId})");
    $orderIds = getAssocResult("SELECT `id` FROM `orders` WHERE `customer_id` = $customerId");
    return $orderIds[count($orderIds)-1]['id'];
}

function generateBasketOrderedData($orderId, $auth) {
    if ($auth) {
        postponeBasketFromUnorderedToOrderedDB($orderId);
    } else {
        postponeBasketFromSessionStorageToOrderedDB($orderId);
    }
}

function postponeBasketFromUnorderedToOrderedDB($orderId) {
    $userId = $_SESSION['id'];
    $basket = getAssocResult("SELECT `product_id`, `amount` FROM `basket_unordered` WHERE `user_id` = {$userId}");
    foreach ($basket as $item) {
        putBasketToOrderedDB($orderId, $userId, $item['product_id'], $item['amount']);
    }
    deleteProductsFromBasketUnordered($userId);
}

function deleteProductsFromBasketUnordered($userId) {
    executeSql("DELETE FROM `basket_unordered` WHERE user_id={$userId}");
}

function putBasketToOrderedDB($orderId, $productId, $amount) {
    return executeSql("INSERT INTO `basket_ordered` (`order_id`, `product_id`, `amount`) VALUES ({$orderId}, {$productId}, {$amount})");
}

function postponeBasketFromSessionStorageToOrderedDB($orderId) {
    $basket = $_SESSION['basket'];
    foreach ($basket as $productId => $amount) {
        putBasketToOrderedDB($orderId, $productId, $amount);
    }
    deleteBasketFromSessionStorage();
}

function deleteBasketFromSessionStorage() {
    unset($_SESSION['basket']);
}







