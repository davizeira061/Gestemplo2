<?php
include_once "../components/acessorestrito.php";
include_once "../components/conexao.php";
$idTema = $_POST['idTema'];
$nomeTema = mb_strtoupper($_POST['NomeTema']);
$dataTema = dataMysql($_POST['DataTema']);
$alterar = $_POST['altArquivos'];
$altPre = $_POST['altPre'];
$altPos = $_POST['altPos'];
$altCart = $_POST['altCart'];

if ($alterar == '1'){
    // BUSCA NOME NO BANCO DE DADOS
    $q = "select pre, pos, cartilha from temas where idTema = $idTema";
    $r = mysqli_query($conn, $q);
    $d = mysqli_fetch_array($r);

    //Pasta onde a imagem será salva
    $pasta   ='../licao/';

    // TRATA PRE
    if ($altPre == '1'){
        $enviaLA = $_FILES['enviaLA'];
        $nameLA = $enviaLA['name'];
        $tmpLA  = $enviaLA['tmp_name'];
        $nameLA = 'reuniao-'.dataNome($dataTema).'.jpg';
        if ($d['pre'] != 'licao/antes/'.$nameLA) {unlink("../".$d['pre']);};
        move_uploaded_file($tmpLA, $pasta.'/antes/'.$nameLA) or die ('erro de envio da foto');
        $commLA = "update temas set pre = 'licao/antes/$nameLA' where idTema = '$idTema'";
        mysqli_query($conn,$commLA);
    }

    // TRATA POS
    if ($altPos == '1'){
        $enviaLP = $_FILES['enviaLP'];
        $nameLP = $enviaLP['name'];
        $tmpLP  = $enviaLP['tmp_name'];
        $nameLP = 'reuniao-'.dataNome($dataTema).'.jpg';
        if ($d['pos'] != 'licao/pos/'.$nameLP) {unlink("../".$d['pos']);};
        move_uploaded_file($tmpLP, $pasta.'/pos/'.$nameLP) or die ('erro de envio da foto');
        $commLP = "update temas set pos = 'licao/pos/$nameLP' where idTema = '$idTema'";
        mysqli_query($conn,$commLP);
    }

    // TRATA CARTILHA
    if ($altCart == '1'){
        $enviaCA = $_FILES['enviaCA'];
        $nameCA = $enviaCA['name'];
        $tmpCA  = $enviaCA['tmp_name'];
        $nameCA = dataNome($dataTema).'.pdf';
        if ($d['cartilha'] != 'licao/cartilha/'.$nameCA) {unlink("../".$d['cartilha']);};
        move_uploaded_file($tmpCA, $pasta.'/cartilha/'.$nameCA) or die ('erro de envio da foto');
        $commCA = "update temas set cartilha = 'licao/cartilha/$nameCA' where idTema = '$idTema'";
        mysqli_query($conn,$commCA);
    }
}
$comm = "update temas set nomeTema = '$nomeTema',dataTema = '$dataTema', modificado = now() where idTema = '$idTema'";
mysqli_query($conn,$comm);

header("location: ../tema.php?msg=Tema Alterado com Sucesso!");
?>