<?php
session_start();
if (! isset($_SESSION['nome'])){
    header("location: index.php?msg=Área Restrita!");
}

/// Funções

function dataMysql($data){
    date_default_timezone_set('America/Cuiaba');
    $data = str_replace("/", "-", $data);
    return date('Y-m-d', strtotime($data));
}
function dataBrasil($data){
    date_default_timezone_set('America/Cuiaba');
    return date('d/m/Y', strtotime($data));
}
function dataNome($data){
    date_default_timezone_set('America/Cuiaba');
    return date('d-m-Y', strtotime($data));
}
function ultimaReuniao($participante){
    global $conn;
    $query = "select data_Reuniao from presenca where id_participante = $participante order by data_Reuniao desc";
    $resposta = mysqli_query($conn, $query);
    $dados = mysqli_fetch_array($resposta);
    return $dados['data_Reuniao'];
}
function preparaWhatsApp($Telefone){
    $Telefone = str_replace("(", "", $Telefone);
    $Telefone = str_replace(")", "", $Telefone);
    $Telefone = str_replace(" ", "", $Telefone);
    $Telefone = str_replace("-", "", $Telefone);
    return $Telefone;
}
?>