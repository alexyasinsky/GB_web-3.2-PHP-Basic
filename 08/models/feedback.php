<?php

function doFeedbackAction($action) {
    switch ($action) {
        case 'add':
            $product_id = addFeedBack();
            header("Location: /product/?product_id=$product_id");
            die();
        case 'delete':
            $product_id = deleteFeedback();
            header("Location: /product/?product_id=$product_id");
            die();
        case 'edit':
            $feedback_id = editFeedback();
            return $feedbackToChange = getOneFeedbackFromDB($feedback_id);
            break;
        case 'save':
            $product_id = saveFeedback();
            header("Location: /product/?product_id=$product_id");
            die();
    }
}

function addFeedBack() {
    $product_id = (int)$_REQUEST['product_id'];
    $db = getDb();
    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_REQUEST['feedback_name'])));
    $text = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_REQUEST['feedback_text'])));
    setFeedbackOnProductToDB($product_id, $name, $text);
    return $product_id;
}

function deleteFeedback() {
    $feedback_id = (int)$_REQUEST['feedback_id'];
    $product_id = (int)$_REQUEST['product_id'];
    deleteFeedBackOnProductFromDB($feedback_id);
    return $product_id;
}

function editFeedback() {
    $product_id = (int)$_REQUEST['product_id'];
    return $feedback_id = (int)$_REQUEST['feedback_id'];
}

function saveFeedback() {
    $feedback_id = (int)$_REQUEST['feedback_id'];
    $product_id = (int)$_REQUEST['product_id'];
    $db = getDb();
    $name = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['feedback_name'])));
    $text = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['feedback_text'])));
    updateOneFeebackInDB($feedback_id, $name, $text);
    return $product_id;
}




