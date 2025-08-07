<?php
include_once "../components/acessorestrito.php";
$id = $_POST['id'];
include_once "../components/conexao.php";
$comm = "select l.regiao, r.idRegiao from lider as l
join regiao as r
on l.regiao = r.idRegiao
where l.regiao = '$id'";
$ress = mysqli_query($conn,$comm);
$qtd = mysqli_num_rows($ress);

if ($qtd == 0){
    $comando = "delete from regiao where idRegiao = $id";
    mysqli_query($conn, $comando);

    header("location: ../novaregiao.php?msg=Região Excluida com Sucesso!");
}else{
    header("location: ../novaregiao.php?msg=Não foi possível excluir Região,<br/><br/> Líder vinculado.");
}
?>