<?php

namespace App\Utils;

use PDO;

class Database
{
    /**
     * Create an instance of our database
     *
     * @param bool $debug - If we want more detailed errors
     *
     * @see https://www.php.net/manual/en/class.pdo.php
     */
    public function __construct($debug = false)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=tonysphpadminabuse', 'root', '');
    
        if ($debug) {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    
        return $pdo;
    }
}
