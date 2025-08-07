<?php
include_once "../components/acessorestrito.php";
include_once "../components/conexao.php";
$nome = mb_strtoupper($_POST['Nome']);
$nomePG = mb_strtoupper($_POST['NomePG']);
$regiao = $_POST['Regiao'];
$email = $_POST['Email'];
$telefone = $_POST['Telefone'];
$senha = $_POST['Senha'];
$nivel = $_POST['nivelacesso'];
$mapa = $_POST['Mapa'];
$foto = $_POST['FotoLider'];

$senha = md5($senha);

$query = "select email from lider where email = '$email'";
$busca = mysqli_query($conn, $query);
$qtd = mysqli_num_rows($busca);

if ($qtd == 0){

    $comando = "insert into lider (nome, nomePG, regiao, telefone, email, senha, nivelacesso, foto, mapa, criado)
            values ('$nome','$nomePG', $regiao,'$telefone','$email','$senha','$nivel', '$foto', '$mapa',now())";
    mysqli_query($conn, $comando);
    header("location: ../lider.php?msg=Lider Cadastrado com Sucesso!");
}else{
    header("location: ../newlider.php?msg=E-mail já Cadastrado!");
};
?>