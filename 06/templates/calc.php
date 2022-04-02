<link rel="stylesheet" href="css/calc.css">
<h2>Калькулятор</h2>

<form action="" method="get" class="calc_form">
    <input type="text" name="arg1" value="<?=$arg1?>">
    <select name="operation">
        <option <?php if ($operation == 'sum') echo 'selected';?> value="sum">+</option>
        <option <?php if ($operation == 'sub') echo 'selected';?> value="sub">-</option>
        <option <?php if ($operation == 'mult') echo 'selected';?> value="mult">*</option>
        <option <?php if ($operation == 'div') echo 'selected';?> value="div">/</option>
    </select>
    <input type="text" name="arg2" value="<?=$arg2?>">
    <input type="submit" value="=">
    <span class="calc_result"><?=$result?></span>
</form>
