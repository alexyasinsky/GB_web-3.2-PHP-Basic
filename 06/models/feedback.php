<?php

if (isset($_REQUEST['feedback'])) {
    switch ($_REQUEST['feedback']) {
        case 'add':
            $id = (int)$_REQUEST['product_id'];
            $db = getDb();
            $name = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['feedback_name'])));
            $text = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['feedback_text'])));
            setFeedbackOnProductToDB($id, $name, $text);
            break;
        case 'delete':
            $id = (int)$_REQUEST['feedback_id'];
            deleteFeedBackOnProductFromDB($id);
            break;
        case 'edit':
            $id = (int)$_REQUEST['feedback_id'];
            $feedbackToChange = getOneFeedbackFromDB($id);
            break;
        case 'save':
            $id = (int)$_REQUEST['feedback_id'];
            $db = getDb();
            $name = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['feedback_name'])));
            $text = strip_tags(htmlspecialchars(mysqli_real_escape_string($db, $_POST['feedback_text'])));
            updateOneFeebackInDB($id, $name, $text);
    }
}



