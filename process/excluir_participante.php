<?php
include_once "../components/acessorestrito.php";
$id = $_POST['id'];
include_once "../components/conexao.php";
$comando = "delete from participante where id_part = $id";
mysqli_query($conn, $comando);

header("location: ../participantes.php?msg=Participante Excluido com Sucesso!");
?>