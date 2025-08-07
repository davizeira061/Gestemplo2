<?php
include "components/acessorestrito.php";
include_once "components/conexao.php";
$idLogado = $_SESSION['idLider'];
if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2){
    $comando = "select * from participante as m
    join pg as p
    on p.id_pg = m.id_grupo
    order by m.nome_part";
}else{
    $comando = "select * from participante as m
    join pg as p
    on p.id_pg = m.id_grupo
    where p.id_do_lider = $idLogado
    order by m.nome_part";
}
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
        <h3>Lista de Pasticipantes</h3>
        <hr>
        <div class="row">
            <div class="col-sm-8">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".novoParticipante">Novo Participante</button>
                <br class="hidden-sm hidden-md hidden-lg"/><br class="hidden-sm hidden-md hidden-lg"/>
            </div>
            <div class="col-sm-4">
                <form id="buscaPart">
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
                        <input type="text" class="form-control" id="campoPart" name="campoPart" placeholder="Nome do Participante ou PG">
                    </div>
                </form>
            </div>
            <div class="col-sm-12" id="resultadoPart">
                <br/>
                <table class="table table-hover detal hidden-xs">
                    <tr class="title-table">
                        <th>Participante</th>
                        <th>Nome PG</th>
                        <th>Telefone</th>
                        <th>Função</th>
                        <th>Ultima Reunião</th>
                        <th>Ações</th>
                    </tr>
                    <?php while ($dadosLider = mysqli_fetch_array($resultado)){
                        ?>
                        <tr>
                            <td data-toggle="modal" data-target=".detalhes" onclick="enviaDados('<?php print $dadosLider['nome_part'] ?>','<?php print dataBrasil($dadosLider['nascimento_part']) ?>','<?php print dataBrasil($dadosLider['inicio_pg']) ?>','<?php print dataBrasil($dadosLider['data_batismo']) ?>','<?php print $dadosLider['local_batismo'] ?>','<?php print $dadosLider['telefone_part'] ?>','<?php print $dadosLider['obs_part'] ?>','<?php print $dadosLider['funcao'] ?>','<?php print dataBrasil(ultimaReuniao($dadosLider['id_part'])); ?>')"><?php print $dadosLider['nome_part'] ?></td>
                            <td data-toggle="modal" data-target=".detalhes" onclick="enviaDados('<?php print $dadosLider['nome_part'] ?>','<?php print dataBrasil($dadosLider['nascimento_part']) ?>','<?php print dataBrasil($dadosLider['inicio_pg']) ?>','<?php print dataBrasil($dadosLider['data_batismo']) ?>','<?php print $dadosLider['local_batismo'] ?>','<?php print $dadosLider['telefone_part'] ?>','<?php print $dadosLider['obs_part'] ?>','<?php print $dadosLider['funcao'] ?>','<?php print dataBrasil(ultimaReuniao($dadosLider['id_part'])); ?>')"><?php print $dadosLider['nome_do_pg'] ?></td>
                            <td data-toggle="modal" data-target=".detalhes" onclick="enviaDados('<?php print $dadosLider['nome_part'] ?>','<?php print dataBrasil($dadosLider['nascimento_part']) ?>','<?php print dataBrasil($dadosLider['inicio_pg']) ?>','<?php print dataBrasil($dadosLider['data_batismo']) ?>','<?php print $dadosLider['local_batismo'] ?>','<?php print $dadosLider['telefone_part'] ?>','<?php print $dadosLider['obs_part'] ?>','<?php print $dadosLider['funcao'] ?>','<?php print dataBrasil(ultimaReuniao($dadosLider['id_part'])); ?>')"><?php print $dadosLider['telefone_part'] ?></td>
                            <td><?php if ($dadosLider['funcao'] == "L"){print "Líder";} elseif ($dadosLider['funcao'] == "A"){print "Anfitrião";}else{print "Participante";} ?></td>
                            <?php
                            // verifica quantos dias sem ir na reunião
                            $d1 = ultimaReuniao($dadosLider['id_part']);
                            $d1 = new DateTime($d1);
                            $d2 = date('Y-m-d');
                            $d2 = new DateTime($d2);
                            $intervalo = $d1->diff( $d2 );
                            ?>
                            <td <?php if ($intervalo->days > 29){print "class='text-danger'";}else{print "class='text-success'";} ?> > <?php if (ultimaReuniao($dadosLider['id_part']) != ""){print dataBrasil(ultimaReuniao($dadosLider['id_part']));} ?> </td>
                            <td>
                                <form method="post" action="process/excluir_participante.php">
                                    <input class="hidden" name="id" value="<?php print $dadosLider['id_part']?>">
                                    <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".AlterarParticipante" onclick="editar('<?php print $dadosLider['id_part'] ?>','<?php print $dadosLider['id_grupo'] ?>','<?php print $dadosLider['nome_part'] ?>','<?php print dataBrasil($dadosLider['nascimento_part']) ?>','<?php print dataBrasil($dadosLider['inicio_pg']) ?>','<?php print dataBrasil($dadosLider['data_batismo']) ?>','<?php print $dadosLider['local_batismo'] ?>','<?php print $dadosLider['telefone_part'] ?>','<?php print $dadosLider['obs_part'] ?>','<?php print $dadosLider['funcao'] ?>')"><span class="glyphicon glyphicon-pencil"></span></button>
                                    <?php if ($_SESSION['nivel'] == 1){ ?>
                                        <button class="btn btn-xs btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                                    <?php } ?>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <table class="table hidden-md hidden-md hidden-lg">
                    <?php while ($dLider = mysqli_fetch_array($result)){ ?>
                        <tr>
                            <td>
                                <h4><?php print $dLider['nome_part'] ?></h4>
                                <?php print $dLider['nome_do_pg'] ?><br/>
                                <?php print $dLider['telefone_part'] ?><br/>
                                <?php
                                // verifica quantos dias sem ir na reunião
                                $d1 = ultimaReuniao($dLider['id_part']);
                                $d1 = new DateTime($d1);
                                $d2 = date('Y-m-d');
                                $d2 = new DateTime($d2);
                                $intervalo = $d1->diff( $d2 );
                                ?>
                                <span class="<?php if ($intervalo->days > 29){ print "text-danger"; }else{ print "text-success";} ?>">
                                    <?php if (ultimaReuniao($dLider['id_part']) != ""){print dataBrasil(ultimaReuniao($dLider['id_part']));} ?>
                                </span>
                            </td>
                            <td class="text-right">
                                <br/><br/>
                                <form method="post" action="process/excluir_participante.php">
                                    <input class="hidden" name="id" value="<?php print $dLider['id_part']?>">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".AlterarParticipante" onclick="editar('<?php print $dLider['id_part'] ?>','<?php print $dLider['id_grupo'] ?>','<?php print $dLider['nome_part'] ?>','<?php print dataBrasil($dLider['nascimento_part']) ?>','<?php print dataBrasil($dLider['inicio_pg']) ?>','<?php print dataBrasil($dLider['data_batismo']) ?>','<?php print $dLider['local_batismo'] ?>','<?php print $dLider['telefone_part'] ?>','<?php print $dLider['obs_part'] ?>','<?php print $dLider['funcao'] ?>')"><span class="glyphicon glyphicon-pencil"></span></button>
                                    <?php if ($_SESSION['nivel'] == 1){ ?>
                                        <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                                    <?php } ?>
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
<div class="modal fade novoParticipante" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="process/cadastro_participante.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4>Novo Participante</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            Nome:
                            <input type="text" name="NomePart" class="form-control maiuscula" required>
                        </div>
                        <div class="col-sm-6">
                            Pequeno Grupo:
                            <?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2){
                                $comPG = "select id_pg, nome_do_pg from pg";
                                $rePG = mysqli_query($conn,$comPG);
                                ?>
                                <select name="id_PG" class="form-control">
                                    <?php while ($dPG = mysqli_fetch_array($rePG)){ ?>
                                        <option value="<?php print $dPG['id_pg']?>"><?php print $dPG['nome_do_pg']?></option>
                                    <?php } ?>
                                </select>
                            <?php }else{
                                $comPG = "select id_pg, nome_do_pg from pg where id_do_lider = $idLogado";
                                $rePG = mysqli_query($conn,$comPG);
                                $dPG = mysqli_fetch_array($rePG)
                                ?>
                                <input type="text" value="<?php print $dPG['nome_do_pg']?>" class="form-control" readonly>
                                <input type="number" name="id_PG" value="<?php print $dPG['id_pg']?>" class="hidden">
                            <?php } ?>
                        </div>
                        <div class="col-sm-6">
                            Data de Nascimento:
                            <input type="text" name="DataNascimento" class="form-control dataForm" required>
                        </div>
                        <div class="col-sm-6">
                            Data de Início no PG:
                            <input type="text" name="DataInicioPG" class="form-control dataForm" required>
                        </div>
                        <div id="Divbatizou">
                            <input type="text" value="0" id="batizou" name="batizou" class="hidden">
                            <div class="col-sm-6">
                                Data do Batismo:
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-danger" onclick="NaoBatizou()" type="button">Não</button>
                                </span>
                                    <input type="text" name="DataBatismo" class="form-control dataForm">
                                </div><!-- /input-group -->
                            </div>
                            <div class="col-sm-6">
                                Local do Batismo:
                                <input type="text" name="LocalBatismo" class="form-control maiuscula">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            Telefone:
                            <input type="text" name="Telefone" class="form-control telefoneForm" required>
                        </div>
                        <div class="col-sm-12">
                            Observação:
                            <textarea class="form-control" name="obsPart"></textarea>
                        </div>
                        <div class="col-sm-6">
                            <br/>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
                            <button class="btn btn-success" type="submit">Cadastrar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function NaoBatizou() {
        $('#Divbatizou').addClass('hidden');
        $('#batizou').val(1);
    }
    function NaoBatizouEdit() {
        $('#DivbatizouEdit').addClass('hidden');
        $('#batizouEdit').val(1);
    }
</script>

<!-- Formulário de Alteração -->
<div class="modal fade AlterarParticipante" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="process/alterar_participante.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4>Alterar Participante</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input class="hidden" type="text" name="id_lider" id="id_lider">
                        <div class="col-sm-12">
                            Nome:
                            <input type="text" name="EditNomePart" id="EditNomePart" class="form-control maiuscula" required>
                        </div>
                        <div class="col-sm-6">
                            Pequeno Grupo:
                            <?php if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2){
                                $comPG = "select id_pg, nome_do_pg from pg";
                                $rePG = mysqli_query($conn,$comPG);
                                ?>
                                <select name="EditId_PG" id="EditId_PG" class="form-control">
                                    <?php while ($dPG = mysqli_fetch_array($rePG)){ ?>
                                        <option value="<?php print $dPG['id_pg']?>"><?php print $dPG['nome_do_pg']?></option>
                                    <?php } ?>
                                </select>
                            <?php }else{
                                $comPG = "select id_pg, nome_do_pg from pg where id_do_lider = $idLogado";
                                $rePG = mysqli_query($conn,$comPG);
                                $dPG = mysqli_fetch_array($rePG)
                                ?>
                                <input type="text" value="<?php print $dPG['nome_do_pg']?>" class="form-control" readonly>
                                <input type="number" name="EditId_PG" value="<?php print $dPG['id_pg']?>" class="hidden">
                            <?php } ?>
                        </div>
                        <div class="col-sm-6">
                            Data de Nascimento:
                            <input type="text" name="EditDataNascimento" id="EditDataNascimento" class="form-control dataForm" required>
                        </div>
                        <div class="col-sm-6">
                            Data de Início no PG:
                            <input type="text" name="EditDataInicioPG" id="EditDataInicioPG" class="form-control dataForm" required>
                        </div>
                        <div id="DivbatizouEdit">
                            <input type="text" value="0" id="batizouEdit" name="batizou" class="hidden">
                            <div class="col-sm-6">
                                Data do Batismo:
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-danger" onclick="NaoBatizouEdit()" type="button">Não</button>
                                </span>
                                    <input type="text" name="EditDataBatismo" id="EditDataBatismo" class="form-control dataForm">
                                </div><!-- /input-group -->
                            </div>
                            <div class="col-sm-6">
                                Local do Batismo:
                                <input type="text" name="EditLocalBatismo" id="EditLocalBatismo" class="form-control maiuscula">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            Telefone:
                            <input type="text" name="EditTelefone" id="EditTelefone" class="form-control telefoneForm" required>
                        </div>
                        <div class="col-sm-12">
                            Observação:
                            <textarea class="form-control" name="EditObsPart" id="EditObsPart"></textarea>
                        </div>
                        <div class="col-sm-6">
                            <br/>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
                            <button class="btn btn-primary" type="submit">Salvar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


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
                    <div class="col-sm-8">
                        <h4 class="title-detalhes"><div class="hidden" id="nome">BRUNO FERREIRA</div></h4>
                        <span>Nasceu dia <span class="hidden" id="datanasc">17/10/1986</span></span><br/>
                        <span>Iniciou no Grupo dia <span class="hidden" id="datainico">12/03/2019</span></span><br/>
                        <span>Foi batizado dia <span class="hidden" id="databatismo">10/03/2019</span></span><br/>
                        <span>na <span class="hidden" id="localbatismo">IBPAZ Sede</span></span><br/>
                        <span>Celular: <span class="hidden" id="telefone"></span></span>
                        <hr>
                        <span class="maiuscula">Observações: </span><br/><br/>
                        <span class="hidden" id="observ"></span>
                    </div>
                    <div class="col-sm-4">
                        <span id="funcaoPart"></span>
                        <br/><br/><br/>
                        Sua ultima reunião foi dia:
                        <span id="ultimareunicao"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/bootstrap.min.js"></script>
<script src="js/busca.js"></script>
<script src="js/jquery.mask.min.js"></script>
<script>
    $(document).ready(function(){
        $('.dataForm').mask('00/00/0000');
        $('.telefoneForm').mask('(00)00000-0000');
    });
</script>
<script>
    function enviaDados(nome, nascimento, dataInicio, dataBatismo, localBatismo, telefone, observ, funcao, ultimaReuniao) {
        $('#nome').html(nome).removeClass('hidden');
        $('#datanasc').html(nascimento).removeClass('hidden');
        $('#datainico').html(dataInicio).removeClass('hidden');
        $('#databatismo').html(dataBatismo).removeClass('hidden');
        $('#localbatismo').html(localBatismo).removeClass('hidden');
        $('#telefone').html(telefone).removeClass('hidden');
        $('#observ').html(observ).removeClass('hidden');
        if (funcao == 'A') funcaoPart = 'ANFITRIÃO';
        if (funcao == 'P') funcaoPart = 'PARTICIPANTE';
        if (funcao == 'L') funcaoPart = 'LÍDER';
        $('#funcaoPart').html(funcaoPart);
        $('#ultimareunicao').html(ultimaReuniao);
    }
    function editar(id, id_pg, nome, nascimento, dataInicio, dataBatismo, localBatismo, telefone, observ, funcao) {
        $('#id_lider').val(id);
        $('#EditId_PG').val(id_pg);
        $('#EditNomePart').val(nome);
        $('#EditDataNascimento').val(nascimento);
        $('#EditDataInicioPG').val(dataInicio);
        $('#EditDataBatismo').val(dataBatismo);
        $('#EditLocalBatismo').val(localBatismo);
        $('#EditTelefone').val(telefone);
        $('#EditObsPart').val(observ);
        if (funcao == "P") $('#p').attr("checked", true);
        if (funcao == "A") $('#a').attr("checked", true);
        if (funcao == "L") $('#l').attr("checked", true);
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