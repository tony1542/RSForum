<?php

namespace App\Utils\Runescape;

class Accolades
{
    public const ALL = [
        'Bounty Hunter - Hunter',
        'Bounty Hunter - Rogue',
        'Clue Scrolls (all)',
        'Clue Scrolls (beginner)',
        'Clue Scrolls (easy)',
        'Clue Scrolls (medium)',
        'Clue Scrolls (hard)',
        'Clue Scrolls (elite)',
        'Clue Scrolls (master)',
        'LMS - Rank',
        'Alchemical'
    ];
    
    public const PATH_TO_ICONS = 'public/Images/OSRS/Accolades/';
    
    public static function getAccoladeFromIndex(int $index): string
    {
        return self::ALL[$index];
    }
    
    public static function getAccoladeIconFromIndex(int $index): string
    {
        $accolade = self::getAccoladeFromIndex($index);
        
        return self::PATH_TO_ICONS . strtolower($accolade) . '.png';
    }
}
