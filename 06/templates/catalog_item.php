<link rel="stylesheet" href="css/product.css">

<h2><?=$item['name']?></h2>

<div class="product__card">
    <h5><?=$item['name']?></h5>
    <img src="img/catalog/<?=$item['image']?>" alt="" width="100">
    <p class="product__about"><?=$item['about']?></p>
    Цена: <?=$item['price']?><br>
    <button class="button">Купить</button>
    <hr>
</div>