<?php
function presenca($relatorio, $participante){
    global $conn;
    // PEGA AS PRESENÇAS
    $sql = "select * from presenca where id_reuniao = $relatorio and id_participante = $participante;";
    $query = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($query);
    if ($rows > 0){
        print "checked";
    }
}
?>