<?php
    require_once 'php/global.php';
    require_once 'php/game.php';

    $playerLevel = myLevel();
?>

<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dungeon Ascendancy</title>
    <link rel="stylesheet" href="style/global.css" />
    <script type="text/javascript" src="js/global.js"></script>
    <link rel="stylesheet" href="style/game.css" />
    <title>Inicio</title>
</head>
<body>
    
    <div class="game">
        <div class="nav">
            <div class="profileInfo">
                <img src="style/imgs/defaultProfile.png" alt="" class="profileImage" width="96px" height="96px">
                <p class="name"><?php echo $_SESSION['playerName']; ?></p>
                <p class="level">Level <?php echo $playerLevel['level']; ?></p>
                <div class="level-progress">
                    <div class="xp" style="width:<?php echo $playerLevel['xp_percentage'] ?>%;"></div>
                    <p class="text"><?php echo "${playerLevel['xp']} / ${playerLevel['nextLevelXp']} XP"; ?></p>
                </div>
            </div>
            <div class="currency">
                <div class="money"><img class="currencyImg" src="style/imgs/money.png"><p class="value"><?php echo $_SESSION['playerMoney']; ?></p></div>
                <div class="gem"><img class="currencyImg" src="style/imgs/gem.png"><p class="value"><?php echo $_SESSION['playerGems']; ?></p></div>
                <div class="sgem"><img class="currencyImg" src="style/imgs/sgem.png"><p class="value"><?php echo $_SESSION['playerSGems']; ?></p></div>
            </div>
        </div>
        <button class="logout" onclick="window.location = 'php/logout.php';">Sair</button>
        <div class="gameLogo"><img src="style/imgs/logo1024px.png" alt="" class="logo"></div>
        <div class="gameNav"></div>
        <div class="gameArea"></div>
    </div>
</body>
</html>