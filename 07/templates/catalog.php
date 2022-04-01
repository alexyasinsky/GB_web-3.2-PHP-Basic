<link rel="stylesheet" href="css/catalog.css">

<h2>Каталог</h2>

<div class="product__box">
    <?php foreach ($catalog as $item): ?>
        <div class="product__card">
            <h5><?=$item['name']?></h5>
            <a href='/product?product_id=<?=$item['id']?>'><img src="img/catalog/<?=$item['image']?>" alt="<?=$item['name']?>" width="100"></a>
            Цена: <?=$item['price']?><br>
            <button class="product__button" data-product_id="<?=$item['id']?>">Купить</button>
        </div>
    <?php endforeach; ?>
</div>
<script>
  const buttons = document.querySelectorAll('.product__button');
  buttons.forEach(button => {
    button.addEventListener('click', event => {
      addActionToBuyButton(button);
    })
  })

</script>