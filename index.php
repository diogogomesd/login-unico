<?php
//iniciando a sessão
session_start();

//puxando a conexão ao bd
require 'config.php';

//verificando se está logado
if(empty($_SESSION['lg'])){
    header("Location: login.html");
}
else{
    $id = $_SESSION['lg'];
    $ip = $_SERVER['REMOTE_ADDR'];

    $sql = "SELECT * FROM usuarios WHERE id = :id AND ip = :ip";
    $sql = $pdo->prepare($sql);
    $sql->bindValue('id', $id);
    $sql->bindValue('ip', $ip);
    $sql->execute();

    //verifica se existe o ip registrado no bd
    if($sql->rowCount() === 0){
        header("Location: login.html");
        exit;
    }
}


?>