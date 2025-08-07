<?php
include "components/acessorestrito.php";
include_once "components/conexao.php";
$dataConsolidar = dataMysql($_POST['Consolidado']);


$comando = "select dataReuniao,
sum(crenteMaior12) as crenteMaior12,
sum(crenteMenores12) as crenteMenores12,
sum(naoCrenteMaior12) as naoCrenteMaior12,
sum(naoCrenteMenores12) as naoCrenteMenores12,
sum(totalPessoas) as totalPessoas
from relatorio
where dataReuniao = '$dataConsolidar';";

$resultado = mysqli_query($conn, $comando);
$dados = mysqli_fetch_array($resultado);
$data = $dados['dataReuniao'];
$data = dataBrasil($data);


$html = ('
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Relatórios PG</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<section class="pdf-pagina">
    <div class="container">
        <div>
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="text-center"><img src="img/logoibpaz.png" class="altura-img-lg"></h1>
                    <h2 class="text-center"><b>Relatório de Reunião<br/>Pequeno Grupo IBPaz</b></h2>
                    <h3 class="text-center"><img src="img/logopg.png" class="altura-img"></h3>
                </div>
            </div>
            <div class="row pdf-espaco-top">
                <div class="col-sm-12">
                    <p>
                        <b>1. Data da reunião:</b><br/>
                        <em>'.$data.'</em>
                    </p>
                    <br/>
                </div>
                <div class="col-sm-12">
                    <p>
                        <b>2. Supervisor de PGs:</b><br/>
                        <em>'.$_SESSION['nome'].'</em>
                    </p>
                    <br/>
                </div>
                <div class="col-sm-12">
                    <p>
                        <b>3. Quantidade de crentes (batizadas) presentes na reunião:</b><br/>
                        Maiores de 12 anos:<br/>
                        <em>'.$dados['crenteMaior12'].'</em><br/>
                        Menores de 12 anos:<br/>
                        <em>'.$dados['crenteMenores12'].'</em>
                    </p>
                    <br/>
                </div>
                <div class="col-sm-12">
                    <p>
                        <b>4. Quantidade de não crentes presentes na reunião:</b><br/>
                        Maiores de 12 anos: <br/>
                        <em>'.$dados['naoCrenteMaior12'].'</em><br/>
                        Menores de 12 anos:<br/>
                        <em>'.$dados['naoCrenteMenores12'].'</em>
                    </p>
                    <br/>
                </div>
                <div class="col-sm-12">
                    <p>
                        <b>5. Quantidade total na reunião:</b><br/>
                        <em>'.$dados['totalPessoas'].'</em><br/>
                        Observações quanto a quantidade de participantes nesta reunião:<br/>
                        <em>...</em>
                    </p>
                    <br/>
                </div>
                <div class="col-sm-12">
                    <p>
                        <b>6. Impressões do líder quanto à lição e uso do livro do participante:</b><br/>
                        <em>...</em>
                    </p>
                    <br/>
                </div>
                <div class="col-sm-12">
                    <p>
                        <b>7. Pedidos de oração:</b><br/>
                        <em>...</em>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
');


//referenciar o DomPDF com namespace
use Dompdf\Dompdf;

// include autoloader
require_once("dompdf/autoload.inc.php");

//Criando a Instancia
$dompdf = new DOMPDF();

// Carrega seu HTML
$dompdf->load_html($html);

//Renderizar o html
$dompdf->render();

//Exibibir a página
$dompdf->stream(
    "Relatório - Consolidado ".$dados['dataReuniao'],
    array(
        "Attachment" => false //Para realizar o download somente alterar para true
    )
);
?>