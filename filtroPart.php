<?php
include "components/acessorestrito.php";
include_once "components/conexao.php";
$idLogado = $_SESSION['idLider'];
$campo = "%{$_POST['campoPart']}%";

if ($_SESSION['nivel'] == 1 || $_SESSION['nivel'] == 2){
    $comando = "select * from participante as m
        join pg as p
        on p.id_pg = m.id_grupo
        where m.nome_part like '$campo' or p.nome_do_pg like '$campo' 
        order by m.nome_part";
}else{
    $comando = "select * from participante as m
        join pg as p
        on p.id_pg = m.id_grupo
        where m.nome_part like '$campo' and p.id_do_lider = $idLogado
        order by m.nome_part";
}

$resultado = mysqli_query($conn, $comando);
$result = mysqli_query($conn, $comando);
?>
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
            <td>
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