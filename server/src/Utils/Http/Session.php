<?php

namespace App\Utils\Http;

class Session
{
    public static function flash(string $key): mixed
    {
        $value = $_SESSION[$key];

        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }

        return $value;
    }

    public static function get(string $key): mixed
    {
        if (self::has($key)) {
            return $_SESSION[$key];
        }

        return false;
    }

    public static function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function unset(string $key): void
    {
        if (self::has($key)) {
            unset($_SESSION[$key]);
        }
    }

    public static function destroy(): bool
    {
        return session_destroy();
    }
}
