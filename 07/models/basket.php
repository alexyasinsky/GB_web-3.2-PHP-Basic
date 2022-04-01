<?php

function putProductIntoBasket() {
    $productId = file_get_contents('php://input');
    $sessionId = $_SESSION['id'];
    if (isset($_SESSION['login'])) {
        putProductIntoBasketDB($sessionId, $productId);
    } else {
        putProductIntoBasketSessionStorage($productId);
    }
}

function getBasketFromDB() {
    return getAssocResult('SELECT * FROM basket');
}

function getBasketFromSessionStorage() {

}

function putProductIntoBasketDB($session_id, $product_id, $amount = 1) {
    $row = getOneResult("SELECT * FROM basket WHERE session_id = {$session_id} AND product_id = {$product_id}");
    if ($row) {
        $amountToDB = $row['amount'] + $amount;
        return executeSql("UPDATE `basket` SET amount = {$amountToDB} WHERE session_id = {$session_id} AND product_id = {$product_id}");
    } else {
        return executeSql("INSERT INTO `basket`(`session_id`, `product_id`, `amount`) VALUES ({$session_id}, {$product_id}, {$amount})");
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
    }
}