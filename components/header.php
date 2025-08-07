<?php
$paginaAtiva = basename($_SERVER['SCRIPT_NAME']);
?>
<header>
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Pequenos Grupos</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li <?php if($paginaAtiva == 'home.php') {print "class='active'";}?> ><a href="home.php">Home</a></li>
                    <li <?php if($paginaAtiva == 'lider.php' || $paginaAtiva == 'newlider.php' || $paginaAtiva == 'editarlider.php' ) {print "class='active'";}?> ><a href="lider.php">Lideres</a></li>
                    <li <?php if($paginaAtiva == 'participantes.php') {print "class='active'";}?> ><a href="participantes.php">Participantes</a></li>
                    <li <?php if($paginaAtiva == 'pequenosgrupos.php') {print "class='active'";}?> ><a href="pequenosgrupos.php">PG's</a></li>
                    <?php if ($_SESSION['nivel']==1){ ?>
                        <li <?php if($paginaAtiva == 'novaregiao.php') {print "class='active'";}?> ><a href="novaregiao.php">Regiões</a></li>
                        <li class="detal" data-toggle="modal" data-target=".msg"><a>Msg</a></li>
                    <?php }?>
                    <li <?php if($paginaAtiva == 'tema.php') {print "class='active'";}?> ><a href="tema.php">Lições</a></li>
                    <li <?php if($paginaAtiva == 'relatorios.php' || $paginaAtiva == 'newrelatorio.php' || $paginaAtiva == 'editarrelatorio.php' || $paginaAtiva == 'vizualizarrelatorio.php') {print "class='active'";}?> ><a href="relatorios.php">Relatórios</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li data-toggle="modal" data-target=".foto"><img src="<?php if(empty($_SESSION['foto'])){ print "img/foto.jpg"; }else{print $_SESSION['foto'];} ?>" alt="Foto Lider" class="img-circle img-header hidden-xs"></li>
                    <li class="hidden-xs"><a href="#"><?php print $_SESSION['nome'] ?></a></li>
                    <li><a href="process/sair.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Formulário de alteração da foto -->
<div class="modal fade foto" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4>Alterar Foto:</h4>
            </div>
            <div class="modal-body">
                <p><img src='<?php print $_SESSION['foto'] ?>' id='imagem' class='img-responsive view-img img-thumbnail'></p>
                <br/>
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
                <a href="crop-simples.php" class="btn btn-primary">Alterar</a>
            </div>
        </div>
    </div>
</div>

<!-- Formulário Mensagem -->
<div class="modal fade msg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form method="post" action="process/envia_msg.php" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4>Alterar Mensagem:</h4>
                </div>
                <div class="modal-body">
                    <div id="label-envia-MSG">
                        <label for="enviaMSG" class="upload" id="nomeMSG">Clique para enviar a Mensagem</label>
                        <input type="file" name="msg" id="enviaMSG" class="hidden" />
                    </div>
                    <br/>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Alterar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#enviaMSG').change(function () {
        var nome_arquivo = $( this ).val().split("\\").pop();
        $('#nomeMSG').html('Arquivo Selecionado: <br/>'+nome_arquivo);
    });
</script>