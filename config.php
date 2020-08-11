<?php
    //nome e maquina onde está o bd
    $con = "mysql:dbname=login;host=localhost";
    $user = "root";//usuário do bd
    $pass ="";//senha do bd

    try{
        $pdo = new PDO($con, $user, $pass);
    }
    catch(PDOExeception $e){
        echo "ERRO: ".$e->getMessage();
        exit;
    }
?>