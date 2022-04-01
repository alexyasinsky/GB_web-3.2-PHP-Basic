<h2>Корзина</h2>
<?php if (empty($basket)): ?>
    <h4>Корзина пуста</h4>
<?php else: ?>
    <table>
        <?php foreach ($basket as $item): ?>
            <tr> class="basket_card">
               <td>
                   <a href='/product?product_id=<?=$item['id']?>'><img src="img/catalog/<?=$item['image']?>" alt="<?=$item['name']?>" width="50px"></a>
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
                    <a href="/basket?id=<?=$item['id']?>&action=delete"></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>