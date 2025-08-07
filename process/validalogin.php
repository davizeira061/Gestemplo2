<?php
session_start();
include_once "../components/conexao.php";
$email = $_POST['Email'];
$senha = $_POST['Senha'];

$senha = md5($senha);

$comando = "select * from lider where email = '$email' and senha = '$senha'";
$resultado = mysqli_query($conn, $comando);

$qtd = mysqli_num_rows($resultado);

if ($qtd == 1){
    $usuario = mysqli_fetch_array($resultado);
    $_SESSION['nome'] = $usuario['nome'];
    $_SESSION['nivel'] = $usuario['nivelacesso'];
    $_SESSION['idLider'] = $usuario['idLider'];
    $_SESSION['foto'] = $usuario['foto'];

    $id = $usuario['idLider'];
    $logado = "update lider set logado = 2, ultimoacesso = now() where idLider = $id";
    mysqli_query($conn, $logado);

    header("location: ../home.php");
}else{
    header("location: ../index.php?msg=Usuário ou senha inválido");
}
?>