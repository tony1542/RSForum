<?php

namespace App\Utils\Runescape;

class Accolades
{
    public const ALL = [
        'Bounty Hunter - Hunter',
        'Bounty Hunter - Rogue',
        'Bounty Hunter (Legacy) - Hunter',
        'Bounty Hunter (Legacy) - Rogue',
        'Clue Scrolls (all)',
        'Clue Scrolls (beginner)',
        'Clue Scrolls (easy)',
        'Clue Scrolls (medium)',
        'Clue Scrolls (hard)',
        'Clue Scrolls (elite)',
        'Clue Scrolls (master)',
        'LMS - Rank',
        'Soul Wars Zeal',
        'Rifts closed',
        'Colosseum Glory',
        'Collections Logged',
        'Abyssal Sire',
        'Alchemical Hydra',
        'Amoxliatl',
        'Araxxor',
        'Artio',
        'Barrows Chests',
        'Bryophyta',
        'Callisto',
        'Calvariion',
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
        'Duke Sucellus',
        'General Graardor',
        'Giant Mole',
        'Grotesque Guardians',
        'Hespori',
        'Kalphite Queen',
        'King Black Dragon',
        'Kraken',
        'KreeArra',
        'Kril Tsutsaroth',
        'Lunar Chests',
        'Mimic',
        'Nex',
        'Nightmare',
        'Phosani Nightmare',
        'Obor',
        'Phantom Muspah',
        'Sarachnis',
        'Scorpia',
        'Scurrius',
        'Skotizo',
        'Sol Heredit',
        'Spindel',
        'Tempoross',
        'The Gauntlet',
        'The Corrupted Gauntlet',
        'The Hueycoatl',
        'The Leviathan',
        'The Royal Titans',
        'The Whisperer',
        'Theatre of Blood',
        'Theatre of Blood Hard Mode',
        'Thermonuclear Smoke Devil',
        'Tombs of Amascut',
        'Tombs of Amascut Expert Mode',
        'TzKal-Zuk',
        'TzTok-Jad',
        'Vardorvis',
        'Venenatis',
        'Vetiion',
        'Vorkath',
        'Wintertodt',
        'Zalcano',
        'Zulrah'
    ];

    public const PATH_TO_ICONS = '/public/Images/OSRS/AccoladesTest/';

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
