<?php
$idLider = $_SESSION['idLider'];
$buscaData = "select * from lider where idLider = $idLider";
$resultData = mysqli_query($conn,$buscaData);
$dadosData = mysqli_fetch_array($resultData);

$ultimoAcesso = $dadosData['ultimoacesso'];
$data2 = strtotime($ultimoAcesso);

date_default_timezone_set('America/Cuiaba');
$date = date('Y-m-d H:i:s');
$data1 = strtotime($date);

$diferença = (($data1 - $data2)/100)-144;

if($diferença > 15){
    $logado = "update lider set logado = 1 where idLider = $idLider";
    mysqli_query($conn, $logado);
    session_destroy();
}
?>