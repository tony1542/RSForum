<?php

namespace App\Utils;

class Input
{
    /**
     * Takes in a variable, trims whitespace, strips slashes, and removed
     *
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
