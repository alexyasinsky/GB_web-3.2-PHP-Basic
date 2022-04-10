<?php

function render($page, $params = [], $layout) {
    return renderTemplate(LAYOUTS_DIR . $layout, [
        'title' => $params['title'],
        'menu' => renderTemplate('menu', $params),
        'content' => renderTemplate($page, $params)
    ]);
}

function renderTemplate($page, $params = []) {

    ob_start();

    if (!is_null($params))
        extract($params);

    $fileName = TEMPLATES_DIR . $page . ".php";

    if (file_exists($fileName)) {
        include $fileName;
    } else {
        Die("Страницы {$page} не существует.");
    }

    return ob_get_clean();
}


