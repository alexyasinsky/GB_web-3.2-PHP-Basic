<?php
    updateViewsOnPictureInDB($item['id']);
?>
<h2><?=$item['name']?></h2>
<img src="<?=UPLOADS_DIR . $item['name']?>" alt="<?=$item['name']?>">
<p>Просмотров: <?=$item['views'] + 1?></p>