<?php

namespace App\Utils;

class Levels
{
    const REGULAR_SKILL_CAP = 99;
    const VIRTUAL_SKILL_CAP = 126;
    
    /**
     * Returns a players level in a skill given their experience
     *
     * @param int  $player_experience
     * @param bool $include_virtual_levels
     *
     * @return int
     *
     * @see https://oldschool.runescape.wiki/w/Experience#Levels_1-99
     */
    public static function findFromExp($player_experience, $include_virtual_levels = true)
    {
        $modifier = 0;
        
        $skill_cap = $include_virtual_levels === true ? self::VIRTUAL_SKILL_CAP : self::REGULAR_SKILL_CAP;
        for ($i = 1; $i <= $skill_cap; $i++) {
            $modifier += floor($i + 300 * pow(2, ($i / 7)));
            $level = floor($modifier / 4);
        
            if ($player_experience < $level) {
                return $i;
            }
        }
        
        return $skill_cap;
    }
}
