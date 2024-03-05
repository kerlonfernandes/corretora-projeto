<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imóvel |
        <?= $title ?>
    </title>
    <link rel="stylesheet" href="<?= SITE ?>/public/assets/bootstrap.min.css">
    <link rel="stylesheet" href="<?= SITE ?>/public/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .mbr-form input,
        .message-form1-d {
            border-radius: 1px;


        }
    </style>
</head>

<body>

    <div id="carouselExampleIndicators" class="carousel slide mt-4">
        <div class="carousel-indicators">
            <?php
            require_once("./templates/home/HomeHeader.php");

            $i = 0;
            $imagens = explode(", ", $imovel->imovel_images);
            foreach ($imagens as $image) {
            ?>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $i ?>" <?php if ($i == 0)
                                                                                                                    echo 'class="active"' ?> aria-label="Slide <?= $i + 1 ?>"></button>
            <?php
                $i++;
            }
            ?>
        </div>
        <div class="carousel-inner">
            <?php
            $i = 0;
            foreach ($imagens as $image) {
            ?>
                <div class="carousel-item <?php if ($i == 0)
                                                echo 'active' ?>">
                    <img src="<?= SITE ?>/public/imoveis-images/<?= $image ?>" class="d-block w-100 img-fluid" alt="...">
                    <?php if ($i == 0) { ?>

                        <!-- <button class="btn btn-lg btn-primary btn-floating btn-block" style="position: absolute; bottom: 10%; left: 50%; transform: translateX(-50%); ">Botão Flutuante</button> -->

                    <?php } ?>
                    <span class="p-1 price" style="font-size: 32px; font-weight: bold; position: absolute; bottom: 0; left: 0; color:white;">
                        <?= 'R$ ' . number_format($imovel->price, 2, ',', '.'); ?>
                    </span>
                </div>
            <?php
                $i++;
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="card">

        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <div class="card">

                    <div class="card-header">

                        <div class="card border-light mb-3">
                            <div class="card-header text-center">
                                <h2 class="card-title p-3" style="font-weight: 600;">
                                    <?= $imovel->imovel_name ?>
                                </h2>
                                <div class="text-center p-3">
                                    <h3 class="card-text">
                                        <?= $imovel->imovel_locality ?>
                                        </h2>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="h1 text-center" style="font-weight: bold;">Resumo do imóvel</div>
                                <p class="card-text text-justify p-4 mt-3 box-shadow-bl" style=" border-radius: 4px; font-weight: 500;">
                                    <?= nl2br($imovel->short_description) ?>
                                </p>
                            </div>

                            <div class="card-body ">
                                <div class="h1 text-center" style="font-weight: bold;">Descrição</div>

                                <div class="card-text text-bg-light p-3 box-shadow-bl">
                                    <?= $imovel->imovel_description ?>
                                </div>

                            </div>
                            <div class="card-footer">
                                <ul class="list-group list-group-flush mt-3">
                                    <li class="list-group-item p-5">
                                        <div><i class="fa-solid fa-user"></i> <strong>Proprietário: </strong>
                                            <?= $imovel->proprietario ?>
                                        </div>
                                        <div><i class="fa-solid fa-pen-to-square"></i> <strong>Ultíma Atualização:
                                            </strong>
                                            <?php
                                            $data = new DateTime($imovel->last_update);
                                            echo $data->format('d/m/Y H:i:s');

                                            ?>
                                        </div>

                                    </li>
                                </ul>

                            </div>
                            <div class="container">
                                <div class="row">

                                    <section class="form1 cid-rqEPFdvXqt" id="form1-d">
                                        <div class="container mt-5 mb-5">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-5 col-md-12 col-sm-12 align-center">
                                                    <h2 class="title1 mbr-fonts-style mbr-bold display-5">Corretor
                                                        responsável</h2>
                                                    <h4 class="mbr-section-subtitle mbr-fonts-style display-7">
                                                        <?= $imovel->user ?><br>
                                                    </h4>

                                                    <h2 class="title1 mbr-fonts-style mbr-bold display-5">Entre em
                                                        contato</h2>





                                                    <div class="ico-box">
                                                        <span class="pr-3 mbr-iconfont mbr-iconfont-social icon fa-phone fa"></span>
                                                        <div>
                                                            <h4 class="mbr-fonts-style type display-7">Telefone</h4>
                                                            <p class="mbr-fonts-style content display-7 h5">
                                                                <?= $imovel->phone ?>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="ico-box">
                                                        <span class="pr-3 mbr-iconfont mbr-iconfont-social icon imind-email"></span>
                                                        <div>
                                                            <h4 class="mbr-fonts-style type display-7">E-mail</h4>
                                                            <p class="mbr-fonts-style content display-7 h5">
                                                                email@email.com</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-7 col-md-12 col-sm-12 align-left card p-3">
                                                    <h2 class="title2 mbr-fonts-style mbr-bold display-5">Interessou ?
                                                    </h2>
                                                    <h4 class="title2 mbr-bold">Nos contate ?</h4>

                                                    <div data-form-type="formoid">
                                                        <!---Formbuilder Form--->
                                                        <form id="interessou" class="mbr-form form-with-styler" data-form-title="Mobirise Form">
                                                            <input type="hidden" name="email" data-form-email="true" value="">
                                                            <div class="row row-sm-offset">
                                                                <div hidden="hidden" data-form-alert="" class="alert alert-success col-12">Obrigado pelo
                                                                    contato! Nossa equipe entrará em
                                                                    contato o mais rápido possível.</div>
                                                                <div hidden="hidden" data-form-alert-danger="" class="alert alert-danger col-12"></div>
                                                            </div>
                                                            <div class="dragArea row row-sm-offset">
                                                                <div class="col-md-6 form-group" data-for="name">
                                                                    <label for="name-form1-d">Seu nome</label>
                                                                    <input type="text" name="name" placeholder="Seu nome" data-form-field="Name" required="required" class="form-control display-7" id="name-form1-d">
                                                                </div>
                                                                <div class="col-md-6 form-group" data-for="email">
                                                                    <label for="email-form1-d">Seu melhor E-mail</label>
                                                                    <input type="email" name="email" placeholder="Seu melhor E-mail" data-form-field="Email" class="form-control display-7" id="email-form1-d">
                                                                </div>
                                                                <div data-for="phone" class="col-md-12 form-group">
                                                                    <label for="phone-form1-d">DDD + Telefone</label>
                                                                    <input type="tel" name="phone" placeholder="DDD + Telefone" data-form-field="Phone" class="form-control display-7" id="phone-form1-d">
                                                                </div>
                                                                <div data-for="message" class="col-md-12 form-group">
                                                                    <label for="message-form1-d">Deixe sua
                                                                        mensagem...</label>
                                                                    <textarea name="message" placeholder="Deixe sua mensagem..." data-form-field="Message" class="form-control display-7" id="message-form1-d"></textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="row mt-3">
                                                                        <div class="col-md-12 input-group-btn"><button type="submit" class="btn btn-form btn-primary">Enviar</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>


                                </div>
                            </div>
                        </div>
            </li>

        </ul>

    </div>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <a href="https://api.whatsapp.com/send?phone=<?= $imovel->phone ?>&text=👋 Olá! Estou interessado neste imóvel. <?= SITE ?>/imovel/<?= $imovel->imovel_slug ?>" class="float" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
    </a>
    <?php
    require_once("./templates/home/HomeFooter.php");
    ?>

<script src="<?= SITE ?>/public/js/jquery.min.js?id=<?= uniqid() ?>"></script>

    <script src="<?= SITE ?>/public/js/bootstrap.bundle.min.js.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/public/js/scripts.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/public/js/imovel/imovel.js?id=<?= uniqid() ?>"></script>

    <!-- <script src="<?= SITE ?>/public/js/index.js?id=<?= uniqid() ?>"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>