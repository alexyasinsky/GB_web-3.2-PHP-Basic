<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$title?></title>
    <link rel="stylesheet" href="css/style.css">
    <?php foreach ($styles as $style): ?>
        <link rel='stylesheet' href='css/<?=$style?>.css'>
    <?php endforeach; ?>
</head>
<body>
    <script src="index.js"></script>
    <?=$menu?>
    <?=$content?>
</body>
</html>