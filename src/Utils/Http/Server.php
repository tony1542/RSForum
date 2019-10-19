<?php

namespace App\Utils\Http;

class Server
{
    public static function getOptions()
    {
        return $_SERVER;
    }
    
    public static function getRoot()
    {
        return self::getOptions()['DOCUMENT_ROOT'];
    }
    
    public static function isLocalHost()
    {
        $address = self::getOptions()['REMOTE_ADDR'];
        
        $whitelist = [
            '127.0.0.1',
            '::1',
            '[::1]'
        ];
        
        return (in_array($address, $whitelist));
    }
}
