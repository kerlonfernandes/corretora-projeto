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
            .sidenav {
                height: 100%;
                width: 0;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: #111;
                overflow-x: hidden;
                padding-top: 60px;
                transition: 0.5s;
            }

            .sidenav a {
                padding: 8px 8px 8px 32px;
                text-decoration: none;
                font-size: 25px;
                color: #818181;
                display: block;
                transition: 0.3s;
            }

            .sidenav a:hover {
                color: #f1f1f1;
            }

            .sidenav .closebtn {
                position: absolute;
                top: 0;
                right: 25px;
                font-size: 36px;
                margin-left: 50px;
            }

            #main {
                transition: margin-left .5s;
                padding: 20px;
            }


            @media screen and (max-height: 450px) {
                .sidenav {
                    padding-top: 15px;
                }

                .sidenav a {
                    font-size: 18px;
                }
            }

            .overlay {
                position: fixed;
                top: 0;
                right: 0;
                /* Altere de "left" para "right" para posicioná-lo à direita */
                width: 300px;
                background-color: rgba(0, 0, 0, 0.0);
                padding: 20px;
                color: #fff;
                z-index: 9999;
                text-align: right;
                /* Alinhar o texto à direita */
            }


            .alert-box {
                padding: 10px;
                border-radius: 5px;
            }

            /* Posiciona o overlay no canto esquerdo da tela */
            .overlay {
                top: 0;
                left: 0;
                transform: translateX(0);
                /* Certifique-se de que o overlay está visível no canto esquerdo */
            }
            .open-sidebar {
                cursor: pointer;
            }
        </style>
        <link rel="stylesheet" href="<?= SITE ?>/public/assets/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    </head>

    <body>

        <div id="overlay">
            <div id="loader-container">
                <div id="custom-loader"></div>
            </div>
        </div>

        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="<?= SITE ?>/admin/painel/?area=imoveis">Imóveis</a>
            <a href="<?= SITE ?>/admin/painel/?area=users">Usuários</a>
            <a href="<?= SITE ?>/admin/painel/?area=reports">Relatórios</a>
            <a href="<?= SITE ?>/admin/painel/?area=system-tools">Ferramentas</a>
            <a href="<?= SITE ?>/admin/logout">LogOut <i class="fa-solid fa-right-from-bracket"></i></a>
        </div>

        <div class="row">
            <!-- Use any element to open the sidenav -->
            <span onclick="openNav()" class="open-sidebar"><i class="fa-solid fa-arrow-right m-3"></i></span>


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


        </div>


        <script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
                document.getElementById("main").style.marginLeft = "250px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
                document.getElementById("main").style.marginLeft = "0";
            }
            openNav()
        </script>

        <script src="<?= SITE ?>/public/js/bootstrap.bundle.min.js.js?id=<?= uniqid() ?>"></script>
        <script src="<?= SITE ?>/public/js/scripts.js?id=<?= uniqid() ?>"></script>
        <script src="<?= SITE ?>/public/js/admin/painel.js?id=<?= uniqid() ?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
</body>

</html>