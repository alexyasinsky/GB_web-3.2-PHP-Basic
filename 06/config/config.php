<?php

define('ROOT', dirname(__DIR__));

define('TEMPLATES_DIR', ROOT . '/templates/');
define('LAYOUTS_DIR', 'layouts/');
define('UPLOADS_DIR', 'img/gallery_fullsize/');
define('VIEW_DIR', 'img/gallery_small/');

/* DB config */
define('HOST', 'localhost:3306');
define('USER', 'user1');
define('PASS', '12345');
define('DB', 'gb_php_1');

include ROOT . "/engine/functions.php";
include ROOT . "/models/bux.php";
include ROOT . '/models/calc.php';
include ROOT . "/engine/db.php";
include ROOT . "/models/catalog.php";
include ROOT . "/models/log.php";
include ROOT . "/models/gallery.php";