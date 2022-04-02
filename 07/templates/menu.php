<?=$statusMessage?>
<?php if ($auth): ?>
    Добро пожаловать <?= $name ?>, <a href="/logout">[Выход]</a>
<?php else: ?>
    <form action="/login" method="post">
        <input type="text" name="login">
        <input type="text" name="password">
        Оставаться в системе? <input type='checkbox' name='save'>
        <button type="submit" name="action" value="register">Зарегистрироваться</button>
        <button type="submit" name="action" value="enter">Войти</button>
    </form>
<?php endif; ?>

<hr>
<a href="/">Главная</a>
<a href="/catalog">Каталог</a>
<a href="/about">О нас</a>
<a href="/basket">Корзина <span id="basket__indicator"><?=$basketAmount ?? '(' . $basketAmount . ')'?></span> </a>
<br>
