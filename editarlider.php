<?php
include "components/acessorestrito.php";
$id = $_GET['id'];
include_once "components/conexao.php";
$comando = "select * from lider where idLider = $id";
$resultado = mysqli_query($conn, $comando);
$lider = mysqli_fetch_array($resultado);
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
        <h3>Alterar Lider de Pequeno Grupo</h3>
        <hr>
        <div class="row">
            <form method="post" action="process/enviaalteracaolider.php">
                <div class="col-sm-6">
                    Nome:
                    <input type="text" name="Nome" class="form-control maiuscula" value="<?php print $lider['nome'] ?>">
                    <input type="text" name="id" class="hidden" value="<?php print $id ?>">
                </div>
                <div class="col-sm-6">
                    Nome do Pequeno Grupo:
                    <input type="text" name="NomePG" class="form-control maiuscula" value="<?php print $lider['nomePG'] ?>">
                </div>
                <div class="col-sm-3">
                    E-mail:
                    <input type="email" name="Email" class="form-control" value="<?php print $lider['email'] ?>">
                </div>
                <div class="col-sm-3">
                    Celular:
                    <input type="text" name="Telefone" class="form-control" value="<?php print $lider['telefone'] ?>">
                </div>
                <div class="col-sm-3">
                    Senha:
                    <input type="password" name="Senha" class="form-control" value="000000">
                </div>
                <?php if ($_SESSION['nivel'] == 1){ ?>
                    <div class="col-sm-3">
                        Status:
                        <select name="status" class="form-control">
                            <option value="Ativo">Ativo</option>
                            <option value="Inativo" <?php if ($lider['status'] == 'Inativo') print "selected" ?>>Inativo</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        Região:
                        <select name="Regiao" class="form-control">
                            <?php
                            $comReg = "select * from regiao";
                            $resultReg = mysqli_query($conn, $comReg);
                            while ($dadosReg = mysqli_fetch_array($resultReg)){
                                ?>
                                <option <?php if ($lider['regiao'] == $dadosReg['idRegiao']) print "selected" ?>  value="<?php print $dadosReg['idRegiao']?>"><?php print $dadosReg['nomeRegiao']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        Nivel de Acesso:
                        <select name="nivelacesso" class="form-control">
                            <option <?php if ($lider['nivelacesso'] == 3) print "selected" ?> value="3">Lider</option>
                            <option <?php if ($lider['nivelacesso'] == 2) print "selected" ?> value="2">Supervisor</option>
                            <option <?php if ($lider['nivelacesso'] == 1) print "selected" ?> value="1">Administrador</option>
                        </select>
                    </div>
                <?php } ?>
                <div class="col-sm-12">
                    <br/>
                    <a href="lider.php" class="btn btn-danger">Cancelar</a>
                    <button class="btn btn-primary" type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.mask.min.js"></script>
<script>
    $(document).ready(function(){
        $('[name=Telefone]').mask('(00) 00000-0000');
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
