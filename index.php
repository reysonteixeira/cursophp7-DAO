<?php
    require_once("config.php");

    //Carrega um usuario
    //$root = new Usuario();
    //$root->loadById(1);
    //echo($root);

    //Carrega uma lista de usuarios
    //$lista = Usuario::getList();
   // echo json_encode($lista);

   //Carrega uma lista de usuarios buscando pelo login
    //$search = Usuario::search("rey");
    //echo(json_encode($search));


    //Carrega usuario usando login e a senha
    $usuario = new Usuario();
    $usuario->login("reysontt@gmail.com","reyson123456");
    echo($usuario);
?>