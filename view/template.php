<!-- Obliger de mettre session_start partout -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="public/img/logotop.png" />
    <title><?= $title ?></title>
    <?php require('parts/css.php') ?>
</head>

<body>
    <?php require('parts/nav.php') ?>
    <?= $content ?>
    <?php require('parts/footer.php') ?>
    <?php require('parts/script.php') ?>
</body>

</html>