<?php

function getCatalogFromDB() {
    return getAssocResult('SELECT * FROM catalog ORDER BY `views` DESC');
}

function getOneProductFromDB($id) {
    return getOneResult("SELECT * FROM catalog WHERE id = $id");
}

function updateViewsOnProductInDB($id) {
    return executeSql("UPDATE `catalog` SET views = views + 1 WHERE id=$id");
}

function getFeedbackOnProductFromDB($productId) {
    return getAssocResult("SELECT * FROM `feedback` WHERE product_id = $productId ORDER BY `time` DESC");
}

function setFeedbackOnProductToDB($productId, $name, $text) {
    return executeSql("INSERT INTO `feedback`(`product_id`, `name`, `text`) VALUES ({$productId}, '{$name}', '{$text}')");
}

function deleteFeedbackOnProductFromDB($id) {
        return executeSql("DELETE FROM `feedback` WHERE id = $id");
};

function getOneFeedbackFromDB($id) {
    return getOneResult("SELECT * FROM feedback WHERE id = $id");
}

function updateOneFeebackInDB($id, $name, $text) {
    return executeSql("UPDATE `feedback` SET name = '{$name}', text = '{$text}' WHERE id= $id");
}