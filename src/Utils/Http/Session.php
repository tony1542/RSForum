<?php

namespace App\Utils\Http;

class Session
{
    /**
     * Show the contents of a session variable & unset it after
     *
     * @param string $key - The key of the session variable
     *
     * @return mixed      - The value of whatever session variable provided
     */
    public static function flash($key)
    {
        $value = $_SESSION[$key];
        unset($_SESSION[$key]);
    
        return $value;
    }
}
