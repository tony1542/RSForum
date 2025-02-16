<?php

namespace App\Utils\Runescape;

class Skills
{
    public const array ALL = [
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

    public const string PATH_TO_ICONS = '/public/Images/OSRS/Skills/';

    public static function getSkillIconFromIndex(int $index): string
    {
        $skill_name = self::getSkillNameFromIndex($index);

        return self::PATH_TO_ICONS . strtolower($skill_name) . '.png';
    }

    public static function getSkillNameFromIndex(int $index): string
    {
        return self::ALL[$index] ?? '';
    }
}
