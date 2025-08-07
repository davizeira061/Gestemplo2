<?php
include_once "../components/acessorestrito.php";
include_once "../components/conexao.php";
$idRegiao = $_POST['idRegiao'];
$nomeRegiao = mb_strtoupper($_POST['NomeRegiao']);
$idResp = $_POST['idResp'];

$comm = "update regiao set nomeRegiao = '$nomeRegiao',idResp = '$idResp', modificado = now() where idRegiao = '$idRegiao'";
mysqli_query($conn,$comm);

header("location: ../novaregiao.php?msg=Regiao Alterada com Sucesso!");

?>