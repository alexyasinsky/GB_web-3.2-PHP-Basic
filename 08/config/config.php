<?php

define('ROOT', dirname(__DIR__));

define('TEMPLATES_DIR', ROOT . '/templates/');
define('LAYOUTS_DIR', 'layouts/');

/* DB config */
define('HOST', 'localhost:3306');
define('USER', 'user1');
define('PASS', '12345');
define('DB', 'gb_php_1');

include ROOT . '/engine/auth.php';
include ROOT . "/engine/render.php";
include ROOT . "/engine/db.php";
include ROOT . "/models/catalog.php";
include ROOT . "/models/feedback.php";
include ROOT . "/models/basket.php";
include ROOT . "/models/order.php";
