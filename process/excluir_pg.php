<?php
include_once "../components/acessorestrito.php";
$id = $_POST['id'];
include_once "../components/conexao.php";

$comando = "delete from pg where id_pg = $id";
mysqli_query($conn, $comando);

header("location: ../pequenosgrupos.php?msg=Grupo Excluido com Sucesso!");

?>