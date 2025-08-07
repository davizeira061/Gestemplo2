<?php
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=ExtratoRelatorios.xls");
header("Pragma: no-cache");
print ('
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
</head>
<body>
');

echo $_POST['dados_a_enviar'];

print ('
</body>
</html>
');
?>