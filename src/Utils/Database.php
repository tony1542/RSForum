<?php

namespace App\Utils;

use PDO;
use PDOStatement;

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
    
    /**
     * Allows us to see more details about why a query might not have worked like we wanted
     *
     * @param PDOStatement $statement
     *
     * @see https://www.php.net/manual/en/pdostatement.debugdumpparams.php
     */
    public static function debugQuery(PDOStatement $statement)
    {
        // TODO explode this on something and get only the 'sent sql:' portion
        ob_start();
        $statement->debugDumpParams();
        $contents = ob_get_clean();
        
        dump($contents);
    }
}
