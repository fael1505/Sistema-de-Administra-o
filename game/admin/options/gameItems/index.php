<?php

    require_once '../../../../php/global.php';
    require_once '../../../../php/class.simpleSQLinjectionDetect.php';
    require_once '../../../gameFunctions.php';

    if(!isset($_SESSION['adminLoggedin'])){ return; }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../../style/global.css">
    <link rel="stylesheet" href="default.css">
</head>
<body>
    <table>
        <thead>
            <tr>
                <th width="80px">Item</th>
                <th width="50px">Id</th>
                <th style="min-width:8rem;">Nome</th>
                <th style="min-width:12rem;">Dano base</th>
                <th width="50px">Tier</th>
                <th style="min-width:12rem;">Encantamentos base</th>
                <th width="120px">Opções</th>
                <th width="auto" style="min-width:6rem;" class="tableOptions"><a id="addItem" href="add.php"><img src="../../../../style/imgs/add32px.png"></a><a id="reload" href=""><img src="../../../../style/imgs/reload32px.png"></a></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $error = false;
                $error_msg = "";

                $sql = "SELECT * FROM items";

                if($result=mysqli_query(sql_link, $sql)){

                    if(mysqli_num_rows($result)>0){
                        $gameSettings = json_decode(file_get_contents("../../../settings/gameSettings.json"), true);
                        
                        foreach($result as $row){
                            $img = $row['image'];
                            $id = $row['id'];
                            $name = $row['name'];
                            
                            $tier = $row['tier'];
                            $enchantments = json_decode($row['defaultEnchantments']);

                            $dmg = [
                                $row['baseAtkMin'],
                                $row['baseAtkMax'],
                            ];
                            $totalDmg = itemTotalDamage($dmg, $tier, $enchantments, $gameSettings);

                            $enchantmentsDescription = '';

                            if(!empty($enchantments)){
                                foreach($enchantments as $key => $val){
                                    $enchantmentsDescription = $enchantmentsDescription."<p class='enchantmentDescription'>";
                                    $enchantmentsDescription = $enchantmentsDescription.str_replace('*', $val, $gameSettings['enchantmentDescription'][$key]);
                                    $enchantmentsDescription = $enchantmentsDescription."</p>\r\n";
                                }
                            }
                            

                            echo "
                            <tr>
                                <td><img class='itemImage' src='$img'></td>
                                <td>$id</td>
                                <td>$name</td>
                                <td>$totalDmg[0] - $totalDmg[1]</td>
                                <td>$tier</td>
                                <td>$enchantmentsDescription</td>
                                <td class='options'>
                                    <p><a href=''>Ver</a></p>
                                    <p><a href=''>Editar</a></p>
                                    <p><a href=''>Remover</a></p>
                                </td>
                            </tr>
                            ";
                        }

                    }else{

                        $error = true;
                        $error_msg = 'Nenhum item encontrado no banco de dados';

                    }
                    

                }else{

                    $error = true;
                    $error_msg = 'Não foi possível se conectar ao banco de dados';

                }
            ?>
        </tbody>
    </table>

    <?php if($error){echo "<center><p style='font-size: 1.5rem;'>$error_msg</p></center>";} ?>
</body>
</html>