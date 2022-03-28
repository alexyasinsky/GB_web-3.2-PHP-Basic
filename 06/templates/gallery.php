<h2>Галерея</h2>

<div>
    <div style="display: flex">
        <?php foreach ($gallery as $item): ?>
            <div style="margin-right: 50px">
                <a href='/gallery_item?id=<?=$item['id']?>'><img src="<?= VIEW_DIR . $item['name']?>"></a>
                <p>Просмотров: <?=$item['views']?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <h4>Добавить картинку</h4>
    <?=$message?><br>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="my_file">
        <input type="submit" value="Загрузить">
    </form>
</div>