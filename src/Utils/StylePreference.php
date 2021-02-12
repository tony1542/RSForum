<?php

namespace App\Utils;

class StylePreference
{
    private const STYLE_LIGHT = 0;
    private const STYLE_DARK  = 1;
    
    protected static $session_key = 'style_preference';
    
    public static function get(): int
    {
        return $_SESSION[self::$session_key] ?? self::STYLE_LIGHT;
    }
    
    public static function set($type): void
    {
        $_SESSION[self::$session_key] = $type;
    }
}