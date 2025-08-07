<?php
include "components/acessorestrito.php";
include_once "components/conexao.php";
$id = $_GET['id'];

$comando = "select * from relatorio as r
join lider as l
on r.lider = l.idLider
where r.idRelatorio = $id";

$resultado = mysqli_query($conn, $comando);
$dados = mysqli_fetch_array($resultado);
$data = $dados['dataReuniao'];
$data = dataBrasil($data);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Gerenciador de Relatórios PG</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
</head>
<body>
<?php
include_once "components/header.php";
?>
<section>
    <div class="container">
        <h3>Relatório Reunião do Dia <?php print $data ?></h3>
        <hr>
        <div class="viwRelatorio">
            <div class="row">
                <div class="col-sm-3">
                    <h1 class="text-right hidden-xs"><img src="img/logoibpaz.png" class="altura-img-lg"></h1>
                </div>
                <div class="col-sm-6">
                    <h1 class="text-center hidden-xs"><b>Relatório de Reunião Pequeno Grupo IBPaz</b></h1>
                </div>
                <div class="col-sm-3">
                    <h1 class="text-left hidden-xs"><img src="img/logopg.png" class="altura-img"></h1>
                </div>
            </div>
            <br/><br/><br/>
            <div class="row margin-pagina">
                <div class="col-sm-12">
                    <p>
                        <b>1. Data da reunião:</b> <i><?php print $data ?></i>
                    </p>
                    <br/>
                </div>
                <div class="col-sm-12">
                    <p>
                        <b>2. Líder do PG:</b> <i><?php print $dados['nome'] ?></i>
                    </p>
                    <br/>
                </div>
                <div class="col-sm-12">
                    <p>
                        <b>3. Quantidade de crentes (batizadas) presentes na reunião:</b><br/><br/>
                        Maiores de 12 anos: <i><?php print $dados['crenteMaior12'] ?></i><br/><br/>
                        Menores de 12 anos: <i><?php print $dados['crenteMenores12'] ?></i>
                    </p>
                    <br/>
                </div>
                <div class="col-sm-12">
                    <p>
                        <b>4. Quantidade de não crentes presentes na reunião:</b><br/><br/>
                        Maiores de 12 anos: <i><?php print $dados['naoCrenteMaior12'] ?></i><br/><br/>
                        Menores de 12 anos: <i><?php print $dados['naoCrenteMenores12'] ?></i>
                    </p>
                    <br/>
                </div>
                <div class="col-sm-12">
                    <p>
                        <b>5. Quantidade total na reunião:</b><i><?php print $dados['totalPessoas'] ?></i><br/><br/>
                        Observações quanto a quantidade de participantes nesta reunião:<br/><br/>
                        <em><?php print $dados['obsPessoas'] ?></em>
                    </p>
                    <br/>
                </div>
                <div class="col-sm-12">
                    <p>
                        <b>6. Impressões do líder quanto à lição e uso do livro do participante:</b><br/><br/>
                        <em><?php print $dados['obsLicao'] ?></em>
                    </p>
                    <br/>
                </div>
                <div class="col-sm-12">
                    <p>
                        <b>7. Pedidos de oração:</b><br/><br/>
                        <em><?php print $dados['pedOracao'] ?></em>
                    </p>
                    <br/>
                </div>
                <div class="col-sm-12">
                    <p>
                        <b>8. Lista de Presença:</b><br/><br/>
                        <em>
                            <?php
                            $qPart = "select * from participante as m
                        join presenca as p
                        on p.id_participante = m.id_part
                        where p.id_reuniao = $id
                        order by m.nome_part";
                            $rPart = mysqli_query($conn, $qPart);
                            while ($dPart = mysqli_fetch_array($rPart)){
                                print $dPart['nome_part'].", ";
                            } ?>
                        </em>
                    </p>
                    <br/>
                </div>
            </div>
        </div>
        <br/>
    </div>
</section>

<script src="js/bootstrap.min.js"></script>
<?php include_once "components/mensagem.php" ?>
<br/><br/>
<div class="modal-footer">
    <p class="creditos">Desenvolvido Por: <a href="http://www.e2adigital.com" target="_blank">e2a Soluções Digitais!</a></p>
</div>
<script>
    // leva para o topo
    function topTop(){
        var totop = $(window).scrollTop()-8;
        if(totop <= 0){
            clearInterval(idInterval);
        }else{
            totop--;
            $(window).scrollTop(totop);
        }
    }
    function levTop(){
        idInterval = setInterval('topTop();', 1);
    }
</script>
<a class="subirTopo" href="javascript:levTop();"><i class="glyphicon glyphicon-chevron-up"></i></a>
</body>
</html>
