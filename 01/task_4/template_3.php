<?php
    $title = "Главная страница - страница обо мне";
    $h1 = "Информация обо мне";
    $currentYear = date(Y);

    $content = file_get_contents("template_3.html");

    $content = str_replace("{{ title }}", $title, $content);
    $content = str_replace("{{ h1 }}", $h1, $content);
    $content = str_replace("{{ currentYear }}", $currentYear, $content);

    echo $content;

