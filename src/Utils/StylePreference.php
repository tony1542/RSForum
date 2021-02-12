<?php

namespace App\Utils;

use App\Utils\Http\Session;

class StylePreference
{
    public const STYLE_LIGHT = 0;
    public const STYLE_DARK  = 1;
    
    protected static string $session_key = 'style_preference';
    
    public static function get(): int
    {
        return Session::get(self::$session_key) ?? self::STYLE_LIGHT;
    }
    
    public static function set($type): void
    {
        $_SESSION[self::$session_key] = $type;
    }
}
