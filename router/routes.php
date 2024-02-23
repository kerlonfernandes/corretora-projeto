<?php


$routes = [

    "/" => "HomeController@index",
    "/login" => "UserController@login",
    "/cadastrese" => "UserController@cadastrar",
    "/imovel/{slug}"=> "",
    "/admin"=> "AdminController@authAdmin",

];