<?php

namespace App\Utils;

class StylePreference
{
    public const STYLE_LIGHT = 0;
    public const STYLE_DARK  = 1;
    
    protected static string $session_key = 'style_preference';
    
    public static function get(): int
    {
        $set_style = $_SESSION[self::$session_key];
        
        if (!$set_style) {
            $set_style = self::STYLE_DARK;
        }
        
        return $set_style;
    }
    
    public static function set($type): void
    {
        $_SESSION[self::$session_key] = $type;
    }
}
