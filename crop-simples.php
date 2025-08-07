<?php
include "components/acessorestrito.php";
include_once "components/conexao.php";

$id = $_SESSION['idLider'];
$foto = $_SESSION['foto'];


?>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <title>Gerenciador de Relatórios PG</title>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.Jcrop.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/exemplo.css" type="text/css" />
    <link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<?php
include_once "components/header.php";
?>

<div class="container">

    <h3>Alterar Foto</h3>
    <hr>

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
                @unlink($_SESSION['foto']);
                $_SESSION['foto'] = $localimagem;
                $comando = "update lider set foto = '$localimagem' where idLider = '$id';";
                mysqli_query($conn,$comando);
            }
        }
    }
    ?>

    <?php if( $tem_crop === true ): ?>
        <h4 id="tit-jcrop">Recorte a imagem</h4>
        <div id="div-jcrop">

            <div id="div-preview">
                <?php echo $preview; ?>
            </div>

            <?php echo $img; ?>

            <input type="button" value="Alterar" id="btn-crop" />
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
                        $('#tit-jcrop').html('Foto Alterada com Sucesso!<br />');
                    });
                    return false;
                });
            });

            function exibePreview(c)
            {
                var rx = 100 / c.w;
                var ry = 100 / c.h;

                $('#preview').css({
                    width: Math.round(rx * <?php echo $imagesize[0]; ?>) + 'px',
                    height: Math.round(ry * <?php echo $imagesize[1]; ?>) + 'px',
                    marginLeft: '-' + Math.round(rx * c.x) + 'px',
                    marginTop: '-' + Math.round(ry * c.y) + 'px'
                });

                $('#x').val(c.x);
                $('#y').val(c.y);
                $('#x2').val(c.x2);
                $('#y2').val(c.y2);
                $('#w').val(c.w);
                $('#h').val(c.h);

            };
        </script>
    <?php else: ?>
        <form name="frm-jcrop" id="frm-jcrop" method="post" action="crop-simples.php" enctype="multipart/form-data">
            <p>
                <label for="foto" class="upload" id="nomeFoto">Envie uma imagem:</label>
                <input type="file" name="imagem" id="foto" class="hidden" />
                <input type="submit" value="Enviar" />
            </p>
        </form>
    <?php endif; ?>
    <script>
        $('#foto').change(function () {
            var nome_arquivo = $( this ).val().split("\\").pop();
            $('#nomeFoto').html(nome_arquivo);
        });
    </script>
</div>
</body>
</html>