<?php

namespace App\Classes;

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
    
    private const PATH_TO_ICONS = '/images/OSRS/Skills/';
    
    public static function getSkillNameFromIndex(int $index): string {
        return self::ALL[$index];
    }
    
    public static function getSkillIconFromIndex(int $index): string {
        return self::PATH_TO_ICONS . strtolower(self::getSkillNameFromIndex($index)) . '.png';
    }
}
