<?php
include "components/acessorestrito.php";
include_once "components/conexao.php";
$comRegiao = "select * from pg as p
join lider as l
on p.id_do_lider = l.idLider";
$resultRegiao = mysqli_query($conn, $comRegiao);
$resultR = mysqli_query($conn, $comRegiao);
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
    <link href="css/chosen.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
</head>
<body>
<?php
include_once "components/header.php";
?>
<section>
    <div class="container">
        <h3>Lista de Pequenos Grupos</h3>
        <hr>
        <div class="row">
            <div class="col-sm-6 hidden" id="ListaLideres">
                <!-- Lugar onde vai ser lançado a lista de lideres da regiao -->
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <?php if ($_SESSION['nivel']==1){ ?>
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".novopg">Novo PG</button>
                            <br/><br/>
                        </div>
                    <?php } ?>
                    <div class="col-sm-12">
                        <table class="table table-hover hidden-xs">
                            <tr class="title-table">
                                <th>Região</th>
                                <th>Responsável</th>
                                <?php if ($_SESSION['nivel']==1){ ?>
                                    <th>Ações</th>
                                <?php } ?>
                            </tr>
                            <?php while ($dadosPG = mysqli_fetch_array($resultRegiao)){ ?>
                                <tr>
                                    <td>
                                        <a class="btn-link" href="javascript:lideresRegiao('<?php print $dadosPG['id_pg']?>','<?php print $dadosPG['nome_do_pg'] ?>','<?php print $dadosPG['endereco_pg'] ?>','<?php print $dadosPG['bairro_pg'] ?>','<?php print $dadosPG['lat'] ?>','<?php print $dadosPG['lng'] ?>');"><?php print $dadosPG['nome_do_pg'] ?></a>
                                    </td>
                                    <td>
                                        <a class="btn-link" href="javascript:lideresRegiao('<?php print $dadosPG['id_pg']?>','<?php print $dadosPG['nome_do_pg'] ?>','<?php print $dadosPG['endereco_pg'] ?>','<?php print $dadosPG['bairro_pg'] ?>','<?php print $dadosPG['lat'] ?>','<?php print $dadosPG['lng'] ?>');"><?php print $dadosPG['nome'] ?></a>
                                    </td>
                                    <?php if ($_SESSION['nivel']==1){ ?>
                                        <td>
                                            <form method="post" action="process/excluir_pg.php">
                                                <input class="hidden" name="id" value="<?php print $dadosPG['id_pg']?>">
                                                <button type="button" onclick="enviaPG('<?php print $dadosPG['id_pg']?>', '<?php print $dadosPG['nome_do_pg'] ?>', '<?php print $dadosPG['endereco_pg'] ?>', '<?php print $dadosPG['bairro_pg'] ?>', '<?php print $dadosPG['id_do_lider'] ?>', '<?php print $dadosPG['id_do_anfitriao'] ?>', '<?php print $dadosPG['lat'] ?>', '<?php print $dadosPG['lng'] ?>')" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".editarregiao"><span class="glyphicon glyphicon-pencil"></span></button>
                                                <button class="btn btn-xs btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                                            </form>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </table>
                        <table class="table hidden-md hidden-md hidden-lg">
                            <?php while ($dPG = mysqli_fetch_array($resultR)){ ?>
                                <tr>
                                    <td onclick="lideresRegiao('<?php print $dPG['id_pg']?>','<?php print $dPG['nome_do_pg'] ?>','<?php print $dPG['endereco_pg'] ?>','<?php print $dPG['bairro_pg'] ?>','<?php print $dPG['lat'] ?>','<?php print $dPG['lng'] ?>');">
                                        <h4><?php print $dPG['nome_do_pg'] ?></h4>
                                        <?php print $dPG['nome'] ?>
                                    </td>
                                    <?php if ($_SESSION['nivel']==1){ ?>
                                        <td class="text-right">
                                            <br/>
                                            <form method="post" action="process/excluir_pg.php">
                                                <input class="hidden" name="id" value="<?php print $dPG['id_pg']?>">
                                                <button type="button" onclick="enviaPG('<?php print $dPG['id_pg']?>','<?php print $dPG['nome_do_pg'] ?>','<?php print $dPG['endereco_pg'] ?>','<?php print $dPG['bairro_pg'] ?>','<?php print $dPG['id_do_lider'] ?>','<?php print $dPG['id_do_anfitriao'] ?>','<?php print $dPG['lat'] ?>','<?php print $dPG['lng'] ?>')" class="btn btn-primary" data-toggle="modal" data-target=".editarregiao"><span class="glyphicon glyphicon-pencil"></span></button>
                                                <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                                            </form>
                                        </td>
                                    <?php } ?>
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
<div class="modal fade novopg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="process/cadastro_pg.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4>Novo Pequeno Grupo</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            Nome do Pequeno Grupo:
                            <input type="text" name="NomePG" class="form-control maiuscula" required>
                        </div>
                        <div class="col-sm-6">
                            Endereço:
                            <input type="text" name="EndPG" class="form-control maiuscula" required>
                        </div>
                        <div class="col-sm-6">
                            Bairro:
                            <input type="text" name="BairoPG" class="form-control maiuscula" required>
                        </div>
                        <div class="col-sm-6">
                            Líder:
                            <?php
                            $comResp = "select idLider, nome from lider";
                            $reResp = mysqli_query($conn,$comResp);
                            ?>
                            <select name="idLider" class="form-control" required>
                                <option value="">Selecione</option>
                                <?php while ($dadosResp = mysqli_fetch_array($reResp)){ ?>
                                    <option value="<?php print $dadosResp['idLider']?>"><?php print $dadosResp['nome']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            Anfitrião:
                            <?php
                            $comResp = "select id_part, nome_part from participante";
                            $reResp = mysqli_query($conn,$comResp);
                            ?>
                            <select name="idAnfitriao" class="form-control">
                                <option value="00">Selecione</option>
                                <?php while ($dadosResp = mysqli_fetch_array($reResp)){ ?>
                                    <option value="<?php print $dadosResp['id_part']?>"><?php print $dadosResp['nome_part']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            Mapa: (Latitude)
                            <input type="text" name="lat" class="form-control" placeholder="Latitude">
                        </div>
                        <div class="col-sm-6">
                            Mapa: (Logitude)
                            <input type="text" name="lng" class="form-control" placeholder="Logitude">
                        </div>
                        <div class="col-sm-12">
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
    function enviaPG(idPG, nomePG, endPG, bairoPG, idLider, idAnfitriao, lat, lng) {
        $('#idPG').val(idPG);
        $('#NomePG').val(nomePG);
        $('#enderecoPG').val(endPG);
        $('#bairroPG').val(bairoPG);
        $('#idLider').val(idLider);
        if(idAnfitriao == idLider){
            $('#idAnfitriao').val('00');
        }else{
            $('#idAnfitriao').val(idAnfitriao);
        }
        $('#lat').val(lat);
        $('#lng').val(lng);
    }
</script>

<!-- Formulário de Editar -->
<div class="modal fade editarregiao" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="process/alterar_pg.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4>Alterar Pequeno Grupo</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <input type="text" name="idPG" id="idPG" class="form-control hidden">
                            Nome do Pequeno Grupo:
                            <input type="text" name="NomePG" class="form-control maiuscula" id="NomePG">
                        </div>
                        <div class="col-sm-6">
                            Endereço:
                            <input type="text" name="enderecoPG" id="enderecoPG" class="form-control maiuscula">
                        </div>
                        <div class="col-sm-6">
                            Bairro:
                            <input type="text" name="bairroPG" id="bairroPG" class="form-control maiuscula">
                        </div>
                        <div class="col-sm-6">
                            Lider:
                            <?php
                            $comResp = "select idLider, nome from lider";
                            $reResp = mysqli_query($conn,$comResp);
                            ?>
                            <select name="idLider" class="form-control" id="idLider">
                                <option value="">Selecione</option>
                                <?php while ($dadosResp = mysqli_fetch_array($reResp)){ ?>
                                    <option value="<?php print $dadosResp['idLider']?>"><?php print $dadosResp['nome']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            Anfitrião:
                            <?php
                            $comResp = "select id_part, nome_part from participante";
                            $reResp = mysqli_query($conn,$comResp);
                            ?>
                            <select name="idAnfitriao" class="form-control" id="idAnfitriao">
                                <option value="00">Selecione</option>
                                <?php while ($dadosResp = mysqli_fetch_array($reResp)){ ?>
                                    <option value="<?php print $dadosResp['id_part']?>"><?php print $dadosResp['nome_part']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            Mapa: (Latitude)
                            <input type="text" name="lat" id="lat" class="form-control" placeholder="Latitude">
                        </div>
                        <div class="col-sm-6">
                            Mapa: (Logitude)
                            <input type="text" name="lng" id="lng" class="form-control" placeholder="Logitude">
                        </div>
                        <div class="col-sm-12">
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

<script src="js/bootstrap.min.js"></script>
<script src="js/chosen.jquery.js"></script>
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
    function lideresRegiao(idreg, nomereg, endereco, bairro, lat, lng) {
        $.ajax({
            url: 'detalhesPG.php',
            type: 'POST',
            dataType: 'html',
            data: {'idRegiao' : idreg,'nomeRegiao' : nomereg, 'endereco': endereco, 'bairro': bairro, 'lat' : lat, 'lng' : lng},
            success: function (data) {
                $('#ListaLideres').empty().html(data).removeClass('hidden');
                // leva para o top
                idInterval = setInterval('topTop();', 1);
            }
        });
    }
</script>
<script>
    // ativa chosen
    $(function() {
        $('.chosen-select').chosen();
        $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
    });
</script>
<br/><br/>
<div class="modal-footer">
    <p class="creditos">Desenvolvido Por: <a href="http://www.e2adigital.com" target="_blank">e2a Soluções Digitais!</a></p>
</div>
<a class="subirTopo" href="javascript:levTop();"><i class="glyphicon glyphicon-chevron-up"></i></a>
</body>
</html>