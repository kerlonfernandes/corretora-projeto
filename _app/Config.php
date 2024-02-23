<?php

define("CONFIGURATION_DIRECTORY", __DIR__);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//MYSQL configurations 
define('MYSQL_CONFIG', [
    'host' => 'localhost',
    'database' => 'gestao_financeira',
    'username' => 'root',
    'password' => '',
]);
date_default_timezone_set('America/Sao_Paulo');

$dataHoraAtual = new DateTime();
$dataAtual = $dataHoraAtual->format('Y-m-d');
$horaAtual = $dataHoraAtual->format('H:i:s');

define("currentDate", $dataAtual);
define("currentTime", $horaAtual);

function printData($data, $die = true) {

    echo "<pre>";
    if(is_object($data) || is_array($data)) {
        print_r($data);
    }
    else {
        die(PHP_EOL . "END" . PHP_EOL);
    }

} 

$BASE_URL = "https://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI'] . "?") . "/";

define("SITE", "https://" . $_SERVER['SERVER_NAME'] . "/projeto-corretora");
