<?php

include "../../02/task_4.php";

function render($page, $params = []) {
    return renderTemplate(LAYOUTS_DIR . 'main', [
        'title' => $params['title'],
        'menu' => renderTemplate('menu', $params),
        'content' => renderTemplate($page, $params)
    ]);
}

function renderTemplate($page, $params = []) {

    /*    foreach ($params as $key => $value) {
            $$key = $value;
        }*/
    extract($params);

    ob_start();
    include TEMPLATES_DIR . $page . ".php";
    return ob_get_clean();
}

function getFiles($dir) {
    return array_splice(scandir($dir), 2);
}