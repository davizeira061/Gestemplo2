<?php
include_once "../components/acessorestrito.php";
include_once "../components/conexao.php";
$nomeTema = mb_strtoupper($_POST['NomeTema']);
$dataTema = dataMysql($_POST['DataTema']);

if ($_POST['LA'] == "0" || $_POST['LP'] == "0" || $_POST['CA'] == "0"){
    header("location: ../tema.php?msg=Você não anexou o arquivo!");
}else{
    $enviaLA = $_FILES['enviaLA'];
    $enviaLP = $_FILES['enviaLP'];
    $enviaCA = $_FILES['enviaCA'];

// TRATA PRE
    $nameLA = $enviaLA['name'];
    $tmpLA  = $enviaLA['tmp_name'];
    $nameLA = 'reuniao-'.dataNome($dataTema).'.jpg';

// TRATA POS
    $nameLP = $enviaLP['name'];
    $tmpLP  = $enviaLP['tmp_name'];
    $nameLP = 'reuniao-'.dataNome($dataTema).'.jpg';

// TRATA CARTILHA
    $nameCA = $enviaCA['name'];
    $tmpCA  = $enviaCA['tmp_name'];
    $nameCA = dataNome($dataTema).'.pdf';

//Pasta onde a imagem será salva
    $pasta   ='../licao/';

// ENVIA IMAGEM
    $upLA = move_uploaded_file($tmpLA, $pasta.'/antes/'.$nameLA) or die ('erro de envio da foto');
    $upLP = move_uploaded_file($tmpLP, $pasta.'/pos/'.$nameLP) or die ('erro de envio da foto');
    $upCA = move_uploaded_file($tmpCA, $pasta.'/cartilha/'.$nameCA) or die ('erro de envio da foto');


    $comm = "insert into temas (nomeTema,dataTema,pre,pos,cartilha,criado) values ('$nomeTema','$dataTema','licao/antes/$nameLA','licao/pos/$nameLP','licao/cartilha/$nameCA',now())";
    mysqli_query($conn,$comm);

    header("location: ../tema.php?msg=Tema Cadastrado com Sucesso!");
}
?>