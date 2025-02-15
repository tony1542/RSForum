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
        'Soul Wars Zeal',
        'Abyssal Sire',
        'Alchemical Hydra',
        'Barrows Chests',
        'Bryophyta',
        'Callisto',
        'Cerberus',
        'Chambers of Xeric',
        'Chambers of Xeric Challenge Mode',
        'Chaos Elemental',
        'Chaos Fanatic',
        'Commander Zilyana',
        'Corporeal Beast',
        'Crazy Archaeologist',
        'Dagannoth Prime',
        'Dagannoth Rex',
        'Dagannoth Supreme',
        'Deranged Archaeologist',
        'General Graardor',
        'Giant Mole',
        'Grotesque Guardians',
        'Hespori',
        'Kalphite Queen',
        'King Black Dragon',
        'Kraken',
        'KreeArra',
        'Kril Tsutsaroth',
        'Mimic',
        'The Nightmare',
        'Obor',
        'Sarachnis',
        'Scorpia',
        'Skotizo',
        'The Gauntlet',
        'The Corrupted Gauntlet',
        'Theatre of Blood',
        'Thermonuclear Smoke Devil',
        'TzKal-Zuk',
        'TzTok-Jad',
        'Venenatis',
        'Vetion',
        'Vorkath',
        'Wintertodt',
        'Zalcano',
        'Zulrah'
    ];

    public const PATH_TO_ICONS = '/public/Images/OSRS/Accolades/';

    public static function getAccoladeIconFromIndex(int $index): string
    {
        $accolade = self::getAccoladeFromIndex($index);

        return self::PATH_TO_ICONS . $accolade . '.webp';
    }

    public static function getAccoladeFromIndex(int $index): string
    {
        return self::ALL[$index] ?? '';
    }
}
