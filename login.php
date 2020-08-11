<?php
//iniciando a sessao
session_start();

//zerando a sessao 
$_SESSION['lg'] = '';

//verificando as informçãoes vindas por url do formulario login.html
if(isset($_POST['email']) && !empty(['email'])){
    $email = addslashes($_POST['email']);
    $senha = md5(addslashes($_POST['senha']));

    //pegando a conexao ao bd
    require 'config.php';

    //verifica se tem o usuario no bd
    $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(':email', $email);
    $sql->bindValue(':senha', $senha);
    $sql->execute();

    //se houver pega o id e o ip da maquina
    if($sql->rowCount() > 0){
        $sql = $sql->fetch();
        $id = $sql['id'];
        $ip = $_SERVER['REMOTE_ADDR'];

        //seta o usuario na sessao
        $_SESSION['lg'] = $id;

        //atualiza o ip da maquina que esta usando para logar no momento
        $sql = "UPDATE usuarios SET ip = :ip WHERE id = :id";
        $sql = $pdo->prepare($sql);
        $sql->bindValue('ip', $ip);
        $sql->bindValue('id', $id);
        $sql->execute();

        header("Location: index.php");
        exit;
    }
}

?>