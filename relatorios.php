<?php
include "components/acessorestrito.php";
include_once "components/conexao.php";

//Informações da query
$busca = "SELECT count(*) AS 'num_registros' FROM relatorio as r  join lider as l on r.lider = l.idLider";

// Maximo de registros por pagina
$maximo = 50;

// Declaração de pagina inicial
@$pagina = $_GET['pagina'];
if ($pagina == ""){
    $pagina = "1";
}

// Calculando o registro inicial
$inicio = $pagina -1;
$inicio = $maximo * $inicio;

// Conta os Resultados no total da query
$strCount = mysqli_query($conn, $busca);
$row = mysqli_fetch_array($strCount);
$total = $row["num_registros"];

//
$id = $_SESSION['idLider'];

if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2){
    $comando = "select * from relatorio as r
    join lider as l
    on r.lider = l.idLider
    order by r.dataReuniao desc LIMIT $inicio,$maximo";
}else{
    $comando = "select * from relatorio as r
    join lider as l
    on r.lider = l.idLider
    where r.lider = $id
    order by r.dataReuniao desc LIMIT $inicio,$maximo";

}
$resultado = mysqli_query($conn, $comando);
$result = mysqli_query($conn, $comando);

// comando pra planilha do excel
$comandoEX = "select * from relatorio as r
    join lider as l
    on r.lider = l.idLider
    order by r.dataReuniao desc";
