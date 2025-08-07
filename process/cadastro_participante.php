<?php
include_once "../components/acessorestrito.php";
include_once "../components/conexao.php";

$NomePart = mb_strtoupper($_POST['NomePart']);
$id_PG = $_POST['id_PG'];
$DataNascimento = dataMysql($_POST['DataNascimento']);
$DataInicioPG = dataMysql($_POST['DataInicioPG']);
$DataBatismo = dataMysql($_POST['DataBatismo']);
$LocalBatismo = mb_strtoupper($_POST['LocalBatismo']);
$Telefone = $_POST['Telefone'];
$obsPart = $_POST['obsPart'];
$NaoBatizou = $_POST['batizou'];

if ($NaoBatizou == 1){
    $comando = "INSERT INTO `participante`(`id_grupo`, `nome_part`, `nascimento_part`, `inicio_pg`, `telefone_part`, `obs_part`,`criado`)
            values ($id_PG, '$NomePart', '$DataNascimento', '$DataInicioPG', '$Telefone', '$obsPart', now())";
}else{
    $comando = "INSERT INTO `participante`(`id_grupo`, `nome_part`, `nascimento_part`, `inicio_pg`, `data_batismo`, `local_batismo`, `telefone_part`, `obs_part`,`criado`)
            values ($id_PG, '$NomePart', '$DataNascimento', '$DataInicioPG', '$DataBatismo', '$LocalBatismo', '$Telefone', '$obsPart', now())";
}
mysqli_query($conn, $comando);
header("location: ../participantes.php?msg=Participante Cadastrado com Sucesso!");
?>