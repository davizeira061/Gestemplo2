<?php
include_once "../components/acessorestrito.php";
include_once '../components/conexao.php';
$id = $_SESSION['idLider'];
$logado = "update lider set logado = 1 where idLider = $id";
mysqli_query($conn, $logado);
session_destroy();
header("location: ../index.php")
?>