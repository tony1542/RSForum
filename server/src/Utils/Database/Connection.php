<?php

namespace App\Utils\Database;

use App\Utils\Http\Server;
use PDO;

class Connection
{
    public const string CONNECTION = 'connection';
    public const string DB_NAME = 'db_name';
    public const string USERNAME = 'username';
    public const string PASSWORD = 'password';
    public const string PORT = 'port';

    public static function getInstance(): PDO
    {
        $options = self::getConnectionParameters();

        $connection = $options[self::CONNECTION];
        $dbname = $options[self::DB_NAME];
        $username = $options[self::USERNAME];
        $password = $options[self::PASSWORD];
        $port = $options[self::PORT];

        $pdo = new PDO(
            'mysql:host=' . $connection . ';port=' . $port . ';dbname=' . $dbname,
            $username,
            $password
        );

        $server = new Server();
        // If we are on localhost, we want more detailed error messages since we are developing
        if ($server->isLocalHost()) {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        // @see https://www.php.net/manual/en/pdo.connections.php#example-1036
        $pdo->setAttribute(PDO::ATTR_PERSISTENT, true);

        return $pdo;
    }

    protected static function getConnectionParameters(): array
    {
        return [
            self::CONNECTION => $_ENV['DB_CONNECTION_URL'],
            self::DB_NAME => $_ENV['DB_NAME'],
            self::USERNAME => $_ENV['DB_USERNAME'],
            self::PASSWORD => $_ENV['DB_PASSWORD'],
            self::PORT => $_ENV['DB_PORT']
        ];
    }
}
