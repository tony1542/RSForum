<?php

namespace App\Utils\Http;

class Server
{
    public static function getOptions(): array
    {
        return $_SERVER;
    }
    
    public static function getRoot(): string
    {
        if (self::isCommandLine()) {
            return self::getOptions()['PWD'];
        }
        
        return self::getOptions()['DOCUMENT_ROOT'];
    }
    
    public static function isLocalHost(): bool
    {
        if (self::isCommandLine()) {
            return true;
        }
        
        $address = self::getOptions()['REMOTE_ADDR'];
        
        $whitelist = [
            '127.0.0.1',
            '::1',
            '[::1]'
        ];
        
        return (in_array($address, $whitelist));
    }
    
    public static function isCommandLine(): bool
    {
       return PHP_SAPI === 'cli';
    }
}
