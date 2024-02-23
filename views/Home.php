<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= SITE ?>/public/assets/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        .b-app {
            background-color: #EEEDEB;
            height: 1000px;
        }

        .loader {
            width: 100%;
            height: 215px;
            display: block;
            margin: auto;
            position: relative;
            background: #FFF;
            box-sizing: border-box;
        }

        .loader::after {
            content: '';
            width: calc(100% - 30px);
            height: calc(100% - 15px);
            top: 15px;
            left: 15px;
            position: absolute;
            background-image: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5) 50%, transparent 100%),
                linear-gradient(#DDD 50px, transparent 0);
            background-repeat: no-repeat;
            background-size: 75px 175px, 100% 100px, 100% 16px, 100% 30px;
            background-position: -185px 0, center 0, center 115px, center 142px;
            box-sizing: border-box;
            animation: animloader 1s linear infinite;
        }

        @keyframes animloader {
            to {
                background-position: 185px 0, center 0, center 115px, center 142px;
            }
        }

        .spinner {
            color: #B4B4B8;
            font-size: 45px;
            text-indent: -9999em;
            overflow: hidden;
            width: 1em;
            height: 1em;
            border-radius: 50%;
            position: relative;
            transform: translateZ(0);
            animation: mltShdSpin 1.7s infinite ease, round 1.7s infinite ease;
        }

        @keyframes mltShdSpin {
            0% {
                box-shadow: 0 -0.83em 0 -0.4em,
                    0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em,
                    0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }

            5%,
            95% {
                box-shadow: 0 -0.83em 0 -0.4em,
                    0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em,
                    0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }

            10%,
            59% {
                box-shadow: 0 -0.83em 0 -0.4em,
                    -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em,
                    -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
            }

            20% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em,
                    -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em,
                    -0.749em -0.34em 0 -0.477em;
            }

            38% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em,
                    -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em,
                    -0.82em -0.09em 0 -0.477em;
            }

            100% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em,
                    0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
        }

        @keyframes round {
            0% {
                transform: rotate(0deg)
            }

            100% {
                transform: rotate(360deg)
            }
        }



        .item-placeholder {
            width: 100%;
            height: 215px;
            display: block;
            margin: auto;
            position: relative;
            background: #FFF;
            box-sizing: border-box;
        }

        .item-placeholder::after {
            content: '';
            width: calc(100% - 30px);
            height: calc(100% - 15px);
            top: 15px;
            left: 15px;
            position: absolute;
            background-image: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5) 50%, transparent 100%),
                linear-gradient(#DDD 100px, transparent 0),
                linear-gradient(#DDD 16px, transparent 0),
                linear-gradient(#DDD 50px, transparent 0);
            background-repeat: no-repeat;
            background-size: 75px 175px, 100% 100px, 100% 16px, 100% 30px;
            background-position: -185px 0, center 0, center 115px, center 142px;
            box-sizing: border-box;
            animation: animloader 1s linear infinite;
        }

        @keyframes animloader {
            to {
                background-position: 185px 0, center 0, center 115px, center 142px;
            }
        }

        .imovel-card {
            text-decoration: none;
            color: inherit;
            outline: none;
            transition: filter 0.5s ease;
            /* Adiciona uma transição suave para a propriedade filter */

            /* Adicione outras propriedades de estilo conforme necessário */
        }

        .imovel-card:hover {
            filter: brightness(90%);
            /* Escurece o elemento quando o mouse está sobre ele */
        }

        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            transition: transform 0.5s ease-in-out;
        }

        .footer.sticky {
            transform: translateY(0);
        }

        .imovel-card {
            position: relative;
            display: inline-block;
            text-decoration: none;
            color: #333;
        }

        .imovel-card:hover::before {
            content: attr(data-name);
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        .imovel-card:hover::before {
            opacity: 1;
        }
    </style>
</head>

<body>


    <div class="container text-center">
        <div class="row">

            <?php require_once("./templates/home/HomeHeader.php") ?>


        </div>
        <div class="row content b-app">
            <div class="col-1">

            </div>
            <div class="col-10 center-content">

                <header class="header-components loader">
                </header>

                <?php require_once("./templates/home/HomeMain.php") ?>

            </div>
            <div class="col-1">

            </div>
        </div>


    </div>
    <?php require_once("./templates/home/HomeFooter.php") ?>

    <script src="<?= SITE ?>/public/js/bootstrap.bundle.min.js.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/public/js/scripts.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/public/js/index.js?id=<?= uniqid() ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>