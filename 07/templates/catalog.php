<link rel="stylesheet" href="css/catalog.css">

<h2>Каталог</h2>

<div class="product__box">
    <?php foreach ($catalog as $item): ?>
        <div class="product__card">
            <h5><?=$item['name']?></h5>
            <a href='/product?product_id=<?=$item['id']?>'><img src="img/catalog/<?=$item['image']?>" alt="" width="100"></a>
<!--            <p class="product__about">--><?//=$item['about']?><!--</p>-->
            Цена: <?=$item['price']?><br>
            <button class="button">Купить</button>
        </div>
    <?php endforeach; ?>

</div>