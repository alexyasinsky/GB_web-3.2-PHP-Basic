<h2><?=$item['name']?></h2>

<div class="product__card">
    <h3><?=$item['name']?></h3>
    <img src="img/catalog/<?=$item['image']?>" alt="" width="100">
    <p class="product__about"><?=$item['about']?></p>
    Цена: <?=$item['price']?><br>
    <button class="product__button" data-product_id="<?=$item['id']?>">Купить</button>
    <br>
</div>

<h2>Комментарии</h2>
<h3>Добавить комментарий</h3>
<form method="post" class="feedback__form">
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
        <button type="submit" name="feedback" value="save">Сохранить</button>
    <?php endif; ?>
</form>
<?php foreach ($feedbacks as $feedback): ?>
<form class="feedback">
    <input type="text" hidden name="feedback_id" value="<?=$feedback['id']?>">
    <input type="text" hidden name="product_id" value="<?=$item['id']?>">
    <h4><?=$feedback['name']?></h4>
    <i><?=$feedback['time']?></i>
    <p><?=$feedback['text']?></p>
    <button type="submit"  name="feedback" value="edit">Редактировать</button>
    <button type="submit"  name="feedback" value="delete">Удалить</button>
    <hr>
</form>
<?php endforeach; ?>
<script>
  const button = document.querySelector('.product__button');
  button.addEventListener('click', event => {
    let data = {
      productId: button.dataset.product_id,
    }
    addPostQueryToElement('/basketapi/add', data);
    setTimeout(() => window.location.replace(`/product?product_id=${data.productId}`), 50);
  });
</script>