<?php


$routes = [

    "/" => "HomeController@index",
    "/login" => "UserController@login",
    "/cadastrese" => "UserController@cadastrar",
    "/imovel/{slug}"=> "",
    "/admin"=> "AdminController@authAdmin",
    "/admin/painel" => "AdminController@adminPainel",
    "/admin/logout" => "AdminController@logoutAdmin",
    #apis
    
    "/admin/auth"=> "AdminController@loginAdmin",

];