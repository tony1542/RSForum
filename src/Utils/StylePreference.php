<?php

namespace App\Utils;

use App\Utils\Http\Session;

class StylePreference
{
    public const STYLE_LIGHT = 0;
    public const STYLE_DARK  = 1;
    public const SESSION_KEY = 'style_preference';
    
    public static function get(): int
    {
        return Session::get(self::SESSION_KEY) ?? self::STYLE_LIGHT;
    }
    
    public static function set($type): void
    {
        $_SESSION[self::SESSION_KEY] = $type;
    }
}
