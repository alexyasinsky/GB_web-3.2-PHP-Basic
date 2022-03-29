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