<?php
@session_start();
include_once "components/conexao.php";
$campo = "%{$_POST['campo']}%";

$comando = "select * from lider as l
join regiao as r
on l.regiao = r.idRegiao
where l.nome like '$campo' or l.nomePG like '$campo' or r.nomeRegiao like '$campo'
order by l.nome";

$resultado = mysqli_query($conn, $comando);
$result = mysqli_query($conn, $comando);
?>

<br/>
<table class="table table-hover detal hidden-xs">
    <tr class="title-table">
        <th>Lider</th>
        <th>Nome PG</th>
        <th>Regiao</th>
        <th>Celular</th>
        <th>E-mail</th>
        <th>Status</th>
        <th>Ações</th>
    </tr>
    <?php while ($dadosLider = mysqli_fetch_array($resultado)){
        $status = $dadosLider['status'];
        ?>
        <tr>
            <td data-toggle="modal" data-target=".detalhes" onclick="enviaDados('<?php if (empty($dadosLider['foto'])){print "img/foto.jpg";}else{ print $dadosLider['foto']; } ?>', '<?php print $dadosLider['nome'] ?>', '<?php print $dadosLider['nomePG'] ?>', '<?php print $dadosLider['nomeRegiao'] ?>', '<?php print $dadosLider['telefone'] ?>', '<?php print $dadosLider['email'] ?>', '<?php print $dadosLider['status'] ?>')"><?php print $dadosLider['nome'] ?></td>
            <td data-toggle="modal" data-target=".detalhes" onclick="enviaDados('<?php if (empty($dadosLider['foto'])){print "img/foto.jpg";}else{ print $dadosLider['foto']; } ?>', '<?php print $dadosLider['nome'] ?>', '<?php print $dadosLider['nomePG'] ?>', '<?php print $dadosLider['nomeRegiao'] ?>', '<?php print $dadosLider['telefone'] ?>', '<?php print $dadosLider['email'] ?>', '<?php print $dadosLider['status'] ?>')"><?php print $dadosLider['nomePG'] ?></td>
            <td data-toggle="modal" data-target=".detalhes" onclick="enviaDados('<?php if (empty($dadosLider['foto'])){print "img/foto.jpg";}else{ print $dadosLider['foto']; } ?>', '<?php print $dadosLider['nome'] ?>', '<?php print $dadosLider['nomePG'] ?>', '<?php print $dadosLider['nomeRegiao'] ?>', '<?php print $dadosLider['telefone'] ?>', '<?php print $dadosLider['email'] ?>', '<?php print $dadosLider['status'] ?>')"><?php print $dadosLider['nomeRegiao'] ?></td>
            <td data-toggle="modal" data-target=".detalhes" onclick="enviaDados('<?php if (empty($dadosLider['foto'])){print "img/foto.jpg";}else{ print $dadosLider['foto']; } ?>', '<?php print $dadosLider['nome'] ?>', '<?php print $dadosLider['nomePG'] ?>', '<?php print $dadosLider['nomeRegiao'] ?>', '<?php print $dadosLider['telefone'] ?>', '<?php print $dadosLider['email'] ?>', '<?php print $dadosLider['status'] ?>')"><?php print $dadosLider['telefone'] ?></td>
            <td data-toggle="modal" data-target=".detalhes" onclick="enviaDados('<?php if (empty($dadosLider['foto'])){print "img/foto.jpg";}else{ print $dadosLider['foto']; } ?>', '<?php print $dadosLider['nome'] ?>', '<?php print $dadosLider['nomePG'] ?>', '<?php print $dadosLider['nomeRegiao'] ?>', '<?php print $dadosLider['telefone'] ?>', '<?php print $dadosLider['email'] ?>', '<?php print $dadosLider['status'] ?>')"><?php print $dadosLider['email'] ?></td>
            <td>
                                <span class="<?php if ($status == 'Inativo'){ print "text-danger"; }else{ print "text-success";} ?>">
                                    <?php print $status ?>
                                </span>
            </td>
            <td>
                <?php if ($_SESSION['nivel'] == 1 || $_SESSION['idLider'] == $dadosLider['idLider']){ ?>
                    <form method="post" action="process/excluirlider.php">
                        <input class="hidden" name="id" value="<?php print $dadosLider['idLider']?>">
                        <a class="btn btn-xs btn-primary" href="editarlider.php?id=<?php print $dadosLider['idLider']?>"><span class="glyphicon glyphicon-pencil"></span></a>
                        <?php if ($_SESSION['nivel'] == 1){ ?>
                            <button class="btn btn-xs btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                        <?php } ?>
                    </form>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
</table>
<table class="table hidden-md hidden-md hidden-lg">
    <?php while ($dLider = mysqli_fetch_array($result)){
        $status = $dLider['status'];
        ?>
        <tr>
            <td>
                <h4><?php print $dLider['nome'] ?></h4>
                <?php print $dLider['nomePG'] ?><br/>
                <?php print $dLider['telefone'] ?><br/>
                <span class="<?php if ($status == 'Inativo'){ print "text-danger"; }else{ print "text-success";} ?>">
                                    <?php print $status ?>
                                </span>
            </td>
            <td>
                <br/><br/>
                <?php if ($_SESSION['nivel'] == 1 || $_SESSION['idLider'] == $dLider['idLider']){ ?>
                    <form method="post" action="process/excluirlider.php">
                        <input class="hidden" name="id" value="<?php print $dLider['idLider']?>">
                        <a class="btn btn-primary" href="editarlider.php?id=<?php print $dLider['idLider']?>"><span class="glyphicon glyphicon-pencil"></span></a>
                        <?php if ($_SESSION['nivel'] == 1){ ?>
                            <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                        <?php } ?>
                    </form>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
</table>