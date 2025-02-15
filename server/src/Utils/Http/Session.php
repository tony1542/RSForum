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
    public static function flash(string $key)
    {
        $value = $_SESSION[$key];

        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }

        return $value;
    }

    /**
     * Retrieves an item from the session if it exists
     *
     * @param string $key
     *
     * @return bool|mixed
     */
    public static function get(string $key)
    {
        if (self::has($key)) {
            return $_SESSION[$key];
        }

        return false;
    }

    /**
     * Checks if an item exists within the session
     *
     * @param string $key
     *
     * @return bool
     */
    public static function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Sets a key => value in the session array
     *
     * @param string $key
     * @param mixed $value
     */
    public static function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Removes an item from the session if it exists
     *
     * @param string $key
     */
    public static function unset(string $key): void
    {
        if (self::has($key)) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Destroy all session variables
     *
     * @return bool
     */
    public static function destroy(): bool
    {
        return session_destroy();
    }
}
