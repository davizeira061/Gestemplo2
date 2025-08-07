<?php
include_once "components/conexao.php";
$idRegiao = $_POST['idRegiao'];
$nomeRegiao = $_POST['nomeRegiao'];
$commReg = "select * from lider as l
join regiao as r
on l.regiao = r.idRegiao
where l.regiao = '$idRegiao'
order by l.nome";
$ressReg = mysqli_query($conn,$commReg);
?>
<div class="panel panel-default">
    <div class="panel-heading">Lideres da Região do <?php print $nomeRegiao ?></div>
    <div class="panel-body">
        <table class="table">
            <tr class="title-table">
                <th>Nome do Líder</th>
                <th>Nome do PG</th>
            </tr>
        <?php while ($dadosReg = mysqli_fetch_array($ressReg)){ ?>
            <tr>
                <td><?php print $dadosReg['nome'] ?></td>
                <td><?php print $dadosReg['nomePG'] ?></td>
            </tr>
        <?php } ?>
        </table>
    </div>
</div>