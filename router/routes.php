<?php


$routes = [

    #Views
    "/" => "HomeController@index",
    "/login" => "UserController@login",
    "/cadastrese" => "UserController@cadastrar",
    "/imovel/{id}"=> "ItemsController@imovel",

    #admin
    "/admin"=> "AdminController@authAdmin",
    "/admin/painel" => "AdminController@adminPainel",
    "/admin/logout" => "AdminController@logoutAdmin",
    
    
    # --------------------------------------------------------------
    #APIs 
    
    #admin
    "/admin/auth"=> "AdminController@loginAdmin",


    #imoveis
    "/cadastra/imovel"=> "ItemsController@cadastra_imovel",
    "/processa/imovel-imagens" => "ItemsController@processaImagem"
];