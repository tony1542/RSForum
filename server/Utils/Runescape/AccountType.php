<?php

namespace App\Utils\Runescape;

class AccountType
{
    public const PLAYER_TYPE_NORMAL           = 0;
    public const PLAYER_TYPE_IRONMAN          = 1;
    public const PLAYER_TYPE_HARDCORE_IRONMAN = 2;
    public const PLAYER_TYPE_ULTIMATE_IRONMAN = 3;
    
    public const PLAYER_TYPES = [
        self::PLAYER_TYPE_NORMAL,
        self::PLAYER_TYPE_IRONMAN,
        self::PLAYER_TYPE_HARDCORE_IRONMAN,
        self::PLAYER_TYPE_ULTIMATE_IRONMAN,
    ];
    
    public const PLAYER_TYPE_TEXT = [
        self::PLAYER_TYPE_NORMAL           => 'Normal',
        self::PLAYER_TYPE_IRONMAN          => 'Ironman',
        self::PLAYER_TYPE_HARDCORE_IRONMAN => 'Hardcore Ironman',
        self::PLAYER_TYPE_ULTIMATE_IRONMAN => 'Ultimate Ironman'
    ];
    
    public static function getAll(): array
    {
        $account_types = [];
    
        foreach (self::PLAYER_TYPES as $player_type_id) {
            $account_types[$player_type_id] = self::PLAYER_TYPE_TEXT[$player_type_id];
        }
        
        return $account_types;
    }
}
