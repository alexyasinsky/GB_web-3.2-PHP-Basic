<?php

function render($page, $params = []) {
    return renderTemplate(LAYOUTS_DIR . 'main', [
        'styles' => $params['styles'],
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

function setStatusMessage() {
    $status = $_GET['status'];
    $messages = [
        'incorrect' => 'Вы ввели неверный логин или пароль',
        'registered' => 'Регистрация успешно завершена!',
        'exit' => 'Вы вышли из системы'
    ];
    return $messages[$status];
}