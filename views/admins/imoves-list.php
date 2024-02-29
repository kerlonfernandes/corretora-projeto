<?php
session_start();
use Midspace\Database;
require "../../_app/Config.php";
require "../../models/Database.php";

$database = new Database(MYSQL_CONFIG);

$result = $database->execute_query("SELECT * FROM imoveis WHERE id_admin = :id_admin", [
    ":id_admin"=> $_SESSION["id_admin"],
]);
?>

<?php if ($result->affected_rows > 0): ?>

    <?php foreach ($result->results as $imovel): ?>
    <tr>
    <td>
        <div class="text-start">
            <a href="<?= SITE ?>/imovel/<?= $imovel->imovel_slug ?>" class="btn"><i class="fa-solid fa-eye"></i><strong> Ver</strong></a>
            <div class="btn btn-primary"><i class="fa-solid fa-pen"></i></div>
            <div class="btn btn-danger"><i class="fa-solid fa-trash"></i></div>
        </div>
    </td>
    <th scope="row"><?= $imovel->id ?></th>
    <td><?= $imovel->imovel_name ?></td>
    <td><?= $imovel->imovel_description ?></td>
    <td><?= $imovel->imovel_locality ?></td>
    <td><?= $imovel->proprietario ?></td>
    <td><?= date("d/m/Y", strtotime($imovel->registration_date)); ?></td>
    <?php endforeach; ?>
    </tr>
<?php else: ?>
    <td>Nenhum resultado</td>
<?php endif ?>

<input type="hidden" class="imoveis-qtd" value="<?= $result->affected_rows ?>">