<h2>Галерея</h2>

<div>
    <?php foreach ($gallery as $item): ?>
        <a href=<?=UPLOADS_DIR . $item?>><img src="<?= VIEW_DIR . $item?>"></a>
    <?php endforeach; ?>
    <h4>Добавить картинку</h4>
    <?=$message?><br>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="my_file">
        <input type="submit" value="Загрузить">
    </form>
</div>