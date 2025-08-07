<?php
include_once "../components/acessorestrito.php";
$id = $_GET['id'];
include_once "../components/conexao.php";
$comando = "delete from relatorio where idRelatorio = $id";
mysqli_query($conn, $comando);

header("location: ../relatorios.php?msg=Relatório Excluido com Sucesso!");
?>