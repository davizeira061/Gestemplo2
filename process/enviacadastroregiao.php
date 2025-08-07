<?php
include_once "../components/acessorestrito.php";
include_once "../components/conexao.php";
$nomeRegiao = mb_strtoupper($_POST['NomeRegiao']);
$idResp = $_POST['idResp'];

$comm = "insert into regiao (nomeRegiao,idResp,criado) values ('$nomeRegiao','$idResp',now())";
mysqli_query($conn,$comm);

header("location: ../novaregiao.php?msg=Regiao Cadastrada com Sucesso!");

?>