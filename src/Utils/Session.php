<?php

namespace App\Utils;

class Session
{
    /**
     * Show the contents of a session variable & unset it after
     *
     * @param string $key
     */
    public static function flash($key)
    {
        echo $_SESSION[$key];
        unset($_SESSION[$key]);
    }
}
