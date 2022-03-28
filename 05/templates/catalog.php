<h2>Каталог</h2>

<div>
    <?php foreach ($catalog as $item): ?>
        <div>
            <?=$item['name']?><br>
            <img src="img/catalog/<?=$item['image']?>" alt="" width="100"><br>
            Цена: <?=$item['price']?><br>
            <button class="button">Купить</button>
            <hr>
        </div>
    <?php endforeach; ?>

</div>