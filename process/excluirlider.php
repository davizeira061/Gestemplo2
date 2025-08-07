<?php
include_once "../components/acessorestrito.php";
$id = $_POST['id'];
include_once "../components/conexao.php";
$comando = "delete from lider where idLider = $id";
mysqli_query($conn, $comando);

header("location: ../lider.php?msg=Lider Excluido com Sucesso!");
?>