<?php

function putProductIntoBasket() {
    $data = json_decode(file_get_contents('php://input'));
    $productId = $data->productId;
    $userId = $_SESSION['id'];
    if (isset($_SESSION['login'])) {
        putProductIntoBasketDB($userId, $productId);
    } else {
        putProductIntoBasketSessionStorage($productId);
    }
}

function deleteProductFromBasket() {
    $data = json_decode(file_get_contents('php://input'));
    $productId = $data->productId;
    $amount = $data->amount;
    $basketItemId = $data->basketItemId;
    if (isset($_SESSION['login'])) {
        $userId = $_SESSION['id'];
        deleteProductFromBasketInDB($basketItemId, $userId, $amount);
    } else {
        deleteProductFromBasketInSessionStorage($productId, $amount);
    }
}

function deleteProductFromBasketInDB($basketItemId, $userId, $amount) {
    if ($amount == 1) {
        return executeSql("DELETE FROM `basket` WHERE id={$basketItemId} AND user_id={$userId}");
    } else {
        return executeSql("UPDATE `basket` SET amount = amount - 1 WHERE id={$basketItemId} AND user_id={$userId}");
    }
}

function deleteProductFromBasketInSessionStorage($productId, $amount) {
    if ($amount == 1) {
        unset($_SESSION['basket'][$productId]);
    } else {
        $_SESSION['basket'][$productId] = $_SESSION['basket'][$productId] - 1;
    }
}

function getBasket() {

    if (isset($_SESSION['login'])) {
        $userId = $_SESSION['id'];
        return getBasketFromDB($userId);
    } else {
        return getBasketFromSessionStorage();
    }
}
function getBasketFromDB($userId) {
    return getAssocResult("SELECT basket.id, basket.product_id, basket.amount, catalog.name, catalog.price, catalog.image FROM `basket` JOIN `catalog` ON basket.product_id = catalog.id WHERE `user_id` = {$userId}");
}

function getBasketFromSessionStorage() {
    $basketSimple = $_SESSION['basket'];
    $basketAdvanced = [];
    if (!empty($basketSimple)) {
        foreach ($basketSimple as $productId => $amount) {
            $productFromDB = getOneResult("SELECT * FROM `catalog` WHERE id={$productId}");
            $product = array_merge($productFromDB, ['amount' => $amount, 'product_id' => $productId]);
            array_push($basketAdvanced, $product);
        }
    }
    return $basketAdvanced;
}

function getTotalCostOfBasket($basket) {
    $total = 0;
    foreach($basket as $product) {
        $total += $product['price'] * $product['amount'];
    }
    return $total;
}

function putProductIntoBasketDB($userId, $productId, $amount = 1) {
    $row = getOneResult("SELECT * FROM basket WHERE user_id = {$userId} AND product_id = {$productId}");
    if ($row) {
        $amountToDB = $row['amount'] + $amount;
        return executeSql("UPDATE `basket` SET amount = {$amountToDB} WHERE user_id = {$userId} AND product_id = {$productId}");
    } else {
        return executeSql("INSERT INTO `basket`(`user_id`, `product_id`, `amount`) VALUES ({$userId}, {$productId}, {$amount})");
    }
}

function putProductIntoBasketSessionStorage($productId) {
    if (isset($_SESSION['basket'][$productId])) {
        $_SESSION['basket'][$productId] = 1 + $_SESSION['basket'][$productId];
    } else {
        $_SESSION['basket'][$productId] = 1;
    }
}

function putBasketFromSessionStorageToDB() {
    $userId = $_SESSION['id'];
    if (isset($_SESSION['basket'])) {
        foreach ($_SESSION['basket'] as $productId => $amount) {
            putProductIntoBasketDB($userId, $productId, $amount);
        }
        unset($_SESSION['basket']);
    }

}

function getBasketAmount() {
    $amount = 0;
    $basket = getBasket();
    foreach ($basket as $item) {
        $amount += $item['amount'];
    }
    return $amount;
}

function sendAllBasket() {
    $basket = getBasket();
    header("Content-type: application/json");
    echo json_encode($basket);
}

function doBasketActions($action) {
        switch ($action){
        case 'getAll':
            sendAllBasket();
            die();
        case 'add':
            putProductIntoBasket();
            header("Content-type: application/json");
            $response['result'] = 1;
            echo json_encode($response);
            die();
        case 'delete':
            deleteProductFromBasket();
            header("Content-type: application/json");
            $response['result'] = 1;
            echo json_encode($response);
            die();
        case 'getTotalAmount':
            $totalAmount = getBasketAmount();
            header("Content-type: application/json");
            $response['totalAmount'] = $totalAmount;
            echo json_encode($response);
            die();
    }
}