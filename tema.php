<?php
include "components/acessorestrito.php";
include_once "components/conexao.php";
$comTema = "select * from temas";
$resultTema = mysqli_query($conn, $comTema);
$resultT = mysqli_query($conn, $comTema);
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
        <h3>Lista de Temas</h3>
        <?php if ($_SESSION['nivel']==1){ ?>
            <hr>
        <?php }?>
        <div class="row">
            <?php if ($_SESSION['nivel']==1){ ?>
                <div class="col-sm-12">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".novaregiao">Novo Tema</button>
                    <br/><br/>
                </div>
            <?php }?>
            <div class="col-sm-12">
                <table class="table table-hover hidden-xs">
                    <tr class="title-table">
                        <th>Tema</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                    <?php while ($dadosTema = mysqli_fetch_array($resultTema)){
                        $datTema = dataBrasil($dadosTema['dataTema']);
                        ?>
                        <tr>
                            <td><?php print $dadosTema['nomeTema'] ?></td>
                            <td><?php print $datTema ?></td>
                            <td>
                                <form method="post" action="process/excluirtema.php">
                                    <input class="hidden" name="id" value="<?php print $dadosTema['idTema']?>">
                                    <?php if ($_SESSION['nivel']==1){ ?>
                                        <button type="button" onclick="enviaTema('<?php print $dadosTema['idTema']?>','<?php print $dadosTema['nomeTema'] ?>','<?php print $datTema ?>')" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".editarregiao"><span class="glyphicon glyphicon-pencil"></span></button>
                                        <button class="btn btn-xs btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                                    <?php }?>
                                    <?php if ($dadosTema['pre'] != ""){ ?>
                                        <a href="<?php print $dadosTema['pre']?>" download="<?php print $dadosTema['pre']?>" class="btn btn-xs btn-warning">PRÊ</a>
                                    <?php }
                                    if ($dadosTema['pos'] != ""){ ?>
                                        <a href="<?php print $dadosTema['pos']?>" download="<?php print $dadosTema['pos']?>" class="btn btn-xs btn-info">PÓS</a>
                                    <?php }
                                    if ($dadosTema['cartilha'] != ""){ ?>
                                        <a href="<?php print $dadosTema['cartilha']?>" download="<?php print $dadosTema['cartilha']?>" class="btn btn-xs btn-success">CARTILHA</a>
                                    <?php }?>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <table class="table hidden-md hidden-md hidden-lg">
                    <?php while ($dadosT = mysqli_fetch_array($resultT)){
                        $datTema = dataBrasil($dadosT['dataTema']);
                        ?>
                        <tr>
                            <td>
                                <h4><?php print $dadosT['nomeTema'] ?></h4>
                                <?php print $datTema ?><br/><br/>
                                <form method="post" action="process/excluirtema.php">
                                    <input class="hidden" name="id" value="<?php print $dadosT['idTema']?>">
                                    <?php if ($_SESSION['nivel']==1){ ?>
                                        <button type="button" onclick="enviaTema('<?php print $dadosT['idTema']?>','<?php print $dadosT['nomeTema'] ?>','<?php print $datTema ?>')" class="btn btn-primary" data-toggle="modal" data-target=".editarregiao"><span class="glyphicon glyphicon-pencil"></span></button>
                                        <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                                    <?php }?>
                                    <?php if ($dadosT['pre'] != ""){ ?>
                                        <a href="<?php print $dadosT['pre']?>" download="<?php print $dadosT['pre']?>" class="btn btn-warning">PRÊ</a>
                                    <?php }
                                    if ($dadosT['pos'] != ""){ ?>
                                        <a href="<?php print $dadosT['pos']?>" download="<?php print $dadosT['pos']?>" class="btn btn-info">PÓS</a>
                                    <?php }
                                    if ($dadosT['cartilha'] != ""){ ?>
                                        <a href="<?php print $dadosT['cartilha']?>" download="<?php print $dadosT['cartilha']?>" class="btn btn-success">CARTILHA</a>
                                    <?php }?>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- Formulário de Cadastro -->
<div class="modal fade novaregiao" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="process/enviacadastrotema.php" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4>Novo Tema</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            Nome do Tema:
                            <input type="text" name="NomeTema" class="form-control maiuscula" required>
                        </div>
                        <div class="col-sm-6">
                            Data do Tema:
                            <input type="text" name="DataTema" class="form-control" required>
                        </div>
                        <div class="col-sm-12">
                            <div id="label-envia-LA">
                                <label for="enviaLA" class="upload" id="nomeLA">Lição Antes da Reunião</label>
                                <input type="file" name="enviaLA" id="enviaLA" accept="image/jpeg" class="hidden" />
                                <input type="text" id="LA" name="LA" value="0" class="hidden">
                            </div>
                            <div id="label-envia-LP">
                                <label for="enviaLP" class="upload" id="nomeLP">Lição Pós a Reunião</label>
                                <input type="file" name="enviaLP" id="enviaLP" accept="image/jpeg" class="hidden" />
                                <input type="text" id="LP" name="LP" value="0" class="hidden">
                            </div>
                            <div id="label-envia-CA">
                                <label for="enviaCA" class="upload" id="nomeCA">Cartilha do Tema</label>
                                <input type="file" name="enviaCA" id="enviaCA" accept="application/pdf" class="hidden" />
                                <input type="text" id="CA" name="CA" value="0" class="hidden">
                            </div>
                        </div>
                    </div>
                    <br/>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
                    <button class="btn btn-success" type="submit">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#enviaLA').change(function () {
        var nome_arquivo = $( this ).val().split("\\").pop();
        $('#nomeLA').html('Arquivo Selecionado: <br/>'+nome_arquivo);
        $('#LA').val(1);
    });
    $('#enviaLP').change(function () {
        var nome_arquivo = $( this ).val().split("\\").pop();
        $('#nomeLP').html('Arquivo Selecionado: <br/>'+nome_arquivo);
        $('#LP').val(1);
    });
    $('#enviaCA').change(function () {
        var nome_arquivo = $( this ).val().split("\\").pop();
        $('#nomeCA').html('Arquivo Selecionado: <br/>'+nome_arquivo);
        $('#CA').val(1);
    });
</script>

<script>
    function enviaTema(idTema, nomeTema, dataTema) {
        document.getElementById('idTema').value = idTema;
        document.getElementById('nomeTema').value = nomeTema;
        document.getElementById('dataTema').value = dataTema;
    }
</script>

<!-- Formulário de Editar -->
<div class="modal fade editarregiao" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="process/enviaalteracaotema.php" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4>Alterar Tema</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" name="idTema" id="idTema" class="form-control hidden">
                            Nome do Tema:
                            <input type="text" name="NomeTema" class="form-control maiuscula" id="nomeTema">
                        </div>
                        <div class="col-sm-6">
                            Data do Tema:
                            <input type="text" name="DataTema" class="form-control" id="dataTema">
                        </div>
                        <div class="col-sm-12 hidden" id="arquivos">
                            <input type="text" name="altArquivos" id="altArquivos" value="0" class="form-control hidden">
                            <div id="label-envia-LA">
                                <label for="AenviaLA" class="upload" id="AnomeLA">Lição Antes da Reunião</label>
                                <input type="file" name="enviaLA" id="AenviaLA" accept="image/jpeg" class="hidden" />
                                <input type="text" name="altPre" id="altPre" value="0" class="form-control hidden">
                            </div>
                            <div id="label-envia-LP">
                                <label for="AenviaLP" class="upload" id="AnomeLP">Lição Pós a Reunião</label>
                                <input type="file" name="enviaLP" id="AenviaLP" accept="image/jpeg" class="hidden" />
                                <input type="text" name="altPos" id="altPos" value="0" class="form-control hidden">
                            </div>
                            <div id="label-envia-CA">
                                <label for="AenviaCA" class="upload" id="AnomeCA">Cartilha do Tema</label>
                                <input type="file" name="enviaCA" id="AenviaCA" accept="application/pdf" class="hidden" />
                                <input type="text" name="altCart" id="altCart" value="0" class="form-control hidden">
                            </div>
                        </div>
                    </div>
                    <br/>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Salvar</button>
                    <button class="btn btn-info" type="button" onclick="editarArquivos()">Arquivos</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function editarArquivos() {
        $('#altArquivos').val('1');
        $('#arquivos').removeClass('hidden');
    }
</script>

<script>
    $('#AenviaLA').change(function () {
        var nome_arquivo = $( this ).val().split("\\").pop();
        $('#AnomeLA').html('Arquivo Selecionado: <br/>'+nome_arquivo);
        $('#altPre').val('1');
    });
    $('#AenviaLP').change(function () {
        var nome_arquivo = $( this ).val().split("\\").pop();
        $('#AnomeLP').html('Arquivo Selecionado: <br/>'+nome_arquivo);
        $('#altPos').val('1');
    });
    $('#AenviaCA').change(function () {
        var nome_arquivo = $( this ).val().split("\\").pop();
        $('#AnomeCA').html('Arquivo Selecionado: <br/>'+nome_arquivo);
        $('#altCart').val('1');
    });
</script>

<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.mask.min.js"></script>
<script>
    $(document).ready(function(){
        $('[name=DataTema]').mask('00/00/0000');
    });
</script>
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
