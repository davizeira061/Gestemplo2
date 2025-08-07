<?php
include_once "components/conexao.php";
include_once "components/functions.php";

$idPG = $_POST['idRegiao'];
$nomePG = $_POST['nomeRegiao'];
$endereco = $_POST['endereco'];
$bairro = $_POST['bairro'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$queryPG = "select * from pg where id_pg = $idPG";
$resultadoPG = mysqli_query($conn, $queryPG);
$dadosPG = mysqli_fetch_array($resultadoPG);

$sql = "select * from participante where id_grupo = $idPG order by nome_part";
$resultado = mysqli_query($conn, $sql);

$sqlLider = "select * from lider where idLider = {$dadosPG['id_do_lider']}";
$resultadoLider = mysqli_query($conn, $sqlLider);
$dadosLider = mysqli_fetch_array($resultadoLider);
?>
<style>
    #mapa {
        height:320px;
        width:100%;
    }
</style>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-xs-6"><?php print $nomePG ?></div>
            <div class="col-xs-6 text-right"><?php print $bairro ?></div>
        </div>
    </div>
    <div class="panel-body">
        <div id="mapa"></div>
        <?php
        if ($endereco != ""){
            print "<br/>";
        }
        print $endereco;
        ?>
        <hr>
        <a href="https://www.waze.com/ul?ll=<?php print $lat ?>%2C<?php print $lng ?>&navigate=yes&zoom=16" class="btn btn-primary" target="_blank">Waze</a>
        <a href="https://maps.google.com/maps?q=<?php print $lat ?>%2C<?php print $lng ?>&z=17&hl=pt-BR" class="btn btn-warning" target="_blank">Google Maps</a>
        <a href="https://api.whatsapp.com/send?text=https%3A%2F%2Fmaps.google.com%2Fmaps%3Fq%3D<?php print $lat ?>%252C<?php print $lng ?>%26z%3D17%26hl%3Dpt-BR" class="btn btn-success" target="_blank">WhatsApp</a>
        <hr>
        <h4>LISTA DE PARTICIPANTES:</h4>
        <table class="table">
            <tr>
                <td>
                    <?php print $dadosLider['nome']?>
                </td>
                <td>
                    (Lider)
                    <?php
                    if ($dadosPG['id_do_anfitriao'] == $dadosLider['idLider']){print "(Anfitrião)";}
                    ?>
                </td>
            </tr>
            <?php while ($dadosPart = mysqli_fetch_array($resultado)){ ?>
            <tr>
                <td><?php print $dadosPart['nome_part']?></td>
                <td><?php
                    if ($dadosPG['id_do_anfitriao'] == $dadosPart['id_part']){print "(Anfitrião)";}
                ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>
<script>

    function inicializar() {
        var coordenadas = {lat: <?php print $lat ?>, lng: <?php print $lng ?>};

        var mapa = new google.maps.Map(document.getElementById('mapa'), {
            zoom: 15,
            center: coordenadas
        });

        var marker = new google.maps.Marker({
            position: coordenadas,
            map: mapa,
            title: 'Meu marcador'
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDegnWIazCp460z24qCom-rzgRRS5AN4Gc&callback=inicializar">
</script>