<?php

    require_once 'global.php';
    if(!isset($_SESSION['loggedin'])){ return; }

    $_SESSION['gameSettings'] = [
        "firstLevel" => 100,
        "levelMultiplier" => 1.2345,
    ];

    function loadProfile() {
        //LOAD PROFILE INFO
        $user_id = $_SESSION['id'];
        $sql = "SELECT id, playerName, playerXp, playerMoney, playerGems, playerSGems, playerInventory FROM users WHERE id='$user_id'";

        if($result = mysqli_query(sql_link, $sql)){

            $row = $result->fetch_assoc();

            $_SESSION['playerName'] = $row['playerName'];
            $_SESSION['playerXp'] = $row['playerXp'];
            $_SESSION['playerMoney'] = $row['playerMoney'];
            $_SESSION['playerGems'] = $row['playerGems'];
            $_SESSION['playerSGems'] = $row['playerSGems'];
            $_SESSION['playerInventory'] = $row['playerInventory'];

            mysqli_close(sql_link);

            $_SESSION['profileLoaded'] = true;

            return true;

        }else{
            return false;
        }

    }

    function myLevel() {
        $gameSettings = $_SESSION['gameSettings'];

        $xp = $_SESSION['playerXp'];
        $level = 1;
        $nextLevelXp = $gameSettings['firstLevel'];
        $multiplier = $gameSettings['levelMultiplier'];

        while($xp >= $nextLevelXp) {
            $xp -= $nextLevelXp;
            $level += 1;
            $nextLevelXp *= $multiplier;
        }

        $xp_percentage = ($xp/$nextLevelXp)*100;

        return ["xp"=>number_format($xp, 2), "xp_percentage"=>number_format($xp_percentage, 2), "level"=>$level, "nextLevelXp"=>number_format($nextLevelXp, 2)];

    }
    
if(!isset($_SESSION['profileLoaded'])){
        
     if(!loadProfile()){
         echo 'Não foi possível carregar os dados do usuário.';
     }

}
?>