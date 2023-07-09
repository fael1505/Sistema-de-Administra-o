<?php

    require_once '../../php/global.php';

    if(!isset($_SESSION['adminLoggedin'])){ return; }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../style/global.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <p class="optionTitle">Jogo</p>
    <p class="option"><a href="options/gameItems">Itens</a></p>
    <p class="optionTitle">Configurações</p>
    <p class="option"><a href="options/">Configuraçoes gerais do jogo</a></p>
    <p class="option"><a href="options/">Senha de administrador</a></p>
</body>
</html>