<?php

function putProductIntoBasket($productId) {
    $sessionId = $_SESSION['id'];
    if (isset($_SESSION['login'])) {
        putProductIntoBasketDB($sessionId, $productId);
    } else {
        putProductIntoBasketSessionStorage($productId);
    }
}

function deleteProductFromBasket($productId, $basketItemId, $amount) {
    if (isset($_SESSION['login'])) {
        deleteProductFromBasketInDB($basketItemId, $amount);
    } else {
        deleteProductFromBasketInSessionStorage($productId, $amount);
    }
}

function deleteProductFromBasketInDB($basketItemId, $amount) {
    $sessionId = $_SESSION['id'];
    if ($amount == 1) {
        return executeSql("DELETE FROM `basket` WHERE id={$basketItemId}");
    } else {
        return executeSql("UPDATE `basket` SET amount = amount - 1 WHERE id={$basketItemId}");
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
    $sessionId = $_SESSION['id'];
    if (isset($_SESSION['login'])) {
        return getBasketFromDB($sessionId);
    } else {
        return getBasketFromSessionStorage();
    }
}
function getBasketFromDB($sessionId) {
    return getAssocResult("SELECT basket.id, basket.product_id, basket.amount, catalog.name, catalog.price, catalog.image FROM `basket` JOIN `catalog` ON basket.product_id = catalog.id WHERE `session_id` = {$sessionId}");
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

function putProductIntoBasketDB($sessionId, $productId, $amount = 1) {
    $row = getOneResult("SELECT * FROM basket WHERE session_id = {$sessionId} AND product_id = {$productId}");
    if ($row) {
        $amountToDB = $row['amount'] + $amount;
        return executeSql("UPDATE `basket` SET amount = {$amountToDB} WHERE session_id = {$sessionId} AND product_id = {$productId}");
    } else {
        return executeSql("INSERT INTO `basket`(`session_id`, `product_id`, `amount`) VALUES ({$sessionId}, {$productId}, {$amount})");
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
    $sessionId = $_SESSION['id'];
    if (isset($_SESSION['basket'])) {
        foreach ($_SESSION['basket'] as $productId => $amount) {
            putProductIntoBasketDB($sessionId, $productId, $amount);
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

function doBasketActions($action) {
    $data = json_decode(file_get_contents('php://input'));
    $productId = $data->productId;
    $amount = $data->amount;
    $basketItemId = $data->basketItemId;
    switch ($action){
        case 'add':
            putProductIntoBasket($productId);
            break;
        case 'delete':
            deleteProductFromBasket($productId, $basketItemId, $amount);
            break;
    }
}