<?php

function get_user() {
    return $_SESSION['login'] ?? '';
}

function isAuth() {
    if (isset($_SESSION['login'])) {
        return true;
    }
    if (!isset($_SESSION['id'])){
        $_SESSION['id'] = random_int(50000, 65000);
    }
    if (isset($_COOKIE["hash"])) {
        checkCookieHash();
    }
    return isset($_SESSION['login']);
}

function checkExistingOfUser($login) {
    return getOneResult("SELECT * FROM users WHERE login = '{$login}'");
}

function createNewUser($login, $password_hash) {
    return executeSql("INSERT INTO `users` (login, password_hash, role) VALUES ('{$login}', '{$password_hash}', 'user')");
}

function auth($login, $password) {
    $row = getOneResult("SELECT * FROM users WHERE login = '{$login}'");
    if ($row) {
        $password_hash = $row['password_hash'];
        if (password_verify($password, $password_hash)) {
            //Авторизация
            $_SESSION['login'] = $login;
            $_SESSION['id'] = $row['id'];
            $userId = $_SESSION['id'];
            postponeBasketFromSessionStorageToUnorderedDB($userId);
            return true;
        }
    }
    return false;
}

function setCookieHash() {
    $cookie_hash = uniqid(rand(), true);
    $id = $_SESSION['id'];
    executeSql("UPDATE users SET cookie_hash = '{$cookie_hash}' WHERE id = {$id}");
    setcookie("hash", $cookie_hash, time() + 3600, "/");
}

function checkCookieHash() {
    $hash = $_COOKIE["hash"];
    $row = getOneResult("SELECT * FROM users WHERE cookie_hash='{$hash}'");
    if ($row) {
        $_SESSION['login'] = $row['login'];
        $_SESSION['id'] = $row['id'];
    }
}

function loginActions($login, $password, $action) {
    switch ($action) {
        case 'register':
            $password_hash = password_hash($password, PASSWORD_ARGON2ID);
            if (!checkExistingOfUser($login)) {
                createNewUser($login, $password_hash);
                auth($login, $password);
                header("Location: /?status=registered");
            } else {
                header("Location: /?status=exist");
            };
            die();
        case 'enter': {
            if (auth($login, $password)) {
                if (isset($_POST['save'])) {
                   setCookieHash();
                }
                header("Location: /?status=entered");
                die();
            } else {
                header("Location: /?status=incorrect");
            }
        }
    }
}

function unsetCookiesAndSession() {
    setcookie("hash", "", time()-1, "/");
    session_regenerate_id();
    session_destroy();
}

function setStatusMessage() {
    $status = $_GET['status'] ?? 'empty';
    $messages = [
        'incorrect' => 'Вы ввели неверный логин или пароль',
        'registered' => 'Регистрация успешно завершена!',
        'exit' => 'Вы вышли из системы',
        'exist' => 'Такой пользователь уже существует',
        'empty' => ''
    ];
    return $messages[$status];
}