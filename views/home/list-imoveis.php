<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "../../_app/Config.php";
include "../../models/Database.php";
include "../../src/SupAid.php";

use HelpersClass\SupAid;
use Midspace\Database;

$query = new Database(MYSQL_CONFIG);

$itemsPerPage = 15;
$totalItemsQuery = $query->execute_query("SELECT COUNT(*) as total FROM imoveis");
$totalItems = $totalItemsQuery->results[0]->total;
$totalPages = ceil($totalItems / $itemsPerPage);

$page = isset($_GET['page']) ? max(1, min($totalPages, intval($_GET['page']))) : 1;

$startIndex = ($page - 1) * $itemsPerPage;
$endIndex = min($startIndex + $itemsPerPage - 1, $totalItems - 1);
$result;

$conditions = [];
$parameters = [];

if (isset($_GET['imovel_name'])) {
    $conditions[] = "imovel_name LIKE :imovel_name";
    $parameters[":imovel_name"] = '%' . $_GET["imovel_name"] . '%';
}

if (isset($_GET['category'])) {
    $conditions[] = "category = :category";
    $parameters[":category"] = $_GET["category"];
}

// Adicione mais condições conforme necessário

$whereClause = '';
if (!empty($conditions)) {
    $whereClause = ' WHERE ' . implode(' AND ', $conditions) . ' AND is_archived != 1';
}

$sql = "SELECT * FROM imoveis" . $whereClause . " LIMIT $startIndex, $itemsPerPage";

$result = $query->execute_query($sql, $parameters);


?>

<div class="row justify-content-center align-items-center">


    <?php if ($result->affected_rows > 0) : ?>
        <?php foreach ($result->results as $imovel) : ?>
            <div class="card m-4 col-md-4 card-imoveis" style="width: 26rem;">
                <div id="carouselExampleIndicators<?= $imovel->id ?>" class="carousel slide">
                    <div class="carousel-indicators">
                        <?php
                        $i = 0;
                        $imagens = isset($imovel->imovel_images) ? explode(", ", $imovel->imovel_images) : [];
                        foreach ($imagens as $image) {
                        ?>
                            <button type="button" data-bs-target="#carouselExampleIndicators<?= $imovel->id ?>" data-bs-slide-to="<?= $i ?>" <?php if ($i == 0) echo 'class="active"' ?> aria-label="Slide <?= $i + 1 ?>"></button>
                        <?php
                            $i++;
                        }
                        ?>
                    </div>
                    <div class="carousel-inner mt-2">
                        <?php
                        $i = 0;
                        foreach ($imagens as $image) {
                        ?>
                            <div class="carousel-item <?php if ($i == 0) echo 'active' ?>">
                                <img src="<?= SITE ?>/public/imoveis-images/<?= $image ?>" class="d-block w-80 carousel-img" style="border-radius: 10px;" alt="...">
                                <?php if ($i == 0) { ?>
                                    <?php if ($imovel->category == "Venda") : ?>
                                        <a href="<?= SITE ?>/imovel/<?= $imovel->imovel_slug ?>" class="btn btn-lg btn-success btn-floating btn-block" style="position: absolute; bottom: 8%; left: 50%; transform: translateX(-50%); ">Pronto para venda</a>
                                    <?php elseif ($imovel->category == "Aluguel") : ?>
                                        <a href="<?= SITE ?>/imovel/<?= $imovel->imovel_slug ?>" class="btn btn-lg btn-primary btn-floating btn-block" style="position: absolute; bottom: 8%; left: 50%; transform: translateX(-50%); ">Pronto para alugar</a>
                                    <?php elseif ($imovel->category == "Temporada") : ?>
                                        <a href="<?= SITE ?>/imovel/<?= $imovel->imovel_slug ?>" class="btn btn-lg btn-info btn-floating btn-block" style="position: absolute; bottom: 8%; left: 50%; transform: translateX(-50%); ">Temporada</a>
                                    <?php elseif ($imovel->category == "Diária") : ?>
                                        <a href="<?= SITE ?>/imovel/<?= $imovel->imovel_slug ?>" class="btn btn-lg btn-light btn-floating btn-block" style="position: absolute; bottom: 8%; left: 50%; transform: translateX(-50%); ">Diária</a>
                                    <?php endif; ?>

                                <?php } ?>
                            </div>
                        <?php
                            $i++;
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators<?= $imovel->id ?>" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators<?= $imovel->id ?>" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <a href="<?= SITE ?>/imovel/<?= $imovel->imovel_slug ?>" style="text-decoration: none; color:#000;">
                    <div class="card-body">
                        <span class="" style="margin-left:;"><?= $imovel->imovel_name ?></span>
                        <p class="card-text">
                            <span style="font-size: 28px; margin-left:10px ;"><?= 'R$ ' . number_format($imovel->price, 2, ',', '.');  ?></span>
                        </p>
                </a>
                <div class="card-footer" style="width: 100%;">
                    <ul class="list-group list-group-flush m-0">
                        <li class="list-group-item"><i class="fa-solid fa-location-dot"></i> Localização: <?= $imovel->imovel_locality ?></li>
                        <li class="list-group-item"><i class="fa-solid fa-user"></i> Proprietário: <strong><?= $imovel->proprietario ?></strong></li>
                        <li class="list-group-item"><i class="fa-solid fa-upload"></i> Publicado em <span>
                                <?php
                                $data = new DateTime($imovel->registration_date);
                                $hora = new DateTime($imovel->registration_time);

                                $data_f = $data->format("d/m/Y");
                                $hora_f = $hora->format("H:i:s");

                                echo  $data_f . " ás " . $hora_f;
                                ?>
                            </span></li>

                    </ul>
                </div>
            </div>
</div>
<?php endforeach; ?>
<nav aria-label="Page navigation" class="mt-4">
    <ul class="pagination justify-content-center" id="paginationList">
        <li class="page-item <?php if ($page == 1) echo 'disabled'; ?>">
            <button class="page-link" data-page="<?= $page - 1 ?>" <?php if ($page == 1) echo 'disabled'; ?>>Anterior</button>
        </li>

        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                <button class="page-link" data-page="<?= $i ?>"><?= $i ?></button>
            </li>
        <?php endfor; ?>

        <li class="page-item <?php if ($page == $totalPages) echo 'disabled'; ?>">
            <button class="page-link" data-page="<?= $page + 1 ?>" <?php if ($page == $totalPages) echo 'disabled'; ?>>Próximo</button>
        </li>
    </ul>
</nav>
</div>
<?php else : ?>
    <span class="text-center h4 ">Sem Resultados</span>
<?php endif ?>