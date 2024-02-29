<?php
include "./_app/Config.php";
include "./models/Database.php";
include "./src/SupAid.php";

use HelpersClass\SupAid;
use Midspace\Database;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

class itemsController extends RenderView{

    public function imovel($id) {


        $query = new Database(MYSQL_CONFIG);

        $result = $query->execute_query(
            "SELECT * FROM imoveis WHERE imovel_slug = :imovel_slug",
            [":imovel_slug" => $id[0]]
        );
        if($result->affected_rows > 0) {
            $this->loadView("ImovelView", [
                "title" => $result->results[0]->imovel_name,
            ]);
        }

      
        print_r($result);

    }
    public function cadastra_imovel() {

        if(isset($_POST['imovel_name']) && isset($_POST['imovel_description']) && isset($_POST['imovel_locality']) && isset($_POST['price'])) {

            $response = array();
            $imovel_name = $_POST['imovel_name'];
            $proprietario = $_POST['proprietario'];
            $short_description = $_POST['short_description'];
            $imovel_description = $_POST['imovel_description'];
            $imovel_locality = $_POST['imovel_locality'];
            $imovel_price = $_POST['price'];
            $Helpers = new SupAid();
            $imovel_slug = $Helpers->createSlug($imovel_name);
            $database = new Database(MYSQL_CONFIG);
            
            $result = $database->execute_non_query("INSERT INTO `imoveis` (`id_admin`, `imovel_name`, `proprietario`, `imovel_slug`, `short_description`, `imovel_description`, `imovel_locality`, `price`, `registration_time`, `registration_date`, `last_update`) VALUES (:id_admin, :imovel_name, :proprietario, :imovel_slug, :short_description, :imovel_description, :imovel_locality, :price, :registration_time, :registration_date, :last_update)", [
                ":id_admin" => $_SESSION['id_admin'],
                ":imovel_name" => rtrim($imovel_name),
                ":proprietario" => $proprietario,
                ":imovel_slug" => $imovel_slug,
                ":short_description" => $short_description,
                ":imovel_description" => $imovel_description,
                ":imovel_locality" => $imovel_locality,
                ":price" => $imovel_price,
                ":registration_time" => currentTime, 
                ":registration_date" => currentDate, 
                ":last_update" => currentDate . " " . currentTime
            ]);
            if($result->status == "success") {
                $response['status'] = "success";
                $response['message'] = "Imóvel Cadastrado com sucesso!";
                $response['error'] = false;
                $response['status_code'] = 200;
                $response['imovel_id'] = $result->last_id;

            }
            else {
                $response['status'] = "error";
                $response['message'] = "Ocorreu um erro ao cadastrar o imóvel!";
                $response['error'] = true;
                $response['status_code'] = 1001;
            }

            echo json_encode($response);

            // $result = $query->execute_query(
            //     "SELECT * FROM admins WHERE email = :email OR user = :email",
            //     ["email" => $email]
            // );

            // if (!empty($result->results) && password_verify($senha, $result->results[0]->password)) {
            //     $response = $result->results[0];
            //     $_SESSION['admin'] = $response->user;
            //     $_SESSION['id_admin'] = $response->id;


            //     $dados = array(
            //         "id" => $response->id,
            //         "nome" => $response->user,
            //         "status" => "success",

            //     );

            //     echo json_encode($dados);
            // } else {
            //     $dados = array(
            //         "status" => "error"
            //     );

            //     echo json_encode($dados);
            // }
        // } 
        // else {
        //     echo json_encode(["problema" => "deu merda pae"]);
           
        }
    }

    public function processaImagem() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $response = array();
            print_r($_POST);
    
            if (!empty($_FILES['imagens']['name'][0])) {
                $diretorio_destino =  "./public/imoveis-images/";
                $images = array();

                for ($i = 0; $i < count($_FILES['imagens']['name']); $i++) {
                    $nome_original = $_FILES['imagens']['name'][$i];
                    $extensao = pathinfo($nome_original, PATHINFO_EXTENSION);
    
                    // Gerar um nome de arquivo único usando timestamp e hash único
                    $nome_unico = time() . '_' . uniqid('', true) . '.' . $extensao;
    
                    $caminho_temporario = $_FILES['imagens']['tmp_name'][$i];
                    $caminho_destino = $diretorio_destino . $nome_unico;
                    $images[] = $nome_unico;
                    move_uploaded_file($caminho_temporario, $caminho_destino);
                       
                    // Você pode usar $nome_unico como o nome único para esta imagem no seu banco de dados ou em qualquer lugar necessário
                }
                if(count($images) > 0) {
                $db = new Database(MYSQL_CONFIG);
                $db->execute_non_query("UPDATE `imoveis` SET `imovel_images` = :imovel_images WHERE `imoveis`.`id` = :id_imovel", [
                    ":id_imovel" => $_POST["imovel_id"],
                    ":imovel_images" => implode(", ",$images)
                ]);
                }
                $response['status'] = 'success';
                $response['message'] = 'Imagens Salvas com sucesso!';
                $response['error'] = false;
                $response['status_code'] = 200;
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Ocorreu um erro ao processar imagens enviadas';
                $response['error'] = true;
                $response['status_code'] = 1005;
            }
    
            echo json_encode($response);
        }
    }
}