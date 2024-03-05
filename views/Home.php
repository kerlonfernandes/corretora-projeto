<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= SITE ?>/public/assets/bootstrap.min.css">
    <link rel="stylesheet" href="<?= SITE ?>/public/css/styles.css">
    <link rel="stylesheet" href="<?= SITE ?>/public/css/home/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

    <?php
    require_once("./templates/home/HomeHeader.php");

    ?>


    
        <?php require_once("./templates/home/HomeMain.php") ?>





        <?php
        require_once("./templates/home/HomeFooter.php") 
        ?>

   
    <script src="<?= SITE ?>/public/js/jquery.min.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/public/js/bootstrap.bundle.min.js.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/public/js/scripts.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/public/js/index.js?id=<?= uniqid() ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>