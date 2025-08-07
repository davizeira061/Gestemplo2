<?php
include "components/acessorestrito.php";
include_once "components/conexao.php";
$comRegiao = "select * from regiao as r
join lider as l
on r.idResp = l.idLider";
$resultRegiao = mysqli_query($conn, $comRegiao);
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
        <h3>Lista de Regiões</h3>
        <hr>
        <div class="row">
            <div class="col-sm-6 hidden" id="ListaLideres">
                <!-- Lugar onde vai ser lançado a lista de lideres da regiao -->
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".novaregiao">Nova Região</button>
                    </div>
                    <div class="col-sm-12">
                        <br/>
                        <table class="table table-hover">
                            <tr class="title-table">
                                <th>Região</th>
                                <th>Responsável</th>
                                <th>Ações</th>
                            </tr>
                            <?php while ($dadosRegiao = mysqli_fetch_array($resultRegiao)){ ?>
                                <tr onclick="lideresRegiao('<?php print $dadosRegiao['idRegiao']?>','<?php print $dadosRegiao['nomeRegiao'] ?>')">
                                    <td class="tr-link"><?php print $dadosRegiao['nomeRegiao'] ?></td>
                                    <td class="tr-link"><?php print $dadosRegiao['nome'] ?></td>
                                    <td>
                                        <form method="post" action="process/excluirregiao.php">
                                            <input class="hidden" name="id" value="<?php print $dadosRegiao['idRegiao']?>">
                                            <button type="button" onclick="enviaRegiao('<?php print $dadosRegiao['idRegiao']?>','<?php print $dadosRegiao['nomeRegiao'] ?>','<?php print $dadosRegiao['idLider'] ?>')" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".editarregiao"><span class="glyphicon glyphicon-pencil"></span></button>
                                            <button class="btn btn-xs btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Formulário de Cadastro -->
<div class="modal fade novaregiao" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form method="post" action="process/enviacadastroregiao.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4>Nova Região</h4>
                </div>
                <div class="modal-body">
                    Nome da Região:
                    <input type="text" name="NomeRegiao" class="form-control maiuscula" required>
                    Responsável:
                    <?php
                    $comResp = "select idLider, nome from lider where nivelacesso = 1 or nivelacesso = 2";
                    $reResp = mysqli_query($conn,$comResp);
                    ?>
                    <select name="idResp" class="form-control" required>
                        <option value="">Selecione</option>
                        <?php while ($dadosResp = mysqli_fetch_array($reResp)){ ?>
                        <option value="<?php print $dadosResp['idLider']?>"><?php print $dadosResp['nome']?></option>
                        <?php } ?>
                    </select>
                    <br/>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
                    <button class="btn btn-success" type="submit">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function enviaRegiao(idRegiao, nomeRegiao, idResp) {
        document.getElementById('idRegiao').value = idRegiao;
        document.getElementById('NomeRegiao').value = nomeRegiao;
        document.getElementById('idResp').value = idResp;
    }
</script>

<!-- Formulário de Editar -->
<div class="modal fade editarregiao" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form method="post" action="process/enviaalteracaoregiao.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4>Alterar Região</h4>
                </div>
                <div class="modal-body">
                    <input type="text" name="idRegiao" id="idRegiao" class="form-control hidden">
                    Nome da Região:
                    <input type="text" name="NomeRegiao" class="form-control maiuscula" id="NomeRegiao">
                    Responsável:
                    <?php
                    $comResp = "select idLider, nome from lider where nivelacesso = 1 or nivelacesso = 2";
                    $reResp = mysqli_query($conn,$comResp);
                    ?>
                    <select name="idResp" class="form-control" id="idResp">
                        <option value="">Selecione</option>
                        <?php while ($dadosResp = mysqli_fetch_array($reResp)){ ?>
                            <option value="<?php print $dadosResp['idLider']?>"><?php print $dadosResp['nome']?></option>
                        <?php } ?>
                    </select>
                    <br/>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/bootstrap.min.js"></script>
<?php include_once "components/mensagem.php" ?>
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
    // Abre detalhes PG
    function lideresRegiao(idreg, nomereg) {
        $.ajax({
            url: 'lideresRegiao.php',
            type: 'POST',
            dataType: 'html',
            data: {'idRegiao' : idreg,'nomeRegiao' : nomereg},
            success: function (data) {
                $('#ListaLideres').empty().html(data).removeClass('hidden');
                // leva para o top
                idInterval = setInterval('topTop();', 1);
            }
        });
    }
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
