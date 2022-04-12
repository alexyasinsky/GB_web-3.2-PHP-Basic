<h2>Заказ <?=$orderId?></h2>
    <table>
        <tr class="table__row">
            <th></th>
            <th>Наименование</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Стоимость</th>
        </tr>
        <?php foreach ($basket as $item): ?>
            <tr>
                <td>
                    <a :href="'/product/?product_id=<?=$item['id']?>"><img src="/img/catalog/<?=$item['image']?>" alt="<?=$item['name']?>" width="50px"></a>
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
            </tr>
        <?php endforeach; ?>
    </table>
    <div>
        <h3>ИТОГО: <?=$total?> ₽</h3>
    </div>
</div>

