<?php
include "components/acessorestrito.php";
include_once "components/conexao.php";
$filtro = "%{$_POST['filtro']}%";

$id = $_SESSION['idLider'];

$data = dataMysql($_POST['filtro']);

if ($_SESSION['nivel'] == 1){
    $comando = "select * from relatorio as r
    join lider as l
    on r.lider = l.idLider
    where l.nome like '$filtro' or l.nomePG like '$filtro' or r.dataReuniao like '$data' or r.temaReuniao like '$filtro'
    order by r.dataReuniao desc";
}else{
    $comando = "select * from relatorio as r
    join lider as l
    on r.lider = l.idLider
    where r.lider = $id and (l.nome like '$filtro' or l.nomePG like '$filtro' or r.dataReuniao like '$data' or r.temaReuniao like '$filtro')
    order by r.dataReuniao desc";

}
$resultado = mysqli_query($conn, $comando);
$result = mysqli_query($conn, $comando);

// comando pra planilha do excel
$comandoEX = "select * from relatorio as r
    join lider as l
    on r.lider = l.idLider
    where l.nome like '$filtro' or l.nomePG like '$filtro' or r.dataReuniao like '$data' or r.temaReuniao like '$filtro'
    order by r.dataReuniao desc";
$resultadoEx = mysqli_query($conn, $comandoEX);
?>
<br/>
<!-- TABELA PARA VER NA PAGINA -->
<table class="table hidden-xs">
    <tr class="title-table">
        <th>Lider</th>
        <th>Nome PG</th>
        <th>Tema</th>
        <th>Data</th>
        <th>Ações</th>
    </tr>
    <?php while ($relatorio = mysqli_fetch_array($resultado)){
        $dataReuniao = $relatorio['dataReuniao'];
        $dataReuniao = dataBrasil($dataReuniao);
        $status = $relatorio['status'];
        ?>
        <tr>
            <td><?php print $relatorio['nome'] ?></td>
            <td><?php print $relatorio['nomePG'] ?></td>
            <td><?php print $relatorio['temaReuniao']?></td>
            <td><?php print $dataReuniao ?></td>
            <td>
                <a href="editarrelatorio.php?id=<?php print $relatorio['idRelatorio']?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                <a href="vizualizarrelatorio.php?id=<?php print $relatorio['idRelatorio']?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
                <a href="pdfrelatorio.php?id=<?php print $relatorio['idRelatorio']?>" class="btn btn-default btn-xs" target="_blank"><span class="glyphicon glyphicon-print"></span></a>
                <?php if ($_SESSION['nivel'] == 1) {?>
                    <a href="process/excluirrelatorio.php?id=<?php print $relatorio['idRelatorio']?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
</table>

<!-- TABELA PARA O CELULAR -->
<table class="table hidden-sm hidden-md hidden-lg">
    <?php while ($DRelatorio = mysqli_fetch_array($result)){
        $dataReuniao = $DRelatorio['dataReuniao'];
        $dataReuniao = dataBrasil($dataReuniao);
        $status = $DRelatorio['status'];
        ?>
        <tr>
            <td>
                <h4><?php print $DRelatorio['nome'] ?></h4>
                <?php print $DRelatorio['nomePG'] ?><br/>
                <?php print $DRelatorio['temaReuniao']?><br/>
                <?php print $dataReuniao ?>
            </td>
            <td>
                <br/><br/>
                <a href="editarrelatorio.php?id=<?php print $DRelatorio['idRelatorio']?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
                <a href="pdfrelatorio.php?id=<?php print $DRelatorio['idRelatorio']?>" class="btn btn-default" target="_blank"><span class="glyphicon glyphicon-print"></span></a>
                <?php if ($_SESSION['nivel'] == 1) {?>
                    <a href="process/excluirrelatorio.php?id=<?php print $DRelatorio['idRelatorio']?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
</table>

<!-- TABELA PARA O EXCEL -->
<table class="table hidden" id="Exportar_para_Excel">
    <tr class="title-table">
        <th>Lider</th>
        <th>Nome PG</th>
        <th>Data</th>
        <th>Tema</th>
        <th>Crentes Maiores de 12 anos</th>
        <th>Crentes Menores de 12 anos</th>
        <th>Maiores de 12 anos</th>
        <th>Menores de 12 anos</th>
        <th>Total de Pessoas Reunião</th>
        <th>Obs. Reunião</th>
        <th>Obs. Participante</th>
        <th>Oração</th>
    </tr>
    <?php while ($relatorio = mysqli_fetch_array($resultadoEx)){
        $dataReuniao = $relatorio['dataReuniao'];
        $dataReuniao = dataBrasil($dataReuniao);
        $status = $relatorio['status'];
        ?>
        <tr>
            <td><?php print $relatorio['nome'] ?></td>
            <td><?php print $relatorio['nomePG'] ?></td>
            <td><?php print $relatorio['dataReuniao'] ?></td>
            <td><?php print $relatorio['temaReuniao'] ?></td>
            <td><?php print $relatorio['crenteMaior12'] ?></td>
            <td><?php print $relatorio['crenteMenores12'] ?></td>
            <td><?php print $relatorio['naoCrenteMaior12'] ?></td>
            <td><?php print $relatorio['naoCrenteMenores12'] ?></td>
            <td><?php print $relatorio['totalPessoas'] ?></td>
            <td><?php print $relatorio['obsPessoas'] ?></td>
            <td><?php print $relatorio['obsLicao'] ?></td>
            <td><?php print $relatorio['pedOracao'] ?></td>
        </tr>
    <?php } ?>
</table>
