<?php
session_start();
include_once "components/conexao.php";
$q = "select link from msg where Id = 1";
$r = mysqli_query($conn, $q);
$d = mysqli_fetch_array($r);
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
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="padding-topo hidden-xs"></div>
    <div class="row">
        <div class="col-sm-4 col-sm-offset-2">
            <br/>
            <img src="<?php print $d['link']; ?>" class="img-responsive">
        </div>
        <div class="col-sm-4">
            <br/>
            <form class="form-signin" action="process/validalogin.php" method="post">
                <img src="img/logopg.png" class="form-signin-heading img-responsive">
                <label for="inputEmail" class="sr-only">Email</label>
                <input name="Email" type="email" id="inputEmail" class="form-control" placeholder="E-mail" required>
                <label for="inputPassword" class="sr-only">Senha</label>
                <input name="Senha" type="password" id="inputPassword" class="form-control" placeholder="Senha" required>
                <button class="btn btn-md btn-primary btn-block" type="submit">ENTRAR</button>
            </form>
        </div>
    </div>
</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php include_once "components/mensagem.php" ?>
</body>
</html>
