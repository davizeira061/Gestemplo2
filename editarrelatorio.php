<?php
include "components/acessorestrito.php";
include_once "components/conexao.php";
include_once "components/functions.php";
$id = $_SESSION['idLider'];
$comando = "select * from lider where idLider = $id";
$resultado = mysqli_query($conn, $comando);
$dados = mysqli_fetch_array($resultado);
if ($dados['status'] == "Inativo"){
    header("location: relatorios.php?msg=Você esta Inativo!");
}else{

    $id = $_GET['id'];

    $comando = "select * from relatorio where idRelatorio = $id";
    $resultado = mysqli_query($conn, $comando);
    $dados = mysqli_fetch_array($resultado);
    $data = $dados['dataReuniao'];
    $data = dataBrasil($data);
    $liderSelect = $dados['lider'];


    $qPart = "select * from participante as m
                    join presenca as p
                    on p.id_participante = m.id_part
                    where p.id_reuniao = $id
                    order by m.nome_part";
    $rPart = mysqli_query($conn, $qPart);
    while ($dPart = mysqli_fetch_array($rPart)){
        @$nomes = $nomes.$dPart['nome_part'].', ';
    }
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
            <h3>Alterar Relatório!</h3>
            <hr>
            <div class="row">
                <form method="post" action="process/enviaalteracaorelatorio.php">
                    <div class="col-sm-3">
                        Data da Reúnião:
                        <input type="text" name="DataReuniao" value="<?php print $data ?>" class="form-control" required>
                        <input type="text" name="idRelatorio" class="hidden" value="<?php print $id ?>">
                    </div>
                    <div class="col-sm-4">
                        Tema Reunião:
                        <?php
                        $queryTema = "select * from temas order by idTema desc";
                        $resultTema = mysqli_query($conn, $queryTema);
                        ?>
                        <select name="TemaReuniao" class="form-control" required>
                            <?php while ($temas = mysqli_fetch_array($resultTema)){ ?>
                                <option value="<?php print $temas['nomeTema']?>"><?php print $temas['nomeTema']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-5">
                        Líder do PG:
                        <?php
                        $idLider = $_SESSION['idLider'];
                        if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2){
                            $queryLider = "select * from lider";
                        }else{
                            $queryLider = "select * from lider where idLider = '$idLider'";
                        }
                        $resultLider = mysqli_query($conn, $queryLider);
                        ?>
                        <select name="Lider" class="form-control" required>
                            <?php while ($lider = mysqli_fetch_array($resultLider)){ ?>
                                <option value="<?php print $lider['idLider']?>" <?php if ($liderSelect == $lider['idLider']){print "selected";} ?>><?php print $lider['nome']?>  ||  <?php print $lider['nomePG']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <br/>
                        <h4>Quantidade de crentes (Batizados) presentes na reunião:</h4>
                    </div>
                    <div class="col-sm-2">
                        Maiores de 12 Anos:
                        <input id="valor1" type="number" name="CrenteMaior12" value="<?php print $dados['crenteMaior12'] ?>" class="form-control" required>
                    </div>
                    <div class="col-sm-2">
                        Menores de 12 Anos:
                        <input id="valor2" type="number" name="CrenteMenores12" value="<?php print $dados['crenteMenores12'] ?>" class="form-control">
                    </div>
                    <div class="col-sm-12">
                        <br/>
                        <h4>Quantidade de não crentes presentes na reunião:</h4>
                    </div>
                    <div class="col-sm-2">
                        Maiores de 12 Anos:
                        <input id="valor3" type="number" name="NaoCrenteMaior12" value="<?php print $dados['naoCrenteMaior12'] ?>" class="form-control">
                    </div>
                    <div class="col-sm-2">
                        Menores de 12 Anos:
                        <input id="valor4" type="number" name="NaoCrenteMenores12" value="<?php print $dados['naoCrenteMenores12'] ?>" class="form-control">
                    </div>
                    <div class="col-sm-12">
                        <br/>
                        <h4>Quantidade total na reunião:</h4>
                    </div>
                    <div class="col-sm-2">
                        Total de Pessoas:
                        <input id="total" type="number" name="TotalPessoas" value="<?php print $dados['totalPessoas'] ?>" class="form-control" required>
                    </div>
                    <div class="col-sm-10">
                        Observações quanto a quantidade de participantes nesta reunião:
                        <input type="text" name="ObsPessoas" value="<?php print $dados['obsPessoas'] ?>" class="form-control" required>
                    </div>
                    <div class="col-sm-12">
                        Impressões do líder quanto a lição:
                        <input type="text" name="ObsLicao" value="<?php print $dados['obsLicao'] ?>" class="form-control" required>
                    </div>
                    <div class="col-sm-12">
                        <br/>
                        <h4>Pedidos de Oração:</h4>
                    </div>
                    <div class="col-sm-12">
                        <textarea name="PedOracao" class="form-control" rows="6"><?php print $dados['pedOracao'] ?></textarea>
                    </div>
                    <div class="col-sm-12">
                        <br/>
                        <?php
                        $idLider = $dados['lider'];
                        // PEGA LISTA DE PARTICIPANTES
                        $qPart = "select * from participante as m
                        join pg as p
                        on p.id_pg = m.id_grupo
                        where p.id_do_lider = $idLider
                        order by m.nome_part";
                        $rPart = mysqli_query($conn, $qPart);
                        while ($dPart = mysqli_fetch_array($rPart)){ ?>
                            <div class="checkbox-inline">
                                <label>
                                    <input type="checkbox" <?php presenca($id, $dPart['id_part']) ?> name="presenca_<?php print $dPart['id_part']?>" value="<?php print $dPart['id_part']?>" > <?php print $dPart['nome_part']?>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-sm-12">
                        <br/>
                        <a href="relatorios.php" class="btn btn-danger">Cancelar</a>
                        <button class="btn btn-success" type="submit">Salvar</button>
                        <br/><br/>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
            $('[name=DataReuniao]').mask('00/00/0000');
        });
    </script>
    <script type="text/javascript">
        $(document).ready( function() {
            $('#valor1, #valor2, #valor3, #valor4').blur(function(){
                var valor1 		= $('#valor1').val();
                var valor2 		= $('#valor2').val();
                var valor3 		= $('#valor3').val();
                var valor4 		= $('#valor4').val();

                if(valor1 == "") valor = 0;
                if(valor2 == "") valor = 0;
                if(valor3 == "") valor = 0;
                if(valor4 == "") valor = 0;

                var resultado 	= parseInt(valor1) + parseInt(valor2) + parseInt(valor3) + parseInt(valor4);
                $('#total').val(resultado);
            })
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
<?php } ?>