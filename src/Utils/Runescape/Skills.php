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
     * Get skill name out of our array given an index
     *
     * @param int $index
     *
     * @return string
     */
    public static function getSkillNameFromIndex($index)
    {
        return self::ALL[$index];
    }
    
    /**
     * Gets a skill icon thumbnail path from an index
     *
     * @param int $index
     *
     * @return string - Icon location
     */
    public static function getSkillIconFromIndex($index)
    {
        $skillName = self::getSkillNameFromIndex($index);
        $path = self::PATH_TO_ICONS . strtolower($skillName) . '.png';
        
        return $path;
    }
}
