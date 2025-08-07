<?php
include_once "../components/acessorestrito.php";
include_once "../components/conexao.php";

$NomePG         = mb_strtoupper($_POST['NomePG']);
$idLider        = $_POST['idLider'];
$idAnfitriao    = $_POST['idAnfitriao'];
$EndPG          = mb_strtoupper($_POST['EndPG']);
$BairoPG        = mb_strtoupper($_POST['BairoPG']);
if ($idAnfitriao == "00"){$idAnfitriao = $idLider;}
$lat = $_POST['lat'];
$lng = $_POST['lng'];

$comm = "insert into pg (`id_do_lider`, `id_do_anfitriao`, `nome_do_pg`,`endereco_pg`,`bairro_pg`, `lat`, `lng`, `criado`) values ($idLider, $idAnfitriao, '$NomePG', '$EndPG', '$BairoPG', '$lat', '$lng', now())";
mysqli_query($conn,$comm);

$com = "update participante set funcao = 'A' where id_part = $idAnfitriao";
mysqli_query($conn,$com);

header("location: ../pequenosgrupos.php?msg=Grupo Cadastrado com Sucesso!");

?>