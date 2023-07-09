<?php

    function itemTotalDamage($baseAtk, $tier, $enchantments, $gameSettings){

        $atkMin = $baseAtk[0];
        $atkMax = $baseAtk[1];
        $maxAtkMultiplier = ($atkMax/100)*$atkMin;

        $tierMultiplier = 1 + (($gameSettings['items']['tierDamageMultiplier'])*($tier-1));

        $atkMin *= $tierMultiplier;
        $atkMax *= $tierMultiplier;

        if(!empty($enchantments)){
            foreach($enchantments as $key => $val){
                
                switch ($key){
                    case '+dmg':
                        $atkMin += $val;
                        $atkMax += ($val*$maxAtkMultiplier);

                        break;

                    case '%dmg':
                        $percentage = $val/100;
                        $atkMin += ($atkMin*$percentage);
                        $atkMax += ($atkMax*$percentage);

                        break;

                }

            }
        }

        return [
            number_format($atkMin, 2),
            number_format($atkMax, 2),
        ];
        
    }

?>