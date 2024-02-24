<?php

use Midspace\Database;

include "./_app/Config.php";
include "./models/Database.php";
include "./src/SupAid.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
class AdminController extends RenderView
{
    public function authAdmin()
    {
        $is_logged = isset($_SESSION['id_admin']) ? true : false;
        if (!$is_logged) {
            $this->loadView("AdminAuth", [
                "title" => "Autenticar | Administração",
            ]);
        } else {
            header("location: ./painel/?area=imoveis");
        }
    }

    public function loginAdmin()
    {

        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $senha = $_POST['password'];

            $query = new Database(MYSQL_CONFIG);

            $result = $query->execute_query(
                "SELECT * FROM admins WHERE email = :email OR user = :email",
                ["email" => $email]
            );

            if (!empty($result->results) && password_verify($senha, $result->results[0]->password)) {
                $response = $result->results[0];
                $_SESSION['admin'] = $response->user;
                $_SESSION['id_admin'] = $response->id;


                $dados = array(
                    "id" => $response->id,
                    "nome" => $response->user,
                    "status" => "success",

                );

                echo json_encode($dados);
            } else {
                $dados = array(
                    "status" => "error"
                );

                echo json_encode($dados);
            }
        } else {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(["error" => "Login e senha devem ser fornecidos"]);
        }
    }
    public function logoutAdmin() {
        session_start();
        unset($_SESSION);
        session_destroy();
        header('location: ./');
    }
    public function adminPainel()
    {
        $is_logged = isset($_SESSION['id_admin']) ? true : false;
        if($is_logged) {
            $this->loadView("adminPainel", [
                "title" => "Administração | {$_SESSION['admin']}",
            ]);
        }
        else {
            $this->loadView("AdminAuth", [
                "title" => "Autenticar | Administração",
            ]);
        }
    
    }
}
