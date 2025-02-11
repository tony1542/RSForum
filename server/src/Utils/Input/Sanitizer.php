<?php

namespace App\Utils\Input;

class Sanitizer
{
    public static function sanitize(string $variable = ''): string
    {
        $variable = trim($variable);
        $variable = stripslashes($variable);
        $variable = htmlspecialchars($variable, ENT_QUOTES);
        
        return $variable;
    }
}
