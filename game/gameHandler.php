<?php
    require_once 'php/global.php';
    require_once 'game/game.php';

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
    <script type="text/javascript" src="game/gameScripts.js"></script>
    <link rel="stylesheet" href="game/style/gameHandler.css" />
    <title>Inicio</title>
</head>
<body onload="gameNav('home')">
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
        <div class="gameNav" id="gameNav">
            <a id="home" class="item" onclick="gameNav('home')">Inicio</a>
            <a id="shop" class="item" href="javascript:gameNav('shop');">Loja</a>
            <a id="inventory" class="item" href="javascript:gameNav('inventory');">Inventário</a>
            <a id="dungeons" class="item" href="javascript:gameNav('dungeons');">Dungeons</a>
            <a id="upgrade" class="item" href="javascript:gameNav('upgrade');">Upgrade</a>
            <?php if(isset($_SESSION['isAdmin'])){ ?>
                <!-- ADMIN NAVIGATION -->
                <a id="adminLogin" class="item" href="javascript:gameNav('adminLogin');">Admin</a>
            <?php }?>
        </div>
        <div class="gameArea">
            <iframe src="" class="game" id="gameFrame"></iframe>
        </div>
    </div>
</body>
</html>