$resultadoEx = mysqli_query($conn, $comandoEX);
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
        <h3>Relatórios</h3>
        <hr>
        <div class="row">
            <div class="col-sm-4">
                <a href="newrelatorio.php" class="btn btn-success">Novo</a>
                <?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2) {?>
                <button class="btn btn-primary botaoExcel">Excel</button>
                <?php } ?>
                <br class="hidden-sm hidden-md hidden-lg"/><br class="hidden-sm hidden-md hidden-lg"/>
            </div>
            <div class="col-sm-4">
                <?php if ($_SESSION['nivel'] == 1) {?>
                <form method="post" action="pdfrelatorioConsolidado.php" name="Consolidar" id="Consolidar">
                    <div class="input-group">
                        <input type="text" class="form-control" name="Consolidado" placeholder="Digite a Data">
                        <div class="input-group-addon consolidar tr-link" onclick="document.Consolidar.submit()">Consolidar</div>
                    </div>
                </form>
                <?php } ?>
                <br class="hidden-sm hidden-md hidden-lg"/>
            </div>
            <div class="col-sm-4">
                <form id="buscaRelatorio">
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
                        <input type="text" class="form-control" id="filtro" name="filtro" placeholder="Lider, PG, Tema ou Data">
                    </div>
                </form>
            </div>
            <div class="col-sm-12" id="resultadoFiltro">
                <br/>
                <!-- TABELA PARA VER NA PAGINA -->
                <table class="table hidden-xs">
                    <tr class="title-table">
                        <th>Lider</th>
                        <th>Nome PG</th>
                        <th>Tema</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                    <?php while ($relatorio = mysqli_fetch_array($resultado)){
                    $dataReuniao = $relatorio['dataReuniao'];
                    $dataReuniao = dataBrasil($dataReuniao);
                    $status = $relatorio['status'];
                    ?>
                        <tr>
                            <td><?php print $relatorio['nome'] ?></td>
                            <td><?php print $relatorio['nomePG'] ?></td>
                            <td><?php print $relatorio['temaReuniao']?></td>
                            <td><?php print $dataReuniao ?></td>
                            <td>
                                <a href="editarrelatorio.php?id=<?php print $relatorio['idRelatorio']?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="vizualizarrelatorio.php?id=<?php print $relatorio['idRelatorio']?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <a href="pdfrelatorio.php?id=<?php print $relatorio['idRelatorio']?>" class="btn btn-default btn-xs" target="_blank"><span class="glyphicon glyphicon-print"></span></a>
                                <?php if ($_SESSION['nivel'] == 1) {?>
                                    <a href="process/excluirrelatorio.php?id=<?php print $relatorio['idRelatorio']?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>

                <!-- TABELA PARA O CELULAR -->
                <table class="table hidden-sm hidden-md hidden-lg">
                    <?php while ($DRelatorio = mysqli_fetch_array($result)){
                        $dataReuniao = $DRelatorio['dataReuniao'];
                        $dataReuniao = dataBrasil($dataReuniao);
                        $status = $DRelatorio['status'];
                        ?>
                        <tr>
                            <td>
                                <h4><?php print $DRelatorio['nome'] ?></h4>
                                <?php print $DRelatorio['nomePG'] ?><br/>
                                <?php print $DRelatorio['temaReuniao']?><br/>
                                <?php print $dataReuniao ?>
                            </td>
                            <td class="text-right">
                                <br/><br/>
                                <a href="editarrelatorio.php?id=<?php print $DRelatorio['idRelatorio']?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="pdfrelatorio.php?id=<?php print $DRelatorio['idRelatorio']?>" class="btn btn-default" target="_blank"><span class="glyphicon glyphicon-print"></span></a>
                                <?php if ($_SESSION['nivel'] == 1) {?>
                                    <a href="process/excluirrelatorio.php?id=<?php print $DRelatorio['idRelatorio']?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>

                <!-- TABELA PARA O EXCEL -->
                <table class="table hidden" id="Exportar_para_Excel">
                    <tr class="title-table">
                        <th>Lider</th>
                        <th>Nome PG</th>
                        <th>Data</th>
                        <th>Tema</th>
                        <th>Crentes Maiores de 12 anos</th>
                        <th>Crentes Menores de 12 anos</th>
                        <th>Maiores de 12 anos</th>
                        <th>Menores de 12 anos</th>
                        <th>Total de Pessoas Reunião</th>
                        <th>Obs. Reunião</th>
                        <th>Obs. Participante</th>
                        <th>Oração</th>
                        <th>Lista de Presença</th>
                    </tr>
                    <?php while ($relatorio = mysqli_fetch_array($resultadoEx)){
                        $dataReuniao = $relatorio['dataReuniao'];
                        $dataReuniao = dataBrasil($dataReuniao);
                        $status = $relatorio['status'];
                        $idReuniao = $relatorio['idRelatorio'];
                        ?>
                        <tr>
                            <td><?php print $relatorio['nome'] ?></td>
                            <td><?php print $relatorio['nomePG'] ?></td>
                            <td><?php print $relatorio['dataReuniao'] ?></td>
                            <td><?php print $relatorio['temaReuniao'] ?></td>
                            <td><?php print $relatorio['crenteMaior12'] ?></td>
                            <td><?php print $relatorio['crenteMenores12'] ?></td>
                            <td><?php print $relatorio['naoCrenteMaior12'] ?></td>
                            <td><?php print $relatorio['naoCrenteMenores12'] ?></td>
                            <td><?php print $relatorio['totalPessoas'] ?></td>
                            <td><?php print $relatorio['obsPessoas'] ?></td>
                            <td><?php print $relatorio['obsLicao'] ?></td>
                            <td><?php print $relatorio['pedOracao'] ?></td>
                            <td>
                                <?php
                                $qPart = "select * from participante as m
                        join presenca as p
                        on p.id_participante = m.id_part
                        where p.id_reuniao = $idReuniao
                        order by m.nome_part";
                                $rPart = mysqli_query($conn, $qPart);
                                while ($dPart = mysqli_fetch_array($rPart)){
                                    print $dPart['nome_part'].", ";
                                } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php
                    //Paginação
                    $menos = $pagina - 1;
                    $mais = $pagina + 1;
                    $pgs = ceil($total / $maximo);
                    if ($pgs > 1){
                        //exibição da pagina
                        if ($menos > 0){
                            echo "<li><a href=relatorios.php?pagina=".($menos)." aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
                        }
                        for ($i=1;$i <= $pgs;$i++){
                            if ($i != $pagina){
                                echo "<li><a href=relatorios.php?pagina=".($i).">$i</a></li>";
                            }else{
                                echo "<li class='active'><a>".$i."</a></li>";
                            }
                        }
                        if ($mais <= $pgs){
                            echo "<li><a href=relatorios.php?pagina=".($mais)." aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";
                        }
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</section>
<form action="arquivoExcel.php" method="post" target="_blank" id="FormularioExportacao">
    <input type="hidden" id="dados_a_enviar" name="dados_a_enviar" />
</form>
<script src="js/bootstrap.min.js"></script>
<?php include_once "components/mensagem.php" ?>
<script src="js/busca.js"></script>
<script src="js/jquery.mask.min.js"></script>
<script language="javascript">
    $(document).ready(function() {
        $(".botaoExcel").click(function(event) {
            $("#dados_a_enviar").val( $("<div>").append( $("#Exportar_para_Excel").eq(0).clone()).html());
            $("#FormularioExportacao").submit();
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('[name=Consolidado]').mask('00/00/0000');
    });
</script>
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
