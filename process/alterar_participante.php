<?php
include_once "../components/acessorestrito.php";
include_once "../components/conexao.php";

$id_lider = $_POST['id_lider'];
$EditNomePart = mb_strtoupper($_POST['EditNomePart']);
$EditId_PG = $_POST['EditId_PG'];
$EditDataNascimento = dataMysql($_POST['EditDataNascimento']);
$EditDataInicioPG = dataMysql($_POST['EditDataInicioPG']);
$EditDataBatismo = dataMysql($_POST['EditDataBatismo']);
$EditLocalBatismo = mb_strtoupper($_POST['EditLocalBatismo']);
$EditTelefone = $_POST['EditTelefone'];
$EditObsPart = $_POST['EditObsPart'];
$Editfuncao = $_POST['Editfuncao'];
$NaoBatizou = $_POST['batizou'];

if ($NaoBatizou == 1){
    $comando = "update participante set id_grupo = '$EditId_PG', nome_part = '$EditNomePart', nascimento_part = '$EditDataNascimento', inicio_pg = '$EditDataInicioPG', telefone_part = '$EditTelefone', obs_part = '$EditObsPart', modificado = now() where id_part = $id_lider";
}else{
    $comando = "update participante set id_grupo = '$EditId_PG', nome_part = '$EditNomePart', nascimento_part = '$EditDataNascimento', inicio_pg = '$EditDataInicioPG', data_batismo = '$EditDataBatismo', local_batismo = '$EditLocalBatismo', telefone_part = '$EditTelefone', obs_part = '$EditObsPart', modificado = now() where id_part = $id_lider";
}

mysqli_query($conn, $comando);
header("location: ../participantes.php?msg=Participante Alterado com Sucesso!");
?>