<?php

namespace App\Utils\Database;

use App\Utils\Http\Server;
use PDO;
use PDOStatement;

class Connection
{
    public const CONNECTION = 'connection';
    public const DB_NAME    = 'db_name';
    public const USERNAME   = 'username';
    public const PASSWORD   = 'password';
    
    /**
     * Create an instance of our database
     *
     * @return PDO
     *
     * @see https://www.php.net/manual/en/class.pdo.php
     */
    public static function getInstance(): PDO
    {
        $options = self::getConnectionParameters();
    
        $connection = $options[self::CONNECTION];
        $dbname = $options[self::DB_NAME];
        $username = $options[self::USERNAME];
        $password = $options[self::PASSWORD];
    
        $pdo = new PDO(
            'mysql:host=' . $connection . ';dbname=' . $dbname,
            $username,
            $password
        );
        
        // If we are on localhost, we want more detailed error messages since we are developing
        if (Server::isLocalHost()) {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        
        // @see https://www.php.net/manual/en/pdo.connections.php#example-1036
        $pdo->setAttribute(PDO::ATTR_PERSISTENT, true);
    
        return $pdo;
    }
    
    /**
     * Grabs our database values from our .env file
     *
     * @return array
     */
    protected static function getConnectionParameters(): array
    {
        return [
            self::CONNECTION => getenv('DB_CONNECTION_URL'),
            self::DB_NAME    => getenv('DB_NAME'),
            self::USERNAME   => getenv('DB_USERNAME'),
            self::PASSWORD   => getenv('DB_PASSWORD')
        ];
    }
    
    /**
     * Allows us to see more details about why a query might not have worked like we wanted
     *
     * @param PDOStatement $statement
     *
     * @see https://www.php.net/manual/en/pdostatement.debugdumpparams.php
     */
    public static function debugQuery(PDOStatement $statement): void
    {
        ob_start();
        $statement->debugDumpParams();
        $contents = ob_get_clean();
        dump($contents);
    }
}
