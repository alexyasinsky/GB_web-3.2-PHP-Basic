<link rel="stylesheet" href="css/product.css">

<h2><?=$item['name']?></h2>

<div class="product__card">
    <h3><?=$item['name']?></h3>
    <img src="img/catalog/<?=$item['image']?>" alt="" width="100">
    <p class="product__about"><?=$item['about']?></p>
    Цена: <?=$item['price']?><br>
    <button class="button">Купить</button>
    <hr>
</div>

<h2>Комментарии</h2>
<h3>Добавить комментарий</h3>
<form action="" method="post" class="feedback__form">
    <?php if (empty($feedbackToChange)) : ?>
        <input type="text" hidden name="product_id" value="<?=$item['id']?>">
        <input type="text" name="feedback_name" placeholder="Ваше имя:"><br>
        <textarea class='feedback__textarea' name="feedback_text" placeholder="Ваш отзыв:"></textarea><br>
        <button type="submit" name="feedback" value="add">Добавить</button>
    <?php else: ?>
        <input type="text" hidden name="feedback_id" value="<?=$feedbackToChange['id']?>">
        <input type="text" hidden name="product_id" value="<?=$item['id']?>">
        <input type="text" name="feedback_name" placeholder="Ваше имя:" value="<?=$feedbackToChange['name']?>"><br>
        <textarea class='feedback__textarea' name="feedback_text" placeholder="Ваш отзыв:"><?=$feedbackToChange['text']?></textarea><br>
        <button type="submit" name="feedback" value="save">Изменить</button>
    <?php endif; ?>
</form>
<?php foreach ($feedbacks as $feedback): ?>
<form class="feedback">
    <input type="text" hidden name="feedback_id" value="<?=$feedback['id']?>">
    <input type="text" hidden name="product_id" value="<?=$item['id']?>">
    <h4><?=$feedback['name']?></h4>
    <i><?=$feedback['time']?></i>
    <p><?=$feedback['text']?></p>
    <button type="submit" name="feedback" value="edit">Редактировать</button>
    <button type="submit" name="feedback" value="delete">Удалить</button>
    <hr>
</form>
<?php endforeach; ?>
