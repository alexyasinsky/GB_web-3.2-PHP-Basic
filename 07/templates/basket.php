<h2>Корзина</h2>
<?php if (empty($basket)): ?>
    <h4>Корзина пуста</h4>
<?php else: ?>
    <table>
        <tr>
           <th></th>
            <th>Наименование</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Стоимость</th>
            <th></th>
        </tr>
        <?php foreach ($basket as $item): ?>
            <tr class="basket__row">
               <td>
                   <a href='/product?product_id=<?=$item['product_id']?>'><img src="img/catalog/<?=$item['image']?>" alt="<?=$item['name']?>" width="50px"></a>
               </td>
                <td>
                    <?=$item['name']?>
                </td>
                <td>
                    <?=$item['price']?>  ₽
                </td>
                <td>
                    <?=$item['amount']?>
                </td>
                <td>
                    <?=$item['price'] * $item['amount']?>  ₽
                </td>
                <td>
                    <button class="basket__delete-button"
                            data-product_id="<?=$item['product_id']?>"
                            data-amount="<?=$item['amount']?>"
                            data-basket_item_id="<?=$item['id']?>"
                    >X</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h3>ИТОГО: <?=$total?> ₽</h3>

    <a href="/checkout">Перейти к оформлению заказа</a>
<?php endif; ?>
<script>
  const buttons = document.querySelectorAll('.basket__delete-button');
  buttons.forEach(button => {
    button.addEventListener('click', event => {
      let data = {
        productId: button.dataset.product_id,
        amount: button.dataset.amount,
        basketItemId: button.dataset.basket_item_id
      }
      addPostQueryToElement('/basketapi/delete/', data);
      setTimeout(() => window.location.replace('/basket'), 50);
    });
  });
</script>



