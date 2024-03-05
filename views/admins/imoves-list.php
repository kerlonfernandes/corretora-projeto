<?php
session_start();

use Midspace\Database;

require "../../_app/Config.php";
require "../../models/Database.php";

$database = new Database(MYSQL_CONFIG);

$result = $database->execute_query("SELECT * FROM imoveis WHERE id_admin = :id_admin AND is_archived = 0 ORDER BY id DESC", [
    ":id_admin" => $_SESSION["id_admin"],
]);
?>

<?php if ($result->affected_rows > 0) : ?>

    <?php foreach ($result->results as $imovel) : ?>
        <?php if($imovel->is_archived != 1): ?>
        <tr>
            <td scope="row">

                <div class="text-start">
              

                    <div class="btn-group">
                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item editar" href="<?= SITE ?>/imovel/<?= $imovel->imovel_slug ?>?action=editar"><i class="fa-solid fa-pen"></i> Editar</a>
                            <a class="dropdown-item arquivar" data-id="<?= $imovel->id ?>"><i class="fa-solid fa-box-archive"></i> Arquivar</a>
                            <a class="dropdown-item apagar" data-id="<?= $imovel->id ?>"><i class="fa-solid fa-trash"></i> Apagar</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= SITE ?>/imovel/<?= $imovel->imovel_slug ?>" href="#"><i class="fa-solid fa-eye"></i> Vizualizar</a>


                        </div>
                    </div>
                </div>

             
                </div>
            </td>
            <td scope="row"><?= $imovel->id ?></th>
            <td><?= $imovel->imovel_name ?></td>
            <td><?php
                if (strlen($imovel->short_description) > 50) {
                    $shortDescription = substr($imovel->short_description, 0, 50) . "...";
                    echo $shortDescription; 
                }
                else {
                    echo $imovel->short_description; 
                }

                ?></td>
            <td><?= $imovel->imovel_locality ?></td>
            <td><?= $imovel->proprietario ?></td>
            <td><?= date("d/m/Y", strtotime($imovel->registration_date)); ?></td>
            <?php endif; ?>
        <?php endforeach; ?>
        </tr>
    <?php else : ?>
        <td>Nenhum resultado</td>
    <?php endif ?>

    <input type="hidden" class="imoveis-qtd" value="<?= $result->affected_rows ?>">
    <?php 
    
    $arquivados = $database->execute_query("SELECT COUNT(id) as total FROM imoveis WHERE id_admin = :id_admin AND is_archived = 1", [
        ":id_admin" => $_SESSION["id_admin"],
    ]);
    
    // A variável $arquivados agora contém o total de registros arquivados
    $totalArquivados = $arquivados->results[0]->total;
    ?>
    
    <input type="hidden" class="imoveis-arquivados-qtd" value="<?= $totalArquivados ?>">
