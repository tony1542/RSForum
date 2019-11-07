<?php

namespace App\Utils\Database;

use App\Utils\Http\Server;
use PDO;
use PDOStatement;

class Connection
{
    const CONNECTION = 'connection';
    const DB_NAME    = 'db_name';
    const USERNAME   = 'username';
    const PASSWORD   = 'password';
    
    /**
     * Create an instance of our database
     *
     * @return PDO
     *
     * @see https://www.php.net/manual/en/class.pdo.php
     *
     * @throws EnvException
     */
    public static function getInstance()
    {
        $options = self::getConnectionParameters();
    
        $pdo = new PDO('mysql:host=localhost;dbname=tonysphpadminabuse', 'root', '');
        
        // If we are on localhost, we want more detailed error messages since we are developing
        if (Server::isLocalHost()) {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        
        // @see https://www.php.net/manual/en/pdo.connections.php#example-1036
        $pdo->setAttribute(PDO::ATTR_PERSISTENT, true);
    
        return $pdo;
    }
    
    /**
     * @return array
     *
     * @throws EnvException
     */
    protected static function getConnectionParameters()
    {
        $database_name = 'DB';
        
        EnvValidator::enforce($database_name);
        
        return [
            self::CONNECTION => getenv($database_name . '_CONNECTION_URL'),
            self::DB_NAME    => getenv($database_name . '_NAME'),
            self::USERNAME   => getenv($database_name . '_USERNAME'),
            self::PASSWORD   => getenv($database_name . '_PASSWORD')
        ];
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
        ob_start();
        $statement->debugDumpParams();
        $contents = ob_get_clean();
        
        dump($contents);
    }
}
