<?php

namespace App\Utils\Input;

class Sanitizer
{
    /**
     * @param mixed $variable - variable to be sanitized
     *
     * @return string - sanitized variable
     */
    public static function sanitize($variable)
    {
        $variable = trim($variable);
        $variable = stripslashes($variable);
        $variable = htmlspecialchars($variable);
        
        return $variable;
    }
}
