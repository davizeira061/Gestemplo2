<?php
include "components/acessorestrito.php";
include_once "components/conexao.php";

$buscaLider = "select * from lider order by nome";
$resultLider = mysqli_query($conn, $buscaLider);
$qtdLider = mysqli_num_rows($resultLider);

$id = $_SESSION['idLider'];
$comando = "select * from relatorio as r
join lider as l
on r.lider = l.idLider
order by r.dataReuniao desc
limit $qtdLider";
$resultado = mysqli_query($conn, $comando);
$result = mysqli_query($conn, $comando);

$resultL = mysqli_query($conn, $buscaLider);
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
    <script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
<?php
include_once "components/header.php";
?>
<div class="container">
    <h3>Bem Vindo Lider!</h3>
    <hr>
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">Ultimos Relatórios</div>
                <div class="panel-body">
                    <table class="table table-hover table-responsive hidden-xs">
                        <tr class="title-table">
                            <th>Data</th>
                            <th>Pequeno Grupo</th>
                            <th>Ações</th>
                        </tr>
                        <?php while ($relatorio = mysqli_fetch_array($resultado)){
                        $dataReuniao = $relatorio['dataReuniao'];
                        $dataReuniao = dataBrasil($dataReuniao);
                        ?>
                        <tr>
                            <td><?php print $dataReuniao ?></td>
                            <td><?php print $relatorio['nomePG'] ?></td>
                            <td>
                                <a href="vizualizarrelatorio.php?id=<?php print $relatorio['idRelatorio'] ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <a href="pdfrelatorio.php?id=<?php print $relatorio['idRelatorio'] ?>" class="btn btn-default btn-xs" target="_blank"><span class="glyphicon glyphicon-print"></span></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                    <table class="table hidden-md hidden-md hidden-lg">
                        <?php while ($relat = mysqli_fetch_array($result)){
                            $dataReuniao = $relat['dataReuniao'];
                            $dataReuniao = dataBrasil($dataReuniao);
                            ?>
                            <tr>
                                <td>
                                    <h4><?php print $relat['nomePG'] ?></h4>
                                    <?php print $dataReuniao ?>
                                </td>
                                <td class="text-right">
                                    <br/>
                                    <a href="pdfrelatorio.php?id=<?php print $relat['idRelatorio'] ?>" class="btn btn-primary" target="_blank"><span class="glyphicon glyphicon-print"></span></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">Lista de Lideres</div>
                <div class="panel-body">
                    <table class="table table-responsive hidden-xs">
                        <tr class="title-table">
                            <th>Lider</th>
                            <th>Nome PG</th>
                            <th>Celular</th>
                        </tr>
                        <?php while ($lider = mysqli_fetch_array($resultLider)){ ?>
                        <tr>
                            <td>
                                <div class="btn btn-xs <?php if ($lider['logado'] == 2){print "text-success";}else{print "text-danger";} ?>"><span class="glyphicon glyphicon-record"></span></div>
                                <?php print $lider['nome'] ?>
                            </td>
                            <td><?php print $lider['nomePG'] ?></td>
                            <td><?php print $lider['telefone'] ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                    <table class="table hidden-md hidden-md hidden-lg">
                        <?php while ($l = mysqli_fetch_array($resultL)){
                             $whats = preparaWhatsApp($l['telefone']);
                            ?>
                            <tr>
                                <td>
                                    <h4>
                                        <div class="btn btn-xs <?php if ($l['logado'] == 2){print "text-success";}else{print "text-danger";} ?>"><span class="glyphicon glyphicon-record"></span></div>
                                        <?php print $l['nome'] ?>
                                    </h4>
                                    <?php print $l['nomePG'] ?><br/>
                                    <?php print $l['telefone'] ?>
                                </td>
                                <td class="text-right">
                                    <br/>
                                    <a href="https://api.whatsapp.com/send?phone=55<?php print $whats ?>&text=Oi!" target="_blank">
                                        <img src="img/whatsapp.svg" width="50px">
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/bootstrap.min.js"></script>
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
