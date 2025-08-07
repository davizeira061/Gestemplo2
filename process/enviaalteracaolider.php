<?php
session_start();
$id = $_POST['id'];
$nome = mb_strtoupper($_POST['Nome']);
$nomePG = mb_strtoupper($_POST['NomePG']);
$regiao = $_POST['Regiao'];
$email = $_POST['Email'];
$telefone = $_POST['Telefone'];
$senha = $_POST['Senha'];
$status = $_POST['status'];
$nivel = $_POST['nivelacesso'];
$mapa = $_POST['Mapa'];

include_once "../components/conexao.php";

if ($_SESSION['nivel']==1){
    if ($senha != "000000") {
        $senha = md5($senha);
        $comm = "UPDATE `pequenosgrupos`.`lider` SET `nome`='$nome', `nomePG`='$nomePG', `regiao`='$regiao', `telefone`='$telefone', `email`='$email', `senha`='$senha', `status`='$status', `nivelacesso`='$nivel', `mapa`='$mapa', `modificado` = now() WHERE `idLider`='$id'";
    }else{
        $comm = "UPDATE `pequenosgrupos`.`lider` SET `nome`='$nome', `nomePG`='$nomePG', `regiao`='$regiao', `telefone`='$telefone', `email`='$email', `status`='$status', `nivelacesso`='$nivel', `mapa`='$mapa', `modificado` = now() WHERE `idLider`='$id'";
    }
}else{
    if ($senha != "000000") {
        $senha = md5($senha);
        $comm = "UPDATE `pequenosgrupos`.`lider` SET `nome`='$nome', `nomePG`='$nomePG', `telefone`='$telefone', `email`='$email', `senha`='$senha', `mapa`='$mapa', `modificado` = now() WHERE `idLider`='$id'";
    }else{
        $comm = "UPDATE `pequenosgrupos`.`lider` SET `nome`='$nome', `nomePG`='$nomePG', `telefone`='$telefone', `email`='$email', `mapa`='$mapa', `modificado` = now() WHERE `idLider`='$id'";
    }
}



mysqli_query($conn, $comm);
header("location: ../lider.php?msg=Lider Alterado com Sucesso!");
?>