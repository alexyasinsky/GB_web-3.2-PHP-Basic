<?php

define('ROOT', dirname(__DIR__));

define('TEMPLATES_DIR', ROOT . '/templates/');
define('LAYOUTS_DIR', 'layouts/');
define('UPLOADS_DIR', 'img/gallery_fullsize/');
define('VIEW_DIR', 'img/gallery_small/');


include ROOT . "/engine/bux.php";
include ROOT . "/engine/functions.php";
include ROOT . "/engine/catalog.php";
include ROOT . "/engine/log.php";
include ROOT . "/engine/gallery.php";