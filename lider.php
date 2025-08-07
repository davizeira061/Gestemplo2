<?php
include "components/acessorestrito.php";
include_once "components/conexao.php";
$comando = "select * from lider as l
join regiao as r
on l.regiao = r.idRegiao
order by l.nome";
$resultado = mysqli_query($conn, $comando);
$result = mysqli_query($conn, $comando);
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
        <h3>Lista de Lideres</h3>
        <hr>
        <div class="row">
            <?php if ($_SESSION['nivel']==1){ ?>
                <div class="col-sm-8">
                    <a href="newlider.php" class="btn btn-primary">Novo Lider</a>
                    <br class="hidden-sm hidden-md hidden-lg"/><br class="hidden-sm hidden-md hidden-lg"/>
                </div>
            <?php }?>
            <div class="col-sm-4">
                <form id="busca">
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
                        <input type="text" class="form-control" id="campo" name="campo" placeholder="Lider, Região ou PG">
                    </div>
                </form>
            </div>
            <div class="col-sm-12" id="resultado">
                <br/>
                <table class="table table-hover detal hidden-xs">
                    <tr class="title-table">
                        <th>Lider</th>
                        <th>Nome PG</th>
                        <th>Regiao</th>
                        <th>Celular</th>
                        <th>E-mail</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                    <?php while ($dadosLider = mysqli_fetch_array($resultado)){
                        $status = $dadosLider['status'];
                        ?>
                        <tr>
                            <td data-toggle="modal" data-target=".detalhes" onclick="enviaDados('<?php if (empty($dadosLider['foto'])){print "img/foto.jpg";}else{ print $dadosLider['foto']; } ?>', '<?php print $dadosLider['nome'] ?>', '<?php print $dadosLider['nomePG'] ?>', '<?php print $dadosLider['nomeRegiao'] ?>', '<?php print $dadosLider['telefone'] ?>', '<?php print $dadosLider['email'] ?>', '<?php print $dadosLider['status'] ?>')"><?php print $dadosLider['nome'] ?></td>
                            <td data-toggle="modal" data-target=".detalhes" onclick="enviaDados('<?php if (empty($dadosLider['foto'])){print "img/foto.jpg";}else{ print $dadosLider['foto']; } ?>', '<?php print $dadosLider['nome'] ?>', '<?php print $dadosLider['nomePG'] ?>', '<?php print $dadosLider['nomeRegiao'] ?>', '<?php print $dadosLider['telefone'] ?>', '<?php print $dadosLider['email'] ?>', '<?php print $dadosLider['status'] ?>')"><?php print $dadosLider['nomePG'] ?></td>
                            <td data-toggle="modal" data-target=".detalhes" onclick="enviaDados('<?php if (empty($dadosLider['foto'])){print "img/foto.jpg";}else{ print $dadosLider['foto']; } ?>', '<?php print $dadosLider['nome'] ?>', '<?php print $dadosLider['nomePG'] ?>', '<?php print $dadosLider['nomeRegiao'] ?>', '<?php print $dadosLider['telefone'] ?>', '<?php print $dadosLider['email'] ?>', '<?php print $dadosLider['status'] ?>')"><?php print $dadosLider['nomeRegiao'] ?></td>
                            <td data-toggle="modal" data-target=".detalhes" onclick="enviaDados('<?php if (empty($dadosLider['foto'])){print "img/foto.jpg";}else{ print $dadosLider['foto']; } ?>', '<?php print $dadosLider['nome'] ?>', '<?php print $dadosLider['nomePG'] ?>', '<?php print $dadosLider['nomeRegiao'] ?>', '<?php print $dadosLider['telefone'] ?>', '<?php print $dadosLider['email'] ?>', '<?php print $dadosLider['status'] ?>')"><?php print $dadosLider['telefone'] ?></td>
                            <td data-toggle="modal" data-target=".detalhes" onclick="enviaDados('<?php if (empty($dadosLider['foto'])){print "img/foto.jpg";}else{ print $dadosLider['foto']; } ?>', '<?php print $dadosLider['nome'] ?>', '<?php print $dadosLider['nomePG'] ?>', '<?php print $dadosLider['nomeRegiao'] ?>', '<?php print $dadosLider['telefone'] ?>', '<?php print $dadosLider['email'] ?>', '<?php print $dadosLider['status'] ?>')"><?php print $dadosLider['email'] ?></td>
                            <td>
                                <span class="<?php if ($status == 'Inativo'){ print "text-danger"; }else{ print "text-success";} ?>">
                                    <?php print $status ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($_SESSION['nivel'] == 1 || $_SESSION['idLider'] == $dadosLider['idLider']){ ?>
                                    <form method="post" action="process/excluirlider.php">
                                        <input class="hidden" name="id" value="<?php print $dadosLider['idLider']?>">
                                        <a class="btn btn-xs btn-primary" href="editarlider.php?id=<?php print $dadosLider['idLider']?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                        <?php if ($_SESSION['nivel'] == 1){ ?>
                                            <button class="btn btn-xs btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                                        <?php } ?>
                                    </form>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <table class="table hidden-md hidden-md hidden-lg">
                    <?php while ($dLider = mysqli_fetch_array($result)){
                        $status = $dLider['status'];
                        ?>
                        <tr>
                            <td>
                                <h4><?php print $dLider['nome'] ?></h4>
                                <?php print $dLider['nomePG'] ?><br/>
                                <?php print $dLider['telefone'] ?><br/>
                                <span class="<?php if ($status == 'Inativo'){ print "text-danger"; }else{ print "text-success";} ?>">
                                    <?php print $status ?>
                                </span>
                            </td>
                            <td class="text-right">
                                <br/><br/>
                                <?php if ($_SESSION['nivel'] == 1 || $_SESSION['idLider'] == $dLider['idLider']){ ?>
                                    <form method="post" action="process/excluirlider.php">
                                        <input class="hidden" name="id" value="<?php print $dLider['idLider']?>">
                                        <a class="btn btn-primary" href="editarlider.php?id=<?php print $dLider['idLider']?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                        <?php if ($_SESSION['nivel'] == 1){ ?>
                                            <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                                        <?php } ?>
                                    </form>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- DETALHES DO LIDER -->
<div class="modal fade detalhes" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4>INFORMAÇÕES DETALHADAS</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="hidden" id="foto"></div>
                    </div>
                    <div class="col-sm-8">
                        <h4 class="title-detalhes"><div class="hidden" id="nome"></div></h4>
                        <span><div class="hidden" id="pg"></div></span>
                        <span><div class="hidden" id="regiao"></div></span>
                        <span><div class="hidden" id="celular"></div></span>
                        <span><div class="hidden" id="email"></div></span>
                        <span><div class="hidden" id="status"></div></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/bootstrap.min.js"></script>
<script src="js/busca.js"></script>
<script>
    function enviaDados(foto,nome,pg,regiao,celular,email,status) {
        $('#foto').html("<img class='img-responsive img-thumbnail' src="+foto+" >").removeClass('hidden');
        $('#nome').html(nome).removeClass('hidden');
        $('#pg').html(pg).removeClass('hidden');
        $('#regiao').html(regiao).removeClass('hidden');
        $('#celular').html(celular).removeClass('hidden');
        $('#email').html(email).removeClass('hidden');
        $('#status').html(status).removeClass('hidden');
    }
</script>
<?php
include_once "components/mensagem.php";
?>
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
