<?php

class Skills {
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
    
    private const PATH_TO_ICONS = 'images/OSRS/Skills/';
    
    public static function getSkillNameFromIndex(int $index) : string {
        return self::ALL[$index];
    }
    
    public static function getSkillIconFromIndex(int $index) : string {
        return self::PATH_TO_ICONS . strtolower(self::getSkillNameFromIndex($index)) . '.png';
    }
    
    public static function getSkillIconFromName(string $name) : string {
        $file = self::PATH_TO_ICONS . strtolower($name) . '.png';
        
        if (!file_exists($file)) {
            throw new UnexpectedValueException('Invalid file name: ' . $file);
        }
        
        return $file;
    }
}
