<?php
    require_once '../../../../../php/global.php';
    require_once '../../../../../php/sql.php';

    if(!isset($_SESSION['adminLoggedin'])) { return; }
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <form method="POST">
        <input type="submit" value="Adicionar">
        <input type="button" value="Cancelar" onclick="window.location = '../'">
    </form>
</body>
</html>