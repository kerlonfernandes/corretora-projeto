<?php
include "./_app/Config.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
class AdminController extends RenderView {

    public function authAdmin() {
        $this->loadView("AdminAuth", [
 
        ]);
    }


}