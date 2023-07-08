<?php

    require_once '../php/global.php';

    if(isset($_SESSION['adminLoggedin'])){
        header("location: admin/");
        return;
    }

    $result = "";
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){

        if(isset($_POST['adminPassword'])){
            
            $adminInfo = json_decode(file_get_contents("settings/adminSettings.json"), true);
            $inputValue = $_POST['adminPassword'];

            if($inputValue == $adminInfo['password']){
                $_SESSION['adminLoggedin'] = true;
                header("refresh:0");
            }else{ $result = "Senha inválida"; }

        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../style/global.css">
    <link rel="stylesheet" href="style/adminLogin.css">
</head>
<body>
    <form method="POST" name="adminLogin">
        <input type="password" name="adminPassword" id="pass" placeholder="Senha de administrador" autocomplete="on">
        <input type="submit" value="Entrar">
        <?php if($result<>""){echo "<p class='login_result'>$result</p>";} ?>
    </form>
</body>
</html>