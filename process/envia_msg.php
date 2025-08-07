<?php
include_once "../components/acessorestrito.php";
include_once "../components/conexao.php";

// BUSCA MSG ATUAL
$q = "select link from msg where Id = 1";
$r = mysqli_query($conn, $q);
$d = mysqli_fetch_array($r);
$link = $d['link'];

$msg = $_FILES['msg'];
$d2 = date('d-m-Y');

// TRATA NOME DA IMAGEM
$name = $msg['name'];
$tmp  = $msg['tmp_name'];
$pasta   ='../img/'; //Pasta onde a imagem será salva
$name = 'msg_'.$d2.'.jpg';

// REMOVE IMAGEM SE FOR DIFERENTE
if ($link != 'img/'.$name) {unlink("../".$link);}

// ENVIA IMAGEM
$upload = move_uploaded_file($tmp, $pasta.$name) or die ('erro de envio da foto');

$commLP = "update msg set link = 'img/$name' where Id = 1";
mysqli_query($conn,$commLP);

header("location: ../home.php?msg=Mensagem Alterada com Sucesso!");