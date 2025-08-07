<?php
include "components/acessorestrito.php";
include_once "components/conexao.php";
include_once "components/mensagem.php";
?>
<?php

// memory limit (nem todo server aceita)
ini_set("memory_limit","50M");
set_time_limit(0);

// processa arquivo
$imagem		= isset( $_FILES['imagem'] ) ? $_FILES['imagem'] : NULL;
$tem_crop	= false;
$img		= '';
if( $imagem['tmp_name'] )
{
    $imagesize = getimagesize( $imagem['tmp_name'] );
    if( $imagesize !== false )
    {
        date_default_timezone_set('America/Cuiaba');
        $date = date('d-m-Y H:i');
        $localimagem = 'img/'.md5($imagem['name'].$date).".jpg";

        if( move_uploaded_file( $imagem['tmp_name'], $localimagem ) )
        {
            include( 'm2brimagem.class.php' );
            $oImg = new m2brimagem( $localimagem );
            if( $oImg->valida() == 'OK' )
            {
                $oImg->redimensiona( '400', '', '' );
                $oImg->grava( $localimagem );

                $imagesize 	= getimagesize( $localimagem );
                $img		= '<img src="'.$localimagem.'" id="jcrop" '.$imagesize[3].' />';
                $preview	= '<img src="'.$localimagem.'" id="preview" '.$imagesize[3].' />';
                $tem_crop 	= true;
            }
        }
    }
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
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.Jcrop.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php
include_once "components/header.php";
?>
<section>
    <div class="container">
        <h3>Cadastro Lider de Pequeno Grupo</h3>
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <?php if( $tem_crop === true ): ?>
                    <h4 id="tit-jcrop">Recorte a imagem</h4>
                    <div id="div-jcrop">
                        <?php echo $img; ?>
                        <br/>
                        <button class="btn btn-primary" id="btn-crop">Recortar</button>
                    </div>
                    <div id="debug" class="hidden">
                        <p><strong>X</strong> <input type="text" id="x" size="5" disabled /> x <input type="text" id="x2" size="5" disabled /> </p>
                        <p><strong>Y</strong> <input type="text" id="y" size="5" disabled /> x <input type="text" id="y2" size="5" disabled /> </p>
                        <p><strong>Dimensões</strong> <input type="text" id="h" size="5" disabled /> x <input type="text" id="w" size="5" disabled /></p>
                    </div>
                    <script type="text/javascript">
                        var img = '<?php echo $localimagem; ?>';

                        $(function(){
                            $('#jcrop').Jcrop({
                                onChange: exibePreview,
                                onSelect: exibePreview,
                                aspectRatio: 1
                            });
                            $('#btn-crop').click(function(){
                                $.post( 'crop.php', {
                                    img:img,
                                    x: $('#x').val(),
                                    y: $('#y').val(),
                                    w: $('#w').val(),
                                    h: $('#h').val()
                                }, function(){
                                    $('#div-jcrop').html( '<img src="' + img + '?' + Math.random() + '" width="'+$('#w').val()+'" height="'+$('#h').val()+'" />' );
                                    $('#debug').hide();
                                    $('#tit-jcrop').html('Foto Enviada com Sucesso!<br />');
                                });
                                return false;
                            });
                        });

                        function exibePreview(c)
                        {
                            var rx = 100 / c.w;
                            var ry = 100 / c.h;

                            $('#x').val(c.x);
                            $('#y').val(c.y);
                            $('#x2').val(c.x2);
                            $('#y2').val(c.y2);
                            $('#w').val(c.w);
                            $('#h').val(c.h);

                        };
                    </script>
                <?php else: ?>
                    <form name="frm-jcrop" id="frm-jcrop" method="post" action="newlider.php" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-2 hidden" id="btn-envia-foto">
                                <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                            </div>
                            <div class="col-sm-12" id="label-envia-foto">
                                <label for="foto" class="upload2" id="nomeFoto">Envie uma imagem:</label>
                                <input type="file" name="imagem" id="foto" class="hidden" />
                            </div>
                        </div>
                    </form>
                <?php endif; ?>
                <script>
                    $('#foto').change(function () {
                        var nome_arquivo = $( this ).val().split("\\").pop();
                        $('#nomeFoto').html(nome_arquivo);
                        $('#btn-envia-foto').removeClass('hidden');
                        $('#label-envia-foto').removeClass('col-sm-12').addClass('col-sm-10');
                    });
                </script>
            </div>
            <form method="post" action="process/enviacadastrolider.php" enctype="multipart/form-data">
                <div class="col-sm-6">
                    Nome:
                    <input type="text" name="Nome" class="form-control maiuscula" required>
                </div>
                <div class="col-sm-6">
                    Nome do Pequeno Grupo:
                    <input type="text" name="NomePG" class="form-control maiuscula" required>
                </div>
                <div class="col-sm-6">
                    E-mail:
                    <input type="email" name="Email" class="form-control" required>
                </div>
                <div class="col-sm-3">
                    Celular:
                    <input type="text" name="Telefone" class="form-control" required>
                </div>
                <div class="col-sm-3">
                    Senha:
                    <input type="password" name="Senha" class="form-control" required>
                </div>
                <div class="col-sm-3">
                    Nivel de Acesso:
                    <select name="nivelacesso" class="form-control">
                        <option value="3">Lider</option>
                        <option value="2">Supervisor</option>
                        <option value="1">Administrador</option>
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
                            <option value="<?php print $dadosReg['idRegiao']?>"><?php print $dadosReg['nomeRegiao']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <input type="text" name="FotoLider" value="<?php echo @$localimagem; ?>" class="form-control hidden">
                </div>
                <div class="col-sm-12">
                    <br/>
                    <a href="lider.php" class="btn btn-danger">Cancelar</a>
                    <button class="btn btn-success" type="submit">Cadastrar</button>
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
