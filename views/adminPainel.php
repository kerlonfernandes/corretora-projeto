<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>

<body>
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    ?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?> </title>
        <style>
        </style>
        <link rel="stylesheet" href="<?= SITE ?>/public/assets/bootstrap.min.css">
        <link rel="stylesheet" href="<?= SITE ?>/public/css/styles.css">
        <link rel="stylesheet" href="<?= SITE ?>/public/css/admin/admin-painel.css">

        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.snow.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

        <!-- Popper.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    </head>

    <body>

        <div id="overlay">
            <div id="loader-container">
                <div id="custom-loader"></div>
            </div>
        </div>

        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn">&times;</a>
            <a href="<?= SITE ?>/admin/painel/?area=imoveis"><i class="fa-solid fa-house"></i> Imóveis</a>
            <a href="<?= SITE ?>/admin/painel/?area=users"><i class="fa-solid fa-users"></i>  Usuários</a>
            <a href="<?= SITE ?>/admin/painel/?area=reports"><i class="fa-regular fa-file-lines"></i> Relatórios</a>
            <a href="<?= SITE ?>/admin/painel/?area=system-tools"><i class="fa-solid fa-gear"></i> Ferramentas</a>
            <a id="logout-link" href="<?= SITE ?>/admin/logout">Sair <i class="fa-solid fa-door-open"></i><i class="fa-solid fa-person-walking-arrow-right" style="transform: scaleX(-1);"></i></a>
        </div>

        <div class="row">
            <!-- Use any element to open the sidenav -->
            <span class="open-sidebar"><i class="fa-solid fa-arrow-right m-3"></i></span>


            <div id="main">
                <?php if (isset($_GET['area'])) {
                    $areaAdmin = ["imoveis", "users", "reports", "system-tools"];

                    if (in_array($_GET['area'], $areaAdmin)) {

                        require("./templates/admins/{$_GET['area']}.php");
                    } else {
                ?>
                        <div class="area-home">Área não existente</div>
                <?php
                    }
                }

                ?>

            </div>



            <?php
            require("modais/admin_cadastrar_imovel.php");
            ?>
        </div>


        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <script src="<?= SITE ?>/public/js/jquery.min.js?id=<?= uniqid() ?>"></script>
        <script src="<?= SITE ?>/public/js/bootstrap.bundle.min.js.js?id=<?= uniqid() ?>"></script>
        <script src="<?= SITE ?>/public/js/scripts.js?id=<?= uniqid() ?>"></script>
        <script src="<?= SITE ?>/public/js/admin/painel.js?id=<?= uniqid() ?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.2/dist/quill.js"></script>



    </body>

    </html>
</body>

</html>