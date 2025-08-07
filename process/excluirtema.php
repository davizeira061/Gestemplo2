<?php
include_once "../components/acessorestrito.php";
$id = $_POST['id'];
include_once "../components/conexao.php";

$sql = "select pre,pos,cartilha from temas where idTema = $id";
$res = mysqli_query($conn,$sql);
$d = mysqli_fetch_array($res);

unlink("../".$d['pre']);
unlink("../".$d['pos']);
unlink("../".$d['cartilha']);

$comando = "delete from temas where idTema = $id";
mysqli_query($conn, $comando);
header("location: ../tema.php?msg=Tema Excluido com Sucesso!");
?>