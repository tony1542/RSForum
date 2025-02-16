<?php

namespace App\Utils\Runescape;

class Levels
{
    public const REGULAR_SKILL_CAP = 99;
    public const VIRTUAL_SKILL_CAP = 126;

    /**
     * Returns a players level in a skill given their experience
     *
     * @param int $player_experience
     * @param bool $include_virtual_levels
     *
     * @return int
     *
     * @see https://oldschool.runescape.wiki/w/Experience#Levels_1-99
     */
    public static function findFromExp(int $player_experience, bool $include_virtual_levels = true): int
    {
        $total = 0;

        $skill_cap = $include_virtual_levels === true ? self::VIRTUAL_SKILL_CAP : self::REGULAR_SKILL_CAP;
        for ($i = 1; $i <= $skill_cap; $i++) {
            $total += floor($i + 300 * 2 ** ($i / 7));
            $level_experience = floor($total / 4);

            if ($player_experience < $level_experience) {
                return $i;
            }
        }

        return $skill_cap;
    }

    public static function getTotalLevel(array $levels, bool $virtual_level = false): int
    {
        $total_level = 0;

        foreach ($levels as $level) {
            if (!is_numeric($level)) {
                continue;
            }

            $level = (int)$level;

            if (!$virtual_level && $level > self::REGULAR_SKILL_CAP) {
                $total_level += self::REGULAR_SKILL_CAP;

                continue;
            }

            $total_level += $level;
        }

        return $total_level;
    }
}
