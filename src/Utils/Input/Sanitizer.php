<?php

namespace App\Utils\Input;

class Sanitizer
{
    /**
     * @param string $variable - variable to be sanitized
     *
     * @return string - sanitized variable
     */
    public static function sanitize(string $variable)
    {
        $variable = trim($variable);
        $variable = stripslashes($variable);
        $variable = htmlspecialchars($variable);
        
        return $variable;
    }
}
