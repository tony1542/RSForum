<?php

namespace App\Utils;

use PDO;

class Database
{
    /**
     * Create an instance of our database
     *
     * @return PDO
     *
     * @see https://www.php.net/manual/en/class.pdo.php
     */
    public static function getInstance()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=tonysphpadminabuse', 'root', '');
        
        // If we are on localhost, we want more detailed error messages since we are developing
        if (isLocalhost()) {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    
        return $pdo;
    }
}
