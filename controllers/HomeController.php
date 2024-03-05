<?php
include "./_app/Config.php";


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

class HomeController extends RenderView {

    public function index(){

        $this->loadView("Home", [
            "title"=> "Inicio | Imoveis",
        ]);

    }

}