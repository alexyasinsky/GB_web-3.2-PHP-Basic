<?php


function refreshGalleryPage($message) {
    header("Location: index.php?page=gallery&status=$message");
    die();
}
$messages = [
    'ok' => 'Файл загружен',
    'error' => 'Ошибка загрузки',
    'php' => 'Загрузка php-файлов запрещена!',
    'exist' => "Файл существует, выберите другое имя файла!",
    'size' => 'Размер файла не больше 5 мб',
    'extension' => 'Можно загружать только jpg, png и giff, неверное содержание файла, не изображение.',
];

function loadImage(){

    $filename = $_FILES['my_file']['name'];

    //Проверить на безопасность
    if (file_exists(UPLOADS_DIR . $filename)) {
        $message = 'exist';
        refreshGalleryPage($message);
    }

    if($_FILES["my_file"]["size"] > 1024*1*1024)
    {
        $message = 'size';
        refreshGalleryPage($message);
    }

    $imageinfo = getimagesize($_FILES['my_file']['tmp_name']);
    if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/png') {
        $message = 'extension';
        refreshGalleryPage($message);
    }

    //создание уменьшенной версии
    include('classSimpleImage.php');
    $image = new SimpleImage();
    $image->load($_FILES['my_file']['tmp_name']);
    $image->resize(100, 75);
    $image->save($filename);
    rename($filename, VIEW_DIR . $filename);

    //копирование оригинала
    $path = UPLOADS_DIR . $filename;
    if (move_uploaded_file($_FILES['my_file']['tmp_name'], $path)) {
        $message =  "ok";
    } else {
        $message =  "error";
    }

    refreshGalleryPage($message);
}

