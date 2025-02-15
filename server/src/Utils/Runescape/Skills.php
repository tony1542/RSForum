<?php

namespace App\Utils\Runescape;

class Skills
{
    public const ALL = [
        'Overall',
        'Attack',
        'Defence',
        'Strength',
        'Hitpoints',
        'Ranged',
        'Prayer',
        'Magic',
        'Cooking',
        'Woodcutting',
        'Fletching',
        'Fishing',
        'Firemaking',
        'Crafting',
        'Smithing',
        'Mining',
        'Herblore',
        'Agility',
        'Thieving',
        'Slayer',
        'Farming',
        'Runecrafting',
        'Hunter',
        'Construction'
    ];

    // Our path to the skill thumbnails
    public const PATH_TO_ICONS = '/public/Images/OSRS/Skills/';

    /**
     * Gets a skill icon thumbnail path from an index
     *
     * @param int $index
     *
     * @return string - Icon location
     */
    public static function getSkillIconFromIndex(int $index): string
    {
        $skill_name = self::getSkillNameFromIndex($index);

        return self::PATH_TO_ICONS . strtolower($skill_name) . '.png';
    }

    /**
     * Get skill name out of our array given an index
     *
     * @param int $index
     *
     * @return string
     */
    public static function getSkillNameFromIndex(int $index): string
    {
        return self::ALL[$index] ?? '';
    }
}
