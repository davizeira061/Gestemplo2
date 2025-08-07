<?php
include_once "../components/acessorestrito.php";
include_once "../components/conexao.php";
$dataReuniao        = $_POST['DataReuniao'];
$lider              = $_POST['Lider'];
$crenteMaior12      = $_POST['CrenteMaior12'];
$crenteMenores12    = $_POST['CrenteMenores12'];
$naoCrenteMaior12   = $_POST['NaoCrenteMaior12'];
$naoCrenteMenores12 = $_POST['NaoCrenteMenores12'];
$totalPessoas       = $_POST['TotalPessoas'];
$obsPessoas         = $_POST['ObsPessoas'];
$obsLicao           = $_POST['ObsLicao'];
$pedOracao          = $_POST['PedOracao'];
$temaReuniao        = $_POST['TemaReuniao'];

$dataReuniao = dataMysql($dataReuniao);

$comando = "INSERT INTO `relatorio` (`dataReuniao`, `lider`, `crenteMaior12`, `crenteMenores12`, `naoCrenteMaior12`, `naoCrenteMenores12`, `totalPessoas`, `obsPessoas`, `obsLicao`, `pedOracao`,`temaReuniao`, `criado`) VALUES
('$dataReuniao', '$lider', '$crenteMaior12', '$crenteMenores12', '$naoCrenteMaior12', '$naoCrenteMenores12', '$totalPessoas', '$obsPessoas', '$obsLicao', '$pedOracao','$temaReuniao', now());";

mysqli_query($conn,$comando);

$idreuniao = mysqli_insert_id($conn);
// print "id da reunião cadastrada = ".$idreuniao."<br/>";

// TRATA LISTA DE PRESENÇA
$query = "select id_part from participante order by id_part desc limit 1;";
$resultado = mysqli_query($conn, $query);
$dP = mysqli_fetch_array($resultado);
$qtd = $dP['id_part']; // função que conta a quantidade de array
$presenca = array();
for($i=1; $i <= $qtd; $i++){
    if (isset($_POST['presenca_'.$i])){
        $presenca[$i] = $_POST['presenca_'.$i];
        $comm = "insert into presenca (id_reuniao,id_participante,data_Reuniao) values ('$idreuniao',$presenca[$i],'$dataReuniao')";
        mysqli_query($conn,$comm);
        // print "id do participante = ".$presenca[$i]."<br/>";
    }
}
header("location: ../relatorios.php?msg=Relatorio Cadastrado com Sucesso!");