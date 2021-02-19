<?php

namespace App\Utils\Runescape;

class AccountType
{
    public const PLAYER_TYPE_NORMAL           = 0;
    public const PLAYER_TYPE_IRONMAN          = 1;
    public const PLAYER_TYPE_HARDCORE_IRONMAN = 2;
    public const PLAYER_TYPE_ULTIMATE_IRONMAN = 3;
    
    public const PLAYER_TYPE_TEXT = [
        self::PLAYER_TYPE_NORMAL           => '',
        self::PLAYER_TYPE_IRONMAN          => 'Ironman',
        self::PLAYER_TYPE_HARDCORE_IRONMAN => 'Hardcore Ironman',
        self::PLAYER_TYPE_ULTIMATE_IRONMAN => 'Ultimate Ironman'
    ];
}
