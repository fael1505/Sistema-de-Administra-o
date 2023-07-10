<?php
    require_once '../../../../../php/global.php';
    require_once '../../../../../php/sql.php';

    if(!isset($_SESSION['adminLoggedin'])) { return; }
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../../../style/global.css">
    <link rel="stylesheet" href="../../../admin.css">
</head>
<body>
    <form method="POST">
        <p class="optionTitle">Informações basicas</p>
        <p class="option">Nome: <input type="text" name="itemName" id="itemName"></p>
        <p class="option">Imagem (Base64): <textarea name="itemImg" id="itemImg"></textarea></p>
        <p class="option">Tier: <input type="number" name="itemTier" id="itemTier" value="1"></p>
        <p class="option">
            Tipo do item: 
            <select name="itemType">
                <?php
                    $gameSettings = json_decode(file_get_contents("../../../../settings/gameSettings.json"), true);

                    foreach($gameSettings['itemTypeName'] as $key => $name){
                        echo "<option value='$key'>$name</option>";
                    }
                ?>
            </select>
        </p>
        
        <p class="optionTitle">Propriedades</p>

        <!-- ITEM PROPERTIES -->
        <div id="dmg" class="property btop">
            <p class="option">Dano: </p>
            <p class="option">Min <input type="number" name="dmgMin" id="dmgMin"> - Max <input type="number" name="dmgMax" id="dmgMax"></p>
        </div>
        <div id="atkSpeed" class="property">
            <p class="option">Velocidade de ataque: </p>
            <p class="option"><input type="number" name="atkSpeed" id="atkSpeed"> /s</p>
        </div>
        <div id="lifeSteal" class="property">
            <p class="option">Roubo de vida: </p>
            <p class="option"><input type="number" name="lifeSteal" id="lifeSteal"> %</p>
        </div>
        <div id="armor" class="property">
            <p class="option">Armadura: </p>
            <p class="option"><input type="number" name="armor" id="armor"></p>
        </div>
        <div id="life" class="property">
            <p class="option">Vida máxima: </p>
            <p class="option"><input type="number" name="life" id="life"></p>
        </div>
        <div id="lifeReg" class="property">
            <p class="option">Regeneração de vida: </p>
            <p class="option"><input type="number" name="lifeReg" id="lifeReg"> /s</p>
        </div>

        <p class="optionTitle">Encantamentos</p>

        <!-- ITEM ENCHANTMENTS -->
        <div id="enchantments" class="property btop">
            <p class="option">Valor (JSON): </p>
            <p class="option">
                <textarea name="enchantments" id="enchantments">{}</textarea>
            </p>
            <p class="option">Lista de encantamentos</p>
            <?php
                foreach($gameSettings['enchantmentDescription'] as $key => $val){
                    echo "<p class='option'>$key: <span style='color: #AA00AA;'>$val</span></p>";
                }
            ?>
        </div>

        <br />
        <input type="submit" value="Adicionar">
        <input type="button" value="Cancelar" onclick="window.location = '../'">
    </form>
</body>
</html>

<?php
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){

        //SETTINGS
        define("maxImageSize", 131072);

        //HANDLE BASIC INFO
        $itemName = '';
        $itemImg = '';
        $itemTier = -1;
        $itemType = '';

        if(isset($_POST['itemName'])){ $itemName = $_POST['itemName']; } else { return; }
        if(isset($_POST['itemImg']) || $_POST['itemImg'] < maxImageSize){ $itemImg = $_POST['itemImg']; } else { return; }
        if(isset($_POST['itemTier'])){ $itemTier = $_POST['itemTier']; } else { return; }
        if(isset($_POST['itemType'])){ $itemType = $_POST['itemType']; } else { return; }

        //HANDLE PROPERTIES
        $itemProperties = "{";
        foreach(explode(",", $gameSettings['itemTypeValues'][$itemType]['values']) as $itemVal){
            switch($itemVal){
                case 'dmg':
                    if(isset($_POST['dmgMin']) && isset($_POST['dmgMax']) && !empty($_POST['dmgMin'] && !empty($_POST['dmgMax']))){
                        $dmgMin = $_POST['dmgMin'];
                        $dmgMax = $_POST['dmgMax'];
                        $itemProperties = $itemProperties.'"dmg":{"min":'.$dmgMin.', "max":'.$dmgMax.'},';
                    }

                    break;
                
                case 'atkSpeed':
                    if(isset($_POST['atkSpeed']) && !empty($_POST['atkSpeed'])){
                        $atkSpeed = $_POST['atkSpeed'];
                        $itemProperties = $itemProperties.'"atkSpeed":{"value":'.$atkSpeed.'},';
                    }

                    break;

                case 'lifeSteal':
                    if(isset($_POST['lifeSteal']) && !empty($_POST['lifeSteal'])){
                        $lifeSteal = $_POST['lifeSteal'];
                        $itemProperties = $itemProperties.'"lifeSteal":{"value":'.$lifeSteal.'},';
                    }

                    break;

                case 'armor':
                    if(isset($_POST['armor']) && !empty($_POST['armor'])){
                        $armor = $_POST['armor'];
                        $itemProperties = $itemProperties.'"armor":{"value":'.$armor.'},';
                    }

                    break;

                case 'life':
                    if(isset($_POST['life']) && !empty($_POST['life'])){
                        $life = $_POST['life'];
                        $itemProperties = $itemProperties.'"life":{"value":'.$life.'},';
                    }

                    break;

                case 'lifeReg':
                    if(isset($_POST['lifeReg']) && !empty($_POST['lifeReg'])){
                        $lifeReg = $_POST['lifeReg'];
                        $itemProperties = $itemProperties.'"lifeReg":{"value":'.$lifeReg.'},';
                    }

                    break;

            }
        }
        
        $itemProperties = substr($itemProperties, 0, -1);
        $itemProperties = $itemProperties.'}';

        echo $itemProperties;

        //HANDLE ENCHANTMENTS
        $enchantments = '';
        if(isset($_POST['enchantments'])) { $enchantments = $_POST['enchantments']; } else { return; }

        //SQL
        $sql = "INSERT INTO items (name, image, itemType, itemValues, tier, defaultEnchantments) VALUES ('$itemName', '$itemImg', '$itemType', '$itemProperties', $itemTier, '$enchantments')";

        try {
            mysqli_query(sql_link, $sql);
            header("location: ../");
        } catch (Exception $e) {
            echo 'SQL ERROR: '.$e->getMessage();
        }

    }

?>