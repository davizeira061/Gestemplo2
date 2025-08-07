<?php
include_once "../components/acessorestrito.php";
include_once "../components/conexao.php";

$idPG           = $_POST['idPG'];
$NomePG         = mb_strtoupper($_POST['NomePG']);
$idLider        = $_POST['idLider'];
$idAnfitriao    = $_POST['idAnfitriao'];
if ($idAnfitriao == "00"){$idAnfitriao = $idLider;}
$EndPG          = mb_strtoupper($_POST['enderecoPG']);
$BairoPG        = mb_strtoupper($_POST['bairroPG']);
$lat = $_POST['lat'];
$lng = $_POST['lng'];

$comm = "update pg set id_do_lider = '$idLider', id_do_anfitriao = '$idAnfitriao', nome_do_pg = '$NomePG', endereco_pg = '$EndPG', bairro_pg = '$BairoPG', lat = '$lat', lng = '$lng', modificado = now() where id_pg = $idPG";
mysqli_query($conn,$comm);

// busca antigo
$q = "select * from participante where id_grupo = $idPG  and funcao = 'A'";
$r = mysqli_query($conn, $q);
$d = mysqli_fetch_array($r);
$idAntigoAnfitriao = $d['id_part'];

// seta novo
$com = "update participante set funcao = 'A' where id_part = $idAnfitriao";
mysqli_query($conn,$com);

if ($idAnfitriao != $idAntigoAnfitriao){
    $com = "update participante set funcao = 'P' where id_part = $idAntigoAnfitriao";
}

header("location: ../pequenosgrupos.php?msg=Grupo Alterado com Sucesso!");

?>