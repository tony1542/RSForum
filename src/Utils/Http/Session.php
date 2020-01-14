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
        
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    
        return $value;
    }
    
    /**
     * Retrieves an item from the session if it exists
     *
     * @param string $id
     *
     * @return bool|mixed
     */
    public static function get($id)
    {
        if (self::has($id)) {
            return $_SESSION[$id];
        }
        
        return false;
    }
    
    /**
     * Checks if an item exists within the session
     *
     * @param string $id
     *
     * @return bool
     */
    public static function has($id)
    {
        return isset($_SESSION[$id]);
    }
    
    /**
     * Sets a key => value in the session array
     *
     * @param string $id
     * @param mixed  $value
     */
    public static function set($id, $value)
    {
        $_SESSION[$id] = $value;
    }
    
    /**
     * Removes an item from the session if it exists
     *
     * @param string $id
     */
    public static function unset($id)
    {
        if (self::has($id)) {
            unset($_SESSION[$id]);
        }
    }
    
    /**
     * Destroy all session variables
     *
     * @return bool
     */
    public static function destroy()
    {
        return session_destroy();
    }
}
