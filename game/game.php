<?php

    require_once realpath("php/global.php");
    require_once realpath("php/class.simpleSQLinjectionDetect.php");

    if(!isset($_SESSION['loggedin'])){ return; }

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
        $gameSettings = json_decode(file_get_contents(realpath("game/settings/gameSettings.json")), true);

        $xp = $_SESSION['playerXp'];
        $level = 1;
        $nextLevelXp = $gameSettings['firstLevelXp'];
        $multiplier = $gameSettings['levelXpMultiplier'];

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